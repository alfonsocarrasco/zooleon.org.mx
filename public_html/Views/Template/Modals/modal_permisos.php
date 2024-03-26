<!-- Modal -->
<div class="modal fade" id="modalFormPermisos" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Permisos de Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formPermisos">
                        <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required>
                        <div class="card">
                            <div class="card-body">
                                <table class="table mb-0 table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Módulo</th>
                                            <th scope="col">Ver</th>
                                            <th scope="col">Crear</th>
                                            <th scope="col">Actualizar</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $no = 1;
                                        $modulos = $data['modulos'];
                                        for ($i=0; $i < count($modulos); $i++) {

                                            $permisos = $modulos[$i]['permisos'];
                                            $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                            $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                            $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                            $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                            $idmod = $modulos[$i]['idmodulo'];
                                        
                                        ?>
                                            <tr>
                                                <td scope="row">
                                                    <?= $no; ?>
                                                    <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                                                </td>
                                                <td>
                                                    <?= $modulos[$i]['titulo']; ?>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?>>
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
								                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
									                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?>>
									                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
								                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>>
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>>
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-check2-circle"></i><span id="btnText"> Guardar</span></button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-box-arrow-right"></i> Salir</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>