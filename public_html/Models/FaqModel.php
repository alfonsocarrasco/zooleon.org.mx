<?php

    class FaqModel extends Mysql {

        private $intIdFAQ;
        private $strPregunta;
        private $strRespuesta;
        private $strImgPortada;
        private $strTitulo;
        private $strNameEspecie;
        private $strNameScie;
        private $strImgParallax;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertFAQ(int $id, string $pregunta, string $respuesta, int $status) {

            $this->intIdFAQ     = $id;
            $this->strPregunta  = $pregunta;
            $this->strRespuesta = $respuesta;
            $this->intStatus    = $status;

            if($this->intIdFAQ <= 0) {

                $query_insert = "INSERT INTO faqs(pregunta_faq, respuesta_faq, statusfaq) VALUES (?,?,?)";
                $arrData = array($this->strPregunta,
                                 $this->strRespuesta,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE faqs SET pregunta_faq = ?, respuesta_faq = ?, statusfaq = ? WHERE idfaq = $this->intIdFAQ";
                $arrData = array($this->strPregunta,
                                 $this->strRespuesta,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectFAQS() {
            $sql = "SELECT idfaq, pregunta_faq, respuesta_faq, statusfaq FROM faqs WHERE statusfaq != 0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectFAQ(int $id) {
            $this->intIdFAQ = $id;
            $sql = "SELECT idfaq, pregunta_faq, respuesta_faq, statusfaq FROM faqs WHERE idfaq = $this->intIdFAQ";
            $request = $this->select($sql);
            return $request;
        }

        public function delFAQ(int $id) {
            $this->intIdFAQ = $id;

            $sql = "UPDATE faqs SET statusfaq = ? WHERE idfaq = $this->intIdFAQ";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);

            if($request) {
                $request = 'ok';	
            } else {
                $request = 'error';
            }

            return $request;
        }

        public function insertDataPageFAQS(int $id, string $titulo, string $name_espe, string $name_scie, string $portada, string $portada_parallax, int $status) {
            $this->intIdFAQ       = $id;
            $this->strTitulo      = $titulo;
            $this->strNameEspecie = $name_espe;
            $this->strNameScie    = $name_scie;
            $this->strImgPortada  = $portada;
            $this->strImgParallax = $portada_parallax;
            $this->intStatus      = $status;

            if($this->intIdFAQ <= 0) {

                $query_insert = "INSERT INTO page_faqs(titulo_pagefaqs, namespecie_pagefaqs, namescie_pagefaqs, portada_pagefaqs, parallax_pagefaqs, statuspagefaqs) VALUES (?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strImgPortada,
                                 $this->strImgParallax,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE page_faqs SET titulo_pagefaqs = ?, namespecie_pagefaqs = ?, namescie_pagefaqs = ?, portada_pagefaqs = ?, parallax_pagefaqs = ?, statuspagefaqs = ? WHERE idpagefaqs = $this->intIdFAQ";
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

        public function selectDataPageFAQS($id) {
            $this->intIdFAQ = $id;
            if ($this->intIdFAQ != null) {
                $sql = "SELECT idpagefaqs, titulo_pagefaqs, namespecie_pagefaqs, namescie_pagefaqs, portada_pagefaqs, parallax_pagefaqs, statuspagefaqs FROM page_faqs WHERE idpagefaqs = $this->intIdFAQ";
            } else {
                $sql = "SELECT idpagefaqs, titulo_pagefaqs, namespecie_pagefaqs, namescie_pagefaqs, portada_pagefaqs, parallax_pagefaqs, statuspagefaqs FROM page_faqs";
            }

            $request = $this->select($sql);
            return $request;
        }
    }