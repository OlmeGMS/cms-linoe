<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../models/payments.php');

$servicio = $_POST['id'];
$empresa = $_POST['emp'];

$consulta = new Services();

$filas = $consulta->infoPagosfacturados($servicio, $empresa);


if($filas == NULL){
  $rows = $consulta->infoPagos($servicio, $empresa);
        foreach($rows as $row){
          $placa = strtoupper($row['placa']);
          $nombreCond = $row['name'];
          $apellidoCond = $row['lastname'];



          if($apellidoCond != '' || $apellidoCond != null){
            $conductor = "$nombreCond $apellidoCond";
          }else{
            $conductor = "$nombreCond";
          }

            $n_recibo = "No tiene recibo de pago registrado";




          echo '
          <form id="form-pago" action="javascript:void(0)" method="post" class="form-horizontal form-bordered">
            <fieldset>
              <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="usuario">Usuario</label>
                <div class="col-md-6">
                  <input type="text" id="usuario" name="usuario" class="form-control" value="'.$row['user_name'].'" readonly>
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="idServicio" name="idServicio" class="form-control" value="'.$row['id'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="placa">Placa</label>
                <div class="col-md-6">
                  <input type="text" id="placa" name="placa" class="form-control" value="'.$placa.'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="conductor">Conductor</label>
                <div class="col-md-6">
                  <input type="text" id="conductor" name="conductor" class="form-control" value="'.strtoupper($conductor).'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="unidades">Unidades<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="unidades" name="unidades" class="form-control" value="'.$row['units'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="aeropuerto">Aeropuerto<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="aeropuerto" name="aeropuerto" class="form-control" value="'.$row['charge1'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="nocturno">Nocturno<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="nocturno" name="nocturno" class="form-control" value="'.$row['charge2'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="mensajeria">Mensajeria<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="mensajeria" name="mensajeria" class="form-control" value="'.$row['charge3'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="pp">Puerta a Puerta<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="pp" name="pp" class="form-control" value="'.$row['charge4'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="valor">Valor<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="valor" name="valor" class="form-control" value="'.$row['value'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="recibo">Nº Pago<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="recibo" name="recibo" class="form-control" value = "'.$n_recibo.'" readonly>
                </div>
              </div>
              <div class="form-group form-actions">
                  <div class="col-xs-12 text-right">
                      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cerrar</button>
                  </div>
              </div>
            </fieldset>
          </form>
          ';
        }

}else{
        foreach ($filas as $fila) {
          $placa = strtoupper($fila['placa']);
          $nombreCond = $fila['name'];
          $apellidoCond = $fila['lastname'];


          $recibo = $fila['n_recibo'];

          if($apellidoCond != '' || $apellidoCond != null){
            $conductor = "$nombreCond $apellidoCond";
          }else{
            $conductor = "$nombreCond";
          }

          if($recibo == null){
            $n_recibo = "No tiene recibo de pago registrado";
          }else{
            $n_recibo = $recibo;
          }



          echo '
          <form id="form-pago" action="javascript:void(0)" method="post" class="form-horizontal form-bordered">
            <fieldset>
              <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="usuario">Usuario</label>
                <div class="col-md-6">
                  <input type="text" id="usuario" name="usuario" class="form-control" value="'.$fila['user_name'].'" readonly>
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="idServicio" name="idServicio" class="form-control" value="'.$fila['id'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="placa">Placa</label>
                <div class="col-md-6">
                  <input type="text" id="placa" name="placa" class="form-control" value="'.$placa.'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="conductor">Conductor</label>
                <div class="col-md-6">
                  <input type="text" id="conductor" name="conductor" class="form-control" value="'.strtoupper($conductor).'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="unidades">Unidades<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="unidades" name="unidades" class="form-control" value="'.$fila['units'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="aeropuerto">Aeropuerto<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="aeropuerto" name="aeropuerto" class="form-control" value="'.$fila['charge1'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="nocturno">Nocturno<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="nocturno" name="nocturno" class="form-control" value="'.$fila['charge2'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="mensajeria">Mensajeria<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="mensajeria" name="mensajeria" class="form-control" value="'.$fila['charge3'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="pp">Puerta a Puerta<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="pp" name="pp" class="form-control" value="'.$fila['charge4'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="valor">Valor<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="valor" name="valor" class="form-control" value="'.$fila['value'].'" readonly>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="recibo">Nº Pago<span class="text-danger">*</span></label>
                <div class="col-md-6">
                  <input type="text" id="recibo" name="recibo" class="form-control" value = "'.$n_recibo.'" readonly>
                </div>
              </div>
              <div class="form-group form-actions">
                  <div class="col-xs-12 text-right">
                      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cerrar</button>
                  </div>
              </div>
            </fieldset>
          </form>
          ';
        }
}








 ?>
