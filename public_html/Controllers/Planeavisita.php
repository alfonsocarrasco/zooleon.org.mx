<?php

require_once('Models/TDataGral.php');
require_once('Models/TPlaneavisita.php');

class Planeavisita extends Controllers {

    use TDataGral, TPlaneavisita;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function planeavisita() {

        $data['page_id']       = 1;
        $data['page_tag']      = 'planeavisita';
        $data['page_title']    = 'Paquetes Grupales | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Paquetes Grupales';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León Guanajuato, León, Guanajuato';
        $data['page_content']  = 'Planifica tu visita a Zooleón';
        $data['infogral']      = $this->getDataInfoGral();
        $data['estados']       = $this->loadEstados();
        $data['page_planea']   = $this->getDataPage();
        $data['page_functions_js'] = 'functions_planeavisita.js';
        $this->views->getView($this, 'planeavisita', $data);
        
    }
    
    public function getMunicipios($id) {
        $arrData = $this->loadMunicipios($id);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
}