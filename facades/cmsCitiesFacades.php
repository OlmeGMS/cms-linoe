<?php
function listaCiudadesFacade(){
  $consulta = new CmsCities();
  $ciudades = $consulta->listaCiudades($arg_country_id, $arg_department_id);
  foreach ($ciudades as $ciudad) {
    echo '<option value="'.$ciudad['id'].'">'.$ciudad['name'].'</option>';
  }
}

function tablaCiudadesFacade($arg_rol){

  $consulta = new CmsCities();
  $consultaDepartamento = new CmsDepartments();
  $consultaPais = new CmsCountries();
  $rol = $arg_rol;

  $filas = $consulta->listaCiudadesSistema();
  echo'<table id="table-lineas" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">País</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';

      foreach ($filas as $fila) {
        $pais = $consultaPais->obtenerNombrePais($fila['country_id']);
        $dempartamento = $consultaDepartamento->obtenerNombreDepartamento($fila['department_id']);
        echo '
        <td id="id_ciudad" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="" name ="" class="text-center">'.$dempartamento.'</td>
        <td id="" name ="" class="text-center">'.$pais.'</td>
        <td class="text-center">
              <div class="btn-group btn-group-xs">';
                  if($rol == 1 || $rol == 2){
                    echo '
                    <a href="modificar_ciudad?id_ciudad='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_ciudad"><i class="fa fa-times"></i></a>
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

function modificarCiudadFacade($arg_idCiudad){

  $consulta = new CmsCities();
  $consultaDepartamento = new CmsDepartments();
  $consultaPais = new CmsCountries();

  $idCiudad = $arg_idCiudad;

  $filas = $consulta->cargarCiudad($idCiudad);

  foreach ($filas as $fila) {
    $pais = $consultaPais->obtenerNombrePais($fila['country_id']);
    $departamento = $consultaDepartamento->obtenerNombreDepartamento($fila['department_id']);

    echo '
    <form id="form-empresa" action="../../controllers/app/modificarCiudadController.php" method="post" class="form-horizontal form-bordered">
      <fieldset>
        <legend><i class="fa fa-angle-right"></i> Datos de la ciudad</legend>

        <div class="form-group">
          <label class="col-md-4 control-label" for="pais">País<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <!--<select id="pais" name="pais" class="select-chosen" data-placeholder="Seleccione el país de la empresa" style="width: 250px;">-->
            <select type="text" class="form-control" name="pais" id="pais">
              <option value="'.$fila['country_id'].'" selected>'.$pais.'</option>';
               echo listaPaisesFacade();
          echo '</select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="departamento">Departamento<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <!--<select id="pais" name="pais" class="select-chosen" data-placeholder="Seleccione el país de la empresa" style="width: 250px;">-->
            <select type="text" class="form-control" name="departamento" id="departamento">
                <option value="'.$fila['department_id'].'" selected>'.$departamento.'</option>';
          echo ' </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'" >
          </div>
          <div class="col-md-6">
            <input type="hidden" id="id_ciudad" name="id_ciudad" class="form-control" value="'.$fila['id'].'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
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
