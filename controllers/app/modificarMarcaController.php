<?php
require_once('../../models/conexion.php');
require_once('../../models/brandsCars.php');
require_once('../../util/nocsrf.php');

$consulta = new BrandsCars();

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$idMarca = $_POST['id_marca'];
$estado = 1;
if (isset($_POST['_token'])){

      $mensaje = $consulta->modificarMarca($nombre, $idMarca);
      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/app/listaMarcas");

    }

}
 ?>
