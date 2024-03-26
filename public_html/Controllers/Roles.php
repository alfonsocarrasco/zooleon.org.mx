<?php

class Roles extends Controllers {

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
            $this->getPermisos = getPermisos(3, $idRol); // Extrae los permisos del modulo actual
        }

    }

    public function Roles() {

        if(isset($_SESSION['token'])) {
            $valores = $this->validarTk;
            $getPermisos = $this->getPermisos;
    
            $data['nombre'] = $valores['data']->nombre;
            $data['primerApellido'] = $valores['data']->primerapellido;
            $data['rol'] = $valores['data']->nombrerol;
            $data['imagen'] = $valores['data']->imguser;
    
            $data['permisos'] = $getPermisos['permisos'];
            $data['permisosMod'] = $getPermisos['permisosMod'];
    
            $data['permisos'] = $getPermisos['permisos'];
            $data['permisosMod'] = $getPermisos['permisosMod'];
        }

        if (empty($data['permisosMod']['r'])) {
            header('Location: '.base_url().'dashboard');
        }

        $data['page_id'] = 3;
        $data['page_tag'] = 'Roles de Usuario';
        $data['page_name'] = 'Roles de Usuario';
        $data['page_title'] = 'Roles de Usuario';
        $data['page_functions_js'] = 'functions_roles.js';
        $this->views->getView($this, 'roles', $data);
    }

    public function getRoles() {
        
        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectRoles($valores['data']->iduser);
            
            for ($i=0; $i < count($arrData); $i++) { 
                if($arrData[$i]['statusrol'] == 1) {
                    $arrData[$i]['statusrol'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['statusrol'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }
                
                if($getPermisos['permisosMod']['u']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['idrol'].')" title="Permisos"><i class="bi bi-key-fill"></i></button>';
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['idrol'].')" title="Editar"><i class="bi bi-pencil-square"></i></button>';
                }
    
                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['idrol'].')" title="Eliminar"><i class="bi bi-trash-fill"></i></button>';
                }
    
                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getSelectRoles() {

        $htmlOptions = '';
        $valores = $this->validarTk;

        $arrData = $this->model->selectRoles($valores['data']->iduser); 
        if(count($arrData) > 0) {
            $htmlOptions .= '<option value="" selected>Seleccionar Rol</option>';
            for ($i=0; $i < count($arrData); $i++) {
                if ($arrData[$i]['statusrol'] == 1) {
                    $htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }

    public function getRol(int $idrol) {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {

            $intIdrol = intval(strClean($idrol));
            if ($intIdrol > 0) {
                $arrData = $this->model->selectRol($intIdrol);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
    }

    public function setRol() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['w']) {

            $intIdrol = intval($_POST['idRol']);
            $strRol = strClean($_POST['txtRol']);
            $strDescripcion = strClean($_POST['txtDescripcion']);
            $intStatus = intval($_POST['listStatus']);
    
            if($intIdrol == 0) {
                // Crear Rol
                $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
                $option = 1;
            } else {
                // Actualizar
                $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
                $option = 2;
            }
    
            if ($request_rol > 0) {
                if($option == 1) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                } else {
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }
            } else if($request_rol == 'exist') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El rol ya existe.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);

        }
        die();
    }

    public function delRol() {
        if($_POST) {

            $getPermisos = $this->getPermisos;

            if($getPermisos['permisosMod']['r']) {
                $intIdrol = intval($_POST['idrol']);
                $requestDelete = $this->model->deleteRol($intIdrol);
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el rol.');
                } else if ($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un rol asociado a un usuario.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el rol.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}