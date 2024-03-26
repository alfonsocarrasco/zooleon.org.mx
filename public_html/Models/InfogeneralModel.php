<?php

    class InfogeneralModel extends Mysql {

        private $intIdInfoGral;
        private $strDiasCierre;
        private $strDiasApertura;
        private $strHorarioA;
        private $strHorarioC;
        private $imgParallax;
        private $strNameEspecie;
        private $strNameScie;
        private $strParallaxD;
        private $strImgAcredita;
        private $strTituloContacto;
        private $strTel;
        private $strMail;
        private $strDireccion;
        private $strTituloTransporte;
        private $strTituloLineaU;
        private $strDescLineaU;
        private $strTituloLineaD;
        private $strDescLineaD;
        private $strFace;
        private $strInsta;
        private $strTwit;
        private $strYoutube;
        private $strTikTok;
        private $intStatus;

        public function __construct() {
            parent::__construct();
        }

        public function insertDataInfoGral(int $id, string $diasCierre, string $diasApertura, string $horarioA, string $horarioC, string $imgParallax, string $nameEspecie, string $nameScie, string $imgParallaxDos, string $imgAcredita, string $titulo_c, string $tel, string $mail, string $direccion, string $title_t, string $linea_u, string $desc_lineau, string $linea_d, string $desc_linead, string $face, string $insta, string $twit, string $youtube, string $tikTok, int $status) {

            $this->intIdInfoGral       = $id;
            $this->strDiasCierre       = $diasCierre;
            $this->strDiasApertura     = $diasApertura;
            $this->strHorarioA         = $horarioA;
            $this->strHorarioC         = $horarioC;
            $this->imgParallax         = $imgParallax;
            $this->strNameEspecie      = $nameEspecie;
            $this->strNameScie         = $nameScie;
            $this->strParallaxD        = $imgParallaxDos;
            $this->strImgAcredita      = $imgAcredita;
            $this->strTituloContacto   = $titulo_c;
            $this->strTel              = $tel;
            $this->strMail             = $mail;
            $this->strDireccion        = $direccion;
            $this->strTituloTransporte = $title_t;
            $this->strTituloLineaU     = $linea_u;
            $this->strDescLineaU       = $desc_lineau;
            $this->strTituloLineaD     = $linea_d;
            $this->strDescLineaD       = $desc_linead;
            $this->strFace             = $face;
            $this->strInsta            = $insta;
            $this->strTwit             = $twit;
            $this->strYoutube          = $youtube;
            $this->strTikTok           = $tikTok;
            $this->intStatus           = $status;

            if($this->intIdInfoGral <= 0) {

                $query_insert = "INSERT INTO page_infogral(dias_cierre, dias_apertura, horario_apertura, horario_cierre, img_parallax_uno, name_especieinfogral, name_scieninfogral, img_parallax_dos, img_acreditaciones, title_contacto, telefono, email, direccion, title_transporte, linea_uno, desc_linea_uno, linea_dos, desc_linea_dos, facebook, instagram, twitter, youtube, tiktok, statusinfogral) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($this->strDiasCierre,
                                 $this->strDiasApertura,
                                 $this->strHorarioA,
                                 $this->strHorarioC,
                                 $this->imgParallax,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strParallaxD,
                                 $this->strImgAcredita,
                                 $this->strTituloContacto,
                                 $this->strTel,
                                 $this->strMail,
                                 $this->strDireccion,
                                 $this->strTituloTransporte,
                                 $this->strTituloLineaU,
                                 $this->strDescLineaU,
                                 $this->strTituloLineaD,
                                 $this->strDescLineaD,
                                 $this->strFace,
                                 $this->strInsta,
                                 $this->strTwit,
                                 $this->strYoutube,
                                 $this->strTikTok,
                                 $this->intStatus);
                $request = $this->insert($query_insert, $arrData);
    
            } else {
    
                $sql = "UPDATE page_infogral SET dias_cierre = ?, dias_apertura = ?, horario_apertura = ?, horario_cierre = ?, img_parallax_uno = ?, name_especieinfogral = ?, name_scieninfogral = ?, img_parallax_dos = ?, img_acreditaciones = ?, title_contacto = ?, telefono = ?, email = ?, direccion = ?, title_transporte = ?, linea_uno = ?, desc_linea_uno = ?, linea_dos = ?, desc_linea_dos = ?, facebook = ?, instagram = ?, twitter = ?, youtube = ?, tiktok = ?, statusinfogral = ? WHERE id = $this->intIdInfoGral";
                $arrData = array($this->strDiasCierre,
                                 $this->strDiasApertura,
                                 $this->strHorarioA,
                                 $this->strHorarioC,
                                 $this->imgParallax,
                                 $this->strNameEspecie,
                                 $this->strNameScie,
                                 $this->strParallaxD,
                                 $this->strImgAcredita,
                                 $this->strTituloContacto,
                                 $this->strTel,
                                 $this->strMail,
                                 $this->strDireccion,
                                 $this->strTituloTransporte,
                                 $this->strTituloLineaU,
                                 $this->strDescLineaU,
                                 $this->strTituloLineaD,
                                 $this->strDescLineaD,
                                 $this->strFace,
                                 $this->strInsta,
                                 $this->strTwit,
                                 $this->strYoutube,
                                 $this->strTikTok,
                                 $this->intStatus);
                $request = $this->update($sql, $arrData);
    
            }
            return $request;

        }

        public function selectDataInfoGral($id) {

            $this->intIdInfoGral = $id;
            if ($id != null) {
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
                        WHERE id = $this->intIdInfoGral";
            } else {
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
                        FROM page_infogral";
            }

            $request = $this->select($sql);
            return $request;
        }

    }