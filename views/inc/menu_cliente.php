
<body>
    <!-- Page Wrapper -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
    <div id="page-wrapper" class="">
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

        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
                Available #page-container classes:

                '' (None)                                       for a full main and alternative sidebar hidden by default (> 991px)

                'sidebar-visible-lg'                            for a full main sidebar visible by default (> 991px)
                'sidebar-partial'                               for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
                'sidebar-partial sidebar-visible-lg'            for a partial main sidebar which opens on mouse hover, visible by default (> 991px)
                'sidebar-mini sidebar-visible-lg-mini'          for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)
                'sidebar-mini sidebar-visible-lg'               for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)

                'sidebar-alt-visible-lg'                        for a full alternative sidebar visible by default (> 991px)
                'sidebar-alt-partial'                           for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
                'sidebar-alt-partial sidebar-alt-visible-lg'    for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

                'sidebar-partial sidebar-alt-partial'           for both sidebars partial which open on mouse hover, hidden by default (> 991px)

                'sidebar-no-animations'                         add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

                'style-alt'                                     for an alternative main style (without it: the default style)
                'footer-fixed'                                  for a fixed footer (without it: a static footer)

                'disable-menu-autoscroll'                       add this to disable the main menu auto scrolling when opening a submenu

                'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
                'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

                'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links
            -->
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

            <!-- Main Sidebar -->
            <div id="sidebar">
                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Brand -->
                        <a href="home" class="sidebar-brand">
                            <i class="fa fa-cab"></i><span class="sidebar-nav-mini-hide"><strong>Taxis</strong>Ya</span>
                        </a>
                        <!-- END Brand -->

                        <!-- User Info -->
                           <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                               <div class="sidebar-user-avatar">
                                   <a href="#">
                              <img src="../dis/img/placeholders/avatars/avatar.png" alt="avatar">
                                   </a>
                               </div>
                               <div class="sidebar-user-name"><?php echo $nombre; ?></div>
                               <div class="sidebar-user-links">
                                   <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Settings" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                                   <a href="../../controllers/cerrarSesionController.php" data-toggle="tooltip" data-placement="bottom" title="Cerrar Sesion"><i class="gi gi-exit"></i></a>
                               </div>
                            </div>
                  <!-- END User Info -->

                        <!-- Theme Colors -->
                        <!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->

                        <!-- END Theme Colors -->

                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                          <a href="#" class="sidebar-nav-menu"><span class="sidebar-nav-mini-hide">MENU DE NAVEGACIÓN</span></a>

                          <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-database sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Servicios</span></a>
                          <ul>
                            <li>
                                <a href="servicioEstado"><i class="fa fa-list sidebar-nav-icon "></i>Serivicios por estados</span></a>
                            </li>
                            <li>
                                <a href="solicitarServicio"><i class="fa fa-plus sidebar-nav-icon "></i>Solicitar Servicio</span></a>
                            </li>
                            <!--<li>
                                <a href="serviciosActivos"><i class="fa fa-calendar sidebar-nav-icon "></i>Agendar Servicio</span></a>
                            </li>-->
                            <li>
                                <a href="reporteServicioCliente"><i class="fa fa-print sidebar-nav-icon "></i>Reporte Servicio</span></a>
                            </li>
                          </ul>
                          <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-ticket sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Vales</span></a>
                          <ul>
                            <?php
                            switch ($role) {
                              case 'admin':
                                echo '
                                    <li>
                                        <a href="usuarioManager"><i class="fa fa-edit sidebar-nav-icon "></i>Usuario manager</span></a>
                                    </li>
                                    <li>
                                        <a href="vale"><i class="fa fa-ticket sidebar-nav-icon "></i>Vales</span></a>
                                    </li>
                                    <li>
                                        <a href="ServicosValesXEmpresa"><i class="fa fa-calendar sidebar-nav-icon "></i>Servicios</span></a>
                                    </li>
                                    <li>
                                        <a href="centroCostos"><i class="fa fa-building sidebar-nav-icon "></i>Centros de costos</span></a>
                                    </li>
                                ';
                                break;
                                case 'manager':
                                  echo '
                                        <li>
                                            <a href="listareporters"><i class="fa fa-edit sidebar-nav-icon "></i>Usuario reportes</span></a>
                                        </li>
                                        <li>
                                            <a href="vale"><i class="fa fa-ticket sidebar-nav-icon "></i>Generar vales</span></a>
                                        </li>
                                        <li>
                                            <a href="ServicosValesXEmpresa"><i class="fa fa-calendar sidebar-nav-icon "></i>Servicios</span></a>
                                        </li>
                                  ';
                                  break;
                                  case 'report':

                                    echo '
                                        <li>
                                            <a href="ServicosValesXEmpresa"><i class="fa fa-calendar sidebar-nav-icon "></i>Servicios</span></a>
                                        </li>
                                    ';

                                    break;

                              default:
                                # code...
                                break;
                            }
                             ?>

                        </ul>
                        <!-- END Sidebar Navigation -->

                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->
