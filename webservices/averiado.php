<?php
require_once('../models/conexion.php');
require_once('../models/services.php');
require_once('../models/parameters.php');
require_once('../models/secretaryCars.php');
require_once('../models/drivers.php');
require_once('../models/llaves.php');
ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaParameters = new Parameters();
$consultaSecretaryCars = new SecretaryCars();
$consultaKeys = new Llaves();
$consultaConductor = new Drivers();

$llave = $consultaKeys->firebaseConductor();
$hora = $consultaParameters->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$idCarro = $_POST['id_vehiculo'];
$idConductor = $_POST['conductor'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$estado = $_POST['estado'];
$idCarrera = NULL;

if ($estado == 1) {
  $status = "A";
  $message = array('message' => 'El vehículo fue reportado como averiado', 'push_type'=>80);
}elseif ($estado == 2) {
  $status = "D";
  $message = array('message' => 'El vehículo fue reportado como habilitado', 'push_type'=>80);
}

$mensaje = $consultaSecretaryCars->insertarAveriado($idCarro, $idConductor, $lat, $lng, $date, $status, $idCarrera);

if ($mensaje == TRUE) {
  $uuid = $consultaConductor->obtenerUuidConductor($idConductor);
  if ($uuid != NULL) {

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
      $mensaje = array('success' => true, 'data' => array('message' => 'El conductor fue notificado'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }else {
      $msj = array('success' => false, 'data' => array('message' => 'No se pudo notificar al usuario'));
      header('Content-Type: application/json');
      echo json_encode($msj);
    }
  }else {
    $msj = array('success' => false, 'data' => array('message' => 'El conductor no tiene uuid registrado'));
    header('Content-Type: application/json');
    echo json_encode($msj);
  }
}else{
  $message = array('success' => false, 'data' => array('message' => 'No se envio ningun id'));
  header('Content-Type: application/json');
  echo json_encode($message);

}

header('Content-Type: application/json');
echo json_encode($respuesta);


 ?>
