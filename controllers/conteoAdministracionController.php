<?php
require_once('../models/conexion.php');
require_once('../models/ticketCostCenters.php');
require_once('../models/ticketCompanies.php');



$consulta = new TicketCompanies();
$consultaCentroCosto = new TicketCostCenters();

$idCompania = $_POST['idCompania'];

$porcentaje = $consulta->obtenerPorcentajeAdm($idCompania);

$filas = $consultaCentroCosto->listaCentrosCostos($idCompania);

$usado = 0;

foreach($filas as $fila){

  $gastado = $fila['gasto'];
  $usado = $usado + $gastado;
}

$admin = $usado * $porcentaje;

$mensaje = $consulta->actualizarUsado($admin, $idCompania);

if ($mensaje == FALSE) {
  echo "<script>console.log('No se puedo actualizar el valor usado en ticketsCompanie');</script>";
}else {
  echo "bien";
}

?>
