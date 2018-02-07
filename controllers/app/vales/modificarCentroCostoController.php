<?php
session_start();
require_once('../../../models/conexion.php');
require_once('../../../models/ticketCostCenters.php');
require_once('../../../models/ticketCompanies.php');
require_once('../../../util/nocsrf.php');

$consulta = new TicketCostCenters();
$consultaCompania = new TicketCompanies();
$mensaje = null;
$idCentroCostos = $_POST['id_centro_costo'];
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$presupuesto = htmlspecialchars($_POST['presupuesto'], ENT_QUOTES,'UTF-8');
$usado = $consulta->obtenerUsed($idCentroCostos);
$idCompania = $consulta->obtnerIDCompaniaXCC($idCentroCostos);
$tipoBloqueo = $consultaCompania->obtenerTipoBloqueo($idCompania);


if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
    if(strlen($idCentroCostos) > 0 && strlen($nombre) > 0 && strlen($presupuesto) > 0){

      $porciento = $presupuesto*10/100;

      $msj = $consulta->actualizarPorcentaje($porciento, $idCentroCostos);
      if ($msj == FALSE) {
        echo "ERROR: No se pudo actualizar el porcentaje";
      }else {
        if($tipoBloqueo == 1){
            if($porciento > $usado){
              $arg_bloqueo = 0;
              $bloqueo = $consulta->modificarBloqueo($arg_bloqueo, $idCentroCostos);
            }
        }
        $mensaje = $consulta->modificarCentroCosto($nombre, $presupuesto, $idCentroCostos);
      }


    }else{
      header("Location: ../../../views/mensajes/error.php");
    }
  }else {
    header("Location: ../../views/mensajes/error.php");
  }
}




 ?>
