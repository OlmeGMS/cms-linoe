<?php
require_once('../models/conexion.php');
require_once('../models/llaves.php');
require_once('../models/drivers.php');
require_once('../models/users.php');

$consultaKeys = new Llaves();
$consultaConductor = new Drivers();
$consultaUsuario = new Users();

$idUsuario = $_GET['id_usuario'];
$idConductor = $_GET['id_conductor'];

if ($idUsuario == NULL && $idConductor == NULL) {

  $mensaje = array('success' => false, 'data' => array('message' => 'No se envio ningun id'));
  header('Content-Type: application/json');
  echo json_encode($mensaje);
}else {

  if ($idUsuario != NULL && $idConductor == NULL) {
    $llave = $consultaKeys->firebaseUsuario();
    $uuid = $consultaUsuario->obtenerUuidUsuario($idUsuario);
    if ($uuid != NULL) {
      $message = array('message' => 'Tienes un nuevo mensaje en el chat', 'push_type'=>99);
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
        $mensaje = array('success' => true, 'data' => array('message' => 'El usuario fue notificado'), 'push_type'=>99);
        header('Content-Type: application/json');
        echo json_encode($mensaje);
      }else {
        $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo notificar al usuario'));
        header('Content-Type: application/json');
        echo json_encode($mensaje);
      }
    }else {
      $mensaje = array('success' => false, 'data' => array('message' => 'El usuario no tiene uuid registrado'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }



  }elseif ($idUsuario == NULL && $idConductor != NULL) {
    //CONDUCTOR
    $llave = $consultaKeys->firebaseConductor();
    $uuid = $consultaConductor->obtenerUuidConductor($idConductor);

    if ($uuid != NULL) {
      $message = array('message' => 'Tienes un nuevo mensaje en el chat', 'push_type'=>99);
      $url = 'https://fcm.googleapis.com/fcm/send';
      $keyToken = "$uuid";
      $fields = array('data' => $message, 'to' => $keyToken);
      $headers = array('Content-Type: application/json', 'Authorization:key='.$llave);
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
        $mensaje = array('success' => true, 'data' => array('message' => 'El conductor fue notificado'), 'push_type'=>99);
        header('Content-Type: application/json');
        echo json_encode($mensaje);
      }else {
        $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo notificar al conductor'));
        header('Content-Type: application/json');
        echo json_encode($mensaje);
      }
    }else {
      $mensaje = array('success' => false, 'data' => array('message' => 'El conductor no tiene uuid registrado'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }
  }
}



 ?>
