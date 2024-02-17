<div class="modal fade" id="modalFormValores" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formValores" name="formValores" class="form-horizontal">
                    <input type="hidden" id="idValorvar" name="idValorvar" value="">
                    <p class="text-primary">Todos los campos son obligatorios</p>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listVariable">Grupo <span class="required">*</span></label>
                            <select class="form-control" data-live-search="true" id="listVariable" name="listVariable" required=""></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtnitEmpresa">Documento</label>
                            <input type="text" class="form-control valid validNumber" id="txtnitEmpresa" name="txtnitEmpresa" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtnomEmpresa">Nombre</label>
                            <input type="text" class="form-control valid validText" id="txtnomEmpresa" name="txtnomEmpresa" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtdirEmpresa">Dirección</label>
                            <input type="text" class="form-control valid validText" id="txtdirEmpresa" name="txtdirEmpresa" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txttelEmpresa">Teléfono</label>
                            <input type="text" class="form-control valid validNumber" id="txttelEmpresa" name="txttelEmpresa" required="" onkeypress="return controlTag(event);">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtemaEmpresa">Correo Electrónico</label>
                            <input type="text" class="form-control valid validEmail" id="txtemaEmpresa" name="txtemaEmpresa" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listestEmpresa">Estado</label>
                            <select class="form-control selectpicker" id="listestEmpresa" name="listestEmpresa" required>
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
<div class="modal fade" id="modalViewEmpresa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Documento:</td>
                            <td id="celnitEmpresa">3</td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td id="celnomEmpresa">73111404</td>
                        </tr>
                        <tr>
                            <td>Dirección:</td>
                            <td id="celdirEmpresa">73111404</td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td id="celtelEmpresa">73111404</td>
                        </tr>
                        <tr>
                            <td>Correo Electrónico:</td>
                            <td id="celemaEmpresa">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestEmpresa">73111404</td>
                        </tr>
                        <tr>
                            <td>Fecha de Creación:</td>
                            <td id="celregEmpresa">73111404</td>
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