<?php

    class PageejemplaresModel extends Mysql {

        private $intIdPageEjemplar;
        private $strImgPortada;
        private $strTitulo;
        private $strNameEspecie;
        private $strNameScie;
        private $strImgParallax;
        private $strNameEspecie2;
        private $strNameScie2;
        private $strImgParallax2;
        private $strNameEspecie3;
        private $strNameScie3;
        private $strImgParallax3;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertDataPageEjemplares(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, string $nespecie2, string $nscien2, string $parallax2, string $nespecie3, string $nscien3, string $parallax3, int $status) {
            $this->intIdPageEjemplar = $id;
            $this->strTitulo         = $titulo;
            $this->strNameEspecie    = $name_espe;
            $this->strNameScie       = $name_scie;
            $this->strImgPortada     = $portada;
            $this->strImgParallax    = $portada_parallax;
            $this->strNameEspecie2   = $nespecie2;
            $this->strNameScie2      = $nscien2;
            $this->strImgParallax2   = $parallax2;
            $this->strNameEspecie3   = $nespecie3;
            $this->strNameScie3      = $nscien3;
            $this->strImgParallax3   = $parallax3;
            $this->intStatus         = $status;

            if($this->intIdPageEjemplar <= 0) {

                $query_insert = "INSERT INTO page_ejemplares(titulo_pageejemplares, namespecie_pageejemplares, namescie_pageejemplares, portada_pageejemplares, parallax_pageejemplares, namespecie2, namescie2, parallax2, namespecie3, namescie3, parallax3, statuspageejemplares) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImgPortada,
                                 $this->strImgParallax,
                                 $this->strNameEspecie2,
                                 $this->strNameScie2,
                                 $this->strImgParallax2,
                                 $this->strNameEspecie3,
                                 $this->strNameScie3,
                                 $this->strImgParallax3,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE page_ejemplares SET titulo_pageejemplares = ?, namespecie_pageejemplares = ?, namescie_pageejemplares = ?, portada_pageejemplares = ?, parallax_pageejemplares = ?, namespecie2 = ?, namescie2 = ?, parallax2 = ?, namespecie3 = ?, namescie3 = ?, parallax3 = ?, statuspageejemplares = ? WHERE idpageejemplares = $this->intIdPageEjemplar";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImgPortada,
                                 $this->strImgParallax,
                                 $this->strNameEspecie2,
                                 $this->strNameScie2,
                                 $this->strImgParallax2,
                                 $this->strNameEspecie3,
                                 $this->strNameScie3,
                                 $this->strImgParallax3,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;
        }

        public function selectDataPageEjemplares($id) {
            $this->intIdPageEjemplar = $id;
            if ($this->intIdPageEjemplar != null) {
                $sql = "SELECT idpageejemplares, titulo_pageejemplares, namespecie_pageejemplares, namescie_pageejemplares, portada_pageejemplares, parallax_pageejemplares, namespecie2, namescie2, parallax2, namespecie3, namescie3, parallax3, statuspageejemplares FROM page_ejemplares WHERE idpageejemplares = $this->intIdPageEjemplar";
            } else {
                $sql = "SELECT idpageejemplares, titulo_pageejemplares, namespecie_pageejemplares, namescie_pageejemplares, portada_pageejemplares, parallax_pageejemplares, namespecie2, namescie2, parallax2, namespecie3, namescie3, parallax3, statuspageejemplares FROM page_ejemplares";
            }

            $request = $this->select($sql);
            return $request;
        }
    }