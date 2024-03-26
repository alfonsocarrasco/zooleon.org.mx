<!-- Modal -->
<div class="modal fade" id="modalFormNoticias" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formNoticias">
                        <input type="hidden" id="idNota" name="idNota" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <input type="hidden" name="fechaPub" id="fechaPub" value="">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloNota" name="txtTituloNota" placeholder="Título del Post">
                                    <label for="txtTituloNota" class="form-label">Título del Post <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtDescripcion" class="form-label">Descripción del Post <span class="required">*</span></label>
                                    <textarea type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción del Post"></textarea>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Agrega una foto de portada (1920x820)px</label>
                                    <div class="prevPhoto prevPortadaCat noticias">
                                        <span class="delPhoto notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto"></label>
                                        <div>
                                            <img src="<?= media(); ?>/images/portada_categoria.jpg" alt="" id="img">
                                        </div>
                                        <div class="upimg">
                                            <input type="file" name="foto" id="foto">
                                        </div>
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtVideo" name="txtVideo" placeholder="Ingresa el enlace del video (opcional)">
                                    <label for="txtVideo" class="form-label">Video</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating col-6">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listCategoria" name="listCategoria">
                                    </select>
                                    <label for="listCategoria" class="form-label">Categoría <span class="required">*</span></label>
                                </div>
                                <div class="form-floating col-6">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listStatus" name="listStatus">
                                        <option value="" selected>Seleccionar Estatus</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                    <label for="listStatus" class="form-label">Estatus del Post <span class="required">*</span></label>
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
<div class="modal fade" id="modalViewNoticia" tabindex="-1" aria-hidden="true">
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
                            <td>Portada</td>
                            <td id="celImg" class="imgEvento"></td>
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
                            <td>Fecha Creación</td>
                            <td id="celFecha"></td>
                        </tr>
                        <tr>
                            <td>Video</td>
                            <td id="celVideo"></td>
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