<?php
require_once('../../models/conexion.php');
require_once('../../models/secretaryServices.php');
require_once('../../models/services.php');
require_once('../../models/route.php');
require_once('../../models/parameters.php');
require_once('../../models/cars.php');
require_once('../../models/drivers.php');
require_once('../../models/holidays.php');
require_once('../../models/secretaryLogin.php');
require_once('../../models/secretaryServices.php');

ini_set('date.timezone','America/Bogota');

$consulta = new SecretaryServices();
$consutlaServiciosCms = new Services();
$consultaRuta = new Route();
$consultaParametros = new Parameters();
$consultaCars = new Cars();
$consultaDrivers = new Drivers();
$consultaHoliday = new Holidays();
$consultaSecretaryLogin = new SecretaryLogin();
$consultaSecretaryServices = new SecretaryServices();


//AERPUERTO

$latAeropuerto = 4.6843698;
$lngAeropuerto = -74.1310506;

//VARIABLES PARAMETROS
$km = $consultaParametros->obtenerPrecioKm();
$kmCalidad = $consultaParametros->obtenerPrecioKmCalidad();
$banderazo = $consultaParametros->obtenerPrecioBanderazo();
$banderazoCalidad = $consultaParametros->obtenerPrecioBanderazoCalidad();
$aeropuerto = $consultaParametros->obtenerPrecioAeropuerto();
$aeropuertoCalidad = $consultaParametros->obtenerPrecioAeropuertoCalidad();
$nocturno = $consultaParametros->obtenerPrecioNocturno();
$nocturnoCalidad = $consultaParametros->obtenerPrecioNocturnoCalidad();
$minima = $consultaParametros->obtenerPrecioMinima();
$minimaCalidad = $consultaParametros->obtenerPrecioMinimaCalidad();
$pp = $consultaParametros->obtenerPrecioPP();
$ppCalidad = $consultaParametros->obtenerPrecioPPCalidad();
$token = $consultaSecretaryLogin->obtenerToken();

$hora = $consultaParametros->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";
$festivo = FALSE;
$nombreFestivo = null;
$dia = date("N");
$horaNocturnoIncio = "20:00";
$horaNocturnoFin = "6:00";
$idServicioCms = $_GET['id'];

$filas = $consutlaServiciosCms->cargarServicio($idServicioCms);
$puntosRecorrido = $consultaRuta->obtnerRuta($idServicioCms);
$anio = date('y');

$solPlataforma = FALSE;

foreach ($puntosRecorrido as $point) {
  $ruta[] = array('latitud' => $point['lat'], 'longitud' => $point['lng']);
}

//RECORRER EL SERVICIO
foreach ($filas as $fila) {
  $idServices = $fila['id'];
  $idCarro = $fila['car_id'];
  $idCarrera = "0000-$anio-$idServices";
  $from_lat = $fila['from_lat'];
  $from_lng = $fila['from_lng'];
  $to_lat = $fila['to_lat'];
  $to_lng = $fila['to_lng'];
  $placa = $consultaCars->obtenerPlacas($idCarro);
  $valorCalculado = $fila['valor_app'];
  $tiempoCalculado = $fila['tiempo_recorido'];
  $distanciaCalculada = $fila['km_recorrido'];
  $numeroTc = $consultaDrivers->obtenerNumeroTc($fila['driver_id']);
  $factorCalidad = $consultaCars->obtenerFactorVehiculo($idCarro);
  $sumaHoras = $consultaParametros->CalcularHoraSumada($hora,$tiempoCalculado);
  $tipoSolicitud = $fila['kind_id'];
}

//FILTRO FESTIVOS
$holiday = $consultaHoliday->verificarFestivo();
if ($holiday == NULL) {
  $festivo = FALSE;
}else{
  $festivo = TRUE;
}

//LOGICA RECARGOS
if ($latAeropuerto == $to_lat &&  $lngAeropuerto == $to_lng || $from_lat == $latAeropuerto &&  $from_lng == $lngAeropuerto) {

    if ($dia == 7) {
      $recargoAeropuerto = TRUE;
      $recargoPP = TRUE;
      $recargoNocturno = TRUE;
      if($tipoSolicitud == 1){
        $solPlataforma = TRUE;
      }else{
        $solPlataforma = FALSE;
      }

      $url = "http://localhost/pruebasScre/login.php";
      $ch = curl_init($url);
      $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                          'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                          'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
      $payload = json_encode($data);
      $data_string = http_build_query(array('data' => json_encode($data)));
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Autorization: '.$token));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response  = curl_exec($ch);
      curl_close($ch);

      $respuesta = json_decode($response);

      $idCarreraSecretaria = $respuesta->{"idCarrera"};
      $codigoQr = $respuesta->{"qrValidacion"};

      $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
      if ($mensaje == FALSE) {
        $res = array('Error' => 'No se puedo agregar el codigo');
        header('Content-Type: application/json');
        echo json_encode($res);
      }else{
        $res = array('Status' => '200');
        header('Content-Type: application/json');
        echo json_encode($res);
      }


    }elseif ($festivo == TRUE) {
      $recargoAeropuerto = TRUE;
      $recargoPP = TRUE;
      $recargoNocturno = TRUE;
      if($tipoSolicitud == 1){
        $solPlataforma = TRUE;
      }else{
        $solPlataforma = FALSE;
      }

      $url = "http://localhost/pruebasScre/login.php";
      $ch = curl_init($url);
      $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                          'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                          'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
      $payload = json_encode($data);
      $data_string = http_build_query(array('data' => json_encode($data)));
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response  = curl_exec($ch);
      curl_close($ch);

      $respuesta = json_decode($response);

      $idCarreraSecretaria = $respuesta->{"idCarrera"};
      $codigoQr = $respuesta->{"qrValidacion"};

      $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
      if ($mensaje == FALSE) {
        $res = array('Error' => 'No se puedo agregar el codigo');
        header('Content-Type: application/json');
        echo json_encode($res);
      }else{
        $res = array('Status' => '200');
        header('Content-Type: application/json');
        echo json_encode($res);
      }
    }else {
      $zonaNocturno = $consultaParametros->hourIsBetween($horaNocturnoIncio, $horaNocturnoFin, $sumaHoras);
      if ($zonaNocturno == TRUE) {
            $recargoAeropuerto = TRUE;
            $recargoPP = TRUE;
            $recargoNocturno = TRUE;
            if($tipoSolicitud == 1){
              $solPlataforma = TRUE;
            }else{
              $solPlataforma = FALSE;
            }

            $url = "http://localhost/pruebasScre/login.php";
            $ch = curl_init($url);
            $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                                'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                                'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
            $payload = json_encode($data);
            $data_string = http_build_query(array('data' => json_encode($data)));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);

            $respuesta = json_decode($response);

            $idCarreraSecretaria = $respuesta->{"idCarrera"};
            $codigoQr = $respuesta->{"qrValidacion"};

            $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
            if ($mensaje == FALSE) {
              $res = array('Error' => 'No se puedo agregar el codigo');
              header('Content-Type: application/json');
              echo json_encode($res);
            }else{
              $res = array('Status' => '200');
              header('Content-Type: application/json');
              echo json_encode($res);
            }
      }else{
            $recargoAeropuerto = TRUE;
            $recargoPP = TRUE;
            $recargoNocturno = FALSE;
            if($tipoSolicitud == 1){
              $solPlataforma = TRUE;
            }else{
              $solPlataforma = FALSE;
            }

            $url = "http://localhost/pruebasScre/login.php";
            $ch = curl_init($url);
            $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                                'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                                'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
            $payload = json_encode($data);
            $data_string = http_build_query(array('data' => json_encode($data)));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);

            $respuesta = json_decode($response);

            $idCarreraSecretaria = $respuesta->{"idCarrera"};
            $codigoQr = $respuesta->{"qrValidacion"};

            $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
            if ($mensaje == FALSE) {
              $res = array('Status' => 'No se puedo agregar el codigo');
              header('Content-Type: application/json');
              echo json_encode($res);
            }else{
              $res = array('Status' => '200');
              header('Content-Type: application/json');
              echo json_encode($res);
            }
          }
      }


}else {

  if ($dia == 7) {
    $recargoAeropuerto = FALSE;
    $recargoPP = TRUE;
    $recargoNocturno = TRUE;
    if($tipoSolicitud == 1){
      $solPlataforma = TRUE;
    }else{
      $solPlataforma = FALSE;
    }

    $url = "http://localhost/pruebasScre/login.php";
    $ch = curl_init($url);
    $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                        'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                        'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
    $payload = json_encode($data);
    $data_string = http_build_query(array('data' => json_encode($data)));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    curl_close($ch);

    $respuesta = json_decode($response);

    $idCarreraSecretaria = $respuesta->{"idCarrera"};
    $codigoQr = $respuesta->{"qrValidacion"};

    $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
    if ($mensaje == FALSE) {
      $res = array('Error' => 'No se puedo agregar el codigo');
      header('Content-Type: application/json');
      echo json_encode($res);
    }else{
      $res = array('Status' => '200');
      header('Content-Type: application/json');
      echo json_encode($res);
    }


  }elseif ($festivo == TRUE) {
    $recargoAeropuerto = FALSE;
    $recargoPP = TRUE;
    $recargoNocturno = TRUE;
    if($tipoSolicitud == 1){
      $solPlataforma = TRUE;
    }else{
      $solPlataforma = FALSE;
    }

    $url = "http://localhost/pruebasScre/login.php";
    $ch = curl_init($url);
    $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                        'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                        'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
    $payload = json_encode($data);
    $data_string = http_build_query(array('data' => json_encode($data)));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    curl_close($ch);

    $respuesta = json_decode($response);

    $idCarreraSecretaria = $respuesta->{"idCarrera"};
    $codigoQr = $respuesta->{"qrValidacion"};

    $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
    if ($mensaje == FALSE) {
      $res = array('Error' => 'No se puedo agregar el codigo');
      header('Content-Type: application/json');
      echo json_encode($res);
    }else{
      $res = array('Status' => '200');
      header('Content-Type: application/json');
      echo json_encode($res);
    }
  }else {
    $zonaNocturno = $consultaParametros->hourIsBetween($horaNocturnoIncio, $horaNocturnoFin, $sumaHoras);
    if ($zonaNocturno == TRUE) {
          $recargoAeropuerto = FALSE;
          $recargoPP = TRUE;
          $recargoNocturno = TRUE;
          if($tipoSolicitud == 1){
            $solPlataforma = TRUE;
          }else{
            $solPlataforma = FALSE;
          }

          $url = "http://localhost/pruebasScre/login.php";
          $ch = curl_init($url);
          $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                              'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                              'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
          $payload = json_encode($data);
          $data_string = http_build_query(array('data' => json_encode($data)));
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response  = curl_exec($ch);
          curl_close($ch);

          $respuesta = json_decode($response);

          $idCarreraSecretaria = $respuesta->{"idCarrera"};
          $codigoQr = $respuesta->{"qrValidacion"};

          $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
          if ($mensaje == FALSE) {
            $res = array('Error' => 'No se puedo agregar el codigo');
            header('Content-Type: application/json');
            echo json_encode($res);
          }else{
            $res = array('Status' => '200');
            header('Content-Type: application/json');
            echo json_encode($res);
          }
    }else{
          $recargoAeropuerto = FALSE;
          $recargoPP = TRUE;
          $recargoNocturno = FALSE;
          if($tipoSolicitud == 1){
            $solPlataforma = TRUE;
          }else{
            $solPlataforma = FALSE;
          }

          $url = "http://localhost/pruebasScre/login.php";
          $ch = curl_init($url);
          $data = array('distanciaCalculada' => $distanciaCalculada, 'factorCalidad' => $factorCalidad, 'fechaHora' => $date, 'idCarrera' => $idCarrera, 'idCarreraPrevia' => '', 'numeroTC' => $numeroTc, 'placa' => $placa,
                              'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng), 'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'recAeropueto' => $recargoAeropuerto, 'recNoturno' => $recargoNocturno,
                              'recPuerta' => $recargoPP, 'recorrido' => $ruta, 'solPlataforma' => $solPlataforma, 'tiempoCalculado' => $tiempoCalculado, 'valorCalculado' => $valorCalculado);
          $payload = json_encode($data);
          $data_string = http_build_query(array('data' => json_encode($data)));
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json Autorization: '.$token));
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response  = curl_exec($ch);
          curl_close($ch);

          $respuesta = json_decode($response);

          $idCarreraSecretaria = $respuesta->{"idCarrera"};
          $codigoQr = $respuesta->{"qrValidacion"};

          $mensaje = $consultaSecretaryServices->agregarCalculoCarreraSecretaria($idServicioCms, $codigoQr);
          if ($mensaje == FALSE) {
            $res = array('Status' => 'No se puedo agregar el codigo');
            header('Content-Type: application/json');
            echo json_encode($res);
          }else{
            $res = array('Status' => '200');
            header('Content-Type: application/json');
            echo json_encode($res);
          }
        }
    }

}





 ?>
