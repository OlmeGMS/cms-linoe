<?php
function listaLineasFacade($arg_id_brand){
  $consulta = new LineCars();
  $idMarca = $arg_id_brand;
  $lineas = $consulta->listaMarcasActivas($idMarca);
  foreach ($lineas as $linea) {
    echo '<option value="'.$linea['id'].'">'.$linea['name_line'].'</option>';
  }
}

function tablaLineasfacade($arg_rol){

  $consulta = new LineCars();
  $consultaMarca = new BrandsCars();
  $rol = $arg_rol;

  $filas = $consulta->listaMarcasActivas();

  echo'<table id="table-lineas" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Marca</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
  foreach($filas as $fila){
    $marca = $consultaMarca->obtenerNombreMarca($fila['id_brand']);
    echo '

    <td id="id_linea" name ="" class="text-center">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['name_line'].'</td>
    <td id="" name ="" class="text-center">'.$marca.'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">';
              if($rol == 1 || $rol == 2){
                echo '
                <a href="modificar_linea?id_linea='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_linea"><i class="fa fa-times"></i></a>
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

function modificarLineaFacade($arg_linea){

  $consulta = new LineCars();
  $consultaMarca = new BrandsCars();
  $linea = $arg_linea;
  $filas = $consulta->cargarLinea($linea);

  foreach($filas as $fila){
    $marca = $consultaMarca->obtenerNombreMarca($fila['id_brand']);
    echo '
    <form id="form-empresa" action="../../controllers/app/modificarLineaController.php" method="post" class="form-horizontal form-bordered">
      <fieldset>
        <legend><i class="fa fa-angle-right"></i> Datos de la línea</legend>
        <div class="form-group">
          <label class="col-md-4 control-label" for="marca">Marca<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <select id="marca" name="marca" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">
              <option value="'.$fila['id_brand'].'"selected>'.$marca.'</option>';
              listaMarcasFacade();
          echo'  </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name_line'].'" >
          </div>
          <div class="col-md-6">
            <input type="hidden" id="id_linea" name="id_linea" class="form-control" value="'.$fila['id'].'" >
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
