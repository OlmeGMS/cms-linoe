<?php
require_once('../../models/conexion.php');
require_once('../../models/brandsCars.php');
require_once('../../util/nocsrf.php');

$consulta = new BrandsCars();

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$estado = 1;
if (isset($_POST['_token'])){
    $filtro = $consulta->filtroMarca($nombre);
    if ($filtro != NULL || $filtro != 0 ) {
      header("Location: ../../views/mensajes/error_existe?ref=marca");
    }else {
      $mensaje = $consulta->agregarMarca($nombre, $estado);
      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/mensajes/registro_exitoso");

    }
  }
}
 ?>
