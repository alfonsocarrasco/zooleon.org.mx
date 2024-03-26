<?php
    headerSite($data);

    $dataAtraccion = $data['page_atraccion'];
    if (!empty($dataAtraccion) && !empty($data['page_atracciones'])):
        $portada = media().'images/uploads/'.$dataAtraccion['imagen'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $portada; ?>" alt="<?= $dataAtraccion['titulo']; ?>">
                    </div>
                    <div class="holder ejemplar d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $dataAtraccion['titulo']; ?></h1>
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

        <section id="atraccion" class="atraccion">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="e-borde" data-aos="fade-down" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="600"></div>
                    </div>
                    <div class="col-12 col-lg-9 descripcion pe-0 pe-lg-5" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <?= $dataAtraccion['descripcion']; ?>
                    </div>
                    <div class="col-12 col-lg-3 detalles" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h3>Información del Servicio</h3>
                        <?php
                            $timeStart = new DateTime($dataAtraccion['horarioa']);
                            $timeEnd = new DateTime($dataAtraccion['horarioc']);
                            $timeStart2 = new DateTime($dataAtraccion['horarioa2']);
                            $timeEnd2 = new DateTime($dataAtraccion['horarioc2']);
                        ?>
                        <ul class="categories">
                            <li><span class="title_details">Días de Apertura: </span><?= $dataAtraccion['dia_apertura']; ?></li>
                            <?php if ($dataAtraccion['horarioa'] != ''): ?>
                                <li><span class="title_details">Horario Apertura: </span> <?= $timeStart->format('h:i a'); ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['horarioc'] != ''): ?>
                                <li><span class="title_details">Horario Cierre: </span> <?= $timeEnd->format('h:i a'); ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['dia_apertura_2'] != ''): ?>
                                <li><span class="title_details">De: </span><?= $dataAtraccion['dia_apertura_2']; ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['horarioa2'] != '' && $dataAtraccion['horarioa2'] != '00:00:00'): ?>
                                <li><span class="title_details">Horario Apertura: </span> <?= $timeStart2->format('h:i a'); ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['horarioc2'] != '' && $dataAtraccion['horarioc2'] != '00:00:00'): ?>
                                <li><span class="title_details">Horario Cierre: </span> <?= $timeEnd2->format('h:i a'); ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['costo'] != '' && $dataAtraccion['costo'] != '0.00'): ?>
                                <li><span class="title_details">Costo Persona: </span><?= '$'.$dataAtraccion['costo'].' MXN'; ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['costo2'] != '' && $dataAtraccion['costo2'] != '0.00'): ?>
                                <li><span class="title_details">Costo Mascota: </span><?= '$'.$dataAtraccion['costo2'].' MXN'; ?></li>
                            <?php endif; ?>
                            <?php if ($dataAtraccion['costo3'] != '' && $dataAtraccion['costo3'] != '0.00'): ?>
                                <li><span class="title_details">Costo Niño: </span><?= '$'.$dataAtraccion['costo3'].' MXN'; ?></li>
                            <?php endif; ?>
                        </ul>
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