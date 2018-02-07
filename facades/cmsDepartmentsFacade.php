<?php
function listaDepartamentosFacade(){
  $consulta = new CmsDepartments();
  $departamentos = $consulta->listaDepartamentos($arg_country_id);
  foreach ($departamentos as $departamento) {
    echo '<option value="'.$departamento['id'].'">'.$departamento['name_company'].'</option>';
  }
}

function tablaDepartamentosFacade($arg_rol){

  $consulta = new CmsDepartments();
  $consultaPais = new CmsCountries();
  $rol = $arg_rol;
  $filas = $consulta->listaTodosDepartamentos();
  echo'<table id="table-lineas" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">País</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
  foreach ($filas as $fila) {
    $pais = $consultaPais->obtenerNombrePais($fila['country_id']);
    echo '
    <td id="id_departamento" name ="" class="text-center">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['name'].'</td>
    <td id="" name ="" class="text-center">'.$pais.'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">';
              if($rol == 1 || $rol == 2){
                echo '
                <a href="modificardepartamento?id_departamento='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_departamento"><i class="fa fa-times"></i></a>
                ';
              }else {
                echo'
                  <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-info" id=""><i class="fa fa-lock"></i></a>
                ';
              }
echo '
          </div>
      </td>

     </tr>';
  }
  echo '<!-- END Responsive Full Block -->
  </tbody>
  </table>';
}

function modificarDepartamento($arg_idDepartamento){

  $consulta = new CmsDepartments();
  $consultaPais = new CmsCountries();
  $idDepartamento = $arg_idDepartamento;
  $filas = $consulta->cargarDepartamento($idDepartamento);
  foreach($filas as $fila){
    $pais = $consultaPais->obtenerNombrePais($fila['country_id']);
    echo '
    <form id="form-empresa" action="../../controllers/app/modificarDepartamentoController.php" method="post" class="form-horizontal form-bordered">
      <fieldset>
        <legend><i class="fa fa-angle-right"></i> Datos del departamento</legend>

        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="id_departamento" name="id_departamento" class="form-control" value="'.$fila['id'].'">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="pais">País<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <!--<select id="pais" name="pais" class="select-chosen" data-placeholder="Seleccione el país de la empresa" style="width: 250px;">-->
            <select type="text" class="form-control" name="pais" id="pais">
              <option value="'.$fila['country_id'].'"selected>'.$pais.'</option>
              <?php echo listaPaisesFacade(); ?>
            </select>
          </div>
        </div>

        <div class="form-group ">
          <div class="col-md-8 col-md-offset-4">
            <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Modificar</button>
            <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
          </div>
        </div>
      </fieldset>
    </form>

    ';
  }
}
 ?>
