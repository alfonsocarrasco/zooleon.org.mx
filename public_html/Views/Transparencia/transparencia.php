<?php
    headerSite($data);

    $dataPageTransparencia = $data['page_transp'];
    
    $arrResponsables = $data['responsables'];
    $titular = $data['titular'];
    $arrTransparencia = $data['transparencia'];

    if (!empty($dataPageTransparencia)):
        $portada = media().'images/uploads/'.$dataPageTransparencia['portada_pagetransparencia'];
        $portada_parallax = media().'images/uploads/'.$dataPageTransparencia['parallax_pagetransparencia'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="">
                    </div>
                    <div class="holder historia d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $dataPageTransparencia['titulo_pagetransparencia']; ?></h1>
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

        <section id="transparencia" class="transparencia">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 txt-ejemplares d-flex flex-column align-items-center">
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $data['page_name']; ?></h1>
                        <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                    </div>
                </div>
                <div class="row m-5 pt-5 info-transparencia">
                    <div class="col-12 col-md-4">
                        <?php
                        for ($i = 0; $i < count($arrTransparencia); $i++):
                            if ($arrTransparencia[$i]['anio'] == '0000'):
                                if ($i == 0):
                        ?>
                                    <h1><?= $arrTransparencia[$i]['titulo']; ?></h1>
                        <?php
                                endif;
                        ?>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i+1 ?>" aria-expanded="false" aria-controls="flush-collapse<?= $i+1 ?>">
                                                <?= $arrTransparencia[$i]['formato']; ?>
                                            </button>
                                        </h2>

                        <?php
                                        for ($j=0; $j < count($arrTransparencia[$i]['info']); $j++):
                                            if ($arrTransparencia[$i]['formato'] == $arrTransparencia[$i]['info'][$j]['formato']):
                        ?>
                                        
                                            <div id="flush-collapse<?= $i+1 ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body info">
                                                    <p><?= $arrTransparencia[$i]['info'][$j]['subtitulo']; ?></p>
                                                    <div class="docs d-flex justify-content-center gap-3">
                                                        <?php if ($arrTransparencia[$i]['info'][$j]['filePDF'] != ''): ?>
                                                            <a class="btn-custom" href="<?= $arrTransparencia[$i]['info'][$j]['filePDF']; ?>"><span>Descargar PDF <i class="fa-solid fa-download"></i></span></a>
                                                        <?php endif; ?>
                                                        <?php if ($arrTransparencia[$i]['info'][$j]['fileXLS'] != ''): ?>
                                                            <a class="btn-custom" href="<?= $arrTransparencia[$i]['info'][$j]['fileXLS']; ?>"><span>Descargar XLS <i class="fa-solid fa-download"></i></span></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                        <?php
                                            endif;
                                        endfor;
                        ?>
                                    </div>
                                </div>
                        <?php
                                endif;
                            endfor;
                        ?>
                    </div>
                    <div class="col-12 col-md-8 mt-5">
                        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                        </div>
                    </div>
                </div>
                <div class="row m-5" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100">
                    <div class="responsable" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                            <h3>Responsables de la Información</h3>
                            <p><?= $titular['nombre']; ?></p>
                            <p><?= $titular['puesto']; ?></p>
                    </div>
                    <div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-md-center gap-5">
                        <?php
                            foreach ($arrResponsables as $responsable):
                                if ($responsable['link'] != ''):
                        ?>
                                    <a href="<?= $responsable['link'] ?>" target="_blank">
                                        <img src="<?= media().'images/uploads/'.$responsable['imagen']; ?>" alt="imagen <?= $responsable['nombre']; ?>" class="img-fluid">
                                    </a>
                        <?php
                                else:
                        ?>
                                    <img src="<?= media().'images/uploads/'.$responsable['imagen']; ?>" alt="imagen <?= $responsable['nombre']; ?>" class="img-fluid">
                        <?php
                                endif;
                            endforeach;
                        ?>
                    </div>
                    <div class="tesoreria d-flex justify-content-center mt-3">
                        <p>
                            <a href="<?= $titular['link']; ?>" target="_blank">Enlace Cuenta Pública Tesorería Municipal (LEY GENERAL DE CONTABILIDAD GUBERNAMENTAL)</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $dataPageTransparencia['nameespecie_pagetransparencia']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $dataPageTransparencia['namescie_pagetransparencia']; ?>)</h3>
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