<?php

    class DashboardModel extends Mysql {

        public function __construct() {
            parent::__construct();
        }

        public function cantUsuarios() {
            $sql = "SELECT COUNT(*) AS Total FROM usuarios WHERE statususer != 0";
            $request = $this->select($sql);
            $total = $request['Total'];
            return $total;
        }

        public function cantCategorias() {
            $sql = "SELECT COUNT(*) AS Total FROM categoria WHERE status_categoria != 0";
            $request = $this->select($sql);
            $total = $request['Total'];
            return $total;
        }
        
        public function cantEspecies() {
            $sql = "SELECT COUNT(*) AS Total FROM especies WHERE statusespecie != 0";
            $request = $this->select($sql);
            $total = $request['Total'];
            return $total;
        }

        public function cantNoticias() {
            $sql = "SELECT COUNT(*) AS Total FROM blog WHERE statusnota != 0";
            $request = $this->select($sql);
            $total = $request['Total'];
            return $total;
        }

        public function cantPaquetes() {
            $sql = "SELECT COUNT(*) AS Total FROM paquetes WHERE statuspaquete != 0";
            $request = $this->select($sql);
            $total = $request['Total'];
            return $total;
        }

        public function lastMessage()
        {
            $sql = "SELECT idcontacto, nombre, email, asunto, DATE_FORMAT(datecreated, '%d/%m/%Y') AS fecha FROM contactanos ORDER BY idcontacto DESC LIMIT 10";
            $request = $this->select_all($sql);
            return $request;
        }
    }