<?php
if (isset($_SESSION['token'])):
    headerAdmin($data);
?>

    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $data['page_tag']; ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $data['page_title']; ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
            
    <div class="card radius-10">
        <div class="row g-0">
            <div class="col-12 col-xl-5">
                <div class="card-body">
                    <h1 class="display-1"><span class="text-danger">4</span><span class="text-primary">0</span><span class="text-success">4</span></h1>
                    <h2 class="font-weight-bold display-4">OPPS! NO SE PUDO ENCONTRAR ESTA PÁGINA!</h2>
                    <p>Lo sentimos,
                    <br>pero la página que está buscando no existe,
                    <br>ha sido eliminada o ha cambiado de nombre.</p>
                    <div class="mt-5">
                        <a href="javascript:window.history.back();" class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Regresar</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-7">
                <img src="assets/images/error/404-error.png" class="img-fluid" alt="">
            </div>
        </div>
        <!--end row-->
    </div>

<?php
    footerAdmin($data);
else:
    headerSite($data);
?>

        <section class="hero-section">
            <div class="container-fluid g-0">
                <div class="promo">
                    <div class="img-banner">
                        <img src="<?= media(); ?>site/images/contacto.jpg" alt="">
                    </div>
                    <div class="holder ejemplar d-none d-md-block">
                        <h1>Error 404</h1>
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

        <section id="historia-title" class="historia-title">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <img src="<?= media(); ?>site/images/404.png" alt="404">
                    </div>
                    <div class="col-12 text-center d-flex flex-column align-items-center mb-5">
                        <h1>OPPS! No se pudo encontrar esta página!</h1>
                        <p>Lo sentimos, pero la página que está buscando no existe, ha sido eliminada o ha cambiado de nombre.</p>
                        <div class="boton">
                            <a href="javascript: history.back()" class="btn-custom">
                                <span>Regresar <i class="fa-solid fa-arrow-right-long"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="parallax01 parallax-padding" style="background-image: url('<?= media(); ?>site/images/parallax07.jpg');"></div>

<?php
    footerSite($data);
endif;
?>