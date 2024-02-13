<div class="modal fade" id="modalFormGrupo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formGrupo" name="formGrupo" class="form-horizontal">
                    <input type="hidden" id="idGrupo" name="idGrupo" value="">
                    <p class="text-primary">Todos los campos son obligatorios</p>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listCapitulo">Capítulo <span class="required">*</span></label>
                            <select class="form-control" data-live-search="true" id="listCapitulo" name="listCapitulo" required=""></select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtdesGrupo">Descripción <span class="required">*</span></label>
                            <input type="text" class="form-control valid validText" id="txtdesGrupo" name="txtdesGrupo" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listestGrupo">Estado</label>
                            <select class="form-control selectpicker" id="listestGrupo" name="listestGrupo" required>
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
<div class="modal fade" id="modalViewGrupo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Capitulo:</td>
                            <td id="celnomCapitulo">3</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celestGrupo">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestEmpresa">73111404</td>
                        </tr>
                        <tr>
                            <td>Fecha de Creación:</td>
                            <td id="celcreGrupo">73111404</td>
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