<?php
    headerAdmin($data);
    getModal('modal_planearvisita', $data);
?>

    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $data['page_title']; ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item">
                        <a href="javascript:;"><i class="bi bi-person-lines-fill"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $data['page_title']; ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div id="contentAjax"></div>
    <div class="card radius-10">
        <div class="card-body">
            <?php if($data['permisosMod']['w']): ?>
                <button type="button" class="btn btn-primary" onclick="openModal();">Nuevo Registro <i class="fa-solid fa-list-check"></i></button>
            <?php endif; ?>
            <hr/>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="table-responsive">
                        <table id="tablePlanearVisita" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de Evento</th>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Medio de Contacto</th>
                                    <th>Estado Seguimiento</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo de Evento</th>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Medio de Contacto</th>
                                    <th>Estado Seguimiento</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

<?php footerAdmin($data); ?>