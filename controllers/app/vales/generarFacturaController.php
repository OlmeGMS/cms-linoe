<?php
session_start();
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../models/payments.php');
require_once('../../../models/parameters.php');
require_once('../../../util/nocsrf.php');
ini_set('date.timezone','America/Bogota');

$consultaParametros = new Parameters();
$consulta = new Services();
$consultaPayments = new Payments();

$hora = $consultaParametros->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$pagos = $_POST['checkbox-1'];
$nPago = htmlspecialchars($_POST['n-pago'], ENT_QUOTES,'UTF-8');
$empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES,'UTF-8');

$pagos = serialize($pagos);
$pagos = base64_encode($pagos);
$pagos = urlencode($pagos);
if (isset($_POST['_token'])){
  if(NoCSRF::check('_token', $_POST, false, 60*60, true)){

    header('location: ../../../views/app/factura?empresa='.$empresa.'&&npago='.$nPago.'&&servicios='.$pagos);

  }else {
    header("Location: ../../../views/mensajes/error.php");
  }
}else {
  header("Location: ../../../views/mensajes/error.php");
}


 ?>
