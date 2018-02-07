<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/barrio.php');
require_once('../../models/services.php');
require_once('../../models/drivers.php');
require_once('../../models/schedule.php');
require_once('../../models/cars.php');
require_once('../../facades/barrioFacade.php');

$id = $_POST['id'];

$consulta = new Services();
$consultaUsers = new Users();
$consultaBarrio = new Barrio();
$consultaConductor = new Drivers();
$consultaCarro = new Cars();
$consultaAgendamiento = new Schedule();


$barrios = $consultaBarrio->todosBarrios();
$filas = $consultaAgendamiento->cargarAgendamiento($id);

foreach ($filas as $fila) {
  if($fila['name_user'] != null || $fila['name_user'] != ''){
    $nombreCms = $fila['name_user'];
  }else {
    $nombreCms = null;
  }
  if ($fila['lastname_user'] != null || $fila['lastname_user'] != '') {
    $apellidoCms = $fila['lastname_user'];
  }else {
    $apellidoCms = null;
  }

  $direccion = $fila['address'];
  // $tipoPago = $fila['pay_reference'];
  $nombreAv = $fila['address_index'];
  $comp1 = $fila['comp1'];
  $comp2 = $fila['comp2'];
  $no = $fila['no'];
  $barrio = $fila['barrio'];
  $usuarioSer = $fila['user_id'];

  $nombreUsuario = $consultaUsers->obtenerNombre($usuarioSer);

  if ($nombreCms != null && $apellidoCms != null) {
    $name = "$nombreCms $apellidoCms";
  }else{
    $name = "$nombreUsuario";
  }


}



switch ($fila['schedule_type']) {
  case '1':
    $tipoAgendamiento = "Aeropuerto";
    break;
    case '2':
      $tipoAgendamiento = "Fuera de la ciudad";
      break;
      case '3':
        $tipoAgendamiento = "Mensajería";
        break;
        case '4':
          $tipoAgendamiento = "Por horas";
          break;
  default:
    # code...
    break;

}
$destino = $fila['destination'];
$hora = $fila['service_date_time'];

echo '
<form action="../../controllers/modificarServicioController.php" method="post" class="form-horizontal form-bordered">
    <fieldset>
        <legend>Información Agendamiento</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">Fecha servicio</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$hora.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$name.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Dirección</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$direccion.'</p>

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Tipo de agendmaiento</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$tipoAgendamiento.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Destino</label>
            <div class="col-md-8">
                <p class="form-control-static">'.strtoupper($destino).'</p>

            </div>
        </div>

    </fieldset>

    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</form>
';




 ?>
