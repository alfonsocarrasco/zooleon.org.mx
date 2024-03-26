<?php

    class Login extends Controllers {
        
        public function __construct() {
            parent::__construct();

            session_name('zl-abkclss');
            session_id();
            session_start();
            session_regenerate_id();

            if (isset($_COOKIE['_xssid-zl']) && isset($_SESSION['token'])) {
                header('Location: '.base_url().'dashboard');
            }

        }

        public function login() {
            $data['page_tag'] = 'Login - Zooleón';
            $data['page_title'] = 'Parque Zoológico de León';
            $data['page_name'] = 'login';
            $data['page_functions_js'] = 'functions_login.js';
            $this->views->getView($this, 'login', $data);
        }

        public function loginUser() {

            if($_POST) {
                if (empty($_POST['inputEmail']) || empty($_POST['inputPassword'])) {
    
                    $arrResponse = array('status' => false, 'msg' => 'Error en el usuario o contraseña.');
    
                } else {
    
                    $strUsuario = strtolower(strClean($_POST['inputEmail']));
                    $strPassword = hash('SHA256', $_POST['inputPassword']);
                    
                    $requestUser = $this->model->loginUser($strUsuario, $strPassword);
                    
                    if(empty($requestUser)) {
                        
                        $arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
                        
                    } else {
    
                        $idSessionActiva = $this->model->getSesionID($requestUser['iduser']);
    
                        if(empty($idSessionActiva['idssesion'])) {
                            // Genera Id para la sesión
                            $id_user = intval($requestUser['iduser']);
                            $id_sesion = strClean(hash('SHA256', uniqid(rand(), true)));
                            $sesionId = $this->model->setSesionID($id_user, $id_sesion);
                            
                            if ($requestUser['statususer'] == 1 && $requestUser['statusrol'] == 1 && $sesionId == 1) {
                                
                                $arrData = $this->model->sessionLogin($requestUser['iduser']);
                                
                                $arrToken = generarToken($arrData);

                                $_SESSION['id'] = $id_user;
                                $_SESSION['token'] = $arrToken;
                                $_SESSION['time'] = time();
                                $token = $_SESSION['token'];
                                $validarTk = validarToken($token);
        
                                setcookie('_xssid-zl', $validarTk['data']->idsession, $validarTk['exp'], '/', null, true, true);
                                setcookie(session_name(), session_id(), $validarTk['exp'], '/', null, true, true);
                                sessionUser($validarTk['data']->iduser);
                                $arrResponse = array('status' => true, 'msg' => 'ok');
                                
                            } else {
                                $arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
                            }
                        } else {
                            $arrResponse = array('status' => false, 'msg' => 'Ya inicio sesión en otro navegador, para continuar cierre la sesión anterior.');
                        }
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function reset() {
            $data['page_tag'] = 'reiniciar password';
            $data['page_title'] = 'Reiniciar Password';
            $data['page_name'] = 'reiniciar';
            $data['page_functions_js'] = 'functions_login.js';
            $this->views->getView($this, 'reset', $data);
        }
    
        public function resetPass() {
            if($_POST) {

                if(empty($_POST['txtEmailReset']) || empty($_POST['token'])) {
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                } else {

                    define('SECRET_KEY', SKEY);

                    $token_captcha = $_POST['token'];
                    $action = $_POST['action'];

                    // call curl to POST request
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => SECRET_KEY, 'response' => $token_captcha)));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $arrResponse = json_decode($response, true);

                    if ($arrResponse['success'] == 1 && $arrResponse['action'] == $action && $arrResponse['score'] >= 0.5) {

                        $token = token();
                        $strEmail = strtolower(strClean($_POST['txtEmailReset']));
                        $arrData = $this->model->getUserEmail($strEmail);
        
                        if(empty($arrData)) {
                            $arrResponse = array('status' => false, 'msg' => 'Usuario no existe.');
                        } else {

                            $iduser = $arrData['iduser'];
                            $nombreUsuario = $arrData['nombre'].' '.$arrData['primerapellido'].' '.$arrData['segundoapellido'];

                            $url_recovery = base_url().'login/confirmUser/'.$strEmail.'/'.$token;
                            $requestUpdate = $this->model->setTokenUser($iduser, $token);

                            $dataUsuario = array('nombreUsuario' => $nombreUsuario,
                                                    'email' => $strEmail,
                                                    'asunto' => 'Notificación: Recuperar Contraseña de '.NOMBRE_REMITENTE,
                                                    'url_recovery' => $url_recovery);

                            if($requestUpdate) {
                                $sendEmail = sendEmail($dataUsuario, 'change_pass_mail');
                                $sendEmail = 1;
        
                                if ($sendEmail) {
                                    $arrResponse = array('status' => true, 'msg' => 'Le hemos enviado un correo electrónico, si no vizualiza el correo en su bandeja de entrada, por favor revise su carpeta SPAM.');
                                } else {
                                    $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                                }
        
                            } else {
                                $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.');
                            }
                        }

                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'Captcha inválido, eres un robot!!!.');
                    }
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    
        public function confirmUser(string $params) {
    
            if(empty($params)) {
                header('Location: '.base_url());
            } else {
                $arrParams = explode(',', $params);
                $strEmail = strClean($arrParams[0]);
                $strToken = strClean($arrParams[1]);
                
                $arrResponse = $this->model->getUsuario($strEmail, $strToken);
                if(empty($arrResponse)) {
                    header('Location: '.base_url().'home');
                } else {
                    $data['page_tag'] = 'Recuperación contraseña';
                    $data['page_title'] = 'Recuperación Contraseña';
                    $data['page_name'] = 'Recuperación Contraseña - Leiregenomics Resultados';
                    $data['nameuser'] = $strEmail;
                    $data['tokenuser'] = $strToken;
                    $data['iduser'] = $arrResponse['iduser'];
                    $data['page_functions_js'] = 'functions_login.js';
                    $this->views->getView($this, 'recovery', $data);
                }
            }
            die();
        }
    
        public function setPassword() {
            
            if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])) {
                
                $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
                
            } else {
                $intIdUsuario = intval($_POST['idUsuario']);
                $strPassword = $_POST['txtPassword'];
                $strPasswordConfirm = $_POST['txtPasswordConfirm'];
                $strEmail = strClean($_POST['txtEmail']);
                $strToken = strClean($_POST['txtToken']);
    
                if (strlen($strPassword) < 8 || strlen($strPasswordConfirm) < 8) {
                    $arrResponse = array('status' => false, 'msg' => 'La contraseña debe tener un mínimo de 8 caracteres.');
                } else if ($strPassword != $strPasswordConfirm) {
                    $arrResponse = array('status' => false, 'msg' => 'La contraseña no coinciden.');
                } else {
    
                    $arrResponseUser = $this->model->getUsuario($strEmail, $strToken);
                    
                    if (empty($arrResponseUser)) {
                        $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
                    } else {
                        $strPassword = hash('SHA256', $strPassword);
                        $requestPass = $this->model->insertPassword($intIdUsuario, $strPassword);
    
                        if ($requestPass) {
                            $arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada con éxito.');
                        } else {
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde.');
                        }
                        
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }

    }