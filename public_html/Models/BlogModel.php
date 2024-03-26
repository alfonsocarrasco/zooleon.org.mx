<?php

class BlogModel extends Mysql {

    private $intIdNoticia;
    private $intIdCategoria;
    private $strTituloNota;
    private $strDescripcionNota;
    private $strImg;
    private $strVideo;
    private $intStatus;

    private $idPageNoticia;
    private $strTitulo;
    private $strNameEspecie;
    private $strNameScie;
    private $strImgPortada;
    private $strImgParallax;

    public function __construct() {
        parent::__construct();
    }

    public function insertNoticia(int $idNota, int $idCat, string $titleNota, string $descripcion, string $imgPortada, string $ruta, string $video, string $fechaActual, int $intStatus) {

        $this->intIdNoticia = $idNota;
        $this->intIdCategoria = $idCat;
        $this->strTituloNota = $titleNota;
        $this->strDescripcionNota = $descripcion;
        $this->strImg = $imgPortada;
        $this->strRuta = $ruta;
        $this->strVideo = $video;
        $this->strFechaActual = $fechaActual;
        $this->intStatus = $intStatus;

        if($this->intIdNoticia <= 0) {

            $query_insert = "INSERT INTO blog(categoriaid_nota, titulo_nota, descripcion_nota, img_nota, ruta_nota, video_nota, fecha_nota, statusnota) VALUES (?,?,?,?,?,?,?,?)";
            $arrData = array($this->intIdCategoria,
                             $this->strTituloNota,
                             $this->strDescripcionNota,
                             $this->strImg,
                             $this->strRuta,
                             $this->strVideo,
                             $this->strFechaActual,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE blog SET categoriaid_nota = ?, titulo_nota = ?, descripcion_nota = ?, img_nota = ?, ruta_nota = ?, video_nota = ?, fecha_nota = ?, statusnota = ? WHERE idblog = $this->intIdNoticia";
            $arrData = array($this->intIdCategoria,
                             $this->strTituloNota,
                             $this->strDescripcionNota,
                             $this->strImg,
                             $this->strRuta,
                             $this->strVideo,
                             $this->strFechaActual,
                             $this->intStatus);
            $request = $this->update($sql, $arrData);

        }
        return $request;
    }

    public function selectNoticias() {
        $sql = "SELECT idblog, titulo_nota, descripcion_nota, img_nota, video_nota, fecha_nota, statusnota FROM blog WHERE statusnota != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectNota(int $id) {
        $this->intIdNoticia = $id;
        $sql = "SELECT idblog, categoriaid_nota, titulo_nota, descripcion_nota, img_nota, ruta_nota, video_nota, DATE_FORMAT(fecha_nota, '%Y-%m-%e') AS fecha_publicacion, statusnota FROM blog WHERE idblog = $this->intIdNoticia";
        $request = $this->select($sql);
        return $request;
    }

    public function deleteNoticia(int $id) {
        $this->intIdNoticia = $id;

        $sql = "UPDATE blog SET statusnota = ? WHERE idblog = $this->intIdNoticia";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);

        if($request) {
            $request = 'ok';	
        } else {
            $request = 'error';
        }

        return $request;
    }

    public function insertDataPageNoticias(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
        $this->idPageNoticia          = $id;
        $this->strTitulo              = $titulo;
        $this->strNameEspecie         = $name_espe;
        $this->strNameScie            = $name_scie;
        $this->strImgPortada          = $portada;
        $this->strImgParallax         = $portada_parallax;
        $this->intStatus              = $status;

        if($this->idPageNoticia <= 0) {

            $query_insert = "INSERT INTO page_noticias(titulo_pagenoticia, namespecie_pagenoticia, namescie_pagenoticia, portada_pagenoticia, parallax_pagenoticia, statuspagenoticia) VALUES (?,?,?,?,?,?)";
            $arrData = array($this->strTitulo,
                             $this->strNameEspecie,
                             $this->strNameScie,
                             $this->strImgPortada,
                             $this->strImgParallax,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE page_noticias SET titulo_pagenoticia = ?, namespecie_pagenoticia = ?, namescie_pagenoticia = ?, portada_pagenoticia = ?, parallax_pagenoticia = ?, statuspagenoticia = ? WHERE idpagenoticia = $this->idPageNoticia";
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

    public function selectDataPageNoticias($id) {
        $this->idPageNoticia = $id;
        if ($this->idPageNoticia != null) {
            $sql = "SELECT idpagenoticia, titulo_pagenoticia, namespecie_pagenoticia, namescie_pagenoticia, portada_pagenoticia, parallax_pagenoticia, statuspagenoticia FROM page_noticias WHERE idpagenoticia = $this->idPageNoticia";
        } else {
            $sql = "SELECT idpagenoticia, titulo_pagenoticia, namespecie_pagenoticia, namescie_pagenoticia, portada_pagenoticia, parallax_pagenoticia, statuspagenoticia FROM page_noticias";
        }

        $request = $this->select($sql);
        return $request;
    }
    
}