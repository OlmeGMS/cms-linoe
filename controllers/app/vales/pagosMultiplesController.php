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

$pagos = $_GET['servicios'];
/* Deshacemos el trabajo hecho por base64_encode */
$ser = base64_decode($_GET['servicios']);
/* Deshacemos el trabajo hecho por 'serialize' */
$ser = unserialize($ser);
$nPago = htmlspecialchars($_GET['n-pago'], ENT_QUOTES,'UTF-8');
$empresa = htmlspecialchars($_GET['empresa'], ENT_QUOTES,'UTF-8');
$valorTotal = 0;
$estado_pago = 1;

if (isset($_GET['_token'])) {
  if(NoCSRF::check('_token', $_GET, false, 60*10, true)){
    if (isset($ser)){
      foreach ($ser as $pago) {
        $id = $pago;
        $estadoPago = $consulta->obtenerEstadoPagoServicio($id);
        $valorServicio = $consulta->obtenerValorServicio($id);
        $msj = $consultaPayments->agregarPago($id, $date, $nPago, $estado_pago);
        if ($msj == FALSE) {
          header('location: ../../../views/mensajes/error');
        }else{
          $mensaje = $consulta->modificarEstadoPago($pago, $date);
          if ($mensaje == FALSE) {
            header('location: ../../../views/mensajes/error');
          }else {
            $valorTotal = $valorTotal + $valorServicio;
          }
        }

      }
      header('location: ../../../views/mensajes/pagos_exitosos?empresa='.$empresa.'&&total='.$valorTotal);

    }else{
      header('../../../views/mensajes/error.php');
    }

  }else {
    header("Location: ../../../views/mensajes/error.php");
  }

}





 ?>
