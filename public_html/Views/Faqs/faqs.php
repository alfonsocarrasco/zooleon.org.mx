<?php
    headerSite($data);

    $arrInfoFaqs = $data['page_faqs'];

    if (!empty($arrInfoFaqs)):
        $arrFaqs = $data['info_faqs'];
        $arrInfoContacto = $data['info_contacto'];
        $portada_parallax_contacto = media().'images/uploads/'.$arrInfoContacto['parallax_pagecontacto'];

        $portada = media().'images/uploads/'.$arrInfoFaqs['portada_pagefaqs'];
        $portada_parallax = media().'images/uploads/'.$arrInfoFaqs['parallax_pagefaqs'];

        $arrInfoGral = $data['infogral'];
        $portada_acreditaciones = media().'images/uploads/'.$arrInfoGral['img_acreditaciones'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="">
                    </div>
                    <div class="holder contact d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
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

        <section id="faqs-title" class="faqs-title">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex flex-column align-items-center py-3">
                        <span class="icon-faqs" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500"></span>
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrInfoFaqs['titulo_pagefaqs']; ?></h1>
                        <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="faqs" class="faqs">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="800">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <?php for ($i=0; $i < count($arrFaqs); $i++): ?>
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="flush-heading<?= $i; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $i; ?>">
                                            <?= $arrFaqs[$i]['pregunta_faq']; ?>
                                        </button>
                                    </h1>
                                    <div id="flush-collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $i; ?>" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body"><?= $arrFaqs[$i]['respuesta_faq'] ?></div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $arrInfoFaqs['namespecie_pagefaqs']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $arrInfoFaqs['namescie_pagefaqs']; ?>)</h3>
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
                            <h2>Nuestas Acreditaciones</h2>
                            <div class="logos-acreditaciones">
                                <ul class="d-flex justify-content-center">
                                    <?php
                                        $arrAcreditaciones = getAcreditaciones();
                                        for ($i=0; $i < count($arrAcreditaciones); $i++):
                                            $imageAcreditacion = media().'images/uploads/'.$arrAcreditaciones[$i]['imagenacreditacion'];
                                    ?>
                                            <li class="d-flex align-items-center"><img src="<?= $imageAcreditacion; ?>" alt="<?= $arrAcreditaciones[$i]['nombreacreditacion']; ?>" style="height: 115px;"></li>
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

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax_contacto; ?>');">
            <div class="holder-contact" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"></div>
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end parallax-holder">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $arrInfoContacto['namespecie_pagecontacto']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $arrInfoContacto['namescie_pagecontacto']; ?>)</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="ubicacion contacto">
            <div class="cotaniner-fluid">
                <div class="row">
                    <div class="col-lg-12 g-0 order-2 order-lg-1">
                        <div class="mapa" id="mapa"></div>
                    </div>
                    <div class="col-12 col-lg-8 order-1 order-lg-2 d-flex flex-column justify-content-center info-contacto" data-aos="fade-down" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="datos-contacto">
                                    <h3><?= $arrInfoGral['title_contacto']; ?></h3>
                                    <div class="tel">
                                        <i class="fa-solid fa-phone"></i> <?= $arrInfoGral['telefono']; ?>
                                    </div>
                                    <div class="mail"><i class="fa-solid fa-envelope"></i> <?= $arrInfoGral['email']; ?></div>
                                    <div class="dir"><i class="fa-solid fa-location-dot"></i> <?= $arrInfoGral['direccion']; ?></div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="transporte">
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
            </div>
        </div>

<?php
    else:
        include_once('./Views/Mantenimiento/mantenimiento.php');
    endif;
    footerSite($data);
?>