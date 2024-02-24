<!-- Modal para Cabecera de Actas -->
<div class="modal fade" id="modalFormActas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Acta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formActa" name="formActa" class="form-horizontal">
                    <input type="hidden" id="idActa" name="idActa" value="">
                    <input type="hidden" id="foto_actual" name="foto_actual" value="">
                    <input type="hidden" id="foto_remove" name="foto_remove" value="0">
                    <p class="text-primary">Todos los campos son obligatorios</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="listClases">Clase de Acta </label>
                                    <select class="form-control" data-live-search="true" id="listClases" name="listClases" required=""></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Número Acta </label>
                                    <input class="form-control" id="txtnumActa" name="txtnumActa" type="text" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Fecha </label>
                                    <input class="form-control date-picker" id="txtfecActa" name="txtfecActa" type="date" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="listRecursos">Origen Recurso </label>
                                    <select class="form-control" data-live-search="true" id="listRecursos" name="listRecursos" required=""></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="listestActa">Estado</label>
                                    <select class="form-control selectpicker" id="listestActa" name="listestActa" required>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <button id="btnActionForm" class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="form-group col-md-6">
                                    <button class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="form-group col-md-12">
                            <div id="containerGallery">
                                <span>Agregar Fotos (440 x 545)</span>
                                <button class="btnAddImage btn btn-info btn-sm" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <hr>
                            <div id="containerImages">
                                <!--                                 <div id="div24">
                                    <div class="prevImage">
                                        <img class="loading" src="<?= media(); ?>/images/loading.svg">
                                    </div>
                                    <input type="file" name="foto" id="img1" class="inputUploadfile">
                                    <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                                    <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                <div id="div24">
                                    <div class="prevImage">
                                        <img src="<?= media(); ?>/images/uploads/baseimagen.jpg">
                                    </div>
                                    <input type="file" name="foto" id="img1" class="inputUploadfile">
                                    <label for="img1" class="btnUploadfile"><i class="fas fa-upload"></i></label>
                                    <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                                </div>
 -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Ver información de Actas -->
<div class="modal fade" id="modalViewActa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Elemento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Código:</td>
                            <td id="celcodElemento">73111404</td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td id="celnomElemento">73111404</td>
                        </tr>
                        <tr>
                            <td>Latitud:</td>
                            <td id="cellatElemento">73111404</td>
                        </tr>
                        <tr>
                            <td>Longitud:</td>
                            <td id="cellonElemento">73111404</td>
                        </tr>
                        <tr>
                            <td>Grupo:</td>
                            <td id="celdesGrupo">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestElemento">73111404</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesElemento">73111404</td>
                        </tr>
                        <tr>
                            <td>Fotos del Elemento:</td>
                            <td id="celFotos">73111404</td>
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