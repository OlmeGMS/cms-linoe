<?php
require_once('../../models/conexion.php');
require_once('../../models/drivers.php');
require_once('../../models/users.php');

$message = htmlspecialchars($_POST['mensaje'], ENT_QUOTES,'UTF-8');
//$message = "hola";
$tipo_usuario = $_POST['tipo_usuario'];
$title = "Notificacion";

$consultaConductores = new Drivers();
$consultaUsuarios = new Users();

if ($tipo_usuario == 1) {
  //TAXISTAS
  $filas = $consultaConductores->todosCoductoresSistema();
  $Key = "AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI";
}else{
  //USUARIOS
  $filas = $consultaUsuarios->todosUsers();
  $Key = "AIzaSyA47lBB0XAPgt2yAIfw7YoXOl7m49PP76M";
}

$bandera = false;

foreach ($filas as $fila) {
  $llaves[] = $keyToken = $fila['uuid'];

  if (strlen($keyToken) > 64) {
    //ANDROID
    $mensaje = array('message' => "$message", 'extra' => array('push_type' => 38));



    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array('data' => $mensaje, 'to' => $keyToken);
    $headers = array('Content-Type: application/json', "Authorization:key=$Key");

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    curl_close($ch);

    //COMPROBAR SI SE PUDO NOTIFICAR AL CONDUCTOR
    $regreso = json_decode($result);
    $success = $regreso->{"success"};
    $message_id = $regreso->{"results"};

    if ($success == 1) {
      $bandera = true;
      echo "<script> console.log('Se envio la notificación'); </script>";
    }else {
      $bandera = false;
      echo "<script> console.log('No se envio la notificación'); </script>";
    }

  }else {
    //iOS
    echo "<script> console.log('No se envio la notificación'); </script>";
  }
}

if ($bandera == true) {
  header('location: ../../views/mensajes/notificacion_exitosa');
}else{
  header('location: ../../views/mensajes/error');
}








?>
