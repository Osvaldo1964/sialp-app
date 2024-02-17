<div class="modal fade" id="modalFormValorvar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formValorvar" name="formValorvar" class="form-horizontal">
                    <input type="hidden" id="idValorvar" name="idValorvar" value="">
                    <p class="text-primary">Todos los campos son obligatorios</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="control-label">Variable<span class="required">*</span></label>
                            <input type="text" class="form-control" id="txtcodValorvar" name="txtcodValorvar" required="">
                        </div>>
                        <div class="form-group col-md-6">
                            <label for="txtdesVarsalp">Descripción <span class="required">*</span></label>
                            <input type="text" class="form-control valid validText" id="txtdesVarsalp" name="txtdesVarsalp" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listestVarsalp">Estado</label>
                            <select class="form-control selectpicker" id="listestVarsalp" name="listestVarsalp" required>
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

<!-- Modal para Ver información de Empresas -->
<div class="modal fade" id="modalViewValorvar" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <tbody style="text-align: left;">
                        <tr>
                            <td>Código:</td>
                            <td id="celcodValorvar">3</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesVarsalp">73111404</td>
                        </tr>
                        <tr>
                            <td>Desde:</td>
                            <td id="celiniVarsalp">73111404</td>
                        </tr>
                        <tr>
                            <td>Hasta:</td>
                            <td id="celfinVarsalp">73111404</td>
                        </tr>
                        <tr>
                            <td>Tipo (Valor/Porcentaje):</td>
                            <td id="celtipVarsalp">73111404</td>
                        </tr>
                        <tr>
                            <td>Valor:</td>
                            <td id="celvalVarsalp">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestValorvar">73111404</td>
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