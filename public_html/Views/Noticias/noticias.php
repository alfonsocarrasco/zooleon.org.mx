<?php
    headerSite($data);
    
    $infoPageNews = $data['info_pagsnews'];
    
    if (!empty($infoPageNews)):
        $arrNoticias = $data['noticias'];
        $portada = media().'images/uploads/'.$infoPageNews['portada_pagenoticia'];
        $portada_parallax = media().'images/uploads/'.$infoPageNews['parallax_pagenoticia'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="">
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

        <section id="blog-title" class="blog-title">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex flex-column align-items-center py-3">
                        <span class="icon-noticias" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500"></span>
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $infoPageNews['titulo_pagenoticia']; ?></h1>
                    </div>
                    <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                </div>
            </div>
        </section>

        <section id="noticias" class="noticias">
            <div class="container-lg">
                <div class="row">
                    <?php
                    if (count($arrNoticias) > 0):
                        for ($i=0; $i < count($arrNoticias); $i++):
                            $portada_noticia = media().'images/uploads/noticias/'.$arrNoticias[$i]['img_nota'];
                            $ruta_noticias = base_url().'noticias/noticia/'.$arrNoticias[$i]['idblog'].'/'.$arrNoticias[$i]['ruta_nota'];
                    ?>
                            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center" data-aos="flip-left" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                                <figure class="image-block">
                                    <img src="<?= $portada_noticia; ?>" alt="" />
                                    <figcaption>
                                        <h4>
                                            <?= substr($arrNoticias[$i]['titulo_nota'], 0, 50).'...'; ?>
                                        </h4>
                                        <div class="descripcion">
                                            <?= substr($arrNoticias[$i]['descripcion_nota'], 0, 150).'...'; ?>
                                        </div>
                                        <a href="<?= $ruta_noticias; ?>"><span>Aprende Más <i class="fa-solid fa-arrow-right-long"></i></span></a>
                                    </figcaption>
                                </figure>
                            </div>
                    <?php
                        endfor;
                    else:
                    ?>
                        <div class="col-12 d-flex flex-column align-items-center non-news">
                            <h2>No hay noticias por mostrar</h2>
                            <a href="<?= base_url(); ?>"><span>Regresar <i class="fa-solid fa-arrow-right-long"></i></span></a>
                        </div>                    
                    <?php
                    endif;
                    ?>
                </div>
                <div class="row mt-5">
                    <!-- paginations -->
                    <div class="col-12 d-flex justify-content-center paginations">
                        <?php 
                        if(count($arrNoticias) > 0):
                            $prevPagina = $data['pagina'] - 1;
                            $nextPagina = $data['pagina'] + 1;
                        ?>
                            <?php if ($data['pagina'] > 1): ?>
                                    <a href="<?= base_url() ?>noticias/page/<?= $prevPagina ?>"> <span>Anterior <i class="fa-solid fa-arrow-left-long"></i></span></a>
                            <?php endif; ?>
                            <?php if ($data['pagina'] != $data['total_paginas']): ?>
                                    <a href="<?= base_url() ?>noticias/page/<?= $nextPagina ?>"><span>Siguiente <i class="fa-solid fa-arrow-right-long"></i></span></a>
                            <?php endif; ?>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $infoPageNews['namespecie_pagenoticia']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $infoPageNews['namescie_pagenoticia']; ?>)</h3>
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