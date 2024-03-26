<?php

class Usuarios extends Controllers {

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
            $this->getPermisos = getPermisos(2, $idRol); // Extrae los permisos del modulo actual
        }
        
    }

    public function Usuarios() {

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

        $data['page_tag'] = 'Usuarios';
        $data['page_title'] = 'Usuarios';
        $data['page_name'] = 'usuarios';
        $data['page_functions_js'] = 'functions_usuarios.js';
        $this->views->getView($this, 'usuarios', $data);
    }

    public function setUsuario() {

        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtNombre']) || empty($_POST['txtPrimerApellido']) || empty($_POST['txtMail']) || empty($_POST['listRol']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {
                
                $idUsuario = intval($_POST['idUsuario']);
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strPaterno = ucwords(strClean($_POST['txtPrimerApellido']));
                $strMaterno = ucwords(strClean($_POST['txtSegundoApellido']));
                $strMail = strtolower(strClean($_POST['txtMail']));
                $intRolId = intval(strClean($_POST['listRol']));
                $intStatus = intval(strClean($_POST['listStatus']));

                $foto        = $_FILES['foto'];
                $nombre_foto = $foto['name'];
                $type        = $foto['type'];
                $url_temp    = $foto['tmp_name'];
                $imgPortada  = 'default.jpg';

                if($nombre_foto != '' && $type == 'image/jpeg') {
                    $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }

                if($nombre_foto != '' && $type == 'image/png') {
                    $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.png';
                }

                $validarMail = is_valid_email($_POST['txtMail']);

                if($validarMail === true) {

                    $request_user = '';
                    if($idUsuario == 0) {
                        
                        if($getPermisos['permisosMod']['w']) {
                            // Crea usuario
                            $option = 1;
                            $strPassword = empty($_POST['txtPassword']) ? passGenerator() : $_POST['txtPassword'];
                            $strPasswordEncript = hash('SHA256', $strPassword);
                            $request_user = $this->model->insertUsuario($intRolId,
                                                                        $strNombre,
                                                                        $strPaterno,
                                                                        $strMaterno,
                                                                        $strMail,
                                                                        $strPasswordEncript,
                                                                        $imgPortada,
                                                                        $intStatus);
                        }
                    } else {
                        
                        if($getPermisos['permisosMod']['u']) {
                            // Actualiza usuario
                            $option = 2;
                            $strPassword = empty($_POST['txtPassword']) ? '' : hash('SHA256', $_POST['txtPassword']);
                            if ($nombre_foto == '') {
                                if ($_POST['foto_actual'] != 'default.jpg' && $_POST['foto_remove'] == 0) {
                                    $imgPortada = $_POST['foto_actual'];
                                }
                            }

                            $request_user = $this->model->updateUsuario($idUsuario,
                                                                        $intRolId,
                                                                        $strNombre,
                                                                        $strPaterno,
                                                                        $strMaterno,
                                                                        $strMail,
                                                                        $strPassword,
                                                                        $imgPortada,
                                                                        $intStatus);
                        }
                    }

                    if($request_user > 0) {

                        if ($option == 1) {
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente. Se envio un mail con sus datos, si no vizualiza el correo en su bandeja de entrada, por favor revise su carpeta SPAM.');
                            $nombreUsuario = $strNombre.' '.$strPaterno.' '.$strMaterno;
                            $dataUsuario = array('nombreUsuario' => $nombreUsuario,
                                                 'email' => $strMail,
                                                 'password' => $strPassword,
                                                 'asunto' => 'Bienvenid@ '.$nombreUsuario);
                            sendEmail($dataUsuario, 'assign_pass_mail');

                            if($nombre_foto != '') { uploadImage($foto, $imgPortada); }
                        } else {
                            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                            if($nombre_foto != '') { uploadImage($foto, $imgPortada); }

                            // Eliminar foto actual
                            if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'default.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'default.jpg')) {
                                deleteFileUsers($_POST['foto_actual']);
                            }
                        }

                    } else if($request_user == 'exist') {
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos');
                    }

                } else {
                    $arrResponse = array('status' => false, 'msg' => 'El correo: '.$_POST['txtMail'].' no es valido!');
                }

            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getUsuarios() {
        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {
            $arrData = $this->model->selectUsuarios($valores['data']->iduser);
    
            for ($i=0; $i < count($arrData); $i++) {
    
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
    
                if($arrData[$i]['statususer'] == 1) {
                    $arrData[$i]['statususer'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statususer'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }
    
                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['iduser'].')" title="Ver usuario"><i class="bi bi-eye-fill"></i></button>';
                }
    
                if($getPermisos['permisosMod']['u']) {
                    if(($valores['data']->iduser == 1 and $valores['data']->idrol == 1) || ($valores['data']->idrol == 1 and $arrData[$i]['idrol'] != 1)) {
    
                        $btnEdit = '<button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['iduser'].')" title="Editar usuario"><i class="bi bi-pencil-square"></i></button>';
    
                    } else {
                        $btnEdit = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';
                    }
                }
    
                if($getPermisos['permisosMod']['d']) {
                    if(($valores['data']->iduser == 1 && $valores['data']->idrol == 1) || ($valores['data']->idrol == 1 && $arrData[$i]['idrol'] != 1) and ($valores['data']->iduser != $arrData[$i]['iduser'])) {
    
                        $btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['iduser'].')" title="Eliminar usuario"><i class="bi bi-trash-fill"></i></button>';
    
                    } else {
    
                        $btnDelete = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-trash-alt"></i></button>';
    
                    }
    
                }
    
                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getUsuario($idusuario) {
        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {
            $iduser = intval($idusuario);
            if ($iduser > 0) {
                $arrData = $this->model->selectUsuario($iduser);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['imguser'] == 'default.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['imguser'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/usuarios/'.$arrData['imguser'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delUsuario() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;
            if($getPermisos['permisosMod']['d']) {
                $intIdusuario = intval($_POST['iduser']);
                $requestDelete = $this->model->deleteUsuario($intIdusuario);
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function perfil() {

        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        $data['page_tag'] = 'Perfil';
        $data['page_title'] = 'Perfil de Usuario';
        $data['page_name'] = 'perfil';
        $data['page_functions_js'] = 'functions_usuarios.js';

        $data['iduser'] = $valores['data']->iduser;
        $data['nombre'] = $valores['data']->nombre;
        $data['primerApellido'] = $valores['data']->primerapellido;
        $data['segundoApellido'] = $valores['data']->segundoapellido;
        $data['rol'] = $valores['data']->nombrerol;
        $data['nameuser'] = $valores['data']->nameuser;
        $data['imagen'] = $valores['data']->imguser;

        $data['permisos'] = $getPermisos['permisos'];
        $data['permisosMod'] = $getPermisos['permisosMod'];

        $this->views->getView($this, 'perfil', $data);

    }

    public function putPerfil() {

        if ($_POST) {
            if(empty($_POST['txtNombre']) || empty($_POST['txtPrimerApellido'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');
            } else {

                $valores = $this->validarTk;

                $idUsuario = $valores['data']->iduser;
                $strNombre = strClean($_POST['txtNombre']);
                $strPaterno = strClean($_POST['txtPrimerApellido']);
                $strMaterno = strClean($_POST['txtSegundoApellido']);

                $foto        = $_FILES['foto'];
                $nombre_foto = $foto['name'];
                $type        = $foto['type'];
                $url_temp    = $foto['tmp_name'];
                $imgPortada  = 'default.jpg';

                if($nombre_foto != '') {
                    $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }

                if ($nombre_foto == '') {
                    if ($_POST['foto_actual'] != 'default.jpg' && $_POST['foto_remove'] == 0) {
                        $imgPortada = $_POST['foto_actual'];
                    }
                }
                
                $strPassword = '';
                if(!empty($_POST['txtPassword'])) {
                    $strPassword = hash('SHA256', $_POST['txtPassword']);
                }

                $request_user = $this->model->updatePerfil($idUsuario, $strNombre, $strPaterno, $strMaterno, $strPassword, $imgPortada);

                if($request_user) {
                    sessionUser($idUsuario);
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                    if($nombre_foto != '') { uploadImage($foto, $imgPortada); }

                    // Eliminar foto actual
                    if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'default.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'default.jpg')) {
                        deleteFileUsers($_POST['foto_actual']);
                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getPerfil($idusuario) {
        $iduser = intval($idusuario);
        if ($iduser > 0) {
            $arrData = $this->model->selectUsuario($iduser);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrData['url_portada'] = media().'images/uploads/usuarios/'.$arrData['imguser'];
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

}