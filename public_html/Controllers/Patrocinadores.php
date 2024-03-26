<?php

class Patrocinadores extends Controllers {

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

    public function patrocinadores() {

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

        $data['page_tag']          = 'patrocinadores';
        $data['page_title']        = 'Módulo de Administración de Patrocinadores';
        $data['page_name']         = 'Patrocinadores';
        $data['page_functions_js'] = 'functions_patrocinadores.js';
        $this->views->getView($this, 'patrocinadores', $data);

    }

    public function setSponsor() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtNameSponsor']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdSponsor   = intval($_POST['idSponsor']);
                $strNameSponsor = strClean($_POST['txtNameSponsor']);
                $intStatus      = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_sponsor.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_sponsor.png'; }

                $request_sponsor = '';
                if ($intIdSponsor == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_sponsor = $this->model->insertSponsor($intIdSponsor, $strNameSponsor, $imgPortada, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_sponsor = $this->model->insertSponsor($intIdSponsor, $strNameSponsor, $imgPortada, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_sponsor > 0) {

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

    public function getSponsors() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectSponsors();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['imagenpatrocinador'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['imagenpatrocinador'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/'.$arrData[$i]['imagenpatrocinador'];
                }

                if($arrData[$i]['statuspatrocinador'] == 1) {
                    $arrData[$i]['statuspatrocinador'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statuspatrocinador'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewSponsor" onClick="fntViewSponsor('.$arrData[$i]['idpatrocinador'].')" title="Ver Patrociandor"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditSponsor" onClick="fntEditSponsor('.$arrData[$i]['idpatrocinador'].')" title="Editar Patrociandor"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelSponsor" onClick="fntDelSponsor('.$arrData[$i]['idpatrocinador'].')" title="Eliminar Patrociandor"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getSponsor($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdSponsor = intval($id);
            if ($intIdSponsor > 0) {
                $arrData = $this->model->selectSponsor($intIdSponsor);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['imagenpatrocinador'] == 'portada_categoria.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['imagenpatrocinador'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/'.$arrData['imagenpatrocinador'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
        
    }

    public function delSponsor() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdSponsor = intval($_POST['idsponsor']);
                $requestDelete = $this->model->delSponsor($intIdSponsor);
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