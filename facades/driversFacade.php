<?php
function listaConductoresFacade($arg_rol){
  $consulta = new Drivers();
  $consultaVehiculo = new Cars();
  $filas = $consulta->todosCoductoresEstado();
  $rol = $arg_rol;

  echo'<table id="table-conductor" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th class="text-center">Disponible</th>
              <th class="text-center">Celular</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Email</th>
              <th class="text-center">F. Registro</th>
              <th class="text-center">F. Modif.</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
  foreach($filas as $fila){
    $placa = $consultaVehiculo->buscarPlaca($fila['car_id']);

    $estado = $fila['status'];
    echo '<tr>
    <td id="id_conductor" name ="" class="text-center">'.$fila['id'].'</td>';
    switch ($estado) {
      case 'true':
        echo '<td class="text-center"><span class="label label-success">Aceptado</span></td>';
        break;
        case 'false':
          echo '<td class="text-center"><span class="label label-warning">No Aceptado</span></td>';
          break;
          case 'nuevo':
            echo '<td class="text-center"><span class="label label-info">Nuevo</span></td>';
            break;
            case 'rechazado':
              echo '<td class="text-center"><span class="label label-danger">Rechazado</span></td>';
              break;
      default:
        # code...
        break;
    }
  echo '
    <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
    <td id="" name ="" class="text-center">'.$fila['name'].' '.$fila['lastname'].'</td>
    <td id="" name ="" class="text-center">'.$placa.'</td>
    <td id="" name ="" class="text-center">'.$fila['email'].'</td>
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">';
              if($rol == 1 || $rol == 2){
                echo '
                <a href="modificarconductor.php?id_conductor='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Conductor"><i class="fa fa-times"></i></a>
                ';
              }elseif ($rol == 3) {
                echo '
                  <a href="modificarconductor.php?id_conductor='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
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
</table>
<a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelDriversController.php" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
<!-- END All Orders Content -->
';
}

function modificarconductorFacade($arg_idConductor){
  if (isset($_GET['id_conductor'])) {
    $consulta = new Drivers();
    $consultaVehiculo = new Cars();
    $consultaDriversCars = new DriversCars();
    $idConductor = $arg_idConductor;
    $filas = $consulta->cargarConductor($idConductor);
    $js = "$('#modal-user-camera').modal('show')";


    foreach($filas as $fila){
      echo '
      <form id="form-validation" action="../../controllers/app/modificarConductorController.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
        <fieldset>
          <legend><i class="fa fa-angle-right"></i> Datos del conductor</legend>

          <div class="form-group">
              <div class="col-md-12" align=center>
                <img src="../dis/img/conductores/'.$fila['picture'].'" alt="foto_conductor" width="300px" height="300px">
              </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="example-file-input">Foto conductor</label>
              <div class="col-md-6">
                  <input type="file" id="example-file-input" name="example-file-input" accept="image/*">
              </div>
              <div class="col-md-6">
                  <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="CamaraWeb" onclick="'.$js.'"><i class="gi gi-photo"></i>Tomar foto con la camara web</a>
              </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'" >
            </div>
            <div class="col-md-6">
              <input type="hidden" id="id_conductor" name="id_conductor" class="form-control" value="'.$fila['id'].'" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="primer_apellido">Apellido<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" value="'.$fila['lastname'].'">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="email" id="email" name="email" class="form-control" value="'.$fila['email'].'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="password">Contraseña<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="hidden" id="pass" name="pass" class="form-control" value="'.$fila['pwd'].'" >
            </div>
            <div class="col-md-6">
              <input type="text" id="passwords" name="passwords" class="form-control" placeholder="Digite la contraseña" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="movil">Celular<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="movil" name="movil" class="form-control" value="'.$fila['cellphone'].'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="telefono">Teléfono<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="telefono" name="telefono" class="form-control" value="'.$fila['telephone'].'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="Documento">Cédula de ciudadania<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="Documento" name="Documento" class="form-control" value="'.$fila['cedula'].'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="direccion">Direccion<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="direccion" name="direccion" class="form-control" value="'.$fila['dir'].'">
            </div>
          </div>
          <div class="form-group">
              <label class="col-md-4 control-label" for="example-chosen-multiple">Vehículos</label>
              <div class="col-md-6">
                  <select id="example-chosen-multiple[]" name="example-chosen-multiple[]" class="select-chosen" data-placeholder="Seleccione los vehículos que conduce" style="width: 250px;" multiple>
                  <!--<option value="2" selected>SGH272 | CHEVROLET</option>-->';
                    echo placaSelecionadaFacade($idConductor);
                    echo placasFacade();
                echo  '</select>
              </div>
          </div>

          <div class="form-group ">
            <div class="col-md-8 col-md-offset-4">
              <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Editar</button>
              <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
            </div>
          </div>
        </fieldset>
      </form>
      ';
    }
  }else{
    return header("Location: ../views/app/listaConductores");
  }
}

function listaHistoricoCoductoresFacade(){
  $consulta = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();
  $filas = $consulta->listaHistoricoCoductores();
  echo '<table id="example-datatable" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellido</th>
              <th class="text-center">Celular</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Acciones</th>
          </tr>
      </thead>
      <tbody>';
      foreach ($filas as $fila) {
        $estado = $fila['status'];
        $idCarro = $consultaDriversCars->carrosManejados($fila['idcont']);
        $placa = $consultaVehiculo->obtenerPlacas($idCarro);
        echo '<tr>
        <td id="" name ="" class="text-center">'.$fila['idcont'].'</td>';
        switch ($estado) {
          case 'true':
            echo '<td class="text-center"><span class="label label-success">Aceptado</span></td>';
            break;
            case 'false':
              echo '<td class="text-center"><span class="label label-warning">Pendiente</span></td>';
              break;
              case 'nuevo':
                echo '<td class="text-center"><span class="label label-info">Nuevo</span></td>';
                break;
                case 'rechazado':
                  echo '<td class="text-center"><span class="label label-danger">Rechazado</span></td>';
                  break;
          default:
            # code...
            break;
        }
   echo'<td id="" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="" name ="" class="text-center">'.$fila['lastname'].'</td>
        <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
        <td id="" name ="" class="text-center">'.$placa.'</td>';
        $registro = $fila['documento1'];
        if (!empty($registro)) {
          echo '<td id="" name ="" class="text-center">App/Web</td>
                <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="modificardocumento.php?id_conductor='.$fila['idcont'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                            <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                        </div>
                    </td>

                   </tr>';
        }else{
          echo '<td id="" name ="" class="text-center">CMS</td>
                <td class="text-center">
                          <div class="btn-group btn-group-xs">
                              <a href="javascript:void(0)" data-toggle="tooltip" title="No se Editar" class="btn btn-default" ><i class="fa fa-lock"></i></a>
                              <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                          </div>
                      </td>

                     </tr>';
        }


      }
echo '<!-- END Responsive Full Block -->
    </tbody>
    </table>
    <!-- END All Orders Content -->
    ';
}

function listaHistoricoCoductoresCentralFacade(){
  $consulta = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();
  $filas = $consulta->listaHistoricoCoductoresCentral();
  echo '<table id="example-datatable" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellido</th>
              <th class="text-center">Celular</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Acciones</th>
          </tr>
      </thead>
      <tbody>';
      foreach ($filas as $fila) {
        $estado = $fila['status'];
        $idCarro = $consultaDriversCars->carrosManejados($fila['idcont']);
        $placa = $consultaVehiculo->obtenerPlacas($idCarro);
        echo '<tr>
        <td id="" name ="" class="text-center">'.$fila['idcont'].'</td>';
        switch ($estado) {
          case 'true':
            echo '<td class="text-center"><span class="label label-success">Aceptado</span></td>';
            break;
            case 'false':
              echo '<td class="text-center"><span class="label label-warning">Pendiente</span></td>';
              break;
              case 'nuevo':
                echo '<td class="text-center"><span class="label label-info">Nuevo</span></td>';
                break;
                case 'rechazado':
                  echo '<td class="text-center"><span class="label label-danger">Rechazado</span></td>';
                  break;
          default:
            # code...
            break;
        }
   echo'<td id="" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="" name ="" class="text-center">'.$fila['lastname'].'</td>
        <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
        <td id="" name ="" class="text-center">'.$placa.'</td>';
        $registro = $fila['documento1'];
        if (!empty($registro)) {
          echo '<td id="" name ="" class="text-center">App/Web</td>
                <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="modificardocumento.php?id_conductor='.$fila['idcont'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                            <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                        </div>
                    </td>

                   </tr>';
        }else{
          echo '<td id="" name ="" class="text-center">CMS</td>
                <td class="text-center">
                          <div class="btn-group btn-group-xs">
                              <a href="javascript:void(0)" data-toggle="tooltip" title="No se Editar" class="btn btn-default" ><i class="fa fa-lock"></i></a>
                              <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                          </div>
                      </td>

                     </tr>';
        }


      }
echo '<!-- END Responsive Full Block -->
    </tbody>
    </table>
    <!-- END All Orders Content -->
    ';
}

function listaHistoricoCoductoresCentralBusquedaFacade($arg_placa){
  $placa = $arg_placa;
  $consulta = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();
  $filas = $consulta->listaHistoricoCoductoresBusqueda($placa);
  echo '<table id="example-datatable" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellido</th>
              <th class="text-center">Celular</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Acciones</th>
          </tr>
      </thead>
      <tbody>';
      foreach ($filas as $fila) {
        $estado = $fila['status'];
        $idCarro = $consultaDriversCars->carrosManejados($fila['id']);
        $placa = $consultaVehiculo->obtenerPlacas($idCarro);
        echo '<tr>
        <td id="" name ="" class="text-center">'.$fila['id'].'</td>';
        switch ($estado) {
          case 'true':
            echo '<td class="text-center"><span class="label label-success">Aceptado</span></td>';
            break;
            case 'false':
              echo '<td class="text-center"><span class="label label-warning">Pendiente</span></td>';
              break;
              case 'nuevo':
                echo '<td class="text-center"><span class="label label-info">Nuevo</span></td>';
                break;
                case 'rechazado':
                  echo '<td class="text-center"><span class="label label-danger">Rechazado</span></td>';
                  break;
          default:
            # code...
            break;
        }
   echo'<td id="" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="" name ="" class="text-center">'.$fila['lastname'].'</td>
        <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
        <td id="" name ="" class="text-center">'.$fila['placa'].'</td>';
        $registro = $fila['documento1'];
        if (!empty($registro)) {
          echo '<td id="" name ="" class="text-center">App/Web</td>
                <td class="text-center">
                        <div class="btn-group btn-group-xs">
                            <a href="modificardocumento.php?id_conductor='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                            <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                        </div>
                    </td>

                   </tr>';
        }else{
          echo '<td id="" name ="" class="text-center">CMS</td>
                <td class="text-center">
                          <div class="btn-group btn-group-xs">
                              <a href="javascript:void(0)" data-toggle="tooltip" title="No se Editar" class="btn btn-default" ><i class="fa fa-lock"></i></a>
                              <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                          </div>
                      </td>

                     </tr>';
        }


      }
echo '<!-- END Responsive Full Block -->
    </tbody>
    </table>
    <!-- END All Orders Content -->
    ';
}

function modificarConductorDocumentoFacade($arg_idConductor){
  if (isset($_GET['id_conductor'])) {
    $consulta = new Drivers();
    $consultaVehiculo = new Cars();
    $consultaDriversCars = new DriversCars();
    $idConductor = $arg_idConductor;
    $filas = $consulta->cargarConductorDocumentos($idConductor);
    $js = "$('#modal-user-camera').modal('show')";

    foreach($filas as $fila){
      echo '
      <form id="clickable-wizard" action="../../controllers/app/modificarConductorDocumentoController.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
          <!-- First Step -->
          <div id="clickable-first" class="step">
              <!-- Step Info -->
              <div class="form-group">
                  <div class="col-xs-12">
                      <ul class="nav nav-pills nav-justified clickable-steps">
                          <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-first"><strong>1. Conductor</strong></a></li>
                          <li><a href="javascript:void(0)" data-gotostep="clickable-second"><strong>2. Vehículo</strong></a></li>
                          <li><a href="javascript:void(0)" data-gotostep="clickable-third"><strong>3. Documentos</strong></a></li>
                      </ul>
                  </div>
              </div>
              <!-- END Step Info -->
              <div class="form-group">
                  <div class="col-md-12" align=center>
                    <img src="../dis/img/conductores/'.$fila['picture'].'" alt="foto_conductor" width="300px" height="300px">
                  </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="foto_conductor">Foto conductor</label>
                  <div class="col-md-5">
                      <input type="file" id="foto_conductor" name="foto_conductor" accept="image/*">
                  </div>
                  <div class="col-md-5">
                      <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="CamaraWeb" onclick="'.$js.'"><i class="gi gi-photo"></i>Tomar foto con la camara web</a>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'" >
                </div>
                <div class="col-md-5">
                  <input type="hidden" id="id_conductor" name="id_conductor" class="form-control" value="'.$fila['idCond'].'" >
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="primer_apellido">Apellido<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" value="'.$fila['lastname'].'">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="email" id="email" name="email" class="form-control" value="'.$fila['email'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="movil">Celular<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" id="movil" name="movil" class="form-control" value="'.$fila['cellphone'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="telefono">Teléfono<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" id="telefono" name="telefono" class="form-control" value="'.$fila['telephone'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="Documento">Cédula de ciudadania<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" id="Documento" name="Documento" class="form-control" value="'.$fila['cedula'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="direccion">Direccion<span class="text-danger">*</span></label>
                <div class="col-md-5">
                  <input type="text" id="direccion" name="direccion" class="form-control" value="'.$fila['dir'].'">
                  <input type="hidden" id="id_carro" name="id_carro" class="form-control" value="'.$fila['car_id'].'">
                </div>
              </div>

          </div>
          <!-- END First Step -->

          <!-- Second Step -->
          <div id="clickable-second" class="step">
              <!-- Step Info -->
              <div class="form-group">
                  <div class="col-xs-12">
                      <ul class="nav nav-pills nav-justified clickable-steps">
                          <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-check"></i> <strong>1. Conductor</strong></a></li>
                          <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-second"><strong>2. Vehículo</strong></a></li>
                          <li><a href="javascript:void(0)" data-gotostep="clickable-third"><strong>3. Documentos</strong></a></li>
                      </ul>
                  </div>
              </div>
              <!-- END Step Info -->';
                modificarVehiculoDocumentoFacade($fila['car_id']);
          echo'</div>
          <!-- END Second Step -->

          <!-- Third Step -->
          <div id="clickable-third" class="step">
              <!-- Step Info -->
              <div class="form-group">
                  <div class="col-xs-12">
                      <ul class="nav nav-pills nav-justified clickable-steps">
                          <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-check"></i> <strong>1. Conductor</strong></a></li>
                          <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-check"></i> <strong>2. Vehículo</strong></a></li>
                          <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-third"><strong>3. Documentos</strong></a></li>
                      </ul>
                  </div>
              </div>
              <!-- END Step Info -->
              <div class="form-group">
                  <div class="col-md-12" align=center>
                    <img src="../dis/img/documentos/'.$fila['documento1'].'" alt="foto_documento" id="documento1" width="300px" height="300px">
                  </div>
                  <div class="col-md-12" align=center>
                      <br>
                      <button type="button" name="button" onclick="girar0()">0º</button>
                      <button type="button" name="button" onclick="girar90()">90º</button>
                      <button type="button" name="button" onclick="girar180()">180º</button>
                      <button type="button" name="button" onclick="girar270()">270º</button>
                    </div>
                </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="foto_documento">Foto Documento</label>
                  <div class="col-md-5">
                      <input type="file" id="foto_documento" name="foto_documento" accept="image/*">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-12" align=center>
                    <img src="../dis/img/documentos/'.$fila['documento2'].'" alt="foto_licencia" id="documento2" width="300px" height="300px">
                  </div>
                  <div class="col-md-12" align=center>
                      <br>
                      <button type="button" name="button" onclick="girar02()">0º</button>
                      <button type="button" name="button" onclick="girar902()">90º</button>
                      <button type="button" name="button" onclick="girar1802()">180º</button>
                      <button type="button" name="button" onclick="girar2702()">270º</button>
                    </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="foto_licencia">Foto Licencia</label>
                  <div class="col-md-5">
                      <input type="file" id="foto_licencia" name="foto_licencia" accept="image/*">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-12" align=center>
                    <img src="../dis/img/documentos/'.$fila['documento3'].'" alt="foto_propiedad" id="documento3" width="300px" height="300px">
                  </div>
                  <div class="col-md-12" align=center>
                      <br>
                      <button type="button" name="button" onclick="girar03()">0º</button>
                      <button type="button" name="button" onclick="girar903()">90º</button>
                      <button type="button" name="button" onclick="girar1803()">180º</button>
                      <button type="button" name="button" onclick="girar2703()">270º</button>
                    </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="foto_propiedad">Foto Tarjeta Propiedad</label>
                  <div class="col-md-5">
                      <input type="file" id="foto_propiedad" name="foto_propiedad" accept="image/*">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-md-12" align=center>
                    <img src="../dis/img/documentos/'.$fila['documento4'].'" alt="foto_operacion" id="documento4" width="300px" height="300px">
                  </div>
                  <div class="col-md-12" align=center>
                      <br>
                      <button type="button" name="button" onclick="girar04()">0º</button>
                      <button type="button" name="button" onclick="girar904()">90º</button>
                      <button type="button" name="button" onclick="girar1804()">180º</button>
                      <button type="button" name="button" onclick="girar2704()">270º</button>
                    </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="foto_operacion">Foto Tarjeta Operación</label>
                  <div class="col-md-5">
                      <input type="file" id="foto_operacion" name="foto_operacion" accept="image/*">
                  </div>

              </div>
              <div class="form-group">
                  <label class="col-md-4 control-label">Estado</label>
                  <div class="col-md-5">
                      <label class="radio-inline" for="example-inline-radio1">
                          <input type="radio" id="example-inline-radio1" name="example-inline-radios" value="true"> Aceptado
                      </label>
                      <label class="radio-inline" for="example-inline-radio2">
                          <input type="radio" id="example-inline-radio2" name="example-inline-radios" value="false" checked> Pendiente
                      </label>
                      <label class="radio-inline" for="example-inline-radio3">
                          <input type="radio" id="example-inline-radio3" name="example-inline-radios" value="rechazado"> Rechazado
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-4 control-label" for="example-clickable-bio">Mensaje</label>
                  <div class="col-md-8">
                      <textarea id="example-clickable-bio" name="example-clickable-bio" rows="6" class="form-control" placeholder="Escriba el mensaje si es estado es pendiente o rechazado"></textarea>
                  </div>
              </div>
          </div>
          <!-- END Third Step -->

          <!-- Form Buttons -->
          <div class="form-group form-actions">
              <div class="col-md-8 col-md-offset-4">
                  <button type="reset" class="btn btn-sm btn-warning" id="back">Previous</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="next">Next</button>
              </div>
          </div>
          <!-- END Form Buttons -->
      </form>
      ';
      }
  }else{
    return header("Location: ../views/app/usuarioCms.php");
  }
}

function buscadorConductoresFacade($arg_campo, $arg_item, $arg_rol){

  $consulta = new Drivers();
  $consultaVehiculo = new Cars();
  $consultaDriveresCars = new DriversCars();

  $campo = $arg_campo;
  $item = $arg_item;

  $rol = $arg_rol;

  if ($campo == 'placa') {

    $placa = strtoupper($item);
    $idVehiculo = $consultaVehiculo->obtenerIdVehiculo($placa);
    $conductores = $consultaDriveresCars->obtenerConductroesXCarro($idVehiculo);
    echo'<table id="table-conductor" class="table table-bordered table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 80px;">ID</th>
                <th class="text-center">Disponible</th>
                <th class="text-center">Celular</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Placa</th>
                <th class="text-center">Email</th>
                <th class="text-center">F. Registro</th>
                <th class="text-center">F. Modif.</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>';
    if ($conductores != '' || $conductores != null) {

                foreach($conductores as $conductor){

                      $idConductor = $conductor['drivers_id'];
                      $flechas = $consulta->cargarConductor($idConductor);

                      foreach ($flechas as $flecha) {

                                $placa = $consultaVehiculo->buscarPlaca($flecha['car_id']);
                                $estado = $flecha['status'];
                                echo '<tr>
                                <td id="id_conductor" name ="" class="text-center">'.$flecha['id'].'</td>';
                                switch ($estado) {
                                  case 'true':
                                    echo '<td class="text-center"><span class="label label-success">Aceptado</span></td>';
                                    break;
                                    case 'false':
                                      echo '<td class="text-center"><span class="label label-warning">No Aceptado</span></td>';
                                      break;
                                      case 'nuevo':
                                        echo '<td class="text-center"><span class="label label-info">Nuevo</span></td>';
                                        break;
                                        case 'rechazado':
                                          echo '<td class="text-center"><span class="label label-danger">Rechazado</span></td>';
                                          break;
                                  default:
                                    # code...
                                    break;
                                }
                              echo '
                                <td id="" name ="" class="text-center">'.$flecha['cellphone'].'</td>
                                <td id="" name ="" class="text-center">'.$flecha['name'].' '.$flecha['lastname'].'</td>
                                <td id="" name ="" class="text-center">'.$placa.'</td>
                                <td id="" name ="" class="text-center">'.$flecha['email'].'</td>
                                <td id="" name ="" class="text-center">'.$flecha['created_at'].'</td>
                                <td id="" name ="" class="text-center">'.$flecha['updated_at'].'</td>
                                <td class="text-center">
                                      <div class="btn-group btn-group-xs">';
                                      if ($rol == 1 || $rol == 2 || $rol == 3) {
                                        echo '
                                        <a href="modificarconductor.php?id_conductor='.$flecha['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                                        <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Conductor"><i class="fa fa-times"></i></a>
                                        ';
                                      }else {
                                        echo '
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-info" id=""><i class="fa fa-lock"></i></a>
                                        ';
                                      }
                                      echo '
                                      </div>
                                  </td>

                                 </tr>';


                      }


                }
                echo '<!-- END Responsive Full Block -->
              </tbody>
              </table>
              <a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelDriversBuscadorController.php?campo='.$campo.'&&item='.$item.'" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
              <!-- END All Orders Content -->
              ';
    }else{
      header('Location: ../../views/mensajes/error_busqueda');
    }


  }else {
            $filas = $consulta->busquedaPersonalizadaConductor($campo, $item);

            echo'<table id="table-conductor" class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th class="text-center">Disponible</th>
                        <th class="text-center">Celular</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Placa</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">F. Registro</th>
                        <th class="text-center">F. Modif.</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>';
            foreach($filas as $fila){
              $placa = $consultaVehiculo->buscarPlaca($fila['car_id']);

              $estado = $fila['status'];
              echo '<tr>
              <td id="id_conductor" name ="" class="text-center">'.$fila['id'].'</td>';
              switch ($estado) {
                case 'true':
                  echo '<td class="text-center"><span class="label label-success">Aceptado</span></td>';
                  break;
                  case 'false':
                    echo '<td class="text-center"><span class="label label-warning">No Aceptado</span></td>';
                    break;
                    case 'nuevo':
                      echo '<td class="text-center"><span class="label label-info">Nuevo</span></td>';
                      break;
                      case 'rechazado':
                        echo '<td class="text-center"><span class="label label-danger">Rechazado</span></td>';
                        break;
                default:
                  # code...
                  break;
              }
            echo '
              <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
              <td id="" name ="" class="text-center">'.$fila['name'].' '.$fila['lastname'].'</td>
              <td id="" name ="" class="text-center">'.$placa.'</td>
              <td id="" name ="" class="text-center">'.$fila['email'].'</td>
              <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
              <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
              <td class="text-center">
                    <div class="btn-group btn-group-xs">';
                    if ($rol == 1 || $rol == 2) {
                      echo '
                      <a href="modificarconductor.php?id_conductor='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                      <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Conductor"><i class="fa fa-times"></i></a>
                      ';
                    }else {
                      echo '
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
          </table>
          <a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelDriversBuscadorController.php?campo='.$campo.'&&item='.$item.'" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
          <!-- END All Orders Content -->
          ';
  }

}

 ?>
