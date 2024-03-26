<?php

class Births extends Controllers {

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
            $this->getPermisos = getPermisos(30, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function births() {

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

        $data['page_tag'] = 'nacimientos';
        $data['page_title'] = 'Nacimientos';
        $data['page_name'] = 'Nacimientos';
        $data['page_functions_js'] = 'functions_births.js';
        $this->views->getView($this, 'births', $data);

    }

    public function setData() {
        if ($_POST) {

            $getPermisos = $this->getPermisos;

            if(empty($_POST['txtNombreEspecie']) || empty($_POST['txtNombreCientifico']) || empty($_POST['txtFecha']) || empty($_POST['txtDescripcion']) || empty($_POST['listCategoria']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {

                $intIdEspecie        = intval($_POST['idNacimiento']);
                $strNombreEjemplar   = strClean($_POST['txtNombreEspecie']);
                $strNombreCientifico = strClean($_POST['txtNombreCientifico']);
                $strFecha            = strClean($_POST['txtFecha']);
                $strDescripcion      = strClean($_POST['txtDescripcion']);
                $arrimgGaleriaActual = strClean($_POST['imgGaleriaActual']);
                $intListCat          = intval($_POST['listCategoria']);
                $intListStatus       = intval($_POST['listStatus']);

                $ruta = strtolower(clear_cadena($strNombreEjemplar));
                $ruta = str_replace(' ', '-', $ruta);

                // Portada Hero
                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['name'];
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                ($nombre_foto != '' && $type == 'image/jpeg') ? $imgPortada = $ruta.'_'.md5(date('d-m-Y H:i:s')).'.jpg' : $imgPortada = $ruta.'_'.md5(date('d-m-Y H:i:s')).'.png';

                if(isset($_FILES['txtGaleria'])) {
                    $imgGaleria      = $_FILES['txtGaleria'];
                    $name_imgGaleria = $imgGaleria['name'];
                    $type_imgGaleria = $imgGaleria['type'];
                    $objectGaleriaNew = array();
    
                    if ($name_imgGaleria != '') {
    
                        $imgCount = count($name_imgGaleria);
                        for ($i=0; $i < $imgCount; $i++) { 
    
                            if ( $type_imgGaleria[$i] == 'image/png' ) {
                                $objectGaleriaNew[] .= $ruta.'-'.md5(rand()).'.png';
                            } else {
                                $objectGaleriaNew[] .= $ruta.'-'.md5(rand()).'.jpg';
                            }
                        }

                        $updateImg = json_encode($objectGaleriaNew, JSON_UNESCAPED_UNICODE);

                        if (!empty($arrimgGaleriaActual)) {

                            $newArrImg = explode(',', $arrimgGaleriaActual);
                            for ($i=0; $i < count($newArrImg); $i++) {
                                $objectImgActual[] = str_replace('"', '', basename($newArrImg[$i]));
                            }

                            $arrInsertImg = array_merge($objectImgActual, $objectGaleriaNew);
                            $arrImgGaleria = json_encode($arrInsertImg, JSON_UNESCAPED_UNICODE);

                        } else {
                            $arrImgGaleria = json_encode($objectGaleriaNew, JSON_UNESCAPED_UNICODE);
                        }

                    }
                } else {
                    
                    $newArrImg = explode(',', $arrimgGaleriaActual);
                    for ($i=0; $i < count($newArrImg); $i++) {
                        $objectImgActual[] = str_replace('"', '', basename($newArrImg[$i]));
                    }
                    
                    $arrImgGaleria = json_encode($objectImgActual, JSON_UNESCAPED_UNICODE);
                    
                }

                if($intIdEspecie == 0) {
                    //Crear
                    if ($getPermisos['permisosMod']['w']) {

                        $request_evento = $this->model->insertData($intIdEspecie, $strNombreEjemplar, $strNombreCientifico, $strFecha, $strDescripcion, $imgPortada, $arrImgGaleria, $ruta, $intListCat, $intListStatus);
                        $option = 1;

                    }

                } else {
                    //Actualizar
                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ){
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_evento = $this->model->insertData($intIdEspecie, $strNombreEjemplar, $strNombreCientifico, $strFecha, $strDescripcion, $imgPortada, $arrImgGaleria, $ruta, $intListCat, $intListStatus);
                        $option = 2;
                    }
                }

                if($request_evento > 0 ) {
                    if($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                        if ($nombre_foto != '') { uploadNacimientos($foto, $imgPortada); }
                        if ($name_imgGaleria != '') { uploadGaleriaNacimientos($imgGaleria, $arrImgGaleria); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

                        if ($nombre_foto != ''){ uploadNacimientos($foto, $imgPortada); }

                        if (isset($_FILES['txtGaleria'])) {
                            if ($name_imgGaleria != '') { uploadGaleriaNacimientos($imgGaleria, $updateImg); }
                        }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileNacimiento($_POST['foto_actual']);
                        }

                    }

                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
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
                
                if ($arrData[$i]['portada'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['portada'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/nacimientos/'.$arrData[$i]['portada'];
                }

                if($arrData[$i]['status'] == 1) {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewEjemplar" onClick="fntViewData('.$arrData[$i]['idnacimiento'].')" title="Ver ejemplar"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditEjemplar" onClick="fntEditData('.$arrData[$i]['idnacimiento'].')" title="Editar ejemplar"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelEjemplar" onClick="fntDelData('.$arrData[$i]['idnacimiento'].')" title="Eliminar ejemplar"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getNacimiento($id) {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $intIdNacimiento = intval($id);
            if($intIdNacimiento > 0) {
                $arrData = $this->model->selectNacimiento($intIdNacimiento);
                if(empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {

                    $arrData['url_portada'] = media().'images/uploads/nacimientos/'.$arrData['portada'];

                    $decode_img = json_decode($arrData['galeria']);
                    
                    if (!empty($decode_img)) {
                        for ($i=0; $i < count($decode_img); $i++) {
                            $arrData['img_galeria'][] = media().'images/uploads/nacimientos/'.$decode_img[$i];
                        }
                    }

                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();

    }

    public function delData() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdEjemplar = intval($_POST['id']);
                $requestDelete = $this->model->deleteData($intIdEjemplar);
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
                $destino = 'Assets/images/uploads/nacimientos/'.$titulo;
                $origen = $_FILES["file"]["tmp_name"];
                move_uploaded_file($origen, $destino);
                $image = media().'images/uploads/nacimientos/'.$titulo;
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