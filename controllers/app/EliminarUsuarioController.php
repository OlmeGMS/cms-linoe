<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsUsers.php');

if (isset($_POST['idUsuario'])) {
  $idUser = $_POST['idUsuario'];
  $consulta = new CmsUsers();
  $mensaje = $consulta->EstadoUsuarioCms($idUser);

  if ($mensaje == TRUE) {
    return "ELIMINADO";
  }else {
    return "ERROR: El vehiculo tiene servicios asociados";
  }
}

?>
