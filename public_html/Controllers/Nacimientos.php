<?php

include_once('Models/TDataGral.php');
include_once('Models/TNacimientos.php');

class Nacimientos extends Controllers {

    use TDataGral, TNacimientos;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function nacimientos() {

        $data['page_id']       = 1;
        $data['page_tag']      = 'nacimientos';
        $data['page_title']    = 'Nacimientos | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Nacimientos';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['page_data']     = $this->getDataPage();
        $data['data_births']   = $this->getDataNacimientos();
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'nacimientos', $data);
    }

    public function nacimiento($params) {

        if (empty($params)) {
            header('Location: '.base_url());
        } else {

            $arrParams  = explode(',', $params);
            $catEspecie = strClean($arrParams[0]);
            $idbirth	= intval($arrParams[1]);
            $ruta 		= strClean($arrParams[2]);
            $dataBirth  = $this->getDataNacimiento($idbirth, $ruta);

            if (!empty($dataBirth)) {
                $data['page_tag'] 	   = $dataBirth['ruta'];
                $data['page_title']    = $dataBirth['nombre_especie'].' | '.NOMBRE_EMPRESA;
                $data['page_name']     = $dataBirth['nombre_especie'];
                $data['page_content']  = $dataBirth['descripcion'];
            } else {
                $data['page_tag'] 	   = 'matenimiento';
                $data['page_title']    = 'Página en matenimiento | '.NOMBRE_EMPRESA;
            }
            $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
            $data['data_brith']    = $dataBirth;
            $data['page_data']     = $this->getDataPage();
            $data['infogral']      = $this->getDataInfoGral();
            $this->views->getView($this, 'nacimiento', $data);

        }

    }

}