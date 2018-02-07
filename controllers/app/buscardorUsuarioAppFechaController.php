<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');

$consulta = new Users();

$item = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$frase = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');
$fecha1 = htmlspecialchars($_POST['fecha1'], ENT_QUOTES,'UTF-8');
$fecha2 = htmlspecialchars($_POST['fecha2'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->busquedaXFecha($item, $frase, $fecha1, $fecha2);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../views/app/busquedafechaUsuariosApp?item='.$item.'&&frase='.$frase.'&&fecha1='.$fecha1."&&fecha2=".$fecha2);
}
 ?>
