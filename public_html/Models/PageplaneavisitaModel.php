<?php

class PageplaneavisitaModel extends Mysql {

    private $intIdPage;
	private $strTitulo;
	private $strFrase;
	private $strNameEspecie;
	private $strNameScie;
	private	$strImgPortada;
	private $strImgParallax;
	private $intStatus;

    public function insertDataPage(int $id, string $titulo, string $frase, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
		$this->intIdPage 		 = $id;
		$this->strTitulo      	 = $titulo;
		$this->strFrase			 = $frase;
		$this->strNameEspecie 	 = $name_espe;
		$this->strNameScie    	 = $name_scie;
		$this->strImgPortada  	 = $portada;
		$this->strImgParallax 	 = $portada_parallax;
		$this->intStatus      	 = $status;

		if($this->intIdPage <= 0) {

			$query_insert = "INSERT INTO page_planea_visita(titulo_pageplanea, frase, namespecie_pageplanea, namescie_pageplanea, portada_pageplanea, parallax_pageplanea, statuspageplanea) VALUES (?,?,?,?,?,?,?)";
			$arrData = array($this->strTitulo,
							 $this->strFrase,
							 $this->strNameEspecie,
							 $this->strNameScie,
							 $this->strImgPortada,
							 $this->strImgParallax,
							 $this->intStatus);
			$request = $this->insert($query_insert, $arrData);

		} else {

			$sql = "UPDATE page_planea_visita SET titulo_pageplanea = ?, frase = ?, namespecie_pageplanea = ?, namescie_pageplanea = ?, portada_pageplanea = ?, parallax_pageplanea = ?, statuspageplanea = ? WHERE idpageplanea = $this->intIdPage";
			$arrData = array($this->strTitulo,
							 $this->strFrase,
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
			$sql = "SELECT idpageplanea, titulo_pageplanea, frase, namespecie_pageplanea, namescie_pageplanea, portada_pageplanea, parallax_pageplanea, statuspageplanea FROM page_planea_visita WHERE idpageplanea = $this->intIdPage";
		} else {
			$sql = "SELECT idpageplanea, titulo_pageplanea, frase, namespecie_pageplanea, namescie_pageplanea, portada_pageplanea, parallax_pageplanea, statuspageplanea FROM page_planea_visita";
		}

		$request = $this->select($sql);
		return $request;
	}

}