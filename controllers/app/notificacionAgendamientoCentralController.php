<?php
require_once('../../models/conexion.php');
require_once('../../models/schedule.php');
require_once('../../models/services.php');

$consulta = new Schedule();
$consultaServicios = new Services();

$flag = null;

$mensaje = $consulta->obtenerAgendamientosParaCentral();

if ($mensaje != NULL) {
  foreach ($mensaje as $msj) {
    $idServicio = $msj['id'];
    $estado = $consultaServicios->obtenerEstadoServicio($msj['service_id']);

    if ($estado == 1 || $estado == 8) {
      $message = $consulta->cambiarEstadoCentralAgendamiento($idServicio);
      echo "<script>alert('Hola Central, Debes crear un servicio de agendamiento con id: $idServicio!');</script>";
    }elseif ($estado == 2) {
      $message = $consulta->asignarServicioAgendamientoCentral($idServicio);
    }elseif ($estado == 3) {
      $message = $consulta->actualizarEstadoAgendamientoAuto(3,$idServicio);
    }elseif ($estado == 4) {
      $message = $consulta->actualizarEstadoAgendamientoAuto(4,$idServicio);
    }elseif ($estado == 5) {
      $message = $consulta->actualizarEstadoAgendamientoAuto(5,$idServicio);
    }elseif ($estado == 6) {
      $message = $consulta->actualizarEstadoAgendamientoAuto(6,$idServicio);
    }elseif ($estado == 7) {
      $message = $consulta->actualizarEstadoAgendamientoAuto(7,$idServicio);
    }elseif ($estado == 9) {
      $message = $consulta->actualizarEstadoAgendamientoAuto(9,$idServicio);
    }else{
      echo "<script> console.log('No hay que notificar a la central por el estado del servicio');</script>";
    }

  }
}else{
  echo "<script>console.log('No hay servicios que notificar a la central');</script>";
}






 ?>
