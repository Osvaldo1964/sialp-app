<div class="modal fade" id="modalFormCapitulo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Capitulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCapitulo" name="formCapitulo" class="form-horizontal">
          <input type="hidden" id="idCapitulo" name="idCapitulo" value="">
          <p class="text-primary">Todos los campos son obligatorios</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtnomCapitulo">Descripción</label>
              <input type="text" class="form-control valid validText" id="txtnomCapitulo" name="txtnomCapitulo" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listtipCapitulo">Tipo</label>
              <select class="form-control selectpicker" id="listtipCapitulo" name="listtipCapitulo" required>
                <option value="1">Ingreso</option>
                <option value="2">Gasto</option>
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
<div class="modal fade" id="modalViewCapitulo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Capitulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Descripción:</td>
              <td id="celnomCapitulo">73111404</td>
            </tr>
            <tr>
              <td>Tipo:</td>
              <td id="celtipCapitulo">73111404</td>
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