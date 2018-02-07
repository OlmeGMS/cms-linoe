<?php
require_once('../models/conexion.php');
require_once('../models/parameters.php');
require_once('../models/holidays.php');
ini_set('date.timezone','America/Bogota');

$consulta = new Parameters();
$consultaHoliday = new Holidays();



$lat = $_GET['lat'];
$lng = $_GET['lng'];
$tiempo = $_GET['time'];

$horaNocturnoIncio = "20:00";
$horaNocturnoFin = "6:00";

//VARIABLES PARAMETROS
$km = $consulta->obtenerPrecioKm();
$kmCalidad = $consulta->obtenerPrecioKmCalidad();
$banderazo = $consulta->obtenerPrecioBanderazo();
$banderazoCalidad = $consulta->obtenerPrecioBanderazoCalidad();
$aeropuerto = $consulta->obtenerPrecioAeropuerto();
$aeropuertoCalidad = $consulta->obtenerPrecioAeropuertoCalidad();
$nocturno = $consulta->obtenerPrecioNocturno();
$nocturnoCalidad = $consulta->obtenerPrecioNocturnoCalidad();
$minima = $consulta->obtenerPrecioMinima();
$minimaCalidad = $consulta->obtenerPrecioMinimaCalidad();
$pp = $consulta->obtenerPrecioPP();
$ppCalidad = $consulta->obtenerPrecioPPCalidad();
$cero = "0";

//FECHAS
$horaActual = $consulta->horaAcutal();
$dia = date("N");
$fechaActual = $consulta->fechaAcutal();
$festivo = FALSE;
$nombreFestivo = null;

$sumaHoras = $consulta->CalcularHoraSumada($horaActual,$tiempo);
//$sumaHoras = "22:00";

//AERPUERTO

//$latAeropuerto = 4.6843698;
//$lngAeropuerto = -74.1310506;
$latAeropuerto = 4.6982308;
$lngAeropuerto = -74.1415777;

//FILTRO FESTIVOS
$holiday = $consultaHoliday->verificarFestivo();
if ($holiday == NULL) {
  $festivo = FALSE;
}else{
  $festivo = TRUE;
}

// LOGICA RECARGOS
if ($lat == $latAeropuerto && $lng == $lngAeropuerto) {
  if ($dia == 7) {
    $totalRecargo = $pp + $nocturno + $aeropuerto;
    $totalRecargoCalidad = $ppCalidad + $nocturnoCalidad + $aeropuertoCalidad;
    $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'aeropuerto'=>$aeropuerto,'nocturno'=>$nocturno,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'aeropuerto_calidad'=>$aeropuertoCalidad,
    'nocturno_calidad'=>$nocturnoCalidad);
    header('Content-Type: application/json');
    echo json_encode($recargo);

  }elseif ($festivo == TRUE) {
    $filas = $consultaHoliday->listaHoliday();
    foreach ($filas as $fila) {
      $nombreFestivo = $fila['holiday'];
    }
    $totalRecargo = $pp + $nocturno + $aeropuerto;
    $totalRecargoCalidad = $ppCalidad + $nocturnoCalidad + $aeropuertoCalidad;
    $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'aeropuerto'=>$aeropuerto,'nocturno'=>$nocturno,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'aeropuerto_calidad'=>$aeropuertoCalidad,
    'nocturno_calidad'=>$nocturnoCalidad, 'nombre_festivo'=>$nombreFestivo);
    header('Content-Type: application/json');
    echo json_encode($recargo);

  }else{
    $zonaNocturno = $consulta->hourIsBetween($horaNocturnoIncio, $horaNocturnoFin, $sumaHoras);
    if ($zonaNocturno == TRUE) {
      $totalRecargo = $pp + $nocturno + $aeropuerto;
      $totalRecargoCalidad = $ppCalidad + $nocturnoCalidad + $aeropuertoCalidad;
      $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'aeropuerto'=>$aeropuerto,'nocturno'=>$nocturno,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'aeropuerto_calidad'=>$aeropuertoCalidad,
      'nocturno_calidad'=>$nocturnoCalidad);
      header('Content-Type: application/json');
      echo json_encode($recargo);
    }else{
      $totalRecargo = $pp + $aeropuerto;
      $totalRecargoCalidad = $ppCalidad + $aeropuertoCalidad;
      $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'nocturno'=>$cero,'aeropuerto'=>$aeropuerto,'km_calidad'=>$kmCalidad,'total_recargo_calidad'=>$totalRecargoCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'nocturno_calidad'=>$cero,
      'aeropuerto_calidad'=>$aeropuertoCalidad);
      header('Content-Type: application/json');
      echo json_encode($recargo);
    }


  }

}else {
        if ($dia == 7) {
          $totalRecargo = $pp + $nocturno;
          $totalRecargoCalidad = $ppCalidad + $nocturnoCalidad;

          $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'nocturno'=>$nocturno,'aeropuerto'=>$cero,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'nocturno_calidad'=>$nocturnoCalidad,
          'aeropuerto_calidad'=>$cero);
          header('Content-Type: application/json');
          echo json_encode($recargo);

        }elseif ($festivo == TRUE) {
          $filas = $consultaHoliday->listaHoliday();
          foreach ($filas as $fila) {
            $nombreFestivo = $fila['holiday'];
          }
          $totalRecargo = $pp + $nocturno;
          $totalRecargoCalidad = $ppCalidad + $nocturnoCalidad;
          $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'nocturno'=>$nocturno,'aeropuerto'=>$cero,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'nocturno_calidad'=>$nocturnoCalidad,
          'nombre_festivo'=>$nombreFestivo, 'aeropuerto_calidad'=>$cero);
          header('Content-Type: application/json');
          echo json_encode($recargo);

        }else{
          $zonaNocturno = $consulta->hourIsBetween($horaNocturnoIncio, $horaNocturnoFin, $sumaHoras);
          if ($zonaNocturno == TRUE) {
            $totalRecargo = $pp + $nocturno;
            $totalRecargoCalidad = $ppCalidad + $nocturnoCalidad;
            //$recargo = array('totalRecargo'=>$totalRecargo,'km'=>$km,'Puerta a puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'Nocturno'=>$nocturno,'totalRecargoCalidad'=>$totalRecargoCalidad,'kmCalidad'=>$kmCalidad,'Puerta a puertaCalidad'=>$ppCalidad,'banderazoCalidad'=>$banderazoCalidad,'minimaCalidad'=>$minimaCalidad,'NocturnoCalidad'=>$nocturnoCalidad);
            $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'nocturno'=>$nocturno,'aeropuerto'=>$cero,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad,'nocturno_calidad'=>$nocturnoCalidad,
            'aeropuerto_calidad'=>$cero);
            header('Content-Type: application/json');
            echo json_encode($recargo);
          }else{
            $totalRecargo = $pp;
            $totalRecargoCalidad = $ppCalidad;
            $recargo = array('total_recargo'=>$totalRecargo,'km'=>$km,'puerta_a_puerta'=>$pp,'banderazo'=>$banderazo,'minima'=>$minima,'nocturno'=>$cero,'aeropuerto'=>$cero,'total_recargo_calidad'=>$totalRecargoCalidad,'km_calidad'=>$kmCalidad,'puerta_a_puerta_calidad'=>$ppCalidad,'banderazo_calidad'=>$banderazoCalidad,'minima_calidad'=>$minimaCalidad, 'nocturno_calidad'=>$cero,
            'aeropuerto_calidad'=>$cero);
            header('Content-Type: application/json');
            echo json_encode($recargo);
          }
      }

}




 ?>
