
<div class="modal fade modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" >Permisos Roles <?= $data['rol'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="tile">
                        <form action="" id="formPermisos" name="formPermisos">
                            <input type="hidden" id="idRol" name="idRol" value="<?= $data['idRol']; ?>" required="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Módulo</th>
                                            <th>Ver</th>
                                            <th>Crear</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $modulos = $data['modulos'];
                                        for ($i = 0; $i < count($modulos); $i++) {
                                            $permisos = $modulos[$i]['permisos'];
                                            $rCheck = $permisos['reaPermiso'] == 1 ? " checked " : "";
                                            $wCheck = $permisos['wriPermiso'] == 1 ? " checked " : "";
                                            $uCheck = $permisos['updPermiso'] == 1 ? " checked " : "";
                                            $dCheck = $permisos['delPermiso'] == 1 ? " checked " : "";
                                            $idmod = $modulos[$i]['idModulo'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no; ?>
                                                    <input type="hidden" name="modulos[<?= $i; ?>][idModulo]" value="<?= $idmod ?>" required>
                                                </td>
                                                <td>
                                                    <?= $modulos[$i]['titModulo']; ?>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][reaPermiso]" <?= $rCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][wriPermiso]" <?= $wCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][updPermiso]" <?= $uCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label>
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][delPermiso]" <?= $dCheck ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $no++; 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i> Guardar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="app-menu__icon fas fa-sign-out-alt" aria-hidden="true"></i> Salir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>