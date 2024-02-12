<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario" class="form-horizontal">
          <input type="hidden" id="idUsuario" name="idUsuario" value="">
          <p class="text-primary">Todos los campos son obligatorios</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtdocUsuario">Documento</label>
              <input type="text" class="form-control valid validNumber" id="txtdocUsuario" name="txtdocUsuario" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtnomUsuario">Nombres</label>
              <input type="text" class="form-control valid validText" id="txtnomUsuario" name="txtnomUsuario" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtapeUsuario">Apellidos</label>
              <input type="text" class="form-control valid validText" id="txtapeUsuario" name="txtapeUsuario" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txttelUsuario">Teléfono</label>
              <input type="text" class="form-control valid validNumber" id="txttelUsuario" name="txttelUsuario" required=""
                      onkeypress="return controlTag(event);">
            </div>
            <div class="form-group col-md-6">
              <label for="txtemaUsuario">Correo Electrónico</label>
              <input type="text" class="form-control valid validEmail" id="txtemaUsuario" name="txtemaUsuario" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listidRol">Rol del Usuario</label>
              <select class="form-control" data-live-search="true" id="listidRol" name="listidRol" required>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="listestUsuario">Estado</label>
              <select class="form-control selectpicker" id="listestUsuario" name="listestUsuario" required>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtpasUsuario">Contraseña</label>
              <input type="password" class="form-control" id="txtpasUsuario" name="txtpasUsuario">
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

<!-- Modal para Ver información de Usuarios-->
<div class="modal fade" id="modalViewUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">datos del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Documento:</td>
              <td id="celdocUsuario">3</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celnomUsuario">73111404</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celapeUsuario">73111404</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celtelUsuario">73111404</td>
            </tr>
            <tr>
              <td>Correo Electrónico:</td>
              <td id="celemaUsuario">73111404</td>
            </tr>
            <tr>
              <td>Rol:</td>
              <td id="celrolUsuario">73111404</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celestUsuario">73111404</td>
            </tr>
            <tr>
              <td>Fecha de Creación:</td>
              <td id="celregUsuario">73111404</td>
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