<?php

require_once('Models/TTransparencia.php');
require_once('Models/TDataGral.php');

class Transparencia extends Controllers {

    use TDataGral, TTransparencia;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function transparencia() {

        $data['page_id']       = 1;
        $data['page_tag']      = 'transparencia';
        $data['page_title']    = 'Transparencia | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Transparencia';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León Guanajuato, León, Guanajuato';
        $data['page_transp']   = $this->getDataPageTransp();
        $data['infogral']      = $this->getDataInfoGral();
        $data['responsables']  = $this->getResponsables();
        $data['titular']       = $this->getTitular();
        $data['transparencia'] = $this->getArticulosTransp();
        // $data['transp_anio']   = $this->getArticulosAnio();
        $data['page_functions_js'] = 'functions_transparencia.js';
        $this->views->getView($this, 'transparencia', $data);

    }

    public function getAnios() {

        $arrData = $this->getAniosBD();

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getFormato($anio) {

        $anio = intval($anio);

        $arrData = $this->getFormatoBD($anio);

        if (empty($arrData)) {
            $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
        } else {
            $arrResponse = array('status' => true, 'data' => $arrData);
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function getFileArticles() {
        
        if ($_POST) {
            $anio = intval($_POST['anio']);
            $formato = strClean($_POST['formato']);
            
            $arrData = $this->getDataTransparencia($anio, $formato);
            
            for ($i=0; $i < count($arrData); $i++) {

                if ($arrData[$i]['filePDF'] != '') {
                    $arrData[$i]['filePDF'] = '<a href="'.base_url().$arrData[$i]['filePDF'].'" class="formatos btn-custom" target="_blank"><span>Descargar PDF <i class="fas fa-download"></i></span></a>';
                }

                if ($arrData[$i]['fileXLS'] != '') {
                    $arrData[$i]['fileXLS'] = '<a href="'.base_url().$arrData[$i]['fileXLS'].'" class="formatos btn-custom" target="_blank"><span>Descargar XLS<i class="fas fa-download"></i></span></a>';
                }

            }
        
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
        
    }
    
}