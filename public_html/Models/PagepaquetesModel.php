<?php

    class PagepaquetesModel extends Mysql {

        private $intIdPaquete;
        private $strTitulo;
        private $strDescripcion;
        private $strDescCorta;
        private $strImg;
        private $strLink;
        private $strDuracion;
        private $strHorario;
        private $strRuta;
        private $intStatus;

        // Página paquetes
        private $strNameEspecie;
        private $strNameScie;
        private $strImgParallax;

        public function __construct() {
            parent::__construct();
        }

        public function insertPaquete(int $id, string $titulo, string $descripcion, string $desc_corta, string $img, string $link, string $duracion, string $horario, string $ruta, int $status) {

            $this->intIdPaquete   = $id;
            $this->strTitulo      = $titulo;
            $this->strDescripcion = $descripcion;
            $this->strDescCorta   = $desc_corta;
            $this->strImg         = $img;
            $this->strLink        = $link;
            $this->strDuracion    = $duracion;
            $this->strHorario     = $horario;
            $this->strRuta        = $ruta;
            $this->intStatus      = $status;

            if($this->intIdPaquete <= 0) {

                $query_insert = "INSERT INTO paquetes(titulo, descripcion, descripcion_corta, imagen, link_ecommerce, duracion, horario, ruta, statuspaquete) VALUES (?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strDescripcion,
                                 $this->strDescCorta,
                                 $this->strImg,
                                 $this->strLink,
                                 $this->strDuracion,
                                 $this->strHorario,
                                 $this->strRuta,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE paquetes SET titulo = ?, descripcion = ?, descripcion_corta = ?, imagen = ?, link_ecommerce = ?, duracion = ?, horario = ?, ruta = ?, statuspaquete = ? WHERE idpaquete = $this->intIdPaquete";
                $arrData = array($this->strTitulo,
                                 $this->strDescripcion,
                                 $this->strDescCorta,
                                 $this->strImg,
                                 $this->strLink,
                                 $this->strDuracion,
                                 $this->strHorario,
                                 $this->strRuta,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectPaquetes() {
            $sql = "SELECT idpaquete, titulo, descripcion, descripcion_corta, imagen, link_ecommerce, duracion, horario, statuspaquete FROM paquetes WHERE statuspaquete != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPaquete(int $id) {
            $this->intIdPaquete = $id;
            $sql = "SELECT idpaquete, titulo, descripcion, descripcion_corta, imagen, link_ecommerce, duracion, horario, statuspaquete FROM paquetes WHERE idpaquete = $this->intIdPaquete";
            $request = $this->select($sql);
            return $request;
        }

        public function deletePaquete(int $id) {
            $this->intIdPaquete = $id;

            $sql = "UPDATE paquetes SET statuspaquete = ? WHERE idpaquete = $this->intIdPaquete";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);

            if($request) {
                $request = 'ok';	
            } else {
                $request = 'error';
            }

            return $request;
        }

        public function insertDataPagePaquetes(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
            $this->intIdPaquete   = $id;
            $this->strTitulo      = $titulo;
            $this->strNameEspecie = $name_espe;
            $this->strNameScie    = $name_scie;
            $this->strImg         = $portada;
            $this->strImgParallax = $portada_parallax;
            $this->intStatus      = $status;

            if($this->intIdPaquete <= 0) {

                $query_insert = "INSERT INTO page_paquetes(titulo_pagepaquetes, nameespecie_pagepaquetes, namescie_pagepaquetes, portada_pagepaquetes, parallax_pagepaquetes, statuspagepaquetes) VALUES (?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImg,
                                 $this->strImgParallax,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE page_paquetes SET titulo_pagepaquetes = ?, nameespecie_pagepaquetes = ?, namescie_pagepaquetes = ?, portada_pagepaquetes = ?, parallax_pagepaquetes = ?, statuspagepaquetes = ? WHERE idpagepaquetes = $this->intIdPaquete";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImg,
                                 $this->strImgParallax,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;
        }

        public function selectDataPagePaquetes($id) {
            $this->intIdPaquete = $id;
            if ($this->intIdPaquete != null) {
                $sql = "SELECT idpagepaquetes, titulo_pagepaquetes, nameespecie_pagepaquetes, namescie_pagepaquetes, portada_pagepaquetes, parallax_pagepaquetes, statuspagepaquetes FROM page_paquetes WHERE idpagepaquetes = $this->intIdPaquete";
            } else {
                $sql = "SELECT idpagepaquetes, titulo_pagepaquetes, nameespecie_pagepaquetes, namescie_pagepaquetes, portada_pagepaquetes, parallax_pagepaquetes, statuspagepaquetes FROM page_paquetes";
            }

            $request = $this->select($sql);
            return $request;
        }

    }