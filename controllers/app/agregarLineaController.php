<?php
require_once('../../models/conexion.php');
require_once('../../models/lineCars.php');
require_once('../../util/nocsrf.php');

$consulta = new LineCars();
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$idMarca = $_POST['marca'];
$estado = 1;

if (isset($_POST['_token'])){
  $filtro = $consulta->filtroLinea($nombre);
  if ($filtro != NULL || $filtro != 0) {
    header("Location: ../../views/mensajes/error_existe?ref=Línea");
  }else {
      $mensaje = $consulta->agregarLinea($nombre, $idMarca, $estado);
      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/mensajes/registro_exitoso");
    }
  }
}
?>
