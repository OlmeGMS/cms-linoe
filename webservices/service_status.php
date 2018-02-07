<?php
require_once('../models/conexion.php');
require_once('../models/parameters.php');
require_once('../models/services.php');

ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaParameters = new Parameters();

$hora = $consultaParameters->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$idServicio = $_GET['id_servicio'];

$filas = $consulta->obtenerServicioXId($idServicio);

if ($filas > 0) {
  foreach ($filas as $fila) {
    $idServicioArray = $fila['id'];
    $user_idArryay = $fila['user_id'];
    $driver_idArray = $fila['driver_id'];
    $car_idArray = $fila['car_id'];
    $from_latArray = $fila['from_lat'];
    $from_lngArray = $fila['from_lng'];
    $status_idArray = $fila['status_id'];
    $to_latArray = $fila['to_lat'];
    $to_lngArray = $fila['to_lng'];
    $qualificationArray = $fila['qualification'];
    $barrioArray = $fila['barrio'];
    $obsArray = $fila['obs'];
    $kind_idArray = $fila['kind_id'];
    $created_atArray = $fila['created_at'];
    $destinationArray = $fila['destination'];
    $user_nameArray = $fila['user_name'];
    $addressArray = $fila['address'];
    $pay_typeArray = $fila['pay_type'];
    $pay_referenceArray = $fila['pay_reference'];
    $user_card_referenceArray = $fila['user_card_reference'];
    $commitArray = $fila['commit'];
    $unitsArray = $fila['units'];
    $charge1Array = $fila['charge1'];
    $charge2Array = $fila['charge2'];
    $charge3Array = $fila['charge3'];
    $charge4Array = $fila['charge4'];
    $valueArray = $fila['value'];
    $codeArray = $fila['code'];
    $km_recorridoArray = $fila['km_recorrido'];
    $tiempo_recoridoArray = $fila['tiempo_recorido'];
    $valor_appArray = $fila['valor_app'];
    $n_pasajerosArray = $fila['n_pasajeros'];
    $id_carrera_antArray = $fila['id_carrera_ant'];
    $valor_totalArray = $fila['valor_total'];
  }

  if($id_carrera_antArray != NULL){
    //Se captura los servicio anterior
    $rows = $consulta->obtenerServicioXId($id_carrera_antArray);
        foreach ($rows as $row) {
          $idServicioArrayB = $row['id'];
          $user_idArryayB = $row['user_id'];
          $driver_idArrayB = $row['driver_id'];
          $car_idArrayB = $row['car_id'];
          $from_latArrayB = $row['from_lat'];
          $from_lngArrayB = $row['from_lng'];
          $status_idArrayB = $row['status_id'];
          $to_latArrayB = $row['to_lat'];
          $to_lngArrayB = $row['to_lng'];
          $qualificationArrayB = $row['qualification'];
          $barrioArrayB = $row['barrio'];
          $obsArrayB = $row['obs'];
          $kind_idArrayB = $row['kind_id'];
          $created_atArrayB = $row['created_at'];
          $destinationArrayB = $row['destination'];
          $user_nameArrayB = $row['user_name'];
          $addressArrayB = $row['address'];
          $pay_typeArrayB = $row['pay_type'];
          $pay_referenceArrayB = $row['pay_reference'];
          $user_card_referenceArrayB = $row['user_card_reference'];
          $commitArrayB = $row['commit'];
          $unitsArrayB = $row['units'];
          $charge1ArrayB = $row['charge1'];
          $charge2ArrayB = $row['charge2'];
          $charge3ArrayB = $row['charge3'];
          $charge4ArrayB = $row['charge4'];
          $valueArrayB = $row['value'];
          $codeArrayB = $row['code'];
          $km_recorridoArrayB = $row['km_recorrido'];
          $tiempo_recoridoArrayB = $row['tiempo_recorido'];
          $valor_appArrayB = $row['valor_app'];
          $n_pasajerosArrayB = $row['n_pasajeros'];
          $id_carrera_antArrayB = $row['id_carrera_ant'];
          $valor_totalArrayB = $row['valor_total'];
        }
  }


  if($id_carrera_antArray != NULL){

    $response = array('success' => true, 'data' => array('id' => $idServicioArray, 'user_id' => $user_idArryay,'driver_id' => $driver_idArray,'car_id' => $car_idArray,'from_lat' => $from_latArray,'from_lng' => $from_lngArray,'status_id' => $status_idArray,
    'to_lat' => $to_latArray,'qualification' => $qualificationArray,'barrio' => $barrioArray,'obs' => $obsArray,
    'kind_id' => $kind_id,'schedule_id' => $schedule_id,'updated_at' => $updated_at,'created_at' => $created_at,
    'destination' => $destinationArray,'user_name' => $user_nameArray,'address' => $addressArray,'pay_type' => $pay_typeArray,'pay_reference' => $pay_referenceArray,'user_card_reference' => $user_card_referenceArray,'units' => $unitsArray,'charge1' => $charge1Array,
    'charge2' => $charge2Array,'charge3' => $charge3Array,'charge4' => $charge4Array,'value' => $valueArray,'code' => $codeArray,'commit' => $commitArray,'km_recorrido' => $km_recorridoArray,'tiempo_recorido' => $tiempo_recoridoArray,'valor_app' => $valor_appArray,'n_pasajeros' => $n_pasajerosArray,'id_carrera_ant' => $id_carrera_antArray,
    'valor_total' => $valor_appArray), 'route' => array(array('id_servicio' => $idServicioArray, 'lat_origen' => $from_latArray, 'lng_origen' => $from_lngArray,'lat_destino' => $to_latArrayB, 'lng_destino' => $to_lngArrayB,
    'address' => $addressArray, 'destination' => $destinationArray, 'valor_app' => $valor_appArray),array('id_servicio' => $idServicioArrayB, 'lat_origen' => $from_latArrayB, 'lng_origen' => $from_lngArrayB, 'lat_destino' => $to_latArrayB, 'lng_destino' => $to_lngArrayB, 'address' => $addressArrayB,
    'destination' => $destinationArrayB, 'valor_app' => $valor_appArrayB)));

  }else{

    $response = array('success' => true, 'data' => array('service'=> array('id' => $idServicioArray, 'user_id' => $user_idArryay,'driver_id' => $driver_idArray,'car_id' => $car_idArray,'from_lat' => $from_latArray,'from_lng' => $from_lngArray,'status_id' => $status_idArray,
    'to_lat' => $to_latArray,'qualification' => $qualificationArray,'barrio' => $barrioArray,'obs' => $obsArray,
    'kind_id' => $kind_id,'schedule_id' => $schedule_id,'updated_at' => $updated_at,'created_at' => $created_at,
    'destination' => $destinationArray,'user_name' => $user_nameArray,'address' => $addressArray,'pay_type' => $pay_typeArray,'pay_reference' => $pay_referenceArray,'user_card_reference' => $user_card_referenceArray,'units' => $unitsArray,'charge1' => $charge1Array,
    'charge2' => $charge2Array,'charge3' => $charge3Array,'charge4' => $charge4Array,'value' => $valueArray,'code' => $codeArray,'commit' => $commitArray,'km_recorrido' => $km_recorridoArray,'tiempo_recorido' => $tiempo_recoridoArray,'valor_app' => $valor_appArray,'n_pasajeros' => $n_pasajerosArray,'id_carrera_ant' => $id_carrera_antArray,
    'valor_total' => $valor_appArray), 'route' => array('id_servicio' => $idServicioArray, 'lat_origen' => $from_latArray, 'lng_origen' => $from_lngArray,
    'address' => $addressArray, 'destination' => $destinationArray, 'valor_app' => $valor_appArray)));
  }



header('Content-Type: application/json');
echo json_encode($response);

}else {
  $mensaje = array('success' => false, 'data' => array('message' => 'El id no corresponde a un servicio'));
  header('Content-Type: application/json');
  echo json_encode($mensaje);
}





 ?>
