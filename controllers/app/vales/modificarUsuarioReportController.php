<?php
session_start();
require_once('../../../models/conexion.php');
require_once('../../../models/ticket_users.php');
require_once('../../../models/cmsUsers.php');
require_once('../../util/nocsrf.php');

ini_set('date.timezone','America/Bogota');
$consultaTicketUsers = new TicketUsers();
$consulta = new CmsUsers();

$mensaje = null;
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$movil = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$idUsuarioReport = $_POST['id_usuario_report'];
$fecha = date('Y-m-d h:m:s');

$idUsuarioCms = $_POST['id_usuario_cms'];
$parent = $_POST['id_usuario_parent'];

if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
    $msj = $consulta->modificarReporterCms($nombre, $email, $fecha, $idUsuarioCms);

    if ($msj == FALSE) {
      echo "ERROR: no se pudo modificar el usuario reporter";
    }else {
      $mensajes = $consultaTicketUsers->modificarUsuarioReport($nombre, $email, $movil, $idUsuarioReport);

      return $mensaje;
    }
  }else{
    header("Location: ../../views/mensajes/error.php");
  }
}




 ?>
