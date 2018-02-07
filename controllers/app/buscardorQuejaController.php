<?php
require_once('../../models/conexion.php');
require_once('../../models/complains.php');

$consulta = new Complains();

$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$item = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->busquedaPersonalizada($campo, $item);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../views/app/busquedaQueja?campo='.$campo.'&&item='.$item);
}





 ?>
