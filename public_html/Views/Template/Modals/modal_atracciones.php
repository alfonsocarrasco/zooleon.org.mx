<!-- Modal -->
<div class="modal fade" id="modalFormAtraccion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Atracción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formAtraccion">
                        <input type="hidden" id="idAtraccion" name="idAtraccion" value="0">
                        <input type="hidden" name="foto_actual" id="foto_actual" value="">
                        <input type="hidden" name="foto_remove" id="foto_remove" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Título">
                                    <label for="txtTitulo" class="form-label">Título Atracción <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtDescripcion" class="form-label">Descripción Atracción <span class="required">*</span></label>
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
                                    <input type="text" class="form-control" id="txtDias" name="txtDias" placeholder="Ingresa los días">
                                    <label for="txtDias" class="form-label">Días Apertura</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="time" class="form-control" id="txtHorarioA" name="txtHorarioA" placeholder="Ingresa el horario de apertura">
                                    <label for="txtHorarioA" class="form-label">Horario de Apertura</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="time" class="form-control" id="txtHorarioC" name="txtHorarioC" placeholder="Ingresa el horario de cierre">
                                    <label for="txtHorarioC" class="form-label">Horario de Cierre</label>
                                </div>
                                <hr>
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtDias2" name="txtDias2" placeholder="Ingresa los días">
                                    <label for="txtDias2" class="form-label">Días Apertura 2 (opcional)</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="time" class="form-control" id="txtHorarioA2" name="txtHorarioA2" placeholder="Ingresa el horario de apertura">
                                    <label for="txtHorarioA2" class="form-label">Horario de Apertura</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="time" class="form-control" id="txtHorarioC2" name="txtHorarioC2" placeholder="Ingresa el horario de cierre">
                                    <label for="txtHorarioC2" class="form-label">Horario de Cierre</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtCosto" name="txtCosto" placeholder="Ingresa el costo">
                                    <label for="txtCosto" class="form-label">($) Costo Persona</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtCosto3" name="txtCosto3" placeholder="Ingresa el costo">
                                    <label for="txtCosto3" class="form-label">($) Costo Niño</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtCosto2" name="txtCosto2" placeholder="Ingresa el costo">
                                    <label for="txtCosto2" class="form-label">($) Costo Mascota</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="number" min="1" class="form-control" id="intPosicion" name="intPosicion" placeholder="Ingresa el orden">
                                    <label for="intPosicion" class="form-label">Ingrese el orden</label>
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
<div class="modal fade" id="modalViewAtraccion" tabindex="-1" aria-hidden="true">
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
                            <td>Días apertura</td>
                            <td id="celDias"></td>
                        </tr>
                        <tr>
                            <td>Horario apertura</td>
                            <td id="celHorario"></td>
                        </tr>
                        <tr>
                            <td>Costo Persona</td>
                            <td id="celCosto"></td>
                        </tr>
                        <tr>
                            <td>Costo Niño</td>
                            <td id="celCosto3"></td>
                        </tr>
                        <tr>
                            <td>Costo Mascota</td>
                            <td id="celCosto2"></td>
                        </tr>
                        <tr>
                            <td>Días apertura 2</td>
                            <td id="celDias2"></td>
                        </tr>
                        <tr>
                            <td>Horario apertura</td>
                            <td id="celHorario2"></td>
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