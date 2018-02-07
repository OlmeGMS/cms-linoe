<?php
require_once('../../models/conexion.php');
require_once('../../models/ticketCostCenters.php');

$idCompania = $_POST['id_compania'];
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$prefijo = htmlspecialchars(strtoupper($_POST['prefijo']), ENT_QUOTES,'UTF-8');
$presupuesto = htmlspecialchars($_POST['presupuesto'], ENT_QUOTES,'UTF-8');
$disponible = htmlspecialchars($_POST['presupuesto'], ENT_QUOTES,'UTF-8');


if (strlen($idCompania) > 0 && strlen($nombre) > 0 && strlen($prefijo) > 0 && strlen($presupuesto) > 0 && strlen($disponible) > 0) {
  $consulta = new TicketCostCenters();
  $flag = $consulta->verificarPrefijo($prefijo);
  if ($flag == "true") {
    header("Location: ../../views/mensajes/error_prefijo.php");
  }else{
    $mensajes = $consulta->crearCentroConsto($idCompania, $nombre, $prefijo, $presupuesto, $disponible );
  }
}else{
  header("Location: ../../views/mensajes/error.php");
}



 ?>
