<?php

class PagenacimientosModel extends Mysql {

    private $intIdPage;
	private $strTitulo;
	private $strNameEspecie;
	private $strNameScie;
	private	$strImgPortada;
	private $strImgParallax;
	private $intStatus;

    public function insertDataPage(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
		$this->intIdPage 		 = $id;
		$this->strTitulo      	 = $titulo;
		$this->strNameEspecie 	 = $name_espe;
		$this->strNameScie    	 = $name_scie;
		$this->strImgPortada  	 = $portada;
		$this->strImgParallax 	 = $portada_parallax;
		$this->intStatus      	 = $status;

		if($this->intIdPage <= 0) {

			$query_insert = "INSERT INTO page_nacimientos(titulo, name_especie, name_cientifico, portada, parallax, status) VALUES (?,?,?,?,?,?)";
			$arrData = array($this->strTitulo,
							 $this->strNameEspecie,
							 $this->strNameScie,
							 $this->strImgPortada,
							 $this->strImgParallax,
							 $this->intStatus);
			$request = $this->insert($query_insert, $arrData);

		} else {

			$sql = "UPDATE page_nacimientos SET titulo = ?, name_especie = ?, name_cientifico = ?, portada = ?, parallax = ?, status = ? WHERE idpagenacimientos = $this->intIdPage";
			$arrData = array($this->strTitulo,
							 $this->strNameEspecie,
							 $this->strNameScie,
							 $this->strImgPortada,
							 $this->strImgParallax,
							 $this->intStatus);
			$request = $this->update($sql, $arrData);

		}
		return $request;
	}

	public function selectDataPage($id) {
		$this->intIdPage = $id;
		if ($this->intIdPage != null) {
			$sql = "SELECT idpagenacimientos, titulo, name_especie, name_cientifico, portada, parallax, status FROM page_nacimientos WHERE idpagenacimientos = $this->intIdPage";
		} else {
			$sql = "SELECT idpagenacimientos, titulo, name_especie, name_cientifico, portada, parallax, status FROM page_nacimientos";
		}

		$request = $this->select($sql);
		return $request;
	}

}