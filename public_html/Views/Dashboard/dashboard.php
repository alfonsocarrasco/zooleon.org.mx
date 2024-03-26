<?php
    headerAdmin($data);
    getModal('modal_contactanos', $data);
?>

    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-5">
        <?php if (!empty($data['permisos'][2]['r'])): ?>
        <div class="col">
            <a href="<?= base_url(); ?>usuarios">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="mx-auto widget-icon bg-light-dark text-dark">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="text-center mt-3">
                            <h3 class="text-dark mb-1"><?= $data['usuarios']; ?></h3>
                            <p class="text-muted mb-4">Usuarios</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['permisos'][4]['r'])): ?>
        <div class="col">
            <a href="<?= base_url(); ?>categorias">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="mx-auto widget-icon bg-light-dark text-dark">
                            <i class="bi bi-inboxes-fill"></i>
                        </div>
                        <div class="text-center mt-3">
                            <h3 class="text-dark mb-1"><?= $data['categorias']; ?></h3>
                            <p class="text-muted mb-4">Categorias</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['permisos'][6]['r'])): ?>
        <div class="col">
            <a href="<?= base_url(); ?>ejemplares">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="mx-auto widget-icon bg-light-dark text-dark">
                            <i class="fa-solid fa-hippo"></i>
                        </div>
                        <div class="text-center mt-3">
                            <h3 class="text-dark mb-1"><?= $data['especies']; ?></h3>
                            <p class="text-muted mb-4">Especies</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['permisos'][5]['r'])): ?>
        <div class="col">
            <a href="<?= base_url(); ?>blog">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="mx-auto widget-icon bg-light-dark text-dark">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <div class="text-center mt-3">
                            <h3 class="text-dark mb-1"><?= $data['noticias']; ?></h3>
                            <p class="text-muted mb-4">Noticias</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
        <?php if (!empty($data['permisos'][21]['r'])): ?>
        <div class="col">
            <a href="<?= base_url(); ?>pagepaquetes">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="mx-auto widget-icon bg-light-dark text-dark">
                            <i class="fa-solid fa-boxes-packing"></i>
                        </div>
                        <div class="text-center mt-3">
                            <h3 class="text-dark mb-1"><?= $data['paquetes']; ?></h3>
                            <p class="text-muted mb-4">Paquetes</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <!--end row-->

    <?php if(!empty($data['permisos'][13]['r'])): ?>
    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Mensajes Contacto Web</h6>
                <div class="fs-5 ms-auto dropdown">
                    <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url(); ?>contactanos">Mensajes</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Aunto</th>
                            <th>fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($data['lastMsg']) > 0):
                            foreach($data['lastMsg'] as $msg):
                        ?>
                            <tr>
                                <td><?= $msg['idcontacto']; ?></td>
                                <td><?= $msg['nombre']; ?></td>
                                <td><?= $msg['email']; ?></td>
                                <td><?= $msg['asunto']; ?></td>
                                <td><?= $msg['fecha']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 fs-6">
                                        <a href="javascript:fntViewInfo(<?= $msg['idcontacto']; ?>);" class="text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="" data-bs-original-title="View detail" aria-label="Views">
                                            <ion-icon name="eye-sharp"></ion-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php footerAdmin($data); ?>