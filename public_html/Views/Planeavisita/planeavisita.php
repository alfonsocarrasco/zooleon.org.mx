<?php
    headerSite($data);

    $infoPage = $data['page_planea'];
    
    if (!empty($infoPage)):
        $estados = $data['estados'];
        $imgPortada = media().'images/uploads/'.$infoPage['portada_pageplanea'];
        $imgParallax = media().'images/uploads/'.$infoPage['parallax_pageplanea'];
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner" data-aos="fade" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="500">
                        <img src="<?= $imgPortada; ?>" alt="">
                    </div>
                    <div class="holder contact d-none d-md-block" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
                        <h1 data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100"><?= $infoPage['titulo_pageplanea']; ?></h1>
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
                        <h1 data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700"><?= $infoPage['titulo_pageplanea']; ?></h1>
                        <p><?= $infoPage['frase']; ?></p>
                    </div>
                    <div class="e-borde" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900"></div>
                </div>
            </div>
        </section>

        <section id="form-pvisita" class="form-pvisita">
            <div class="container-lg">
                <form id="fpvisita" class="fpvisita">
                    <p>Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                    <div class="row d-flex justify-content-center">
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <select class="form-select" id="txtTipoEvento" name="txtTipoEvento" aria-label="Tipo de Evento" required>
                                    <option value="1">Escolar</option>
                                    <option value="2">Empresarial</option>
                                    <option value="3">Fiesta Infantil</option>
                                </select>
                                <label for="txtTipoEvento"><i class="fa-solid fa-calendar-check"></i> Selecciona el tipo de evento</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingresa tu nombre" required>
                                <label for="txtNombre"><i class="fa-solid fa-file-signature"></i> Nombre completo</label>
                            </div>
                        </div>
                        <div class="col-12" id="nombreEmpresa" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtEmpresa" name="txtEmpresa" placeholder="Escuela o Empresa" required>
                                <label for="txtEmpresa"><i class="fa-solid fa-school-flag"></i> Nombre de la Escuela o Empresa</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <select class="form-select" id="txtEstado" name="txtEstado" aria-label="Selecciona el Estado" required>
                                    <option selected>Selecciona el Estado</option>
                                    <?php foreach ($estados as $estado): ?>
                                        <option value="<?= $estado['id']; ?>"><?= $estado['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="txtEstado"><i class="fa-solid fa-file-signature"></i> Estado</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <select class="form-select" id="txtMunicipio" name="txtMunicipio" aria-label="Selecciona el Municipio" required></select>
                                <label for="txtMunicipio"><i class="fa-solid fa-file-signature"></i> Ciudad</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="txtTelFijo" name="txtTelFijo" placeholder="Ingresa tu número de teléfono" required>
                                <label for="txtTelFijo"><i class="fa-solid fa-phone-flip"></i> Teléfono Fijo</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="txtTelCel" name="txtTelCel" placeholder="Ingresa tu número de celular" required>
                                <label for="txtTelCel"><i class="fa-brands fa-whatsapp"></i> Teléfono Celular</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="900">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingresa tu correo electrónico" required>
                                <label for="txtEmail"><i class="fa-solid fa-at"></i> E-mail</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="number" min="15" class="form-control" id="txtNumeroPersonas" name="txtNumeroPersonas" placeholder="Número de personas" required>
                                <label for="txtNumeroPersonas"><i class="fa-solid fa-person-circle-plus"></i> Numero estimado de personas</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtFechaHr" name="txtFechaHr" placeholder="Fecha estimada de visita" required>
                                <label for="txtFechaHr"><i class="fa-solid fa-calendar-days"></i> Fecha y horario estimado de visita</label>
                            </div>
                        </div>
                        <div class="col-6" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtAsunto" name="txtAsunto" placeholder="Asunto..." required>
                                <label for="txtAsunto"><i class="fa-solid fa-marker"></i> Asunto</label>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1100">
                            <div class="form-floating">
                                <textarea class="form-control" name="txtMensaje" id="txtMensaje" placeholder="Ingresa tu mensaje" required></textarea>
                                <label for="txtMensaje"><i class="fa-solid fa-comments"></i> Ingresa tu mensaje</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center" data-aos="fade-up" data-aos-offset="100" data-aos-easing="ease-in-sine" data-aos-duration="1200">
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

        <div class="parallax01 parallax-padding" style="background-image: url('<?= $imgParallax; ?>');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-end">
                        <h2 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="500"><?= $infoPage['namespecie_pageplanea']; ?></h2>
                        <h3 data-aos="fade-left" data-aos-offset="150" data-aos-easing="ease-in-sine" data-aos-duration="700">(<?= $infoPage['namescie_pageplanea']; ?>)</h3>
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