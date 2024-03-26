<?php

require_once('Libraries/Core/Mysql.php');

trait TNacimientos {

    private $con;
    private $intIdNacimiento;
    private $strRuta;

    public function getDataPage() {
        $this->con = new Mysql();

        $sql = "SELECT idpagenacimientos,
                       titulo,
                       name_especie,
                       name_cientifico,
                       portada,
                       parallax,
                       status
                FROM page_nacimientos
                WHERE status = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getDataNacimientos() {
        $this->con = new Mysql();

        $sql = "SELECT n.idnacimiento,
                       n.nombre_especie,
                       n.nombre_cientifico,
                       n.fecha_nacimiento,
                       n.galeria,
                       n.ruta,
                       c.nombre_categoria
                FROM nacimientos n INNER JOIN categoria c 
                ON n.categoria = c.idcategoria
                WHERE n.status = 1";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getDataNacimiento(int $id, string $ruta) {
        $this->con = new Mysql();
        $this->intIdNacimiento = $id;
        $this->strRuta = $ruta;

        $sql = "SELECT n.nombre_especie,
                       n.nombre_cientifico,
                       n.fecha_nacimiento,
                       n.descripcion,
                       n.portada,
                       n.galeria,
                       n.ruta,
                       n.status
                FROM nacimientos n INNER JOIN categoria c
                ON n.categoria = c.idcategoria
                WHERE n.status = 1 AND n.idnacimiento = {$this->intIdNacimiento} AND n.ruta = '{$this->strRuta}'";
        $request = $this->con->select($sql);
        return $request;
    }

}