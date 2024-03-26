<?php

include_once('Models/TDataGral.php');
include_once('Models/TNoticias.php');

class Home extends Controllers {

    use TDataGral, TNoticias;

    public function __construct() {
        parent::__construct();
    }

    public function home() {

        $infoHistoria          = $this->getDataHistory();

        $data['page_id']       = 1;
        $data['page_tag']      = 'home';
        $data['page_title']    = 'Zoológico de León | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Home';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['slider_home']   = $this->getSlidersHome();
        $data['paquetes_home'] = $this->getPaquetesHome();
        $data['historia_home'] = $infoHistoria;
        $data['noticias_home'] = $this->getInfoNoticiasHome(4, HOMENOTICIAS);
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'home', $data);
    }

}