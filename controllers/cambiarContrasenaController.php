<?php
require_once('../models/conexion.php');
require_once('../models/cmsUsers.php');
require_once('../util/Cifrado.php');

$mensaje = null;
$idUsuario = $_POST['idUsuario'];
$nuevaClave = Cifrado($_POST['user-settings-password']);

if (strlen($idUsuario) > 0) {
  $consulta = new CmsUsers();
  $mensaje = $consulta->cambiarContrasena($nuevaClave, $idUsuario);
  if($mensaje == FALSE){
    header("Location: ../views/mensajes/errorContrasena.php");
  }else {
    header("Location: ../views/mensajes/cambiarContrasena.php");
  }

}

 ?>
