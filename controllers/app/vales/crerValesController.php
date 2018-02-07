<?php
require_once('../../../models/conexion.php');
require_once('../../../models/ticketCostCenters.php');
require_once('../../../models/ticketCompanies.php');
require_once('../../../models/ticketTickets.php');
require_once('../../../models/services.php');

ini_set('date.timezone','America/Bogota');

$cantidad = null;
$fechaV = null;
$depenencia = null;

$fechaActual = date('Y-m-d H:i:s');

$cantidad = $_POST['cantidad'];
$idCompania = $_POST['idCompania'];
$fechaV  = $_POST['fechaFin'];
$depenencia = $_POST['dependencia'];
$costCenter = $_POST['cost_center'];
$nombreUsuario = $_POST['nombre_usuario'];
$hora = $_POST['example-timepicker24'];

$fV = $fechaV.' '.$hora;

$consultaCC = new TicketCostCenters();
$consultaS = new Services();
$consulta = new TicketTickets();
$consultaCompania = new TicketCompanies();

$prefijo = strtoupper($consultaS->prefijo($costCenter));
$numero = $consultaCC->ultimoNumeroVale($costCenter);

$tipoBloqueo = $consultaCompania->obtenerTipoBloqueo($idCompania);
$filtroBloqueo = $consultaCC->obtenerBloqueo($costCenter);





if (strlen($cantidad) > 0 && strlen($fechaV) > 0 && strlen($depenencia) > 0){

  if ($tipoBloqueo == 1) {
    if ($filtroBloqueo == 1) {
      header('Location: ../../../views/mensajes/error_crear_vale_presupuesto.php');
    }else {

          if($fechaV >= $fechaActual){
            for ($i=0; $i < $cantidad ; $i++) {

              $n = str_pad($numero, 5, "0", STR_PAD_LEFT);
              $vale = $prefijo.$n;
              $flag = $consulta->crearNuevoVale($idCompania, $costCenter, $vale, $fechaActual, $fV, $nombreUsuario, $depenencia);
              $numero++;
            }

            if($flag == TRUE){
              $consultaCC->actualizarNumeroVale($numero, $costCenter);
              return header("Location: ../../../views/mensajes/registro_exitoso.php");
            }else{
              return header("Location: ../../../views/mensajes/error.php");
            }



          }else{
            header('Location: ../../../views/mensajes/error.php');
          }

    }
  }else {

        if($fechaV >= $fechaActual){
          for ($i=0; $i < $cantidad ; $i++) {

            $n = str_pad($numero, 5, "0", STR_PAD_LEFT);
            $vale = $prefijo.$n;
            $flag = $consulta->crearNuevoVale($idCompania, $costCenter, $vale, $fechaActual, $fV, $nombreUsuario, $depenencia);
            $numero++;
          }

          if($flag == TRUE){
            $consultaCC->actualizarNumeroVale($numero, $costCenter);
            return header("Location: ../../../views/mensajes/registro_exitoso.php");
          }else{
            return header("Location: ../../../views/mensajes/error.php");
          }



        }else{
          header('Location: ../../../views/mensajes/error.php');
        }

  }




}else{
  header('Location: ../../views/mensajes/error.php');
}





 ?>
