<?php

class Blog extends Controllers {

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

    public function blog() {
        
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

        $data['page_tag'] = 'Blog';
        $data['page_title'] = 'Blog';
        $data['page_name'] = 'blog';
        $data['page_functions_js'] = 'functions_blog.js';
        $this->views->getView($this, 'blog', $data);

    }

    public function setNoticia() {
        // dep($_POST);dep($_FILES);exit;
        if($_POST){

            $getPermisos = $this->getPermisos;

            if(empty($_POST['txtTituloNota']) || empty($_POST['txtDescripcion']) || empty($_POST['listCategoria']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                
                $intIdNota = intval($_POST['idNota']);
                $strTitleNota =  strClean($_POST['txtTituloNota']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $strVideo = $_POST['txtVideo'];
                $intCategoria = intval($_POST['listCategoria']);
                $intStatus = intval($_POST['listStatus']);
                $fechaActualPub = strClean($_POST['fechaPub']);
                
                if($fechaActualPub != '') {
                    $fechaPublicacion = $fechaActualPub;
                } else {
                    $fechaPublicacion = date('Y-m-d');
                }

                $ruta = strtolower(clear_cadena($strTitleNota));
                $ruta = str_replace(' ', '-', $ruta);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['name'];
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';
                $request_noticia = "";

                if($nombre_foto != '') {
                    $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
                }

                if($intIdNota == 0) {
                    //Crear
                    if($getPermisos['permisosMod']['w']){

                        $request_noticia = $this->model->insertNoticia($intIdNota, $intCategoria, $strTitleNota, $strDescripcion, $imgPortada, $ruta, $strVideo, $fechaPublicacion, $intStatus);
                        $option = 1;
                    }
                } else {
                    //Actualizar
                    if($getPermisos['permisosMod']['u']){
                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ){
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_noticia = $this->model->insertNoticia($intIdNota, $intCategoria, $strTitleNota, $strDescripcion, $imgPortada, $ruta, $strVideo, $fechaPublicacion, $intStatus);
                        $option = 2;
                    }
                }

                if($request_noticia > 0 ) {
                    if($option == 1) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != ''){ uploadImageNoticias($foto, $imgPortada); }
                    } else {
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                        if($nombre_foto != ''){ uploadImageNoticias($foto, $imgPortada); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileNoticias($_POST['foto_actual']);
                        }
                    }
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getNoticias() {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';
            $arrData = $this->model->selectNoticias();

            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['img_nota'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['img_nota'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/noticias/'.$arrData[$i]['img_nota'];
                }

                if($arrData[$i]['statusnota'] == 1) {
                    $arrData[$i]['statusnota'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statusnota'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewNota" onClick="fntViewNota('.$arrData[$i]['idblog'].')" title="Ver nota"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditNota" onClick="fntEditNota('.$arrData[$i]['idblog'].')" title="Editar nota"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelNota" onClick="fntDelNota('.$arrData[$i]['idblog'].')" title="Eliminar nota"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getNoticia($id) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $intIdNota = intval($id);
            if($intIdNota > 0) {
                $arrData = $this->model->selectNota($intIdNota);
                if(empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrData['url_portada'] = media().'images/uploads/noticias/'.$arrData['img_nota'];
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delNoticia() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdNota = intval($_POST['idNota']);
                $requestDelete = $this->model->deleteNoticia($intIdNota);
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

    public function uploadImages() {

        if(isset($_FILES["file"]["name"])) {
            if(!$_FILES["file"]["error"]) {
                $titulo = $_FILES["file"]["name"];
                $destino = 'Assets/images/uploads/noticias/'.$titulo;
                $origen = $_FILES["file"]["tmp_name"];
                move_uploaded_file($origen, $destino);
                $image = media().'images/uploads/noticias/'.$titulo;
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

    public function pagenoticias() {

        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        $data['iduser'] = $valores['data']->iduser;
        $data['nombre'] = $valores['data']->nombre;
        $data['primerApellido'] = $valores['data']->primerapellido;
        $data['segundoApellido'] = $valores['data']->segundoapellido;
        $data['rol'] = $valores['data']->nombrerol;
        $data['nameuser'] = $valores['data']->nameuser;
        $data['imagen'] = $valores['data']->imguser;

        $data['permisos'] = $getPermisos['permisos'];
        $data['permisosMod'] = $getPermisos['permisosMod'];

        $data['page_tag'] = 'page_noticias';
        $data['page_title'] = 'Noticias';
        $data['page_name'] = 'Noticias';
        $data['page_functions_js'] = 'functions_pagenoticia.js';

        $this->views->getView($this, 'pagenoticias', $data);

    }

    public function setDataPageNoticias() {
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

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_noticia.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_noticia.png'; }

                $foto_parallax        = $_FILES['foto2'];
                $nombre_foto_parallax = $foto_parallax['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax['name'], 'png')));
                $nombre_foto_parallax = str_replace(' ', '-', $nombre_foto_parallax);
                $type_parallax        = $foto_parallax['type'];
                $url_temp_parallax    = $foto_parallax['tmp_name'];
                $imgPortada_parallax  = 'portada_categoria.jpg';

                if ($nombre_foto_parallax != '' && $type_parallax == 'image/jpeg') { $imgPortada_parallax = $nombre_foto_parallax.'_noticia.jpg'; }
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/png') { $imgPortada_parallax = $nombre_foto_parallax.'_noticia.png'; }

                $request_noticias = '';

                if ($intIdPageRegla == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_noticias = $this->model->insertDataPageNoticias($intIdPageRegla, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
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

                        $request_noticias = $this->model->insertDataPageNoticias($intIdPageRegla, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_noticias > 0) {

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

    public function getDataPageNoticias($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            
            $arrData = $this->model->selectDataPageNoticias($id);
            
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {

                if ($arrData['portada_pagenoticia'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada_pagenoticia'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_pagenoticia'];
                }

                if ($arrData['parallax_pagenoticia'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax'] = media().'images/'.$arrData['parallax_pagenoticia'];
                } else {
                    $arrData['portada_url_parallax'] = media().'images/uploads/'.$arrData['parallax_pagenoticia'];
                }

                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}