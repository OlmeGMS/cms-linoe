<?php
require_once('../models/conexion.php');
require_once('../models/services.php');
require_once('../models/drivers.php');
require_once('../models/cars.php');
require_once('../models/ticketTickets.php');
require_once('../models/parameters.php');
require_once('../models/users.php');
require_once('../models/llaves.php');
ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaParameters = new Parameters();
$consultaTickets = new TicketTickets();
$consultaConductor = new Drivers();
$consultaVehiculo = new Cars();
$consultaUsers = new Users();
$consultaKeys = new Llaves();

$hora = $consultaParameters->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";

$llaveUsuario = $consultaKeys->firebaseUsuario();
$llaveConductor = $consultaKeys->firebaseConductor();



//Captura

$idServicio = $_POST['id_servicio'];
$idConductor = $_POST['id_conductor'];
$unidades = $_POST['unidades'];
$valor = $_POST['valor'];
$pasajero = $_POST['pasajeros'];

$filas = $consulta->cargarServicio($idServicio);

$conductores = $consultaConductor->cargarConductor($idConductor);
if ($filas > 0) {

  foreach ($filas as $fila) {
    $servicioId = $fila['id'];
    $user_id = $fila['user_id'];
    $driver_id = $fila['driver_id'];
    $car_id = $fila['car_id'];
    $from_lat = $fila['from_lat'];
    $from_lng = $fila['from_lng'];
    $status_id = $fila['status_id'];
    $to_lat = $fila['to_lat'];
    $to_lng = $fila['to_lng'];
    $barrio = $fila['barrio'];
    $obs = $fila['obs'];
    $kind_id = $fila['kind_id'];
    $created_at = $fila['created_at'];
    $destination = $fila['destination'];
    $user_name = $fila['user_name'];
    $address = $fila['address'];
    $pay_type = $fila['pay_type'];
    $pay_reference = $fila['pay_reference'];
    $units = $fila['units'];
    $charge1 = $fila['charge1'];
    $charge2 = $fila['charge2'];
    $charge3 = $fila['charge3'];
    $charge4 = $fila['charge4'];
    $value = $fila['value'];
    $km_recorrido = $fila['km_recorrido'];
    $tiempo_recorido = $fila['tiempo_recorido'];
    $valor_app = $fila['valor_app'];
    $n_pasajeros = $fila['n_pasajeros'];
    $id_carrera_ant = $fila['id_carrera_ant'];
    $valor_total = $fila['valor_total'];
  }

  foreach ($conductores as $conductor) {
    $uuid = $conductor['uuid'];
    $city_id = $conductor['city_id'];
  }

  //SE CAPTURA EL UUID DEL USUARIO
  $uuidUsuario = $consultaUsers->obtenerUuidUsuario($user_id);

  //Se captura la hora de creación
  $timeStart = explode(" ", $created_at);
  $horaInicio = $timeStart[1];

  if ($pay_type == 3) {

    $flecha = $consulta->terminarServicioOtraCiudad($date, $unidades, $charge1, $charge2, $charge3, $charge4, $valor, $idServicio);

    if ($flecha == FALSE) {
      $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo actualizar el servicio'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }else {

      $message = array('message' => 'El servicio ha terminado');
      if (strlen($uuid) > 64){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $keyToken = "$uuid";
        //$Key = 'AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI';
        //$fields = array('to' => $keyToken, 'data' => $mensaje);

        //$fields = array('to' => $keyToken, 'data' => $mensaje);
        $fields = array('data' => $message, 'to' => $keyToken);
        $headers = array('Content-Type: application/json', 'Authorization:key='.$llaveConductor);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);

        curl_close($ch);

        }
        //COMPROBAR SI SE PUDO NOTIFICAR AL CONDUCTOR
        $regreso = json_decode($result);
        $success = $regreso->{"success"};
        $message_id = $regreso->{"results"};
        if ($success == 1) {
          $messageUsuario = array('message' => 'Gracias por utilizar TaxisYa, lo invitamos a calificar nuestro servicio','extra' => array('push_type' => 7, 'service_id' => $servicioId, 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,
          'to_lat' => $to_lat,'to_lng' => $to_lng, 'barrio' => $barrio,'$obs' => $obs,'kind_id' => $kind_id, 'updated_at' => $date,'$created_at' => $created_at,'destination' => $destination,'user_name' => $user_name,'address' => $address,'pay_type' => $pay_type,
          'pay_reference' => $pay_reference,'user_card_reference' => $user_card_reference,'units' => $units,'$charge1' => $charge1,'$charge2' => $charge2,'$charge3' => $charge3,'$charge4' => $charge4,'value' => $value,'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,
          'n_pasajeros' => $n_pasajeros,'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total));
          if (strlen($uuidUsuario) > 64){
            $url = 'https://fcm.googleapis.com/fcm/send';
            $keyToken = "$uuidUsuario";
            //$KeyUsuario = 'AIzaSyA47lBB0XAPgt2yAIfw7YoXOl7m49PP76M';
            //$fields = array('to' => $keyToken, 'data' => $mensaje);

            //$fields = array('to' => $keyToken, 'data' => $mensaje);
            $fields = array('data' => $messageUsuario, 'to' => $keyToken);
            $headers = array('Content-Type: application/json', 'Authorization:key='.$llaveUsuario);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);

            curl_close($ch);
          }

          $regresoUsuario = json_decode($result);
          $successUsuario = $regresoUsuario->{"success"};
          $message_idUsuario = $regresoUsuario->{"results"};

          if ($successUsuario == 1) {
            $res = array('success' => true, 'data' => array('id_service' => $servicioId, 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,'to_lat' => $to_lat,
            'to_lng' => $to_lng, 'barrio' => $barrio,'$obs' => $obs,'kind_id' => $kind_id, 'updated_at' => $date,'$created_at' => $created_at,'destination' => $destination,'user_name' => $user_name,'address' => $address,'pay_type' => $pay_type,'pay_reference' => $pay_reference,
            'user_card_reference' => $user_card_reference,'units' => $units,'$charge1' => $charge1,'$charge2' => $charge2,'$charge3' => $charge3,'$charge4' => $charge4,'value' => $value,'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,'n_pasajeros' => $n_pasajeros,
            'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total));



            header('Content-Type: application/json');
            echo json_encode($res);
          }else {
            $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo notificar al usuario'));
            header('Content-Type: application/json');
            echo json_encode($mensaje);
          }

        }else{
          $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo notificar al conductor'));
          header('Content-Type: application/json');
          echo json_encode($mensaje);
        }
    }
  }else{
      // suma del timepo que duro el recorrido
      $timepoFinal = $consultaParameters->RestarHoras($horaInicio, $hora);

      $row = $consulta->terminarServicioWS($date, $pasajero, $timepoFinal, $idServicio);
      if ($row == FALSE) {
        $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo actualizar el servicio'));
        header('Content-Type: application/json');
        echo json_encode($mensaje);
      }else {

      if (strlen($uuid) > 64){

              $message = array('message' => 'El servicio ha terminado');
              $url = 'https://fcm.googleapis.com/fcm/send';
              $keyToken = "$uuid";
              $Key = 'AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI';
              //$fields = array('to' => $keyToken, 'data' => $mensaje);

              //$fields = array('to' => $keyToken, 'data' => $mensaje);
              $fields = array('data' => $message, 'to' => $keyToken);
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

        }
          //COMPROBAR SI SE PUDO NOTIFICAR AL CONDUCTOR
         $regreso = json_decode($result);
          $success = $regreso->{"success"};
          $message_id = $regreso->{"results"};
         if ($success == 1) {
            if (strlen($uuidUsuario) > 64){
              $messageUsuario = array('message' => 'Gracias por utilizar TaxisYa, lo invitamos a calificar nuestro servicio','extra' => array('push_type' => 7, 'service_id' => $servicioId , 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,
              'to_lat' => $to_lat,'to_lng' => $to_lng, 'barrio' => $barrio,'$obs' => $obs,'kind_id' => $kind_id, 'updated_at' => $date,'$created_at' => $created_at,'destination' => $destination,'user_name' => $user_name,'address' => $address,'pay_type' => $pay_type,
              'pay_reference' => $pay_reference,'user_card_reference' => $user_card_reference,'units' => $units,'$charge1' => $charge1,'$charge2' => $charge2,'$charge3' => $charge3,'$charge4' => $charge4,'value' => $value,'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,
              'n_pasajeros' => $n_pasajeros,'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total));
              $url = 'https://fcm.googleapis.com/fcm/send';
              $keyToken = "$uuidUsuario";
              //$fields = array('to' => $keyToken, 'data' => $mensaje);
              $KeyUsuario = 'AIzaSyA47lBB0XAPgt2yAIfw7YoXOl7m49PP76M';
              //$fields = array('to' => $keyToken, 'data' => $mensaje);
              $fields = array('data' => $messageUsuario, 'to' => $keyToken);
              $headers = array('Content-Type: application/json', "Authorization:key=$KeyUsuario");
              $ch = curl_init($url);
              curl_setopt($ch, CURLOPT_POST, true);
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
              $result = curl_exec($ch);

              curl_close($ch);
            }

            $regresoUsuario = json_decode($result);
            $successUsuario = $regresoUsuario->{"success"};
            $message_idUsuario = $regresoUsuario->{"results"};

           if ($successUsuario == 1) {
              $res = array('success' => true, 'data' => array('id' => $servicioId, 'user_id' => $user_id,'driver_id' => $driver_id,'car_id' => $car_id,'from_lat' => $from_lat,'from_lng' => $from_lng,'status_id' => $status_id,'to_lat' => $to_lat,
              'to_lng' => $to_lng, 'barrio' => $barrio,'$obs' => $obs,'kind_id' => $kind_id, 'updated_at' => $date,'$created_at' => $created_at,'destination' => $destination,'user_name' => $user_name,'address' => $address,'pay_type' => $pay_type,'pay_reference' => $pay_reference,
              'user_card_reference' => $user_card_reference,'units' => $units,'$charge1' => $charge1,'$charge2' => $charge2,'$charge3' => $charge3,'$charge4' => $charge4,'value' => $value,'km_recorrido' => $km_recorrido,'tiempo_recorido' => $tiempo_recorido,'valor_app' => $valor_app,'n_pasajeros' => $n_pasajeros,
              'id_carrera_ant' => $id_carrera_ant,'valor_total' => $valor_total));



              header('Content-Type: application/json');
              echo json_encode($res);
          }else {
            $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo notificar al usuario'));
             header('Content-Type: application/json');
              echo json_encode($mensaje);
            }

         }else{

            $mensaje = array('success' => false, 'data' => array('message' => 'No se pudo notificar al conductor'));
            header('Content-Type: application/json');
            echo json_encode($mensaje);
          }
      }
  }

}else{
  $mensaje = array('success' => false, 'data' => array('message' => 'El id no corresponde a un servicio'));
  header('Content-Type: application/json');
  echo json_encode($mensaje);
}



 ?>
