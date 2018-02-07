<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCountries.php');
require_once('../../util/nocsrf.php');

$consulta = new CmsCountries();

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$estado = 1;
if (isset($_POST['_token'])){
    $filtro = $consulta->filtroPais($nombre);
    if ($filtro != NULL || $filtro != 0 ) {
      header("Location: ../../views/mensajes/error_existe?ref=país");
    }else {
      $mensaje = $consulta->agregarPais($nombre, $estado);
      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/mensajes/registro_exitoso");

    }
  }
}
 ?>
