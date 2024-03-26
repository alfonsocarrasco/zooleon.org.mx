<?php
    headerSite($data);
    $arrHistoria = $data['info_historia'];

    if (!empty($arrHistoria)):
        $portada = media().'images/uploads/'.$arrHistoria['portada_historia'];
        $portada_contamos = media().'images/uploads/'.$arrHistoria['portada_contamos_h'];
        $parallax1 = media().'images/uploads/'.$arrHistoria['parallax_uno'];
        $parallax2 = media().'images/uploads/'.$arrHistoria['parallax_dos'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="">
                    </div>
                    <div class="holder historia d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $data['page_name']; ?></h1>
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

        <section id="historia-title" class="historia-title">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex flex-column align-items-center">
                        <span class="icon-historia" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"></span>
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrHistoria['titulo_historia']; ?></h1>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 text-center d-flex flex-column align-items-center" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <div class="antecendente">
                            <?php $antecedente = substr($arrHistoria['antecedentes_h'], 0, 105); ?>
                            <p><?= $antecedente; ?></p>
                        </div>
                        <div class="e-borde"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax1; ?>');"></div>

        <div class="numeros-esp">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex flex-column align-items-center justify-content-center" data-aos="zoom-in" data-aos-offset="250" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <p><?= $arrHistoria['titulo_animales_h']; ?></p>
                        <h1><?= $arrHistoria['numero_animales_h']; ?></h1>
                    </div>
                    <div class="col-12 col-lg-4 d-flex flex-column align-items-center justify-content-center" data-aos="zoom-in" data-aos-offset="250" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <p><?= $arrHistoria['titulo_especies_h']; ?></p>
                        <h1><?= $arrHistoria['numero_especies_h']; ?></h1>
                    </div>
                    <div class="col-12 col-lg-4 d-flex flex-column align-items-center justify-content-center" data-aos="zoom-in" data-aos-offset="250" data-aos-easing="ease-in-sine" data-aos-duration="900">
                        <p><?= $arrHistoria['titulo_personas_h']; ?></p>
                        <h1><?= $arrHistoria['numero_personas_h']; ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax2; ?>');">
            <div class="holder-contact"></div>
        </div>

        <div class="historia-txt">
            <div class="container-lg">
                <div class="row">
                    <div class="col-lg-12 txt-history" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <?= $arrHistoria['descripcion_h']; ?>
                    </div>
                </div>
            </div>
        </div>

        <section id="contamos" class="contamos">
            <div class="container-fluid g-0">
                <div class="row">
                    <div class="col-12 col-lg-4 img-contamos" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <img src="<?= $portada_contamos; ?>" alt="" class="img-fluid">
                    </div>
                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-center txt-contamos">
                        <h1 data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrHistoria['titulo_contamos_h']; ?></h1>
                        <div class="e-borde" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"></div>
                        <div class="contamos-desc" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                            <?= $arrHistoria['descripcion_contamos_h']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    else:
        include_once('./Views/Mantenimiento/mantenimiento.php');
    endif;
    footerSite($data);
?>