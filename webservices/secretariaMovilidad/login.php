<?php
require_once('../../models/conexion.php');
require_once('../../models/secretaryLogin.php');
require_once('../../models/parameters.php');

ini_set('date.timezone','America/Bogota');

$consulta = new SecretaryLogin();
$consultaParametros = new Parameters();

$user = $consulta->obtenerUser();
$pass = $consulta->obtenerPassword();

/*

$login = array('usuario' => $user , 'password' => $pass);

header('Content-Type: application/json');
echo json_encode($login);
*/
$hora = $consultaParametros->horaAcutal();

$url = "http://localhost/pruebasScre/login.php";
$ch = curl_init($url);
$data = array('usuario'=>"$user",'password'=>"$pass");

$payload = json_encode($data);
//$payload = json_encode(array("user" => $data));
$data_string = http_build_query(array('data' => json_encode($data)));

curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);

$token = json_decode($response);
$t = $token->{"token"};
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$controTiempo = $consulta->controlTiempo();

if($controTiempo == NULL){
  $res = array('Status' => 'No es necesario actualizar el token');
  header('Content-Type: application/json');
  echo json_encode($res);
}else{
  $mensaje = $consulta->actualizarToken($t, $date);

  if($mensaje == FALSE){
    $res = array('Error' => 'No se puedo actualizar el token');
    header('Content-Type: application/json');
    echo json_encode($res);
  }else{
    $res = array('Status' => '200');
    header('Content-Type: application/json');
    echo json_encode($res);
  }
}






 ?>
