<?php

class Informacionpublica extends Controllers {

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
            $this->getPermisos = getPermisos(22, $idRol); // Extrae los permisos del modulo actual
        }
    }

    public function informacionpublica() {
        
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

        $data['page_tag'] = 'info_publica';
        $data['page_title'] = 'Transparencia';
        $data['page_name'] = 'Transparencia';
        $data['page_functions_js'] = 'functions_infopublica.js';
        $this->views->getView($this, 'informacionpublica', $data);

    }

    public function setFormato() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtFormato']) || empty($_POST['txtSubtitulo']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdFormato  = intval($_POST['idFormato']);
                $strTitulo     = strClean($_POST['txtTitulo']);
                $strFormato    = strClean($_POST['txtFormato']);
                $strAnio       = strClean($_POST['txtAnio']);
                $strSubtitulo  = strClean($_POST['txtSubtitulo']);
                $filePDFActual = strClean($_POST['filePDFActual']);
                $fileXLSActual = strClean($_POST['fileXLSActual']);
                $intStatus     = intval($_POST['listStatus']);

                // Datos PDF
                $pdf      = $_FILES['txtFilePDF'];
                $name_pdf = $pdf['name'];
                $type     = $pdf['type'];
                $url_temp = $pdf['tmp_name'];

                // Datos XLS
                $xls          = $_FILES['txtFileXLS'];
                $name_xls     = $xls['name'];
                $type_xls     = $xls['type'];
                $url_temp_xls = $xls['tmp_name'];

                $nombre_pdf = preg_replace('/[\@\.\;\?\¿\!\¡\´\+\{\}\(\)\<\>\¨\*\^\`\" "]+/', '', str_replace(' ', '-', strtolower(clear_cadena($name_pdf))));
                $nombre_xls = preg_replace('/[\@\.\;\?\¿\!\¡\´\+\{\}\(\)\<\>\¨\*\^\`\" "]+/', '', str_replace(' ', '-', strtolower(clear_cadena($name_xls))));

                if($strAnio == '') {
                    $ruta = clear_cadena($strTitulo.'/'.$strFormato);
                    $nameRuta = str_replace(' ', '', strtolower($ruta));
                } else {
                    $ruta = clear_cadena($strTitulo.'/'.$strFormato.'/'.$strAnio);
                    $nameRuta = str_replace(' ', '', strtolower($ruta));
                }

                $request_formato = '';
                if ($intIdFormato == 0) {

                    if ($getPermisos['permisosMod']['w']) {

                        if($nombre_pdf != '') {

                            $file_pdf = $nombre_pdf;
                            $url = basename($file_pdf, 'pdf');
                            $folder = 'Assets/site/transparencia/'.$nameRuta;
        
                            if(file_exists($folder)) {
        
                                $destino_pdf = $folder.'/'.$url.'.pdf';
                                move_uploaded_file($url_temp, $destino_pdf);
        
                            } else {
        
                                mkdir($folder, 0755, true);
                                $destino_pdf = $folder.'/'.$url.'.pdf';
                                move_uploaded_file($url_temp, $destino_pdf);
        
                            }
                            
                        } else {
                            $destino_pdf = '';
                        }
                        if($nombre_xls != '') {

                            if ($type_xls == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'docx');
                                $extension = '.docx';

                            } else if ($type_xls == 'application/msword') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'doc');
                                $extension = '.doc';

                            } else if ($type_xls == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'xlsx');
                                $extension = '.xlsx';

                            } else if ($type_xls == 'application/vnd.ms-excel') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'xls');
                                $extension = '.xls';

                            }

                            $folder_xls = 'Assets/site/transparencia/'.$nameRuta;

                            if(file_exists($folder_xls)) {

                                $destino_xls = $folder_xls.'/'.$url_xls.$extension;
                                move_uploaded_file($url_temp_xls, $destino_xls);

                            } else {

                                mkdir($folder_xls, 0755, true);
                                $destino_xls = $folder_xls.'/'.$url_xls.$extension;
                                move_uploaded_file($url_temp_xls, $destino_xls);

                            }

                        } else {
                            $destino_xls = '';
                        }

                        $request_formato = $this->model->insertFormato($intIdFormato, $strTitulo, $strFormato, $strAnio, $strSubtitulo, $destino_pdf, $destino_xls, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($pdf['error'] == 4 && $xls['error'] == 4) {
                            if ($filePDFActual) {
                                $destino_pdf = $filePDFActual;
                            } else {
                                $destino_pdf = '';
                            }
                            if ($fileXLSActual) {
                                $destino_xls = $fileXLSActual;
                            } else {
                                $destino_xls = '';
                            }
                        } else if ($pdf['error'] == 0 && $xls['error'] == 0) {

                            $file_pdf = $nombre_pdf;
                            $url = basename($file_pdf, 'pdf');
                            $folder = 'Assets/site/transparencia/'.$nameRuta;
        
                            if(file_exists($folder)) {
                                $destino_pdf = $folder.'/'.$url.'.pdf';
                                move_uploaded_file($url_temp, $destino_pdf);
                            } else {
                                mkdir($folder, 0755, true);
                                $destino_pdf = $folder.'/'.$url.'.pdf';
                                move_uploaded_file($url_temp, $destino_pdf);
                            }

                            if ($type_xls == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'docx');
                                $extension = '.docx';

                            } else if ($type_xls == 'application/msword') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'doc');
                                $extension = '.doc';

                            } else if ($type_xls == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'xlsx');
                                $extension = '.xlsx';

                            } else if ($type_xls == 'application/vnd.ms-excel') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'xls');
                                $extension = '.xls';

                            }

                            $folder_xls = 'Assets/site/transparencia/'.$nameRuta;

                            if(file_exists($folder_xls)) {
                                $destino_xls = $folder_xls.'/'.$url_xls.$extension;
                                move_uploaded_file($url_temp_xls, $destino_xls);

                            } else {

                                mkdir($folder_xls, 0755, true);
                                $destino_xls = $folder_xls.'/'.$url_xls.$extension;
                                move_uploaded_file($url_temp_xls, $destino_xls);

                            }
    
                        } else if ($pdf['error'] == 0 && $xls['error'] == 4) {

                            $file_pdf = $nombre_pdf;
                            $url = basename($file_pdf, 'pdf');
                            $folder = 'Assets/site/transparencia/'.$nameRuta;
        
                            if(file_exists($folder)) {
        
                                $destino_pdf = $folder.'/'.$url.'.pdf';
                                move_uploaded_file($url_temp, $destino_pdf);
        
                            } else {
        
                                mkdir($folder, 0755, true);
                                $destino_pdf = $folder.'/'.$url.'.pdf';
                                move_uploaded_file($url_temp, $destino_pdf);
        
                            }
                            $destino_xls = $fileXLSActual;

                        } else if ($xls['error'] == 0 && $pdf['error'] == 4) {

                            if ($type_xls == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'docx');
                                $extension = '.docx';

                            } else if ($type_xls == 'application/msword') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'doc');
                                $extension = '.doc';

                            } else if ($type_xls == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'xlsx');
                                $extension = '.xlsx';

                            } else if ($type_xls == 'application/vnd.ms-excel') {

                                $file_xls = $nombre_xls;
                                $url_xls = basename($file_xls, 'xls');
                                $extension = '.xls';

                            }

                            $folder_xls = 'Assets/site/transparencia/'.$nameRuta;

                            if(file_exists($folder_xls)) {
                                $destino_xls = $folder_xls.'/'.$url_xls.$extension;
                                move_uploaded_file($url_temp_xls, $destino_xls);

                            } else {

                                mkdir($folder_xls, 0755, true);
                                $destino_xls = $folder_xls.'/'.$url_xls.$extension;
                                move_uploaded_file($url_temp_xls, $destino_xls);

                            }
                            $destino_pdf = $filePDFActual;

                        }

                        $request_formato = $this->model->insertFormato($intIdFormato, $strTitulo, $strFormato, $strAnio, $strSubtitulo, $destino_pdf, $destino_xls, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_formato > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
                
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);            
        }
        die();

    }

    public function getFormatos() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectFormatos();
            
            for ($i=0; $i < count($arrData); $i++) {

                if($arrData[$i]['fileXLS'] != '') {
                    $arrData[$i]['fileXLS'] = '<a href="'.base_url().$arrData[$i]['fileXLS'].'"><i class="fas fa-download"></i></a>';
                } else {
                    $arrData[$i]['fileXLS'] = 'N/A';
                }

                if($arrData[$i]['filePDF'] != '') {
                    $arrData[$i]['filePDF'] = '<a href="'.base_url().$arrData[$i]['filePDF'].'"><i class="fas fa-download"></i></a>';
                } else {
                    $arrData[$i]['filePDF'] = 'N/A';
                }

                if($arrData[$i]['status'] == 1) {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewFormato" onClick="fntViewFormato('.$arrData[$i]['id'].')" title="Ver Formato"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditFormato" onClick="fntEditFormato('.$arrData[$i]['id'].')" title="Editar Formato"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelFormato" onClick="fntDelFormato('.$arrData[$i]['id'].')" title="Eliminar Formato"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getFormato($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdFormato = intval($id);

            if ($intIdFormato != 0) {

                $arrData = $this->model->selectFormato($intIdFormato);

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

    public function delFormato() {
        if($_POST) {
            
            $getPermisos = $this->getPermisos;

            if($getPermisos['permisosMod']['d']) {

                $intIdAtraccion = intval($_POST['id']);

                $requestDelete = $this->model->deleteFormato($intIdAtraccion);

                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el formato.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el formato.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function pagetransparencia() {

        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        $data['page_tag'] = 'page_atracciones';
        $data['page_title'] = 'Página Atracciones';
        $data['page_name'] = 'Página Atracciones';
        $data['page_functions_js'] = 'functions_pagetransparencia.js';

        $data['iduser'] = $valores['data']->iduser;
        $data['nombre'] = $valores['data']->nombre;
        $data['primerApellido'] = $valores['data']->primerapellido;
        $data['segundoApellido'] = $valores['data']->segundoapellido;
        $data['rol'] = $valores['data']->nombrerol;
        $data['nameuser'] = $valores['data']->nameuser;
        $data['imagen'] = $valores['data']->imguser;

        $data['permisos'] = $getPermisos['permisos'];
        $data['permisosMod'] = $getPermisos['permisosMod'];

        $this->views->getView($this, 'pagetransparencia', $data);

    }

    public function setData() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtTitulo']) || empty($_POST['txtNameEspecie']) || empty($_POST['txtNameScien']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdPageTransparencia = intval($_POST['idpagetransparencia']);
                $strTitulo              = strClean($_POST['txtTitulo']);
                $strNameEspecie         = strClean($_POST['txtNameEspecie']);
                $strnameScientific      = strClean($_POST['txtNameScien']);
                $intStatus              = intval($_POST['listStatus']);

                $foto   	 = $_FILES['foto'];
                $nombre_foto = $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto = str_replace(' ', '-', $nombre_foto);
                $type 		 = $foto['type'];
                $url_temp    = $foto['tmp_name'];
                $imgPortada  = 'portada_categoria.jpg';

                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_transparencia.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_transparencia.png'; }

                $foto_parallax        = $_FILES['foto2'];
                $nombre_foto_parallax = $foto_parallax['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto_parallax['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto_parallax['name'], 'png')));
                $nombre_foto_parallax = str_replace(' ', '-', $nombre_foto_parallax);
                $type_parallax        = $foto_parallax['type'];
                $url_temp_parallax    = $foto_parallax['tmp_name'];
                $imgPortada_parallax  = 'portada_categoria.jpg';

                if ($nombre_foto_parallax != '' && $type_parallax == 'image/jpeg') { $imgPortada_parallax = $nombre_foto_parallax.'_transparencia.jpg'; }
                if ($nombre_foto_parallax != '' && $type_parallax == 'image/png') { $imgPortada_parallax = $nombre_foto_parallax.'_transparencia.png'; }

                $request_privacidad     = '';

                if ($intIdPageTransparencia == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_privacidad = $this->model->insertData($intIdPageTransparencia, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        if($nombre_foto_parallax == '') {
                            if($_POST['foto_actual_parallax'] != 'portada_categoria.jpg' && $_POST['foto_remove_parallax'] == 0 ) {
                                $imgPortada_parallax = $_POST['foto_actual_parallax'];
                            }
                        }

                        $request_privacidad = $this->model->insertData($intIdPageTransparencia, $strTitulo, $strNameEspecie, $strnameScientific, $imgPortada, $imgPortada_parallax, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_privacidad > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_parallax != '') { uploadImageGral($foto_parallax, $imgPortada_parallax); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }
                        if($nombre_foto_parallax != '') { uploadImageGral($foto_parallax, $imgPortada_parallax); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                        if(($nombre_foto_parallax == '' && $_POST['foto_remove_parallax'] == 1 && $_POST['foto_actual_parallax'] != 'portada_categoria.jpg') || ($nombre_foto_parallax != '' && $_POST['foto_actual_parallax'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual_parallax']);
                        }

                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
                
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);            
        }
        die();
    }

    public function getData($id = null) {
        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']) {
            
            $arrData = $this->model->selectData($id);
            
            if(empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {

                if ($arrData['portada_pagetransparencia'] == 'portada_categoria.jpg') {
                    $arrData['portada_url'] = media().'images/'.$arrData['portada_pagetransparencia'];
                } else {
                    $arrData['portada_url'] = media().'images/uploads/'.$arrData['portada_pagetransparencia'];
                }

                if ($arrData['parallax_pagetransparencia'] == 'portada_categoria.jpg') {
                    $arrData['portada_url_parallax'] = media().'images/'.$arrData['parallax_pagetransparencia'];
                } else {
                    $arrData['portada_url_parallax'] = media().'images/uploads/'.$arrData['parallax_pagetransparencia'];
                }

                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function Responsables() {

        $valores = $this->validarTk;
        $getPermisos = $this->getPermisos;

        $data['page_tag'] = 'responsables';
        $data['page_title'] = 'Responsables de la Información';
        $data['page_name'] = 'Responsables de la Información';
        $data['page_functions_js'] = 'functions_responsables.js';

        $data['iduser'] = $valores['data']->iduser;
        $data['nombre'] = $valores['data']->nombre;
        $data['primerApellido'] = $valores['data']->primerapellido;
        $data['segundoApellido'] = $valores['data']->segundoapellido;
        $data['rol'] = $valores['data']->nombrerol;
        $data['nameuser'] = $valores['data']->nameuser;
        $data['imagen'] = $valores['data']->imguser;

        $data['permisos'] = $getPermisos['permisos'];
        $data['permisosMod'] = $getPermisos['permisosMod'];

        $this->views->getView($this, 'responsables', $data);

    }

    public function setResponsables() {
        if ($_POST) {
            $getPermisos = $this->getPermisos;

            if (empty($_POST['txtNombre']) || empty($_POST['listStatus'])) {
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos');
            } else {
                
                $intIdAcreditacion   = intval($_POST['idResponsable']);
                $strNameAcreditacion = strClean($_POST['txtNombre']);
                $strLink             = strClean($_POST['txtLink']);
                $intStatus           = intval($_POST['listStatus']);

                $foto   	 	= $_FILES['foto'];
                $nombre_foto 	= $foto['type'] == 'image/jpeg' ? strtolower(clear_cadena(basename($foto['name'], 'jpg'))) : strtolower(clear_cadena(basename($foto['name'], 'png')));
                $nombre_foto    = str_replace(' ', '-', $nombre_foto);
                $type 		 	= $foto['type'];
                $url_temp    	= $foto['tmp_name'];
                $imgPortada 	= 'portada_categoria.jpg';

                
                if ($nombre_foto != '' && $type == 'image/jpeg') { $imgPortada = $nombre_foto.'_responsable.jpg'; }
                if ($nombre_foto != '' && $type == 'image/png') { $imgPortada = $nombre_foto.'_responsable.png'; }

                $request_acreditacion = '';
                if ($intIdAcreditacion == 0) {

                    if ($getPermisos['permisosMod']['w']) {
                        $request_acreditacion = $this->model->insertResponsables($intIdAcreditacion, $strNameAcreditacion, $strLink, $imgPortada, $intStatus);
                        $option = 1;
                    }

                } else {

                    if ($getPermisos['permisosMod']['u']) {

                        if($nombre_foto == ''){
                            if($_POST['foto_actual'] != 'portada_categoria.jpg' && $_POST['foto_remove'] == 0 ) {
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }

                        $request_acreditacion = $this->model->insertResponsables($intIdAcreditacion, $strNameAcreditacion, $strLink, $imgPortada, $intStatus);
                        $option = 2;
                    }

                }

                if ($request_acreditacion > 0) {

                    if ($option == 1) {

                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }

                    } else {

                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');

                        if($nombre_foto != '') { uploadImageGral($foto, $imgPortada); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.jpg') || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.jpg')) {
                            deleteFileGral($_POST['foto_actual']);
                        }

                    }
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
                
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);            
        }
        die();
    }

    public function getResponsables() {

        $getPermisos = $this->getPermisos;

        if($getPermisos['permisosMod']['r']){

            $btnView = '';
            $btnEdit = '';
            $btnDelete = '';

            $arrData = $this->model->selectResponsables();
            
            for ($i=0; $i < count($arrData); $i++) {
                
                if ($arrData[$i]['imagen'] == 'portada_categoria.jpg') {
                    $arrData[$i]['url_portada'] = media().'images/'.$arrData[$i]['imagen'];
                } else {
                    $arrData[$i]['url_portada'] = media().'images/uploads/'.$arrData[$i]['imagen'];
                }

                if($arrData[$i]['status'] == 1) {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge rounded-pill bg-danger">Inactivo</span>';
                }

                if($getPermisos['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-dark btn-sm btnViewResponsable" onClick="fntViewResponsable('.$arrData[$i]['idresponsables'].')" title="Ver Responsable"><i class="bi bi-eye-fill"></i></button>';
                }

                if($getPermisos['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary btn-sm btnEditResponsable" onClick="fntEditResponsable('.$arrData[$i]['idresponsables'].')" title="Editar Responsable"><i class="bi bi-pencil-square"></i></button>';
                }

                if($getPermisos['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm btnDelResponsable" onClick="fntDelResponsable('.$arrData[$i]['idresponsables'].')" title="Eliminar Responsable"><i class="bi bi-trash-fill"></i></button>';
                }

                $arrData[$i]['options'] = '<div class="btn-group">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

    }

    public function getResponsable($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdResponsable = intval($id);

            if ($intIdResponsable > 0) {

                $arrData = $this->model->selectResponsable($intIdResponsable);

                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    if ($arrData['imagen'] == 'portada_categoria.jpg') {
                        $arrData['url_portada'] = media().'images/'.$arrData['imagen'];
                    } else {
                        $arrData['url_portada'] = media().'images/uploads/'.$arrData['imagen'];
                    }
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }

                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }

        }
        die();
        
    }

    public function delResponsable() {
        $getPermisos = $this->getPermisos;

        if($_POST) {
            if($getPermisos['permisosMod']['d']) {
                $intIdResponsable = intval($_POST['id']);
                $requestDelete = $this->model->delResponsable($intIdResponsable);
                if($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado correctamente');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    // Titular
    public function setTitular() {
        
        if ($_POST) {

            $getPermisos = $this->getPermisos;

            if(empty($_POST['txtNombreTitular']) || empty($_POST['txtPuesto']) || empty($_POST['listStatusT']) ) {

				$arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');

			} else {

				$intIdTitular = empty($_POST['idTitular']) ? 0 : intval($_POST['idTitular']);
				$strNombre = strClean($_POST['txtNombreTitular']);
				$strPuesto = strClean($_POST['txtPuesto']);
                $strLinkTesoreria = strClean($_POST['txtTesoreria']);
				$intStatus 	= intval($_POST['listStatusT']);

				if($intIdTitular == 0) {
					//Crear
                    if($getPermisos['permisosMod']['w']) {
                        $option = 1;
                        $request = $this->model->insertTitular($intIdTitular, $strNombre, $strPuesto, $strLinkTesoreria, $intStatus);
                    }
				} else {
					//Actualizar
					if($getPermisos['permisosMod']['u']) {
                        
						$option = 2;
						$request = $this->model->insertTitular($intIdTitular, $strNombre, $strPuesto, $strLinkTesoreria, $intStatus);
					}
				}

				if ($request > 0) {

					if ($option == 1) {
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
					}

				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getTitular($id) {

        $getPermisos = $this->getPermisos;

        if ($getPermisos['permisosMod']['r']) {

            $intIdTitular = intval($id);
            if ($intIdTitular > 0) {

                $arrData = $this->model->selectTitular($intIdTitular);

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

}