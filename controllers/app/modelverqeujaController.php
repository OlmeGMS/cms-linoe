<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/complains.php');

$id = $_POST['id'];

$consulta = new Complains();
$consultaUsuario = new Users();

$filas = $consulta->cargarQueja($id);
$nombre = "--";

foreach($filas as $fila){
  $nServicios = $fila['service_id'];
  if(isset($fila['user_name'])){
    $nombre = $fila['user_name'];
  }
  $queja = $fila['descript'];
  $respuesta = $fila['answer'];
}

echo'
<form action="" method="post" class="form-horizontal form-bordered">
    <fieldset>
        <legend>Información Servicio</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">Nº Servicio</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$nServicios.'</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre usuario</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$nombre.'</p>

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Queja o Reclamo</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$queja.'</p>

            </div>
        </div>

    </fieldset>
    <fieldset>
        <legend>Actualizar Conductor del Servicio</legend>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-repassword">Respuesta Enviada</label>
            <div class="col-md-8">
                <p class="form-control-static">'.$respuesta.'
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
