<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsUsers.php');
require_once('../../util/Cifrado.php');

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$documento = htmlspecialchars($_POST['movil'], ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$password = Cifrado($_POST['password']);
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES,'UTF-8');
$fechaActual = date('Y-m-d H:i:s');

if (strlen($nombre) > 0 && strlen($documento) > 0 && strlen($email) > 0 && strlen($password) > 0 && strlen($rol) > 0 && strlen($fechaActual) > 0 ) {
  $consulta = new CmsUsers();
  $flag = $consulta->verificarCorreo($email);
  if ($flag == "true") {
    header("Location: ../../views/mensajes/registro_error.php");
  }else{
    $mensaje = $consulta->agregarUsuarioApp($nombre, $documento, $email, $rol, $password, $fechaActual);
  }
}else{
  header("Location: ../../views/mensajes/error.php");
}
 ?>
