<?php
    headerSite($data);
    $dataPagePaquetes = $data['site_paquetes'];
    $infoPaquete = $data['paquete'];
    
    if (!empty($infoPaquete) && !empty($dataPagePaquetes)):
        $portada_paquete = media().'images/uploads/'.$infoPaquete['imagen'];

        $portada_parallax = media().'images/uploads/'.$dataPagePaquetes['parallax_pagepaquetes'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada_paquete; ?>" alt="<?= $infoPaquete['titulo']; ?>">
                    </div>
                    <!-- <div class="holder d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $infoPaquete['titulo']; ?></h1>
                    </div> -->
                </div>
            </div>
            <div class="hero-shape">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                </svg>
            </div>
        </section>
        <!-- Main Slider -->

        <section id="blog-title" class="blog-title">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex flex-column align-items-center py-3">
                        <span class="icon-noticias" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500"></span>
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $infoPaquete['titulo']; ?></h1>
                    </div>
                    <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                </div>
            </div>
        </section>

        <section id="paquete" class="paquete">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 col-lg-9 pe-0 pe-lg-5 descripcion_nota" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <?= $infoPaquete['descripcion']; ?>
                    </div>
                    <div class="col-12 col-lg-3 detalles">
                    <h3>Detalles Rápidos</h3>
                        <ul class="categories">
                            <li><span class="title_details"><i class="fa-solid fa-hourglass-start"></i> Tiempo aproximado de visita: </span><?= $infoPaquete['duracion']; ?></li>
                            <?php if ($infoPaquete['horario'] !== ''): ?>
                                <li><span class="title_details"><i class="fa-solid fa-stopwatch"></i> Horario: </span> <?= $infoPaquete['horario']; ?></li>
                            <?php endif; ?>
                        </ul>
                        <?php if ($infoPaquete['link_ecommerce'] !== ''): ?>
                            <div class="btn-ecommerce">
                                <a href="<?= $infoPaquete['link_ecommerce']; ?>" class="link"><span>Reservar <i class="fa-solid fa-arrow-right-long"></i></span></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                    <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $dataPagePaquetes['nameespecie_pagepaquetes']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $dataPagePaquetes['namescie_pagepaquetes']; ?>)</h3>
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