<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../models/cars.php');

$consulta = new Services();
$consultaVehiculo = new Cars();

$item = $_POST['item-busqueda'];
$vale = $_POST['frase'];


if ($vale != NULL) {
  if ($item == "ticket") {
    $mensaje = $consulta->obtenerServicioXVale($vale);

    if ($mensaje == NULL) {
      header('Location: ../../../views/mensajes/error');
    }else {
      header("Location: ../../../views/app/resultadoServicioVale?campo=$item&&vale=$vale");
    }
  }elseif ($item == "car_id") {
    $placa = strtoupper($vale);
    $idVehiculo = $consultaVehiculo->obtenerIdVehiculo($placa);
    $msj = $consulta->obtenerServiciosXIdVehiculo($idVehiculo);
    if ($msj == FALSE) {
      header('Location: ../../../views/mensajes/error_respuesta?variable=La+placa&&mensaje=no+tiene+servicios');
    }else {
      header("Location: ../../../views/app/resultadoServicioVale?campo=$item&&vale=$vale");
    }
  }else {
    header('Location: ../../../views/app/servicioEstado');
  }


}else {
  header('Location: ../../../views/app/servicioEstado');
}

 ?>
