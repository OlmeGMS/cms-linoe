<?php
session_start();
require_once('../../../models/conexion.php');
require_once('../../../models/ticket_users.php');
require_once('../../../models/cmsUsers.php');
require_once('../../../util/Cifrado.php');
require_once('../../../util/nocsrf.php');

ini_set('date.timezone','America/Bogota');

$idCompania = $_POST['id_compania'];
$idCentroCostos = $_POST['centro_costo'];
$idParent = $_POST['id_usuario'];
$rol = $_POST['rol'];
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$movil = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$cedula = htmlspecialchars($_POST['Documento'], ENT_QUOTES,'UTF-8');
$pass = Cifrado($_POST['password']);
$fecha = date('Y-m-d h:m:s');

if(strlen($idCompania) > 0 && strlen($idCentroCostos) > 0 && strlen($idParent) > 0 && strlen($rol) > 0 && strlen($nombre) > 0 && strlen($movil) > 0 && strlen($email) > 0 && strlen($pass) > 0){

  if (isset($_POST['_token'])) {
    if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
      $consulta = new TicketUsers();
      $consultaUsuarioCms = new CmsUsers();

      $flag = $consulta->verificarCorreo($email);
      if($flag == "true"){
        header("Location: ../../../views/mensajes/error");
      }else{
        $flagTwo = $consulta->verificarMovil($movil);
        if ($flagTwo == "true") {
          header("Location: ../../../views/mensajes/error");
        }else{
          $msj = $consultaUsuarioCms->agregarUsuarioCmsVales($nombre, $email, $fecha, $cedula, $pass, $idCompania, $idParent, $idCentroCostos, $rol);
          if($msj == FALSE){

          }else{
            $mensaje = $consulta->crearUsuarioManager($idCompania, $idCentroCostos, $idParent, $rol, $nombre, $movil, $email, $pass);
            if ($mensaje == FALSE) {
              header("Location: ../../../views/mensajes/error");
            }else {
              header("Location: ../../../views/mensajes/registro_exitoso.php");
            }
          }

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
