<!-- Modal -->
<div class="modal fade" id="modalFormPlanear" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Editar Política de Privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formPlanear">
                        <input type="hidden" id="idplanea" name="idplanea" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select disabled" id="txtEvento" name="txtEvento" aria-label="Tipo de Evento" disabled>
                                        <option selected>Selecciona tipo de evento</option>
                                        <option value="1">Escolar</option>
                                        <option value="2">Empresarial</option>
                                        <option value="3">Fiesta Infantil</option>
                                    </select>
                                    <label for="txtEvento" class="form-label">Tipo Evento</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control disabled" id="txtNombre" name="txtNombre" disabled>
                                    <label for="txtNombre" class="form-label">Nombre</label>
                                </div>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control disabled" id="txtEmpresa" name="txtEmpresa" disabled>
                                    <label for="txtEmpresa" class="form-label">Nombre de la Empresa</label>
                                </div>
                                <div class="form-floating col-6">
                                    <select class="form-select disabled" id="txtEstado" name="txtEstado" aria-label="Selecciona el Estado" disabled>
                                        <option selected>Selecciona el Estado</option>
                                        <?php foreach ($data['estados'] as $estado): ?>
                                            <option value="<?= $estado['id']; ?>"><?= $estado['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="txtEstado" class="form-label">Estado</label>
                                </div>
                                <div class="form-floating col-6">
                                    <select class="form-select disabled" id="txtMunicipio" name="txtMunicipio" aria-label="Selecciona el Municipio" disabled></select>
                                    <label for="txtMunicipio" class="form-label">Municipio</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control disabled" id="txtTelefono" name="txtTelefono" disabled>
                                    <label for="txtTelefono" class="form-label">Teléfono Fijo</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control disabled" id="txtCelular" name="txtCelular" disabled>
                                    <label for="txtCelular" class="form-label">Celular</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control disabled" id="txtEmail" name="txtEmail" disabled>
                                    <label for="txtEmail" class="form-label">Correo Electrónico</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" class="form-control disabled" id="txtNumPersonas" name="txtNumPersonas" disabled>
                                    <label for="txtNumPersonas" class="form-label">Número de Personas</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control disabled" id="txtAsunto" name="txtAsunto" disabled>
                                    <label for="txtAsunto" class="form-label">Asunto</label>
                                </div>
                                <div class="form-floating col-12">
                                    <textarea type="text" class="form-control disabled" id="txtMensaje" name="txtMensaje" disabled></textarea>
                                    <label for="txtDescripcion" class="form-label">Descripción</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-1">
                                <div class="form-floating col-6">
                                    <select class="form-select mb-3" aria-label="Seleccionar Estatus" id="listStatus" name="listStatus">
                                        <option value="" selected>Seleccionar Estatus</option>
                                        <option value="1">Informes</option>
                                        <option value="2">Reservación</option>
                                        <option value="3">Cancelación</option>
                                        <option value="4">Visita</option>
                                    </select>
                                    <label for="listStatus" class="form-label">Estatus <span class="required">*</span></label>
                                </div>
                                <div class="form-floating col-6">
                                    <select class="form-select mb-3" aria-label="Seleccionar Medio de Contacto" id="listMedio" name="listMedio">
                                        <option value="" selected>Seleccionar Medio de Contacto</option>
                                        <option value="1">Telefónico</option>
                                        <option value="2">Presencial</option>
                                    </select>
                                    <label for="listMedio" class="form-label">Seleccionar Medio de Contacto <span class="required">*</span></label>
                                </div>
                                <div class="form-floating col-12 mb-3">
                                    <input type="text" class="form-control" id="txtFechaHr" name="txtFechaHr" placeholder="Fecha estimada de visita" required>
                                    <label for="txtFechaHr"><i class="fa-solid fa-calendar-days"></i> Fecha y horario estimado de visita <span class="required">*</span></label>
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
<div class="modal fade" id="modalViewMensaje" tabindex="-1" aria-hidden="true">
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
                            <td>Tipo de Evento:</td>
                            <td id="celEvento"></td>
                        </tr>
                        <tr>
                            <td>Medio de Contacto:</td>
                            <td id="celContacto"></td>
                        </tr>
                        <tr>
                            <td>Nombre Completo:</td>
                            <td id="celNombre"></td>
                        </tr>
                        <tr>
                            <td>Nombre de la Empresa:</td>
                            <td id="celEmpresa"></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celEstado"></td>
                        </tr>
                        <tr>
                            <td>Municipio:</td>
                            <td id="celMunicipio"></td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td id="celTel"></td>
                        </tr>
                        <tr>
                            <td>Celular:</td>
                            <td id="celCel"></td>
                        </tr>
                        <tr>
                            <td>Correo Electrónico:</td>
                            <td id="celEmail"></td>
                        </tr>
                        <tr>
                            <td>Número de Personas:</td>
                            <td id="celNumPer"></td>
                        </tr>
                        <tr>
                            <td>Fecha estimada de visita:</td>
                            <td id="celFechaHr"></td>
                        </tr>
                        <tr>
                            <td>Estado de Seguimiento:</td>
                            <td id="celStatusSeg"></td>
                        </tr>
                        <tr>
                            <td>Asunto:</td>
                            <td id="celAsunto"></td>
                        </tr>
                        <tr>
                            <td>Fecha:</td>
                            <td id="celFecha"></td>
                        </tr>
                        <tr>
                            <td>Mensaje:</td>
                            <td id="celMensaje"></td>
                        </tr>
                        <tr>
                            <td>IP:</td>
                            <td id="celIP"></td>
                        </tr>
                        <tr>
                            <td>Dispositivo:</td>
                            <td id="celDispositivo"></td>
                        </tr>
                        <tr>
                            <td>Navegador:</td>
                            <td id="celUseragent"></td>
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