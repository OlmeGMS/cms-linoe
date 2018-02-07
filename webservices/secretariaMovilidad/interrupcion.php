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

//VARIABLES RECIBIDAS
$idServicioCms = $_POST['id'];
$motivoInterrupcion = $_POST['motivo'];
$to_lat = $_POST['to_lat'];
$to_lng = $_POST['to_lng'];
$valorCalculado = $_POST['valor_app'];
$tiempoCalculado = $_POST['tiempo_recorido'];
$distanciaCalculada = $_POST['km_recorrido'];
$n_pasajeros = $_POST['n_pasajeros'];


$anio = date('y');
$filas = $consutlaServiciosCms->cargarServicio($idServicioCms);

//RECORRIDO
foreach($filas as $fila){
  $idServices = $fila['id'];
  $calificacion = $fila['qualification'];
  $idCarro = $fila['car_id'];
  $idCarrera = "0000-$anio-$idServices";
  $from_lat = $fila['from_lat'];
  $from_lng = $fila['from_lng'];
  $placa = $consultaCars->obtenerPlacas($idCarro);
  $numeroTc = $consultaDrivers->obtenerNumeroTc($fila['driver_id']);
  $factorCalidad = $consultaCars->obtenerFactorVehiculo($idCarro);
  $sumaHoras = $consultaParametros->CalcularHoraSumada($hora,$tiempoCalculado);
  $tipoSolicitud = $fila['kind_id'];

}

//ENVIO DEL SERVICIO
$url = "http://localhost/pruebasScre/login.php";
$ch = curl_init($url);
$data = array('calificacion' => $calificacion, 'distanciaViaje' => $distanciaCalculada, 'idCarrera' => $idCarrera, 'motivoInterrupcion' => $motivoInterrupcion, 'posicionDestino' => array('latitud' => $to_lat, 'longitud' => $to_lng),
              'posicionOrigen' => array('latitud' => $from_lat, 'longitud' => $from_lng), 'timepoViaje' => $tiempoCalculado, 'valorPagado' => $valorCalculado, 'numeroPasajero' => $n_pasajeros);

$payload = json_encode($data);
$data_string = http_build_query(array('data' => json_encode($data)));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Autorization: '.$token));
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);

$respuesta = json_decode($response);

if ($idCarrera == $idCarreraSecretaria) {
  $res = array('Status' => '200');
  header('Content-Type: application/json');
  echo json_encode($res);

}else {
  $res = array('Error' => '100');
  header('Content-Type: application/json');
  echo json_encode($res);
}

?>
