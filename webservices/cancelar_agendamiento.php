<?php
require_once('../models/conexion.php');
require_once('../models/schedule.php');
require_once('../models/llaves.php');
require_once('../models/users.php');

$consulta = new Schedule();
$consultaKeys = new Llaves();
$consultaUsuario = new Users();

$idAgendamiento = $_GET['id'];
$idUsuario = $_GET['user'];

$llave = $consultaKeys->firebaseUsuario();
$uuid = $consultaUsuario->obtenerUuidUsuario($idUsuario);
$mensaje = $consulta->cancelarAgendamientoUsuario($idAgendamiento, $idUsuario);

if ($mensaje == TRUE) {
  $respuesta = "Status: 200";
  if ($uuid != NULL) {
    $message = array('message' => 'Se ha cancelado el agendamiento', 'push_type'=>82);
    $url = 'https://fcm.googleapis.com/fcm/send';
    $keyToken = "$uuid";
    $fields = array('data' => $message, 'to' => $keyToken);
    $headers = array('Content-Type: application/json', "Authorization:key=$llave");
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    curl_close($ch);
    //COMPROBAR SI SE PUDO NOTIFICAR AL USUARIO
    $regreso = json_decode($result);
    $success = $regreso->{"success"};
    $message_id = $regreso->{"results"};
    if ($success == 1) {
      $respuesta = array('success' => true, 'data' => array('message' => 'Se cancelo el agendamiento y el usuario fue notificado'));
      header('Content-Type: application/json');
      echo json_encode($respuesta);
    }else {
      $respuesta = array('success' => false, 'data' => array('message' => 'No se pudo notificar al usuario'));
      header('Content-Type: application/json');
      echo json_encode($respuesta);
    }
  }else {
    $respuesta = array('success' => false, 'data' => array('message' => 'El usuario no tiene uuid registrado'));
    header('Content-Type: application/json');
    echo json_encode($respuesta);
  }

}else{

  $respuesta = array('success' => false, 'data' => array('message' => 'No se pudo cancelar el agendamiento'));
  header('Content-Type: application/json');
  echo json_encode($respuesta);
}


?>
