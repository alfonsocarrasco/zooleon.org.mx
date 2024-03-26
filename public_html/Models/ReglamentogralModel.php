<?php

    class ReglamentogralModel extends Mysql {

        private $idRegla;
        private $idPageRegla;
        private $strDescripcion;
        private $strImgPortada;
        private $strTitulo;
        private $strNameEspecie;
        private $strNameScie;
        private $strImgParallax;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertRegla(int $id, string $descripcion, string $portada, int $status) {

            $this->idRegla        = $id;
            $this->strDescripcion = $descripcion;
            $this->strImgPortada  = $portada;
            $this->intStatus      = $status;

            if($this->idRegla <= 0) {

                $query_insert = "INSERT INTO reglamento(descripcion_reglamento, image_reglamento, statusreglamento) VALUES (?,?,?)";
                $arrData = array($this->strDescripcion,
                                 $this->strImgPortada,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE reglamento SET descripcion_reglamento = ?, image_reglamento = ?, statusreglamento = ? WHERE idreglamento = $this->idRegla";
                $arrData = array($this->strDescripcion,
                                 $this->strImgPortada,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectReglas() {
            $sql = "SELECT idreglamento, descripcion_reglamento, image_reglamento, statusreglamento FROM reglamento WHERE statusreglamento != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectRegla(int $id) {
            $this->idRegla = $id;
            $sql = "SELECT idreglamento, descripcion_reglamento, image_reglamento, statusreglamento FROM reglamento WHERE idreglamento = $this->idRegla";
            $request = $this->select($sql);
            return $request;
        }

        public function delRegla(int $id) {
            $this->idRegla = $id;

            $sql = "UPDATE reglamento SET statusreglamento = ? WHERE idreglamento = $this->idRegla";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);

            if($request) {
                $request = 'ok';	
            } else {
                $request = 'error';
            }

            return $request;
        }

        public function insertDataPageRegla(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
            $this->idPageRegla            = $id;
            $this->strTitulo              = $titulo;
            $this->strNameEspecie         = $name_espe;
            $this->strNameScie            = $name_scie;
            $this->strImgPortada          = $portada;
            $this->strImgParallax         = $portada_parallax;
            $this->intStatus              = $status;

            if($this->idPageRegla <= 0) {

                $query_insert = "INSERT INTO page_reglamento(titulo_pagereglamento, namespecie_pagereglamento, namescie_pagereglamento, portada_pagereglamento, parallax_pagereglamento, statuspagereglamento) VALUES (?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImgPortada,
                                 $this->strImgParallax,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE page_reglamento SET titulo_pagereglamento = ?, namespecie_pagereglamento = ?, namescie_pagereglamento = ?, portada_pagereglamento = ?, parallax_pagereglamento = ?, statuspagereglamento = ? WHERE idpagereglamento = $this->idPageRegla";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImgPortada,
                                 $this->strImgParallax,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;
        }

        public function selectDataPageReglamento($id) {
            $this->idPageRegla = $id;
            if ($this->idPageRegla != null) {
                $sql = "SELECT idpagereglamento, titulo_pagereglamento, namespecie_pagereglamento, namescie_pagereglamento, portada_pagereglamento, parallax_pagereglamento, statuspagereglamento FROM page_reglamento WHERE idpagereglamento = $this->idPageRegla";
            } else {
                $sql = "SELECT idpagereglamento, titulo_pagereglamento, namespecie_pagereglamento, namescie_pagereglamento, portada_pagereglamento, parallax_pagereglamento, statuspagereglamento FROM page_reglamento";
            }

            $request = $this->select($sql);
            return $request;
        }
    }