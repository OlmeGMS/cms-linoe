<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/cmsUsers.php');
require_once('../../util/Cifrado.php');
require_once('../../util/nocsrf.php');

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$documento = htmlspecialchars($_POST['Documento'], ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$password = Cifrado($_POST['password']);
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES,'UTF-8');
$fechaActual = date('Y-m-d H:i:s');

if (strlen($nombre) > 0 && strlen($documento) > 0 && strlen($email) > 0 && strlen($password) > 0 && strlen($rol) > 0 && strlen($fechaActual) > 0 ) {
  if (isset($_POST['_token'])) {
    if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
      $consulta = new CmsUsers();
      $flecha = $consulta->obtenerEstadoUsuarioCms($email);

      if ($flecha == 2) {
        $estado = 1;
        $idUserCms = $consulta->obtenerIdDUserCms($email);
        $mensaje = $consulta->modificarUsuarioCmsReingreso($nombre, $email, $fechaActual, $documento, $password, $estado, $idUserCms);
        if ($mensaje == FALSE) {
          header("Location: ../../views/mensajes/error");
        }else{
          header("Location: ../../views/mensajes/registro_exitoso");
        }
      }elseif ($flecha == 1) {
        header("Location: ../../views/mensajes/error_existe?ref=usuario");
      }elseif ($flecha == '' || $flecha == null || $flecha == false) {
        $flag = $consulta->verificarCorreo($email);

        if ($flag == TRUE) {
          header("Location: ../../views/mensajes/registro_error.php");
        }else{
          $mensaje = $consulta->agregarUsuarioOperador($nombre, $documento, $email, $rol, $password, $fechaActual);
        }
      }
    }else {
      header("Location: ../../views/mensajes/error.php");
    }
  }





}else{
  header("Location: ../../views/mensajes/error.php");
}
 ?>
