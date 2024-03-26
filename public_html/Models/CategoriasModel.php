<?php

class CategoriasModel extends Mysql {
    public $intIdcategoria;
    public $strCategoria;
    public $strDescripcion;
    public $intStatus;
    public $strPortada;
    public $strRuta;

    public function __construct()
    {
        parent::__construct();
    }

    public function inserCategoria(string $nombre, string $descripcion, string $portada, string $ruta, int $status) {

        $return = 0;
        $this->strCategoria = $nombre;
        $this->strDescripcion = $descripcion;
        $this->strPortada = $portada;
        $this->strRuta = $ruta;
        $this->intStatus = $status;

        $sql = "SELECT * FROM categoria WHERE nombre_categoria = '{$this->strCategoria}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert  = "INSERT INTO categoria(nombre_categoria, descripcion_categoria, portada_categoria, ruta_categoria, status_categoria) VALUES (?,?,?,?,?)";
            $arrData = array($this->strCategoria, 
                             $this->strDescripcion, 
                             $this->strPortada,
                             $this->strRuta, 
                             $this->intStatus);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function selectCategorias() {
        $sql = "SELECT * FROM categoria WHERE status_categoria != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCategoria(int $idcategoria) {
        $this->intIdcategoria = $idcategoria;
        $sql = "SELECT * FROM categoria WHERE idcategoria = $this->intIdcategoria";
        $request = $this->select($sql);
        return $request;
    }

    public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada, string $ruta, int $status) {
        $this->intIdcategoria = $idcategoria;
        $this->strCategoria = $categoria;
        $this->strDescripcion = $descripcion;
        $this->strPortada = $portada;
        $this->strRuta = $ruta;
        $this->intStatus = $status;

        $sql = "SELECT * FROM categoria WHERE nombre_categoria = '{$this->strCategoria}' AND idcategoria != $this->intIdcategoria";
        $request = $this->select_all($sql);

        if(empty($request)) {
            $sql = "UPDATE categoria SET nombre_categoria = ?, descripcion_categoria = ?, portada_categoria = ?, ruta_categoria = ?, status_categoria = ? WHERE idcategoria = $this->intIdcategoria";
            $arrData = array($this->strCategoria,
                             $this->strDescripcion,
                             $this->strPortada,
                             $this->strRuta,
                             $this->intStatus);
            $request = $this->update($sql,$arrData);
        } else {
            $request = "exist";
        }
        return $request;			
    }

    public function deleteCategoria(int $idcategoria) {
        $this->intIdcategoria = $idcategoria;
        $sql = "SELECT * FROM especies WHERE categoriaid = $this->intIdcategoria";
        $request = $this->select_all($sql);
        if(empty($request)) {
            $sql = "UPDATE categoria SET status_categoria = ? WHERE idcategoria = $this->intIdcategoria";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            if($request) {
                $request = 'ok';	
            } else {
                $request = 'error';
            }
        } else {
            $request = 'exist';
        }
        return $request;
    }
}