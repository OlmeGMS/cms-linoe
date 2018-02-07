<?php
require_once('../../models/conexion.php');
require_once('../../models/services.php');
require_once('../../models/ticketTickets.php');

$consulta = new Services();
$consultaTickets = new TicketTickets();

$mensaje = $consulta->cancelarServiciosAutomaticamente();
$filas = $consulta->obtenerServiciosXValeCanceladosSistema();
foreach ($filas as $fila) {
  $nVale = $fila['user_card_reference'];
  $msj = $consultaTickets->cambiarEstadoValeDisponible($nVale);
}

if ($mensaje == FALSE) {
  echo "<script> console.log('ERROR: No realizar el cancelamiento automatico')</script>";
}else{
  echo "<script> console.log('Se cancelaron los servicios')</script>";
}





 ?>
