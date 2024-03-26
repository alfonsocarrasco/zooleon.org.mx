<?php
    headerSite($data);

    $arrInfoAtracciones = $data['page_atracciones'];

    if (!empty($arrInfoAtracciones)):
        $arrAtracciones     = $data['atracciones'];
        $portada  = media().'images/uploads/'.$arrInfoAtracciones['portada_atracciones'];
        $parallax = media().'images/uploads/'.$arrInfoAtracciones['parallax_atracciones'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="Imagen atracciones">
                    </div>
                    <div class="holder d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
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

        <section id="blog-title reglamento" class="blog-title reglamento">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex flex-column align-items-center py-3">
                        <span class="icon-reglamento" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500"></span>
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrInfoAtracciones['titulo']; ?></h1>
                    </div>
                    <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                </div>
            </div>
        </section>

        <section id="atracciones" class="atracciones">
            <div class="container-lg">
                <div class="row">
                    <?php for ($i=0; $i < count($arrAtracciones); $i++): ?>
                        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-5 pb-5" data-aos="flip-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">
                            <article class="card_ej card--1">
                                <div class="card__img" style="background-image: url('<?= media().'images/uploads/'.$arrAtracciones[$i]['imagen']; ?>');"></div>
                                <a href="<?= base_url().'atracciones/atraccion/'.$arrAtracciones[$i]['idatracciones'].'/'.$arrAtracciones[$i]['ruta']; ?>" class="card_link">
                                    <div class="card__img--hover" style="background-image: url('<?= media().'images/uploads/'.$arrAtracciones[$i]['imagen']; ?>');"></div>
                                </a>
                                <div class="card__info">
                                    <h3 class="card__title"><?= $arrAtracciones[$i]['titulo']; ?></h3>
                                </div>
                            </article>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url(<?= $parallax; ?>">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $arrInfoAtracciones['namespecie_atracciones']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $arrInfoAtracciones['namescie_atracciones']; ?>)</h3>
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