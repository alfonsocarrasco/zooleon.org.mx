<?php

class Acreditaciones extends Controllers {

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
            $this->getPermisos = getPermisos(14, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function acreditaciones() {

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

        $data['page_tag']          = 'acreditaciones';
        $data['page_title']        = 'Módulo de Administración de Acreditaciones';
        $data['page_name']         = 'Acreditaciones';
        $data['page_functions_js'] = 'functions_acreditaciones.js';
        $this->views->getView($this, 'acreditaciones', $data);

    }

    public function setAcreditacion() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtNameAcreditacion']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdAcreditacion   = intval($_POST['idAcreditacion']);
                $strNameAcreditacion = strClean($_POST['txtNameAcreditacion']);
                $intStatus           = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                
                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_acredit.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_acredit.png'; }

                $request_acreditacion = '';
                if ($intIdAcreditacion == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_acreditacion = $this->model->insertAcreditacion($intIdAcreditacion, $strNameAcreditacion, $imgPortada, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_acreditacion = $this->model->insertAcreditacion($intIdAcreditacion, $strNameAcreditacion, $imgPortada, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_acreditacion > 0) {

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

    public function getAcreditaciones() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectAcreditaciones();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['imagenacreditacion'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['imagenacreditacion'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/'.$arrData[$i]['imagenacreditacion'];
                }

                if($arrData[$i]['statusacreditacion'] == 1) {
                    $arrData[$i]['statusacreditacion'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statusacreditacion'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewAcreditacion" onClick="fntViewAcreditacion('.$arrData[$i]['idacreditacion'].')" title="Ver Acreditacion"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditAcreditacion" onClick="fntEditAcreditacion('.$arrData[$i]['idacreditacion'].')" title="Editar Acreditacion"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelAcreditacion" onClick="fntDelAcreditacion('.$arrData[$i]['idacreditacion'].')" title="Eliminar Acreditacion"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getAcreditacion($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdAcreditacion = intval($id);
            if ($intIdAcreditacion > 0) {
                $arrData = $this->model->selectAcreditacion($intIdAcreditacion);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['imagenacreditacion'] == 'portada_categoria.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['imagenacreditacion'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/'.$arrData['imagenacreditacion'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
        
    }

    public function delAcreditacion() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdAcreditacion = intval($_POST['idacreditacion']);
                $requestDelete = $this->model->delAcreditacion($intIdAcreditacion);
                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado correctamente');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

}