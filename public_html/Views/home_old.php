<?php
    headerSite($data);

    $arrInfoGral = $data['infogral'];

    if ($arrInfoGral['statusinfogral'] != 2):
        $arrSliders  = $data['slider_home'];
        $arrHistoria = $data['historia_home'];
        $arrNoticiasHome = $data['noticias_home'];

        $portada_parallax01 = media().'images/uploads/'.$arrInfoGral['img_parallax_uno'];
        $portada_parallax02 = media().'images/uploads/'.$arrInfoGral['img_parallax_dos'];
        $portada_acreditaciones = media().'images/uploads/'.$arrInfoGral['img_acreditaciones'];

        $arrPaqueteHome = $data['paquetes_home'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="row">
                    <div class="col-xl-12 g-0">
                        <div id="main-slider">
                            <?php
                            if (count($arrSliders) > 0):
                                for ($i=0; $i < count($arrSliders); $i++):
                                    $tituloSlide = $arrSliders[$i]['titulo'];
                                    $enlaceSlide = $arrSliders[$i]['link'];
                                    $imagenSlide = media().'images/uploads/'.$arrSliders[$i]['imagen'];
                            ?>
                                    <div class="slide">
                                        <div class="caption">
                                            <div class="txt animate__animated" data-animation-in="animate__fadeInLeft" data-delay-in="0" data-animation-out="animate__fadeOutLeft" data-delay-out="3.5">
                                                <h1><?= $tituloSlide; ?></h1>
                                            </div>
                                            <div class="boton animate__animated" data-animation-in="animate__fadeInUp" data-delay-in="0.2" data-animation-out="animate__fadeOutDown" data-delay-out="3.3">
                                                <?php if ($enlaceSlide !== ''): ?>
                                                    <a href="<?= $enlaceSlide; ?>" class="btn-custom" target="_blank">
                                                        <span>Conocenos <i class="fa-solid fa-arrow-right-long"></i></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="slide-img">
                                            <img src="<?= $imagenSlide; ?>" alt="<?= $tituloSlide ?>">
                                        </div>
                                    </div>
                            <?php
                                    endfor;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-shape">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                </svg>
            </div>
        </section>
        <!-- Main Slider -->

        <section id="paquetes" class="paquetes">
            <div class="container-lg">
                <div class="row d-flex justify-content-center cards-paquetes">
                    <div class="col-12 mb-5" data-aos="fade-right" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1>Nuestros Paquetes</h1>
                        <h5>* No hay reembolsos por cuestiones climatológicas.</h5>
                    </div>
                    <?php for ($i=0; $i < count($arrPaqueteHome); $i++): ?>
                        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center" data-aos="flip-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                            <div class="card bg1" style="background-image: url('<?= media().'images/uploads/'.$arrPaqueteHome[$i]['imagen_bkg']; ?>');">
                                <div class="imgBx">
                                    <img src="<?= media().'images/uploads/'.$arrPaqueteHome[$i]['imagen_animal']; ?>">
                                </div>
                                <?php if ($i == 0) { $class = 'uno'; } else if ($i == 1) { $class = 'dos'; } else { $class = 'tres'; }  ?>
                                <div class="contentBx <?= $class; ?>">
                                    <div class="size <?= $class; ?>">
                                        <?php if ($i == 0): ?>
                                            <img src="<?= media(); ?>site/images/paquete_integral.svg" alt="">
                                        <?php elseif ($i == 1): ?>
                                            <img src="<?= media(); ?>site/images/paquete_zoo.svg" alt="">
                                        <?php else: ?>
                                            <img src="<?= media(); ?>site/images/paquete_safari.svg" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="color <?= $class; ?>">
                                        <h2>Incluye</h2>
                                        <?= $arrPaqueteHome[$i]['descripcion']; ?>
                                    </div>
                                    <a href="<?= $arrPaqueteHome[$i]['link'] ?>">Reservar</a>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax01; ?>">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrInfoGral['name_especieinfogral']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="900">(<?= $arrInfoGral['name_scieninfogral']; ?>)</h3>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($arrHistoria)): ?>
            <section class="historia">
                <div class="container-fluid g-0">
                    <div class="row">
                        <div class="col-xl-4 d-none d-xl-flex" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="800">
                            <img src="<?= media(); ?>site/images/img-historia.png" alt="Historia">
                        </div>
                        <div class="col-12 col-xl-8 d-flex flex-column justify-content-center txt-historia" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <h1>Historia</h1>
                            <?= $arrHistoria['antecedentes_h']; ?>
                            <div class="boton" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                                <a href="<?= base_url(); ?>zooleon" class="btn-custom">
                                    <span>Aprende Más <i class="fa-solid fa-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section id="conocenos" class="conocenos">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12" data-aos="fade-left" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1>Conoce el Parque</h1>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center" data-aos="flip-left" data-aos-duration="700" data-aos-offset="300">
                        <div class="cards">
                            <div class="cover">
                                <img src="<?= media(); ?>site/images/p1.png" alt="">
                                <div class="img__backuno"></div>
                            </div>
                            <div class="description">
                                <h2>Nuestras Atracciones</h2>
                                <a href="<?= base_url(); ?>atracciones"><span>Aprende Más <i class="fa-solid fa-arrow-right-long"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center" data-aos="flip-left" data-aos-duration="1100" data-aos-offset="300">
                        <div class="cards">
                            <div class="cover">
                                <img src="<?= media(); ?>site/images/p2.png" alt="">
                                <div class="img__backdos"></div>
                            </div>
                            <div class="description">
                                <h2>Nuestros Ejemplares</h2>
                                <a href="<?= base_url(); ?>especies"><span>Aprende Más <i class="fa-solid fa-arrow-right-long"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="300">
                        <div class="cards">
                            <div class="cover">
                                <img src="<?= media(); ?>site/images/p3.png" alt="">
                                <div class="img__backtres"></div>
                            </div>
                            <div class="description">
                                <h2>Nuestro Reglamento</h2>
                                <a href="<?= base_url(); ?>reglamento"><span>Aprende Más <i class="fa-solid fa-arrow-right-long"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="noticias" class="noticias">
            <div class="container-lg">
                <div class="row d-flex justify-content-center cards-noticias">
                    <div class="col-12 pb-5" data-aos="fade-right" data-aos-offset="200" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1>Noticias Relevantes</h1>
                    </div>
                    <?php
                    if(count($arrNoticiasHome) > 0):
                        $start = 0;
                        for ($i=0; $i < count($arrNoticiasHome); $i++):
                            $aosDuration = $start == 0 ? $start = 700 : $start += 400;
                            $portada_noticia = media().'images/uploads/noticias/'.$arrNoticiasHome[$i]['img_nota'];
                            $ruta_noticia = base_url().'noticias/noticia/'.$arrNoticiasHome[$i]['idblog'].'/'.$arrNoticiasHome[$i]['ruta_nota'];
                    ?>
                            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center" data-aos="flip-left" data-aos-duration="<?= $aosDuration; ?>" data-aos-offset="300">
                                <figure class="image-block">
                                    <img src="<?= $portada_noticia; ?>" alt="<?= $arrNoticiasHome[$i]['titulo_nota']; ?>" />
                                    <figcaption>
                                        <h4>
                                            <?= $arrNoticiasHome[$i]['titulo_nota']; ?>
                                        </h4>
                                        <div class="descripcion">
                                            <?= substr($arrNoticiasHome[$i]['descripcion_nota'], 0, 150).'[...]'; ?>
                                        </div>
                                        <a href="<?= $ruta_noticia; ?>"><span>Aprende Más <i class="fa-solid fa-arrow-right-long"></i></span></a>
                                    </figcaption>
                                </figure>
                            </div>
                    <?php
                        endfor;
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <div class="parallax01" style="background-image: url('<?= $portada_parallax02; ?>');">
            <div class="container-fluid g-0">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-en" data-aos="fade" data-aos-offset="100" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <img src="<?= media(); ?>site/images/parallax02_pattern.png" alt="Safari">
                    </div>
                </div>
            </div>
        </div>

        <section class="acreditaciones">
            <div class="container-fluid g-0">
                <div class="row g-0">                    
                    <div class="col-6 d-none d-md-flex d-xl-flex" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <img src="<?= $portada_acreditaciones; ?>" alt="Acreditaciones">
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center info" data-aos="flip-left" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="800">
                        <div class="info-acreditaciones">
                            <h2>Nuestras Acreditaciones</h2>
                            <div class="logos-acreditaciones">
                                <ul class="d-flex justify-content-center">
                                    <?php
                                        $arrAcreditaciones = getAcreditaciones();
                                        for ($i=0; $i < count($arrAcreditaciones); $i++):
                                            $imageAcreditacion = media().'images/uploads/'.$arrAcreditaciones[$i]['imagenacreditacion'];
                                    ?>
                                            <li class="d-flex align-items-center"><img src="<?= $imageAcreditacion; ?>" alt="<?= $arrAcreditaciones[$i]['nombreacreditacion']; ?>"></li>
                                    <?php
                                        endfor;
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="ubicacion">
            <div class="cotaniner-fluid">
                <div class="row">
                    <div class="col-md-12 col-xl-8 g-0">
                        <div class="mapa" id="mapa"></div>
                    </div>
                    <div class="col-md-12 col-xl-4 d-flex flex-column justify-content-center info-contacto">
                        <div class="datos-contacto" data-aos="fade-up" data-aos-duration="750" data-aos-anchor-placement="bottom-bottom">
                            <h3><?= $arrInfoGral['title_contacto']; ?></h3>
                            <div class="tel">
                                <i class="fa-solid fa-phone"></i> <?= $arrInfoGral['telefono']; ?>
                            </div>
                            <div class="mail"><i class="fa-solid fa-envelope"></i> <?= $arrInfoGral['email']; ?></div>
                            <div class="dir"><i class="fa-solid fa-location-dot"></i> <?= $arrInfoGral['direccion']; ?></div>
                        </div>
                        <div class="transporte" data-aos="fade-up" data-aos-duration="1000" data-aos-anchor-placement="bottom-bottom">
                            <h3><?= $arrInfoGral['title_transporte']; ?></h3>
                            <div class="linea">
                                <h4><i class="fa-solid fa-bus"></i> <?= $arrInfoGral['linea_uno']; ?></h4>
                                <p><?= $arrInfoGral['desc_linea_uno']; ?></p>
                            </div>
                            <div class="linea">
                                <h4><i class="fa-solid fa-bus"></i> <?= $arrInfoGral['linea_dos']; ?></h4>
                                <p><?= $arrInfoGral['desc_linea_dos']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    else:
        include_once('./Views/Mantenimiento/mantenimiento.php');
    endif;
    footerSite($data);
?>