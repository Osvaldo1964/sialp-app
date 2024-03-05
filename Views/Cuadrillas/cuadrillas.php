<?php
    headerAdmin($data);
    getModal('modalCuadrillas', $data);
?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-box-tissue"></i> <?= $data['page_title'] ?>
                <?php if ($_SESSION['permisosMod']['wriPermiso']) { ?>
                    <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa-solid fa-circle-plus"></i> Nueva Cuadrilla</button>
                <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/Cuadrillas"><?php echo $data['page_title'] ?></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableCuadrillas">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Conductor</th>
                                    <th>Técnico</th>
                                    <th>Ayudante</th>
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