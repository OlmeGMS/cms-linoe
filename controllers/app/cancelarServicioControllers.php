<?php
require_once('../../models/conexion.php');
require_once('../../models/services.php');

$idservicio = $_POST['id'];
$consulta = new Services();

$mensaje = $consulta->cancelarServicioOperadora($idservicio);

if ($mensaje == TRUE) {
  return "Cancelado";
}else {
  return "ERROR";
}




 ?>
