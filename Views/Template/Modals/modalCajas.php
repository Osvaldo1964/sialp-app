<!-- Modal Cajas -->
<div class="modal fade" id="modalFormCaja" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nueva Caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCaja" name="formCaja" class="form-horizontal">
          <input type="hidden" id="idCaja" name="idCaja" value="">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtdesCaja">Descripción <span class="required">*</span></label>
              <input type="text" class="form-control" id="txtdesCaja" name="txtdesCaja">
            </div>
          </div>
          <hr>
          <br>
          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Ver información de la Caja -->
<div class="modal fade" id="modalViewCaja" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">datos de la Caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Descripción:</td>
              <td id="celdesCaja">3</td>
            </tr>
            <tr>
              <td>Usuario:</td>
              <td id="celnomUsuario">73111404</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celestCaja">73111404</td>
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