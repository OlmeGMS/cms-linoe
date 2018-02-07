<?php
require_once('../models/conexion.php');
require_once('../models/parameters.php');
require_once('../models/services.php');
require_once('../models/users.php');
require_once('../models/drivers.php');
require_once('../models/usersDirs.php');
require_once('../models/ticketTickets.php');
ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaUsers = new Users();
$consultaUserDir = new UsersDirs();
$consultaParameters = new Parameters();
$consultaTickets = new TicketTickets();
$consultaConductor = new Drivers();

//CAPTURA
$usuario = $_POST['usuario'];
$lati = $_POST['latitude'];
$longi = $_POST['longitude'];
$to_lati = $_POST['to_lati'];
$to_lng = $_POST['to_lng'];
$dir = $_POST['index'];
$nombreDIr = $_POST['comp1'];
$nDos = $_POST['comp2'];
$numm = $_POST['no'];
$observaciones = $_POST['obs'];
$barrio = $_POST['barrio'];
$kind_id = 1;
$aeropuerto = $_POST['aeropuerto'];
$nocturno = $_POST['nocturno'];
$mensajeria = $_POST['mensajeria'];
$pp = $_POST['pp'];
//$tipoServicio = $_POST['tipo_servicio'];
$pay_type = $_POST['pay_type'];
$destino = $_POST['destino'];
$kmRecorrio = $_POST['km_recorrido'];
$tiempoRecorrido = $_POST['tiempo_recorido'];
$valorApp = $_POST['valor_app'];
$address = $_POST['address'];

//VALES
$nvale = strtoupper($_POST['nVale']);
$motivoVale = $_POST['motivoVale'];



$nombre = strtoupper($consultaUsers->obtenerNombre($usuario));
$apellido = strtoupper($consultaUsers->obtenerApellido($usuario));
$tel = $consultaUsers->obtenerTelefono($usuario);
$cel = $consultaUsers->obtenerCelular($usuario);

$nombreCompleto = "$nombre $apellido";
//$direccion = "$dir $nombreDIr #$nDos-$numm, $barrio";
$direccion = "$address, $barrio";
//$usuarioSistema = $_POST['id_usuariosis'];
$usuarioSistema = 42;

if($tel != null){
  $cuenta = strlen($tel);

    if ($cuenta == '7') {
      $t = $tel;
      $c = null;
      $flecha = chunk_split($tel, 3, " ");
      $flecha1 = substr($tel, 0, 2);
      $flecha2 = substr($tel, 3, 2);
      $flecha3 = substr($tel, 5, 3);
      $code = $flecha3;

    }elseif ($cuenta == '10') {
      $t = null;
      $c = $tel;
      $flecha = chunk_split($tel, 3, " ");
      $flecha1 = substr($tel, 0, 3);
      $flecha2 = substr($tel, 3, 2);
      $flecha3 = substr($tel, 5, 3);
      $flecha4 = substr($tel, 8, 2);
      $code = $flecha4;
    }
}else {
    $cuenta = strlen($cel);

    if ($cuenta == '7') {
      $t = $cel;
      $flecha = chunk_split($cel, 3, " ");
      $flecha1 = substr($cel, 0, 2);
      $flecha2 = substr($cel, 3, 2);
      $flecha3 = substr($cel, 5, 3);
      $code = $flecha3;

    }elseif ($cuenta == '10') {
      $t = null;
      $flecha = chunk_split($cel, 3, " ");
      $flecha1 = substr($cel, 0, 3);
      $flecha2 = substr($cel, 3, 2);
      $flecha3 = substr($cel, 5, 3);
      $flecha4 = substr($cel, 8, 2);
      $code = $flecha4;
    }
}
if ($pay_type == 3) {
  $pay_reference = "VALE";
  $estadoVale = $consultaTickets->obtenerEstadoVale($nvale);
  $companiaId = $consultaTickets->obtenerCompanyId($nvale);
  if ($estadoVale != NULL) {
    if ($estadoVale == 1) {
      $mensaje = array('success' => false, 'data' => array('message' => 'El vale esta utilizado'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }elseif ($estadoVale == 2) {
      $mensaje = array('success' => false, 'data' => array('message' => 'El vale esta solicitado'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }elseif ($estadoVale == 3) {
      $mensaje = array('success' => false, 'data' => array('message' => 'El vale esta vencido'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }elseif ($estadoVale == 4) {
      $mensaje = array('success' => false, 'data' => array('message' => 'El vale fue despachado por central'));
      header('Content-Type: application/json');
      echo json_encode($mensaje);
    }else {
      $flecha = $consulta->crearServicioValeWS($usuario, $lati, $longi, $to_lati, $to_lng, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $kind_id, $destino, $nombreCompleto, $direccion, $usuarioSistema, $pay_type, $pay_reference, $nvale , $aeropuerto, $nocturno, $mensajeria,
      $pp, $code, $companiaId, $motivoVale, $kmRecorrio,$tiempoRecorrido,$valorApp);
      if ($flecha == FALSE) {
        $mensaje = array('success' => false, 'data' => array('message' => 'No se puedo crear el servicio'));
        header('Content-Type: application/json');
        echo json_encode($mensaje);
      }else {
        $query = $consultaTickets->cambiarEstadoVale($nvale);
        if ($query == FALSE) {
          $mensaje = array('success' => false, 'data' => array('message' => 'No se puedo actualizar el vale'));
          header('Content-Type: application/json');
          echo json_encode($mensaje);
        }else {
          $idUltimoServicio = $consulta->obtenerUltimoIdServicio();
          $mensaje = $consulta->obtenerServicioXId($idUltimoServicio);

          foreach ($mensaje as $msn) {
            $idServicioArray = $msn['id'];
            $driver_idArray = $msn['driver_id'];
            $car_idArray = $msn['car_id'];
            $from_latArray = $msn['from_lat'];
            $from_lngArray = $msn['from_lng'];
            $status_idArray = $msn['status_id'];
            $to_latArray = $msn['to_lat'];
            $to_lngArray = $msn['to_lng'];
            $barrioArray = $msn['barrio'];
            $obsArray = $msn['obs'];
            $kind_idArray = $msn['kind_id'];
            $created_atArray = $msn['created_at'];
            $user_nameArray = $msn['user_name'];
            $addressArray = $msn['address'];
            $pay_typeArray = $msn['pay_type'];
            $pay_referenceArray = $msn['pay_reference'];
            $user_card_referenceArray = $msn['user_card_reference'];
            $commitArray = $msn['commit'];
            $unitsArray = $msn['units'];
            $charge1Array = $msn['charge1'];
            $charge2Array = $msn['charge2'];
            $charge3Array = $msn['charge3'];
            $charge4Array = $msn['charge4'];
            $codeArray = $msn['code'];
            $km_recorridoArray = $msn['km_recorrido'];
            $tiempo_recoridoArray = $msn['tiempo_recorido'];
            $valor_appArray =$msn['valor_app'];

          }

          $codigos = $consultaConductor->obtenerTodoUuidTaxisyas();
              // Set POST variables
          foreach ($codigos as $condigo) {
            $uuid = $codigo['uuid'];
            $url = 'https://android.googleapis.com/gcm/send';
            $message = array('message' => 'Se ha generado un nuevo servicio', 'vibrate'	=> 1,'sound' => 1,);
            $key = 'AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI';

            $fields = array(
                            'registration_ids'  => array($uuid),
                            'data'              => array( "message" => $message ),
                            );

            $headers = array(
                                'Authorization: key='.$key,
                                'Content-Type: application/json'
                            );

            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt( $ch, CURLOPT_URL, $url );

            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

            // Execute post
            $result = curl_exec($ch);

            // Close connection
            curl_close($ch);
          }

          $respuesta = array('success' => true, 'data' => array('id_servicio' => $idServicioArray, 'id_conductor' => $driver_idArray, 'id_vehiculo' => $car_idArray, 'latitude_orig' => $from_latArray, 'longitude_orig' => $from_lngArray, 'estado' => $status_idArray, 'latitude_des' => $to_latArray,
          'longitude_des' => $to_lngArray,'barrio' => $barrioArray, 'obs' => $obsArray, 'kind_id' => $kind_idArray, 'fecha' => $created_atArray, 'nombre_usuario' => $user_nameArray, 'direccion' => $addressArray, 'id_tipo_pago' => $pay_typeArray, 'tipo_pago' => $pay_referenceArray, 'vale' => $user_card_referenceArray,
          'motivo' => $commitArray,'unidades' => $unitsArray, 'aeropuerto' => $charge1Array, 'nocturno' => $charge2Array, 'mensajeria' => $charge3Array, 'pp' => $charge4Array, 'codigo' => $codeArray, 'km_recorrido' => $km_recorridoArray, 'tiempo' => $tiempo_recoridoArra, 'valor' => $valor_appArray));


          header('Content-Type: application/json');
          echo json_encode($respuesta);
        }

      }
    }
  }else {
    $mensaje = array('success' => false, 'data' => array('message' => 'El vale no existe'));
    header('Content-Type: application/json');
    echo json_encode($mensaje);
  }




}else {
  $pay_reference = "EFECTIVO";
  $companiaId = 0;

  $flecha = $consulta->crearServicioEfectivoWS($usuario, $lati, $longi, $to_lati, $to_lng, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $kind_id, $destino, $nombreCompleto, $direccion, $usuarioSistema, $pay_type, $pay_reference, $aeropuerto, $nocturno, $mensajeria,
  $pp,$code, $companiaId, $kmRecorrio,$tiempoRecorrido,$valorApp);

  if ($flecha == FALSE) {
    $mensaje = array('success' => false, 'data' => array('message' => 'No se puedo crear el servicio'));
    header('Content-Type: application/json');
    echo json_encode($mensaje);
  }else {
    $idUltimoServicio = $consulta->obtenerUltimoIdServicio();
    $mensaje = $consulta->obtenerServicioXId($idUltimoServicio);

    foreach ($mensaje as $msn) {
      $idServicioArray = $msn['id'];
      $driver_idArray = $msn['driver_id'];
      $car_idArray = $msn['car_id'];
      $from_latArray = $msn['from_lat'];
      $from_lngArray = $msn['from_lng'];
      $status_idArray = $msn['status_id'];
      $to_latArray = $msn['to_lat'];
      $to_lngArray = $msn['to_lng'];
      $barrioArray = $msn['barrio'];
      $obsArray = $msn['obs'];
      $kind_idArray = $msn['kind_id'];
      $created_atArray = $msn['created_at'];
      $user_nameArray = $msn['user_name'];
      $addressArray = $msn['address'];
      $pay_typeArray = $msn['pay_type'];
      $pay_referenceArray = $msn['pay_reference'];
      $user_card_referenceArray = $msn['user_card_reference'];
      $commitArray = $msn['commit'];
      $unitsArray = $msn['units'];
      $charge1Array = $msn['charge1'];
      $charge2Array = $msn['charge2'];
      $charge3Array = $msn['charge3'];
      $charge4Array = $msn['charge4'];
      $codeArray = $msn['code'];
      $km_recorridoArray = $msn['km_recorrido'];
      $tiempo_recoridoArray = $msn['tiempo_recorido'];
      $valor_appArray =$msn['valor_app'];

    }
$codigos = $consultaConductor->obtenerTodoUuidTaxisyas();

$mensaje = array('extra' => array('service' => array('message' => 'Se ha generado un nuevo servicio', 'id_servicio' => $idServicioArray, 'id_conductor' => $driver_idArray, 'id_vehiculo' => $car_idArray, 'lat' => $from_latArray, 'lng' => $from_lngArray, 'estado' => $status_idArray,
'latitude_des' => $to_latArray,'longitude_des' => $to_lngArray,'barrio' => $barrioArray, 'obs' => $obsArray, 'kind_id' => $kind_idArray, 'fecha' => $created_atArray, 'nombre_usuario' => $user_nameArray, 'direccion' => $addressArray, 'id_tipo_pago' => $pay_typeArray, 'tipo_pago' => $pay_referenceArray,
'vale' => $user_card_referenceArray,'motivo' => $commitArray,'unidades' => $unitsArray, 'aeropuerto' => $charge1Array, 'nocturno' => $charge2Array, 'mensajeria' => $charge3Array, 'pp' => $charge4Array, 'codigo' => $codeArray, 'km_recorrido' => $km_recorridoArray, 'tiempo' => $tiempo_recoridoArray,
'valor' => $valor_appArray),'push_type' => 1, 'user_name' => 'olme'));
    // Set POST variables
foreach ($codigos as $codigo) {
  $uuid = $codigo['uuid'];

  //$uuid = "cLFTMt-KxYk:APA91bFjL8Axs3QpZbc7jcIVhzM1_92RYTtFuUywr0QgF_TkaR1Upt8vdXg-KAcVnNS_xJl5ia_ZzCsdNsWIbtOi7cUHifMiD_m7q8e1lli10otlfYU46lw79m57iqpS7MDyWwZE6jaL";
  if (strlen($uuid) > 64){

            $url = 'https://fcm.googleapis.com/fcm/send';
            $keyToken = "$uuid";
            $Key = 'AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI';
            //$fields = array('to' => $keyToken, 'data' => $mensaje);

            //$fields = array('to' => $keyToken, 'data' => $mensaje);
            $fields = array('data' => $mensaje, 'to' => $keyToken);
            $headers = array('Content-Type: application/json', 'Authorization:key=AIzaSyCINYqzLIfJbasINqeS4qAlgrcq0Np3iLI');
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

}


    $respuesta = array('success' => true, 'data' => array('id_servicio' => $idServicioArray, 'id_conductor' => $driver_idArray, 'id_vehiculo' => $car_idArray, 'lat' => $from_latArray, 'lng' => $from_lngArray, 'estado' => $status_idArray, 'latitude_des' => $to_latArray,
    'longitude_des' => $to_lngArray,'barrio' => $barrioArray, 'obs' => $obsArray, 'kind_id' => $kind_idArray, 'fecha' => $created_atArray, 'nombre_usuario' => $user_nameArray, 'direccion' => $addressArray, 'id_tipo_pago' => $pay_typeArray, 'tipo_pago' => $pay_referenceArray, 'vale' => $user_card_referenceArray,
    'motivo' => $commitArray,'unidades' => $unitsArray, 'aeropuerto' => $charge1Array, 'nocturno' => $charge2Array, 'mensajeria' => $charge3Array, 'pp' => $charge4Array, 'codigo' => $codeArray, 'km_recorrido' => $km_recorridoArray, 'tiempo' => $tiempo_recoridoArray, 'valor' => $valor_appArray));

    header('Content-Type: application/json');
    echo json_encode($respuesta);
  }


}
















 ?>
