<?php
require_once('../../models/conexion.php');
require_once('../../models/company.php');
require_once('../../util/nocsrf.php');

$consulta = new Company();

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$description = htmlspecialchars(strtoupper($_POST['descripcion']), ENT_QUOTES,'UTF-8');
$pais = $_POST['pais'];
$departamento = $_POST['departamento'];
$ciudad = $_POST['ciudad'];
$afiliacion = isset($_POST['afiliacion']);

$estado = 1;
if (isset($_POST['_token'])) {
    $filtro = $consulta->validarNombreEmpresa($nombre);
    if ($filtro != NULL) {
      header("Location: ../../views/mensajes/error");
    }else {
      if ($afiliacion == true) {
        $app = 1;
      }else {
        $app = 0;
      }

      if ($ciudad == 1) {
        $secretary = 1;
      }else {
        $secretary = 0;
      }

      if ($description == "" || $description == NULL) {
        $descripcion = "EMPRESA DE TRANSPORTE";
      }else {
        $descripcion = $description;
      }

      $mensaje = $consulta->agregarEmpresa($nombre, $descripcion, $ciudad, $departamento, $pais, $secretary, $app, $estado);

      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/mensajes/registro_exitoso");
      }
    }


}



 ?>
