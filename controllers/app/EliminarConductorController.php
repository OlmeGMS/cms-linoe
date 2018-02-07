<?php
require_once('../../models/conexion.php');
require_once('../../models/drivers.php');

if (isset($_POST['idConductor'])) {
  $idConductor = $_POST['idConductor'];
  $consulta = new Drivers();
  $mensaje = $consulta->EstadoConductor($idConductor);

  if ($mensaje == TRUE) {
    return "ELIMINADO";
  }else {
    return "ERROR: El vehiculo tiene servicios asociados";
  }
}

?>
