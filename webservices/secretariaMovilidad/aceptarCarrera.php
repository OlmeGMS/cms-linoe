<?php
require_once('../../models/conexion.php');
require_once('../../models/parameters.php');
require_once('../../models/services.php');
require_once('../../models/secretaryLogin.php');
ini_set('date.timezone','America/Bogota');

$consutlaServiciosCms = new Services();
$consultaParametros = new Parameters();
$consultaSecretaryLogin = new SecretaryLogin();

$idServicioCms = $_GET['id'];

$token = $consultaSecretaryLogin->obtenerToken();
$hora = $consultaParametros->horaAcutal();
$fecha = date('Y-m-d');
$anio = date('y');
$date = "$fecha $hora";
$filas = $consutlaServiciosCms->cargarServicio($idServicioCms);

foreach ($filas as $fila) {
  $idServices = $fila['id'];
  $idCarrera = "0000-$anio-$idServices";
  $estado = $fila['status_id'];
}

if ($estado == 1) {
  $aceptacion = TRUE;
}else {
  $aceptacion = FALSE;
}

$url = "http://localhost/pruebasScre/login.php";
$ch = curl_init($url);
$data = array('idCarrera' => $idCarrera, 'fechaHora' => $date, 'acepta' => $aceptacion);
$payload = json_encode($data);
$data_string = http_build_query(array('data' => json_encode($data)));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Autorization: '.$token));
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
$respuesta = json_decode($response);
$idCarreraSecretaria = $respuesta->{"idCarrera"};

if ($idCarrera == $idCarreraSecretaria) {
  $res = array('Status' => '200');
  header('Content-Type: application/json');
  echo json_encode($res);;
}else {
  $res = array('Error' => 'No se puedo enviar la aceptacion');
  header('Content-Type: application/json');
  echo json_encode($res);
}






 ?>
