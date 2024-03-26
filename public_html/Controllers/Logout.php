<?php

class logout {

    public function __construct() {
        
        session_name('zl-abkclss');
        session_id();
        session_start();
        session_regenerate_id();

        if(isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $validarTk = validarToken($token);
    
            if ($validarTk == 'Token invalido') {
                $id_user = $_SESSION['id'];
                $id_sesion = '';
                setIdSesion($id_user, $id_sesion);
            } else {
                $valores = $validarTk;
                $id_user = $valores['data']->iduser;
                $id_sesion = '';
                setIdSesion($id_user, $id_sesion);
            }
        } else {
            session_unset();
            session_destroy();
            setcookie('_xssid-zl', '', time() - 1, '/');
            setcookie('PHPSESSID', '', time() - 1, '/');
            setcookie('_xssid-zl', '', time() - 1, '/');
            
            header('location: '.base_url().'login');
            die();
        }
        
		session_unset();
		session_destroy();
        setcookie('_xssid-zl', '', time() - 1, '/');
        setcookie('PHPSESSID', '', time() - 1, '/');
        setcookie('_xssid-zl', '', time() - 1, '/');
        
        header('location: '.base_url().'login');
        die();
        
    }

}