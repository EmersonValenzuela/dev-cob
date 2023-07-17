<body class="skin-default-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">TRAMITES COBIENE</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('be/dashboard'); ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url(); ?>/assets/images/log-c.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?= base_url(); ?>/assets/images/log-c.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text -->
                            <img src="<?= base_url(); ?>/assets/images/2.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="<?= base_url(); ?>/assets/images/1.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    </ul>
                    <input type="hidden" value="<?= base_url() ?>" id="url_base">
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">

                        <?php if ($this->session->userdata('is_user_login') == "1") {

                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link waves-effect waves-dark" href="<?= base_url('admin'); ?>" aria-expanded="false" title="Cambiar Modo de Usuario"> <i class="fas fa-sync-alt text-dark"></i>
                                </a>

                            </li>
                        <?php
                        }
                        ?>
                        <!-- ============================================================== -->
                        <!-- config -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Perfil"> <i class="fas fa-cog text-dark"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end mailbox animated bounceInDown">
                                <ul>
                                    <li>
                                        <div class="drop-title"><?= $this->session->userdata('user_name') ?></div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-danger btn-circle text-white"><i class="fa fa-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5> Mi Perfil</h5>
                                                </div>
                                            </a>

                                            <!-- Message -->
                                            <a href="<?= base_url('cerrar-session'); ?>">
                                                <div class="btn btn-info btn-circle text-white"><i class="fas fa-power-off"></i></div>
                                                <div class="mail-contnet">
                                                    <h5> Cerrar Sessión</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="fas fa-tachometer-alt text-dark" title="Personalizar Tema"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div>
                            <img src="<?= base_url() ?><?= $this->session->userdata('user_img_profile') ?>" class="img-circle" id="crop-img">
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a class="waves-effect waves-dark" href="<?= base_url('be/dashboard'); ?>" aria-expanded="false">
                                <i class="fas fa-chart-pie"></i>
                                <span class="hide-menu">Inicio</span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('user_type') == 1) { ?>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="fas fa-cogs"></i>
                                    <span class="hide-menu">Administración</span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li>
                                        <a class="waves-effect waves-dark" href="<?= base_url('be/usuarios'); ?>">
                                            <i class="fas fa-users"></i>
                                            &nbsp; Usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-dark" href="<?= base_url('be/departamentos'); ?>">
                                            <i class="fas fa-sitemap"></i>
                                            &nbsp; Departamentos
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-dark" href="<?= base_url('be/secciones'); ?>">
                                            <i class="fas fa-desktop"></i>
                                            &nbsp; secciones
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-dark" href="<?= base_url('be/oficinas'); ?>">
                                            <i class="fas fa-briefcase"></i>
                                            &nbsp; Oficinas
                                        </a>
                                    </li>
                                </ul>

                            </li>
                        <?php }
                        ?>

                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                                <span class="hide-menu">Mi Usuario</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <?php
                                if (check_user() == true) {
                                ?>
                                    <li>
                                        <a class="waves-effect waves-dark" href="<?= base_url('be/mi-equipo'); ?>" aria-expanded="false">
                                            <i class="fas fa-users"></i>
                                            <span class="hide-menu">Mi Equipo</span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/editar-personal-civil/'.$this->session->userdata('user_id')); ?>">
                                        <i class="fas fa-id-badge"></i>
                                        &nbsp; Datos Adicionales
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="hide-menu">Correspondencias</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/ordenes-de-servicio'); ?>">
                                        <i class="fas fa-clipboard-check"></i>
                                        &nbsp; Ordenes de Servicio
                                    </a>
                                </li>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/inspeciones-tecnicas'); ?>">
                                        <i class="fas fa-clipboard-check"></i>
                                        &nbsp; Informes Técnicos
                                    </a>
                                </li>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/correspondecias-recibidas'); ?>">
                                        <i class="fas fa-clipboard"></i>
                                        &nbsp; Recibidos
                                    </a>
                                </li>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/correspondecias-remitidas'); ?>">
                                        <i class="fas fa-clipboard-check"></i>
                                        &nbsp; Remitidas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-warehouse"></i>
                                <span class="hide-menu">SOPORTE DETEL</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/ordenes-de-servicio'); ?>">
                                        <i class="fas fa-clipboard-check"></i>
                                        &nbsp; Ordenes de Servicio
                                    </a>
                                </li>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/inspeciones-tecnicas'); ?>">
                                        <i class="fas fa-clipboard-check"></i>
                                        &nbsp; Informes Técnicos
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fas fa-users"></i>
                                <span class="hide-menu">DATOS DEPER</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url('be/lista-personal-civil'); ?>" aria-expanded="false">
                                        <i class="fas fa-list-alt"></i>
                                        <span class="hide-menu">Lista Registro Civil</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->