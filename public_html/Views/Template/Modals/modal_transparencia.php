<!-- Modal -->
<div class="modal fade" id="modalFormTransparencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Formato</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formTransparencia">
                        <input type="hidden" id="idFormato" name="idFormato" value="0">
                        <div class="border p-3 rounded">
                            <p class="text-primary">Todos los campos con (<span class="required">*</span>) son oblogatorios.</p>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Ingrese el título">
                                    <label for="txtTitulo" class="form-label">Título Formato (Informacion de oficio, 2022, ...) <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" id="txtFormato" name="txtFormato" placeholder="Ingrese el nombre del formato">
                                    <label for="txtFormato" class="form-label">Formato (Normatividad, Presupuesto, Anual, ...) <span class="required">*</span></label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <select class="form-select" id="txtAnio" name="txtAnio">
                                        <option value="">Selecciona el año</option>
                                        <?php
                                            $year = date('Y');
                                            for ($i=2010; $i <= $year; $i++):
                                        ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php
                                            endfor;
                                        ?>
                                    </select>
                                    <label for="txtAnio" class="form-label">Año</label>
                                </div>
                            </div>
                            <div class="row g-1">
                                <div class="form-floating mb-3 col-12">
                                    <input type="text" class="form-control" id="txtSubtitulo" name="txtSubtitulo" placeholder="Ingrese el nombre de la acreditación">
                                    <label for="txtSubtitulo" class="form-label">Subtitulo Formato (Disposiciones Administrativas..., ) <span class="required">*</span></label>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtFilePDF" class="form-label">Formato PDF</label>
                                    <input class="form-control" type="file" id="txtFilePDF" name="txtFilePDF">
                                    <input type="hidden" id="filePDFActual" name="filePDFActual" value="">
                                    <span class="badge rounded-pill bg-success filePDFActual"></span>
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="txtFileXLS" class="form-label">Formato XLS</label>
                                    <input class="form-control" type="file" id="txtFileXLS" name="txtFileXLS">
                                    <input type="hidden" id="fileXLSActual" name="fileXLSActual" value="">
                                    <span class="badge rounded-pill bg-success fileXLSActual"></span>
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
<div class="modal fade" id="modalViewTransparencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del Formato</h5>
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
                            <td>Título</td>
                            <td id="celTitulo"></td>
                        </tr>
                        <tr>
                            <td>Formato</td>
                            <td id="celFormato"></td>
                        </tr>
                        <tr>
                            <td>Año</td>
                            <td id="celAnio"></td>
                        </tr>
                        <tr>
                            <td>Subtitulo</td>
                            <td id="celSubtitulo"></td>
                        </tr>
                        <tr>
                            <td>Archivo PDF</td>
                            <td id="celPDF"></td>
                        </tr>
                        <tr>
                            <td>Archivo XLS</td>
                            <td id="celXLS"></td>
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