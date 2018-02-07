
<?php
require_once('../models/conexion.php');
require_once('../models/secretaryReports.php');
require_once('../facades/secretaryReportsFacade.php');
$idEmpresa = $_GET['empresa'];
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="es">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="Content-type" content="text/html; charset=utf-8"/ >-->
    <title>TaxisYa </title>

    <meta name="description" content="Taxisya es un sistema de agendamiento de taxis.">
    <meta name="author" content="Wildcatsoft">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="dis/img/favicon.png">
    <link rel="apple-touch-icon" href="dis/img/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="dis/img/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="dis/img/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="dis/img/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="dis/img/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="dis/img/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="dis/img/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="dis/img/icon180.png" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="dis/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="dis/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="dis/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <!--<link rel="stylesheet" href="../dis/css/themes.css">-->
    <link rel="stylesheet" href="dis/css/themes/lake.css">

    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
    <script src="dis/js/vendor/modernizr-respond.min.js"></script>

</head>


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

                  <!-- END User Info -->

                        <!-- Theme Colors -->
                        <!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->

                        <!-- END Theme Colors -->

                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">

                        </ul>

                        <!-- END Sidebar Navigation -->

                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->

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

                        <!-- END Right Header Navigation -->
                    </header>      <!-- END Header -->
                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Blank Header -->
                        <div class="content-header">
                            <div class="header-section">
                                <h1>
                                    <i class="fa fa-cab"></i>Reportes<br><small>Complete el siquiente formulario para descargar los reportes!</small>
                                </h1>
                            </div>
                        </div>

                        <!-- END Blank Header -->

                        <!-- Example Block -->
                        <div class="block">
                            <!-- Example Title -->
                            <div class="block-title">
                                <h2>Reportes</h2>
                            </div>
                            <!-- END Example Title -->
                            <div class="row media-filter-items">
                            <?php echo tablaReportesSecretaria($idEmpresa);?>
                            <!-- Example Content -->
                            </div>
                            <!-- END Example Content -->
                        </div>
                        <!-- END Example Block -->
                    </div>
                    <!-- END Page Content -->

                <!-- Footer -->
                <footer class="clearfix">
                    <div class="pull-right">
                        Desarollado por <a href="http://taxisya.co" target="_blank">Taxisya</a>
                    </div>
                    <div class="pull-left">
                        <span id="year-copy"></span> &copy; <a href="http://taxisya.co" target="_blank">TaxisYa</a>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
    <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
                </div>
                <!-- END Modal Header -->

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="index.html" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                        <fieldset>
                            <legend>Vital Info</legend>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Username</label>
                                <div class="col-md-8">
                                    <p class="form-control-static">Admin</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                                <div class="col-md-8">
                                    <input type="email" id="user-settings-email" name="user-settings-email" class="form-control" value="admin@example.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                                <div class="col-md-8">
                                    <label class="switch switch-primary">
                                                                <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                                                                <span></span>
                                                            </label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Password Update</legend>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="..and confirm it!">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group form-actions">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
    <!-- END User Settings -->

    <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    !window.jQuery && document.write(decodeURI('%3Cscript src="../dis/js/vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));
</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->



<script src="dis/js/vendor/bootstrap.min.js"></script>
<script src="dis/js/plugins.js"></script>
<script src="dis/js/app.js"></script>
<script src="dis/js/pages/validadorEmpresa.js"></script>
<script>$(function(){ ValidadorEmpresa.init(); });</script>
<script type="text/javascript">
  $('#btn-consultar').click(function(e){
    var bandera = false;
    var empresa = $('#empresa').val();
    if (empresa != undefined ) {
      bandera = true;
    }
    if (bandera == false) {
      alert('No han seleccionado la empresa');
      return false;
    }
  });
</script>

</body>

</html>
