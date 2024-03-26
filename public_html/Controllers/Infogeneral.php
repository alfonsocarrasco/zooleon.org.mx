<?php

class Infogeneral extends Controllers {

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
            $this->getPermisos = getPermisos(17, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function infogeneral() {

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

        $data['page_tag']          = 'page_infogral';
        $data['page_title']        = 'Información General';
        $data['page_name']         = 'Información General';
        $data['page_functions_js'] = 'functions_infogeneral.js';
        $this->views->getView($this, 'infogeneral', $data);

    }

    public function setDataInfoGral() {
        
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if(empty($_POST['txtDias']) || empty($_POST['txtHorarioApertura']) || empty($_POST['txtHorarioCierre']) || empty($_POST['txtTituloContacto']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['txtDireccion']) || empty($_POST['listStatus'])) {

                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');

            } else {
            
                $intIdInfoGral   = intval($_POST['idInfoGral']);
                $strDiasCierre   = strClean($_POST['txtDiasCierre']);
                $strDiasApertura = strClean($_POST['txtDias']);
                $strHorarioA     = strClean($_POST['txtHorarioApertura']);
                $strHorarioC     = strClean($_POST['txtHorarioCierre']);

                $strNameEspecie  = strClean($_POST['txtNameEspecie']);
                $strNameScien    = strClean($_POST['txtNameScien']);
                
                $strTitleContact = strClean($_POST['txtTituloContacto']);
                $strTel          = strClean($_POST['txtTelefono']);
                $strMail         = strClean($_POST['txtEmail']);
                $strDireccion    = strClean($_POST['txtDireccion']);

                $strTituloLinea  = strClean($_POST['txtTituloLinea']);
                $strTiLineaUno   = strClean($_POST['txtTituloLineaUno']);
                $strDescLineaUno = strClean($_POST['txtDescripLineaUno']);
                $strTiLineaDos   = strClean($_POST['txtTituloLineaDos']);
                $strDescLineaDos = strClean($_POST['txtDescripLineDos']);

                $strFace         = strClean($_POST['txtFacebook']);
                $strInsta        = strClean($_POST['txtInstagram']);
                $strTwit         = strClean($_POST['txtTwitter']);
                $strYoutube      = strClean($_POST['txtYoutube']);
                $strTikTok       = strClean($_POST['txtTiktok']);

                $intStatus       = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_infogral.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_infogral.png'; }
                
                $fotoParallax   	 = $_FILES['foto2'];
                $nombre_fotoParallax = $fotoParallax['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($fotoParallax['name'], 'jpg'))) : strtolower(clear_cadena(basename($fotoParallax['name'], 'png')));
                $nombre_fotoParallax    = str_replace(' ', '-', $nombre_fotoParallax);
                $type_parallax	     = $fotoParallax['type'];
                $url_parallax_temp   = $fotoParallax['tmp_name'];
                $imgPortadaParallaxD = 'portada_categoria.jpg';

                if ($nombre_fotoParallax != '' && $type_parallax == 'image/jpeg') { $imgPortadaParallaxD = $nombre_fotoParallax.'_infogral.jpg'; }
                if ($nombre_fotoParallax != '' && $type_parallax == 'image/png') { $imgPortadaParallaxD = $nombre_fotoParallax.'_infogral.png'; }
                
                $fotoAcred   	     = $_FILES['foto3'];
                $nombre_fotoAcred    = $fotoAcred['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($fotoAcred['name'], 'jpg'))) : strtolower(clear_cadena(basename($fotoAcred['name'], 'png')));
                $nombre_fotoAcred    = str_replace(' ', '-', $nombre_fotoAcred);
                $type_acred	 	     = $fotoAcred['type'];
                $url_acred_temp	     = $fotoAcred['tmp_name'];
                $imgPortadaAcred     = 'portada_categoria.jpg';

                if ($nombre_fotoAcred != '' && $type_acred == 'image/jpeg') { $imgPortadaAcred = $nombre_fotoAcred.'_infogral.jpg'; }
                if ($nombre_fotoAcred != '' && $type_acred == 'image/png') { $imgPortadaAcred = $nombre_fotoAcred.'_infogral.png'; }
                
                $request_infogral = '';
                if($intIdInfoGral == 0) {
                    //Crear
                    if($getPermisos['permisosMod']['w']) {

                        $request_infogral = $this->model->insertDataInfoGral($intIdInfoGral, $strDiasCierre, $strDiasApertura, $strHorarioA, $strHorarioC, $imgPortada, $strNameEspecie, $strNameScien, $imgPortadaParallaxD, $imgPortadaAcred, $strTitleContact, $strTel, $strMail, $strDireccion, $strTituloLinea, $strTiLineaUno, $strDescLineaUno, $strTiLineaDos, $strDescLineaDos, $strFace, $strInsta, $strTwit, $strYoutube, $strTikTok, $intStatus);
                        $option = 1;
                    }
                } else {
                    //Actualizar
                    if($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }
                        
                        if($nombre_fotoParallax == '') {
                            if($_POST['foto_actual_pallxd'] != 'portada_categoria.jpg' && $_POST['foto_remove_pallxd'] == 0 ) {
                                $imgPortadaParallaxD = $_POST['foto_actual_pallxd'];
                            }
                        }
                        
                        if($nombre_fotoAcred == '') {
                            if($_POST['foto_actual_acredita'] != 'portada_categoria.jpg' && $_POST['foto_remove_acredita'] == 0 ) {
                                $imgPortadaAcred = $_POST['foto_actual_acredita'];
                            }
                        }

                        $request_infogral = $this->model->insertDataInfoGral($intIdInfoGral, $strDiasCierre, $strDiasApertura, $strHorarioA, $strHorarioC, $imgPortada, $strNameEspecie, $strNameScien, $imgPortadaParallaxD, $imgPortadaAcred, $strTitleContact, $strTel, $strMail, $strDireccion, $strTituloLinea, $strTiLineaUno, $strDescLineaUno, $strTiLineaDos, $strDescLineaDos, $strFace, $strInsta, $strTwit, $strYoutube, $strTikTok, $intStatus);
                        $option = 2;
                    }
                }

                if($request_infogral > 0 ) {
                    if($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_fotoParallax != '') { uploadImageGral($fotoParallax, $imgPortadaParallaxD); }
                        if($nombre_fotoAcred != '') { uploadImageGral($fotoAcred, $imgPortadaAcred); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                        
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_fotoParallax != '') { uploadImageGral($fotoParallax, $imgPortadaParallaxD); }
                        if($nombre_fotoAcred != '') { uploadImageGral($fotoAcred, $imgPortadaAcred); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                        if(($nombre_fotoParallax == '' && $_POST['foto_remove_pallxd'] == 1 && $_POST['foto_actual_pallxd'] != 'portada_categoria.jpg') || ($nombre_fotoParallax != '' && $_POST['foto_actual_pallxd'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_pallxd']);
                        }
                        
                        if(($nombre_fotoAcred == '' && $_POST['foto_remove_acredita'] == 1 && $_POST['foto_actual_acredita'] != 'portada_categoria.jpg') || ($nombre_fotoAcred != '' && $_POST['foto_actual_acredita'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_acredita']);
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

    public function getDataInfoGral($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $arrData = $this->model->selectDataInfoGral($id);
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {

                if ($arrData['img_parallax_uno'] == 'portada_categoria.jpg') {
                    $arrData['url_portada'] = media().'images/'.$arrData['img_parallax_uno'];
                } else {
                    $arrData['url_portada'] = media().'images/uploads/'.$arrData['img_parallax_uno'];
                }
                
                if ($arrData['img_parallax_dos'] == 'portada_categoria.jpg') {
                    $arrData['url_portada_parallaxdos'] = media().'images/'.$arrData['img_parallax_dos'];
                } else {
                    $arrData['url_portada_parallaxdos'] = media().'images/uploads/'.$arrData['img_parallax_dos'];
                }
                
                if ($arrData['img_acreditaciones'] == 'portada_categoria.jpg') {
                    $arrData['url_portada_acreditaciones'] = media().'images/'.$arrData['img_acreditaciones'];
                } else {
                    $arrData['url_portada_acreditaciones'] = media().'images/uploads/'.$arrData['img_acreditaciones'];
                }

                $arrResponse = array('status' => true, 'data' => $arrData);

            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}