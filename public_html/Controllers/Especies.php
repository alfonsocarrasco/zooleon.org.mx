<?php

include_once('Models/TEspecies.php');
include_once('Models/TDataGral.php');

class Especies extends Controllers {

    use TEspecies, TDataGral;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function especies() {
        $data['page_id']       = 1;
        $data['page_tag']      = 'especies';
        $data['page_title']    = 'Especies | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Nuestros Ejemplares';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['especies']      = $this->getDataEspecies();
        $data['page_especies'] = $this->getDataInfoEspecies();
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'especies', $data);
    }

    public function especie($params) {

        if (empty($params)) {
            header('Location: '.base_url());
        } else {

            $arrParams  = explode(',', $params);
            $catEspecie = strClean($arrParams[0]);
            $idespecie	= intval($arrParams[1]);
            $ruta 		= strClean($arrParams[2]);
            $infoEspecie = $this->getInfoEspecie($idespecie, $ruta);

            if (!empty($infoEspecie)) {
                $data['page_tag'] 	   = $infoEspecie['ruta_especie'];
                $data['page_title']    = $infoEspecie['nombre_especie'].' | '.NOMBRE_EMPRESA;
                $data['page_name']     = $infoEspecie['nombre_especie'];
                $data['page_content']  = $infoEspecie['nombre_especie'].' - '.$infoEspecie['nombre_cientifico'];
            } else {
                $data['page_tag'] 	   = 'matenimiento';
                $data['page_title']    = 'Página en matenimiento | '.NOMBRE_EMPRESA;
            }
            
            $data['page_especies'] = $this->getDataInfoEspecies();
            $data['page_especie']  = $infoEspecie;
            $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
            $data['infogral']      = $this->getDataInfoGral();
            $this->views->getView($this, 'especie', $data);

        }

    }

}