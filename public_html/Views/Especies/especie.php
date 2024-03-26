<?php
    headerSite($data);
    
    $arrEspecie      = $data['page_especie'];
    if (!empty($arrEspecie) && $data['page_especies']):
    $portada_url     = media().'images/uploads/especies/'.$arrEspecie['portada_especie'];
    $imgFeed         = media().'images/uploads/especies/'.$arrEspecie['image_alimentacion'];
    $imgSize         = media().'images/uploads/especies/'.$arrEspecie['imagen_tamanio'];
    $imgDelivery     = media().'images/uploads/especies/'.$arrEspecie['image_distribucion'];
    $imgWeight       = media().'images/uploads/especies/'.$arrEspecie['imagen_peso'];
    $imgHabitat      = media().'images/uploads/especies/'.$arrEspecie['imagen_habitat'];
    $imgYouKwon      = media().'images/uploads/especies/'.$arrEspecie['imagen_sabias'];
    $imgConservation = media().'images/uploads/especies/'.$arrEspecie['image_conservacion'];
    $imgLocation     = media().'images/uploads/especies/'.$arrEspecie['ubicacion_img'];
?>

        <?php if ($arrEspecie['video_especie']): ?>
            <!-- Modal -->
            <div class="modal fade" id="videoEspecie" tabindex="-1" aria-labelledby="videoEspecieLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="videoEspecieLabel"><?= $arrEspecie['titulo_video']; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <?= $arrEspecie['video_especie']; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada_url; ?>" alt="Nuestros Ejemplares">
                    </div>
                    <div class="holder ejemplar d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $arrEspecie['nombre_especie']; ?></h1>
                        <h3 data-aos="fade-right" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="1300">(<?= $arrEspecie['nombre_cientifico']; ?>)</h3>
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

        <section id="features" class="features">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 col-md-6 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgFeed; ?>" alt="">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgSize; ?>" alt="">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgDelivery; ?>" alt="">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgWeight; ?>" alt="">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgHabitat; ?>" alt="">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgYouKwon; ?>" alt="">
                    </div>
                    <div class="col-12 d-flex align-items-start">
                        <img class="img-fluid" src="<?= $imgConservation; ?>" alt="">
                    </div>
                </div>
            </div>
        </section>

        <div class="galeria-ejemplar">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $arrSearch = array('"', '[', ']');
                    $galeria = explode(',', str_replace($arrSearch, '', $arrEspecie['images_especie']));
                    $bandera = 0;
                    for ($i=0; $i < count($galeria); $i++):
                        $portada_galeria = media().'images/uploads/especies/'.$galeria[$i];
                        $bandera == 0 ? $bandera = 500 : $bandera += 200;
                    ?>
                        <div class="col-6 col-lg-3 g-0" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="<?= $bandera; ?>"><img src="<?= $portada_galeria ?>" alt=""></div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <?php if ($arrEspecie['video_especie']): ?>
            <div id="video" class="video">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center" data-aos="fade-down" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#videoEspecie"><h1>ver video</h1></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <section id="ubicalo" class="ubicalo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">Ubícalo en tu próxima visita</h1>
                    </div>
                    <div class="col-12 g-0" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <img src="<?= $imgLocation; ?>" alt="">
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