<div class="modal fade" id="modalFormAltura" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Altura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAltura" name="formAltura" class="form-horizontal">
                    <input type="hidden" id="idAltura" name="idAltura" value="">
                    <!-- <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p> -->
                    <div class="row col-md-12">
                        <div class="form-group col-md-12">
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" id="txtdesAltura" name="txtdesAltura" required="">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listestAltura">Estado</label>
                        <select class="form-control selectpicker" id="listestAltura" name="listestAltura" required>
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
<div class="modal fade" id="modalViewAltura" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la Altura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesAltura">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestAltura">73111404</td>
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