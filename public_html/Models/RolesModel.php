<?php

class RolesModel extends Mysql {

    public $intIdrol;
    public $strRol;
    public $strDescripcion;
    public $intStatus;

    public function __construct() {
        parent::__construct();
    }

    public function selectRoles(int $iduser) {
        $whereAdmin = '';
        if($iduser != 1) {
            $whereAdmin = " AND idrol != 1 ";
        }
        // Extrae información de la tabla roles
        $sql = 'SELECT * FROM rol WHERE statusrol != 0'.$whereAdmin;
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectRol(int $idrol) {
        // Busca Rol
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM rol WHERE idrol = $this->intIdrol";
        $request = $this->select($sql);
        return $request;
    }

    public function insertRol(string $rol, string $descripcion, int $status) {
        $return = '';
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM rol WHERE nombrerol = '{$this->strRol}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_insert = 'INSERT INTO rol(nombrerol, descripcion, statusrol) VALUES (?, ?, ?)';
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function updateRol($idrol, string $rol, string $descripcion, int $status) {
        $this->intIdrol = $idrol;
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM rol WHERE nombrerol = '$this->strRol' AND idrol != $this->intIdrol";
        $request = $this->select_all($sql);

        if(empty($request)) {
            $sql = "UPDATE rol SET nombrerol = ?, descripcion = ?, statusrol = ? WHERE idrol = $this->intIdrol";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    public function deleteRol(int $idrol) {
        $this->intIdrol = $idrol;
        // Busca el rol a eliminar
        $sql = "SELECT * FROM usuarios WHERE rolid = $this->intIdrol";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE rol SET status = ? WHERE idrol = $this->intIdrol";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            if ($request) {
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