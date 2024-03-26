<?php

include_once('Models/TDataGral.php');
include_once('Models/TPlaneavisita.php');

class Contacto extends Controllers {

    use TDataGral, TPlaneavisita;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function contacto() {

        $infoContacto = $this->getDataPageContacto();

        $data['page_id']       = 1;
        $data['page_tag']      = 'contacto';
        $data['page_title']    = 'Contacto | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Contacto';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['info_contacto'] = $infoContacto;
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'contacto', $data);
    }

    public function sendContacto() {
        if ($_POST) {
            if (empty($_POST['txtNombre']) || empty($_POST['txtEmail']) || empty($_POST['txtTel']) || empty($_POST['txtAsunto']) || empty($_POST['txtMensaje']) || empty($_POST['token'])) {
                $arrResponse = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');
            } else {

                define('SECRET_KEY', SKEY);

                $token = $_POST['token'];
                $action = $_POST['action'];

                // call curl to POST request
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => SECRET_KEY, 'response' => $token)));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $arrResponse = json_decode($response, true);

                if ($arrResponse['success'] == 1 && $arrResponse['action'] == $action && $arrResponse['score'] >= 0.5) {

                    $nombre 	 = ucwords(strtolower(strClean($_POST['txtNombre'])));
                    $tel 	     = ucwords(strtolower(strClean($_POST['txtTel'])));
                    $email 		 = strtolower(strClean($_POST['txtEmail']));
                    $asunto 	 = strClean($_POST['txtAsunto']);
                    $mensaje  	 = strClean($_POST['txtMensaje']);
                    $useragent 	 = $_SERVER['HTTP_USER_AGENT'];
                    $ip        	 = $_SERVER['REMOTE_ADDR'];
                    $dispositivo = 'PC';
        
                    if (preg_match('/mobile/i', $useragent)) {
                        $dispositivo = 'Movil';
                    } else if (preg_match('/tablet/i', $useragent)) {
                        $dispositivo = 'Tablet';
                    } else if (preg_match('/iPhone/i', $useragent)) {
                        $dispositivo = 'iPhone';
                    } else if (preg_match('/iPad/i', $useragent)) {
                        $dispositivo = 'iPad';
                    }
                    
                    $userContact = $this->setContacto($nombre, $tel, $email, $asunto, $mensaje, $ip, $dispositivo, $useragent);
        
                    if($userContact > 0) {
                        $arrResponse = array('status' => true, 'msg' => 'Su mensaje fue enviado correctamente.');
                        setcookie('zl-abkclss', '', time() - 1, '/');
                        //Enviar correo
                        $dataUsuario = array('asunto' => 'Nuevo contacto desde el sitio web',
                                             'email' => EMAIL_CONTACTO,
                                             'nombreContacto' => $nombre,
                                             'emailContacto' => $email,
                                             'telefonoContacto' => $tel,
                                             'asuntoContacto' => $asunto,
                                             'mensaje' => $mensaje);
                        sendEmail($dataUsuario, 'contact_mail');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'No es posible enviar el mensaje.');
                    }

                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Captcha inválido, eres un robot!!!.');
                }
    
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function sendVisita() {
        if ($_POST) {
            if (empty($_POST['txtTipoEvento']) || empty($_POST['txtNombre']) || empty($_POST['txtEstado']) || empty($_POST['txtMunicipio']) || empty($_POST['txtTelFijo']) || empty($_POST['txtTelCel']) || empty($_POST['txtEmail']) || empty($_POST['txtNumeroPersonas']) || empty($_POST['txtFechaHr']) || empty($_POST['txtAsunto']) || empty($_POST['txtMensaje']) || empty($_POST['token'])) {
                $arrResponse = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');
            } else {

                define('SECRET_KEY', SKEY);

                $token = $_POST['token'];
                $action = $_POST['action'];

                // call curl to POST request
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => SECRET_KEY, 'response' => $token)));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $arrResponse = json_decode($response, true);

                if ($arrResponse['success'] == 1 && $arrResponse['action'] == $action && $arrResponse['score'] >= 0.5) {

                    $evento 	 = strClean(intval($_POST['txtTipoEvento']));
                    $nombre 	 = ucwords(strtolower(strClean($_POST['txtNombre'])));
                    $nombreEmpr  = ucwords(strtolower(strClean($_POST['txtEmpresa'])));
                    $estado 	 = strClean(intval($_POST['txtEstado']));
                    $municipio 	 = strClean(intval($_POST['txtMunicipio']));
                    $tel 	     = ucwords(strtolower(strClean($_POST['txtTelFijo'])));
                    $cel 	     = ucwords(strtolower(strClean($_POST['txtTelCel'])));
                    $email 		 = strtolower(strClean($_POST['txtEmail']));
                    $npersonas   = strtolower(strClean($_POST['txtNumeroPersonas']));
                    $fechaHr     = strtolower(strClean($_POST['txtFechaHr']));
                    $asunto 	 = strClean($_POST['txtAsunto']);
                    $mensaje  	 = strClean($_POST['txtMensaje']);
                    $useragent 	 = $_SERVER['HTTP_USER_AGENT'];
                    $ip        	 = $_SERVER['REMOTE_ADDR'];
                    $dispositivo = 'PC';
        
                    if (preg_match('/mobile/i', $useragent)) {
                        $dispositivo = 'Movil';
                    } else if (preg_match('/tablet/i', $useragent)) {
                        $dispositivo = 'Tablet';
                    } else if (preg_match('/iPhone/i', $useragent)) {
                        $dispositivo = 'iPhone';
                    } else if (preg_match('/iPad/i', $useragent)) {
                        $dispositivo = 'iPad';
                    }
    
                    $estadoName = $this->loadEstados($estado);
                    $municipioName = $this->loadMunicipios($estado, $municipio);
                    
                    $userContact = $this->setVisitas($evento, $nombre, $nombreEmpr, $estado, $municipio, $tel, $cel, $email, $npersonas, $fechaHr, $asunto, $mensaje, $ip, $dispositivo, $useragent);
        
                    if($userContact > 0) {
                        $arrResponse = array('status' => true, 'msg' => 'Su mensaje fue enviado correctamente.');
                        setcookie('zl-abkclss', '', time() - 1, '/');
    
                        //Enviar correo
                        $dataUsuario = array('asunto' => 'Nuevo contacto desde el planea tu visita',
                                             'email' => EMAIL_PLANEAVISITA,
                                             'eventoContacto' => $evento,
                                             'nombreContacto' => $nombre,
                                             'nombreEmpresa' => $nombreEmpr,
                                             'estadoContacto' => $estadoName[0]['nombre'],
                                             'municipioContacto' => $municipioName[0]['nombre'],
                                             'telefonoContacto' => $tel,
                                             'celularContacto' => $cel,
                                             'emailContacto' => $email,
                                             'npersonasContacto' => $npersonas,
                                             'fechahrContacto' => $fechaHr,
                                             'asuntoContacto' => $asunto,
                                             'mensaje' => $mensaje);
                        sendEmail($dataUsuario, 'planeavisita_mail');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'No es posible enviar el mensaje.');
                    }

                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Captcha inválido, eres un robot!!!.');
                }

            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}