<?php

class Ejemplares extends Controllers {

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
            $this->getPermisos = getPermisos(6, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function ejemplares() {

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

        $data['page_tag'] = 'Ejemplares';
        $data['page_title'] = 'Ejemplares';
        $data['page_name'] = 'ejemplares';
        $data['page_functions_js'] = 'functions_ejemplares.js';
        $this->views->getView($this, 'ejemplares', $data);

    }

    public function setEjemplar() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {

            $getPermisos = $this->getPermisos;

            if(empty($_POST['txtNombreEspecie']) || empty($_POST['txtNombreCientifico']) || empty($_POST['listCategoria']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {

                $intIdEspecie        = intval($_POST['idEspecie']);
                $intListCat          = intval($_POST['listCategoria']);
                $strNombreEjemplar   = strClean($_POST['txtNombreEspecie']);
                $strNombreCientifico = strClean($_POST['txtNombreCientifico']);
                $strVideo            = strClean($_POST['txtVideo']);
                $strTitleVideo       = strClean($_POST['txtTituloVideo']);
                $arrimgGaleriaActual = strClean($_POST['imgGaleriaActual']);
                $coordX              = strClean($_POST['txtCoordX']);
                $coordY              = strClean($_POST['txtCoordY']);
                $orden               = strClean($_POST['intPosicion']);
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

                // Imagen Alimentacion
                $imgFeed         = $_FILES['foto2'];
                $imgFeed_nombre  = $imgFeed['name'];
                $typeFeed        = $imgFeed['type'];
                $url_tempFeed    = $imgFeed['tmp_name'];
                $imgFeed_portada = '';

                ($imgFeed_nombre != '' && $typeFeed == 'image/jpeg') ? $imgFeed_portada = $ruta.'_alimentacion.jpg' : $imgFeed_portada = $ruta.'_alimentacion.png';
                
                // Imagen Tamaño
                $imgSize         = $_FILES['foto3'];
                $imgSize_name    = $imgSize['name'];
                $typeSize        = $imgSize['type'];
                $url_tempSize    = $imgSize['tmp_name'];
                $imgSize_portada = '';

                ($imgSize_name != '' && $typeSize == 'image/jpeg') ? $imgSize_portada = $ruta.'_tamanio.jpg' : $imgSize_portada = $ruta.'_tamanio.png';

                // Imagen Distribución
                $imgDelivery         = $_FILES['foto6'];
                $imgDelivery_nombre  = $imgDelivery['name'];
                $typeDelivery        = $imgDelivery['type'];
                $url_tempDelivery    = $imgDelivery['tmp_name'];
                $imgDelivery_portada = '';

                ($imgDelivery_nombre != '' && $typeDelivery == 'image/jpeg') ? $imgDelivery_portada = $ruta.'_distribucion.jpg' : $imgDelivery_portada = $ruta.'_distribucion.png';
                
                // Imagen Peso
                $imgPeso         = $_FILES['foto4'];
                $imgPeso_name    = $imgPeso['name'];
                $typePeso        = $imgPeso['type'];
                $url_tempPeso    = $imgPeso['tmp_name'];
                $imgPeso_portada = '';

                ($imgPeso_name != '' && $typePeso == 'image/jpeg') ? $imgPeso_portada = $ruta.'_peso.jpg' : $imgPeso_portada = $ruta.'_peso.png';
                
                // Imagen Habitat
                $imgHabitat         = $_FILES['foto5'];
                $imgHabitat_name    = $imgHabitat['name'];
                $typeHabitat        = $imgHabitat['type'];
                $url_tempHabitat    = $imgHabitat['tmp_name'];
                $imgHabitat_portada = '';

                ($imgHabitat_name != '' && $typeHabitat == 'image/jpeg') ? $imgHabitat_portada = $ruta.'_habitat.jpg' : $imgHabitat_portada = $ruta.'_habitat.png';
                
                // Imagen Sabías Qué
                $imgSabias         = $_FILES['foto7'];
                $imgSabias_nombre  = $imgSabias['name'];
                $typeSabias        = $imgSabias['type'];
                $url_tempSabias    = $imgSabias['tmp_name'];
                $imgSabias_portada = '';

                ($imgSabias_nombre != '' && $typeSabias == 'image/jpeg') ? $imgSabias_portada = $ruta.'_sabias.jpg' : $imgSabias_portada = $ruta.'_sabias.png';

                // Imagen Conservación
                $imgConservation         = $_FILES['foto8'];
                $imgConservation_nombre  = $imgConservation['name'];
                $typeConservation        = $imgConservation['type'];
                $url_tempConservation    = $imgConservation['tmp_name'];
                $imgConservation_portada = '';

                ($imgConservation_nombre != '' && $typeConservation == 'image/jpeg') ? $imgConservation_portada = $ruta.'_conservacion.jpg' : $imgConservation_portada = $ruta.'_conservacion.png';

                // Imagen Ubicación
                $imgLocation         = $_FILES['foto9'];
                $imgLocation_nombre  = $imgLocation['name'];
                $typeLocation        = $imgLocation['type'];
                $url_tempLocation    = $imgLocation['tmp_name'];
                $imgLocation_portada = '';
                
                ($imgLocation_nombre != '' && $typeLocation == 'image/jpeg') ? $imgLocation_portada = $ruta.'_ubicacion.jpg' : $imgLocation_portada = $ruta.'_ubicacion.png';

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

                        $request_evento = $this->model->insertEjemplar($intIdEspecie, $intListCat, $strNombreEjemplar, $strNombreCientifico, $imgHabitat_portada, $imgPortada, $imgSabias_portada, $imgSize_portada, $imgFeed_portada, $imgPeso_portada, $imgDelivery_portada, $arrImgGaleria, $imgConservation_portada, $strVideo, $strTitleVideo, $imgLocation_portada, $coordX, $coordY, $ruta, $orden, $intListStatus);
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
                        
                        if($imgFeed_nombre == ''){
                            if($_POST['foto_actual_alimentacion'] != 'portada_categoria.jpg' && $_POST['foto_remove_alimentacion'] == 0 ){
                                $imgFeed_portada = $_POST['foto_actual_alimentacion'];
                            }
                        }
                        
                        if($imgSize_name == ''){
                            if($_POST['foto_actual_tamanio'] != 'portada_categoria.jpg' && $_POST['foto_remove_tamanio'] == 0 ){
                                $imgSize_portada = $_POST['foto_actual_tamanio'];
                            }
                        }

                        if($imgDelivery_nombre == ''){
                            if($_POST['foto_actual_distribucion'] != 'portada_categoria.jpg' && $_POST['foto_remove_distribucion'] == 0 ){
                                $imgDelivery_portada = $_POST['foto_actual_distribucion'];
                            }
                        }
                        
                        if($imgPeso_name == ''){
                            if($_POST['foto_actual_peso'] != 'portada_categoria.jpg' && $_POST['foto_remove_peso'] == 0 ){
                                $imgPeso_portada = $_POST['foto_actual_peso'];
                            }
                        }
                        
                        if($imgHabitat_name == ''){
                            if($_POST['foto_actual_habitat'] != 'portada_categoria.jpg' && $_POST['foto_remove_habitat'] == 0 ){
                                $imgHabitat_portada = $_POST['foto_actual_habitat'];
                            }
                        }
                        
                        if($imgSabias_nombre == ''){
                            if($_POST['foto_actual_sabias'] != 'portada_categoria.jpg' && $_POST['foto_remove_sabias'] == 0 ){
                                $imgSabias_portada = $_POST['foto_actual_sabias'];
                            }
                        }
                        
                        if($imgConservation_nombre == ''){
                            if($_POST['foto_actual_conservacion'] != 'portada_categoria.jpg' && $_POST['foto_remove_conservacion'] == 0 ){
                                $imgConservation_portada = $_POST['foto_actual_conservacion'];
                            }
                        }
                        
                        if($imgLocation_nombre == ''){
                            if($_POST['foto_actual_ubicacion'] != 'portada_categoria.jpg' && $_POST['foto_remove_ubicacion'] == 0 ){
                                $imgLocation_portada = $_POST['foto_actual_ubicacion'];
                            }
                        }

                        $request_evento = $this->model->insertEjemplar($intIdEspecie, $intListCat, $strNombreEjemplar, $strNombreCientifico, $imgHabitat_portada, $imgPortada, $imgSabias_portada, $imgSize_portada, $imgFeed_portada, $imgPeso_portada, $imgDelivery_portada, $arrImgGaleria, $imgConservation_portada, $strVideo, $strTitleVideo, $imgLocation_portada, $coordX, $coordY, $ruta, $orden, $intListStatus);
                        $option = 2;
                    }
                }

                if($request_evento > 0 ) {
                    if($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                        if ($nombre_foto != '') { uploadEjemplar($foto, $imgPortada); }
                        if ($imgFeed_nombre != '') { uploadEjemplar($imgFeed, $imgFeed_portada); }
                        if ($imgSize_name != '') { uploadEjemplar($imgSize, $imgSize_portada); }
                        if ($imgDelivery_nombre != '') { uploadEjemplar($imgDelivery, $imgDelivery_portada); }
                        if ($imgPeso_name != '') { uploadEjemplar($imgPeso, $imgPeso_portada); }
                        if ($imgHabitat_name != '') { uploadEjemplar($imgHabitat, $imgHabitat_portada); }
                        if ($imgSabias_nombre != '') { uploadEjemplar($imgSabias, $imgSabias_portada); }
                        if ($imgConservation_nombre != '') { uploadEjemplar($imgConservation, $imgConservation_portada); }
                        if ($imgLocation_nombre != '') { uploadEjemplar($imgLocation, $imgLocation_portada); }
                        if ($name_imgGaleria != '') { uploadGaleria($imgGaleria, $arrImgGaleria); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');

                        if ($nombre_foto != ''){ uploadEjemplar($foto, $imgPortada); }
                        if ($imgFeed_nombre != '') { uploadEjemplar($imgFeed, $imgFeed_portada); }
                        if ($imgSize_name != '') { uploadEjemplar($imgSize, $imgSize_portada); }
                        if ($imgDelivery_nombre != '') { uploadEjemplar($imgDelivery, $imgDelivery_portada); }
                        if ($imgPeso_name != '') { uploadEjemplar($imgPeso, $imgPeso_portada); }
                        if ($imgHabitat_name != '') { uploadEjemplar($imgHabitat, $imgHabitat_portada); }
                        if ($imgSabias_nombre != '') { uploadEjemplar($imgSabias, $imgSabias_portada); }
                        if ($imgConservation_nombre != '') { uploadEjemplar($imgConservation, $imgConservation_portada); }
                        if ($imgLocation_nombre != '') { uploadEjemplar($imgLocation, $imgLocation_portada); }

                        if (isset($_FILES['txtGaleria'])) {
                            if ($name_imgGaleria != '') { uploadGaleria($imgGaleria, $updateImg); }
                        }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual']);
                        }
                        
                        if(($imgFeed_nombre == '' && $_POST['foto_remove_alimentacion'] == 1 && $_POST['foto_actual_alimentacion'] != 'portada_categoria.jpg') || ($imgFeed_nombre != '' && $_POST['foto_actual_alimentacion'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_alimentacion']);
                        }
                        
                        if(($imgSize_name == '' && $_POST['foto_remove_tamanio'] == 1 && $_POST['foto_actual_tamanio'] != 'portada_categoria.jpg') || ($imgSize_name != '' && $_POST['foto_actual_tamanio'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_tamanio']);
                        }
                        
                        if(($imgDelivery_nombre == '' && $_POST['foto_remove_distribucion'] == 1 && $_POST['foto_actual_distribucion'] != 'portada_categoria.jpg') || ($imgDelivery_nombre != '' && $_POST['foto_actual_distribucion'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_distribucion']);
                        }
                        
                        if(($imgPeso_name == '' && $_POST['foto_remove_peso'] == 1 && $_POST['foto_actual_peso'] != 'portada_categoria.jpg') || ($imgPeso_name != '' && $_POST['foto_actual_peso'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_peso']);
                        }
                        
                        if(($imgHabitat_name == '' && $_POST['foto_remove_habitat'] == 1 && $_POST['foto_actual_habitat'] != 'portada_categoria.jpg') || ($imgHabitat_name != '' && $_POST['foto_actual_habitat'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_habitat']);
                        }
                        
                        if(($imgSabias_nombre == '' && $_POST['foto_remove_sabias'] == 1 && $_POST['foto_actual_sabias'] != 'portada_categoria.jpg') || ($imgSabias_nombre != '' && $_POST['foto_actual_sabias'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_sabias']);
                        }
                        
                        if(($imgConservation_nombre == '' && $_POST['foto_remove_conservacion'] == 1 && $_POST['foto_actual_conservacion'] != 'portada_categoria.jpg') || ($imgConservation_nombre != '' && $_POST['foto_actual_conservacion'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_conservacion']);
                        }
                        
                        if(($imgLocation_nombre == '' && $_POST['foto_remove_ubicacion'] == 1 && $_POST['foto_actual_ubicacion'] != 'portada_categoria.jpg') || ($imgLocation_nombre != '' && $_POST['foto_actual_ubicacion'] != 'portada_categoria.jpg')) {
                            deleteFileEjemplar($_POST['foto_actual_ubicacion']);
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

    public function getEjemplares() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectEjemplares();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['portada_especie'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['portada_especie'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/especies/'.$arrData[$i]['portada_especie'];
                }
                
                $arrData[$i]['url_imgalimentacion'] = media().'images/uploads/especies/'.$arrData[$i]['image_alimentacion'];
                $arrData[$i]['url_imgtamanio']      = media().'images/uploads/especies/'.$arrData[$i]['imagen_tamanio'];
                $arrData[$i]['url_imgdistribucion'] = media().'images/uploads/especies/'.$arrData[$i]['image_distribucion'];
                $arrData[$i]['url_imgpeso']         = media().'images/uploads/especies/'.$arrData[$i]['imagen_peso'];
                $arrData[$i]['url_imghabitat']      = media().'images/uploads/especies/'.$arrData[$i]['imagen_habitat'];
                $arrData[$i]['url_imgsabias']       = media().'images/uploads/especies/'.$arrData[$i]['imagen_sabias'];
                $arrData[$i]['url_imgconservacion'] = media().'images/uploads/especies/'.$arrData[$i]['image_conservacion'];
                $arrData[$i]['url_imgubicacion']    = media().'images/uploads/especies/'.$arrData[$i]['ubicacion_img'];

                if($arrData[$i]['statusespecie'] == 1) {
                    $arrData[$i]['statusespecie'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statusespecie'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewEjemplar" onClick="fntViewEjemplar('.$arrData[$i]['idespecie'].')" title="Ver ejemplar"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditEjemplar" onClick="fntEditEjemplar('.$arrData[$i]['idespecie'].')" title="Editar ejemplar"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelEjemplar" onClick="fntDelEjemplar('.$arrData[$i]['idespecie'].')" title="Eliminar ejemplar"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getEjemplar($id) {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $intIdNota = intval($id);
            if($intIdNota > 0) {
                $arrData = $this->model->selectEjemplar($intIdNota);
                if(empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {

                    $arrData['url_portada'] = media().'images/uploads/especies/'.$arrData['portada_especie'];

                    $arrData['url_imgalimentacion'] = media().'images/uploads/especies/'.$arrData['image_alimentacion'];
                    $arrData['url_imgtamanio']      = media().'images/uploads/especies/'.$arrData['imagen_tamanio'];
                    $arrData['url_imgdistribucion'] = media().'images/uploads/especies/'.$arrData['image_distribucion'];
                    $arrData['url_imgpeso']         = media().'images/uploads/especies/'.$arrData['imagen_peso'];
                    $arrData['url_imghabitat']      = media().'images/uploads/especies/'.$arrData['imagen_habitat'];
                    $arrData['url_imgsabias']       = media().'images/uploads/especies/'.$arrData['imagen_sabias'];
                    $arrData['url_imgconservacion'] = media().'images/uploads/especies/'.$arrData['image_conservacion'];
                    $arrData['url_imgubicacion']    = media().'images/uploads/especies/'.$arrData['ubicacion_img'];

                    $decode_img = json_decode($arrData['images_especie']);
                    
                    if (!empty($decode_img)) {
                        for ($i=0; $i < count($decode_img); $i++) {
                            $arrData['img_galeria'][] = media().'images/uploads/especies/'.$decode_img[$i];
                        }
                    }

                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();

    }

    public function delEjemplar() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdEjemplar = intval($_POST['idEjemplar']);
                $requestDelete = $this->model->deleteEjemplar($intIdEjemplar);
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
                $destino = 'Assets/images/uploads/especies/'.$titulo;
                $origen = $_FILES["file"]["tmp_name"];
                move_uploaded_file($origen, $destino);
                $image = media().'images/uploads/especies/'.$titulo;
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