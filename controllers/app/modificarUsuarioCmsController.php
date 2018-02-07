<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/cmsUsers.php');
require_once('../../util/nocsrf.php');


$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$documento = htmlspecialchars($_POST['Documento'], ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$fechaActual = date('Y-m-d H:i:s');
$idUsuario = $_POST['idUsuario'];
$rol = $_POST['rol'];

if (strlen($nombre) > 0 && strlen($documento) > 0 && strlen($email) > 0  && strlen($fechaActual) > 0 && strlen($idUsuario) > 0 ) {
  $consulta = new CmsUsers();
  if (isset($_POST['_token'])) {
    if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
        $mensaje = $consulta->modificarUsuarioCms($nombre, $rol, $email, $fechaActual,$documento, $idUsuario);
        if($mensaje == FALSE){
          header("Location: ../../views/mensajes/error.php");
        }else {
          header("Location: ../../views/app/usuariosCms.php");
        }
    }else {
      header("Location: ../../views/mensajes/error.php");
    }
  }

}else{
  header("Location: ../../views/mensajes/error.php");
}
 ?>
