<?php

class Reglamentogral extends Controllers {

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
            $this->getPermisos = getPermisos(9, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function reglamentogral() {

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

        $data['page_tag']          = 'page_reglamento';
        $data['page_title']        = 'Reglamento';
        $data['page_name']         = 'Reglamento General';
        $data['page_functions_js'] = 'functions_reglamento.js';
        $this->views->getView($this, 'reglamentogral', $data);

    }

    public function setReglas() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtDescripcionRegla']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdRegla     = intval($_POST['idReglamento']);
                $strDescripcion = strClean($_POST['txtDescripcionRegla']);
                $intStatus      = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'.png'; }

                $request_regla = '';
                if ($intIdRegla == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_regla = $this->model->insertRegla($intIdRegla, $strDescripcion, $imgPortada, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_regla = $this->model->insertRegla($intIdRegla, $strDescripcion, $imgPortada, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_regla > 0) {

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

    public function getReglas() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectReglas();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['image_reglamento'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['image_reglamento'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/'.$arrData[$i]['image_reglamento'];
                }

                if($arrData[$i]['statusreglamento'] == 1) {
                    $arrData[$i]['statusreglamento'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statusreglamento'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewReglamento" onClick="fntViewReglamento('.$arrData[$i]['idreglamento'].')" title="Ver Reglamento"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditReglamento" onClick="fntEditReglamento('.$arrData[$i]['idreglamento'].')" title="Editar Reglamento"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelReglamento" onClick="fntDelReglamento('.$arrData[$i]['idreglamento'].')" title="Eliminar Reglamento"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getRegla($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdRegla = intval($id);
            if ($intIdRegla > 0) {
                $arrData = $this->model->selectRegla($intIdRegla);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['image_reglamento'] == 'portada_categoria.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['image_reglamento'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/'.$arrData['image_reglamento'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
        
    }

    public function delRegla() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdRegla = intval($_POST['idregla']);
                $requestDelete = $this->model->delRegla($intIdRegla);
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

    public function pagereglamento() {

        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        $data['page_tag'] = 'page_reglamento';
        $data['page_title'] = 'Reglamento General';
        $data['page_name'] = 'Reglamento General';
        $data['page_functions_js'] = 'functions_pagereglamento.js';

        $data['iduser'] = $valores['data']->iduser;
        $data['nombre'] = $valores['data']->nombre;
        $data['primerApellido'] = $valores['data']->primerapellido;
        $data['segundoApellido'] = $valores['data']->segundoapellido;
        $data['rol'] = $valores['data']->nombrerol;
        $data['nameuser'] = $valores['data']->nameuser;
        $data['imagen'] = $valores['data']->imguser;

        $data['permisos'] = $getPermisos['permisos'];
        $data['permisosMod'] = $getPermisos['permisosMod'];

        $this->views->getView($this, 'pagereglamento', $data);

    }

    public function setDataPageReglamento() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtNameEspecie']) || empty($_POST['txtNameScien']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdPageRegla         = intval($_POST['idpageregla']);
                $strTitulo              = strClean($_POST['txtTitulo']);
                $strNameEspecie         = strClean($_POST['txtNameEspecie']);
                $strnameScientific      = strClean($_POST['txtNameScien']);
                $intStatus              = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_regla.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_regla.png'; }

                $foto_parallax        = $_FILES['foto2'];
                $nombre_foto_parallax = $foto_parallax['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax['name'], 'png')));
                $nombre_foto_parallax = str_replace(' ', '-', $nombre_foto_parallax);
                $type_parallax        = $foto_parallax['type'];
                $url_temp_parallax    = $foto_parallax['tmp_name'];
                $imgPortada_parallax  = 'portada_categoria.jpg';

                if ($nombre_foto_parallax != '' && $type_parallax == 'image/jpeg') { $imgPortada_parallax = $nombre_foto_parallax.'_regla.jpg'; }
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/png') { $imgPortada_parallax = $nombre_foto_parallax.'_regla.png'; }

                $request_privacidad     = '';

                if ($intIdPageRegla == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_privacidad = $this->model->insertDataPageRegla($intIdPageRegla, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        if($nombre_foto_parallax == '') {
                            if($_POST['foto_actual_parallax'] != 'portada_categoria.jpg' && $_POST['foto_remove_parallax'] == 0 ) {
                                $imgPortada_parallax = $_POST['foto_actual_parallax'];
                            }
                        }

                        $request_privacidad = $this->model->insertDataPageRegla($intIdPageRegla, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_privacidad > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_parallax != '') { uploadImageGral($foto_parallax, $imgPortada_parallax); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_parallax != '') { uploadImageGral($foto_parallax, $imgPortada_parallax); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                        if(($nombre_foto_parallax == '' && $_POST['foto_remove_parallax'] == 1 && $_POST['foto_actual_parallax'] != 'portada_categoria.jpg') || ($nombre_foto_parallax != '' && $_POST['foto_actual_parallax'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallax']);
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

    public function getDataPageReglamento($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            
            $arrData = $this->model->selectDataPageReglamento($id);
            
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {

                if ($arrData['portada_pagereglamento'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada_pagereglamento'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_pagereglamento'];
                }

                if ($arrData['parallax_pagereglamento'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax'] = media().'images/'.$arrData['parallax_pagereglamento'];
                } else {
                    $arrData['portada_url_parallax'] = media().'images/uploads/'.$arrData['parallax_pagereglamento'];
                }

                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}