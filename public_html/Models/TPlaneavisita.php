<?php

require_once('Libraries/Core/Mysql.php');

trait TPlaneavisita {

    private $con;

    public function loadEstados($id = null) {
        $this->con = new Mysql();

        $whereEstado = '';
        if($id != null) {
            $whereEstado = " WHERE id = $id";
        }

        $sql = "SELECT id, nombre FROM estados".$whereEstado;
        $request = $this->con->select_all($sql);
        return $request;
    }
    
    public function loadMunicipios($id, $id_municipio = null) {
        $this->con = new Mysql();

        $whereMunicipio = '';
        if($id_municipio != null) {
            $whereMunicipio = " AND id = $id_municipio";
        }

        $sql = "SELECT id, nombre FROM municipios WHERE estado_id = $id".$whereMunicipio;
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getDataPage() {
		$this->con = new Mysql();

		$sql = "SELECT titulo_pageplanea,
                       frase,
					   namespecie_pageplanea,
					   namescie_pageplanea,
					   portada_pageplanea,
					   parallax_pageplanea,
					   statuspageplanea
				FROM page_planea_visita
				WHERE statuspageplanea = 1";
		$request = $this->con->select($sql);
		return $request;
	}

}