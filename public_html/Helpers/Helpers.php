<?php

require_once 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function base_url() {
    return BASE_URL;
}

function media() {
    return BASE_URL.'Assets/';
}

function headerAdmin($data='') {
    $view_header = 'Views/Template/header_admin.php';
    require_once($view_header);
}

function footerAdmin($data='') {
    $view_footer = 'Views/Template/footer_admin.php';
    require_once($view_footer);
}

function headerSite($data='') {
    $view_header = 'Views/Template/header_site.php';
    require_once($view_header);
}

function footerSite($data='') {
    $view_footer = 'Views/Template/footer_site.php';
    require_once($view_footer);
}

function getModal(string $nameModal, $data) {
    $view_modal = "Views/Template/Modals/{$nameModal}.php";
    require_once $view_modal;
}

function dep($data) {
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    return $format;
}

// Generar Llave
$key = 'tVp%tkLv1SUW4M#IW7a54dwTns#ThfJW';
$frase = hash('SHA256', $key);

// Generar Token
function generarToken(array $data) {
    
    $payload = array(
        'iat' => time(),
        'exp' => time() + 3600, //+1 hora
        'data' => $data
    );
    
    $jwt = JWT::encode($payload, $GLOBALS['frase'], 'HS256');
    return $jwt;
}

// Validar Token
function validarToken($token) {
    try {
        $decoded = JWT::decode($token, new Key($GLOBALS['frase'], 'HS256'));
        $decoded_array = (array) $decoded;
        return $decoded_array;
    } catch (Exception $error) {
        $error = 'Token invalido';
        return $error;
    }

}

// Validar Session
function validarSesion() {

    if((!isset($_COOKIE['_xssid-zl']) && !isset($_SESSION['token'])) || (isset($_COOKIE['_xssid-zl']) && !isset($_SESSION['token']))) {
        header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Location: '.base_url().'home');
    }

    if(isset($_COOKIE['_xssid-zl']) != isset($_SESSION['id'])) {
        header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Location: '.base_url().'logout');
    }
    
    if(isset($_SESSION['token'])) {
        $token = $_SESSION['token'];
        $validarTk = validarToken($token);
        
        if(!isset($_COOKIE['_xssid-zl']) && $validarTk == 'Token invalido') {
            header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Location: '.base_url().'logout');
        }
    }
}

function mantenimiento() {
    require_once('Libraries/Core/Mysql.php');
    $con = new Mysql();
    $sql = "SELECT statusinfogral FROM page_infogral";
    $request = $con->select($sql);
    if ($request['statusinfogral'] == 2) {
        header('Location: '.base_url());
    }
}

function is_valid_email($str) {
    $matches = null;

    if(1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches)) {
        $result = (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
        
        if ($result) {
            list($user, $domain) = explode('@', $str);
            $result = checkdnsrr($domain, 'MX');
        }
        return $result;
    }

}

function getPermisos(int $idmodulo, int $idrol) {
    require_once('Models/PermisosModel.php');
    $objPermisos = new PermisosModel();
    $arrPermisos = $objPermisos->permisosModulo($idrol);
    $permisos = '';
    $permisosMod = '';

    if (count($arrPermisos) > 0) {
        $permisos = $arrPermisos;
        $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : '';
    }

    $dataPermisos = array('permisos' => $permisos, 'permisosMod' => $permisosMod);
    return $dataPermisos;
}

function setIdSesion(int $id_user, string $id_sesion) {
    require_once('Models/LoginModel.php');
    $objSesion = new LoginModel();
    $sesionId = $objSesion->setSesionID($id_user, $id_sesion);
    return $sesionId;
}

// Genera Id para la sesión
function getIdSesion(int $id_user) {
    require_once('Models/LoginModel.php');
    $objSesion = new LoginModel();
    $sesionId = $objSesion->getSesionID($id_user);
    return $sesionId;
}

function sessionUser(int $iduser) {
    require_once('Models/LoginModel.php');
    $objLogin = new LoginModel();
    $request = $objLogin->sessionLogin($iduser);
    return $request;
}

function getPatrocinadores() {
    require_once('Libraries/Core/Mysql.php');
    $con = new Mysql();
    $sql = "SELECT idpatrocinador,
                   nombrepatrocinador,
                   imagenpatrocinador,
                   statuspatrocinador
            FROM patrocinadores WHERE statuspatrocinador != 0 AND statuspatrocinador != 2";
    $request = $con->select_all($sql);
    return $request;
}

function getAcreditaciones() {
    require_once('Libraries/Core/Mysql.php');
    $con = new Mysql();
    $sql = "SELECT idacreditacion,
                   nombreacreditacion,
                   imagenacreditacion,
                   statusacreditacion
            FROM acreditaciones WHERE statusacreditacion != 0 AND statusacreditacion != 2";
    $request = $con->select_all($sql);
    return $request;
}

function uploadImage(array $data, string $name) {
    $url_temp = $data['tmp_name'];

    list($ancho, $alto) = getimagesize($url_temp);
    $nuevoAncho = 215;
    $nuevoAlto = 215;

    if($data['type'] == 'image/jpeg') {
        $ruta = 'Assets/images/uploads/usuarios/'.$name;
        $origen = imagecreatefromjpeg($url_temp);
        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, floor($nuevoAncho), floor($nuevoAlto), $ancho, $alto);
        imagejpeg($destino, $ruta);
    } else {
        $ruta = 'Assets/images/uploads/usuarios/'.$name;
        $origen = imagecreatefrompng($url_temp);
        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, floor($nuevoAncho), floor($nuevoAlto), $ancho, $alto);
        imagepng($destino, $ruta);
    }
}

function uploadImageNoticias(array $data, string $name) {
    $url_temp = $data['tmp_name'];
    $ruta = 'Assets/images/uploads/noticias/';
    $file_name = $name;
    $file = $ruta . $file_name;
    move_uploaded_file($url_temp, $file);
}

function uploadEjemplar(array $data, string $name) {

    $url_temp = $data['tmp_name'];
    $ruta = 'Assets/images/uploads/especies/';
    $file_name = $name;
    $file = $ruta . $file_name;
    move_uploaded_file($url_temp, $file);

}

function uploadNacimientos(array $data, string $name) {

    $url_temp = $data['tmp_name'];
    $ruta = 'Assets/images/uploads/nacimientos/';
    $file_name = $name;
    $file = $ruta . $file_name;
    move_uploaded_file($url_temp, $file);

}

// Función Upload Img Galeria
function uploadGaleria(array $data, string $ruta) {

    $path = 'Assets/images/uploads/especies/';
    $all_files = count($data['tmp_name']);
    $ruta = json_decode($ruta);

    for ($i = 0; $i < $all_files; $i++) {

        if ($data['type'][$i] == 'image/png') {

            $file_name = $ruta[$i];
            $file_tmp = $data['tmp_name'][$i];
            $file = $path . $file_name;
            
        } else {

            $file_name = $ruta[$i];
            $file_tmp = $data['tmp_name'][$i];
            $file = $path . $file_name;
        }
        
        move_uploaded_file($file_tmp, $file);

    }

}

// Función Upload Img Galeria
function uploadGaleriaNacimientos(array $data, string $ruta) {

    $path = 'Assets/images/uploads/nacimientos/';
    $all_files = count($data['tmp_name']);
    $ruta = json_decode($ruta);

    for ($i = 0; $i < $all_files; $i++) {

        if ($data['type'][$i] == 'image/png') {

            $file_name = $ruta[$i];
            $file_tmp = $data['tmp_name'][$i];
            $file = $path . $file_name;
            
        } else {

            $file_name = $ruta[$i];
            $file_tmp = $data['tmp_name'][$i];
            $file = $path . $file_name;
        }
        
        move_uploaded_file($file_tmp, $file);

    }

}

function uploadImageCat(array $data, string $name) {
    $url_temp = $data['tmp_name'];

    list($ancho, $alto) = getimagesize($url_temp);
    $nuevoAncho = 570;
    $nuevoAlto = 380;

    if($data['type'] == 'image/jpeg') {
        $ruta = 'Assets/images/uploads/categorias/'.$name;
        $origen = imagecreatefromjpeg($url_temp);
        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, floor($nuevoAncho), floor($nuevoAlto), $ancho, $alto);
        imagejpeg($destino, $ruta);
    } else {
        $ruta = 'Assets/images/uploads/categorias/'.$name;
        $origen = imagecreatefrompng($url_temp);
        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        imagecopyresized($destino, $origen, 0, 0, 0, 0, floor($nuevoAncho), floor($nuevoAlto), $ancho, $alto);
        imagepng($destino, $ruta);
    }
}

function uploadImageGral(array $data, string $name) {
    $url_temp = $data['tmp_name'];
    $ruta = 'Assets/images/uploads/';
    $file_name = $name;
    $file = $ruta . $file_name;
    move_uploaded_file($url_temp, $file);
}

function deleteFileGral(string $name) {
    unlink('Assets/images/uploads/'.$name);
}

function deleteFileUsers(string $name) {
    unlink('Assets/images/uploads/usuarios/'.$name);
}

function deleteFileCategoria(string $name) {
    unlink('Assets/images/uploads/categorias/'.$name);
}

function deleteFileNoticias(string $name) {
    unlink('Assets/images/uploads/noticias/'.$name);
}

function deleteFileEjemplar(string $name) {
    $path = media().'images/uploads/especies/'.$name;

    if (file_exists($path)) {
        unlink('Assets/images/uploads/especies/'.$name);
    }
}

function deleteFileNacimiento(string $name) {
    $path = media().'images/uploads/nacimientos/'.$name;

    if (file_exists($path)) {
        unlink('Assets/images/uploads/nacimientos/'.$name);
    }
}

// Función envio de correo
function sendEmail($data, $template) {
    $asunto = $data['asunto'];
    $emailDestino = $data['email'];
    $empresa = NOMBRE_REMITENTE;
    $remitente = EMAIL_REMITENTE;

    // Envio de correo
    $de = "MIME-Version: 1.0"."\r\n";
    $de .= "Content-type:text/html;charset=UTF-8"."\r\n";
    $de .= "From: {$empresa} <{$remitente}>"."\r\n";
    
    ob_start();
    require_once('Views/Template/Mail/'.$template.'.php');
    $mensaje = ob_get_clean();

    $send = mail($emailDestino, $asunto, $mensaje, $de);
    return $send;
}

//Elimina exceso de espacios entre palabras
function strClean($strCadena){
    $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); // Elimina las \ invertidas
    $string = str_ireplace("<script>","",$string);
    $string = str_ireplace("</script>","",$string);
    $string = str_ireplace("<script src>","",$string);
    $string = str_ireplace("<script type=>","",$string);
    $string = str_ireplace("SELECT * FROM","",$string);
    $string = str_ireplace("DELETE FROM","",$string);
    $string = str_ireplace("INSERT INTO","",$string);
    $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
    $string = str_ireplace("DROP TABLE","",$string);
    $string = str_ireplace("OR '1'='1","",$string);
    $string = str_ireplace('OR "1"="1"',"",$string);
    $string = str_ireplace('OR ´1´=´1´',"",$string);
    $string = str_ireplace("is NULL; --","",$string);
    $string = str_ireplace("is NULL; --","",$string);
    $string = str_ireplace("LIKE '","",$string);
    $string = str_ireplace('LIKE "',"",$string);
    $string = str_ireplace("LIKE ´","",$string);
    $string = str_ireplace("OR 'a'='a","",$string);
    $string = str_ireplace('OR "a"="a',"",$string);
    $string = str_ireplace("OR ´a´=´a","",$string);
    $string = str_ireplace("OR ´a´=´a","",$string);
    $string = str_ireplace("--","",$string);
    $string = str_ireplace("^","",$string);
    $string = str_ireplace("[","",$string);
    $string = str_ireplace("]","",$string);
    $string = str_ireplace("==","",$string);
    return $string;
}
//Genera una contraseña de 10 caracteres
function passGenerator($length = 10)
{
    $pass = "";
    $longitudPass=$length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena=strlen($cadena);

    for($i=1; $i<=$longitudPass; $i++)
    {
        $pos = rand(0,$longitudCadena-1);
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}
//Genera un token
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
    return $token;
}

function clear_cadena(string $cadena) {
    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena);

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena);

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena);

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena);

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena);

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç',',','.',';',':'),
    array('N', 'n', 'C', 'c','','','',''),
    $cadena);
    return $cadena;
}

function getInfoAtracciones(int $idpagina) {
    require_once('Libraries/Core/Mysql.php');
    $con = new Mysql();
    $sql = "SELECT * FROM post WHERE idpost = $idpagina";
    $request = $con->select($sql);
    return $request;
}