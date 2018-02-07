<?php
//bucle de llenar select de años
function aniosModelo(){
  $anio = date('Y');
  $a = 1980;
  while ($a <= $anio) {
    echo '<option value="'.$a.'">'.$a.'</option>';
    $a = $a +1 ;
  }
}
function vehiculosWebServices(){
  $consulta = new Cars();
  $filas = $consulta->todosVehiculos();
  /*header("Content-Type: application/json;charset=utf-8");

    // Collect what you need in the $data variable.

    $json = json_encode($filas);
    if ($json === false) {
        // Avoid echo of empty string (which is invalid JSON), and
        // JSONify the error message instead:
        $json = json_encode(array("jsonError", json_last_error_msg()));
        if ($json === false) {
            // This should not happen, but we go all the way now:
            $json = '{"jsonError": "unknown"}';
        }
        // Set HTTP response status code to: 500 - Internal Server Error
        http_response_code(500);
    }
    echo $json;*/
    header('Content-Type: application/json');
    echo json_encode($filas);
      echo "hola";
}
function listaVehiculosFacade($arg_rol){
  $consulta = new Cars();
  $filas = $consulta->todosVehiculosEstado();
  $rol = $arg_rol;
  echo '<table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Móvil</th>
              <th class="text-center">Marca</th>
              <th class="text-center">Línea</th>
              <th class="text-center">Modelo</th>
              <th class="text-center">Empresa</th>
              <th class="text-center">Acciones</th>
          </tr>
      </thead>
      <tbody>';
  foreach($filas as $fila){
    echo '<tr>
    <td id="id_car" name ="" class="text-center">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
    <td id="" name ="" class="text-center">'.$fila['movil'].'</td>
    <td id="" name ="" class="text-center">'.$fila['car_brand'].'</td>
    <td id="" name ="" class="text-center">'.$fila['model'].'</td>
    <td id="" name ="" class="text-center">'.$fila['year'].'</td>
    <td id="" name ="" class="text-center">'.$fila['empresa'].'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">';
            if ($rol == 1 || $rol == 2) {
              echo '
              <a href="modificarvehiculo.php?id_vehiculo='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
              <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Carro"><i class="fa fa-times"></i></a>
              ';
            }elseif ($rol == 3) {
              echo '
              <a href="modificarvehiculo.php?id_vehiculo='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
              ';
            }else {
              echo '
              <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-info" id=""><i class="fa fa-lock"></i></a>
              ';
            }
      echo'
          </div>
      </td>

     </tr>';
  }
  echo '<!-- END Responsive Full Block -->
</tbody>
</table>
<a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelVehiculosController.php" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
<!--<a id="reportePDF" href="../../controllers/app/reportes/pdf/reportePDFVehiculosController.php" data-toggle="tooltip" title="PDF" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
<!-- END All Orders Content -->
';
}

function modificarVehiculoFacade($arg_idVehiculo){
  if (isset($_GET['id_vehiculo'])) {
    $consulta = new Cars();
    $consultaEmpresa = new Company();
    $consultaMarca = new BrandsCars();
    $consultaLinea = new LineCars();
    $idVehiculo = $arg_idVehiculo;
    $filas = $consulta->cargarVehiculo($idVehiculo);
    foreach ($filas as $fila) {
      $idEmpresa = $fila['id_empresa'];
      $nombreEmpresa = $consultaEmpresa->obtenerNombreEmpresa($idEmpresa);
      $idCiudad = $fila['city_id'];
      if($fila['factor'] == 1){
        $checked = "checked";
      }else {
        $checked = "";
      }

      $nombreMarca = $consultaMarca->obtenerNombreMarca($fila['id_brand']);
      $nombreLinea = $consultaLinea->obtenerNombreLinea($fila['id_line']);

      echo '<form id="form-validation" action="../../controllers/app/modificarVehiculoController.php" method="post" class="form-horizontal form-bordered">
        <fieldset>
          <legend><i class="fa fa-angle-right"></i> Datos del vehículo</legend>

          <div class="form-group">
            <label class="col-md-4 control-label" for="placa">Placa<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="Documento" id="placa" name="placa" class="form-control" value="'.$fila['placa'].'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="id_vehiculo" name="id_vehiculo" class="form-control" value="'.$fila['id'].'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nafiliacion">Móvil<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="nafiliacion" name="nafiliacion" class="form-control" value="'.$fila['movil'].'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="marca">Marca<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select id="marca" name="marca" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">

                <option value="'.$fila['id_brand'].'" selected>'.$nombreMarca.'</option>';
                echo listaMarcasFacade();
              echo '</select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="lineas">Linea<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <!--<select id="lineas" name="lineas" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">-->
              <select type="text" class="form-control" name="lineas" id="lineas">
                <option value="'.$fila['id_line'].'" selected>'.$nombreLinea.'</option>

              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="modelo">Modelo del vehículo<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select type="text" class="form-control" name="modelo" id="modelo">
                <option value="'.$fila['year'].'"selected>'.$fila['year'].'</option>';
                aniosModelo();

              echo'</select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="empresa">Empresa<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select id="empresa" name="empresa" class="select-chosen" data-placeholder="Seleccione la empresa del taxi" style="width: 250px;">
              <option value="'.$idEmpresa.'"selected>'.$nombreEmpresa.'</option>';
                  listaEmpresasFacade();
              echo '</select>
              <input type="hidden" id="ultimo_pago" name="ultimo_pago" class="form-control" value="2030-12-30" >
            </div>
          </div>';
          if ($idCiudad == 1) {
            echo'<div class="form-group">
              <label class="col-md-4 control-label" for="">Factor de calidad<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <label class="switch switch-danger"><input type="checkbox" name="factor" value="factor"'.$checked.'><span></span></input></label>
              </div>
            </div>';
          }else{
            echo '<input type="hidden" id="factor" name="factor" value="false">';
          }

          echo '<div class="form-group ">
            <div class="col-md-8 col-md-offset-4">
              <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Modificar</button>
              <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
            </div>
          </div>
        </fieldset>
      </form>';
    }
  }else{
    return header("Location: ../views/app/usuarioCms");
  }

}

function placasFacade(){
  $consulta = new Cars();
  $filas = $consulta->placasMarcas();
  foreach($filas as $fila){
    echo '<option value="'.$fila['id'].'">'.$fila['placa'].' | '.$fila['car_brand'].'</option>';

  }
}

function placaSelecionadaFacade($arg_idConductor){
  $consulta = new Cars();
  $consultaDriversCars = new DriversCars();
  $idConductor = $arg_idConductor;
  $ids = $consultaDriversCars->carrosManejados($idConductor);
  $filas = $consulta->placasMarcasXConductor($ids);
    foreach($filas as $fila){
      echo '<option value="'.$fila['id'].'" selected>'.$fila['placa'].' | '.$fila['car_brand'].'</option>';
    }


}

function modificarVehiculoDocumentoFacade($arg_idVehiculo){
  $consulta = new Cars();
  $consultaMarca = new BrandsCars();
  $consultaLinea = new LineCars();
  $consultaEmpresa = new Company();
  $idVehiculo = $arg_idVehiculo;
  $filas = $consulta->cargarVehiculo($idVehiculo);
  foreach ($filas as $fila) {
    $idCiudad = $fila['city_id'];
    $nombreMarca = $consultaMarca->obtenerNombreMarca($fila['id_brand']);
    $nombreLinea = $consultaLinea->obtenerNombreLinea($fila['id_line']);
    $nombreEmpresa = $consultaEmpresa->obtenerNombreEmpresa($fila['id_empresa']);

    if($fila['factor'] == 1){
      $checked = "checked";
    }else {
      $checked = "";
    }
    echo '<div class="form-group">
      <label class="col-md-4 control-label" for="placa">Placa<span class="text-danger">*</span></label>
      <div class="col-md-5">
        <input type="text" id="placa" name="placa" class="form-control" value="'.$fila['placa'].'">
      </div>
      <div class="col-md-5">
        <input type="hidden" id="id_vehiculo" name="id_vehiculo" class="form-control" value="'.$fila['id'].'">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="nafiliacion">Móvil<span class="text-danger">*</span></label>
      <div class="col-md-5">
        <input type="text" id="nafiliacion" name="nafiliacion" class="form-control" value="'.$fila['movil'].'">
      </div>
      <div class="col-md-5">
        <input type="hidden" id="ultimo_pago" name="ultimo_pago" class="form-control" value="2030-12-30" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="marca">Marca<span class="text-danger">*</span></label>
      <div class="col-md-5">
        <select id="marca" name="marca" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">
        <!--<select type="text" class="form-control" name="marca" id="marca">-->

          <option value="'.$fila['id_brand'].'" selected>'.$nombreMarca.'</option>';
          echo listaMarcasFacade();
        echo '</select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="lineas">Linea<span class="text-danger">*</span></label>
      <div class="col-md-5">
        <!--<select id="lineas" name="lineas" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">-->
        <select type="text" class="form-control" name="lineas" id="lineas">
          <option value="'.$fila['id_line'].'" selected>'.$nombreLinea.'</option>

        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label" for="modelo">Modelo del vehículo<span class="text-danger">*</span></label>
      <div class="col-md-5">
        <select class="form-control" name="modelo" id="modelo">
          <option value="'.$fila['year'].'"selected>'.$fila['year'].'</option>';
          aniosModelo();

        echo'</select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="empresa">Empresa<span class="text-danger">*</span></label>
      <div class="col-md-5">
        <select id="empresa" name="empresa" class="select-chosen" data-placeholder="Seleccione la empresa del taxi" style="width: 250px;">
        <option value="'.$idEmpresa.'"selected>'.$nombreEmpresa.'</option>';
            listaEmpresasFacade();
        echo '</select>
      </div>
    </div>';
    if ($idCiudad == 1) {
      echo'<div class="form-group">
        <label class="col-md-4 control-label" for="">Factor de calidad<span class="text-danger">*</span></label>
        <div class="col-md-6">
          <label class="switch switch-danger"><input type="checkbox" name="factor" value="factor"'.$checked.'><span></span></input></label>
        </div>
      </div>';
    }else{
      echo '<input type="hidden" id="factor" name="factor" value="false">';
    }

  }
}

function busquedaPersonalizadaVehiculoFacade($arg_campo, $arg_item, $arg_rol){
  $consulta = new Cars();
  $campo = $arg_campo;
  $item = $arg_item;
  $rol = $arg_rol;
  $filas = $consulta->busquedaPersonalizada($campo, $item);
  echo '<table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Móvil</th>
              <th class="text-center">Marca</th>
              <th class="text-center">Línea</th>
              <th class="text-center">Modelo</th>
              <th class="text-center">Empresa</th>
              <th class="text-center">Acciones</th>
          </tr>
      </thead>
      <tbody>';
  foreach($filas as $fila){
    echo'
    <tr>
    <td id="id_car" name ="" class="text-center">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
    <td id="" name ="" class="text-center">'.$fila['movil'].'</td>
    <td id="" name ="" class="text-center">'.$fila['car_brand'].'</td>
    <td id="" name ="" class="text-center">'.$fila['model'].'</td>
    <td id="" name ="" class="text-center">'.$fila['year'].'</td>
    <td id="" name ="" class="text-center">'.$fila['empresa'].'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">';
            if ($rol == 1 || $rol == 2) {
              echo '
              <a href="modificarvehiculo.php?id_vehiculo='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
              <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Carro"><i class="fa fa-times"></i></a>
              ';
            }else {
              echo '
              <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-info" id=""><i class="fa fa-lock"></i></a>
              ';
            }
      echo'
          </div>
      </td>

     </tr>
    ';
  }
  echo '<!-- END Responsive Full Block -->
</tbody>
</table>
<a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelVehiculosBusquedaController.php?campo='.$campo.'&&item='.$item.'" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
<!--<a id="reportePDF" href="../../controllers/app/reportes/pdf/reportePDFVehiculosController.php" data-toggle="tooltip" title="PDF" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
<!-- END All Orders Content -->
';
}




 ?>
