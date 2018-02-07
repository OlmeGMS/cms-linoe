<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/company.php');
require_once('../../util/nocsrf.php');
require_once('../../models/brandsCars.php');
require_once('../../models/lineCars.php');

$placa = htmlspecialchars(strtoupper($_POST['placa']), ENT_QUOTES,'UTF-8');
$movil = htmlspecialchars($_POST['nafiliacion'], ENT_QUOTES,'UTF-8');
$marca = $_POST['marca'];
$linea = $_POST['lineas'];
$modelo = htmlspecialchars($_POST['modelo'], ENT_QUOTES,'UTF-8');
$empresa = $_POST['empresa'];
$pago = htmlspecialchars($_POST['ultimo_pago'], ENT_QUOTES,'UTF-8');
$idVehiculo = $_POST['id_vehiculo'];
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

$estado = 1;

if (strlen($placa) >0 && strlen($movil) >0 && strlen($marca) >0 && strlen($linea) >0 && strlen($modelo) >0 && strlen($empresa) >0 && strlen($pago) >0 && strlen($idVehiculo) >0) {
  $consulta = new Cars();
  if (isset($_POST['_token'])) {
    if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
        $mensaje = $consulta->modificarVehiculo($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago, $modelo, $ciudad, $estado, $factor, $empresa, $marca, $linea, $idVehiculo);

        if ($mensaje == FALSE) {
          header("Location: ../../views/mensajes/error.php");
        }else{
          header("Location: ../../views/mensajes/registro_exitoso.php");
        }
    }else {
      header("Location: ../../views/mensajes/error.php");
    }
  }

}else{
  header("Location: ../../views/mensajes/error.php");
}

?>
