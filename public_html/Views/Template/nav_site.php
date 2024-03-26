        <div id="header" class="header" data-aos="fade-down" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="700">
            <div class="container-lg">
                <nav class="navbar navbar-expand-lg bg-transparent">
                    <div class="container-lg">
                        <a class="navbar-brand logo d-none d-sm-flex justify-content-center" href="<?= base_url(); ?>">
                            <img src="<?= media(); ?>site/images/logo-leon_veda.svg" alt="Parque Zoológico de León">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse bkg-collapse" id="navbarSupportedContent">
                            <a class="d-flex justify-content-center d-md-none d-lg-none d-xl-none py-3 logo_sm" href="<?= base_url(); ?>">
                                <img src="<?= media(); ?>site/images/logo-leon_veda.svg" alt="<?= NOMBRE_EMPRESA ?>">
                            </a>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <?php if ($data['page_tag'] == 'home'): ?>
                                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Inicio</a>
                                    <?php else: ?>
                                        <a class="nav-link" aria-current="page" href="<?= base_url(); ?>">Inicio</a>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item dropdown">
                                    <?php if ($data['page_tag'] == 'historia'): ?>
                                        <a class="nav-link dropdown-toggle active" id="submenu" data-bs-toggle="dropdown" role="button" href="#">Zooleón</a>
                                        <ul class="dropdown-menu" >
                                            <li class="dropdown-item active"><a href="<?= base_url(); ?>zooleon">Historia</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>especies">Especies</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>nacimientos">Nacimientos</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>atracciones">Atracciones</a></li>
                                        </ul>
                                    <?php elseif ($data['page_tag'] == 'especies'): ?>
                                        <a class="nav-link dropdown-toggle active" id="submenu" data-bs-toggle="dropdown" role="button" href="#">Zooleón</a>
                                        <ul class="dropdown-menu" >
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>zooleon">Historia</a></li>
                                            <li class="dropdown-item active"><a href="<?= base_url(); ?>especies">Especies</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>nacimientos">Nacimientos</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>atracciones">Atracciones</a></li>
                                        </ul>
                                    <?php elseif ($data['page_tag'] == 'nacimientos'): ?>
                                        <a class="nav-link dropdown-toggle active" id="submenu" data-bs-toggle="dropdown" role="button" href="#">Zooleón</a>
                                        <ul class="dropdown-menu" >
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>zooleon">Historia</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>especies">Especies</a></li>
                                            <li class="dropdown-item active"><a href="<?= base_url(); ?>nacimientos">Nacimientos</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>atracciones">Atracciones</a></li>
                                        </ul>
                                    <?php elseif ($data['page_tag'] == 'atracciones'): ?>
                                        <a class="nav-link dropdown-toggle active" id="submenu" data-bs-toggle="dropdown" role="button" href="#">Zooleón</a>
                                        <ul class="dropdown-menu" >
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>zooleon">Historia</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>especies">Especies</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>nacimientos">Nacimientos</a></li>
                                            <li class="dropdown-item active"><a href="<?= base_url(); ?>atracciones">Atracciones</a></li>
                                        </ul>
                                    <?php else: ?>
                                        <a class="nav-link dropdown-toggle" id="submenu" data-bs-toggle="dropdown" role="button" href="#">Zooleón</a>
                                        <ul class="dropdown-menu" >
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>zooleon">Historia</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>especies">Especies</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>nacimientos">Nacimientos</a></li>
                                            <li class="dropdown-item"><a href="<?= base_url(); ?>atracciones">Atracciones</a></li>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($data['page_tag'] == 'paquetes'): ?>
                                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>paquetes">Tu visita</a>
                                    <?php else: ?>
                                        <a class="nav-link" aria-current="page" href="<?= base_url(); ?>paquetes">Tu visita</a>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($data['page_tag'] == 'planeavisita'): ?>
                                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>planeavisita">Paquetes Grupales</a>
                                    <?php else: ?>
                                        <a class="nav-link" aria-current="page" href="<?= base_url(); ?>planeavisita">Paquetes Grupales</a>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($data['page_tag'] == 'noticias'): ?>
                                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>noticias">Noticias</a>
                                    <?php else: ?>
                                        <a class="nav-link" aria-current="page" href="<?= base_url(); ?>noticias">Noticias</a>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item">
                                    <?php if ($data['page_tag'] == 'contacto'): ?>
                                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>contacto">Contacto</a>
                                    <?php else: ?>
                                        <a class="nav-link" aria-current="page" href="<?= base_url(); ?>contacto"">Contacto</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header -->