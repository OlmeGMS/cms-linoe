<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../util/nocsrf.php');

ini_set('date.timezone','America/Bogota');

$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$apellido = htmlspecialchars(strtoupper($_POST['apellido']), ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$login = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$celular = htmlspecialchars($_POST['movil'], ENT_QUOTES,'UTF-8');
$password = md5($_POST['password']);
$fechaActual = date('Y-m-d H:i:s');
$uuid = null;
$type = null;
$token = null;
$fecha = '0000-00-00 00:00:00';
$crt_lat = null;
$crt_lng = null;
$diageo = 0;
$pwd_token = null;
$estado = 1;

if (strlen($nombre) > 0 && strlen($email) > 0 && strlen($telefono) > 0 && strlen($celular) > 0 && strlen($password) > 0 && strlen($fechaActual)) {

  if (isset($_POST['_token'])) {
      if (isset($_POST['_token'])) {
        $consulta = new Users();
        $flag = $consulta->verificarEmail($email);
        if ($flag > 0) {
          $state = $consulta->obtnerEstadoUser($flag);
          if ($state == 1) {
            header('Location: ../../views/mensajes/registro_error.php');
          }else {
            $msj = $consulta->modificarUsuarioApp($nombre, $email, $login, $crt_lat, $crt_lng, $password, $celular, $telefono, $apellido, $fechaActual, $uuid, $fecha, $type, $token, $diageo, $pwd_token, $estado, $flag);
            if($msj == FALSE){
              header('Location: ../../views/mensajes/error.php');
            }else {
              header('Location: ../../views/mensajes/registro_exitoso');
            }
          }

        }else{
          $mensaje = $consulta->nuevoUsers($nombre, $email, $login, $crt_lat, $crt_lng, $password, $celular, $telefono, $apellido, $fechaActual, $uuid, $fecha, $type, $token, $diageo, $pwd_token);
          if ($mensaje == FALSE) {
            header('Location: ../../views/mensajes/error.php');
          }else{
            header('Location: ../../views/mensajes/registro_exitoso');
          }
        }
      }else {
        header("Location: ../../views/mensajes/error.php");
      }
  }

}




 ?>
