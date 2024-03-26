<!-- Modal -->
<div class="modal fade" id="modalFormHistoria" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Editar Historia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formHistoria">
                        <input type="hidden" id="idHistoria" name="idHistoria" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <input type="hidden" name="foto_actual_contamos" id="foto_actual_contamos" value="">
                        <input type="hidden" name="foto_remove_contamos" id="foto_remove_contamos" value="0">
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
                                <div class="mb-3 col-12">
                                    <label for="txtDescripcion" class="form-label">Descripción Historia <span class="required">*</span></label>
                                    <textarea type="text" class="form-control" id="txtDescripcion" name="txtDescripcion" placeholder="Descripción Historia"></textarea>
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
                                <div class="form-floating mb-3 col-12">
                                    <label for="txtAntecedentes" class="form-label">Antecedente</label>
                                    <textarea type="text" class="form-control" id="txtAntecedentes" name="txtAntecedentes" placeholder="Ingresa los Antecedente"></textarea>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTituloNumAnimales" name="txtTituloNumAnimales" placeholder="Ingresa el título">
                                    <label for="txtTituloNumAnimales" class="form-label">Título Número Animales</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNumAnimales" name="txtNumAnimales" placeholder="Ingresa la cantidad">
                                    <label for="txtNumAnimales" class="form-label">Número de Animales</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTituloNumEspecies" name="txtTituloNumEspecies" placeholder="Ingresa el título">
                                    <label for="txtTituloNumEspecies" class="form-label">Título Número Especies</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNumEspecies" name="txtNumEspecies" placeholder="Ingresa la cantidad">
                                    <label for="txtNumEspecies" class="form-label">Número de Especies</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTituloNumPersonas" name="txtTituloNumPersonas" placeholder="Ingresa el título">
                                    <label for="txtTituloNumPersonas" class="form-label">Título Número Personas</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNumPersonas" name="txtNumPersonas" placeholder="Ingresa la cantidad">
                                    <label for="txtNumPersonas" class="form-label">Número de Personas</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloContamos" name="txtTituloContamos" placeholder="Ingresa el título">
                                    <label for="txtTituloContamos" class="form-label">Titulo Contamos</label>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="txtDescripcionContamos" class="form-label">Descripción Contamos <span class="required">*</span></label>
                                    <textarea type="text" class="form-control" id="txtDescripcionContamos" name="txtDescripcionContamos" placeholder="Título contamos con..."></textarea>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="foto2" class="form-label">Agrega una foto (Contamos...) (640x720)px</label>
                                    <div class="prevPhotoContamos prevPortadaCat contamos">
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
                                <div class="mb-3 col-12">
                                    <label for="foto3" class="form-label">Agregar foto parallax uno (1920x1000)px</label>
                                    <div class="prevPhotoPrivacidad prevPortadaCat noticias">
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
                                <div class="mb-3 col-12">
                                    <label for="foto4" class="form-label">Agregar foto parallax dos (1920x1000)px</label>
                                    <div class="prevPhotoAcreditaciones prevPortadaCat noticias">
                                        <span class="delPhoto4 notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto4"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img4">
                                        </div>
                                        <div class="upimg4">
                                            <input type="file" name="foto4" id="foto4">
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