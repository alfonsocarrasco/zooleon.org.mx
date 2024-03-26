<?php

include_once('Models/TDataGral.php');
include_once('Models/TNoticias.php');

class Noticias extends Controllers {

    use TDataGral, TNoticias;

    public function __construct() {
        parent::__construct();
        mantenimiento();
    }

    public function noticias() {

        $pagina = 1;
        $cantNoticias 		   = $this->cantNoticias(4);
        $total_noticias        = $cantNoticias['total_noticias'];
        $desde 				   = ($pagina - 1) * NOTASPORPAGINA;
        $total_paginas 		   = ceil($total_noticias / NOTASPORPAGINA);

        $data['page_id']       = 1;
        $data['page_tag']      = 'noticias';
        $data['page_title']    = 'Noticias | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Noticias';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['noticias']      = $this->getDataNoticias($desde, NOTASPORPAGINA, 4);
        $data['pagina'] 	   = $pagina;
        $data['total_paginas'] = $total_paginas;
        $data['info_pagsnews'] = $this->getDataPageNoticias();
        $data['infogral']      = $this->getDataInfoGral();
        $this->views->getView($this, 'noticias', $data);
    }

    public function noticia($params) {
        if (empty($params)) {
            header('Location: '.base_url());
        } else {

            $arrParams  = explode(',', $params);
            $idnoticia	= intval($arrParams[0]);
            $ruta 		= strClean($arrParams[1]);
            $infoNoticia = $this->getInfoNoticia($idnoticia, $ruta);

            if (!empty($infoNoticia)) {
                $data['page_tag'] 	   = $infoNoticia['ruta_nota'];
                $data['page_title']    = $infoNoticia['titulo_nota'].' | '.NOMBRE_EMPRESA;
                $data['page_name']     = $infoNoticia['titulo_nota'];
                $data['page_content']  = $infoNoticia['descripcion_nota'];
            } else {
                $data['page_tag'] 	   = 'matenimiento';
                $data['page_title']    = 'Página en matenimiento | '.NOMBRE_EMPRESA;
            }
            
            $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
            $data['page_noticia']  = $infoNoticia;
            $data['info_pagsnews'] = $this->getDataPageNoticias();
            $data['infogral']      = $this->getDataInfoGral();
            $this->views->getView($this, 'noticia', $data);

        }
    }

    public function page($pagina = null) {

        $pagina = is_numeric($pagina) ? $pagina : 1;

        $cantNotas = $this->cantNoticias(4);
        $total_noticias    = $cantNotas['total_noticias'];
        $desde = ($pagina - 1) * NOTASPORPAGINA;
        $total_paginas = ceil($total_noticias / NOTASPORPAGINA);
        
        $data['page_tag']      = 'noticias';
        $data['page_title']    = 'Noticias | '.NOMBRE_EMPRESA;
        $data['page_name']     = 'Noticias';
        $data['page_content']  = 'En el Zoológico de León además de conocer a sus más de 1089 ejemplares, podrás disfrutar de diversos servicios y eventos de temporada, para el gusto de todos. Viva una experiencia inolvidable en el Zoológico de León. Elija su paquete y viva una auténtica aventura animal. Si tiene alma aventurera, reserve ya.';
        $data['page_keywords'] = 'Zoológico, Zoológico León, Especies, Atracciones, Paquetes, Paquete Integral, Paquete Zoológico, Paquete Safari, Perro Parque, Zoona Lemur, Safari, Zoona Reptil, Zoona Mito, Cabaña de Tío Bufalo, Aves, Mamiferos, Reptiles, Tren, Ranchito, León, Guanajuato';
        $data['noticias']      = $this->getDataNoticias($desde, NOTASPORPAGINA, 4);
        $data['pagina'] 	   = $pagina;
        $data['total_paginas'] = $total_paginas;

        $this->views->getView($this, 'noticias', $data);
    }

}