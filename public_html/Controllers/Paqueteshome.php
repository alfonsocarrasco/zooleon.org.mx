<?php

class Paqueteshome extends Controllers {

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
            $this->getPermisos = getPermisos(21, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function paqueteshome() {
        
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

        $data['page_tag'] = 'paquetes_home';
        $data['page_title'] = 'Paquetes Página Home';
        $data['page_name'] = 'Paquetes Página Home';
        $data['page_functions_js'] = 'functions_paqueteshome.js';
        $this->views->getView($this, 'paqueteshome', $data);

    }

    public function setData() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdPaquete   = intval($_POST['idPaquete']);
                $strTitulo      = strClean($_POST['txtTitulo']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $link           = strClean($_POST['txtLinkPaquete']);
                $intStatus      = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_paquetehome.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_paquetehome.png'; }
                
                $foto2   	 	= $_FILES['foto2'];
                $nombre_foto2 	= $foto2['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto2['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto2['name'], 'png')));
                $nombre_foto2    = str_replace(' ', '-', $nombre_foto2);
                $type2 		 	= $foto2['type'];
                $url_temp2    	= $foto2['tmp_name'];
                $imgPortada2 	= 'portada_categoria.jpg';

                if ($nombre_foto2 != '' && $type2 == 'image/jpeg') { $imgPortada2 = $nombre_foto2.'_paquetehome.jpg'; }
                if ($nombre_foto2 != '' && $type2 == 'image/png') { $imgPortada2 = $nombre_foto2.'_paquetehome.png'; }

                $request_paquete = '';
                if ($intIdPaquete == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_paquete = $this->model->insertData($intIdPaquete, $strTitulo, $strDescripcion, $link, $imgPortada, $imgPortada2, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == '') {
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }
                        
                        if($nombre_foto2 == '') {
                            if($_POST['foto_actual_animal'] != 'portada_categoria.jpg' && $_POST['foto_remove_animal'] == 0 ) {
                                $imgPortada2 = $_POST['foto_actual_animal'];
                            }
                        }

                        $request_paquete = $this->model->insertData($intIdPaquete, $strTitulo, $strDescripcion, $link, $imgPortada, $imgPortada2, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_paquete > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto2 != '') { uploadImageGral($foto2, $imgPortada2); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }
                        
                        if($nombre_foto2 != '') { uploadImageGral($foto2, $imgPortada2); }

                        if(($nombre_foto2 == '' && $_POST['foto_remove_animal'] == 1 && $_POST['foto_actual_animal'] != 'portada_categoria.jpg') || ($nombre_foto2 != '' && $_POST['foto_actual_animal'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_animal']);
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

    public function getData() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectData();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['imagen_bkg'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_bkg'] = media().'images/'.$arrData[$i]['imagen_bkg'];
                } else {
                    $arrData[$i]['url_bkg'] = media().'images/uploads/'.$arrData[$i]['imagen_bkg'];
                }
                
                if ($arrData[$i]['imagen_animal'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_animal'] = media().'images/'.$arrData[$i]['imagen_animal'];
                } else {
                    $arrData[$i]['url_animal'] = media().'images/uploads/'.$arrData[$i]['imagen_animal'];
                }

                if($arrData[$i]['status'] == 1) {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewPaquete" onClick="fntViewData('.$arrData[$i]['idpaqueteh'].')" title="Ver Paquete"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditPaquete" onClick="fntEditData('.$arrData[$i]['idpaqueteh'].')" title="Editar Paquete"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelPaquete" onClick="fntDelData('.$arrData[$i]['idpaqueteh'].')" title="Eliminar Paquete"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getPaquete($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdPaquete = intval($id);
            if ($intIdPaquete > 0) {
                $arrData = $this->model->selectPaquete($intIdPaquete);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['imagen_bkg'] == 'portada_categoria.jpg') {
                        $arrData['url_bkg'] = media().'images/'.$arrData['imagen_bkg'];
                    } else {
                        $arrData['url_bkg'] = media().'images/uploads/'.$arrData['imagen_bkg'];
                    }

                    if ($arrData['imagen_animal'] == 'portada_categoria.jpg') {
                        $arrData['url_animal'] = media().'images/'.$arrData['imagen_animal'];
                    } else {
                        $arrData['url_animal'] = media().'images/uploads/'.$arrData['imagen_animal'];
                    }

                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
        
    }

    public function delData() {
        if($_POST) {
            
            $getPermisos = $this->getPermisos;

            if($getPermisos['permisosMod']['d']) {
                $intIdPaqueteH = intval($_POST['id']);
                $requestDelete = $this->model->delData($intIdPaqueteH);
                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el paquete.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el paquete.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

}