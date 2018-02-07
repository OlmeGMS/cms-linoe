<?php
require_once('../models/conexion.php');
require_once('../models/brandsCars.php');

$consulta = new BrandsCars();
$marcas = $consulta->listaMarcasActivas();

if ($marcas != NULL) {
  header('Content-Type: application/json');
  $respuesta = array('success' => true, 'data' => $marcas);
  echo json_encode($respuesta);
}else {
  header('Content-Type: application/json');
  $respuesta = array('success' => false, 'message' => 'No pudo devolver la lista de marcas');
  echo json_encode($respuesta);
}


 ?>
