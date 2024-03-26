<?php

require_once('Libraries/Core/Mysql.php');

trait TDataGral {

    private $con;

    public function getSlidersHome() {
        $this->con = new Mysql();

        $sql = "SELECT idslider,
                       titulo,
                       link,
                       imagen,
                       orden,
                       statusslider
                FROM sliders
                WHERE statusslider = 1
                ORDER BY CASE WHEN orden = 0 THEN 1 ELSE 0 END, orden ASC";
        $request = $this->con->select_all($sql);
        return $request;

    }

    public function getPaquetesHome() {
        $this->con = new Mysql();

        $sql = "SELECT titulo, descripcion, link, imagen_bkg, imagen_animal, status FROM paquetes_home WHERE status = 1";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getDataPageNoticias() {
        $this->con = new Mysql();

        $sql = "SELECT idpagenoticia,
                       titulo_pagenoticia,
                       namespecie_pagenoticia,
                       namescie_pagenoticia,
                       portada_pagenoticia,
                       parallax_pagenoticia,
                       statuspagenoticia
                FROM page_noticias
                WHERE statuspagenoticia = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getDataHistory() {
        $this->con = new Mysql();

        $sql = "SELECT idhistoria,
                       titulo_historia,
                       antecedentes_h,
                       descripcion_h,
                       portada_historia,
                       titulo_animales_h,
                       numero_animales_h,
                       titulo_especies_h,
                       numero_especies_h,
                       titulo_personas_h,
                       numero_personas_h,
                       titulo_contamos_h,
                       descripcion_contamos_h,
                       portada_contamos_h,
                       parallax_uno,
                       parallax_dos,
                       statushistoria
                FROM historia
                WHERE statushistoria = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getDataPrivacidad() {
        $this->con = new Mysql();

        $sql = "SELECT idprivacidad,
                       titulo_privacidad,
                       descripcion_privacidad,
                       portada_privacidad,
                       name_espe_priv,
                       name_scie_priv,
                       parallax_privacidad,
                       statusprivacidad
                FROM politica_privacidad
                WHERE statusprivacidad = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getDataReglamento() {
        $this->con = new Mysql();

        $sql = "SELECT idpagereglamento,
                       titulo_pagereglamento,
                       namespecie_pagereglamento,
                       namescie_pagereglamento,
                       portada_pagereglamento,
                       parallax_pagereglamento,
                       statuspagereglamento
                FROM page_reglamento
                WHERE statuspagereglamento = 1";
        $request = $this->con->select($sql);
        return $request;
    }
    
    public function getDataReglas() {
        $this->con = new Mysql();

        $sql = "SELECT idreglamento,
                       descripcion_reglamento,
                       image_reglamento,
                       statusreglamento
                FROM reglamento
                WHERE statusreglamento = 1";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getDataFAQS() {
        $this->con = new Mysql();

        $sql = "SELECT idfaq, pregunta_faq, respuesta_faq, statusfaq FROM faqs WHERE statusfaq = 1";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getDataPageFAQS() {
        $this->con = new Mysql();

        $sql = "SELECT idpagefaqs,
                       titulo_pagefaqs,
                       namespecie_pagefaqs,
                       namescie_pagefaqs,
                       portada_pagefaqs,
                       parallax_pagefaqs,
                       statuspagefaqs
                FROM page_faqs
                WHERE statuspagefaqs = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function setContacto(string $nombre, string $tel, string $email, string $asunto, string $mensaje, string $ip, string $dispositivo, string $useragent) {

		$this->con = new Mysql();

		$nombre  	   = $nombre != '' ? $nombre : '';
		$tel           = $tel != '' ? $tel : '';
		$email 		   = $email != '' ? $email : '';
		$asunto	   	   = $asunto != '' ? $asunto : '';
		$mensaje	   = $mensaje != '' ? $mensaje : '';
		$ip 		   = $ip != '' ? $ip : '';
		$dispositivo   = $dispositivo != '' ? $dispositivo : '';
		$useragent	   = $useragent != '' ? $useragent : '';
		
		$query_insert  = "INSERT INTO contactanos(nombre, telefono, email, asunto, mensaje, ip, dispositivo, useragent) VALUES (?,?,?,?,?,?,?,?)";
		$arrData = array($nombre, $tel, $email, $asunto, $mensaje, $ip, $dispositivo, $useragent);
		$request_insert = $this->con->insert($query_insert, $arrData);
		return $request_insert;

	}

    public function getDataPageContacto() {
        $this->con = new Mysql();

        $sql = "SELECT idpagecontacto, titulo_pagecontacto, namespecie_pagecontacto, namescie_pagecontacto, portada_pagecontacto, parallax_pagecontacto, statuspagecontacto
                FROM page_contacto
                WHERE statuspagecontacto = 1";
        $request = $this->con->select($sql);
        return $request;
    }

    public function getDataInfoGral() {
        $this->con = new Mysql();

        $sql = "SELECT id,
                       dias_cierre,
                       dias_apertura,
                       horario_apertura,
                       horario_cierre,
                       img_parallax_uno,
                       name_especieinfogral,
                       name_scieninfogral,
                       img_parallax_dos,
                       img_acreditaciones,
                       title_contacto,
                       telefono,
                       email,
                       direccion,
                       title_transporte,
                       linea_uno,
                       desc_linea_uno,
                       linea_dos,
                       desc_linea_dos,
                       facebook,
                       instagram,
                       twitter,
                       youtube,
                       tiktok,
                       statusinfogral
                FROM page_infogral
                WHERE statusinfogral != 0";
        $request = $this->con->select($sql);
        return $request;
    }

    public function setVisitas(int $evento, string $nombre, string $nomEmpr, int $estado, int $municipio, string $tel, string $cel, string $email, string $npersonas, string $fechaHr, string $asunto, string $mensaje, string $ip, string $dispositivo, string $useragent) {

		$this->con = new Mysql();

		$evento  	   = $evento != '' ? $evento : '';
		$nombre  	   = $nombre != '' ? $nombre : '';
		$nombreEmpr	   = $nomEmpr != '' ? $nomEmpr : '';
		$estado  	   = $estado != '' ? $estado : '';
		$municipio 	   = $municipio != '' ? $municipio : '';
		$tel           = $tel != '' ? $tel : '';
		$cel           = $cel != '' ? $cel : '';
		$email 		   = $email != '' ? $email : '';
		$npersonas	   = $npersonas != '' ? $npersonas : '';
		$fechaHr	   = $fechaHr != '' ? $fechaHr : '';
		$asunto	   	   = $asunto != '' ? $asunto : '';
		$mensaje	   = $mensaje != '' ? $mensaje : '';
		$ip 		   = $ip != '' ? $ip : '';
		$dispositivo   = $dispositivo != '' ? $dispositivo : '';
		$useragent	   = $useragent != '' ? $useragent : '';
        $medio_contact = 3; // Medio contacto email
		
		$query_insert  = "INSERT INTO planea_visita(tipo_evento, nombre, nombre_empresa, estado, municipio, telefono, celular, email, num_personas, fecha_horario, asunto, mensaje, ip, dispositivo, useragent, medio_contacto) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$arrData = array($evento, $nombre, $nombreEmpr, $estado, $municipio, $tel, $cel, $email, $npersonas, $fechaHr, $asunto, $mensaje, $ip, $dispositivo, $useragent, $medio_contact);
		$request_insert = $this->con->insert($query_insert, $arrData);
		return $request_insert;

	}

}