<?php
require_once('../../models/Conexion.php');
//require_once('../../models/Usuario.php');
//require_once('../../controllers/conteoUsuarios.php');
?>
<body>
    <!-- Page Wrapper -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
    <div id="page-wrapper">
        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>Taxis</strong>Ya</h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
            </div>
        </div>
        <!-- END Preloader -->
<!-- Main Container -->
<div id="main-container">
    <!-- Header -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
            Available header.navbar classes:

            'navbar-default'            for the default light header
            'navbar-inverse'            for an alternative dark header

            'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

            'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
        -->
    <header class="navbar navbar-default">
        <!-- Left Header Navigation -->
        <ul class="nav navbar-nav-custom">
            <!-- Main Sidebar Toggle Button -->
            <li>
                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                    <i class="fa fa-bars fa-fw"></i>
                </a>
            </li>
            <!-- END Main Sidebar Toggle Button -->

            <!-- Template Options -->
            <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="gi gi-settings"></i>
                </a>
                <ul class="dropdown-menu dropdown-custom dropdown-options">
                    <li class="dropdown-header text-center">Estilo Cabecera</li>
                    <li>
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                            <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                        </div>
                    </li>
                    <li class="dropdown-header text-center">Estilo Pagina</li>
                    <li>
                        <div class="btn-group btn-group-justified btn-group-sm">
                            <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                            <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternativa</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- END Template Options -->
        </ul>
        <!-- END Left Header Navigation -->

        <!-- Search Form -->
        <!--<form action="page_ready_search_results.html" method="post" class="navbar-form-custom" role="search">
            <div class="form-group">
                <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Buscar..">
            </div>
        </form>-->
        <!-- END Search Form -->

        <!-- Right Header Navigation -->
        <ul class="nav navbar-nav-custom pull-right">
            <!-- Alternative Sidebar Toggle Button -->

            <!-- END Alternative Sidebar Toggle Button -->

            <!-- User Dropdown -->
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../dis/img/placeholders/avatars/avatar2.jpg" alt="avatar"> <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                    <li class="dropdown-header text-center">Cuenta</li>
                    <li>
                        <a href="#">
                            <i class="fa fa-clock-o fa-fw pull-right"></i>
                            <span class="badge pull-right"></span> Usuarios
                        </a>

                    </li>
                    <li class="divider"></li>
                    <li>
                        <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                        <a href="#modal-user-settings" data-toggle="modal">
                            <i class="fa fa-cog fa-fw pull-right"></i> Configuración
                        </a>
                        <a href="crearCuenta.php">
                            <i class="fa fa-rocket fa-fw pull-right"></i> Crear Cuenta
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="page_ready_lock_screen.html"><i class="fa fa-lock fa-fw pull-right"></i> Bloquear Cuentas</a>
                        <a href="../../Controllers/cerrarSesionController.php"><i class="fa fa-ban fa-fw pull-right"></i> Cerrar Sesion</a>
                    </li>

                </ul>
            </li>
            <!-- END User Dropdown -->
        </ul>
        <!-- END Right Header Navigation -->

    </header>
    <!-- END Header -->
