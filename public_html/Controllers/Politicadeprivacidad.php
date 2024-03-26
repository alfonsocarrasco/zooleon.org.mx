<?php

include_once('Models/TDataGral.php');

class Politicadeprivacidad extends Controllers {

    use TDataGral;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function politicadeprivacidad() {

        $infoPrivacidad = $this->getDataPrivacidad();

        $data['page_id']         = 1;
        $data['page_tag']        = 'politicaprivacidad';
        $data['page_title']      = 'Politica de Privacidad | '.NOMBRE_EMPRESA;
        $data['page_name']       = 'Politica de Privacidad';
        if (!empty($infoPrivacidad)) {
            $data['page_content']    = $infoPrivacidad['descripcion_privacidad'];
        }
        $data['page_keywords']   = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['info_privacidad'] = $infoPrivacidad;
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'politicadeprivacidad', $data);
    }

}