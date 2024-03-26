<?php
    headerAdmin($data);
    getModal('modal_responsables', $data);
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
                    <button type="button" class="btn btn-primary" onclick="openModal();">Nuevo Responsable <i class="fa-solid fa-magnifying-glass"></i></button>
                <?php endif; ?>
                <hr/>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="table-responsive">
                            <table id="tableResponsables" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <form id="formTitular">
                            <input type="hidden" id="idTitular" name="idTitular" value="0">
                            <div class="border p-3 rounded">
                                <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                                <div class="row g-1">
                                    <div class="form-floating mb-3 col-12">
                                        <input type="text" class="form-control" id="txtNombreTitular" name="txtNombreTitular" placeholder="Ingrese el nombre del titular">
                                        <label for="txtNombreTitular" class="form-label">Nombre del Titular <span class="required">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3 col-12">
                                        <input type="text" class="form-control" id="txtPuesto" name="txtPuesto" placeholder="Ingrese el puesto">
                                        <label for="txtPuesto" class="form-label">Puesto <span class="required">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3 col-12">
                                        <input type="text" class="form-control" id="txtTesoreria" name="txtTesoreria">
                                        <label for="txtTesoreria" class="form-label">Link Tesorería</label>
                                    </div>
                                </div>
                                <div class="row g-1">
                                    <div class="form-floating col-12">
                                        <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listStatusT" name="listStatusT">
                                            <option value="" selected>Seleccionar Estatus</option>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                        <label for="listStatusT" class="form-label">Estatus <span class="required">*</span></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                    <button type="submit" class="btn btn-primary mb-3" id="btnActionForm"><i class="bi bi-check2-circle"></i><span id="btnText">Guardar</span></button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php
    footerAdmin($data);
?>