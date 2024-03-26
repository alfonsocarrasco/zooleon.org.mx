<?php

    class PoliticaprivacidadModel extends Mysql {

        private $idPrivacidad;
        private $strTitulo;
        private $strDescripcion;
        private $strImgPortada;
        private $strNameEsp;
        private $strNameScie;
        private $strImgPortadaParallax;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertDataPrivacidad(int $id, string $titulo, string $descripcion, string $portada, string $name_espe, string $name_scie, string $parallax, int $status) {

            $this->idPrivacidad           = $id;
            $this->strTitulo              = $titulo;
            $this->strDescripcion         = $descripcion;
            $this->strImgPortada          = $portada;
            $this->strNameEsp             = $name_espe;
            $this->strNameScie            = $name_scie;
            $this->strImgPortadaParallax  = $parallax;
            $this->intStatus              = $status;

            if($this->idPrivacidad <= 0) {

                $query_insert = "INSERT INTO politica_privacidad(titulo_privacidad, descripcion_privacidad, portada_privacidad, name_espe_priv, name_scie_priv, parallax_privacidad, statusprivacidad) VALUES (?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strDescripcion,
                                 $this->strImgPortada,
                                 $this->strNameEsp,
                                 $this->strNameScie,
                                 $this->strImgPortadaParallax,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE politica_privacidad SET titulo_privacidad = ?, descripcion_privacidad = ?, portada_privacidad = ?, name_espe_priv = ?, name_scie_priv = ?, parallax_privacidad = ?, statusprivacidad = ? WHERE idprivacidad = $this->idPrivacidad";
                $arrData = array($this->strTitulo,
                                 $this->strDescripcion,
                                 $this->strImgPortada,
                                 $this->strNameEsp,
                                 $this->strNameScie,
                                 $this->strImgPortadaParallax,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectDataPrivacidad($id) {

            $this->idPrivacidad = $id;
            if ($id != null) {
                $sql = "SELECT idprivacidad, titulo_privacidad, descripcion_privacidad, portada_privacidad, name_espe_priv, name_scie_priv, parallax_privacidad, statusprivacidad FROM politica_privacidad WHERE idprivacidad = $this->idPrivacidad";
            } else {
                $sql = "SELECT idprivacidad, titulo_privacidad, descripcion_privacidad, portada_privacidad, name_espe_priv, name_scie_priv, parallax_privacidad, statusprivacidad FROM politica_privacidad";
            }

            $request = $this->select($sql);
            return $request;
        }

    }