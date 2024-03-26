<?php

include_once('Models/TDataGral.php');

class Reglamento extends Controllers {

    use TDataGral;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function reglamento() {

        $infoReglamento = $this->getDataReglamento();
        $reglas = $this->getDataReglas();

        $data['page_id']          = 1;
        $data['page_tag']         = 'reglamento';
        $data['page_title']       = 'Reglamento General | '.NOMBRE_EMPRESA;
        $data['page_name']        = 'Reglamento General';
        $data['page_content']     = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords']    = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['info_reglamentoe'] = $infoReglamento;
        $data['reglas']           = $reglas;
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'reglamento', $data);
    }

}