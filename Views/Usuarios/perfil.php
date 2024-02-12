<?php
    headerAdmin($data);
    getModal('modalPerfil', $data);
?>
<main class="app-content">
    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info"><img class="user-img" src="<?= media() ?>/images/avatar.png">
                    <h4><?= $_SESSION['userData']['nomUsuario'] . ' ' .
                            $_SESSION['userData']['apeUsuario'] ?></h4>
                    <p><?= $_SESSION['userData']['nomRol'] ?></p>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Datos personales</a></li>
                    <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Datos Comerciales</a></li>
                    <li class="nav-item"><a class="nav-link" href="#datos" data-toggle="tab">Otros</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="timeline-post">
                        <div class="post-media">
                            <div class="content">
                                <h5>DATOS PERSONALES <button class="btn btn-sm btn-info" type="button" onclick="openModalPerfil();">
                                        <i class="fas fa-pencil-alt" aria-hidden="true"></i></button></h5>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:150px;">Identificación:</td>
                                    <td><?= $_SESSION['userData']['docUsuario']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nombres:</td>
                                    <td><?= $_SESSION['userData']['nomUsuario']; ?></td>
                                </tr>
                                <tr>
                                    <td>Apellidos:</td>
                                    <td><?= $_SESSION['userData']['apeUsuario']; ?></td>
                                </tr>
                                <tr>
                                    <td>Teléfono:</td>
                                    <td><?= $_SESSION['userData']['telUsuario']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email (Usuario):</td>
                                    <td><?= $_SESSION['userData']['emaUsuario']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-settings">
                    <div class="tile user-settings">
                        <h4 class="line-head">Datos Comerciales</h4>
                        <form id="formDataFiscal" name="formDataFiscal">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label for="listipUsuario">Clase de Cliente</label>
                                    <select class="form-control" id="listipUsuario" name="listipUsuario">
                                        <option value="1">Corporativo</option>
                                        <option value="2">Particular</option>
                                        <option value="3">Especial</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Nombre Comercial</label>
                                    <input class="form-control valid validText" type="text" id="txtrazUsuario" name="txtrazUsuario" value="<?= $_SESSION['userData']['razUsuario']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mb-4">
                                    <label>Actividad Económica</label>
                                    <input class="form-control valid validText" type="text" id="txtactUsuario" name="txtactUsuario" value="<?= $_SESSION['userData']['actUsuario']; ?>">
                                </div>
                                <div class="col-md-5 mb-4">
                                    <label>Representante Legal</label>
                                    <input class="form-control valid validText" type="text" id="txtrepUsuario" name="txtrepUsuario" value="<?= $_SESSION['userData']['repUsuario']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="clearfix"></div>
                                <div class="col-md-5 mb-4">
                                    <label>Dirección</label>
                                    <input class="form-control valid validText" type="text" id="txtdirUsuario" name="txtdirUsuario" value="<?= $_SESSION['userData']['dirUsuario']; ?>">
                                </div>
                                <div class="col-md-5 mb-4">
                                    <label>Correo Electrónico</label>
                                    <input class="form-control" type="form-control valid validEmail" id="txtefaUsuario" name="txtefaUsuario" value="<?= $_SESSION['userData']['efaUsuario']; ?>">
                                </div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Grabar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="datos">
                    <div class="tile user-settings">
                        <p>Otros Datos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerAdmin($data); ?>