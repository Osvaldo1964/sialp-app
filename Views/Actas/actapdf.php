<?php
headerAdmin($data);
$nombreImagen =  media() . '/site/images/icons/logo_icaruscol.jpg';
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
            <p>Formato de Orden Imprimible</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Orden</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                if (empty($data['arrPedido'])) {
                ?>
                    <p>Datos no encontrados</p>
                <?php } else {
                    $acta = $data['arrPedido'];
                    dep($acta);
                ?>
                    <section id="sPedido" class="invoice">
                        <div class="row mb-4">
                            <div class="wd33">
                                <img src="<?php echo $imagenBase64 ?>" alt="Logo">
                                <!--  <h2 class="page-header" style="width: 50px; height: 500px"><img src="<?= media(); ?>/site/images/icons/logo_icaruscol.jpg"></h2> -->
                            </div>
                            <div class="col-6">
                                <!-- <h5 class="text-right">Fecha: <?= $orden['fecPedido']; ?></h5> -->
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">
                                <address><strong><?= NOMBRE_EMPRESA; ?></strong><br>
                                    <?= DIRECCION; ?><br>
                                    <?= TELEMPRESA; ?><br>
                                    <?= EMAIL_EMPRESA; ?><br>
                                    <?= WEB_EMPRESA; ?><br>
                                </address>
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4"><b>Orden No. <?= $acta[0]['numActa']; ?></b><br>
                                <b>Fecha:</b> <?= $acta[0]['fecActa']; ?><br>
                                <b>Estado:</b> <?= $acta[0]['estActa']; ?><br>
                                <b>Total Acta:</b> <?= SMONEY . formatMoney($acta[0]['valActa']); ?><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        if (count($detalle) > 0) {
                                            foreach ($detalle as $producto) {
                                        ?>
                                                <tr>
                                                    <td class="text-left"><?= $producto['nomProducto']; ?></td>
                                                    <td class="text-right"><?= SMONEY . formatMoney($producto['vtaBody']); ?></td>
                                                    <td class="text-right"><?= SMONEY . formatMoney($producto['canBody']); ?></td>
                                                    <td class="text-right"><?= SMONEY . formatMoney($producto['vtaBody'] * $producto['canBody']); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Sub-Total:</th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($subtotal) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Envío:</th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney(COSTOENVIO) ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Total:</th>
                                            <td class="text-right"><?= SMONEY . ' ' . formatMoney($orden['valPedido']) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sPedido');"><i class="fa fa-print"></i> Imprimir</a></div>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>