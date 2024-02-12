<div class="modal fade" id="modalFormProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProducto" name="formProducto" class="form-horizontal">
                    <input type="hidden" id="idProducto" name="idProducto" value="">
                    <p class="text-primary">Todos los campos con (<span class="required">*</span>) son obligatorios</p>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Nombre Producto<span class="required">*</span></label>
                                <input type="text" class="form-control" id="txtnomProducto" name="txtnomProducto" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripción Producto</label>
                                <textarea class="form-control" id="txtdesProducto" name="txtdesProducto"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Código <span class="required">*</span></label>
                                <input class="form-control" id="txtcodProducto" name="txtcodProducto" type="text" placeholder="Código de barra" required="">
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
                                    <label class="control-label">Precio Venta <span class="required">*</span></label>
                                    <input class="form-control" id="txtvtaProducto" name="txtvtaProducto" type="text" placeholder="" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Existencia <span class="required">*</span></label>
                                    <input class="form-control" id="txtstoProducto" name="txtstoProducto" type="text" placeholder="" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="listidCategoria">Categoría <span class="required">*</span></label>
                                    <select class="form-control" data-live-search="true" id="listidCategoria" name="listidCategoria" required=""></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listestProducto">Estado<span class="required">*</span></label>
                                    <select class="form-control selectpicker" id="listestProducto" name="listestProducto" required>
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
 -->                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Ver información de Categorías -->
<div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Código:</td>
                            <td id="celcodProducto">73111404</td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td id="celnomProducto">73111404</td>
                        </tr>
                        <tr>
                            <td>Precio Venta:</td>
                            <td id="celvtaProducto">73111404</td>
                        </tr>
                        <tr>
                            <td>Existencia:</td>
                            <td id="celstoProducto">73111404</td>
                        </tr>
                        <tr>
                            <td>Categoría:</td>
                            <td id="celnomCategoria">73111404</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celestProducto">73111404</td>
                        </tr>
                        <tr>
                            <td>Descripción:</td>
                            <td id="celdesProducto">73111404</td>
                        </tr>
                        <tr>
                            <td>Fotos del Producto:</td>
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