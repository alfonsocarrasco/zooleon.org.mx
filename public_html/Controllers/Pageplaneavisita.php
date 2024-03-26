<?php

class Pageplaneavisita extends Controllers {

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
            $this->getPermisos = getPermisos(29, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function pageplaneavisita() {
    
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
    
        $data['page_tag'] = 'page_planeavisita';
        $data['page_title'] = 'Página Paquetes Grupales';
        $data['page_name'] = 'Página Paquetes Grupales';
        $data['page_functions_js'] = 'functions_pageplanearvisita.js';
        $this->views->getView($this, 'pageplaneavisita', $data);
    
    }
    
    public function setDataPage() {
        // dep($_POST);dep($_FILES);die();
        if ($_POST) {
            $getPermisos = $this->getPermisos;
    
            if (empty($_POST['txtTitulo']) || empty($_POST['txtNameEspecie']) || empty($_POST['txtNameScien']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdPage         = intval($_POST['idpageregla']);
                $strTitulo         = strClean($_POST['txtTitulo']);
                $strFrase          = strClean($_POST['txtFrase']);
                $strNameEspecie    = strClean($_POST['txtNameEspecie']);
                $strnameScientific = strClean($_POST['txtNameScien']);
                $intStatus         = intval($_POST['listStatus']);
    
                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';
    
                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_contacto.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_contacto.png'; }
    
                $foto_parallax        = $_FILES['foto2'];
                $nombre_foto_parallax = $foto_parallax['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax['name'], 'png')));
                $nombre_foto_parallax = str_replace(' ', '-', $nombre_foto_parallax);
                $type_parallax        = $foto_parallax['type'];
                $url_temp_parallax    = $foto_parallax['tmp_name'];
                $imgPortada_parallax  = 'portada_categoria.jpg';
    
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/jpeg') { $imgPortada_parallax = $nombre_foto_parallax.'_contacto.jpg'; }
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/png') { $imgPortada_parallax = $nombre_foto_parallax.'_contacto.png'; }
    
                $request = '';
    
                if ($intIdPage == 0) {
    
                    if ($getPermisos['permisosMod']['w']) {
                        $request = $this->model->insertDataPage($intIdPage, $strTitulo, $strFrase, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
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
    
                        $request = $this->model->insertDataPage($intIdPage, $strTitulo, $strFrase, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
                        $option = 2;
                    }
    
                }
    
                if ($request > 0) {
    
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
    
    public function getDataPage($id = null) {
        $getPermisos = $this->getPermisos;
    
        if($getPermisos['permisosMod']['r']) {
            
            $arrData = $this->model->selectDataPage($id);
            
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
    
                if ($arrData['portada_pageplanea'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada_pageplanea'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_pageplanea'];
                }
    
                if ($arrData['parallax_pageplanea'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax'] = media().'images/'.$arrData['parallax_pageplanea'];
                } else {
                    $arrData['portada_url_parallax'] = media().'images/uploads/'.$arrData['parallax_pageplanea'];
                }
    
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}