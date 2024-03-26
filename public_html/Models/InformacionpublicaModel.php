<?php

class InformacionpublicaModel extends Mysql {

    private $intIdFormato;
    private $strTitulo;
    private $strFormato;
    private $strAnio;
    private $strSubtitulo;
    private $strFilePDF;
    private $strFileXLS;
    private $intStatus;

    // Página paquetes
    private $intIdPageTransparencia;
    private $strNameEspecie;
    private $strNameScie;
    private $strImg;
    private $strImgParallax;

    // Resposables
    private $intIdResponsable;
    private $strNombre;
    private $strLink;
    private $strImgResponsable;

    // Titular
    private $intIdTitular;
    private $strNombreTitular;
    private $strPuesto;
    private $strLinkTesoreria;

    public function __construct() {
        parent::__construct();
    }

    public function insertFormato(int $id, string $titulo, string $formato, string $anio, string $subtitulo, string $filePDF, string $fileXLS, int $status) {

        $this->intIdFormato = $id;
        $this->strTitulo    = $titulo;
        $this->strFormato   = $formato;
        $this->strAnio      = $anio;
        $this->strSubtitulo = $subtitulo;
        $this->strFilePDF   = $filePDF;
        $this->strFileXLS   = $fileXLS;
        $this->intStatus    = $status;

        if($this->intIdFormato == 0) {

            $query_insert = "INSERT INTO transparencia(titulo, formato, anio, subtitulo, filePDF, fileXLS, status) VALUES (?,?,?,?,?,?,?)";
            $arrData = array($this->strTitulo,
                             $this->strFormato,
                             $this->strAnio,
                             $this->strSubtitulo,
                             $this->strFilePDF,
                             $this->strFileXLS,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);
            
        } else {

            $query_insert = "UPDATE transparencia SET titulo = ?, formato = ?, anio = ?, subtitulo = ?, filePDF = ?, fileXLS = ?, status = ? WHERE id = $this->intIdFormato";
            $arrData = array($this->strTitulo,
                             $this->strFormato,
                             $this->strAnio,
                             $this->strSubtitulo,
                             $this->strFilePDF,
                             $this->strFileXLS,
                             $this->intStatus);
            $request = $this->update($query_insert, $arrData);

        }
        return $request;

    }

    public function selectFormatos() {
        $query = "SELECT id, titulo, formato, anio, subtitulo, filePDF, fileXLS, status FROM transparencia WHERE status != 0";
        $request = $this->select_all($query);
        return $request;
    }

    public function selectFormato(int $id) {
        $this->intIdFormato = $id;

        $query = "SELECT id, titulo, formato, anio, subtitulo, filePDF, fileXLS, status FROM transparencia WHERE id = $this->intIdFormato";
        $request = $this->select($query);
        return $request;
    }

    public function deleteFormato(int $id) {
        $this->intIdFormato = $id;

        $sql = "UPDATE transparencia SET status = ? WHERE id = $this->intIdFormato";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if ($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }

        return $request;
    }

    public function insertData(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
        $this->intIdPageTransparencia = $id;
        $this->strTitulo              = $titulo;
        $this->strNameEspecie         = $name_espe;
        $this->strNameScie            = $name_scie;
        $this->strImg                 = $portada;
        $this->strImgParallax         = $portada_parallax;
        $this->intStatus              = $status;

        if($this->intIdPageTransparencia <= 0) {

            $query_insert = "INSERT INTO page_transparencia(titulo_pagetransparencia, nameespecie_pagetransparencia, namescie_pagetransparencia, portada_pagetransparencia, parallax_pagetransparencia, statuspagetransparencia) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->strTitulo,
                             $this->strNameEspecie,
                             $this->strNameScie,
                             $this->strImg,
                             $this->strImgParallax,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE page_transparencia SET titulo_pagetransparencia = ?, nameespecie_pagetransparencia = ?, namescie_pagetransparencia = ?, portada_pagetransparencia = ?, parallax_pagetransparencia = ?, statuspagetransparencia = ? WHERE idpagetransparencia  = $this->intIdPageTransparencia";
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

    public function selectData($id) {
        $this->intIdPageTransparencia = $id;
        if ($this->intIdPageTransparencia != null) {
            $sql = "SELECT idpagetransparencia, titulo_pagetransparencia, nameespecie_pagetransparencia, namescie_pagetransparencia, portada_pagetransparencia, parallax_pagetransparencia, statuspagetransparencia FROM page_transparencia WHERE idpagetransparencia = $this->intIdPageTransparencia";
        } else {
            $sql = "SELECT idpagetransparencia, titulo_pagetransparencia, nameespecie_pagetransparencia, namescie_pagetransparencia, portada_pagetransparencia, parallax_pagetransparencia, statuspagetransparencia FROM page_transparencia";
        }

        $request = $this->select($sql);
        return $request;
    }

    // Responsable
    public function insertResponsables(int $id, string $name, string $link, string $img, int $status) {

        $this->intIdResponsable  = $id;
        $this->strNombre         = $name;
        $this->strLink           = $link;
        $this->strImgResponsable = $img;
        $this->intStatus         = $status;

        if($this->intIdResponsable <= 0) {

            $query_insert = "INSERT INTO responsables(nombre, link, imagen, status) VALUES (?,?,?)";
            $arrData = array($this->strNombre,
                             $this->strLink,
                             $this->strImgResponsable,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE responsables SET nombre = ?, link = ?, imagen = ?, status = ? WHERE idresponsables = $this->intIdResponsable";
            $arrData = array($this->strNombre,
                             $this->strLink,
                             $this->strImgResponsable,
                             $this->intStatus);
            $request = $this->update($sql, $arrData);

        }
        return $request;

    }

    public function selectResponsables() {
        $sql = "SELECT idresponsables, nombre, link, imagen, status FROM responsables WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectResponsable(int $id) {
        $this->intIdResponsable = $id;
        $sql = "SELECT idresponsables, nombre, link, imagen, status FROM responsables WHERE idresponsables = $this->intIdResponsable";
        $request = $this->select($sql);
        return $request;
    }

    public function delResponsable(int $id) {
        $this->intIdResponsable = $id;

        $sql = "UPDATE responsables SET status = ? WHERE idresponsables = $this->intIdResponsable";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if($request) {
            $request = 'ok';
        } else {
            $request = 'error';
        }

        return $request;
    }

    public function insertTitular(int $id, string $nombre, string $puesto, string $link, int $status) {

        $this->intIdTitular     = $id;
        $this->strNombreTitular = $nombre;
        $this->strPuesto        = $puesto;
        $this->strLinkTesoreria = $link;
        $this->intStatus        = $status;

        if($this->intIdTitular == 0) {

            $query_insert = "INSERT INTO titular_transparencia(nombre, puesto, link, status) VALUES (?,?,?,?)";
            $arrData = array($this->strNombreTitular,
                             $this->strPuesto,
                             $this->strLinkTesoreria,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);
            
        } else {

            $query_insert = "UPDATE titular_transparencia SET nombre = ?, puesto = ?, link = ?, status = ? WHERE idtitular = $this->intIdTitular";
            $arrData = array($this->strNombreTitular,
                             $this->strPuesto,
                             $this->strLinkTesoreria,
                             $this->intStatus);
            $request = $this->update($query_insert, $arrData);

        }
        return $request;

    }

    public function selectTitular($id) {
    
        $this->intIdTitular = $id;
        $sql = "SELECT idtitular, nombre, puesto, link, status
                FROM titular_transparencia
                WHERE idtitular = {$this->intIdTitular} AND status != 0";
        $request = $this->select($sql);
        return $request;
        
    }

}