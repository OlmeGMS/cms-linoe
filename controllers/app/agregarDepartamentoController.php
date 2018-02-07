<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsDepartments.php');
require_once('../../util/nocsrf.php');

$consulta = new CmsDepartments();
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$estado = 1;
$pais = $_POST['pais'];

if (isset($_POST['_token'])){
  $filtro = $consulta->filtroDepartamentos($nombre);
  if ($filtro != NULL || $filtro != 0) {
    header("Location: ../../views/mensajes/error_existe?ref=departamento");
  }else{
    $mensaje = $consulta->agregarDepartamento($nombre, $pais);
    if ($mensaje == FALSE) {
      header("Location: ../../views/mensajes/error");
    }else {
      header("Location: ../../views/mensajes/registro_exitoso");

  }
  }
}
 ?>
