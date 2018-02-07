<?php
require_once('../../../models/conexion.php');
require_once('../../../models/ticketTickets.php');

$consulta = new TicketTickets();

$idVale = $_POST['idvale'];

$estado =  $consulta->obtenerEstadoValeXId($idVale);

if ($estado == 0){
  $mensaje = $consulta->cambiarEstadoValeCentral($idVale);
  return $mensaje;

}else{
  return $mensaje = FALSE;
}




 ?>
