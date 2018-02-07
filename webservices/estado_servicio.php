<?php
require_once('../models/conexion.php');
require_once('../models/services.php');

$consulta = new Services();

$idServicio = $_GET['id'];

$mensaje = $consulta->cambiarEstadoServicioPrevio($idServicio);

if ($mensaje == TRUE) {
  $respuesta = array('success' => true, 'data' => array('message' => 'El servicio volvio a espera'));
}else{
  $respuesta = array('success' => false, 'data' => array('message' => 'No se puedo cambiar el estado del servicio'));
}

header('Content-Type: application/json');
echo json_encode($respuesta);

?>
