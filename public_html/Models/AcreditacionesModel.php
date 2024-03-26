<?php

    class AcreditacionesModel extends Mysql {

        private $intIdAcreditacion;
        private $strNameAcreditacion;
        private $strImgAcreditacion;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertAcreditacion(int $id, string $name, string $img, int $status) {

            $this->intIdAcreditacion   = $id;
            $this->strNameAcreditacion = $name;
            $this->strImgAcreditacion  = $img;
            $this->intStatus           = $status;

            if($this->intIdAcreditacion <= 0) {

                $query_insert = "INSERT INTO acreditaciones(nombreacreditacion, imagenacreditacion, statusacreditacion) VALUES (?,?,?)";
                $arrData = array($this->strNameAcreditacion,
                                 $this->strImgAcreditacion,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE acreditaciones SET nombreacreditacion = ?, imagenacreditacion = ?, statusacreditacion = ? WHERE idacreditacion = $this->intIdAcreditacion";
                $arrData = array($this->strNameAcreditacion,
                                 $this->strImgAcreditacion,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectAcreditaciones() {
            $sql = "SELECT idacreditacion, nombreacreditacion, imagenacreditacion, statusacreditacion FROM acreditaciones WHERE statusacreditacion != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectAcreditacion(int $id) {
            $this->intIdAcreditacion = $id;
            $sql = "SELECT idacreditacion, nombreacreditacion, imagenacreditacion, statusacreditacion FROM acreditaciones WHERE idacreditacion = $this->intIdAcreditacion";
            $request = $this->select($sql);
            return $request;
        }

        public function delAcreditacion(int $id) {
            $this->intIdAcreditacion = $id;

            $sql = "UPDATE acreditaciones SET statusacreditacion = ? WHERE idacreditacion = $this->intIdAcreditacion";
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