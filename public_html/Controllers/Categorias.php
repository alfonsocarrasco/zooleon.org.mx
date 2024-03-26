<?php

class Categorias extends Controllers {

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
            $this->getPermisos = getPermisos(4, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function Categorias() {

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

        $data['page_tag'] = 'Categorias';
        $data['page_title'] = 'Categorias';
        $data['page_name'] = 'categorias';
        $data['page_functions_js'] = 'functions_categorias.js';
        $this->views->getView($this, 'categorias', $data);
    }

    public function setCategoria(){
        if($_POST){

            $getPermisos = $this->getPermisos;

            if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                
                $intIdcategoria = intval($_POST['idCategoria']);
                $strCategoria =  strClean($_POST['txtNombre']);
                $strDescipcion = strClean($_POST['txtDescripcion']);
                $intStatus = intval($_POST['listStatus']);

                $ruta = strtolower(clear_cadena($strCategoria));
                $ruta = str_replace(' ', '-', $ruta);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['name'];
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';
                $request_categoria = '';

                if($nombre_foto != '') {
                    $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';
                }

                if($intIdcategoria == 0) {
                    //Crear
                    if($getPermisos['permisosMod']['w']) {
                        $request_categoria = $this->model->inserCategoria($strCategoria, $strDescipcion, $imgPortada, $ruta, $intStatus);
                        $option = 1;
                    }
                } else {
                    //Actualizar
                    if ($getPermisos['permisosMod']['u']) {
                        if($nombre_foto == '') {
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }
                        $request_categoria = $this->model->updateCategoria($intIdcategoria, $strCategoria, $strDescipcion, $imgPortada, $ruta, $intStatus);
                        $option = 2;
                    }
                }
                if ($request_categoria > 0 ) {
                    if($option == 1) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageCat($foto, $imgPortada); }
                    } else {
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                        if($nombre_foto != '') { uploadImageCat($foto, $imgPortada); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg')
                            || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileCategoria($_POST['foto_actual']);
                        }
                    }
                } else if ($request_categoria == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! La categoría ya existe.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCategorias() {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {
            $arrData = $this->model->selectCategorias();
            for ($i=0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                if ($arrData[$i]['status_categoria'] == 1) {
                    $arrData[$i]['status_categoria'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['status_categoria'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if ($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm" onClick="fntViewInfo('.$arrData[$i]['idcategoria'].')" title="Ver categoría"><i class="bi bi-eye-fill"></i></button>';
                }
                if ($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo('.$arrData[$i]['idcategoria'].')" title="Editar categoría"><i class="bi bi-pencil-square"></i></button>';
                }
                if ($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idcategoria'].')" title="Eliminar categoría"><i class="bi bi-trash-fill"></i></button>';
                }
                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCategoria($idcategoria) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {
            $intIdcategoria = intval($idcategoria);
            if ($intIdcategoria > 0) {
                $arrData = $this->model->selectCategoria($intIdcategoria);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['portada_categoria'] == 'portada_categoria.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['portada_categoria'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/categorias/'.$arrData['portada_categoria'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function delCategoria() {
        if($_POST) {
            
            $getPermisos = $this->getPermisos;

            if($getPermisos['permisosMod']['d']) {
                $intIdcategoria = intval($_POST['idCategoria']);
                $requestDelete = $this->model->deleteCategoria($intIdcategoria);
                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
                } else if($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function getSelectCategorias() {
        $htmlOptions = "";
        $arrData = $this->model->selectCategorias();
        if (count($arrData) > 0 ) {
            $htmlOptions .= '<option value="" selected>Seleccionar categoría</option>';
            for ($i=0; $i < count($arrData); $i++) {
                if ($arrData[$i]['status_categoria'] == 1 ) {
                    $htmlOptions .= '<option value="'.$arrData[$i]['idcategoria'].'">'.$arrData[$i]['nombre_categoria'].'</option>';
                }
            }
        }
        echo $htmlOptions;
        die();
    }

}