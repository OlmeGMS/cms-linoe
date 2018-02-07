<?php
require_once('../models/conexion.php');
require_once('../models/services.php');
require_once('../models/parameters.php');
ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaParameters = new Parameters();

$idServicio = $_GET['id_servicio'];

$hora = $consultaParameters->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$filas = $consulta->obtenerServicioXId($idServicio);
foreach($filas as $fila){
  $idCarrera = $fila['id'];
}
$mensaje = $consulta->finalizarServicioInterrumpido($idCarrera);
if ($mensaje == FALSE) {
  $respuesta = array('success' => false, 'data' => array('message' => 'No se pudo finalizar el servicio interrumpido'));
}else {
  $respuesta = array('success' => true, 'data' => array('message' => 'El servicio interrumpido fue finalizado'));
}

header('Content-Type: application/json');
echo json_encode($respuesta);

?>
