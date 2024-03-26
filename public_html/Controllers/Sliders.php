<?php

class Sliders extends Controllers {

    public $validarTk;
    public $getPermisos;

    public function __construct() {
        parent::__construct();

        session_name('zl-abkclss');
        session_id();
        session_start();
        session_regenerate_id();
        validarSesion();
    
        if(isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $this->validarTk = validarToken($token);
            $valores = $this->validarTk;
            $idRol = $valores['data']->idrol;
            $this->getPermisos = getPermisos(5, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function sliders() {
        
        if(isset($_SESSION['token'])) {
            $valores = $this->validarTk;
            $getPermisos = $this->getPermisos;
    
            $data['nombre'] = $valores['data']->nombre;
            $data['primerApellido'] = $valores['data']->primerapellido;
            $data['rol'] = $valores['data']->nombrerol;
            $data['imagen'] = $valores['data']->imguser;
    
            $data['permisos'] = $getPermisos['permisos'];
            $data['permisosMod'] = $getPermisos['permisosMod'];
        }

        if (empty($data['permisosMod']['r'])) {
            header('Location: '.base_url().'dashboard');
        }

        $data['page_tag'] = 'sliders';
        $data['page_title'] = 'Sliders';
        $data['page_name'] = 'sliders';
        $data['page_functions_js'] = 'functions_sliders.js';
        $this->views->getView($this, 'sliders', $data);

    }

    public function setSlider() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdSlider    = intval($_POST['idSlider']);
                $strTitulo      = strClean($_POST['txtTitulo']);
                $strLink        = strClean($_POST['txtLink']);
                $intOrden      = intval($_POST['listOrden']);
                $intStatus      = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_slide.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_slide.png'; }

                $request_slider = '';
                if ($intIdSlider == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_slider = $this->model->insertSlider($intIdSlider, $strTitulo, $strLink, $imgPortada, $intOrden, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == '') {
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_slider = $this->model->insertSlider($intIdSlider, $strTitulo, $strLink, $imgPortada, $intOrden, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_slider > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
                
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);            
        }
        die();

    }

    public function getSliders() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectSliders();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['imagen'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['imagen'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/'.$arrData[$i]['imagen'];
                }

                if($arrData[$i]['statusslider'] == 1) {
                    $arrData[$i]['statusslider'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statusslider'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewSlider" onClick="fntViewSlider('.$arrData[$i]['idslider'].')" title="Ver Slider"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditSlider" onClick="fntEditSlider('.$arrData[$i]['idslider'].')" title="Editar Slider"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelSlider" onClick="fntDelSlider('.$arrData[$i]['idslider'].')" title="Eliminar Slider"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getSlider($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdSlider = intval($id);
            if ($intIdSlider > 0) {
                $arrData = $this->model->selectSlider($intIdSlider);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['imagen'] == 'portada_categoria.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['imagen'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/'.$arrData['imagen'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
        
    }

    public function delSlider() {
        if($_POST) {
            
            $getPermisos = $this->getPermisos;

            if($getPermisos['permisosMod']['d']) {
                $intIdSlider = intval($_POST['id']);
                $requestDelete = $this->model->deleteSlider($intIdSlider);
                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el slider.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el slider.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

}