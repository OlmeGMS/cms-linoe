<?php
require_once('../../models/conexion.php');
require_once('../../models/drivers.php');
require_once('../../models/cars.php');
require_once('../../models/driversCars.php');

$consulta = new Drivers();
$consultaVehiculo = new Cars();
$consultaDriveresCars = new DriversCars();


$campo = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$item = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');

if($campo == 'placa'){
  $placa = strtoupper($item);
  $idVehiculo = $consultaVehiculo->obtenerIdVehiculo($placa);
  $filas = $consultaDriveresCars->obtenerConductroesXCarro($idVehiculo);
  if ($filas != '' || $filas != null) {
    header('Location: ../../views/app/busquedaConductor?campo='.$campo.'&&item='.$placa);
  }else{
    header('Location: ../../views/mensajes/error_busqueda');
  }

}else{
  $mensaje = $consulta->busquedaPersonalizadaConductor($campo, $item);

  if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
    header('Location: ../../views/mensajes/error_busqueda');
  }else{
    header('Location: ../../views/app/busquedaConductor?campo='.$campo.'&&item='.$item);
  }
}



 ?>
