<?php
require_once('../../../models/conexion.php');
require_once('../../../models/ticketTickets.php');

$consulta = new TicketTickets();

$idVale = $_POST['idvale'];

$estado =  $consulta->obtenerEstadoValeXId($idVale);

if ($estado == 4){
  $mensaje = $consulta->cambiarEstadoValeCentralDisponible($idVale);
  return $mensaje;

}else{
  return $mensaje = FALSE;
}




 ?>
