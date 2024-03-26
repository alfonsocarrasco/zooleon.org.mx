<?php

class Cultura extends Controllers {

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
            $this->getPermisos = getPermisos(27, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function cultura() {

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

        $data['page_tag']          = 'cultura';
        $data['page_title']        = 'Cultura Zooleon | '.NOMBRE_EMPRESA;
        $data['page_name']         = 'Cultura Zooleon';
        $data['page_functions_js'] = 'functions_cultura.js';
        $this->views->getView($this, 'cultura', $data);

    }

    public function setData() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;
            
            if (empty($_POST['txtTitulo']) || empty($_POST['txtMision']) || empty($_POST['txtVision']) || empty($_POST['txtValores']) || empty($_POST['txtTituloMision']) || empty($_POST['txtTituloVision']) || empty($_POST['txtTituloValores']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdCultura     = intval($_POST['idCultura']);
                $strTitulo        = strClean($_POST['txtTitulo']);
                $strMision        = strClean($_POST['txtMision']);
                $strVision        = strClean($_POST['txtVision']);
                $strValores       = strClean($_POST['txtValores']);
                $strTituloMision  = strClean($_POST['txtTituloMision']);
                $strTituloVision  = strClean($_POST['txtTituloVision']);
                $strTituloValores = strClean($_POST['txtTituloValores']);
                $intStatus        = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= strtolower(clear_cadena(basename($foto['name'], 'jpg')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_cultura.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_cultura.png'; }

                $parallaxUno        = $_FILES['foto2'];
                $nombreParallaxUno = strtolower(clear_cadena(basename($parallaxUno['name'], 'jpg')));
                $nombreParallaxUno = str_replace(' ', '-', $nombreParallaxUno);
                $typeParallaxUno        = $parallaxUno['type'];
                $url_temp_parallaxUno    = $parallaxUno['tmp_name'];
                $imgPortada_parallaxUno  = 'portada_categoria.jpg';

                if ($nombreParallaxUno != '' && $typeParallaxUno == 'image/jpeg') { $imgPortada_parallaxUno = $nombreParallaxUno.'_cultura.jpg'; }
                if ($nombreParallaxUno != '' && $typeParallaxUno == 'image/png') { $imgPortada_parallaxUno = $nombreParallaxUno.'_cultura.png'; }

                $parallaxDos        = $_FILES['foto3'];
                $nombreParallaxDos = strtolower(clear_cadena(basename($parallaxDos['name'], 'jpg')));
                $nombreParallaxDos = str_replace(' ', '-', $nombreParallaxDos);
                $typeParallaxDos        = $parallaxDos['type'];
                $url_temp_parallaxDos    = $parallaxDos['tmp_name'];
                $imgPortada_parallaxDos  = 'portada_categoria.jpg';

                if ($nombreParallaxDos != '' && $typeParallaxDos == 'image/jpeg') { $imgPortada_parallaxDos = $nombreParallaxDos.'_cultura.jpg'; }
                if ($nombreParallaxDos != '' && $typeParallaxDos == 'image/png') { $imgPortada_parallaxDos = $nombreParallaxDos.'_cultura.png'; }

                if ($intIdCultura == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_aviso = $this->model->insertData($intIdCultura, $strTitulo, $imgPortada, $strMision, $strTituloMision, $strVision, $strTituloVision, $strValores, $strTituloValores, $imgPortada_parallaxUno, $imgPortada_parallaxDos, $intStatus);
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

                        $request_aviso = $this->model->insertData($intIdCultura, $strTitulo, $imgPortada, $strMision, $strTituloMision, $strVision, $strTituloVision, $strValores, $strTituloValores, $imgPortada_parallaxUno, $imgPortada_parallaxDos, $intStatus);
                        $option = 2;

                    } else {
                        $request_aviso = '';
                    }

                }

                if ($request_aviso > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombreParallaxUno != '') { uploadImageGral($parallaxUno, $imgPortada_parallaxUno); }
                        if($nombreParallaxDos != '') { uploadImageGral($parallaxDos, $imgPortada_parallaxDos); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombreParallaxUno != '') { uploadImageGral($parallaxUno, $imgPortada_parallaxUno); }
                        if($nombreParallaxDos != '') { uploadImageGral($parallaxDos, $imgPortada_parallaxDos); }

                        if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
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

    public function getData($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {

            $arrData = $this->model->selectData($id);

            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                
                if ($arrData['portada'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada'];
                }
                
                if ($arrData['parallax1'] == 'portada_categoria.jpg') {
                    $arrData['portada_parallax1'] = media().'images/'.$arrData['parallax1'];
                } else {
                    $arrData['portada_parallax1'] = media().'images/uploads/'.$arrData['parallax1'];
                }
                if ($arrData['parallax2'] == 'portada_categoria.jpg') {
                    $arrData['portada_parallax2'] = media().'images/'.$arrData['parallax2'];
                } else {
                    $arrData['portada_parallax2'] = media().'images/uploads/'.$arrData['parallax2'];
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