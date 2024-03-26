<?php
    headerSite($data);
    $arrData = $data['data_brith'];

    if (!empty($arrData) && !empty($data['page_data'])):
        $portada = media().'images/uploads/nacimientos/'.$arrData['portada'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="Imagen Nacimiento">
                    </div>
                    <div class="holder d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $arrData['nombre_especie']; ?></h1>
                        <h3 data-aos="fade-right" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="1300" class="aos-init aos-animate">(<?= $arrData['nombre_cientifico']; ?>)</h3>
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
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrData['nombre_especie']; ?></h1>
                        <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="aves" class="aves">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <?= $arrData['descripcion']; ?>
                    </div>
                    <?php
                    $arrSearch = array('"', '[', ']');
                    $galeria = explode(',', str_replace($arrSearch, '', $arrData['galeria']));
                    $bandera = 0;
                    for ($i=0; $i < count($galeria); $i++):
                        $imgGaleria = media().'images/uploads/nacimientos/'.$galeria[$i];
                        $bandera == 0 ? $bandera = 500 : $bandera += 200;
                    ?>
                        <div class="col-6" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="<?= $bandera; ?>">
                            <img src="<?= $imgGaleria; ?>" alt="">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= media().'images/uploads/'.$data['page_data']['parallax']; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $data['page_data']['name_especie']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $data['page_data']['name_cientifico']; ?>)</h3>
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