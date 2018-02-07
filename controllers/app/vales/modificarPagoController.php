<?php
session_start();
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../models/payments.php');
require_once('../../../util/nocsrf.php');

ini_set('date.timezone','America/Bogota');

$idSerivicio = $_POST['idServicio'];
$unidades = htmlspecialchars($_POST['unidades'], ENT_QUOTES,'UTF-8');
$aero = htmlspecialchars($_POST['aeropuerto'], ENT_QUOTES,'UTF-8');
$nocturno = htmlspecialchars($_POST['nocturno'], ENT_QUOTES,'UTF-8');
$mensajeria = htmlspecialchars($_POST['mensajeria'], ENT_QUOTES,'UTF-8');
$pp = htmlspecialchars($_POST['pp'], ENT_QUOTES,'UTF-8');
$valor = htmlspecialchars($_POST['valor'], ENT_QUOTES,'UTF-8');
$empresa = $_POST['empresa'];
//$recibo = htmlspecialchars(strtoupper($_POST['recibo']), ENT_QUOTES,'UTF-8');
$estado_pago = 0;

//$fecha = date('Y-m-d h:m:s');
$fecha = "0000-00-00 00:00:00";
$consulta = new Services();
$consultaPayments = new Payments();

if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
      $mensaje = $consulta->modificarPago($unidades, $aero, $nocturno, $mensajeria, $pp, $valor, $estado_pago, $fecha, $idSerivicio);
      if($mensaje == FALSE){
        header('location: ../../../views/mensajes/error');
      }else{
        header('location: ../../../views/app/busquedaPagos?empresa='.$empresa);
      }
  }else {
    header("Location: ../../views/mensajes/error.php");
  }
}









?>
