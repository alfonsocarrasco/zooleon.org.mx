<?php

include_once('Models/TDataGral.php');
include_once('Models/TPaquetes.php');

class Paquetes extends Controllers {

    use TDataGral, TPaquetes;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function paquetes() {

        $pagina = 1;
        $cantPaquetes 		   = $this->countPaquetes();
        $total_paquetes        = $cantPaquetes['total_paquetes'];
        $desde 				   = ($pagina - 1) * PAQUETESPORPAG;
        $total_paginas 		   = ceil($total_paquetes / PAQUETESPORPAG);
        
        $data['page_id']       = 1;
        $data['page_tag']      = 'paquetes';
        $data['page_title']    = 'Paquetes | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Nuestros Paquetes';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['paquetes']      = $this->getDataPaquetes($desde, PAQUETESPORPAG);
        $data['site_paquetes'] = $this->getDataPagePaquetes();
        $data['pagina']        = $pagina;
        $data['total_paginas'] = $total_paginas;
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'paquetes', $data);
    }

    public function paquete($params) {
        if (empty($params)) {
            header('Location: '.base_url());
        } else {

            $arrParams   = explode(',', $params);
            $idpaquete	 = intval($arrParams[0]);
            $ruta        = strClean($arrParams[1]);
            $infoPaquete = $this->getPaquete($idpaquete, $ruta);

            if (!empty($infoPaquete)) {
                $data['page_tag'] 	   = $infoPaquete['ruta'];
                $data['page_title']    = $infoPaquete['titulo'].' | '.NOMBRE_EMPRESA;
                $data['page_name']     = $infoPaquete['titulo'];
                $data['page_content']  = $infoPaquete['descripcion_corta'];
            } else {
                $data['page_tag'] 	   = 'matenimiento';
                $data['page_title']    = 'Página en matenimiento | '.NOMBRE_EMPRESA;
            }
            $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
            $data['paquete']       = $infoPaquete;
            $data['site_paquetes'] = $this->getDataPagePaquetes();
            $data['infogral']      = $this->getDataInfoGral();
            $this->views->getView($this, 'paquete', $data);

        }
    }

    public function page($pagina = null) {

        $pagina = is_numeric($pagina) ? $pagina : 1;

        $cantPaquetes = $this->countPaquetes();
        $total_paquetes    = $cantPaquetes['total_paquetes'];
        $desde = ($pagina - 1) * PAQUETESPORPAG;
        $total_paginas = ceil($total_paquetes / PAQUETESPORPAG);
        
        $data['page_tag']      = 'paquetes';
        $data['page_title']    = 'Paquetes | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Nuestros Paquetes';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['paquetes']      = $this->getDataPaquetes($desde, PAQUETESPORPAG);
        $data['site_paquetes'] = $this->getDataPagePaquetes();
        $data['pagina'] 	   = $pagina;
        $data['total_paginas'] = $total_paginas;
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'paquetes', $data);
    }

}