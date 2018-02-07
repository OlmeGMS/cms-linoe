<?php
require_once('../models/conexion.php');
require_once('../models/company.php');

$consulta = new Company();
$empresas = $consulta->listaEmpresasActivas();

if ($empresas != NULL) {
  header('Content-Type: application/json');
  $respuesta = array('success' => true, 'data' => $empresas);
  echo json_encode($respuesta);
}else {
  header('Content-Type: application/json');
  $respuesta = array('success' => false, 'message' => 'No pudo devolver la lista de empresa');
  echo json_encode($respuesta);
}








 ?>
