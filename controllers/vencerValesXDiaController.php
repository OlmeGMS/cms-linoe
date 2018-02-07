<?php
require_once('../models/conexion.php');
require_once('../models/ticketCostCenters.php');
require_once('../models/ticketTickets.php');

ini_set('date.timezone','America/Bogota');

$fechaActual = date('Y-m-d h:m:s');

echo "<script> console.log('$fechaActual');</script>";

$idCompania = $_POST['idCompania'];



$consulta = new TicketTickets();
$consultaCentoCostos = new TicketCostCenters();

$filas = $consultaCentoCostos->listaCentrosCostos($idCompania);

foreach($filas as $fila){
  $id = $fila['id'];
  $vales = $consulta->obtenerTodosValesDisponiblesXCentroCosto($id);
  foreach($vales as $vale){
    $idVale = $vale['id'];
    $fechaVen = $vale['end_at'];
    if ($fechaActual > $fechaVen) {
      $mensaje = $consulta->vencerVales($idVale);
      if ($mensaje == FALSE) {
        echo "<script> console.log('ERROR: No se pudo vencer el vale');</script>";
      }else{
        echo "<script> console.log('el vale con id : $idVale ha caducado');</script>";
      }
    }
  }

}









 ?>
