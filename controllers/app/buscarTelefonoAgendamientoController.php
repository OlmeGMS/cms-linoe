<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');

$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');

$consulta = new Users();
$consultaDir = new UsersDirs();

$idUser = $consulta->obtenerIdUser($telefono);
if ($idUser == FALSE) {
  $url = 'agendamientoNuevoUsuario?tel='.$telefono;
  header("Location: ../../views/app/$url");
}else {
  $url = 'agendamientoBuscador?id_usu='.$idUser.'&&tel='.$telefono;
  header("Location: ../../views/app/$url");
}




?>
