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
$idCentroCostos = $_POST['centro_costo'];
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$movil = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$idUsuarioManager = $_POST['id_usuario_manager'];
$fecha = date('Y-m-d h:m:s');

if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
    $msj = $consulta->modificarManagerCms($nombre, $email, $fecha, $idCentroCostos, $idUsuarioManager);

    if($msj == FALSE){
       echo "Error";
    }else {
      $mensajes = $consultaTicketUsers->modificarUsuarioManager($idCentroCostos, $nombre, $email, $movil, $idUsuarioManager);

      return $mensaje;
    }
  }else {
    header("Location: ../../views/mensajes/error.php");
  }
}



 ?>
