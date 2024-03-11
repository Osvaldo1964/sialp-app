<?php
headerAdmin($data);
getModal('modalCuadrillas', $data);
?>
<!-- Content Wrapper. Contains page content -->
<br>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="app-title">
        <div>
            <h2 style="padding-left: .5cm;"><i class="fa-solid fa-people-group"></i> <?= $data['page_title'] ?>
                <?php if ($_SESSION['permisosMod']['wriPermiso']) { ?>
                    <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fa-solid fa-circle-plus"></i> Nueva Cuadrilla</button>
                <?php } ?>
            </h2>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/cuadrillas"><?php echo $data['page_title'] ?></a></li>
        </ul>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php footerAdmin($data); ?>