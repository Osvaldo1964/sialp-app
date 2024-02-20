<?php
    headerAdmin($data);
    getModal('modalFacturacion', $data); 
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user-tag"></i> <?= $data['page_title'] ?>
                <?php if ($_SESSION['permisosMod']['wriPermiso']) { ?>
                    <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa-solid fa-circle-plus"></i> Nuevo Grupo</button>
                <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/grupos"><?php echo $data['page_title'] ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableFacturacion">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Período</th>
                                    <th>Estrato</th>
                                    <th>Cant. Facturas</th>
                                    <th>valor Facturas</th>
                                    <th>Valor Reacudo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>