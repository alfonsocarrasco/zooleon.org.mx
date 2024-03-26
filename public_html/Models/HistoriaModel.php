<?php

    class HistoriaModel extends Mysql {

        private $idHistoria;
        private $strTitulo;
        private $strAntecedentes;
        private $strDescripcion;
        private $strImgPortada;
        private $strTituloNumAnimals;
        private $strNumAnimals;
        private $strTituloNumEspecies;
        private $strNumEspecies;
        private $strTituloNumPersonas;
        private $strNumPersonas;
        private $strTituloContamos;
        private $strDescripcionContamos;
        private $strImgPortadaContamos;
        private $strImgParallax;
        private $strImgParallaxDos;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertDataHistoria(int $id, string $titulo, string $antecedentes, string $descripcion, string $portada, string $titleNumAnimals, string $numAnimal, string $titleNumEspecies, string $numEspecies, string $titleNumPersonas, string $numPersonas, string $titleContamos, string $descipcionContamos, string $portadaContamos, string $parallax, string $parallaxdos, int $status) {

            $this->idHistoria             = $id;
            $this->strTitulo              = $titulo;
            $this->strAntecedentes        = $antecedentes;
            $this->strDescripcion         = $descripcion;
            $this->strImgPortada          = $portada;
            $this->strTituloNumAnimals    = $titleNumAnimals;
            $this->strNumAnimals          = $numAnimal;
            $this->strTituloNumEspecies   = $titleNumEspecies;
            $this->strNumEspecies         = $numEspecies;
            $this->strTituloNumPersonas   = $titleNumPersonas;
            $this->strNumPersonas         = $numPersonas;
            $this->strTituloContamos      = $titleContamos;
            $this->strDescripcionContamos = $descipcionContamos;
            $this->strImgPortadaContamos  = $portadaContamos;
            $this->strImgParallax         = $parallax;
            $this->strImgParallaxDos      = $parallaxdos;
            $this->intStatus              = $status;

            if($this->idHistoria <= 0) {

                $query_insert = "INSERT INTO historia(titulo_historia, antecedentes_h, descripcion_h, portada_historia, titulo_animales_h, numero_animales_h, titulo_especies_h, numero_especies_h, titulo_personas_h, numero_personas_h, titulo_contamos_h, descripcion_contamos_h, portada_contamos_h, parallax_uno, parallax_dos, statushistoria) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strTitulo,
                                 $this->strAntecedentes,
                                 $this->strDescripcion,
                                 $this->strImgPortada,
                                 $this->strTituloNumAnimals,
                                 $this->strNumAnimals,
                                 $this->strTituloNumEspecies,
                                 $this->strNumEspecies,
                                 $this->strTituloNumPersonas,
                                 $this->strNumPersonas,
                                 $this->strTituloContamos,
                                 $this->strDescripcionContamos,
                                 $this->strImgPortadaContamos,
                                 $this->strImgParallax,
                                 $this->strImgParallaxDos,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE historia SET titulo_historia = ?, antecedentes_h = ?, descripcion_h = ?, portada_historia = ?, titulo_animales_h = ?, numero_animales_h = ?, titulo_especies_h = ?, numero_especies_h = ?, titulo_personas_h = ?, numero_personas_h = ?, titulo_contamos_h = ?, descripcion_contamos_h = ?, portada_contamos_h = ?, parallax_uno = ?, parallax_dos = ?, statushistoria = ? WHERE idhistoria = $this->idHistoria";
                $arrData = array($this->strTitulo,
                                 $this->strAntecedentes,
                                 $this->strDescripcion,
                                 $this->strImgPortada,
                                 $this->strTituloNumAnimals,
                                 $this->strNumAnimals,
                                 $this->strTituloNumEspecies,
                                 $this->strNumEspecies,
                                 $this->strTituloNumPersonas,
                                 $this->strNumPersonas,
                                 $this->strTituloContamos,
                                 $this->strDescripcionContamos,
                                 $this->strImgPortadaContamos,
                                 $this->strImgParallax,
                                 $this->strImgParallaxDos,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectDataHistoria($id) {

            $this->idHistoria = $id;
            if ($id != null) {
                $sql = "SELECT * FROM historia WHERE idhistoria = $this->idHistoria";
            } else {
                $sql = "SELECT * FROM historia";
            }

            $request = $this->select($sql);
            return $request;
        }

    }