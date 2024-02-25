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
                                    <label for="fltvalActa">Valor Acta </label>
                                    <input type="text" class="form-control valid validEmail" id="fltvalActa" name="fltvalActa">
                                </div>
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
                                <span>Agregar PDF</span>
                                <button class="btnAddImage btn btn-info btn-sm" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <hr>
                            <div class="col-md-12" id="containerImages">
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
                <h5 class="modal-title" id="titleModal">Datos del Acta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Tipo de Acta:</td>
                            <td id="celtipActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Clase de Acta:</td>
                            <td id="celiteActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Núm. de Acta :</td>
                            <td id="celnumActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Fecha:</td>
                            <td id="celfecActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Recursos:</td>
                            <td id="celrecActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Valor Acta:</td>
                            <td id="celvalActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestActa">73111404</td>
                        </tr>
                        <tr>
                            <td>Pdf Acta:</td>
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

<!-- Modal para Ver Adicionar Elementos al Acta -->
<div class="modal fade" id="modalFormElemento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Elemento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formElemento" name="formElemento" class="form-horizontal">
                    <input type="hidden" id="idElemento" name="idElemento" value="">
                    <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="control-label">No. de Acta </label>
                            <input class="form-control" id="elenumActa" name="elenumActa" type="text" placeholder="" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Fecha del Acta </label>
                            <input class="form-control" id="elefecActa" name="elefecActa" type="date" placeholder="" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label class="control-label">Código </label>
                                <input class="form-control" id="txtcodElemento" name="txtcodElemento" type="text" placeholder="Código de barra" required="">
                                <br>
                                <div id="divBarCode" class="notblock textcenter">
                                    <div id="printCode">
                                        <svg id="barcode"></svg>
                                    </div>
                                    <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"><i class="fas fa-print"></i> Imprimir</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Dirección</label>
                                    <input type="text" class="form-control" id="txtdirElemento" name="txtdirElemento"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Latitud </label>
                                    <input class="form-control" id="fltlatElemento" name="fltlatElemento" type="text" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Longitud </label>
                                    <input class="form-control" id="fltlonElemento" name="fltlonElemento" type="text" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="listRecursos">Origen Recurso </label>
                                    <select class="form-control" data-live-search="true" id="listRecursos" name="listRecursos" required=""></select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="listUsos">Clase de Iluminación </label>
                                    <select class="form-control" data-live-search="true" id="listUsos" name="listUsos" required=""></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="listGrupos">Grupo </label>
                                    <select class="form-control" data-live-search="true" id="listGrupos" name="listGrupos" required=""></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listItems">SubGrupo </label>
                                    <select class="form-control" data-live-search="true" id="listItems" name="listItems" required=""></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fltvalElemento">Valor </label>
                                    <select class="form-control" data-live-search="true" id="fltvalElemento" name="fltvalElemento" required=""></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listestElemento">Estado</label>
                                    <select class="form-control selectpicker" id="listestElemento" name="listestElemento" required>
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