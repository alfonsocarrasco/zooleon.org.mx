<?php

    class EventosModel extends Mysql {

        private $intIdAtraccion;
        private $strTitulo;
        private $strRuta;
        private $strDescripcion;
        private $strImg;
        private $strDias;
        private $strDias2;
        private $strCosto;
        private $strCosto2;
        private $strCosto3;
        private $strHorarioA;
        private $strHorarioC;
        private $strHorarioA2;
        private $strHorarioC2;
        private $intPosicion;
        private $intStatus;

        // Página atracciones
        private $strNameEspecie;
        private $strNameScie;
        private $strImgParallax;

        public function __construct() {
            parent::__construct();
        }

        public function insertAtraccion(int $id, string $titulo, string $ruta, string $descripcion, string $img, string $dias, string $dias2, string $costo, string $costo2, string $costo3, string $horarioA, string $horarioC, string $horarioA2, string $horarioC2, int $orden, int $status) {

            $this->intIdAtraccion = $id;
            $this->strTitulo      = $titulo;
            $this->strRuta        = $ruta;
            $this->strDescripcion = $descripcion;
            $this->strImg         = $img;
            $this->strDias        = $dias;
            $this->strDias2       = $dias2;
            $this->strCosto       = $costo;
            $this->strCosto2      = $costo2;
            $this->strCosto3      = $costo3;
            $this->strHorarioA    = $horarioA;
            $this->strHorarioC    = $horarioC;
            $this->strHorarioA2   = $horarioA2;
            $this->strHorarioC2   = $horarioC2;
            $this->intPosicion    = $orden;
            $this->intStatus      = $status;

            if($this->intIdAtraccion <= 0) {

                $query_insert = "INSERT INTO atracciones(titulo, ruta, descripcion, imagen, dia_apertura, dia_apertura_2, costo, costo2, costo3, horarioa, horarioc, horarioa2, horarioc2, orden, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strRuta,
                                 $this->strDescripcion,
                                 $this->strImg,
                                 $this->strDias,
                                 $this->strDias2,
                                 $this->strCosto,
                                 $this->strCosto2,
                                 $this->strCosto3,
                                 $this->strHorarioA,
                                 $this->strHorarioC,
                                 $this->strHorarioA2,
                                 $this->strHorarioC2,
                                 $this->intPosicion,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE atracciones SET titulo = ?, ruta = ?, descripcion = ?, imagen = ?, dia_apertura = ?, dia_apertura_2 = ?, costo = ?, costo2 = ?, costo3 = ?, horarioa = ?, horarioc = ?, horarioa2 = ?, horarioc2 = ?, orden = ?, status = ? WHERE idatracciones = $this->intIdAtraccion";
                $arrData = array($this->strTitulo,
                                 $this->strRuta,
                                 $this->strDescripcion,
                                 $this->strImg,
                                 $this->strDias,
                                 $this->strDias2,
                                 $this->strCosto,
                                 $this->strCosto2,
                                 $this->strCosto3,
                                 $this->strHorarioA,
                                 $this->strHorarioC,
                                 $this->strHorarioA2,
                                 $this->strHorarioC2,
                                 $this->intPosicion,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectAtracciones() {
            $sql = "SELECT idatracciones, titulo, descripcion, imagen, dia_apertura, dia_apertura_2, costo, costo2, costo3, horarioa, horarioc, horarioa2, horarioc2, orden, status FROM atracciones WHERE status != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectAtraccion(int $id) {
            $this->intIdAtraccion = $id;
            $sql = "SELECT idatracciones, titulo, descripcion, imagen, dia_apertura, dia_apertura_2, costo, costo2, costo3, horarioa, horarioc, horarioa2, horarioc2, orden, status FROM atracciones WHERE idatracciones = $this->intIdAtraccion";
            $request = $this->select($sql);
            return $request;
        }

        public function deleteAtraccion(int $id) {
            $this->intIdAtraccion = $id;

            $sql = "UPDATE atracciones SET status = ? WHERE idatracciones = $this->intIdAtraccion";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);

            if($request) {
                $request = 'ok';	
            } else {
                $request = 'error';
            }

            return $request;
        }

        public function insertDataPageAtracciones(int $id, string $titulo, string $contenido, string $portada, string $portada_parallax, string $name_espe, string $name_scie, int $status) {
            $this->intIdAtraccion         = $id;
            $this->strTitulo              = $titulo;
            $this->strDescripcion         = $contenido;
            $this->strImg                 = $portada;
            $this->strImgParallax         = $portada_parallax;
            $this->strNameEspecie         = $name_espe;
            $this->strNameScie            = $name_scie;
            $this->intStatus              = $status;

            if($this->intIdAtraccion <= 0) {

                $query_insert = "INSERT INTO page_atracciones(titulo, descripcion, portada_atracciones, parallax_atracciones, namespecie_atracciones, namescie_atracciones, statusatracciones) VALUES (?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strDescripcion,
                                 $this->strImg,
                                 $this->strImgParallax,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE page_atracciones SET titulo = ?, descripcion = ?, portada_atracciones = ?, parallax_atracciones = ?, namespecie_atracciones = ?, namescie_atracciones = ?, statusatracciones = ? WHERE idpageatracciones = $this->intIdAtraccion";
                $arrData = array($this->strTitulo,
                                 $this->strDescripcion,
                                 $this->strImg,
                                 $this->strImgParallax,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;
        }

        public function selectDataPageAtracciones($id) {
            $this->intIdAtraccion = $id;
            if ($this->intIdAtraccion != null) {
                $sql = "SELECT idpageatracciones, titulo, descripcion, portada_atracciones, parallax_atracciones, namespecie_atracciones, namescie_atracciones, statusatracciones FROM page_atracciones WHERE idpageatracciones = $this->intIdAtraccion";
            } else {
                $sql = "SELECT idpageatracciones, titulo, descripcion, portada_atracciones, parallax_atracciones, namespecie_atracciones, namescie_atracciones, statusatracciones FROM page_atracciones";
            }

            $request = $this->select($sql);
            return $request;
        }

    }