<?php
require_once('../../models/conexion.php');
require_once('../../models/schedule.php');

$consulta = new Schedule();

$idAgendamiento = $_POST['id'];
$mensaje = $consulta->asignarServicioAgendamientoCentral($idAgendamiento);

if ($mensaje == TRUE) {
  return "Cancelado";
}else {
  return "ERROR";
}

 ?>
