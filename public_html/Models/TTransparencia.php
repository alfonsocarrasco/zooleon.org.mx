<?php

require_once('Libraries/Core/Mysql.php');

trait TTransparencia {

    private $con;
	private $intAnio;
	private $strFormato;

	public function getDataPageTransp() {
		$this->con = new Mysql();

		$sql = "SELECT titulo_pagetransparencia,
					   nameespecie_pagetransparencia,
					   namescie_pagetransparencia,
					   portada_pagetransparencia,
					   parallax_pagetransparencia,
					   statuspagetransparencia
				FROM page_transparencia
				WHERE statuspagetransparencia = 1";
		$request = $this->con->select($sql);
		return $request;
	}

	public function getArticulosTransp() {

		$this->con = new Mysql();

		$sql = "SELECT DISTINCT titulo, formato, anio FROM transparencia WHERE status = 1";
		$request = $this->con->select_all($sql);

		if (count($request) > 0) {
			for ($i=0; $i < count($request); $i++) {
				$sql = "SELECT DISTINCT formato, subtitulo, filePDF, fileXLS FROM transparencia WHERE titulo = '{$request[$i]['titulo']}' AND anio = 0000";
				$request[$i]['info'] = $this->con->select_all($sql);
			}
		}

		return $request;
	}

	public function getAniosBD() {
		$this->con = new Mysql();
			
		$sql = "SELECT anio FROM transparencia WHERE status = 1 AND anio != 0000 GROUP BY anio ORDER BY titulo DESC";
		$request = $this->con->select_all($sql);
		return $request;

	}

	public function getFormatoBD(int $anio) {
		$this->con = new Mysql();
		$this->intAnio = $anio;

		$sql = "SELECT formato FROM transparencia WHERE status = 1 AND anio = {$this->intAnio} AND anio != 0000 GROUP BY formato ORDER BY titulo DESC";
		$request = $this->con->select_all($sql);
		return $request;
	}

	public function getDataTransparencia(int $anio, string $formato) {

		$this->con = new Mysql();
		$this->intAnio = $anio;
		$this->strFormato = $formato;

		$sql = "SELECT subtitulo, filePDF, fileXLS from transparencia WHERE status = 1 AND anio = {$this->intAnio} AND formato = '{$this->strFormato}' AND anio != 0000";
		$request = $this->con->select_all($sql);
		return $request;
	}

	public function getResponsables() {
		$this->con = new Mysql();
		$sql = "SELECT nombre, link, imagen, status FROM responsables WHERE status != 0 AND status != 2";
		$request = $this->con->select_all($sql);
		return $request;
	}

	public function getTitular() {
		$this->con = new Mysql();
		$sql = "SELECT nombre, puesto, link, status FROM titular_transparencia WHERE status != 0 AND status != 2";
		$request = $this->con->select($sql);
		return $request;
	}

}