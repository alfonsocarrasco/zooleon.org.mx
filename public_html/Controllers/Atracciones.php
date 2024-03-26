<?php

include_once('Models/TDataGral.php');
include_once('Models/TAtracciones.php');

class Atracciones extends Controllers {

    use TDataGral, TAtracciones;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function atracciones() {

        $data['page_id']          = 1;
        $data['page_tag']         = 'atracciones';
        $data['page_title']       = 'Atracciones | '.NOMBRE_EMPRESA;
        $data['page_name']        = 'Atracciones';
        $data['page_keywords']    = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León Guanajuato, León, Guanajuato';
        $data['infogral']         = $this->getDataInfoGral();
        $data['page_atracciones'] = $this->getPageAtracciones();
        $data['atracciones']      = $this->getAtracciones();
        $this->views->getView($this, 'atracciones', $data);
    }

    public function atraccion($params) {

        if (empty($params)) {
            header('Location: '.base_url());
        } else {

            $arrParams     = explode(',', $params);
            $idatraccion	   = intval($arrParams[0]);
            $ruta 		   = strClean($arrParams[1]);
            $infoAtraccion = $this->getAtraccion($idatraccion, $ruta);

            if (!empty($infoAtraccion)) {
                $data['page_tag'] 	    = $infoAtraccion['ruta'];
                $data['page_title']     = $infoAtraccion['titulo'].' | '.NOMBRE_EMPRESA;
                $data['page_name']      = $infoAtraccion['ruta'];
            } else {
                $data['page_tag'] 	   = 'matenimiento';
                $data['page_title']    = 'Página en matenimiento | '.NOMBRE_EMPRESA;
            }
            $data['page_keywords']  = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
            $data['page_atracciones'] = $this->getPageAtracciones();
            $data['page_atraccion'] = $infoAtraccion;
            $data['infogral']       = $this->getDataInfoGral();
            $this->views->getView($this, 'atraccion', $data);

        }

    }

}