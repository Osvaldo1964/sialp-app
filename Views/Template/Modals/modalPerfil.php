<div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPerfil" name="formPerfil" class="form-horizontal">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtdocUsuario">Documento <span class="required">*</span></label>
              <input type="text" class="form-control valid validNumber" id="txtdocUsuario" name="txtdocUsuario" value="<?= 
              $_SESSION['userData']['docUsuario']; ?>" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtnomUsuario">Nombres <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtnomUsuario" name="txtnomUsuario" value="<?= 
              $_SESSION['userData']['nomUsuario']; ?>" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtapeUsuario">Apellidos <span class="required">*</span></label>
              <input type="text" class="form-control valid validText" id="txtapeUsuario" name="txtapeUsuario" value="<?= 
              $_SESSION['userData']['apeUsuario']; ?>" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txttelUsuario">Teléfono <span class="required">*</span></label>
              <input type="text" class="form-control valid validNumber" id="txttelUsuario" name="txttelUsuario" value="<?= 
              $_SESSION['userData']['telUsuario']; ?>" required=""
                      onkeypress="return controlTag(event);">
            </div>
            <div class="form-group col-md-6">
              <label for="txtemaUsuario">Correo Electrónico</label>
              <input type="text" class="form-control valid validEmail" id="txtemaUsuario" name="txtemaUsuario" value="<?= 
              $_SESSION['userData']['emaUsuario']; ?>" required="" readonly disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtpasUsuario">Contraseña</label>
              <input type="password" class="form-control" id="txtpasUsuario" name="txtpasUsuario">
            </div>
            <div class="form-group col-md-6">
              <label for="txtpasUsuarioConfirm">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="txtpasUsuarioConfirm" name="txtpasUsuarioConfirm">
            </div>
          </div>
          <div class="tile-footer">
            <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>