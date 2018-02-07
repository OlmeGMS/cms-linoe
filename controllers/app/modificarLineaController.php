<?php
require_once('../../models/conexion.php');
require_once('../../models/lineCars.php');
require_once('../../util/nocsrf.php');

$consulta = new LineCars();
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$idMarca = $_POST['marca'];
$idLinea = $_POST['id_linea'];
$estado = 1;

if (isset($_POST['_token'])){
  $filtro = $consulta->filtroLinea($nombre);

      $mensaje = $consulta->modificarLinea($nombre, $idMarca, $idLinea);
      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/app/listaLineasVehiculos");
    }

}
?>
