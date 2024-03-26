<!-- Modal -->
<div class="modal fade" id="modalFormPageEjemplares" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Editar Política de Privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formPageEjemplares">
                        <input type="hidden" id="idpageejemplares" name="idpageejemplares" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <input type="hidden" name="foto_actual_parallax" id="foto_actual_parallax" value="">
                        <input type="hidden" name="foto_remove_parallax" id="foto_remove_parallax" value="0">
                        <input type="hidden" name="foto_actual_parallax2" id="foto_actual_parallax2" value="">
                        <input type="hidden" name="foto_remove_parallax2" id="foto_remove_parallax2" value="0">
                        <input type="hidden" name="foto_actual_parallax3" id="foto_actual_parallax3" value="">
                        <input type="hidden" name="foto_remove_parallax3" id="foto_remove_parallax3" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título Página">
                                    <label for="txtTitulo" class="form-label">Título Página <span class="required">*</span></label>
                                </div>
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
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtNameEspecie" name="txtNameEspecie" placeholder="Nombre Especie">
                                    <label for="txtNameEspecie" class="form-label">Nombre Especie <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtNameScien" name="txtNameScien" placeholder="Nombre Científico">
                                    <label for="txtNameScien" class="form-label">Nombre Científico <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="foto2" class="form-label">Agrega una foto de fondo (parallax)... (1920x1000)px</label>
                                    <div class="prevPhotoPrivacidad prevPortadaCat noticias">
                                        <span class="delPhoto2 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto2"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" class="img-fluid" alt="" id="img2">
                                        </div>
                                        <div class="upimg2">
                                            <input type="file" name="foto2" id="foto2">
                                        </div>
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtNameEspecie2" name="txtNameEspecie2" placeholder="Nombre Especie">
                                    <label for="txtNameEspecie2" class="form-label">Nombre Especie <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtNameScien2" name="txtNameScien2" placeholder="Nombre Científico">
                                    <label for="txtNameScien2" class="form-label">Nombre Científico <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Agrega una foto de fondo (parallax dos) (1920x1000)px</label>
                                    <div class="prevPhotoAcreditaciones prevPortadaCat noticias">
                                        <span class="delPhoto3 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto3"></label>
                                        <div>
                                            <img src="<?= media(); ?>/images/portada_categoria.jpg" alt="" id="img3" class="img-fluid">
                                        </div>
                                        <div class="upimg3">
                                            <input type="file" name="foto3" id="foto3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtNameEspecie3" name="txtNameEspecie3" placeholder="Nombre Especie">
                                    <label for="txtNameEspecie3" class="form-label">Nombre Especie <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtNameScien3" name="txtNameScien3" placeholder="Nombre Científico">
                                    <label for="txtNameScien3" class="form-label">Nombre Científico <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Agrega una foto de fondo (parallax tres) (1920x1000)px</label>
                                    <div class="prevPhotoEjemplares prevPortadaCat noticias">
                                        <span class="delPhoto4 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto4"></label>
                                        <div>
                                            <img src="<?= media(); ?>/images/portada_categoria.jpg" alt="" id="img4" class="img-fluid">
                                        </div>
                                        <div class="upimg4">
                                            <input type="file" name="foto4" id="foto4">
                                        </div>
                                    </div>
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