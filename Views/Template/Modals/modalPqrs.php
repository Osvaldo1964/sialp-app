<div class="modal fade" id="modalFormPqrs" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Capitulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPqrs" name="formPqrs" class="form-horizontal">
          <input type="hidden" id="idPqrs" name="idPqrs" value="">
          <p class="text-primary">Todos los campos son obligatorios</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtnomPqrs">Nombre</label>
              <input type="text" class="form-control valid validText" id="txtnomPqrs" name="txtnomPqrs" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtemaPqrs">Correo</label>
              <input type="text" class="form-control valid validText" id="txtemaPqrs" name="txtemaPqrs" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtdirPqrs">Dirección</label>
              <input type="text" class="form-control valid validText" id="txtdirPqrs" name="txtdirPqrs" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtmsgPqrs">Mensaje</label>
              <input type="text" class="form-control valid validText" id="txtmsgPqrs" name="txtmsgPqrs" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtfsoPqrs">Fecha Solucionado:</label>
              <input type="date" class="date-picker form-control" id="txtfsoPqrs" name="txtfsoPqrs" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtdsoPqrs">Observaciones</label>
              <input type="text" class="form-control valid validText" id="txtdsoPqrs" name="txtdsoPqrs" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listestPqrs">Estado</label>
              <select class="form-control selectpicker" id="listestPqrs" name="listestPqrs" required>
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
<div class="modal fade" id="modalViewPqrs" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la PQR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody style="text-align: left;">
            <tr>
              <td>ID:</td>
              <td id="celidPqrs">73111404</td>
            </tr>
            <tr>
              <td>Nombre:</td>
              <td id="celnomPqrs">73111404</td>
            </tr>
            <tr>
              <td>Correo:</td>
              <td id="celemaPqrs">73111404</td>
            </tr>
            <tr>
              <td>Dirección:</td>
              <td id="celdirPqrs">73111404</td>
            </tr>
            <tr>
              <td>Fecha Reporte:</td>
              <td id="celfrePqrs">73111404</td>
            </tr>
            <tr>
              <td>Mensaje:</td>
              <td id="celmsgPqrs">73111404</td>
            </tr>
            <tr>
              <td>Fecha Solución:</td>
              <td id="celfsoPqrs">73111404</td>
            </tr>
            <tr>
              <td>Observaciones:</td>
              <td id="celdsoPqrs">73111404</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celestPqrs">73111404</td>
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