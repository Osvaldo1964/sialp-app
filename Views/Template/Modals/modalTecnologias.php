<div class="modal fade" id="modalFormTecnologia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Tecnologia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTecnologia" name="formTecnologia" class="form-horizontal">
                    <input type="hidden" id="idTecno" name="idTecno" value="">
                    <!-- <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p> -->
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" id="txtdesTecno" name="txtdesTecno" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listestTecno">Estado</label>
                        <select class="form-control selectpicker" id="listestTecno" name="listestTecno" required>
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
<div class="modal fade" id="modalViewTecnologia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la Tecnologia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesTecno">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestTecno">73111404</td>
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