<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');

$consulta = new Services();

$empresa = htmlspecialchars($_POST['empresa'], ENT_QUOTES,'UTF-8');
$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$frase = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->listaServiciosParaPagos($empresa);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../../views/app/busquedaPagos?empresa='.$empresa);
}



 ?>
