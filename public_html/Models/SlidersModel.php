<?php

    class SlidersModel extends Mysql {

        private $intIdSlider;
        private $strTitulo;
        private $strLink;
        private $strImg;
        private $intOrden;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertSlider(int $id, string $titulo, string $link, string $img, int $orden, int $status) {

            $this->intIdSlider    = $id;
            $this->strTitulo      = $titulo;
            $this->strLink        = $link;
            $this->strImg         = $img;
            $this->intOrden       = $orden;
            $this->intStatus      = $status;

            if($this->intIdSlider <= 0) {

                $query_insert = "INSERT INTO sliders(titulo, link, imagen, orden, statusslider) VALUES (?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strLink,
                                 $this->strImg,
                                 $this->intOrden,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE sliders SET titulo = ?, link = ?, imagen = ?, orden = ?, statusslider = ? WHERE idslider = $this->intIdSlider";
                $arrData = array($this->strTitulo,
                                 $this->strLink,
                                 $this->strImg,
                                 $this->intOrden,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectSliders() {
            $sql = "SELECT idslider, titulo, link, imagen, orden, statusslider FROM sliders WHERE statusslider != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSlider(int $id) {
            $this->intIdSlider = $id;
            $sql = "SELECT idslider, titulo, link, imagen, orden, statusslider FROM sliders WHERE idslider = $this->intIdSlider";
            $request = $this->select($sql);
            return $request;
        }

        public function deleteSlider(int $id) {
            $this->intIdSlider = $id;

            $sql = "UPDATE sliders SET statusslider = ? WHERE idslider = $this->intIdSlider";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);

            if($request) {
                $request = 'ok';	
            } else {
                $request = 'error';
            }

            return $request;
        }

    }