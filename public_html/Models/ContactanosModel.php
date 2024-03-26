<?php

class ContactanosModel extends Mysql {

	private $intIdMsg;
	private $intIdPageContacto;
	private $strTitulo;
	private $strNameEspecie;
	private $strNameScie;
	private	$strImgPortada;
	private $strImgParallax;
	private $intStatus;

	public function selectContactos() {
		$sql = "SELECT idcontacto, nombre, telefono, email, asunto, DATE_FORMAT(datecreated, '%d/%m/%Y') AS fecha
				FROM contactanos";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMensaje(int $idmensaje) {
		$sql = "SELECT idcontacto, nombre, telefono, email, asunto, DATE_FORMAT(datecreated, '%d/%m/%Y') AS fecha, mensaje, ip, dispositivo, useragent FROM contactanos WHERE idcontacto = {$idmensaje}";
		$request = $this->select($sql);
		return $request;
	}

	public function deleteMsg(int $idmensaje) {

		$this->intIdMsg = $idmensaje;

		$sql = "DELETE FROM contactanos WHERE idcontacto = $this->intIdMsg";
		$request = $this->delete($sql);

		if($request) {
			$request = 'ok';	
		} else {
			$request = 'error';
		}

		return $request;

	}

	public function insertDataPageContactanos(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
		$this->intIdPageContacto = $id;
		$this->strTitulo      	 = $titulo;
		$this->strNameEspecie 	 = $name_espe;
		$this->strNameScie    	 = $name_scie;
		$this->strImgPortada  	 = $portada;
		$this->strImgParallax 	 = $portada_parallax;
		$this->intStatus      	 = $status;

		if($this->intIdPageContacto <= 0) {

			$query_insert = "INSERT INTO page_contacto(titulo_pagecontacto, namespecie_pagecontacto, namescie_pagecontacto, portada_pagecontacto, parallax_pagecontacto, statuspagecontacto) VALUES (?,?,?,?,?,?)";
			$arrData = array($this->strTitulo,
							 $this->strNameEspecie,
							 $this->strNameScie,
							 $this->strImgPortada,
							 $this->strImgParallax,
							 $this->intStatus);
			$request = $this->insert($query_insert, $arrData);

		} else {

			$sql = "UPDATE page_contacto SET titulo_pagecontacto = ?, namespecie_pagecontacto = ?, namescie_pagecontacto = ?, portada_pagecontacto = ?, parallax_pagecontacto = ?, statuspagecontacto = ? WHERE idpagecontacto = $this->intIdPageContacto";
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

	public function selectDataPageContactanos($id) {
		$this->intIdPageContacto = $id;
		if ($this->intIdPageContacto != null) {
			$sql = "SELECT idpagecontacto, titulo_pagecontacto, namespecie_pagecontacto, namescie_pagecontacto, portada_pagecontacto, parallax_pagecontacto, statuspagecontacto FROM page_contacto WHERE idpagecontacto = $this->intIdPageContacto";
		} else {
			$sql = "SELECT idpagecontacto, titulo_pagecontacto, namespecie_pagecontacto, namescie_pagecontacto, portada_pagecontacto, parallax_pagecontacto, statuspagecontacto FROM page_contacto";
		}

		$request = $this->select($sql);
		return $request;
	}

}