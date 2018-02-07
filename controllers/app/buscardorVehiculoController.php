<?php
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
$consulta = new Cars();

$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$item = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->busquedaPersonalizada($campo, $item);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../views/app/busquedaVehiculos?campo='.$campo.'&&item='.$item);
}

 ?>
