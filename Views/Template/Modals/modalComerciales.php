<div class="modal fade" id="modalFormComerciales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Comerciales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formComerciales" name="formComerciales" class="form-horizontal">
                    <input type="hidden" id="idComercial" name="idComercial" value="">
                    <!-- <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p> -->
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label class="control-label">Entidad</label>
                            <input type="text" class="form-control" id="txtnomComercial" name="txtnomComercial" required="">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">No. Contrato</label>
                            <input type="text" class="form-control" id="txtcntComercial" name="txtcntComercial" required=""></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Valor</label>
                            <input type="number" class="form-control" id="fltvalComercial" name="fltvalComercial" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listestComercial">Estado</label>
                        <select class="form-control selectpicker" id="listestComercial" name="listestComercial" required>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
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

<!-- Modal para Ver información de Categorías -->
<div class="modal fade" id="modalViewComerciales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la Comerciales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Entidad:</td>
                            <td id="celnomComercial">73111404</td>
                        </tr>
                        <tr>
                            <td>No. Contrato:</td>
                            <td id="celcntComercial">73111404</td>
                        </tr>
                        <tr>
                            <td>Valor:</td>
                            <td id="celvalComercial">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestComercial">73111404</td>
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