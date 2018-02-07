<?php
require_once('../../../models/conexion.php');
require_once('../../../models/ticketTickets.php');

$consulta = new TicketTickets();

$empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES,'UTF-8');
$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$frase = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->busquedaPersonalizadaTickets($empresa, $campo, $frase);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../../views/mensajes/error_busqueda');
}else{
  if ($rol == 3) {
    header('Location: ../../../views/app/busquedaValesCentral?empresa='.$empresa.'&&campo='.$campo.'&&frase='.$frase);
  }else {
    header('Location: ../../../views/app/busquedaValesAdministrador?empresa='.$empresa.'&&campo='.$campo.'&&frase='.$frase);
  }

}



 ?>
