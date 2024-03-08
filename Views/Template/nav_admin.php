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
                        <!--                         <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                        <span class="app-menu__label">CONTROL PQRs</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">VARIABLES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/cuadrillas"> Cuadrillas</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">MOVIMIENTOS</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/pqrs"> Registro PQRs</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/controlpqr"> Seguimiento PQRs</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">REPORTES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/informepqrs01"> Reporte PQRs por Rango de Fechas</a></li>
                                <!-- <li><a class="treeview-item" href="<?= base_url(); ?>/controlpqr"> Seguimiento PQRs</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i> -->
                        <span class="app-menu__label">INVENTARIO UCAPs</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">VARIABLES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/elementos"> Elementos UCAPs</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">MOVIMIENTOS</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a class="app-menu__item" href="#" data-toggle="treeview">
                                        <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                        <span class="app-menu__label">ENTRADAS</span>
                                        <i class="treeview-indicator fa fa-angle-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a class="treeview-item" href="<?= base_url(); ?>/elementos"> Inv. Inicial Lote</a></li>
                                        <li><a class="treeview-item" href="<?= base_url(); ?>/invinicial"> Inv. Inicial Manual</a></li>
                                    </ul>
                                </li>
                                <!--  <li><a class="treeview-item" href="<?= base_url(); ?>/elementos"> Hoja de Vida UCAPs</a></li> -->
                            </ul>
                        </li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/bajas"> BAJA DE INVENTARIO</a></li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">REPORTES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/censo"> Censo Valorizado</a></li>
                            </ul>
                        </li>
                        <!--                         <li><a class="treeview-item" href="<?= base_url(); ?>/tipoactas"> Tipos de Actas</a></li> -->
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i> -->
                        <span class="app-menu__label">COSTOS/PAGOS ENERGIA</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/comerciales"> comercializadores</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/cstenergia"> Registro Consumo Energia </a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/"> Informe de Consumos</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i> -->
                        <span class="app-menu__label">FACTURACION/RECAUDOS</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/cargafacturacion"> Carga Facturación</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/facturacion"> Carga Manual</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/"> Informe de Facturación/Recaudos</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i> -->
                        <span class="app-menu__label"> COSTOS MAXIMOS</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/varsalp"> Variables SALP</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/valorvrsalp"> Registo de Valores de variables</a></li>
                    </ul>
                </li>
            <?php } ?>



            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i> -->
                        <span class="app-menu__label">INVERSIONES</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/actas"> Registro Inversiones</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MESTRUCTURA]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i> -->
                        <span class="app-menu__label">MODELACION FINANCIERA</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">VARIABLES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/capitulos"> Capítulos</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/grupos"> Grupos</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/subgrupos"> SubGrupos</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/conceptos"> Conceptos</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/auxiliares"> Auxiliares</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">MOVIMIENTOS</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/"> Carga Modelo Inicial</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/"> Registro Ejecucion</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a class="app-menu__item" href="#" data-toggle="treeview">
                                <!--                                 <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                                <span class="app-menu__label">REPORTES</span>
                                <i class="treeview-indicator fa fa-angle-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a class="treeview-item" href="<?= base_url(); ?>/"> Modelo Inicial por Rangos</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/"> Ejecucion por Rangos</a></li>
                                <li><a class="treeview-item" href="<?= base_url(); ?>/"> Modelo Vs Ejecucion</a></li>
                            </ul>
                        </li>
                        <!--                         <li><a class="treeview-item" href="<?= base_url(); ?>/tipoactas"> Tipos de Actas</a></li> -->
                    </ul>
                    <ul class="treeview-menu">
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MGENERALES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <!--                         <i class="app-menu__icon fa fa-users" aria-hidden="true"></i> -->
                        <span class="app-menu__label">PARAMETROS GENERALES</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/parametros"> Configuración</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"> Usuarios</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/roles"> Roles</a></li>
                    </ul>
                </li>
            <?php } ?>

            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                    <!--                     <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i> -->
                    <span class="app-menu__label">CERRAR SESION</span>
                </a>
            </li>
        </ul>
    </aside>