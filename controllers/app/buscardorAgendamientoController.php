<?php
require_once('../../models/conexion.php');
require_once('../../models/schedule.php');
$consulta = new Schedule();

$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$item = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->buscarAgendamiento($campo, $item);


if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../views/app/busquedaAgendamiento?campo='.$campo.'&&item='.$item);
}

 ?>
