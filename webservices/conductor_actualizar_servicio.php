<?php
require_once('../models/conexion.php');
require_once('../models/services.php');
require_once('../models/parameters.php');
require_once('../models/holidays.php');
require_once('../models/drivers.php');
require_once('../models/llaves.php');

ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaParametros = new Parameters();
$consultaHoliday = new Holidays();
$consultaConductor = new Drivers();
$consultaKeys = new Llaves();

$idConductor = $_GET['id_conductor'];
$idServicio = $_GET['servicio'];

$mensaje = $consulta->obtenerServicioXId($idServicio);
foreach ($mensaje as $m) {
  $id = $m['id'];
  $user_id = $m['user_id'];
  $driver_id = $m['driver_id'];
  $car_id = $m['car_id'];
  $from_lat = $m['from_lat'];
  $from_lng = $m['from_lng'];
  $status_id = $m['status_id'];
  $to_lat = $m['to_lat'];
  $to_lng = $m['to_lng'];
  $start_datetime = $m['start_datetime'];
  $finish_datetime = $m['finish_datetime'];
  $qualification = $m['qualification'];
  $reason_qualification = $m['reason_qualification'];
  $index_id = $m['index_id'];
  $comp1 = $m['comp1'];
  $comp2 = $m['comp2'];
  $no = $m['no'];
  $barrio = $m['barrio'];
  $obs = $m['obs'];
  $kind_id = $m['kind_id'];
  $schedule_id = $m['schedule_id'];
  $schedule_type = $m['schedule_type'];
  $updated_at = $m['updated_at'];
  $created_at = $m['created_at'];
  $destination = $m['destination'];
  $service_date_time = $m['service_date_time'];
  $user_name = $m['user_name'];
  $address = $m['address'];
  $cms_users_id = $m['cms_users_id'];
  $pay_type = $m['pay_type'];
  $pay_reference = $m['pay_reference'];
  $user_card_reference = $m['user_card_reference'];
  $user_email = $m['user_email'];
  $units = $m['units'];
  $charge1 = $m['charge1'];
  $charge2 = $m['$charge2'];
  $charge3 = $m['$charge3'];
  $charge4 = $m['$charge4'];
  $value = $m['value'];
  $code = $m['code'];
  $company_id = $m['company_id'];
  $state_payment = $m['state_payment'];
  $cedula = $m['cedula'];
  $date_state_payment = $m['date_state_payment'];
  $commit = $m['commit'];
  $facturado = $m['facturado'];
  $km_recorrido = $m['km_recorrido'];
  $tiempo_recorido = $m['tiempo_recorido'];
  $valor_app = $m['valor_app'];
  $n_pasajeros = $m['n_pasajeros'];
  $id_carrera_ant = $m['id_carrera_ant'];
  $valor_total = $m['valor_total'];
}

//PUSH
$message = array('message' => 'El servicio ha sido interrupido por el usuario', 'push_type' => 48, 'id' => $id, 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,'to_lat' => $to_lat,
'start_datetime' => $start_datetime,'finish_datetime' => $finish_datetime,'qualification' => $qualification,'reason_qualification' => $reason_qualification,'index_id' => $index_id,'comp1' => $comp1,'comp2' => $comp2,'no' => $no,'barrio' => $barrio,'$obs' => $obs,
'kind_id' => $kind_id,'schedule_id' => $schedule_id,'updated_at' => $updated_at,'$created_at' => $created_at,
'destination' => $destination,'service_date_time' => $service_date_time,'user_name' => $user_name,'address' => $address,'cms_users_id' => $cms_users_id,'pay_type' => $pay_type,'pay_reference' => $pay_reference,'user_card_reference' => $user_card_reference,'user_email' => $user_email,'units' => $units,'$charge1' => $charge1,
'$charge2' => $charge2,'$charge3' => $charge3,'$charge4' => $charge4,'value' => $value,'code' => $code,'company_id ' => $company_id ,'state_payment' => $state_payment,'cedula' => $cedula,'date_state_payment' => $date_state_payment,'commit' => $commit,'facturado' => $facturado,
'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,'n_pasajeros' => $n_pasajeros,'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total );

$conductores = $consultaConductor->cargarConductor($driver_id);
foreach ($conductores as $conductor) {
  $uuid = $conductor['uuid'];
}

if (strlen($uuid) > 64){
  //Android
  $llave = $consultaKeys->firebaseConductor();
  $url = 'https://fcm.googleapis.com/fcm/send';
  $keyToken = "$uuid";
  $fields = array('to' => $keyToken, 'data' => $message);
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
  if ($success == 1) {
    //respuesta JSON
    $res = array('success' => true, 'data' => array('message' => 'El servicio ha sido interrupido por el usuario, El conductor fue notificado'), 'push_type'=>48);
    header('Content-Type: application/json');
    echo json_encode($res);
  }else{
    $res = array('error' => 'no se pudo notificar al conductor');
    header('Content-Type: application/json');
    echo json_encode($res);
  }
}else{
  //ios
}


 ?>
