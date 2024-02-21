<div class="modal fade" id="modalFormFacturacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formFacturacion" name="formFacturacion" class="form-horizontal">
                    <input type="hidden" id="idFactura" name="idFactura" value="">
                    <p class="text-primary">Todos los campos son obligatorios</p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="intperFactura">Período <span class="required">*</span></label>
                            <input type="text" class="form-control valid validNumber" id="intperFactura" name="intperFactura" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listEstrato">Estrato <span class="required">*</span></label>
                            <select class="form-control" data-live-search="true" id="listEstrato" name="listEstrato" required=""></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="intcanFactura">Cantidad <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="intcanFactura" name="intcanFactura" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="intfacFactura">Facturado <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="intfacFactura" name="intfacFactura" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="intrecFactura">Recaudo <span class="required">*</span></label>
                            <input type="number" class="form-control valid validNumber" id="intrecFactura" name="intrecFactura" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listestFactura">Estado</label>
                            <select class="form-control selectpicker" id="listestFactura" name="listestFactura" required>
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
<div class="modal fade" id="modalViewFacturacion" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <td style="text-align: left;">Período:</td>
                            <td id="celperFactura" style="text-align: left;">3</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Estrato:</td>
                            <td id="celdesEstrato" style="text-align: left;">3</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Cantidad Facturas:</td>
                            <td id="celcanFactura" style="text-align: right;">73111404</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Valor Facturado:</td>
                            <td id="celfacFactura" style="text-align: right;">73111404</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Valor Recaudado:</td>
                            <td id="celrecFactura" style="text-align: right;">73111404</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Estado:</td>
                            <td id="celestFactura">73111404</td>
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