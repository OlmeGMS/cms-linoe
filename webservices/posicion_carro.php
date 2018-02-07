<?php
require_once('../models/conexion.php');
require_once('../models/secretaryCars.php');
require_once('../models/parameters.php');
require_once('../models/services.php');
require_once('../models/cars.php');
ini_set('date.timezone','America/Bogota');

$consulta = new SecretaryCars();
$consultaParametros = new Parameters();
$consultaCars = new Cars();
$consultaServicio = new Services();

$hora = $consultaParametros->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";
$anio = date('y');

$idCarro = $_POST['carro'];
$idConductor = $_POST['conductor'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$estadoVehiculo = $consulta->obtenerEstado($idCarro);
if ($estadoVehiculo == NULL) {
  $status = $consultaServicio->obtenerEstadoServicioXVehiculo($idCarro);
  if ($status == 2 || $status == 3) {
    $estado = "R";
    $idCarrera = null;
  }elseif ($status == 4){
    $estado = "O";
    $idServicio = $consultaServicio->obtenerIdCarreraXVehiculo($idCarro);
    $idCarrera = "0000-$anio-$idServicio";
  }else {
    $estado = "D";
    $idCarrera = null;
  }
}else {
  if ($estadoVehiculo == "F" || $estadoVehiculo == "A") {
    $estado = $estadoVehiculo;
    $idCarrera = null;
  }
}



$mensaje = $consulta->insertarLocalizacion($idCarro, $idConductor, $lat, $lng, $date, $estado, $idCarrera);

if ($mensaje == TRUE) {
  $respuesta = "Status: 200";
}else{
  $respuesta = "Error: 100";
}

header('Content-Type: application/json');
echo json_encode($respuesta);





 ?>
