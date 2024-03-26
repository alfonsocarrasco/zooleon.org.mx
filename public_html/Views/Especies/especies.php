<?php
    headerSite($data);
    
    $arrEspecies = $data['especies'];
    $arrPageEspecies = $data['page_especies'];
    if (!empty($arrPageEspecies)):
    
        $portada = media().'images/uploads/'.$arrPageEspecies['portada_pageejemplares'];
        $parallax1 = media().'images/uploads/'.$arrPageEspecies['parallax_pageejemplares'];
        $parallax2 = media().'images/uploads/'.$arrPageEspecies['parallax2'];
        $parallax3 = media().'images/uploads/'.$arrPageEspecies['parallax3'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="Nuestros Ejemplares">
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

        <section id="ejemplares" class="ejemplares">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 txt-ejemplares d-flex flex-column align-items-center">
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrPageEspecies['titulo_pageejemplares']; ?></h1>
                        <p data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="800">¡Haz clic en el animal de tu interes!</p>
                        <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mapagral d-flex justify-content-center mt-5 g-0">
                        <img src="<?= media(); ?>site/images/mapa.jpg" alt="Imagen Mapa ubicación de Especies" class="img-fluid target">
                        <div class="contenido">    
                            <?php
                            for ($i=0; $i < count($arrEspecies); $i++):
                                if ($arrEspecies[$i]['coord_x'] != '' && $arrEspecies[$i]['coord_y'] != ''):
                            ?>
                                    <div class="position-ub-map ubMVN" style="left: <?= $arrEspecies[$i]['coord_x']; ?>%; top: <?= $arrEspecies[$i]['coord_y']; ?>%;">
                                        <a data-bs-custom-class="custom-tooltip" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<?= $arrEspecies[$i]['nombre_especie']; ?>" onclick="jump('id<?= $arrEspecies[$i]['idespecie']; ?>')"></a>
                                    </div>
                            <?php
                                endif;
                            endfor;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax1; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $arrPageEspecies['namespecie_pageejemplares']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $arrPageEspecies['namescie_pageejemplares']; ?>)</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mamíferos -->
        <section id="mamiferos" class="mamiferos">
            <div class="container-lg">
                <div class="row p-5">
                    <div class="col-12">
                        <h1 data-aos="fade-right" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">Mamíferos</h1>
                    </div>
                    <?php
                        // Mamíferos
                        for ($i=0; $i < count($arrEspecies); $i++):
                            if ($arrEspecies[$i]['nombre_categoria'] == 'Mamíferos'):
                                $arrSearch = array('"', '[', ']');
                                $galeria = explode(',', str_replace($arrSearch, '', $arrEspecies[$i]['images_especie']));
                    ?>
                                <div id="id<?= $arrEspecies[$i]['idespecie']; ?>" class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-5 pb-5" data-aos="flip-right" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">
                                    <article class="card_ej card--1">
                                        <div class="card__img" style="background-image: url('<?= media(); ?>images/uploads/especies/<?= $galeria[0]; ?>');"></div>
                                        <a href="<?= base_url().'especies/especie/'.$arrEspecies[$i]['nombre_categoria'].'/'.$arrEspecies[$i]['idespecie'].'/'.$arrEspecies[$i]['ruta_especie']; ?>" class="card_link">
                                            <div class="card__img--hover" style="background-image: url('<?= media(); ?>images/uploads/especies/<?= $galeria[0]; ?>');"></div>
                                        </a>
                                        <div class="card__info">
                                            <h3 class="card__title"><?= $arrEspecies[$i]['nombre_especie']; ?></h3>
                                            <span class="card__category"><?= $arrEspecies[$i]['nombre_cientifico']; ?></span>
                                        </div>
                                    </article>
                                </div>
                    <?php
                            endif;
                        endfor;
                    ?>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax2; ?>">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $arrPageEspecies['namespecie2']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $arrPageEspecies['namescie2']; ?>)</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aves -->
        <section id="aves" class="aves">
            <div class="container-lg">
                <div class="row p-5">
                    <div class="col-12">
                        <h1 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">Aves</h1>
                    </div>
                    <?php
                        // Aves
                        for ($i=0; $i < count($arrEspecies); $i++):
                            if ($arrEspecies[$i]['nombre_categoria'] == 'Aves'):
                                $arrSearch = array('"', '[', ']');
                                $galeria = explode(',', str_replace($arrSearch, '', $arrEspecies[$i]['images_especie']));
                    ?>
                                <div id="id<?= $arrEspecies[$i]['idespecie']; ?>" class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-5 pb-5" data-aos="flip-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">
                                    <article class="card_ej card--1">
                                        <div class="card__img" style="background-image: url('<?= media(); ?>images/uploads/especies/<?= $galeria[0]; ?>');"></div>
                                        <a href="<?= base_url().'especies/especie/'.$arrEspecies[$i]['nombre_categoria'].'/'.$arrEspecies[$i]['idespecie'].'/'.$arrEspecies[$i]['ruta_especie']; ?>" class="card_link">
                                            <div class="card__img--hover" style="background-image: url('<?= media(); ?>images/uploads/especies/<?= $galeria[0]; ?>');"></div>
                                        </a>
                                        <div class="card__info">
                                            <h3 class="card__title"><?= $arrEspecies[$i]['nombre_especie']; ?></h3>
                                            <span class="card__category"><?= $arrEspecies[$i]['nombre_cientifico']; ?></span>
                                        </div>
                                    </article>
                                </div>
                    <?php
                            endif;
                        endfor;
                    ?>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $parallax3; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $arrPageEspecies['namespecie3']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $arrPageEspecies['namespecie3']; ?>)</h3>
                    </div>
                </div>
            </div>
        </div>

        <section id="reptiles" class="reptiles">
            <div class="container-lg">
                <div class="row p-5">
                    <div class="col-12">
                        <h1 data-aos="fade-right" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">Reptiles</h1>
                    </div>
                    <?php
                        // Reptiles
                        for ($i=0; $i < count($arrEspecies); $i++):
                            if ($arrEspecies[$i]['nombre_categoria'] == 'Reptiles'):
                                $arrSearch = array('"', '[', ']');
                                $galeria = explode(',', str_replace($arrSearch, '', $arrEspecies[$i]['images_especie']));
                    ?>
                                <div id="id<?= $arrEspecies[$i]['idespecie']; ?>" class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mb-5 pb-5" data-aos="flip-right" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">
                                    <article class="card_ej card--1">
                                        <div class="card__img" style="background-image: url('<?= media(); ?>images/uploads/especies/<?= $galeria[0]; ?>');"></div>
                                        <a href="<?= base_url().'especies/especie/'.$arrEspecies[$i]['nombre_categoria'].'/'.$arrEspecies[$i]['idespecie'].'/'.$arrEspecies[$i]['ruta_especie']; ?>" class="card_link">
                                            <div class="card__img--hover" style="background-image: url('<?= media(); ?>images/uploads/especies/<?= $galeria[0]; ?>');"></div>
                                        </a>
                                        <div class="card__info">
                                            <h3 class="card__title"><?= $arrEspecies[$i]['nombre_especie']; ?></h3>
                                            <span class="card__category"><?= $arrEspecies[$i]['nombre_cientifico']; ?></span>
                                        </div>
                                    </article>
                                </div>
                    <?php
                            endif;
                        endfor;
                    ?>
                </div>
            </div>
        </section>

<?php
    else:
        include_once('./Views/Mantenimiento/mantenimiento.php');
    endif;
    footerSite($data);
?>