<?php
require_once('../../models/conexion.php');
require_once('../../models/cars.php');

if (isset($_POST['idCarro'])) {
  $idCarro = $_POST['idCarro'];
  $consulta = new Cars();
  $mensaje = $consulta->EstadoVehiculo($idCarro);

  if ($mensaje == TRUE) {
    return "ELIMINADO";
  }else {
    return "ERROR: El vehiculo tiene servicios asociados";
  }
}

?>
