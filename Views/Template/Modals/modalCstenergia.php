<div class="modal fade" id="modalFormCstenergia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Capitulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCstenergia" name="formCstenergia" class="form-horizontal">
                    <input type="hidden" id="idCosto" name="idCosto" value="">
                    <p class="text-primary">Todos los campos son obligatorios</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="intperCosto">Período <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="intperCosto" name="intperCosto" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="intcsmCosto">Consumo <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="intcsmCosto" name="intcsmCosto" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="intvlrCosto">Valor Kw/h <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="intvlrCosto" name="intvlrCosto" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inttotCosto">Total <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="inttotCosto" name="inttotCosto" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listestCosto">Estado</label>
                            <select class="form-control selectpicker" id="listestCosto" name="listestCosto" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Ver información de Registro del movimiento de costos -->
<div class="modal fade" id="modalViewCstenergia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Período:</td>
                            <td id="celperCosto">73111404</td>
                        </tr>
                        <tr>
                            <td>Consumo:</td>
                            <td id="celcsmCosto">73111404</td>
                        </tr>
                        <tr>
                            <td>Valor Kw/h:</td>
                            <td id="celvlrCosto">73111404</td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td id="celtotCosto">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestCosto">73111404</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>