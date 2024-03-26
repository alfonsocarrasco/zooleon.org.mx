<?php

class EjemplaresModel extends Mysql {

    private $intIdEspecie;
    private $intCategoria;
    private $strNombreEspecie;
    private $strNombreCientifico;
    private $strImgHabitat;
    private $strPortada;
    private $strImgSabias;
    private $strImgTamanio;
    private $strImgAlimentacion;
    private $strImgPeso;
    private $strImgDistribucion;
    private $arrayGaleria;
    private $strImgConservacion;
    private $strVideo;
    private $strTitleVideo;
    private $strImgUbicacion;
    private $strCoordX;
    private $strCoordY;
    private $strRuta;
    private $intOrden;
    private $intStatus;
    
    public function __construct() {
        parent::__construct();
    }

    public function insertEjemplar(int $idEspecie, int $categoria, string $nombreEjemplar, string $nombreCientifico, string $imgHabitat, string $portada, string $imgSabias, string $imgTamanio, string $imgAlimentacion, string $imgPeso, string $imgDistribucion, string $galeria, string $imgConservacion, string $video, string $tituloVideo, string $imgUbicacion, string $x, string $y, string $ruta, int $orden, int $status) {

        $this->intIdEspecie        = $idEspecie;
        $this->intCategoria        = $categoria;
        $this->strNombreEspecie    = $nombreEjemplar;
        $this->strNombreCientifico = $nombreCientifico;
        $this->strImgHabitat       = $imgHabitat;
        $this->strPortada          = $portada;
        $this->strImgSabias        = $imgSabias;
        $this->strImgTamanio       = $imgTamanio;
        $this->strImgAlimentacion  = $imgAlimentacion;
        $this->strImgPeso          = $imgPeso;
        $this->strImgDistribucion  = $imgDistribucion;
        $this->arrayGaleria        = $galeria;
        $this->strImgConservacion  = $imgConservacion;
        $this->strVideo            = $video;
        $this->strTitleVideo       = $tituloVideo;
        $this->strImgUbicacion     = $imgUbicacion;
        $this->strCoordX           = $x;
        $this->strCoordY           = $y;
        $this->strRuta             = $ruta;
        $this->intOrden            = $orden;
        $this->intStatus           = $status;

        if($this->intIdEspecie <= 0) {

            $query_insert = "INSERT INTO especies(categoriaid, nombre_especie, nombre_cientifico, imagen_habitat, portada_especie, imagen_sabias, imagen_tamanio, image_alimentacion, imagen_peso, image_distribucion, images_especie, image_conservacion, video_especie, titulo_video, ubicacion_img, coord_x, coord_y, ruta_especie, orden, statusespecie) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array($this->intCategoria,
                             $this->strNombreEspecie,
                             $this->strNombreCientifico,
                             $this->strImgHabitat,
                             $this->strPortada,
                             $this->strImgSabias,
                             $this->strImgTamanio,
                             $this->strImgAlimentacion,
                             $this->strImgPeso,
                             $this->strImgDistribucion,
                             $this->arrayGaleria,
                             $this->strImgConservacion,
                             $this->strVideo,
                             $this->strTitleVideo,
                             $this->strImgUbicacion,
                             $this->strCoordX,
                             $this->strCoordY,
                             $this->strRuta,
                             $this->intOrden,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE especies SET categoriaid = ?, nombre_especie = ?, nombre_cientifico = ?, imagen_habitat = ?, portada_especie = ?, imagen_sabias = ?, imagen_tamanio = ?, image_alimentacion = ?, imagen_peso = ?, image_distribucion = ?, images_especie = ?, image_conservacion = ?, video_especie = ?, titulo_video = ?, ubicacion_img = ?, coord_x = ?, coord_y = ?, ruta_especie = ?, orden = ?, statusespecie = ? WHERE idespecie = $this->intIdEspecie";
            $arrData = array($this->intCategoria,
                             $this->strNombreEspecie,
                             $this->strNombreCientifico,
                             $this->strImgHabitat,
                             $this->strPortada,
                             $this->strImgSabias,
                             $this->strImgTamanio,
                             $this->strImgAlimentacion,
                             $this->strImgPeso,
                             $this->strImgDistribucion,
                             $this->arrayGaleria,
                             $this->strImgConservacion,
                             $this->strVideo,
                             $this->strTitleVideo,
                             $this->strImgUbicacion,
                             $this->strCoordX,
                             $this->strCoordY,
                             $this->strRuta,
                             $this->intOrden,
                             $this->intStatus);
            $request = $this->update($sql, $arrData);

        }
        return $request;
    }

    public function selectEjemplares() {
        $sql = "SELECT idespecie, categoriaid, nombre_especie, nombre_cientifico, imagen_habitat, portada_especie, imagen_sabias, imagen_tamanio, image_alimentacion, imagen_peso, image_distribucion, images_especie, image_conservacion, video_especie, titulo_video, ubicacion_img, coord_x, coord_y, ruta_especie, orden, statusespecie FROM especies WHERE statusespecie != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectEjemplar(int $id) {
        $this->intIdEspecie = $id;
        $sql = "SELECT e.idespecie,
                       e.categoriaid,
                       c.nombre_categoria,
                       e.nombre_especie,
                       e.nombre_cientifico,
                       e.imagen_habitat,
                       e.portada_especie,
                       e.imagen_sabias,
                       e.imagen_tamanio,
                       e.image_alimentacion,
                       e.imagen_peso,
                       e.image_distribucion,
                       e.images_especie,
                       e.image_conservacion,
                       e.video_especie,
                       e.titulo_video,
                       e.ubicacion_img,
                       e.coord_x,
                       e.coord_y,
                       e.ruta_especie,
                       e.orden,
                       e.statusespecie
                FROM especies e INNER JOIN categoria c 
                ON c.idcategoria = e.categoriaid
                WHERE e.idespecie = $this->intIdEspecie";
        $request = $this->select($sql);
        return $request;
    }

    public function deleteEjemplar($id) {
        $this->intIdEspecie = $id;

        $sql = "UPDATE especies SET statusespecie = ? WHERE idespecie = $this->intIdEspecie";
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