<?php
    headerSite($data);

    $dataAcercade = $data['page_acercade'];

    if (!empty($dataAcercade)):
        $portada = media().'images/uploads/'.$dataAcercade['portada'];
        $parallax = media().'images/uploads/'.$dataAcercade['parallax1'];
        $parallax2 = media().'images/uploads/'.$dataAcercade['parallax2'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="">
                    </div>
                    <div class="holder historia d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $dataAcercade['titulo']; ?></h1>
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
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $dataAcercade['titulo']; ?></h1>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 text-center d-flex flex-column align-items-center" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <div class="e-borde"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mision" class="mision">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-8" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1><?= $dataAcercade['titulo_mision'] ?></h1>
                        <?= $dataAcercade['mision'] ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax; ?>');"></div>

        <section id="vision" class="vision">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-8" data-aos="zoom-in" data-aos-offset="250" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <h1><?= $dataAcercade['titulo_vision']; ?></h1>
                        <?= $dataAcercade['vision']; ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax2; ?>');">
            <div class="holder-contact"></div>
        </div>

        <section id="valores" class="valores">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-8" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1><?= $dataAcercade['titulo_valores'] ?></h1>
                        <?= $dataAcercade['valores']; ?>
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