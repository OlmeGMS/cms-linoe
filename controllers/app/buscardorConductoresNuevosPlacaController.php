<?php
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/driversCars.php');
$consulta = new Cars();
$consultaDriversCars = new DriversCars();
$placa = $_POST['frase'];
if ($placa != NULL) {
  $idVehiculo = $consulta->obtenerIdVehiculo($placa);
  if ($idVehiculo == NULL) {
    header('Location: ../../views/mensajes/error_respuesta?variable=placa&&mensaje=no+esta+resgitrada');
  }else {
    $mensaje = $consultaDriversCars->obtenerConductroesXCarro($idVehiculo);
    if ($mensaje == NULL) {
      header('Location: ../../views/mensajes/error_respuesta?variable=placa&&mensaje=no+tiene+conductores');
    }else {
      header("Location: ../../views/app/historicoConductoresBusqueda?placa=$placa");
    }
  }

}else {
  header('Location: ../../views/app/historicoConductores');
}
?>
