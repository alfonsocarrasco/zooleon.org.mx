<?php

class Errors extends Controllers {
    
    public $validarTk;
    public $getPermisos;

    public function __construct() {
        parent::__construct();
        
        session_name('zl-abkclss');
        session_id();
        session_start();
        session_regenerate_id();
        // validarSesion();

        if(isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $this->validarTk = validarToken($token);
            $valores = $this->validarTk;
            $idRol = $valores['data']->idrol;
            $this->getPermisos = getPermisos(8, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function notFound() {

        if (isset($_SESSION['token'])) {
            $valores = $this->validarTk;
            $getPermisos = $this->getPermisos;
    
            $data['nombre'] = $valores['data']->nombre;
            $data['primerApellido'] = $valores['data']->primerapellido;
            $data['rol'] = $valores['data']->nombrerol;
            $data['imagen'] = $valores['data']->imguser;
    
            $data['permisos'] = $getPermisos['permisos'];
            $data['permisosMod'] = $getPermisos['permisosMod'];
        }

        $data['page_tag'] = 'Error 404';
        $data['page_title'] = 'Error 404 - Página no encontrada';
        $data['page_name'] = 'error';
        $this->views->getView($this, 'error', $data);
        
    }
}

$notFound = new Errors();
$notFound->notFound();