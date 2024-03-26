<?php

require_once('Libraries/Core/Mysql.php');

trait TAtracciones {

    private $con;
    private $intIdAtraccion;
    private $strRuta;

    public function getPageAtracciones() {
        $this->con = new Mysql();

        $sql = "SELECT idpageatracciones,
                       titulo,
                       descripcion,
                       portada_atracciones,
                       parallax_atracciones,
                       namespecie_atracciones,
                       namescie_atracciones,
                       statusatracciones
                FROM page_atracciones WHERE statusatracciones = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getAtracciones() {
        $this->con = new Mysql();

        $sql = "SELECT idatracciones,
                       titulo,
                       ruta,
                       imagen
                FROM atracciones WHERE status = 1 ORDER BY orden DESC";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getAtraccion(int $id, string $ruta) {
        $this->con = new Mysql();
        $this->intIdAtraccion = $id;
        $this->strRuta = $ruta;

        $sql = "SELECT idatracciones,
                       titulo,
                       ruta,
                       descripcion,
                       imagen,
                       dia_apertura,
                       dia_apertura_2,
                       costo,
                       costo2,
                       costo3,
                       horarioa,
                       horarioc,
                       horarioa2,
                       horarioc2
                FROM atracciones WHERE idatracciones = $this->intIdAtraccion AND status = 1";
        $request = $this->con->select($sql);
        return $request;
    }
}