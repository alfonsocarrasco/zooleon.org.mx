<?php
    headerAdmin($data);
    getModal('modal_transparencia', $data);
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

        <!--start page detail-->
        <div class="card radius-10">
            <div class="card-body">
                <?php if($data['permisosMod']['w']): ?>
                    <button type="button" class="btn btn-primary" onclick="openModal();">Nuevo Documento <i class="fa-solid fa-magnifying-glass"></i></button>
                <?php endif; ?>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                                <h6>Filtros</h6>
                                <div class="row d-flex">
                                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 mb-lg-0">
                                        <input class="form-control" name="title" id="title" type="text" data-index="1" placeholder="Título...">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 mb-lg-0">
                                        <input class="form-control" name="formato" id="formato" type="text" data-index="2" placeholder="Formato...">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 mb-lg-0">
                                        <input class="form-control" name="anio" id="anio" type="text" data-index="3" placeholder="Año...">
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3 mb-3 mb-md-3 mb-lg-0">
                                        <input class="form-control" name="subtitle" id="subtitle" type="text" data-index="4" placeholder="Subtitulo...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="table-responsive">
                            <table id="tableTransparencia" class="table table-striped table-bordered dt-responsive" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Formato</th>
                                        <th>Año</th>
                                        <th>Subtitulo</th>
                                        <th>PDF</th>
                                        <th>XLS</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Formato</th>
                                        <th>Año</th>
                                        <th>Subtitulo</th>
                                        <th>PDF</th>
                                        <th>XLS</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    footerAdmin($data);
?>