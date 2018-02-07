<?php
require_once('../models/conexion.php');
require_once('../models/parameters.php');
require_once('../models/secretaryCars.php');
require_once('../models/drivers.php');
require_once('../models/cars.php');
require_once('../models/driversCars.php');
require_once('../models/company.php');
ini_set('date.timezone','America/Bogota');

$consultaParameters = new Parameters();
$consultaSecretaryCars = new SecretaryCars();
$consultaConductores = new Drivers();
$consultaVehiculos = new Cars();
$consultaDriversCars = new DriversCars();
$consultaCompany = new Company();

$hora = $consultaParameters->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

//SE CAPTURAN LAS EMPRESAS AFILIADAS A LA APP
$empresas = $consultaCompany->obtenerEmpresasAfiliadasAPPTaxisYaBog();

//$carros = $consultaVehiculos->listaCarrosFueraServicio();

foreach($empresas as $empresa){
  $idEmpresa = $empresa['id'];
  $carros = $consultaVehiculos->listaCarrosFueraServicioXEmpresa($idEmpresa);
  $bandera = FALSE;

  foreach($carros as $carro){
    $idVechiculo = $carro['id'];
    $filas = $consultaDriversCars->obtenerConductroesXCarro($idVechiculo);
    if ($filas > 0) {
      foreach ($filas as $fila) {
        $idConductor = $fila['drivers_id'];
        $estadoHabilitacion = $consultaConductores->obtenerEstadoHabilitadoConductor($idConductor);
        if ($estadoHabilitacion == 1) {
          $bandera = TRUE;
          $idDriver = $idConductor;
        }
      }
      if ($bandera == FALSE) {
        $lat = 0;
        $lng = 0;
        $driver = 0;
        $estado = "F";
        $carrera = NULL;
        $mensaje = $consultaSecretaryCars->insertarFueraServicio($idVechiculo, $driver, $lat, $lng, $date, $estado, $carrera);
      }

    }

  }
}


$respuesta = array('status' => 200);
header('Content-Type: application/json');
echo json_encode($respuesta);


 ?>
