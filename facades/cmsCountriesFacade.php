<?php
function listaPaisesFacade(){
  $consulta = new CmsCountries();
  $paises = $consulta->listaPaisesActivos();
  foreach ($paises as $pais) {
    echo '<option value="'.$pais['id'].'">'.$pais['name'].'</option>';
  }
}

function tablaPaisesFacade($arg_rol){

  $consulta = new CmsCountries();
  $filas = $consulta->listaPaisesActivos();
  $rol = $arg_rol;
  echo'<table id="table-lineas" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
      foreach ($filas as $fila) {
        echo '
        <td id="id_pais" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['name'].'</td>
        <td class="text-center">
              <div class="btn-group btn-group-xs">';
                  if($rol == 1 || $rol == 2){
                    echo '
                    <a href="modificarpais?id_pais='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_pais"><i class="fa fa-times"></i></a>
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

function modificarPaisFacade($arg_idPais){

  $consulta = new CmsCountries();
  $idPais = $arg_idPais;
  $filas = $consulta->cargarPais($idPais);
  foreach ($filas as $fila) {
    echo '
    <form id="form-empresa" action="../../controllers/app/modificarPaisController.php" method="post" class="form-horizontal form-bordered">
      <fieldset>
        <legend><i class="fa fa-angle-right"></i> Datos del país</legend>

        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="id_pais" name="id_pais" class="form-control" value="'.$fila['id'].'">
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
