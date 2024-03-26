<?php

    class PatrocinadoresModel extends Mysql {

        private $intIdSponsor;
        private $strNameSponsor;
        private $strImgSponsor;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertSponsor(int $id, string $name, string $img, int $status) {

            $this->intIdSponsor   = $id;
            $this->strNameSponsor = $name;
            $this->strImgSponsor  = $img;
            $this->intStatus      = $status;

            if($this->intIdSponsor <= 0) {

                $query_insert = "INSERT INTO patrocinadores(nombrepatrocinador, imagenpatrocinador, statuspatrocinador) VALUES (?,?,?)";
                $arrData = array($this->strNameSponsor,
                                 $this->strImgSponsor,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE patrocinadores SET nombrepatrocinador = ?, imagenpatrocinador = ?, statuspatrocinador = ? WHERE idpatrocinador = $this->intIdSponsor";
                $arrData = array($this->strNameSponsor,
                                 $this->strImgSponsor,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectSponsors() {
            $sql = "SELECT idpatrocinador, nombrepatrocinador, imagenpatrocinador, statuspatrocinador FROM patrocinadores WHERE statuspatrocinador != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectSponsor(int $id) {
            $this->intIdSponsor = $id;
            $sql = "SELECT idpatrocinador, nombrepatrocinador, imagenpatrocinador, statuspatrocinador FROM patrocinadores WHERE idpatrocinador = $this->intIdSponsor";
            $request = $this->select($sql);
            return $request;
        }

        public function delSponsor(int $id) {
            $this->intIdSponsor = $id;

            $sql = "UPDATE patrocinadores SET statuspatrocinador = ? WHERE idpatrocinador = $this->intIdSponsor";
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