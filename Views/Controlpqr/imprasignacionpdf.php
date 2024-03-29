<?php
headerAdmin($data);
$nombreImagen =  media() . '/site/images/icons/logo_icaruscol.jpg';
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file-text-o"></i> <?= $data['page_title'] ?></h1>
            <p>Formato de Acta Imprimible</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Acta</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                if (empty($data['pqrs'])) {
                ?>
                    <p>Datos no encontrados</p>
                <?php } else {
                    $asignacion = $data['pqrs'];
                    //dep($asignacion);
                ?>
                    <section id="sActa" class="invoice">
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
                            <div class="col-4"><b>Asignacion No. <?= $asignacion[0]['idPqrs']; ?></b><br>
                                <b>Fecha:</b> <?= $asignacion[0]['asiPqrs']; ?><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Código UCAP</th>
                                            <th>Descripción</th>
                                            <th>Dirección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $asignacion[0]['codElemento'] ?></td>
                                            <td><?= $asignacion[0]['detElemento'] ?></td>
                                            <td><?= $asignacion[0]['dirElemento'] ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="1" class="text-left">Nombre Conductor: </th>
                                            <td colspan="2" class="text-left"><?= $asignacion[0]['conCuadrilla']; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="1" class="text-left">Nombre Técnico: </th>
                                            <td colspan="2" class="text-left"><?= $asignacion[0]['tecCuadrilla']; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="1" class="text-left">Nombre Ayudante: </th>
                                            <td colspan="2" class="text-left"><?= $asignacion[0]['ayuCuadrilla']; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="1" class="text-left">Fecha Reparación: </th>
                                            <td colspan="2" class="text-left">_________________________</td>
                                        </tr>
                                        <tr>
                                            <th colspan="1" class="text-left">Observaciones: </th>
                                            <td colspan="2" class="text-left">__________________________________</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#sAsignacion');"><i class="fa fa-print"></i> Imprimir</a></div>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>