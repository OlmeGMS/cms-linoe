<?php
require_once('../../models/conexion.php');
require_once('../../models/parameters.php');
require_once('../../models/services.php');
require_once('../../models/secretaryLogin.php');
require_once('../../models/cars.php');
require_once('../../models/drivers.php');
require_once('../../models/company.php');
require_once('../../models/secretaryReports.php');
require_once('../../models/secretaryCars.php');
ini_set('date.timezone','America/Bogota');

$consultaVehiculo = new Cars();
$consultaConductor = new Drivers();
$consultaSecretaryCars = new SecretaryCars();
$consultaParametros = new Parameters();
$consultaCompany = new Company();
$consultaReportesSecretaria = new SecretaryReports();

//SE CAPTURAN LAS EMPRESAS AFILIADAS A LA APP
$empresas = $consultaCompany->obtenerEmpresasAfiliadasAPPTaxisYaBog();


//variables
$hora = $consultaParametros->horaAcutal();
$fecha = date('Y-m-d');
$date = "$fecha $hora";
$numeros = time(); //NÚMEROS PARA NO SOBREESCRIBIR EL ARCHIVO


//ejecutar fichero de fuera de $idServicio
$url = "http://localhost/cms/webservices/fuera_servicio.php";
$ch = curl_init($url);
$data = array('usuario'=>"0",'password'=>"0");

$payload = json_encode($data);
//$payload = json_encode(array("user" => $data));
$data_string = http_build_query(array('data' => json_encode($data)));

curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
$status = json_decode($response);
$s = $status->{"status"};

if ($s == 200) {
    if ($empresas > 0) {
        foreach ($empresas as $empresa) {

          $idEmpresa = $empresa['id'];
          $nombreEmpresa = $empresa['name_company'];
          $sinEspacio = $consultaParametros->limpia_espacios($nombreEmpresa);


          //NOMBRE DEL ARCHIVO
          $nombreArchivo = "$sinEspacio$numeros";

          $cantidadVehiculos = $consultaVehiculo->obtenerNumeroCarrosXEmpresa($idEmpresa);
          $vehiculos = $consultaVehiculo->todosVehiculosXEmpresa($idEmpresa);

          foreach ($vehiculos as $vehiculo) {

              $idCarro = $vehiculo['id'];
              //$idCarro = 1159;
              $placaCarro = $consultaVehiculo->obtenerPlacas($idCarro);
              $cantidadReporte = $consultaSecretaryCars->cantidadReportesXVehiculo($idCarro);
              $filas = $consultaSecretaryCars->seleccionarDatosCarro($idCarro);
              $placa = $consultaParametros->limpia_espacios(strtoupper("$placaCarro"));
              $cant = "$cantidadReporte";
              $idEmpresaSecretaria = "id de la empresa";//ID DADO POR LA SECRETARIA


              if ($filas > 0) {
                $archivo_csv = fopen("../../reportes/$nombreArchivo.csv", 'w');
                fputs($archivo_csv, ("$nombreEmpresa,$idEmpresaSecretaria, $cantidadVehiculos".PHP_EOL));
                foreach ($filas as $fila) {
                  $idServicio = $fila['idCarrera'];
                  if ($idServicio == NULL) {
                    $idCarrera = "NULL";
                  }else {
                    $idCarrera = $idServicio;
                  }
                  //$registros[] = $fila['numero_tc'].",".$fila['fecha'].",".$fila['lat'].",".$fila['lng'].",".$fila['estado'].",".$idCarrera;
                  //fputs($archivo_csv, "$placa, $cant".PHP_EOL);

                  $lolo[] = array("$placa, $cant".PHP_EOL,$fila['numero_tc'], $fila['fecha'],$fila['lat'],$fila['lng'],$fila['estado'],$idCarrera);
                  foreach ($lolo as $lol) {
                    fputs($archivo_csv, implode($lol, ',').PHP_EOL);

                  }
                  //SE LIMPIA EL ARRAY LOLO
                  foreach ($lolo as $lol) {
                    unset($lol);

                  }


                }

                  fclose($archivo_csv);

              }else {
                $prueba = "No tiene registros";
              }


          }
          $vehiculos = 0;
          unset($lolo);
          $reporte = $consultaReportesSecretaria->agregarReporte($nombreArchivo, $idEmpresa, $date);
        }

    }else{
      echo "error no pudo capturar los id de las empresas afiliadas a la app de taxisya";
    }


}else {
  echo "nada";
}














 ?>
