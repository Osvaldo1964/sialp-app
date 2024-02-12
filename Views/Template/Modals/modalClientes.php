<!-- Modal Clientes -->
<div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCliente" name="formCliente" class="form-horizontal">
          <input type="hidden" id="idCliente" name="idCliente" value="">
          <p class="text-primary">Los campos con asterisco (<i class="fa-solid fa-asterisk" style="color: #fa0000;"></i>) son obligatorios</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="listdoCliente">Tipo Documento <span class="required">*</span></label>
              <select class="form-control selectpicker" id="listdoCliente" name="listdoCliente">
                <option value="1">Cédula de Ciudadanía</option>
                <option value="2">Cédula de Extranjería</option>
                <option value="3">Pasaporte</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="txtdocCliente">Documento <span class="required">*</span></label>
              <input type="text" class="form-control" id="txtdocCliente" name="txtdocCliente">
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
              <label for="txtnomCliente">Nombres <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtnomCliente" name="txtnomCliente">
            </div>
            <div class="form-group col-md-6">
              <label for="txtapeCliente">Apellidos <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtapeCliente" name="txtapeCliente">
            </div>
        </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="txtdirCliente">Dirección <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtdirCliente" name="txtdirCliente">
            </div>
            <div class="form-group col-md-4">
              <label for="txttelCliente">Teléfono <span class="required">*</span></label>
              <input type="text" class="form-control valid validNumber" id="txttelCliente" name="txttelCliente" onkeypress="return controlTag(event);">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="txtemaCliente">Correo Electrónico <span class="required">*</span></label>
              <input type="text" class="form-control valid validEmail" id="txtemaCliente" name="txtemaCliente">
            </div>
            <div class="form-group col-md-4">
              <label for="txtpasCliente">Contraseña <span class="required"></span></label>
              <input type="password" class="form-control" id="txtpasCliente" name="txtpasCliente">
            </div>
          </div>
          <hr>
          <p class="text-primary">Información Comercial</p>
          <div class="form-row">
            <div class="form-group col-md-3"> 
              <label for="listipCliente">Clase de Cliente<span class="required">*</span></label>
              <select class="form-control" id="listipCliente" name="listipCliente">
                <option value="1">Corporativo</option>
                <option value="2">Particular</option>
                <option value="3">Especial</option>
              </select>
            </div>
            <div class="form-group col-md-9">
              <label for="txtrazCliente">Razón Social<span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtrazCliente" name="txtrazCliente">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="txtactCliente">Actividad<span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtactCliente" name="txtactCliente">
            </div>
            <div class="form-group col-md-9">
              <label for="txtrepCliente">Representante Legal<span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtrepCliente" name="txtrepCliente">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="txtefaCliente">Correo para Factura Electrónica <span class="required">*</span></label>
              <input type="text" class="form-control valid validEmail" id="txtefaCliente" name="txtefaCliente">
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

<!-- Modal para Ver información de Clientes-->
<div class="modal fade" id="modalViewCliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">datos del Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Tipo Doc:</td>
              <td id="celtdoCliente">3</td>
            </tr>
            <tr>
              <td>Documento:</td>
              <td id="celdocCliente">3</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celnomCliente">73111404</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celapeCliente">73111404</td>
            </tr>
            <tr>
              <td>Dirección:</td>
              <td id="celdirCliente">73111404</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celtelCliente">73111404</td>
            </tr>
            <tr>
              <td>Correo Electrónico:</td>
              <td id="celemaCliente">73111404</td>
            </tr>
            <tr>
              <td>Fecha de Creación:</td>
              <td id="celregCliente">73111404</td>
            </tr>
            <tr>
              <td>Tipo de Cliente:</td>
              <td id="celtipCliente">73111404</td>
            </tr>
            <tr>
              <td>Razón Social:</td>
              <td id="celrazCliente">73111404</td>
            </tr>
            <tr>
              <td>Actividad Económica:</td>
              <td id="celactCliente">73111404</td>
            </tr>
            <tr>
              <td>Rep. Legal:</td>
              <td id="celrepCliente">73111404</td>
            </tr>
            <tr>
              <td>Correo Factura Electrónica:</td>
              <td id="celefaCliente">73111404</td>
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