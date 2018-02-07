<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/barrio.php');
require_once('../../models/services.php');
require_once('../../models/drivers.php');
require_once('../../models/cars.php');
require_once('../../facades/barrioFacade.php');

$id = $_POST['id'];

$consulta = new Services();
$consultaUsers = new Users();
$consultaBarrio = new Barrio();
$consultaConductor = new Drivers();
$consultaCarro = new Cars();


$barrios = $consultaBarrio->todosBarrios();
$filas = $consulta->cargarServicio($id);

foreach ($filas as $fila) {
  $nombre = $fila['user_name'];
  $direccion = $fila['address'];
  $tipoPago = $fila['pay_reference'];
  $nombreAv = $fila['index_id'];
  $comp1 = $fila['comp1'];
  $comp2 = $fila['comp2'];
  $no = $fila['no'];
  $barrio = $fila['barrio'];
  $usuarioSer = $fila['user_id'];
  $observaciones = $fila['obs'];
  $destino = $fila['destination'];

  $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
  $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
  $celularConductor = $consultaConductor->celularConductor($fila['driver_id']);

  $placa = $consultaCarro->obtenerPlacas($fila['car_id']);

}

$conductor = "$nombreConductor $apellidoConductor";
if ($conductor == " " || $conductor == NULL) {
  $conductor = "No se ha asigando conductor";
}
if ($celularConductor == " " || $celularConductor == NULL) {
  $celularConductor = "No se ha asigando conductor";
}
if ($placa == NULL || $placa == " ") {
  $placa = "No se ha asigando vehículo";
}
if($observaciones == NULL || $observaciones == " "){
  $observaciones = "No tiene observaciones";
}


echo '
<form action="../../controllers/modificarServicioController.php" method="post" class="form-horizontal form-bordered">
    <fieldset>
        <legend>Información Servicio</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$nombre.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Dirección</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$direccion.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Observaciones</label>
            <div class="col-md-8">
                <p class="form-control-static">'.strtoupper($observaciones).'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Forma de pago</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$tipoPago.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Destino</label>
            <div class="col-md-8">
                <p class="form-control-static">'.strtoupper($destino).'</p>

            </div>
        </div>

    </fieldset>
    <fieldset>
        <legend>Actualizar Conductor del Servicio</legend>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-repassword">Nombre Conductor</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$conductor.'
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-repassword">Celular Conductor</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$celularConductor.'
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-repassword">Placa del vehículo</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$placa.'
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
