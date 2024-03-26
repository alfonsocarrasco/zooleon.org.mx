<?php

require_once('Models/TDataGral.php');
require_once('Models/TAcercade.php');

class Acercade extends Controllers {

    use TDataGral, TAcercade;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function acercade() {

        $data['page_id']       = 1;
        $data['page_tag']      = 'acerca-de';
        $data['page_title']    = 'Acerca de | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'acerca-de';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['page_acercade'] = $this->getDataCultura();
        $data['infogral']      = $this->getDataInfoGral();

        $this->views->getView($this, 'acercade', $data);
    }

}