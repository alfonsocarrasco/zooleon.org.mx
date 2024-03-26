<!-- Modal -->
<div class="modal fade" id="modalFormPaqueteHome" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Atracción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formPaqueteHome">
                        <input type="hidden" id="idPaquete" name="idPaquete" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <input type="hidden" name="foto_actual_animal" id="foto_actual_animal" value="">
                        <input type="hidden" name="foto_remove_animal" id="foto_remove_animal" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
                                    <label for="txtTitulo" class="form-label">Título Paquete <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtDescripcion" class="form-label">Descripción Paquete <span class="required">*</span></label>
                                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción Paquete"></textarea>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Agrega una fondo (410x660)px</label>
                                    <div class="prevPhoto prevPortadaCat">
                                        <span class="delPhoto notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img">
                                        </div>
                                        <div class="upimg">
                                            <input type="file" name="foto" id="foto">
                                        </div>
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto2" class="form-label">Agrega una fondo (225x399)px</label>
                                    <div class="prevPhoto prevPortada">
                                        <span class="delPhoto2 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto2"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img2">
                                        </div>
                                        <div class="upimg2">
                                            <input type="file" name="foto2" id="foto2">
                                        </div>
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" name="txtLinkPaquete" id="txtLinkPaquete" placeholder="Enlace compra online">
                                    <label for="txtLinkPaquete" class="form-label">Enlace paquete</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating col-12">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listStatus" name="listStatus">
                                        <option value="" selected>Seleccionar Estatus</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                    <label for="listStatus" class="form-label">Estatus <span class="required">*</span></label>
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
</div>

<!-- Modal View User -->
<div class="modal fade" id="modalViewPaqueteH" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                            <td>ID</td>
                            <td id="celId"></td>
                        </tr>
                        <tr>
                            <td>Titulo</td>
                            <td id="celTitulo"></td>
                        </tr>
                        <tr>
                            <td>Descripción</td>
                            <td id="celDescripcion"></td>
                        </tr>
                        <tr>
                            <td>Costo</td>
                            <td id="celLink"></td>
                        </tr>
                        <tr>
                            <td>Imagen background</td>
                            <td id="celImgBkg"></td>
                        </tr>
                        <tr>
                            <td>Imagen animal</td>
                            <td id="celImgAnimal"></td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td id="celEstado"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>