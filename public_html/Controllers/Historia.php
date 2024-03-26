<?php

class Historia extends Controllers {

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
            $this->getPermisos = getPermisos(7, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function historia() {

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

        $data['page_tag']          = 'page_historia';
        $data['page_title']        = 'Historia';
        $data['page_name']         = 'Historia';
        $data['page_functions_js'] = 'functions_historia.js';
        $this->views->getView($this, 'historia', $data);

    }

    public function setDataHistoria() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdHistoria          = intval($_POST['idHistoria']);
                $strTitulo              = strClean($_POST['txtTitulo']);
                $strDescripcion         = strClean($_POST['txtDescripcion']);
                $strAntecedentes        = strClean($_POST['txtAntecedentes']);
                $strTituloNumAnimals    = strClean($_POST['txtTituloNumAnimales']);
                $strNumAnimals          = strClean($_POST['txtNumAnimales']);
                $strTituloNumEspecies   = strClean($_POST['txtTituloNumEspecies']);
                $strNumEspecies         = strClean($_POST['txtNumEspecies']);
                $strTituloNumPersonas   = strClean($_POST['txtTituloNumPersonas']);
                $strNumPersonas         = strClean($_POST['txtNumPersonas']);
                $strTituloContamos      = strClean($_POST['txtTituloContamos']);
                $strDescripcionContamos = strClean($_POST['txtDescripcionContamos']);
                $intStatus              = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= strtolower(clear_cadena(basename($foto['name'], 'jpg')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_historia.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_historia.png'; }
                
                $foto_contamos   	 	= $_FILES['foto2'];
                $nombre_foto_contamos 	= strtolower(clear_cadena(basename($foto_contamos['name'], 'jpg')));
                $nombre_foto_contamos    = str_replace(' ', '-', $nombre_foto_contamos);
                $type_contamos 		 	= $foto_contamos['type'];
                $url_temp_contamos    	= $foto_contamos['tmp_name'];
                $imgPortada_contamos 	= 'portada_categoria.jpg';

                if ($nombre_foto_contamos != '' && $type_contamos == 'image/jpeg') { $imgPortada_contamos = $nombre_foto_contamos.'_historia.jpg'; }
                if ($nombre_foto_contamos != '' && $type_contamos == 'image/png') { $imgPortada_contamos = $nombre_foto_contamos.'_historia.png'; }

                $parallaxUno        = $_FILES['foto3'];
                $nombreParallaxUno = strtolower(clear_cadena(basename($parallaxUno['name'], 'jpg')));
                $nombreParallaxUno = str_replace(' ', '-', $nombreParallaxUno);
                $typeParallaxUno        = $parallaxUno['type'];
                $url_temp_parallaxUno    = $parallaxUno['tmp_name'];
                $imgPortada_parallaxUno  = 'portada_categoria.jpg';

                if ($nombreParallaxUno != '' && $typeParallaxUno == 'image/jpeg') { $imgPortada_parallaxUno = $nombreParallaxUno.'_historia.jpg'; }
                if ($nombreParallaxUno != '' && $typeParallaxUno == 'image/png') { $imgPortada_parallaxUno = $nombreParallaxUno.'_historia.png'; }

                $parallaxDos        = $_FILES['foto4'];
                $nombreParallaxDos = strtolower(clear_cadena(basename($parallaxDos['name'], 'jpg')));
                $nombreParallaxDos = str_replace(' ', '-', $nombreParallaxDos);
                $typeParallaxDos        = $parallaxDos['type'];
                $url_temp_parallaxDos    = $parallaxDos['tmp_name'];
                $imgPortada_parallaxDos  = 'portada_categoria.jpg';

                if ($nombreParallaxDos != '' && $typeParallaxDos == 'image/jpeg') { $imgPortada_parallaxDos = $nombreParallaxDos.'_historia.jpg'; }
                if ($nombreParallaxDos != '' && $typeParallaxDos == 'image/png') { $imgPortada_parallaxDos = $nombreParallaxDos.'_historia.png'; }

                if ($intIdHistoria == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_aviso = $this->model->insertDataHistoria($intIdHistoria, $strTitulo, $strAntecedentes, $strDescripcion, $imgPortada, $strTituloNumAnimals, $strNumAnimals, $strTituloNumEspecies, $strNumEspecies, $strTituloNumPersonas, $strNumPersonas, $strTituloContamos, $strDescripcionContamos, $imgPortada_contamos, $imgPortada_parallaxUno, $imgPortada_parallaxDos, $intStatus);
                        $option = 1;
                    } else {
                        $request_aviso = '';
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        if($nombre_foto_contamos == '') {
                            if($_POST['foto_actual_contamos'] != 'portada_categoria.jpg' && $_POST['foto_remove_contamos'] == 0 ) {
                                $imgPortada_contamos = $_POST['foto_actual_contamos'];
                            }
                        }
                        
                        if($nombreParallaxUno == '') {
                            if($_POST['foto_actual_parallaxUno'] != 'portada_categoria.jpg' && $_POST['foto_remove_parallaxUno'] == 0 ) {
                                $imgPortada_parallaxUno = $_POST['foto_actual_parallaxUno'];
                            }
                        }
                        
                        if($nombreParallaxDos == '') {
                            if($_POST['foto_actual_parallaxDos'] != 'portada_categoria.jpg' && $_POST['foto_remove_parallaxDos'] == 0 ) {
                                $imgPortada_parallaxDos = $_POST['foto_actual_parallaxDos'];
                            }
                        }

                        $request_aviso = $this->model->insertDataHistoria($intIdHistoria, $strTitulo, $strAntecedentes, $strDescripcion, $imgPortada, $strTituloNumAnimals, $strNumAnimals, $strTituloNumEspecies, $strNumEspecies, $strTituloNumPersonas, $strNumPersonas, $strTituloContamos, $strDescripcionContamos, $imgPortada_contamos, $imgPortada_parallaxUno, $imgPortada_parallaxDos, $intStatus);
                        $option = 2;

                    } else {
                        $request_aviso = '';
                    }

                }

                if ($request_aviso > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_contamos != '') { uploadImageGral($foto_contamos, $imgPortada_contamos); }
                        if($nombreParallaxUno != '') { uploadImageGral($parallaxUno, $imgPortada_parallaxUno); }
                        if($nombreParallaxDos != '') { uploadImageGral($parallaxDos, $imgPortada_parallaxDos); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_contamos != '') { uploadImageGral($foto_contamos, $imgPortada_contamos); }
                        if($nombreParallaxUno != '') { uploadImageGral($parallaxUno, $imgPortada_parallaxUno); }
                        if($nombreParallaxDos != '') { uploadImageGral($parallaxDos, $imgPortada_parallaxDos); }

                        if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                        if (($nombre_foto_contamos == '' && $_POST['foto_remove_contamos'] == 1 && $_POST['foto_actual_contamos'] != 'portada_categoria.jpg') || ($nombre_foto_contamos != '' && $_POST['foto_actual_contamos'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_contamos']);
                        }
                        
                        if (($nombreParallaxUno == '' && $_POST['foto_remove_parallaxUno'] == 1 && $_POST['foto_actual_parallaxUno'] != 'portada_categoria.jpg') || ($nombreParallaxUno != '' && $_POST['foto_actual_parallaxUno'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallaxUno']);
                        }

                        if (($nombreParallaxDos == '' && $_POST['foto_remove_parallaxDos'] == 1 && $_POST['foto_actual_parallaxDos'] != 'portada_categoria.jpg') || ($nombreParallaxDos != '' && $_POST['foto_actual_parallaxDos'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallaxDos']);
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

    public function getDataHistoria($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $arrData = $this->model->selectDataHistoria($id);

            if ($arrData['portada_historia'] == 'portada_categoria.jpg') {
                $arrData['portada_url'] = media().'images/'.$arrData['portada_historia'];
            } else {
                $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_historia'];
            }

            if ($arrData['portada_contamos_h'] == 'portada_categoria.jpg') {
                $arrData['portada_contamos'] = media().'images/'.$arrData['portada_contamos_h'];
            } else {
                $arrData['portada_contamos'] = media().'images/uploads/'.$arrData['portada_contamos_h'];
            }
            
            if ($arrData['parallax_uno'] == 'portada_categoria.jpg') {
                $arrData['portada_parallax1'] = media().'images/'.$arrData['parallax_uno'];
            } else {
                $arrData['portada_parallax1'] = media().'images/uploads/'.$arrData['parallax_uno'];
            }
            if ($arrData['parallax_dos'] == 'portada_categoria.jpg') {
                $arrData['portada_parallax2'] = media().'images/'.$arrData['parallax_dos'];
            } else {
                $arrData['portada_parallax2'] = media().'images/uploads/'.$arrData['parallax_dos'];
            }


            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
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