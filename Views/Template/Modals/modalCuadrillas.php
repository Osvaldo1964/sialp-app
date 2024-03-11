<div class="modal fade" id="modalFormCuadrilla" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Cuadrilla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCuadrilla" name="formCuadrilla" class="form-horizontal">
                    <input type="hidden" id="idCuadrilla" name="idCuadrilla" value="">
                    <!-- <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p> -->
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" id="txtdesCuadrilla" name="txtdesCuadrilla" required="">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nombre Conductor</label>
                            <input type="text" class="form-control" id="txtconCuadrilla" name="txtconCuadrilla" required=""></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nombre Técnico</label>
                            <input type="text" class="form-control" id="txttecCuadrilla" name="txttecCuadrilla" required=""></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nombre Ayudante</label>
                            <input type="text" class="form-control" id="txtayuCuadrilla" name="txtayuCuadrilla" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listestCuadrilla">Estado</label>
                        <select class="form-control select2" id="listestCuadrilla" name="listestCuadrilla" required>
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
<div class="modal fade" id="modalViewCuadrilla" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la Cuadrilla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesCuadrilla">73111404</td>
                        </tr>
                        <tr>
                            <td>Conductor:</td>
                            <td id="celconCuadrilla">73111404</td>
                        </tr>
                        <tr>
                            <td>Técnico:</td>
                            <td id="celtecCuadrilla">73111404</td>
                        </tr>
                        <tr>
                            <td>Ayudante:</td>
                            <td id="celayuCuadrilla">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestCuadrilla">73111404</td>
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