<?php

require_once('Libraries/Core/Mysql.php');

trait TEspecies {

    private $con;
    private $intIdEspecie;
    private $strRuta;

    public function getDataInfoEspecies() {
        $this->con = new Mysql();

        $sql = "SELECT idpageejemplares,
                       titulo_pageejemplares,
                       namespecie_pageejemplares,
                       namescie_pageejemplares,
                       portada_pageejemplares,
                       parallax_pageejemplares,
                       namespecie2,
                       namescie2,
                       parallax2,
                       namespecie3,
                       namescie3,
                       parallax3,
                       statuspageejemplares
                FROM page_ejemplares
                WHERE statuspageejemplares = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getDataEspecies() {
        $this->con = new Mysql();

        $sql = "SELECT esp.idespecie,
                       esp.categoriaid,
                       esp.nombre_especie,
                       esp.nombre_cientifico,
                       esp.portada_especie,
                       esp.images_especie,
                       esp.coord_x,
                       esp.coord_y,
                       esp.ruta_especie,
                       esp.statusespecie,
                       c.nombre_categoria,
                       IFNULL(esp.orden, 3) AS orden
                FROM especies esp
                INNER JOIN categoria c ON esp.categoriaid = c.idcategoria
                WHERE esp.statusespecie = 1 ORDER BY orden ASC, FIELD(c.nombre_categoria, 'Mamíferos','Aves','Reptiles')";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getInfoEspecie(int $id, string $ruta) {
        $this->con = new Mysql();
        $this->intIdEspecie = $id;
        $this->strRuta = $ruta;

        $sql = "SELECT esp.idespecie,
                       esp.categoriaid,
                       esp.nombre_especie,
                       esp.nombre_cientifico,
                       esp.imagen_habitat,
                       esp.portada_especie,
                       esp.imagen_sabias,
                       esp.imagen_tamanio,
                       esp.image_alimentacion,
                       esp.imagen_peso,
                       esp.image_distribucion,
                       esp.images_especie,
                       esp.image_conservacion,
                       esp.video_especie,
                       esp.titulo_video,
                       esp.ubicacion_img,
                       esp.ruta_especie,
                       esp.statusespecie,
                       c.nombre_categoria
                FROM especies esp INNER JOIN categoria c
                ON esp.categoriaid = c.idcategoria
                WHERE esp.statusespecie = 1 AND esp.idespecie = {$this->intIdEspecie} AND esp.ruta_especie = '{$this->strRuta}'";
        $request = $this->con->select($sql);
        return $request;
    }

}
