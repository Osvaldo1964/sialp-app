<?php
headerAdmin($data);
getModal('modalClientes', $data);
dep($data);
?>
<section class="content">
    <div class="row">
        <!-- FORMULARIO -->
        <div class="col-lg-5 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border"></div>
                <div class="box-body">
                    <form role="form" method="post">
                        <div class="box">
                            <!-- Vendedor -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Vendedor</span>
                                </div>
                            </div>
                            <!-- Vendedor -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Vendedor</span>
                                </div>
                            </div>
                            <!-- Vendedor -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Factura</span>
                                </div>
                            </div>
                            <!-- Cliente -->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Cliente</span>
                                </div>
                            </div>
                            <!-- Agregar Producto -->
                            <div class="form-group row nuevoProducto">
                                <div class="col-xs-6" style="padding-right: 0px;">

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php footerAdmin($data); ?>