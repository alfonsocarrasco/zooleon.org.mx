<?php
require_once('Libraries/Core/Mysql.php');

trait TNoticias {

    private $con;
    private $intIdEspecie;
    private $strRuta;

    public function getDataNoticias($desde, $porpagina, $categoria) {
        $this->con = new Mysql();

        $sql = "SELECT b.idblog,
                       b.categoriaid_nota,
                       b.titulo_nota,
                       b.descripcion_nota,
                       b.img_nota,
                       b.ruta_nota,
                       b.statusnota,
                       c.nombre_categoria AS categoria
                FROM blog b
                INNER JOIN categoria c 
                ON b.categoriaid_nota = c.idcategoria
                WHERE b.categoriaid_nota = $categoria AND b.statusnota = 1
                ORDER BY b.idblog ASC LIMIT $desde, $porpagina";
        $request = $this->con->select_all($sql);
        return $request;
    }

    public function getInfoNoticia(int $id, string $ruta) {
        $this->con = new Mysql();
        $this->intIdEspecie = $id;
        $this->strRuta = $ruta;

        $sql = "SELECT b.idblog,
                       b.categoriaid_nota,
                       b.titulo_nota,
                       b.descripcion_nota,
                       b.img_nota,
                       b.ruta_nota,
                       b.video_nota,
                       b.fecha_nota,
                       b.statusnota,
                       c.nombre_categoria
                FROM blog b INNER JOIN categoria c
                ON b.categoriaid_nota = c.idcategoria
                WHERE b.statusnota = 1 AND b.idblog = {$this->intIdEspecie} AND b.ruta_nota = '{$this->strRuta}'";
        $request = $this->con->select($sql);
        return $request;
    }

    public function cantNoticias($categoria = null) {
		$where = "";
		if($categoria != null){
			$where = " AND categoriaid_nota = ".$categoria;
		}
		$this->con = new Mysql();
		$sql = "SELECT COUNT(*) AS total_noticias FROM blog WHERE statusnota = 1".$where;
		$result_register = $this->con->select($sql);
		$total_registro = $result_register;
		return $total_registro;
	}

    public function getInfoNoticiasHome($categoria = null, $limit) {

        $where = "";
		if($categoria != null){
			$where = " AND b.categoriaid_nota = ".$categoria;
		}

        $this->con = new Mysql();

        $sql = "SELECT b.idblog,
                       b.categoriaid_nota,
                       b.titulo_nota,
                       b.descripcion_nota,
                       b.img_nota,
                       b.ruta_nota,
                       b.statusnota,
                       c.nombre_categoria AS categoria
                FROM blog b
                INNER JOIN categoria c 
                ON b.categoriaid_nota = c.idcategoria
                WHERE b.statusnota = 1 $where ORDER BY b.idblog DESC LIMIT $limit";
        $request = $this->con->select_all($sql);
        return $request;
    }

}