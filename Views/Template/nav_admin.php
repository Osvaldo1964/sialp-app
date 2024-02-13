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
            <?php if (!empty($_SESSION['permisos'][3]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Inventarios</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/categorias"><i class="icon fa fa-circle-o"></i> Categorías</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/productos"><i class="icon fa fa-circle-o"></i> Productos</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
                    <i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="app-menu__label">Pedidos</span>
                </a>
            </li>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/ventas">
                    <i class="fa-solid fa-basket-shopping" aria-hidden="true"></i>
                    <span class="app-menu__label">Ventas</span>
                </a>
            </li>
            <?php if (!empty($_SESSION['permisos'][13]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Cartera</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/notas"><i class="icon fa fa-circle-o"></i> Notas</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/reciboscaja"><i class="icon fa fa-circle-o"></i> Recibos de Caja</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/informes"><i class="icon fa fa-circle-o"></i> Informes</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][11]['reaPermiso'])) { ?>
                <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-building-circle-check" aria-hidden="true"></i>
                        <span class="app-menu__label">Tesorería</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/cajas"><i class="icon fa fa-circle-o"></i> Cajas</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/conceptogastos"><i class="icon fa fa-circle-o"></i> Conceptos de Gastos</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/registrogastos"><i class="icon fa fa-circle-o"></i> Registro de Gastos</a></li>
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


            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                    <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                    <span class="app-menu__label">Logout</span>
                </a>
            </li>
        </ul>
    </aside>