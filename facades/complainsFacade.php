<?php
function listaComplains(){
  $consulta = new Complains();
  $js = "$('#modal-queja').modal('show');";
  $filas = $consulta->lisataQuejasYReclamos();
  echo '
  <div class="tab-pane active" id="espera">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
          <thead>
              <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Nº Servicio</th>
                  <th class="text-center">Usuario</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center">Respuesta</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Fecha creación</th>
                  <th class="text-center">Fecha Actualización</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';

  foreach ($filas as $fila) {
    echo '
    <tr>
      <td id="id_queja" name ="" class="text-center">'.$fila['id'].'</td>
      <td id="id_servicio" name ="" class="text-center">'.$fila['service_id'].'</td>
      <td id="nombre_usuario" name ="" class="text-center">'.$fila['user_name'].'</td>
      <td id="descripcion" name ="" class="text-center">'.$fila['descript'].'</td>
      <td id="respuesta" name ="" class="text-center">'.$fila['answer'].'</td>';
      if($fila['answered'] == 1){
        echo '<td id="" name ="" class="text-center"><span class="label label-success">Contestado</span></td>';
      }else{
        echo '<td id="" name ="" class="text-center"><span class="label label-danger">Sin Respuesta</span></td>';
      }
    echo'

      <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>';
      if ($fila['answered'] == 1) {
        echo '<td class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="infoqueja" name="infoqueja" data-toggle="tooltip" title="Ver" class="btn btn-default" onclick='.$js.'><i class="fa fa-info-circle" style="padding: 1px 5px;"></i></a>
              </div>
        </td>';
      }else{
        echo '<td class="text-center">
              <div class="btn-group btn-group-xs">
                  <a href="respuestaQueja?id='.$fila['id'].'" id="queja" name="queja" data-toggle="tooltip" title="Responder" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
              </div>
        </td>';
      }
    echo'
    </tr>
    ';
  }
  echo'
  </tbody>
  </table>
  </div>
  </div>
  ';
}

function formularioQuejaFacade($arg_id){
  if (isset($_GET['id'])) {
    $consulta = new Complains();
    $idQueja = $arg_id;
    $filas = $consulta->cargarQueja($idQueja);

    foreach ($filas as $fila) {
      $nombreUsuario = "--";
      if(isset($fila['user_name'])){
        $nombreUsuario = $fila['user_name'];
      }

      echo'
      <form id="form-validation" action="../../controllers/app/quejaController.php" method="post" class="form-horizontal form-bordered">
        <fieldset>
          <legend><i class="fa fa-angle-right"></i> Respuesta a la queja</legend>
      <div class="form-group">
        <label class="col-md-4 control-label" for="placa">Nº Servicio</label>
        <div class="col-md-5">
        <p class="form-control">'.$fila['service_id'].'</p>
        </div>
        <div class="col-md-5">
          <input type="hidden" id="id_queja" name="id_queja" class="form-control" value="'.$fila['id'].'">
        </div>
        <div class="col-md-5">
          <input type="hidden" id="queja" name="queja" class="form-control" value="'.$fila['descript'].'">
        </div>
        <div class="col-md-5">
          <input type="hidden" id="fecha" name="fecha" class="form-control" value="'.$fila['created_at'].'">
        </div>
        <div class="col-md-5">
          <input type="hidden" id="nombre" name="nombre" class="form-control" value="'.$nombreUsuario.'">
        </div>
        <div class="col-md-5">
          <input type="hidden" id="id_servicio" name="id_servicio" class="form-control" value="'.$fila['service_id'].'">
        </div>
        <div class="col-md-6">
          <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="descripcion">Nombre Usuario</label>
        <div class="col-md-5">
          <p class="form-control">'.$nombreUsuario.'</p>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="descripcion">Queja o Reclamo</label>
        <div class="col-md-5">
          <p class="form-control">'.$fila['descript'].'</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label" for="">Respuesta<span class="text-danger">*</span></label>
        <div class="col-md-12">
          <textarea type="text" id="mensaje" name="mensaje" class="form-control ckeditor"></textarea>
        </div>
      </div>
      <div class="form-group ">
        <div class="col-md-8 col-md-offset-4">
          <button id="btn-respuesta" href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Enviar Respuesta</button>
        </div>
      </div>
      </fieldset>
    </form>
      ';
    }
  }else {
    return header("Location: ../views/app/quejasyreclamos");
  }


}

function listaComplainsBusqueda($arg_campo, $arg_item){
  $consulta = new Complains();
  $js = "$('#modal-queja').modal('show');";
  $campo = $arg_campo;
  $item = $arg_item;
  $filas = $consulta->busquedaPersonalizada($campo, $item);
  echo '
  <div class="tab-pane active" id="espera">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
          <thead>
              <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Nº Servicio</th>
                  <th class="text-center">Usuario</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center">Respuesta</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Fecha creación</th>
                  <th class="text-center">Fecha Actualización</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';

  foreach ($filas as $fila) {
    echo '
    <tr>
      <td id="id_queja" name ="" class="text-center">'.$fila['id'].'</td>
      <td id="id_servicio" name ="" class="text-center">'.$fila['service_id'].'</td>
      <td id="nombre_usuario" name ="" class="text-center">'.$fila['user_name'].'</td>
      <td id="descripcion" name ="" class="text-center">'.$fila['descript'].'</td>
      <td id="respuesta" name ="" class="text-center">'.$fila['answer'].'</td>';
      if($fila['answered'] == 1){
        echo '<td id="" name ="" class="text-center"><span class="label label-success">Contestado</span></td>';
      }else{
        echo '<td id="" name ="" class="text-center"><span class="label label-danger">Sin Respuesta</span></td>';
      }
    echo'

      <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>';
      if ($fila['answered'] == 1) {
        echo '<td class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="infoqueja" name="infoqueja" data-toggle="tooltip" title="Ver" class="btn btn-default" onclick='.$js.'><i class="fa fa-info-circle" style="padding: 1px 5px;"></i></a>
              </div>
        </td>';
      }else{
        echo '<td class="text-center">
              <div class="btn-group btn-group-xs">
                  <a href="respuestaQueja?id='.$fila['id'].'" id="queja" name="queja" data-toggle="tooltip" title="Responder" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
              </div>
        </td>';
      }
    echo'
    </tr>
    ';
  }
  echo'
  </tbody>
  </table>
  </div>
  </div>
  ';
}
?>
