<!-- Modal -->
<div class="modal fade" id="modalFormNacimientos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formNacimientos" class="formNacimientos">
                        <input type="hidden" id="idNacimiento" name="idNacimiento" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNombreEspecie" name="txtNombreEspecie" placeholder="Nombre Ejemplar">
                                    <label for="txtNombreEspecie" class="form-label">Nombre Ejemplar <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNombreCientifico" name="txtNombreCientifico" placeholder="Nombre Científico">
                                    <label for="txtNombreCientifico" class="form-label">Nombre Científico <span class="required">*</span></label>
                                </div>
                                <div class="form-floating col-12 mb-3">
                                    <input type="date" class="form-control" id="txtFecha" name="txtFecha" placeholder="Fecha de nacimiento" required>
                                    <label for="txtFecha"><i class="fa-solid fa-calendar-days"></i> Fecha nacimiento <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <label for="txtDescripcion" class="form-label">Descripción</label>
                                    <textarea type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Ingresa la descripción"></textarea>
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
                                    <label for="listStatus" class="form-label">Estatus de Ejemplar <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Agrega una foto de portada (1920x820)px</label>
                                    <div class="prevPhoto prevPortadaCat noticias">
                                        <span class="delPhoto notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img">
                                        </div>
                                        <div class="upimg">
                                            <input type="file" name="foto" id="foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="mb-3 col-12">
                                    <label for="txtGaleria" class="form-label">Imagenes de (600x600)px</label>
                                    <div id="dropzone" class="dropzone">
                                        <div class="dz-default dz-message">
                                            <button class="dz-button" type="button"><i class="bi bi-cloud-arrow-up-fill"></i></button>
                                            <span class="text-dropzone">Arrastra las imagenes aquí o haga click para cargarlas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-12">
                                    <div class="imgGaleria d-flex justify-content-center mb-3"></div>
                                    <input type="hidden" id="imgGaleriaActual" name="imgGaleriaActual" value="">
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
<div class="modal fade" id="modalViewNacimiento" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>ID:</td>
                            <td id="celId"></td>
                        </tr>
                        <tr>
                            <td>Nombre Especie:</td>
                            <td id="celNombre"></td>
                        </tr>
                        <tr>
                            <td>Nombre Científico:</td>
                            <td id="celNombreCientifico"></td>
                        </tr>
                        <tr>
                            <td>Fecha Nacimiento:</td>
                            <td id="celFechaNacimiento"></td>
                        </tr>
                        <tr>
                            <td>Descripcion:</td>
                            <td id="celDescripcion"></td>
                        </tr>
                        <tr>
                            <td>Portada:</td>
                            <td id="celPortada"></td>
                        </tr>
                        <tr>
                            <td>Imagenes:</td>
                            <td id="celGal"></td>
                        </tr>
                        <tr>
                            <td>Categoria:</td>
                            <td id="celCat"></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celStatus"></td>
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