<div class="modal fade" id="modalFormItems" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formItems" name="formItems" class="form-horizontal">
                    <input type="hidden" id="idItem" name="idItem" value="">
                    <p class="text-primary">Todos los campos son obligatorios</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="listGrupos">Grupos </label>
                            <select class="form-control" data-live-search="true" id="listGrupos" name="listGrupos" required=""></select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="txtdesItem">Descripción </label>
                            <input type="text" class="form-control valid" id="txtdesItem" name="txtdesItem" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="intcsmItem">Consumo </label>
                            <input type="text" class="form-control valid validNumber" id="intcsmItem" name="intcsmItem" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listestItem">Estado</label>
                            <select class="form-control selectpicker" id="listestItem" name="listestItem" required>
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
<div class="modal fade" id="modalViewItems" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Grupo:</td>
                            <td id="celnomGrupo">3</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesItem">73111404</td>
                        </tr>
                        <tr>
                            <td>Consumo:</td>
                            <td id="celcsmItem">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestItem">73111404</td>
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