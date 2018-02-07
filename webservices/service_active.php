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
$idConductor = $_GET['id_conductor'];



if($idServicio != NULL && $idConductor != NULL){

  $filas = $consulta->obtenerServiciosXStatusConductorSevicio($idServicio, $idConductor);

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

      $response = array('success' => true, 'data' => array('service'=> array('id' => $idServicioArray, 'user_id' => $user_idArryay,'driver_id' => $driver_idArray,'car_id' => $car_idArray,'from_lat' => $from_latArray,'from_lng' => $from_lngArray,'status_id' => $status_idArray,
      'to_lat' => $to_latArray,'qualification' => $qualificationArray,'barrio' => $barrioArray,'obs' => $obsArray,
      'destination' => $destinationArray,'user_name' => $user_nameArray,'address' => $addressArray,'pay_type' => $pay_typeArray,'pay_reference' => $pay_referenceArray,'user_card_reference' => $user_card_referenceArray,'units' => $unitsArray,'charge1' => $charge1Array,
      'charge2' => $charge2Array,'charge3' => $charge3Array,'charge4' => $charge4Array,'value' => $valueArray,'code' => $codeArray,'commit' => $commitArray,'km_recorrido' => $km_recorridoArray,'tiempo_recorido' => $tiempo_recoridoArray,'valor_app' => $valor_appArray,'n_pasajeros' => $n_pasajerosArray,'id_carrera_ant' => $id_carrera_antArray,
      'valor_total' => $valor_appArray)));

      header('Content-Type: application/json');
      echo json_encode($response);

  }else {
    $mensaje = array('success' => false, 'data' => array('message' => 'El id de servicio o del conductor estan errados'));
    header('Content-Type: application/json');
    echo json_encode($mensaje);
  }
}elseif ($idServicio != NULL && $idConductor == NULL) {
  $campo = "id";
  $filas = $consulta->obtenerServiciosXStatus($campo, $idServicio);
  $response = array('success' => false, 'data' => array('services' => $filas));
  header('Content-Type: application/json');
  echo json_encode($response);

}elseif ($idConductor != NULL && $idServicio == NULL) {
  echo "conductor";
  $campo = "driver_id";
  $filas = $consulta->obtenerServiciosXStatus($campo, $idConductor);
  $response = array('success' => false, 'data' => array('services' => $filas));
  header('Content-Type: application/json');
  echo json_encode($response);

}else{
  echo "mal";
}

 ?>
