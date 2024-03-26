<?php

class UsuariosModel extends Mysql {
    
    private $intIdUsuario;
    private $intRolId;
    private $strNombre;
    private $strPrimerApellido;
    private $strSegundoApellido;
    private $strMail;
    private $strPassword;
    private $strImagen;
    private $strToken;
    private $intStatus;

    public function __construct() {
        parent::__construct();
    }

    public function insertUsuario(int $rolid, string $nombre, string $primerApellido, string $segundoApellido, string $email, string $password, string $img, int $status) {
        $this->intRolId   = $rolid;
        $this->strNombre   = $nombre;
        $this->strPrimerApellido  = $primerApellido;
        $this->strSegundoApellido  = $segundoApellido;
        $this->strMail     = $email;
        $this->strPassword = $password;
        $this->strImagen   = $img;
        $this->intStatus   = $status;
        $return = 0;

        $sql = "SELECT * FROM usuarios WHERE nameuser = '{$this->strMail}'";
        $request = $this->select_all($sql);

        if(empty($request)) {
            $query_insert = "INSERT INTO usuarios(rolid, nombre, primerapellido, segundoapellido, nameuser, password, imguser, statususer) VALUES (?,?,?,?,?,?,?,?)";
            $arrData = array($this->intRolId,
                             $this->strNombre,
                             $this->strPrimerApellido,
                             $this->strSegundoApellido,
                             $this->strMail,
                             $this->strPassword,
                             $this->strImagen,
                             $this->intStatus);
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = 'exist';
        }
        return $return;
    }

    public function selectUsuarios(int $iduser) {
        $whereAdmin = '';
        if($iduser != 1) { /* $_SESSION['idUser'] != 1 */
            $whereAdmin = " AND usr.iduser != 1";
        }
        // Extrae información de la tabla 'usuarios'
        $sql = "SELECT usr.iduser, usr.nombre, usr.primerapellido, usr.segundoapellido, usr.nameuser, usr.imguser, usr.statususer, r.idrol, r.nombrerol
                FROM usuarios usr
                INNER JOIN rol r ON usr.rolid = r.idrol
                WHERE usr.statususer != 0".$whereAdmin;
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectUsuario(int $iduser) {
        $this->intIdUsuario = $iduser;
        $sql = "SELECT usr.iduser, usr.nombre, usr.primerapellido, usr.segundoapellido, usr.nameuser, usr.imguser, usr.statususer, r.idrol, r.nombrerol, DATE_FORMAT(usr.datecreated, '%d-%m-%Y') as fechaRegistro FROM usuarios usr INNER JOIN rol r ON usr.rolid = r.idrol WHERE usr.iduser = $this->intIdUsuario AND usr.statususer != 0";
        $request = $this->select($sql);
        return $request;
    }

    public function updateUsuario(int $idUsuario, int $rolid, string $nombre, string $paterno, string $materno, string $email, string $password, string $img, int $status) {

        $this->intIdUsuario = $idUsuario;
        $this->intRolId = $rolid;
        $this->strNombre = $nombre;
        $this->strPrimerApellido = $paterno;
        $this->strSegundoApellido = $materno;
        $this->strMail = $email;
        $this->strPassword = $password;
        $this->strImagen = $img;
        $this->intStatus = $status;

        $sql = "SELECT * FROM usuarios WHERE (nameuser = '{$this->strMail}' AND iduser != $this->intIdUsuario)";
        $request = $this->select_all($sql);

        if(empty($request)) {
            if ($this->strPassword != '') {
                $sql = "UPDATE usuarios SET rolid=?, nombre=?, primerapellido=?, segundoapellido=?, nameuser=?, password=?, imguser=?, statususer=? WHERE iduser = $this->intIdUsuario";
                $arrData = array($this->intRolId,
                                 $this->strNombre,
                                 $this->strPrimerApellido,
                                 $this->strSegundoApellido,
                                 $this->strMail,
                                 $this->strPassword,
                                 $this->strImagen,
                                 $this->intStatus);
            } else {
                $sql = "UPDATE usuarios SET rolid=?, nombre=?, primerapellido=?, segundoapellido=?, nameuser=?, imguser=?, statususer=? WHERE iduser = $this->intIdUsuario";
                $arrData = array($this->intRolId,
                                 $this->strNombre,
                                 $this->strPrimerApellido,
                                 $this->strSegundoApellido,
                                 $this->strMail,
                                 $this->strImagen,
                                 $this->intStatus);
            }
            $request = $this->update($sql, $arrData);
        } else {
            $request = 'exist';
        }
        return $request;
    }
    
    public function deleteUsuario(int $idUsuario) {

        $this->intIdUsuario = $idUsuario;
        $sql = "UPDATE usuarios SET statususer = ? WHERE iduser = $this->intIdUsuario";
        $arrData = array(0);
        $request = $this->update($sql, $arrData);
        return $request;

    }

    public function updatePerfil(int $idUsuario, string $nombre, string $paterno, string $materno, string $password, string $img) {
        $this->intIdUsuario = $idUsuario;
        $this->strNombre = $nombre;
        $this->strPrimerApellido = $paterno;
        $this->strSegundoApellido = $materno;
        $this->strPassword = $password;
        $this->strImagen = $img;

        if($this->strPassword != '') {
            $sql = "UPDATE usuarios SET nombre=?, primerapellido=?, segundoapellido=?, password=?, imguser=? WHERE iduser = $this->intIdUsuario";
            $arrData = array($this->strNombre,
                             $this->strPrimerApellido,
                             $this->strSegundoApellido,
                             $this->strPassword,
                             $this->strImagen);
        } else {
            $sql = "UPDATE usuarios SET nombre=?, primerapellido=?, segundoapellido=?, imguser=? WHERE iduser = $this->intIdUsuario";
            $arrData = array($this->strNombre,
                             $this->strPrimerApellido,
                             $this->strSegundoApellido,
                             $this->strImagen);
        }
        $request = $this->update($sql, $arrData);
        return $request;
    }
}