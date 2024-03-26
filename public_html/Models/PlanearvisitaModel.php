<?php

class PlanearvisitaModel extends Mysql {

	private $intIdMsg;
	private $intEvento;
	private $strNombre;
	private $strNombreEmpr;
	private $intEstado;
	private $intMunicipio;
	private $strTel;
	private $strCel;
	private $strEmail;
	private $strNumPers;
	private $strFechaHr;
	private $strAsunto;
	private $strMensaje;
	private $intMedio;
	private $intStatus;

	public function insertData(int $evento, string $nombre, string $nomEmpr, int $estado, int $municipio, string $tel, string $cel, string $email, string $npersonas, string $fechaHr, string $asunto, string $mensaje, int $medio, int $status) {

		$this->intEvento 	 = $evento;
		$this->strNombre 	 = $nombre;
		$this->strNombreEmpr = $nomEmpr;
		$this->intEstado	 = $estado;
		$this->intMunicipio  = $municipio;
		$this->strTel 		 = $tel;
		$this->strCel 		 = $cel;
		$this->strEmail 	 = $email;
		$this->strNumPers 	 = $npersonas;
		$this->strFechaHr 	 = $fechaHr;
		$this->strAsunto 	 = $asunto;
		$this->strMensaje 	 = $mensaje;
		$this->intMedio		 = $medio;
		$this->intStatus  	 = $status;

		$query_insert  = "INSERT INTO planea_visita(tipo_evento, nombre, nombre_empresa, estado, municipio, telefono, celular, email, num_personas, fecha_horario, asunto, mensaje, medio_contacto, status_seguimiento) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$arrData = array($this->intEvento,
						 $this->strNombre,
						 $this->strNombreEmpr,
						 $this->intEstado,
						 $this->intMunicipio,
						 $this->strTel,
						 $this->strCel,
						 $this->strEmail,
						 $this->strNumPers,
						 $this->strFechaHr,
						 $this->strAsunto,
						 $this->strMensaje,
						 $this->intMedio,
						 $this->intStatus);
		$request_insert = $this->insert($query_insert, $arrData);
		return $request_insert;
	}

    public function updateData(int $id, string $fechaHr, int $medio, int $status_seg) {

        $this->intIdMsg  = $id;
		$this->strFechaHr = $fechaHr;
		$this->intMedio = $medio;
        $this->intStatus = $status_seg;

        $sql = "UPDATE planea_visita SET fecha_horario = ?, medio_contacto = ?, status_seguimiento = ? WHERE idplanea = $this->intIdMsg";
        $arrData = array($this->strFechaHr,
						 $this->intMedio,
						 $this->intStatus);
        $request = $this->update($sql, $arrData);
        return $request;

    }

	public function selectEventsDate() {
		$sql = "SELECT idplanea AS id,
				CASE
					WHEN tipo_evento = 1 THEN 'Escolar'
					WHEN tipo_evento = 2 THEN 'Empresarial'
					ELSE 'Fiesta Infantil'
				END AS title,
				CASE
					WHEN tipo_evento = 1 THEN '#009E3A'
					WHEN tipo_evento = 2 THEN '#E5007E'
					ELSE '#532569'
				END AS color,
					   nombre,
					   fecha_horario AS start
				FROM planea_visita WHERE status != 0";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMensajes() {
		$sql = "SELECT idplanea,
				CASE
					WHEN tipo_evento = 1 THEN 'Escolar'
					WHEN tipo_evento = 2 THEN 'Empresarial'
					ELSE 'Fiesta Infantil'
				END AS evento,
					   nombre,
					   email,
					   asunto,
					   status_seguimiento,
					   DATE_FORMAT(datecreated, '%d/%m/%Y') AS fecha,
					   CASE
						   WHEN medio_contacto = 1 THEN 'Telefónico'
						   WHEN medio_contacto = 2 THEN 'Presencial'
						   ELSE 'Formulario Web'
					   END AS medio_contacto
				FROM planea_visita WHERE status != 0";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMensaje(int $id) {
        
        $this->intIdMsg = $id;

		$sql = "SELECT pv.idplanea,
					   pv.tipo_evento,
					   pv.nombre,
					   pv.nombre_empresa,
					   e.nombre AS nombre_estado,
					   m.nombre AS nombre_municipio,
					   pv.estado,
					   pv.municipio,
					   pv.telefono,
					   pv.celular,
					   pv.email,
					   pv.num_personas,
					   pv.fecha_horario,
					   pv.asunto,
					   pv.mensaje,
					   pv.ip,
					   pv.dispositivo,
					   pv.useragent,
					   pv.medio_contacto,
				CASE
					WHEN medio_contacto = 1 THEN 'Telefónico'
					WHEN medio_contacto = 2 THEN 'Presencial'
					ELSE 'Formulario Web'
				END AS medio,
					   pv.status_seguimiento,
				CASE 
					WHEN pv.status_seguimiento = 1 THEN 'Informes'
					WHEN pv.status_seguimiento = 2 THEN 'Reservación'
					WHEN pv.status_seguimiento = 3 THEN 'Cancelación'
					ELSE 'Visita'
				END AS seguimiento,
					DATE_FORMAT(datecreated, '%d/%m/%Y') AS fecha
				FROM planea_visita pv
				INNER JOIN estados e ON pv.estado = e.id
				INNER JOIN municipios m ON pv.municipio = m.id
				WHERE idplanea = $this->intIdMsg";
		$request = $this->select($sql);
		return $request;

	}

	public function deleteMsg(int $id) {

		$this->intIdMsg = $id;

		$sql = "UPDATE planea_visita SET status = ? WHERE idplanea = $this->intIdMsg";
        $arrData = array(0);
		$request = $this->update($sql, $arrData);

		if($request) {
			$request = 'ok';	
		} else {
			$request = 'error';
		}

		return $request;

	}

}