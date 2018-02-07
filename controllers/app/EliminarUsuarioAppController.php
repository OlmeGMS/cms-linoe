<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');

if (isset($_POST['idUsuario'])) {
  $idUser = $_POST['idUsuario'];
  $consulta = new Users();
  $mensaje = $consulta->eliminarUsuarioApp($idUser);

  if ($mensaje == TRUE) {
    return "ELIMINADO";
  }else {
    return "ERROR: El vehiculo tiene servicios asociados";
  }
}

?>
