<?php
    session_start();
    require_once('../../util/nocsrf.php');
    $nombre = $_SESSION['nombre'];
    $idUsuario = $_SESSION['idUsuario'];
    $rol = $_SESSION['idRol'];
    $idCustomer = $_SESSION['idCustomer'];
    $role = $_SESSION['role'];
    $idCompania = $_SESSION['id_compania'];
    $idCentroCostos = $_SESSION['id_costCenter'];
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
    <title>TaxisYa - CMS</title>

    <meta name="description" content="Taxisya es un sistema de agendamiento de taxis.">
    <meta name="author" content="Wildcatsoft">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="../dis/img/favicon.png">
    <link rel="apple-touch-icon" href="../dis/img/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="../dis/img/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="../dis/img/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="../dis/img/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="../dis/img/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="../dis/img/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="../dis/img/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="../dis/img/icon180.png" sizes="180x180">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="../dis/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="../dis/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="../dis/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <!--<link rel="stylesheet" href="../dis/css/themes.css">-->
    <link rel="stylesheet" href="../dis/css/themes/lake.css">

    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) & Respond.js (enables responsive CSS code on browsers that don't support it, eg IE8) -->
    <script src="../dis/js/vendor/modernizr-respond.min.js"></script>
  

</head>
