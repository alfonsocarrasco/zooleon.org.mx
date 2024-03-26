<?php
    headerAdmin($data);
    getModal('modal_perfil', $data);
    isset($data['imagen']) ? $imageUser = $data['imagen'] != 'default.jpg' ? media().'images/uploads/usuarios/'.$data['imagen'] : media().'images/'.$data['imagen'] : '';
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

    <div class="row">
        <div class="col-12">
            <div class="card overflow-hidden radius-10">
                <div class="profile-cover bg-dark position-relative mb-4">
                    <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x">
                        <img src="<?= $imageUser; ?>" alt="">
                    </div>
                </div>
                <div class="card-body">
                    <div class="mt-5 d-flex align-items-start justify-content-between">
                        <div class="">
                            <h3 class="mb-2"><?= $data['nombre'].' '.$data['primerApellido'].' '.$data['segundoApellido']; ?></h3>
                            <p class="mb-1"><?= $data['rol']; ?></p>
                            <p><?= $data['nameuser']; ?></p>
                        </div>
                        <div class="">
                            <button onclick="fntEditPerfil(<?= $data['iduser']; ?>);" class="btn btn-dark"><i class="bi bi-pencil-fill"></i> Editar Perfil</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

<?php footerAdmin($data); ?>