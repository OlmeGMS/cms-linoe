<?php
require_once('../models/conexion.php');
require_once('../models/parameters.php');
require_once('../models/services.php');
require_once('../models/users.php');
require_once('../models/drivers.php');
require_once('../models/usersDirs.php');
require_once('../models/ticketTickets.php');
require_once('../models/holidays.php');
require_once('../models/llaves.php');
ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaUsers = new Users();
$consultaUserDir = new UsersDirs();
$consultaParameters = new Parameters();
$consultaTickets = new TicketTickets();
$consultaHoliday = new Holidays();
$consultaConductor = new Drivers();
$consultaKeys = new Llaves();

$hora = $consultaParameters->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$llave = $consultaKeys->firebaseConductor();

//CAPTURA

$idCarro = $_POST['id_vehiculo'];
$id_Conductor = $_POST['id_conductor'];
$lati = $_POST['latitude'];
$longi = $_POST['longitude'];
$to_lati = $_POST['to_lati'];
$to_lng = $_POST['to_lng'];
$direccion = $_POST['direccion'];
$observaciones = $_POST['obs'];
$barrio = $_POST['barrio'];
$kind_id = 3;
$destino = $_POST['destino'];
$kmRecorrio = $_POST['km_recorrido'];
$tiempoRecorrido = $_POST['tiempo_recorido'];
$valorApp = $_POST['valor_app'];
$idCarreraAnteriror = $_POST['carrera_anterior'];
$n_pasajeros = $_POST['n_pasajeros'];
$charge1Creacion = $_POST['charge1'];
$charge2Creacion = $_POST['charge2'];
$charge3Creacion = $_POST['charge3'];
$charge4Creacion = $_POST['charge4'];


$status = 4;


//SE CAPTURA LOS DATOS DE LA CARRERA carrera_anterior
$filas = $consulta->obtenerServicioXId($idCarreraAnteriror);

foreach($filas as $fila){
  $idUsuario = $fila['user_id'];
  $userName = $fila['user_name'];
  $cmsUser = $fila['cms_users_id'];
  $pay_type = $fila['pay_type'];
  $pay_reference = $fila['pay_reference'];
  $user_card_reference = $fila['user_card_reference'];
  $code = $fila['code'];
  $company_id = $fila['company_id'];
  $state_payment = 0;
  $commit = $fila['commit'];
  $valorTotal = $fila['valor_app'] + $valorApp;

}

if ($user_card_reference == NULL) {
  $user_card_reference = "0";
}

if ($commit == NULL) {
  $commit = " ";
}
if ($company_id == NULL) {
  $company_id = 0;
}
if ($observaciones == NULL) {
  $observaciones = "";
}
//TERMINAR EL SERVICIO INTERRUPIDO

$message = $consulta->finalizarServicioInterrumpido($idCarreraAnteriror);
if ($message == FALSE) {
  $respuesta = array('success' => false, 'data' => array('message' => 'No se pudo crear el servicio'));
  header('Content-Type: application/json');
  echo json_encode($respuesta);
}else {
  //SE CREA EL NUEVO SERVICIO
  $flecha = $consulta->crearServicioInterrumpido($idUsuario,$id_Conductor,$idCarro,$lati,$longi,$status,$to_lati,$to_lng,$barrio,$observaciones,$kind_id,$date,$destino,$userName,$direccion,$cmsUser,$pay_type,$pay_reference,$user_card_reference,$charge1Creacion,$charge2Creacion,$charge3Creacion,$charge4Creacion,$code,$company_id,$state_payment,$commit,$kmRecorrio,$tiempoRecorrido,$valorApp,
                                                $n_pasajeros,$idCarreraAnteriror,$valorTotal);

  if ($flecha == FALSE) {
    $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo crear el servicio'));
    header('Content-Type: application/json');
    echo json_encode($mensaje);
  }else {
    $idUltimoServicio = $consulta->obtenerUltimoIdServicio();
    $mensaje = $consulta->obtenerServicioXId($idUltimoServicio);
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
      $charge2 = $m['charge2'];
      $charge3 = $m['charge3'];
      $charge4 = $m['charge4'];
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

    $uuid  = $consultaConductor->obtenerUuidConductor($id_Conductor);


    if (strlen($uuid) > 64){
      //Android
      $url = 'https://fcm.googleapis.com/fcm/send';
      $keyToken = "$uuid";
      //$Key = 'AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI';
      //$fields = array('to' => $keyToken, 'data' => $mensaje);

      //$fields = array('to' => $keyToken, 'data' => $mensaje);
      $msj = array('message' => 'El servicio se ha interrupido', 'push_type'=>83);
      $fields = array('data' => $msj, 'to' => $keyToken);
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
    }else {
      //ios
    }

    if ($success == 1) {
      $res = array('success' => true, 'data' => array('id' => $id, 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,'to_lat' => $to_lat,
      'start_datetime' => $start_datetime,'finish_datetime' => $finish_datetime,'qualification' => $qualification,'reason_qualification' => $reason_qualification,'index_id' => $index_id,'comp1' => $comp1,'comp2' => $comp2,'no' => $no,'barrio' => $barrio,'$obs' => $obs,
      'kind_id' => $kind_id,'schedule_id' => $schedule_id,'updated_at' => $updated_at,'$created_at' => $created_at,
      'destination' => $destination,'service_date_time' => $service_date_time,'user_name' => $user_name,'address' => $address,'cms_users_id' => $cms_users_id,'pay_type' => $pay_type,'pay_reference' => $pay_reference,'user_card_reference' => $user_card_reference,'user_email' => $user_email,'units' => $units,'charge1' => $charge1,
      'charge2' => $charge2,'charge3' => $charge3,'charge4' => $charge4,'value' => $value,'code' => $code,'company_id ' => $company_id ,'state_payment' => $state_payment,'cedula' => $cedula,'date_state_payment' => $date_state_payment,'commit' => $commit,'facturado' => $facturado,
      'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,'n_pasajeros' => $n_pasajeros,'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total));

      header('Content-Type: application/json');
      echo json_encode($res);
    }else{
      $res = array('success' => true, 'data' => array('id' => $id, 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,'to_lat' => $to_lat,
      'start_datetime' => $start_datetime,'finish_datetime' => $finish_datetime,'qualification' => $qualification,'reason_qualification' => $reason_qualification,'index_id' => $index_id,'comp1' => $comp1,'comp2' => $comp2,'no' => $no,'barrio' => $barrio,'$obs' => $obs,
      'kind_id' => $kind_id,'schedule_id' => $schedule_id,'updated_at' => $updated_at,'$created_at' => $created_at,
      'destination' => $destination,'service_date_time' => $service_date_time,'user_name' => $user_name,'address' => $address,'cms_users_id' => $cms_users_id,'pay_type' => $pay_type,'pay_reference' => $pay_reference,'user_card_reference' => $user_card_reference,'user_email' => $user_email,'units' => $units,'charge1' => $charge1,
      'charge2' => $charge2,'charge3' => $charge3,'charge4' => $charge4,'value' => $value,'code' => $code,'company_id ' => $company_id ,'state_payment' => $state_payment,'cedula' => $cedula,'date_state_payment' => $date_state_payment,'commit' => $commit,'facturado' => $facturado,
      'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,'n_pasajeros' => $n_pasajeros,'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total), 'message' => 'No se pudo notificarle al conductor');

      header('Content-Type: application/json');
      echo json_encode($res);
    }

  }
}






 ?>
