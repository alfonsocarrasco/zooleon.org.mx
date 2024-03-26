<?php

class Pageejemplares extends Controllers {

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
            $this->getPermisos = getPermisos(19, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function pageejemplares() {
        
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

        $data['page_tag'] = 'page_ejemplares';
        $data['page_title'] = 'Página Especies';
        $data['page_name'] = 'Página Especies';
        $data['page_functions_js'] = 'functions_pageejemplares.js';
        $this->views->getView($this, 'pageejemplares', $data);

    }

    public function setDataPageEjemplares() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtNameEspecie']) || empty($_POST['txtNameScien']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdPageEjemp    = intval($_POST['idpageejemplares']);
                $strTitulo         = strClean($_POST['txtTitulo']);
                $strNameEspecie    = strClean($_POST['txtNameEspecie']);
                $strnameScientific = strClean($_POST['txtNameScien']);
                $nameespcie2       = strClean($_POST['txtNameEspecie2']);
                $namescie2         = strClean($_POST['txtNameScien2']);
                $nameespcie3       = strClean($_POST['txtNameEspecie3']);
                $namescie3         = strClean($_POST['txtNameScien3']);
                $intStatus         = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_ejemplares.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_ejemplares.png'; }

                $foto_parallax        = $_FILES['foto2'];
                $nombre_foto_parallax = $foto_parallax['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax['name'], 'png')));
                $nombre_foto_parallax = str_replace(' ', '-', $nombre_foto_parallax);
                $type_parallax        = $foto_parallax['type'];
                $url_temp_parallax    = $foto_parallax['tmp_name'];
                $imgPortada_parallax  = 'portada_categoria.jpg';

                if ($nombre_foto_parallax != '' && $type_parallax == 'image/jpeg') { $imgPortada_parallax = $nombre_foto_parallax.'_ejemplares.jpg'; }
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/png') { $imgPortada_parallax = $nombre_foto_parallax.'_ejemplares.png'; }
                
                $foto_parallax2       = $_FILES['foto3'];
                $nombre_p2 = $foto_parallax2['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax2['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax2['name'], 'png')));
                $nombre_p2 = str_replace(' ', '-', $nombre_p2);
                $type_parallax2       = $foto_parallax2['type'];
                $url_temp_parallax2   = $foto_parallax2['tmp_name'];
                $parallax2  = 'portada_categoria.jpg';

                if ($nombre_p2 != '' && $type_parallax2 == 'image/jpeg') { $parallax2 = $nombre_p2.'_ejemplares.jpg'; }
                if ($nombre_p2 != '' && $type_parallax2 == 'image/png') { $parallax2 = $nombre_p2.'_ejemplares.png'; }
                
                $foto_parallax3       = $_FILES['foto4'];
                $nombre_p3 = $foto_parallax3['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax3['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax3['name'], 'png')));
                $nombre_p3 = str_replace(' ', '-', $nombre_p3);
                $type_parallax3       = $foto_parallax3['type'];
                $url_temp_parallax3   = $foto_parallax3['tmp_name'];
                $parallax3  = 'portada_categoria.jpg';

                if ($nombre_p3 != '' && $type_parallax3 == 'image/jpeg') { $parallax3 = $nombre_p3.'_ejemplares.jpg'; }
                if ($nombre_p3 != '' && $type_parallax3 == 'image/png') { $parallax3 = $nombre_p3.'_ejemplares.png'; }

                $request_ejemplares = '';

                if ($intIdPageEjemp == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_ejemplares = $this->model->insertDataPageEjemplares($intIdPageEjemp, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $nameespcie2, $namescie2, $parallax2, $nameespcie3, $namescie3, $parallax3, $intStatus);
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

                        if($nombre_p2 == '') {
                            if($_POST['foto_actual_parallax2'] != 'portada_categoria.jpg' && $_POST['foto_remove_parallax2'] == 0 ) {
                                $parallax2 = $_POST['foto_actual_parallax2'];
                            }
                        }

                        if($nombre_p3 == '') {
                            if($_POST['foto_actual_parallax3'] != 'portada_categoria.jpg' && $_POST['foto_remove_parallax3'] == 0 ) {
                                $parallax3 = $_POST['foto_actual_parallax3'];
                            }
                        }

                        $request_ejemplares = $this->model->insertDataPageEjemplares($intIdPageEjemp, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $nameespcie2, $namescie2, $parallax2, $nameespcie3, $namescie3, $parallax3, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_ejemplares > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_parallax != '') { uploadImageGral($foto_parallax, $imgPortada_parallax); }
                        if($nombre_p2 != '') { uploadImageGral($foto_parallax2, $parallax2); }
                        if($nombre_p3 != '') { uploadImageGral($foto_parallax3, $parallax3); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_parallax != '') { uploadImageGral($foto_parallax, $imgPortada_parallax); }
                        if($nombre_p2 != '') { uploadImageGral($foto_parallax2, $parallax2); }
                        if($nombre_p3 != '') { uploadImageGral($foto_parallax3, $parallax3); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                        if(($nombre_foto_parallax == '' && $_POST['foto_remove_parallax'] == 1 && $_POST['foto_actual_parallax'] != 'portada_categoria.jpg') || ($nombre_foto_parallax != '' && $_POST['foto_actual_parallax'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallax']);
                        }

                        if(($nombre_p2 == '' && $_POST['foto_remove_parallax2'] == 1 && $_POST['foto_actual_parallax2'] != 'portada_categoria.jpg') || ($nombre_p2 != '' && $_POST['foto_actual_parallax2'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallax2']);
                        }
                        
                        if(($nombre_p3 == '' && $_POST['foto_remove_parallax3'] == 1 && $_POST['foto_actual_parallax3'] != 'portada_categoria.jpg') || ($nombre_p3 != '' && $_POST['foto_actual_parallax3'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallax3']);
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

    public function getDataPageEjemplares($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            
            $arrData = $this->model->selectDataPageEjemplares($id);
            
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {

                if ($arrData['portada_pageejemplares'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada_pageejemplares'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_pageejemplares'];
                }

                if ($arrData['parallax_pageejemplares'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax'] = media().'images/'.$arrData['parallax_pageejemplares'];
                } else {
                    $arrData['portada_url_parallax'] = media().'images/uploads/'.$arrData['parallax_pageejemplares'];
                }

                if ($arrData['parallax2'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax2'] = media().'images/'.$arrData['parallax2'];
                } else {
                    $arrData['portada_url_parallax2'] = media().'images/uploads/'.$arrData['parallax2'];
                }
                
                if ($arrData['parallax3'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax3'] = media().'images/'.$arrData['parallax3'];
                } else {
                    $arrData['portada_url_parallax3'] = media().'images/uploads/'.$arrData['parallax3'];
                }

                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}