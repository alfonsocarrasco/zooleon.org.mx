<?php

class PaqueteshomeModel extends Mysql {

    private $intIdPaquete;
    private $strTitulo;
    private $strDescripcion;
    private $strLink;
    private $strImg;
    private $strImg2;
    private $intStatus;

    // Página paquetes
    private $strNameEspecie;
    private $strNameScie;
    private $strImgParallax;

    public function __construct() {
        parent::__construct();
    }

    public function insertData(int $id, string $titulo, string $descripcion, string $link, string $img, string $img2, int $status) {

        $this->intIdPaquete   = $id;
        $this->strTitulo      = $titulo;
        $this->strDescripcion = $descripcion;
        $this->strLink        = $link;
        $this->strImg         = $img;
        $this->strImg2        = $img2;
        $this->intStatus      = $status;

        if($this->intIdPaquete <= 0) {

            $query_insert = "INSERT INTO paquetes_home(titulo, descripcion, link, imagen_bkg, imagen_animal, status) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->strTitulo,
                             $this->strDescripcion,
                             $this->strLink,
                             $this->strImg,
                             $this->strImg2,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE paquetes_home SET titulo = ?, descripcion = ?, link = ?, imagen_bkg = ?, imagen_animal = ?, status = ? WHERE idpaqueteh = $this->intIdPaquete";
            $arrData = array($this->strTitulo,
                             $this->strDescripcion,
                             $this->strLink,
                             $this->strImg,
                             $this->strImg2,
                             $this->intStatus);
            $request = $this->update($sql, $arrData);

        }
        return $request;

    }

    public function selectData() {
        $sql = "SELECT idpaqueteh, titulo, descripcion, link, imagen_bkg, imagen_animal, status FROM paquetes_home WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPaquete(int $id) {
        $this->intIdPaquete = $id;
        $sql = "SELECT idpaqueteh, titulo, descripcion, link, imagen_bkg, imagen_animal, status FROM paquetes_home WHERE idpaqueteh = $this->intIdPaquete";
        $request = $this->select($sql);
        return $request;
    }

    public function delData(int $id) {
        $this->intIdPaquete = $id;

        $sql = "UPDATE paquetes_home SET status = ? WHERE idpaqueteh = $this->intIdPaquete";
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