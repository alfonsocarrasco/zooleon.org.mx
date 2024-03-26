<?php 

class LoginModel extends Mysql {

	private $intIdUsuario;
    private $strUsuario;
    private $strPassword;
    private $strToken;
    private $idSesion;

	public function __construct() {
		parent::__construct();
	}

	public function loginUser(string $usuario, string $password) {

		$this->strUsuario = $usuario;
		$this->strPassword = $password;

		$sql = "SELECT usr.iduser, usr.statususer, rl.statusrol, rl.idrol
				FROM usuarios usr INNER JOIN rol rl ON usr.rolid = rl.idrol
				WHERE usr.nameuser = '$this->strUsuario'
				AND usr.password = '$this->strPassword'
				AND usr.statususer != 0";
		$request = $this->select($sql);
		return $request;

	}

	public function setSesionID(int $idUser, string $id_sesion) {
        $this->intIdUsuario = $idUser;
        $this->idSesion     = $id_sesion;
        $sql = "UPDATE usuarios SET idsession = ? WHERE iduser = $this->intIdUsuario";
        $arrData = array($this->idSesion);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function getSesionID(int $idUser) {
        $this->intIdUsuario = $idUser;
        $sql = "SELECT idsession FROM usuarios WHERE iduser = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }

	public function sessionLogin(int $iduser) {
        $this->intIdUsuario = $iduser;
        // Busca rol
        $sql = "SELECT usr.iduser, usr.nombre, usr.primerapellido, usr.segundoapellido, usr.nameuser, usr.imguser, usr.idsession, usr.statususer, r.idrol, r.nombrerol 
                FROM usuarios usr 
                INNER JOIN rol r 
                ON usr.rolid = r.idrol 
                WHERE usr.iduser = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }

    public function getUserEmail(string $email) {
        $this->strMail = $email;
        $sql = "SELECT iduser, nombre, primerapellido, segundoapellido
                FROM usuarios
                WHERE nameuser = '$this->strMail'";
        $request = $this->select($sql);
        return $request;
    }

    public function setTokenUser(int $iduser, string $token) {
        $this->intIdUsuario = $iduser;
        $this->strToken = $token; 

        $sql = "UPDATE usuarios SET tokenuser = ? WHERE iduser = $this->intIdUsuario";
        $arrData = array($this->strToken);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function getUsuario(string $email, string $token) {
        $this->strMail = $email;
        $this->strToken = $token;
        $sql = "SELECT iduser FROM usuarios WHERE nameuser = '$this->strMail' AND tokenuser = '$this->strToken'";
        $request = $this->select($sql);
        return $request;
    }

    public function insertPassword(int $iduser, string $password) {
        $this->intIdUsuario = $iduser;
        $this->strPassword = $password;
        $sql = "UPDATE usuarios SET password = ?, tokenuser = ? WHERE iduser = $this->intIdUsuario";
        $arrData = array($this->strPassword, '');
        $request = $this->update($sql, $arrData);
        return $request;
    }
	
}