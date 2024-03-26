<?php

    class CulturaModel extends Mysql {

        private $idCultura;
        private $strTitulo;
        private $strImgPortada;
        private $strMision;
        private $strVision;
        private $strValores;
        private $strTituloMision;
        private $strTituloVision;
        private $strTituloValores;
        private $strImgParallax;
        private $strImgParallaxDos;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertData(int $id, string $titulo, string $portada, string $mision, string $tituloMision, string $vision, string $tituloVision, string $valores, string $tituloValores, string $parallax, string $parallaxdos, int $status) {

            $this->idCultura              = $id;
            $this->strTitulo              = $titulo;
            $this->strImgPortada          = $portada;
            $this->strMision              = $mision;
            $this->strTituloMision        = $tituloMision;
            $this->strVision              = $vision;
            $this->strTituloVision        = $tituloVision;
            $this->strValores             = $valores;
            $this->strTituloValores       = $tituloValores;
            $this->strImgParallax         = $parallax;
            $this->strImgParallaxDos      = $parallaxdos;
            $this->intStatus              = $status;

            if($this->idCultura <= 0) {

                $query_insert = "INSERT INTO cultura(titulo, portada, mision, titulo_mision, vision, titulo_vision, valores, titulo_valores, parallax1, parallax2, statuscultura) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strImgPortada,
                                 $this->strMision,
                                 $this->strTituloMision,
                                 $this->strVision,
                                 $this->strTituloVision,
                                 $this->strValores,
                                 $this->strTituloValores,
                                 $this->strImgParallax,
                                 $this->strImgParallaxDos,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE cultura SET titulo = ?, portada = ?, mision = ?, titulo_mision = ?, vision = ?, titulo_vision = ?, valores = ?, titulo_valores = ?, parallax1 = ?, parallax2 = ?, statuscultura = ? WHERE idcultura = $this->idCultura";
                $arrData = array($this->strTitulo,
                                 $this->strImgPortada,
                                 $this->strMision,
                                 $this->strTituloMision,
                                 $this->strVision,
                                 $this->strTituloVision,
                                 $this->strValores,
                                 $this->strTituloValores,
                                 $this->strImgParallax,
                                 $this->strImgParallaxDos,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectData($id) {

            $this->idCultura = $id;
            if ($id != null) {
                $sql = "SELECT * FROM cultura WHERE idcultura = $this->idCultura";
            } else {
                $sql = "SELECT * FROM cultura";
            }

            $request = $this->select($sql);
            return $request;
        }

    }