<!-- Modal -->
<div class="modal fade" id="modalFormPerfil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formPerfil">
                        <!-- <input type="hidden" name="idUsuario" id="idUsuario" value=""> -->
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="mb-3 col-6">
                                    <label for="foto" class="form-label">Agrega una foto (215x215)px</label>
                                    <div class="prevPhoto">
                                        <span class="delPhoto notBlock"><i class="bi bi-x"></i></span>
                                        <label for="foto"></label>
                                        <div>
                                            <img src="<?= media(); ?>/images/default.jpg" alt="" id="img">
                                        </div>
                                        <div class="upimg">
                                            <input type="file" name="foto" id="foto">
                                        </div>
                                        <div id="form_alert"></div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombres">
                                    <label for="txtNombre" class="form-label">Nombres <span class="required">*</span></label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtPrimerApellido" name="txtPrimerApellido" placeholder="Primer Apellido">
                                    <label for="txtPrimerApellido" class="form-label">Primer Apellido <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtSegundoApellido" name="txtSegundoApellido" placeholder="Segundo Apellido">
                                    <label for="txtSegundoApellido" class="form-label">Segundo Apellido</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtMail" name="txtMail" placeholder="Email" required readonly disable>
                                    <label for="txtMail" class="form-label">Email <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Contraseña">
                                    <label for="txtPassword" class="form-label">Contraseña</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <input type="password" class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" placeholder="Contraseña">
                                    <label for="txtPasswordConfirm" class="form-label">Confirmar Contraseña</label>
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