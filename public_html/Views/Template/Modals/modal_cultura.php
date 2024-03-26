<!-- Modal -->
<div class="modal fade" id="modalFormCultura" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Editar Cultura Zooleon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formCultura">
                        <input type="hidden" id="idCultura" name="idCultura" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <input type="hidden" name="foto_actual_parallaxUno" id="foto_actual_parallaxUno" value="">
                        <input type="hidden" name="foto_remove_parallaxUno" id="foto_remove_parallaxUno" value="0">
                        <input type="hidden" name="foto_actual_parallaxDos" id="foto_actual_parallaxDos" value="">
                        <input type="hidden" name="foto_remove_parallaxDos" id="foto_remove_parallaxDos" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
                                    <label for="txtTitulo" class="form-label">Título <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloMision" name="txtTituloMision" placeholder="Título Misión">
                                    <label for="txtTituloMision" class="form-label">Título Misión <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtMision" class="form-label">Descripción Misión <span class="required">*</span></label>
                                    <textarea type="text" class="form-control" id="txtMision" name="txtMision" placeholder="Descripción Misión"></textarea>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloVision" name="txtTituloVision" placeholder="Título Visión">
                                    <label for="txtTituloVision" class="form-label">Título Visión <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtVision" class="form-label">Descripción Visión <span class="required">*</span></label>
                                    <textarea type="text" class="form-control" id="txtVision" name="txtVision" placeholder="Descripción Visión"></textarea>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloValores" name="txtTituloValores" placeholder="Título Valores">
                                    <label for="txtTituloValores" class="form-label">Título Valores <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtValores" class="form-label">Descripción Valores <span class="required">*</span></label>
                                    <textarea type="text" class="form-control" id="txtValores" name="txtValores" placeholder="Descripción Valores"></textarea>
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
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="mb-3 col-12">
                                    <label for="foto2" class="form-label">Agregar foto parallax uno (1920x1000)px</label>
                                    <div class="prevPhotoPrivacidad prevPortadaCat noticias">
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
                                <div class="mb-3 col-12">
                                    <label for="foto3" class="form-label">Agregar foto parallax dos (1920x1000)px</label>
                                    <div class="prevPhotoAcreditaciones prevPortadaCat noticias">
                                        <span class="delPhoto3 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto3"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img3">
                                        </div>
                                        <div class="upimg3">
                                            <input type="file" name="foto3" id="foto3">
                                        </div>
                                        <div id="form_alert"></div>
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