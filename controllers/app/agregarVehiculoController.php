<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/company.php');
require_once('../../models/brandsCars.php');
require_once('../../models/lineCars.php');
require_once('../../util/nocsrf.php');

$placa = htmlspecialchars(strtoupper($_POST['placa']), ENT_QUOTES,'UTF-8');
$movil = htmlspecialchars($_POST['nafiliacion'], ENT_QUOTES,'UTF-8');
$marca = htmlspecialchars(strtoupper($_POST['marca']), ENT_QUOTES,'UTF-8');
$linea = htmlspecialchars(strtoupper($_POST['lineas']), ENT_QUOTES,'UTF-8');
$modelo = htmlspecialchars($_POST['modelo'], ENT_QUOTES,'UTF-8');
$empresa = $_POST['empresa'];
$pago = htmlspecialchars($_POST['ultimo_pago'], ENT_QUOTES,'UTF-8');
$factor = isset($_POST['factor']);

if ($factor == true) {
  $factor = 1;
}else {
  $factor = 0;
}

$consultaEmpresa = new Company();
$consultaMarca = new BrandsCars();
$consultaLinea = new LineCars();

$nombreEmpresa = $consultaEmpresa->obtenerNombreEmpresa($empresa);
$ciudad = $consultaEmpresa->obtenerciudadEmpresa($empresa);
$nombreMarca = $consultaMarca->obtenerNombreMarca($marca);
$nombreLinea = $consultaLinea->obtenerNombreLinea($linea);

if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){

    if (strlen($placa) >0 && strlen($movil) >0 && strlen($marca) >0 && strlen($linea) >0 && strlen($modelo) >0 && strlen($pago) >0) {
      $consulta = new Cars();
      $filtro = $consulta->validarVehiculo($placa);

      if ($filtro == 2) {

        $idCarro = $consulta->obtenerIdVehiculo($placa);

        $mensaje = $consulta->actualizarVehiculoEstado($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago, $modelo, $ciudad, $factor, $empresa, $marca, $linea, $idCarro);
        if($mensaje == FALSE){
          header("Location: ../../views/mensajes/error");
        }else{
          header("Location: ../../views/mensajes/registro_exitoso");
        }
      }elseif ($filtro == 1) {
        header("Location: ../../views/mensajes/error_existe?ref=vehículo");
      }elseif ($filtro == '' || $filtro == false || $filtro = null) {
        //$mensaje = $consulta->agregarVehiculo($placa, $marca, $linea, $movil, $empresa, $pago, $modelo);
        $mensaje = $consulta->agregarVehiculo($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago,  $modelo, $ciudad, $factor, $empresa, $marca, $linea);
        if ($mensaje == FALSE) {
          header("Location: ../../views/mensajes/error");
        }else{
          header("Location: ../../views/mensajes/registro_exitoso");
        }
        //echo "lilo";
      }else {
        //$mensaje = $consulta->agregarVehiculo($placa, $marca, $linea, $movil, $empresa, $pago, $modelo);
        $mensaje = $consulta->agregarVehiculo($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago,  $modelo, $ciudad, $factor, $empresa, $marca, $linea);
        if ($mensaje == FALSE) {
          header("Location: ../../views/mensajes/error");
        }else{
          header("Location: ../../views/mensajes/registro_exitoso");
        }
      }


    }else{
      header("Location: ../../views/mensajes/error");
    }

  }else {
    header("Location: ../../views/mensajes/error.php");
  }
}



?>
