<div class="modal fade" id="modalFormGruposalp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Grupo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formGruposalp" name="formGruposalp" class="form-horizontal">
          <input type="hidden" id="idGruposalp" name="idGruposalp" value="">
          <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Código<span class="required">*</span></label>
                <input type="text" class="form-control" id="txtcodGruposalp" name="txtcodGruposalp" required="">
              </div>
              <div class="form-group">
                <label class="control-label">Descripción<span class="required">*</span></label>
                <textarea class="form-control" id="txtdesGruposalp" name="txtdesGruposalp" required=""></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Vida Util<span class="required">*</span></label>
                <textarea class="form-control" id="fltvidGruposalp" name="fltvidGruposalp" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="listtipGruposalp">Tipo Grupo<span class="required">*</span></label>
                <select class="form-control selectpicker" id="listtipGruposalp" name="listtipGruposalp" required>
                  <option value="1">Eléctrico</option>
                  <option value="2">No Eléctrico</option>
                </select>
              </div>
              <div class="form-group">
                <label for="listestGruposalp">Estado<span class="required">*</span></label>
                <select class="form-control selectpicker" id="listestGruposalp" name="listestGruposalp" required>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
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

<!-- Modal para Ver información de Categorías -->
<div class="modal fade" id="modalViewGruposalp" tabindex="-1" role="dialog" aria-hidden="true">
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
              <td>Código:</td>
              <td id="celcodGruposalp">73111404</td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celdesGruposalp">73111404</td>
            </tr>
            <tr>
              <td>Vida Util:</td>
              <td id="celvidGruposalp">73111404</td>
            </tr>
            <tr>
              <td>Tipo:</td>
              <td id="celtipGruposalp">73111404</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celestGruposalp">73111404</td>
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