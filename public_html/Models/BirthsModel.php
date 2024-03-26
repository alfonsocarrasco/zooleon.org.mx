<?php

class BirthsModel extends Mysql {

    private $intIdNacimiento;
    private $strNombreEspecie;
    private $strNombreCientifico;
    private $strFechaNacimiento;
    private $strDescripcionNacimiento;
    private $strPortada;
    private $arrayGaleria;
    private $strRuta;
    private $intCategoria;
    private $intStatus;
    
    public function __construct() {
        parent::__construct();
    }

    public function insertData(int $id, string $nombre, string $nombreCientifico, string $fecha, string $descripcion, string $portada, string $galeria, string $ruta, int $categoria, int $status) {

        $this->intIdNacimiento          = $id;
        $this->strNombreEspecie         = $nombre;
        $this->strNombreCientifico      = $nombreCientifico;
        $this->strFechaNacimiento       = $fecha;
        $this->strDescripcionNacimiento = $descripcion;
        $this->strPortada               = $portada;
        $this->arrayGaleria             = $galeria;
        $this->strRuta                  = $ruta;
        $this->intCategoria             = $categoria;
        $this->intStatus                = $status;

        if($this->intIdNacimiento == 0) {

            $query_insert = "INSERT INTO nacimientos(nombre_especie, nombre_cientifico, fecha_nacimiento, descripcion, portada, galeria, ruta, categoria, status) VALUES (?,?,?,?,?,?,?,?,?)";
            $arrData = array($this->strNombreEspecie,
                             $this->strNombreCientifico,
                             $this->strFechaNacimiento,
                             $this->strDescripcionNacimiento,
                             $this->strPortada,
                             $this->arrayGaleria,
                             $this->strRuta,
                             $this->intCategoria,
                             $this->intStatus);
            $request = $this->insert($query_insert, $arrData);

        } else {

            $sql = "UPDATE nacimientos SET nombre_especie = ?, nombre_cientifico = ?, fecha_nacimiento = ?, descripcion = ?, portada = ?, galeria = ?, ruta = ?, categoria = ?, status = ? WHERE idnacimiento = $this->intIdNacimiento";
            $arrData = array($this->strNombreEspecie,
                             $this->strNombreCientifico,
                             $this->strFechaNacimiento,
                             $this->strDescripcionNacimiento,
                             $this->strPortada,
                             $this->arrayGaleria,
                             $this->strRuta,
                             $this->intCategoria,
                             $this->intStatus);
            $request = $this->update($sql, $arrData);

        }
        return $request;
    }

    public function selectData() {
        $sql = "SELECT idnacimiento, nombre_especie, nombre_cientifico, fecha_nacimiento, descripcion, portada, galeria, ruta, categoria, status FROM nacimientos WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectNacimiento(int $id) {
        $this->intIdNacimiento = $id;
        $sql = "SELECT n.idnacimiento,
                       n.nombre_especie,
                       n.nombre_cientifico,
                       n.fecha_nacimiento,
                       n.descripcion,
                       n.portada,
                       n.galeria,
                       n.ruta,
                       n.categoria,
                       c.nombre_categoria,
                       n.status
                FROM nacimientos n INNER JOIN categoria c 
                ON c.idcategoria = n.categoria
                WHERE n.idnacimiento = $this->intIdNacimiento";
        $request = $this->select($sql);
        return $request;
    }

    public function deleteData($id) {
        $this->intIdNacimiento = $id;

        $sql = "UPDATE nacimientos SET status = ? WHERE idnacimiento = $this->intIdNacimiento";
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