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
                        <div class="col-md-4">
                            <div class="form-group">
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
                                    <label class="control-label">Latitud </label>
                                    <input class="form-control" id="fltlatElemento" name="fltlatElemento" type="text" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Longitud </label>
                                    <input class="form-control" id="fltlonElemento" name="fltlonElemento" type="text" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="listOrigen">Origen Recurso </label>
                                    <select class="form-control" data-live-search="true" id="listOrigen" name="listOrigen" required=""></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label for="listClase">Clase de Iluminación </label>
                                    <select class="form-control" data-live-search="true" id="listClase" name="listClase" required=""></select>
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
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Descripción Elemento</label>
                                    <textarea class="form-control" id="txtdesElemento" name="txtdesElemento"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Dirección</label>
                                    <input type="text" class="form-control" id="txtdirElemento" name="txtdirElemento"></textarea>
                                </div>
                                <hr>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Acta Ingreso</label>
                                    <input type="text" class="form-control" id="txtainElemento" name="txtainElemento"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Fecha Ingreso</label>
                                    <input type="text" class="form-control" id="txtfinElemento" name="txtfinElemento"></textarea>
                                </div>
                                <hr>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Acta de Baja</label>
                                    <input type="text" class="form-control" id="txtabaElemento" name="txtabaElemento"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Fecha de Baja</label>
                                    <input type="text" class="form-control" id="txtfbaElemento" name="txtfbaElemento"></textarea>
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

<!-- Modal para Ver información de Categorías -->
<div class="modal fade" id="modalViewElemento" tabindex="-1" role="dialog" aria-hidden="true">
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