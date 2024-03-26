<!-- Modal -->
<div class="modal fade" id="modalFormInfoGral" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Evento / Exposición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>
                    <div class="container-fluid">
                        <form id="formInfoGral" name="formInfoGral" class="form-horizontal">
                            <input type="hidden" id="idInfoGral" name="idInfoGral" value="0">
                            <input type="hidden" name="foto_actual" id="foto_actual" value="">
                            <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                            <input type="hidden" name="foto_actual_pallxd" id="foto_actual_pallxd" value="">
                            <input type="hidden" name="foto_remove_pallxd" id="foto_remove_pallxd" value="0">
                            <input type="hidden" name="foto_actual_acredita" id="foto_actual_acredita" value="">
                            <input type="hidden" name="foto_remove_acredita" id="foto_remove_acredita" value="0">
                            <div class="row g-1">
                                <h6>Horario</h6>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtDiasCierre" name="txtDiasCierre" placeholder="Días de Cierre">
                                    <label for="txtDiasCierre" class="form-label">Días de Cierre</label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtDias" name="txtDias" placeholder="Días de Apertura">
                                    <label for="txtDias" class="form-label">Días de Apertura</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="time" class="form-control" id="txtHorarioApertura" name="txtHorarioApertura" placeholder="Horario Apertura">
                                    <label for="txtHorarioApertura" class="form-label">Horario de Apertura</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="time" class="form-control" id="txtHorarioCierre" name="txtHorarioCierre" placeholder="Horario Cierre">
                                    <label for="txtHorarioCierre" class="form-label">Horario de Cierre</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <h6>Sección Imagenes</h6>
                                <hr>
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Foto parallax uno (1920x1000)px</label>
                                    <div class="prevPhoto prevPortadaCat noticias">
                                        <span class="delPhoto notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto"></label>
                                        <div>
                                            <img src="<?= media(); ?>images/portada_categoria.jpg" alt="" id="img" class="img-fluid">
                                        </div>
                                        <div class="upimg">
                                            <input type="file" name="foto" id="foto">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNameEspecie" name="txtNameEspecie" placeholder="Nombre Especie">
                                    <label for="txtNameEspecie" class="form-label">Nombre Especie <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
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
                                    </div>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="foto" class="form-label">Foto Acreditaciones (960x773)px</label>
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
                                <h6>Sección Contacto</h6>
                                <hr>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTituloContacto" name="txtTituloContacto" placeholder="Título Contacto">
                                    <label for="txtTituloContacto" class="form-label">Título Contacto</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="tel" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Teléfono">
                                    <label for="txtTelefono" class="form-label">Teléfono</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-mail">
                                    <label for="txtEmail" class="form-label">E-mail</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección">
                                    <label for="txtDireccion" class="form-label">Dirección</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <h6>Información de transporte</h6>
                                <hr>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTituloLinea" name="txtTituloLinea" placeholder="Título">
                                    <label for="txtTituloLinea" class="form-label">Título</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTituloLineaUno" name="txtTituloLineaUno" placeholder="Título Linea">
                                    <label for="txtTituloLineaUno" class="form-label">Título Linea</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtDescripLineaUno" name="txtDescripLineaUno" placeholder="Descripción Linea">
                                    <label for="txtDescripLineaUno" class="form-label">Descripción Línea</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTituloLineaDos" name="txtTituloLineaDos" placeholder="Título Linea">
                                    <label for="txtTituloLineaDos" class="form-label">Título Linea</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtDescripLineDos" name="txtDescripLineDos" placeholder="Descripción Linea">
                                    <label for="txtDescripLineDos" class="form-label">Descripción Línea</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <h6>Redes Sociales</h6>
                                <hr>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtFacebook" name="txtFacebook" placeholder="Facebook">
                                    <label for="txtFacebook" class="form-label">Url Facebook</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtInstagram" name="txtInstagram" placeholder="Instagram">
                                    <label for="txtInstagram" class="form-label">Url Instagram</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTwitter" name="txtTwitter" placeholder="Twitter">
                                    <label for="txtTwitter" class="form-label">Url Twitter</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtYoutube" name="txtYoutube" placeholder="Youtube">
                                    <label for="txtYoutube" class="form-label">Url Youtube</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtTiktok" name="txtTiktok" placeholder="TikTok">
                                    <label for="txtTiktok" class="form-label">Url TikTok</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating col-12">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estado" id="listStatus" name="listStatus">
                                        <option value="" selected>Seleccionar Estatus</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                    <label for="listStatus" class="form-label">Estatus Página Inicio <span class="required">*</span></label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary mb-3" id="btnActionForm"><i class="bi bi-check2-circle"></i><span id="btnText">Guardar</span></button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>