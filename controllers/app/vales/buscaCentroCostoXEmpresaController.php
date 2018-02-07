<?php
require_once('../../../models/conexion.php');
require_once('../../../models/ticketCostCenters.php');

$consulta = new TicketCostCenters();

$empresa = $_POST['empresa'];

$mensaje = $consulta->listaCentrosCostos($empresa);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../../views/app/centroCostosAdmin?empresa='.$empresa);
}



 ?>
