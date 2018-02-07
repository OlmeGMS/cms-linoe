<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');

$consulta = new Services();

$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$frase = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');
$empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->BusquedaServiciosParaPagos($empresa, $campo, $frase);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../../views/app/busquedaPagosResultado?empresa='.$empresa.'&&campo='.$campo.'&&frase='.$frase);
}


 ?>
