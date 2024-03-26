<?php

require_once('Libraries/Core/Mysql.php');

trait TAcercade {

    private $con;

    public function getDataCultura() {
		$this->con = new Mysql();

		$sql = "SELECT titulo,
                       portada,
                       mision,
                       titulo_mision,
                       vision,
                       titulo_vision,
                       valores,
                       titulo_valores,
                       parallax1,
                       parallax2,
                       statuscultura
				FROM cultura
				WHERE statuscultura = 1";
		$request = $this->con->select($sql);
		return $request;
	}

}