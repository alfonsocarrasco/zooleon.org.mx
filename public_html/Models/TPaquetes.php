<?php

require_once('Libraries/Core/Mysql.php');

trait TPaquetes {

    private $con;
	private $intIdPaquete;
	private $strRuta;

	public function getDataPagePaquetes() {
		$this->con = new Mysql();

		$sql = "SELECT titulo_pagepaquetes,
					   nameespecie_pagepaquetes,
					   namescie_pagepaquetes,
					   portada_pagepaquetes,
					   parallax_pagepaquetes,
					   statuspagepaquetes
				FROM page_paquetes
				WHERE statuspagepaquetes = 1";
		$request = $this->con->select($sql);
		return $request;
	}

    public function getPaquete($id, $ruta) {
        $this->con = new Mysql();
		$this->intIdPaquete = $id;
		$this->strRuta = $ruta;

        $sql = "SELECT idpaquete,
					   titulo,
					   descripcion,
					   descripcion_corta,
					   imagen,
					   link_ecommerce,
					   duracion,
					   horario,
					   ruta
				FROM paquetes
				WHERE (statuspaquete != 0 AND statuspaquete != 2) AND (idpaquete = {$this->intIdPaquete} AND ruta = '{$this->strRuta}')";
        $request = $this->con->select($sql);
        return $request;
    }

    public function countPaquetes() {
		$this->con = new Mysql();

		$sql = "SELECT COUNT(*) AS total_paquetes FROM paquetes WHERE statuspaquete = 1";
		$result_register = $this->con->select($sql);
		$total_registro = $result_register;
		return $total_registro;
	}

	public function getDataPaquetes($desde, $porpagina) {
        $this->con = new Mysql();

        $sql = "SELECT idpaquete,
                       titulo,
                       descripcion_corta,
					   imagen,
                       ruta
                FROM paquetes
                WHERE statuspaquete = 1
                ORDER BY idpaquete ASC LIMIT $desde, $porpagina";
        $request = $this->con->select_all($sql);
        return $request;
    }

}