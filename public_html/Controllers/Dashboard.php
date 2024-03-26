<?php

class Dashboard extends Controllers {

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
            $this->getPermisos = getPermisos(1, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function dashboard() {

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

        $data['page_id'] = 2;
        $data['page_tag'] = 'Dashboard';
        $data['page_title'] = 'Dashboard - Panel de Control Zooleón';
        $data['page_name'] = 'dashboard';
        $data['page_functions_js'] = 'functions_dashboard.js';
        
        $data['usuarios'] = $this->model->cantUsuarios();
        $data['categorias'] = $this->model->cantCategorias();
        $data['especies'] = $this->model->cantEspecies();
        $data['noticias'] = $this->model->cantNoticias();
        $data['paquetes'] = $this->model->cantPaquetes();
        $data['lastMsg']  = $this->model->lastMessage();
        $this->views->getView($this, 'dashboard', $data);

    }

}