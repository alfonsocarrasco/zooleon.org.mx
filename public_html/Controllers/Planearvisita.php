<?php

require_once('Models/TPlaneavisita.php');

class Planearvisita extends Controllers {

    use TPlaneavisita;

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
            $this->getPermisos = getPermisos(28, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function planearvisita() {

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

        $data['page_tag']          = 'planearvisita';
        $data['page_title']        = 'Planea tu Visita';
        $data['page_name']         = 'planearvisita';
        $data['estados']           = $this->loadEstados();
        $data['page_functions_js'] = 'functions_planearvisita.js';
        $this->views->getView($this, 'planearvisita', $data);
    }

    public function setData() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if(count($_POST) > 4) {

                if (empty($_POST['txtEvento']) || empty($_POST['txtNombre']) || empty($_POST['txtEstado']) || empty($_POST['txtMunicipio']) || empty($_POST['txtTelefono']) || empty($_POST['txtCelular']) || empty($_POST['txtEmail']) || empty($_POST['txtNumPersonas']) || empty($_POST['txtFechaHr']) || empty($_POST['txtAsunto']) || empty($_POST['txtMensaje']) || empty($_POST['listMedio']) || empty($_POST['listStatus'])) {
                    $arrResponse = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');
                } else {
                    
                    $intId       = intval($_POST['idplanea']);
                    $evento 	 = strClean(intval($_POST['txtEvento']));
                    $nombre 	 = ucwords(strtolower(strClean($_POST['txtNombre'])));
                    $nombreEmpr  = ucwords(strtolower(strClean($_POST['txtEmpresa'])));
                    $estado 	 = strClean(intval($_POST['txtEstado']));
                    $municipio 	 = strClean(intval($_POST['txtMunicipio']));
                    $tel 	     = ucwords(strtolower(strClean($_POST['txtTelefono'])));
                    $cel 	     = ucwords(strtolower(strClean($_POST['txtCelular'])));
                    $email 		 = strtolower(strClean($_POST['txtEmail']));
                    $npersonas   = strtolower(strClean($_POST['txtNumPersonas']));
                    $fechaHr     = strtolower(strClean($_POST['txtFechaHr']));
                    $asunto 	 = strClean($_POST['txtAsunto']);
                    $mensaje  	 = strClean($_POST['txtMensaje']);
                    $medio       = intval($_POST['listMedio']);
                    $intStatus   = intval($_POST['listStatus']);
    
                    if ($intId == 0) {
                        if ($getPermisos['permisosMod']['r']) {
                            // Medio contacto telefónico
                            $request = $this->model->insertData($evento, $nombre, $nombreEmpr, $estado, $municipio, $tel, $cel, $email, $npersonas, $fechaHr, $asunto, $mensaje, $medio, $intStatus);
                        }
                    }
    
                    if ($request > 0) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                    }
                    
                }
            } else {

                if (empty($_POST['txtFechaHr']) || empty($_POST['listStatus'])) {
                    $arrResponse = array('status' => false, 'msg' => 'Todos los campos son obligatorios.');
                } else {

                    $intId     = intval($_POST['idplanea']);
                    $fechaHr   = strtolower(strClean($_POST['txtFechaHr']));
                    $medio     = intval($_POST['listMedio']);
                    $intStatus = intval($_POST['listStatus']);

                    if ($getPermisos['permisosMod']['u']) {
                        $request = $this->model->updateData($intId, $fechaHr, $medio, $intStatus);
                    }
                    
                    if ($request > 0) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                    } else {
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                    }

                }

            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);            
        }
        die();
    }

    public function getEventsDate() {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $arrData = $this->model->selectEventsDate();
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getMensajes() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            $arrData = $this->model->selectMensajes();
            for ($i=0; $i < count($arrData) ; $i++) { 

                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                if($getPermisos['permisosMod']['r']){
                    $btnView = '<button class="btn btn-dark btn-sm" onClick="fntViewInfo('.$arrData[$i]['idplanea'].')" title="Ver mensaje"><i class="bi bi-eye-fill"></i></button>';
                }
                if($getPermisos['permisosMod']['u']){
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo('.$arrData[$i]['idplanea'].')" title="Editar Mensaje"><i class="bi bi-pencil-square"></i></button>';
                }
                if ($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idplanea'].')" title="Eliminar mensaje"><i class="bi bi-trash-fill"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getMensaje($id){

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){
            $id = intval($id);
            if($id > 0){
                $arrData = $this->model->selectMensaje($id);
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delMessage() {
        if($_POST) {
            
            $getPermisos = $this->getPermisos;

            if($getPermisos['permisosMod']['d']) {

                $intIdMensaje = intval($_POST['id']);
                $requestDelete = $this->model->deleteMsg($intIdMensaje);

                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el mensaje.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el mensaje.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
    
}