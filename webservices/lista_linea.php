<?php
require_once('../models/conexion.php');
require_once('../models/lineCars.php');

$idMarca = $_POST['id_marca'];

$consulta = new LineCars();
$lineas = $consulta->listaMarcasActivasXMarca($idMarca);

if ($lineas != NULL) {
  header('Content-Type: application/json');
  $respuesta = array('success' => true, 'data' => $lineas);
  echo json_encode($respuesta);
}else {
  header('Content-Type: application/json');
  $respuesta = array('success' => false, 'message' => 'No pudo devolver la lista de marcas');
  echo json_encode($respuesta);
}







 ?>
