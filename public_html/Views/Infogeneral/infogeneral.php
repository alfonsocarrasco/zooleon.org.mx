<?php
    headerAdmin($data);
    getModal('modal_infogeneral', $data);
?>

    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $data['page_title']; ?></div>
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
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="card overflow-hidden radius-10">
                        <div class="profile-cover bg-dark position-relative mb-4">
                            <!-- <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x">
                                <img src="https://via.placeholder.com/110X110/212529/fff" alt="...">
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="mt-5 d-flex align-items-start justify-content-between">
                                <div class="">
                                    <h3 class="mb-2">Horario</h3>
                                    <p class="mb-1 dias"></p>
                                    <p class="mb-1 horario"></p>
                                    <p class="mb-1 cierre"></p>
                                    <div class="status"></div>
                                </div>
                                <?php if($data['permisosMod']['w']): ?>
                                    <div class="edit">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2 tituloTransporte"></h4>
                            <div class="descripcion">
                                <h6 class="tlineauno"></h6>
                                <p class="dlineauno"></p>
                                <h6 class="tlineados"></h6>
                                <p class="dlineados"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">Imagen Acreditaciones</h4>
                            <div class="imgAcreditaciones"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-3">
                    <div class="card radius-10">
                        <div class="card-body">
                            <h5 class="mb-3 titulo">Contacto</h5>
                            <p class="mb-0"><i class="fa-solid fa-location-arrow"></i> <span class="dir"></span></p>
                            <p class="mb-0"><i class="fa-solid fa-phone-volume"></i> <span class="tel"></span></p>
                            <p class="mb-0"><i class="fa-solid fa-envelope"></i> <span class="mail"></span></p>
                        </div>
                    </div>

                    <div class="card radius-10">
                        <div class="card-body">
                            <h5 class="mb-3">Redes Sociales</h5>
                            <p class=""><i class="fa-brands fa-facebook"></i> <span class="facebook"></span></p>
                            <p class=""><i class="fa-brands fa-instagram"></i> <span class="instagram"></span></p>
                            <p class=""><i class="fa-brands fa-twitter"></i> <span class="twitter"></span></p>
                            <p class=""><i class="fa-brands fa-youtube"></i> <span class="youtube"></span></p>
                            <p class="mb-0"><i class="fa-brands fa-tiktok"></i> <span class="tiktok"></span></p>
                        </div>
                    </div>

                    <div class="card radius-10">
                        <div class="card-body">
                            <h5 class="mb-3">Parallax Uno</h5>
                            <p><span class="nameespecie"></span> - <span class="namescie"></span></p>
                            <div class="imgEspecie"></div>
                        </div>
                    </div>
                    
                    <div class="card radius-10">
                        <div class="card-body">
                            <h5 class="mb-3">Parallax Dos</h5>
                            <div class="imgEspecieDos"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    footerAdmin($data);
?>