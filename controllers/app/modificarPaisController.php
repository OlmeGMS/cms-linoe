<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCountries.php');
require_once('../../util/nocsrf.php');

$consulta = new CmsCountries();

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$idPais = $_POST['id_pais'];
$estado = 1;
if (isset($_POST['_token'])){
      $mensaje = $consulta->modificarPais($nombre, $idPais);
      if ($mensaje == FALSE) {
        header("Location: ../../views/mensajes/error");
      }else {
        header("Location: ../../views/app/listaPaises");

    }

}
 ?>
