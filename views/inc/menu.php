
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
            <h1 class="push-top-bottom text-light text-center"><strong>Univerty</strong>Test</h1>
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
                        <a href="index.html" class="sidebar-brand">
                            <i class="fa fa-bank"></i><span class="sidebar-nav-mini-hide"><strong>University</strong>Test</span>
                        </a>
                        <!-- END Brand -->

                        <!-- User Info -->

                        <!-- END User Info -->

                        <!-- Theme Colors -->
                        <!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->
                        <ul class="sidebar-section sidebar-themes clearfix sidebar-nav-mini-hide">
                            <!-- You can also add the default color theme
                                <li class="active">
                                    <a href="javascript:void(0)" class="themed-background-dark-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default Blue"></a>
                                </li>
                                -->
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-night themed-border-night" data-theme="Views/dis/css/themes/night.css" data-toggle="tooltip" title="Night"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-amethyst themed-border-amethyst" data-theme="Views/dis/css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-modern themed-border-modern" data-theme="Views/dis/css/themes/modern.css" data-toggle="tooltip" title="Modern"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-autumn themed-border-autumn" data-theme="Views/dis/css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-flatie themed-border-flatie" data-theme="Views/dis/css/themes/flatie.css" data-toggle="tooltip" title="Flatie"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-spring themed-border-spring" data-theme="Views/dis/css/themes/spring.css" data-toggle="tooltip" title="Spring"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-fancy themed-border-fancy" data-theme="Views/dis/css/themes/fancy.css" data-toggle="tooltip" title="Fancy"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-fire themed-border-fire" data-theme="Views/dis/css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-coral themed-border-coral" data-theme="Views/dis/css/themes/coral.css" data-toggle="tooltip" title="Coral"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-lake themed-border-lake" data-theme="Views/dis/css/themes/lake.css" data-toggle="tooltip" title="Lake"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-forest themed-border-forest" data-theme="Views/dis/css/themes/forest.css" data-toggle="tooltip" title="Forest"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-waterlily themed-border-waterlily" data-theme="Views/dis/css/themes/waterlily.css" data-toggle="tooltip" title="Waterlily"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-emerald themed-border-emerald" data-theme="Views/dis/css/themes/emerald.css" data-toggle="tooltip" title="Emerald"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="themed-background-dark-blackberry themed-border-blackberry" data-theme="Views/dis/css/themes/blackberry.css" data-toggle="tooltip" title="Blackberry"></a>
                            </li>
                        </ul>
                        <!-- END Theme Colors -->

                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                            <li>
                                <a href="Views/iniciarsesion.php" class=" active"><i class="fa fa-user"></i><span class="sidebar-nav-mini-hide"> Iniciar Sesion</span></a>
                            </li>
                            <li>
                                <a href="Views/iniciarsesion.php"><i class="fa fa-plus"></i><span class="sidebar-nav-mini-hide"> Registrarse</span></a>
                            </li>

                        </ul>
                        <!-- END Sidebar Navigation -->

                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->
