<?php

class Politicaprivacidad extends Controllers {

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
            $this->getPermisos = getPermisos(8, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function politicaprivacidad() {

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

        $data['page_tag']          = 'page_politicaprivacidad';
        $data['page_title']        = 'Politica de Privacidad';
        $data['page_name']         = 'Politica de Privacidad';
        $data['page_functions_js'] = 'functions_polprivacidad.js';
        $this->views->getView($this, 'politicaprivacidad', $data);

    }

    public function setDataPrivacidad() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdPrivacidad        = intval($_POST['idPrivacidad']);
                $strTitulo              = strClean($_POST['txtTitulo']);
                $strDescripcion         = strClean($_POST['txtDescripcion']);
                $strNameEspecie         = strClean($_POST['txtNameEspecie']);
                $strnameScientific      = strClean($_POST['txtNameScien']);
                $intStatus              = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= strtolower(clear_cadena(basename($foto['name'], 'jpg')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'.png'; }

                $foto_parallax        = $_FILES['foto2'];
                $nombre_foto_parallax = strtolower(clear_cadena(basename($foto_parallax['name'], 'jpg')));
                $nombre_foto_parallax = str_replace(' ', '-', $nombre_foto_parallax);
                $type_parallax        = $foto_parallax['type'];
                $url_temp_parallax    = $foto_parallax['tmp_name'];
                $imgPortada_parallax  = 'portada_categoria.jpg';

                if ($nombre_foto_parallax != '' && $type_parallax == 'image/jpeg') { $imgPortada_parallax = $nombre_foto_parallax.'.jpg'; }
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/png') { $imgPortada_parallax = $nombre_foto_parallax.'.png'; }

                $request_privacidad     = '';

                if ($intIdPrivacidad == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_privacidad = $this->model->insertDataPrivacidad($intIdPrivacidad, $strTitulo, $strDescripcion, $imgPortada, $strNameEspecie, $strnameScientific, $imgPortada_parallax, $intStatus);
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

                        $request_privacidad = $this->model->insertDataPrivacidad($intIdPrivacidad, $strTitulo, $strDescripcion, $imgPortada, $strNameEspecie, $strnameScientific, $imgPortada_parallax, $intStatus);
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

    public function getDataPrivacidad($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            
            $arrData = $this->model->selectDataPrivacidad($id);
            
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {

                if ($arrData['portada_privacidad'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada_privacidad'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_privacidad'];
                }

                if ($arrData['parallax_privacidad'] == 'portada_categoria.jpg') {
                    $arrData['portada_parallax'] = media().'images/'.$arrData['parallax_privacidad'];
                } else {
                    $arrData['portada_parallax'] = media().'images/uploads/'.$arrData['parallax_privacidad'];
                }

                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function uploadImages() {

        if(isset($_FILES["file"]["name"])) {
            if(!$_FILES["file"]["error"]) {
                $titulo = $_FILES["file"]["name"];
                $destino = 'Assets/images/uploads/'.$titulo;
                $origen = $_FILES["file"]["tmp_name"];
                move_uploaded_file($origen, $destino);
                $image = media().'images/uploads/'.$titulo;
                $arrResponse = array('status' => true, 'data' => $image);

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            } else {

                $mensaje = 'Ooops! El archivo no se pudo crear: '.$_FILES["file"]["error"];
                $arrResponse = array('status' => false, 'msg' => $mensaje);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function deleteImages() {

        if(isset($_POST['src'])) {

            $src = $_POST['src'];
            $ruta = media();
            $fileImage = str_replace($ruta, 'Assets/', $src);
            
            if(file_exists($fileImage)) {
                unlink($fileImage);
                $respuesta = '¡La imagen fue eliminada con éxito!';
                $arrResponse = array('status' => true, 'msg' => $respuesta);
            } else {
                $respuesta = '¡Error al eliminar la imagen!';
                $arrResponse = array('status' => false, 'msg' => $respuesta);
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        
        }
        die();
    }
}