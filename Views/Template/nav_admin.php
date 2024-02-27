    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nomUsuario']; ?></p>
                <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nomRol']; ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <?php if (!empty($_SESSION['permisos'][MPQRS]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                        <span class="app-menu__label">CONTROL PQRs</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/pqrs"><i class="icon fa fa-circle-o"></i> Registro PQRs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/controlpqr"><i class="icon fa fa-circle-o"></i> Seguimiento PQRs</a></li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                                <span class="app-menu__label">REPORTES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/informepqrs01"><i class="icon fa fa-circle-o"></i> Reporte PQRs por Rango de Fechas</a></li>
                                <!-- <li><a class="treeview-item" href="<?= base_url(); ?>/controlpqr"><i class="icon fa fa-circle-o"></i> Seguimiento PQRs</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">INVENTARIO UCAPs</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/grupossalp"><i class="icon fa fa-circle-o"></i> Grupos UCAPs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/items"><i class="icon fa fa-circle-o"></i> Subgrupos UCAPs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/elementos"><i class="icon fa fa-circle-o"></i> Elementos UCAPs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/tipoactas"><i class="icon fa fa-circle-o"></i> Tipos de Actas</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/censo"><i class="icon fa fa-circle-o"></i> Censo Valorizado</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">COSTOS Y PAGOS ENERGIA</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/comercializadores"><i class="icon fa fa-circle-o"></i> comercializadores</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/cstenergia"><i class="icon fa fa-circle-o"></i> Registro Consumo Energia </a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/"><i class="icon fa fa-circle-o"></i> Informe de Consumos</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">FACTURACION Y RECAUDOS</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/cargafacturacion"><i class="icon fa fa-circle-o"></i> Carga Facturación</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/facturacion"><i class="icon fa fa-circle-o"></i> Carga Manual</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/"><i class="icon fa fa-circle-o"></i> Informe de Facturación/Recaudos</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label"> COSTOS MAXIMOS</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/varsalp"><i class="icon fa fa-circle-o"></i> Variables SALP</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/valorvrsalp"><i class="icon fa fa-circle-o"></i> Registo de Valores de variables</a></li>
                    </ul>
                </li>
            <?php } ?>



            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">INVERSIONES</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/actas"><i class="icon fa fa-circle-o"></i> Registro Inversiones</a></li>1
                        <!-- <li><a class="treeview-item" href="<?= base_url(); ?>/"><i class="icon fa fa-circle-o"></i> ****</a></li> -->
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MESTRUCTURA]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">MODELACION FINANCIERA</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/capitulos"><i class="icon fa fa-circle-o"></i> Capítulos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/grupos"><i class="icon fa fa-circle-o"></i> Grupos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/subgrupos"><i class="icon fa fa-circle-o"></i> SubGrupos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/conceptos"><i class="icon fa fa-circle-o"></i> Conceptos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/auxiliares"><i class="icon fa fa-circle-o"></i> Auxiliares</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MGENERALES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                        <span class="app-menu__label">PARAMETROS GENERALES</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/parametros"><i class="icon fa fa-circle-o"></i> Configuración</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                    </ul>
                </li>
            <?php } ?>

            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                    <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                    <span class="app-menu__label">CERRAR SESION</span>
                </a>
            </li>
        </ul>
    </aside>