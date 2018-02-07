<?php
require_once('../models/conexion.php');
require_once('../models/parameters.php');
require_once('../models/services.php');
require_once('../models/secretaryLogin.php');
require_once('../models/cars.php');
require_once('../models/secretaryCars.php');
ini_set('date.timezone','America/Bogota');

$consutlaServiciosCms = new Services();
$consultaParametros = new Parameters();
$consultaSecretaryLogin = new SecretaryLogin();
$consultaSecretaryCars = new SecretaryCars();
$consultaVehiculo = new Cars();

$fecha = date('Y-m-d');
$anio = date('y');

$placa = strtoupper($_POST['placa']);
//$placa = "SWS652";
$date = $_POST['fechaHora'];


$hora = $consultaParametros->horaAcutal();
$fecha = date('Y-m-d');
$time = "$fecha $hora";
$idCarro = $consultaVehiculo->obtenerIdVehiculo($placa);


if (strlen($placa)) {
    if ($date == "" || $date == NULL) {
      $fecha = $time;
      if($idCarro == NULL){

        $res = array('resultado' => 3, 'mensaje' => 'N/E 100','descripcion' => 'El vehiculo no esta registrado en el sistema');
        header('Content-Type: application/json');
        echo json_encode($res);
      }else {

        $filas = $consultaSecretaryCars->buscarUbicacionXfecha($idCarro, $fecha);
        $bucle = $consultaSecretaryCars->buscarUbicacionXfechaPosiciones($idCarro, $fecha);

        if ($filas > 0) {

            foreach ($filas as $fila) {
              $numeroTc = $fila['numero_tc'];
              $lat = $fila['lat'];
              $lng = $fila['lng'];
              $fechaHora = $fila['fecha'];
              $estado = $fila['estado'];
              $idServicio = $fila['idCarrera'];
            }

            if ($bucle > 0) {
              //SE CAPTURA LA SEGUNDA UBICACION
              $lat_dos = $bucle [1][3];
              $lng_dos = $bucle [1][4];

              if ($idServicio == NULL) {
                $idCarrera = "NULL";
              }else {
                $idCarrera = "0000-$anio-$idServicio";
              }

              $res = array('resultado' => 1, 'mensaje' => 'OK','numeroTC' => "$numeroTcdescripcion", 'posicion1' => array('lat' => $lat, 'lng' => $lng),
              'posicion2' => array('lat' => $lat_dos, 'lng' => $lng_dos), 'fechaHora' => "$fechaHora", 'estado' => "$estado", 'idCarrera' =>  $idCarrera, 'descripcion' => 'No tiene más ubicaciones');
              header('Content-Type: application/json');
              echo json_encode($res);
            }else {
              $res = array('resultado' => 3, 'mensaje' => 'N/E - 100','descripcion' => 'No tiene más ubicaciones');
              header('Content-Type: application/json');
              echo json_encode($res);
            }
        }else {
          $res = array('resultado' => 2, 'mensaje' => 'N/D - 100','descripcion' => 'El vehiculo no ha utilizado la plataforma en las últimas 24 horas');
          header('Content-Type: application/json');
          echo json_encode($res);
        }
      }

    }else{

      $fecha = $date;

      if($idCarro == NULL){

        $res = array('resultado' => 3, 'mensaje' => 'N/E - 100','descripcion' => 'El vehiculo no esta registrado en el sistema');
        header('Content-Type: application/json');
        echo json_encode($res);
      }else {

        $filas = $consultaSecretaryCars->buscarUbicacionXfecha($idCarro, $fecha);
        $bucle = $consultaSecretaryCars->buscarUbicacionXfechaPosiciones($idCarro, $fecha);

        if ($filas > 0) {
            foreach ($filas as $fila) {
              $numeroTc = $fila['numero_tc'];
              $lat = $fila['lat'];
              $lng = $fila['lng'];
              $fechaHora = $fila['fecha'];
              $estado = $fila['estado'];
              $idServicio = $fila['idCarrera'];
            }

          if ($bucle > 0) {
            //SE CAPTURA LA SEGUNDA UBICACION
            $lat_dos = $bucle [1][3];
            $lng_dos = $bucle [1][4];

            if ($idServicio == NULL) {
              $idCarrera = "NULL";
            }else {
              $idCarrera = "0000-$anio-$idServicio";
            }

            $res = array('resultado' => 1, 'mensaje' => 'OK','numeroTC' => "$numeroTcdescripcion", 'posicion1' => array('lat' => $lat, 'lng' => $lng),
            'posicion2' => array('lat' => $lat_dos, 'lng' => $lng_dos), 'fechaHora' => "$fechaHora", 'estado' => "$estado", 'idCarrera' =>  $idCarrera, 'descripcion' => 'No tiene más ubicaciones');
            header('Content-Type: application/json');
            echo json_encode($res);
          }else {
            $res = array('resultado' => 3, 'mensaje' => 'N/E - 100','descripcion' => 'No tiene más ubicaciones');
            header('Content-Type: application/json');
            echo json_encode($res);
          }
        }else {

          $res = array('resultado' => 2, 'mensaje' => 'N/D - 100','descripcion' => 'El vehiculo no ha utilizado la plataforma en las últimas 24 horas');
          header('Content-Type: application/json');
          echo json_encode($res);
        }
      }

    }
}else {
  $res = array('resultado' => 4, 'mensaje' => 'error 100','descripcion' => 'No se envio la placa');
  header('Content-Type: application/json');
  echo json_encode($res);
}






 ?>
