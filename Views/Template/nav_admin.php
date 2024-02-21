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
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>" target="_blank">
                    <i class="app-menu__icon fa fas fa-globe" aria-hidden="true"></i>
                    <span class="app-menu__label">Ver Sitio WEB</span>
                </a>
            </li>
            <?php if (!empty($_SESSION['permisos'][MDASHBOARD]['reaPermiso'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                        <i class="app-menu__icon fa fa-dashboard"></i>
                        <span class="app-menu__label">Dashboard</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][MGENERALES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                        <span class="app-menu__label">Parámetros Generales</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/parametros"><i class="icon fa fa-circle-o"></i> Configuración</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                    </ul>
                </li>
            <?php } ?>
            <!-- Aqui debo validar 7 y 8 que son Empresas y CLientes y luego en empresas validar con 7 y en clientes validar con 8-->
            <?php if (!empty($_SESSION['permisos'][MESTRUCTURA]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Estructura Modelo</span>
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
            <!--             <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
                    <i class="app-menu__icon fa fa-user" aria-hidden="true"></i>
                    <span class="app-menu__label">Clientes</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/productos">
                    <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
                    <span class="app-menu__label">Productos</span>
                </a>
            </li> -->
            <!-- Aqui debo validar Componentes del SALP-->
            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Componentes SALP</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/varsalp"><i class="icon fa fa-circle-o"></i> Variables SALP</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/grupossalp"><i class="icon fa fa-circle-o"></i> Grupos UCAPs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/subgruposalp"><i class="icon fa fa-circle-o"></i> Subgrupos UCAPs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/elementos"><i class="icon fa fa-circle-o"></i> Elementos UCAPs</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/tipoactas"><i class="icon fa fa-circle-o"></i> Tipos de Actas</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Movimientos</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/valorvrsalp"><i class="icon fa fa-circle-o"></i> Registo de Valores de variables</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/elementos"><i class="icon fa fa-circle-o"></i> Elementos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/tipoactas"><i class="icon fa fa-circle-o"></i> Tipos de Actas</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MCOMPONENTES]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Servicio Energía</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/facturacion"><i class="icon fa fa-circle-o"></i> Facturación/Recaudos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/cstenergia"><i class="icon fa fa-circle-o"></i> Consumos/Costo</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/tipoactas"><i class="icon fa fa-circle-o"></i> ****</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][3]['reaPermiso'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/suscriptores">
                        <i class="app-menu__icon fas fa-user-tie" aria-hidden="true"></i>
                        <span class="app-menu__label">Suscripciones</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MDCONTACTOS]['reaPermiso'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/contactos">
                        <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                        <span class="app-menu__label">Mensajes</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MDPAGINAS]['reaPermiso'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/paginas">
                        <i class="app-menu__icon fas fa-file-alt" aria-hidden="true"></i>
                        <span class="app-menu__label">Páginas</span>
                    </a>
                </li>
            <?php } ?>

            <?php if (!empty($_SESSION['permisos'][MPQRS]['reaPermiso'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/controlpqr">
                        <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                        <span class="app-menu__label">Seguimiento PQRs</span>
                    </a>
                </li>
            <?php } ?>

            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                    <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                    <span class="app-menu__label">Logout</span>
                </a>
            </li>
        </ul>
    </aside>