<?php
    headerSite($data);
    
    $arrInfoContacto = $data['info_contacto'];

    if (!empty($arrInfoContacto)):
        $portada = media().'images/uploads/'.$arrInfoContacto['portada_pagecontacto'];
        $portada_parallax = media().'images/uploads/'.$arrInfoContacto['parallax_pagecontacto'];

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

        <section id="ejemplares" class="ejemplares">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 txt-ejemplares d-flex flex-column align-items-center">
                        <span class="icon-contacto" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"></span>
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $arrInfoContacto['titulo_pagecontacto']; ?></h1>
                        <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="form-contact" class="form-contact">
            <div class="container-lg">
                <form id="fcontacto" class="fcontacto">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingresa tu nombre">
                                <label for="txtNombre"><i class="fa-solid fa-file-signature"></i> Nombre</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingresa tu correo electrónico">
                                <label for="txtEmail"><i class="fa-solid fa-at"></i> E-mail</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="txtTel" name="txtTel" placeholder="Ingresa tu número de teléfono">
                                <label for="txtTel"><i class="fa-solid fa-phone-flip"></i> Teléfono</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtAsunto" name="txtAsunto" placeholder="Asunto...">
                                <label for="txtEmail"><i class="fa-solid fa-marker"></i> Asunto</label>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100">
                            <div class="form-floating">
                                <textarea class="form-control" name="txtMensaje" id="txtMensaje" placeholder="Ingresa tu mensaje"></textarea>
                                <label for="txtMensaje"><i class="fa-solid fa-comments"></i> Ingresa tu mensaje</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="1200">
                            <div class="boton">
                                <button type="submit" id="enviar" class="btn-custom">
                                    <span>Enviar <i class="fa-solid fa-arrow-right-long"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

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

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $portada_parallax; ?>');">
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
                    <div class="col-12 col-lg-8 order-1 order-lg-2 d-flex flex-column justify-content-center info-contacto" data-aos="fade" data-aos-offset="100" data-aos-easing="ease-in-sine" data-aos-duration="500">
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