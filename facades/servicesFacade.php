<?php

function aniosContrato(){
  $anio = date('Y');
  $a = 2017;
  while ($a <= $anio) {
    echo '<option value="'.$a.'">'.$a.'</option>';
    $a = $a +1 ;
  }
}

  function listaServicioEsperaFacade(){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $filas = $consulta->todosServiciosEspera();
    echo '
    <div class="tab-pane active" id="espera">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';

    if (!$filas == null ) {
        foreach ($filas as $fila) {
          $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
          $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
          $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
          $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
          $marca = $consultaCarro->obtenerMarca($fila['car_id']);
          $linea = $consultaCarro->obtenerLinea($fila['car_id']);
          echo '
          <tr>
          <td id="" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
          <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
          <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
          <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
          <td id="" name ="" class="text-center">'.$fila['address'].'</td>


           </tr>
          ';
        }
    }else{
      echo '<h4>No existen registros</h4>';
    }


    echo '
          </tbody>
          </table>
        </div>
        </div>
    ';
  }

  function listaServicioXValeFacade($arg_campo, $arg_vale){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $campo = $arg_campo;
    $vale = $arg_vale;
    if ($campo == "car_id") {
      $placa = strtoupper($vale);
      $idVehiculo = $consultaCarro->obtenerIdVehiculo($placa);
      $filas = $consulta->obtenerServiciosXIdVehiculo($idVehiculo);
    }else {
      $filas = $consulta->obtenerServicioXVale($vale);
    }

    echo '
    <div class="tab-pane active" id="espera">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';

    if (!$filas == null ) {
        foreach ($filas as $fila) {
          $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
          $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
          $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
          $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
          $marca = $consultaCarro->obtenerMarca($fila['car_id']);
          $linea = $consultaCarro->obtenerLinea($fila['car_id']);
          echo '
          <tr>
          <td id="" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
          <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
          <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
          <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
          <td id="" name ="" class="text-center">'.$fila['address'].'</td>


           </tr>
          ';
        }
    }else{
      echo '<h4>No existen registros</h4>';
    }


    echo '
          </tbody>
          </table>
        </div>
        </div>
    ';
  }

  function listaServicioAsignadoFacade(){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $filas = $consulta->todosServiciosAsignado();

    echo '
    <div class="tab-pane" id="asignados">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';
    if ($filas > 0) {
      foreach ($filas as $fila) {
        $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
        $apellidoUsuario = $consultaUsuario->apellidoUsuario($fila['user_id']);
        $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
        $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
        $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
        $marca = $consultaCarro->obtenerMarca($fila['car_id']);
        $linea = $consultaCarro->obtenerLinea($fila['car_id']);
        echo '
        <tr>
        <td id="" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
        <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
        <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
        <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
        <td id="" name ="" class="text-center">'.$fila['address'].'</td>


         </tr>
        ';
      }
    }else {
      echo '<h4>No Hay registros</h4>';
    }


    echo '
          </tbody>
          </table>
        </div>
        </div>
    ';
  }

  function listaServicioFinalizadosFacade(){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $js = "$('#modal-finalizados').modal('show');";
    $filas = $consulta->todosServiciosFinalizado();

    echo '
    <div class="tab-pane" id="finalizados">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="table-finalizados" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';
    if ($filas > 0) {
      foreach ($filas as $fila) {
        $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
        $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
        $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
        $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
        $marca = $consultaCarro->obtenerMarca($fila['car_id']);
        $linea = $consultaCarro->obtenerLinea($fila['car_id']);
        echo '
        <tr>
        <td id="" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
        <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
        <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
        <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['qualification'].' <i class="fa fa-star"></i></td>
        <td id="" name ="" class="text-center">'.$fila['address'].'</td>


         </tr>
        ';
      }
    }else {
      echo '<tr>No Hay registros</tr>';
    }


    echo '
          </tbody>
          </table>
          <a id="reporteExcel" onclick='.$js.' data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
        </div>
        </div>
    ';
  }

  function listaServicioCanceladoSistemaFacade(){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $jsistema = "$('#modal-sistema').modal('show');";
    $filas = $consulta->todosServiciosCanceladoSistemaLista();
    echo '
    <div class="tab-pane" id="sistema">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="table-sistema" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';
    if ($filas > 0) {
      foreach ($filas as $fila) {
        $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
        $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
        $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
        $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
        $marca = $consultaCarro->obtenerMarca($fila['car_id']);
        $linea = $consultaCarro->obtenerLinea($fila['car_id']);
        echo '
        <tr>
        <td id="" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
        <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
        <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
        <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
        <td id="" name ="" class="text-center">'.$fila['address'].'</td>


         </tr>
        ';
      }
    }else{
      echo "<h4>No hay registros</h4>";
    }


    echo '
          </tbody>
          </table>
          <a id="reporteExcel" onclick='.$jsistema.' data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
        </div>
        </div>
    ';
  }

  function listaServicioCanceladoConductorFacade(){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $filas = $consulta->todosServiciosCanceladoConductor();
    $jsconductor = "$('#modal-conductor').modal('show');";
    echo '
    <div class="tab-pane" id="conductor">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="table-conductor" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';
    if ($filas > 0) {
      foreach ($filas as $fila) {
        $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
        $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
        $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
        $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
        $marca = $consultaCarro->obtenerMarca($fila['car_id']);
        $linea = $consultaCarro->obtenerLinea($fila['car_id']);
        echo '
        <tr>
        <td id="" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
        <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
        <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
        <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
        <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
        <td id="" name ="" class="text-center">'.$fila['address'].'</td>


         </tr>
        ';
      }
    }else {
      echo "<h4>No Hay registros</h4>";
    }


    echo '
          </tbody>
          </table>
          <a id="reporteExcel" onclick='.$jsconductor.' data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
        </div>
        </div>
    ';
  }

  function listaServicioCanceladoOperadorFacade(){
    $consulta = new Services();
    $consultaUsuario = new CmsUsers();
    $consultaConductor = new Drivers();
    $consultaCarro = new Cars();
    $filas = $consulta->todosServiciosOperadora();
    $jsoperador = "$('#modal-operador').modal('show');";
    echo '
    <div class="tab-pane" id="operador">
        <!-- Intro Category -->
        <div class="table-responsive remove-margin-bottom">
        <table id="table-operador" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Conductor</th>
                    <th class="text-center">Vehículo</th>
                    <th class="text-center">Solicitud</th>
                    <th class="text-center">Finalización</th>
                    <th class="text-center">Calificación</th>
                    <th class="text-center">Dirección</th>
                </tr>
            </thead>
            <tbody>
    ';
    if ($filas > 0) {
        foreach ($filas as $fila) {
          $nombreUsuario = $consultaUsuario->nombreUsuarioApp($fila['user_id']);
          $nombreConductor = $consultaConductor->nombreConductor($fila['driver_id']);
          $apellidoConductor = $consultaConductor->apellidoConductor($fila['driver_id']);
          $placa = $consultaCarro->obtenerPlacas($fila['car_id']);
          $marca = $consultaCarro->obtenerMarca($fila['car_id']);
          $linea = $consultaCarro->obtenerLinea($fila['car_id']);
          echo '
          <tr>
          <td id="" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
          <td id="" name ="" class="text-center">'.$nombreConductor.' '.$apellidoConductor.'</td>
          <td id="" name ="" class="text-center">'.$placa.' '.$marca.' '.$linea.'</td>
          <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
          <td id="" name ="" class="text-center">'.$fila['address'].'</td>


           </tr>
          ';
        }
    }else{
      echo "<h4>No Hay registros</h4>";
    }

    echo '
          </tbody>
          </table>
            <a id="reporteExcel" onclick='.$jsoperador.' data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
        </div>
        </div>
    ';
  }

  function direccionesUserDirFacade($arg_idUser){
    $idUser = $arg_idUser;
    $consulta = new Users();
    $consultaDir = new UsersDirs();
    $filas = $consultaDir->todasDireccionesUserUso($idUser);

    echo '
    <div class="block">
      <div class="block-title">
        <h2><strong>Direcciones </strong></h2>
      </div>
      <div class="table-responsive remove-margin-bottom">
      <table id="table-direcciones" class="table table-vcenter table-condensed table-bordered">
          <thead>
              <tr>
                  <th class="text-center">Direccion</th>
                  <th class="text-center">Barrio</th>
                  <th class="text-center">Accion</th>
              </tr>
          </thead>
          <tbody>';
      if ($filas > 0) {
        foreach($filas as $fila){
          $direccion = $fila['index_id'].' '.$fila['comp1'].' #'.$fila['comp2'].'-'.$fila['no'];
          echo '
          <tr>
          <td id="idDireccion" name ="id" class="text-center" style="display: none">'.$fila['id'].'</td>
          <td id="direccionGuardada" name ="direccionGuardada" class="text-center">'.$direccion.'</td>
          <td id="barrioGuadado" name ="barrioGuadado" class="text-center">'.$fila['barrio'].'</td>
          <td class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="direccion" name="direccion" data-toggle="tooltip" title="Seleccionar" class="btn btn-default" ><i class="fa fa-check"></i></a>
                </div>
            </td>
           </tr>
          ';
        }
      }else {
        echo "El teléfono no tiene direcciones asociadas";
      }

    echo'
    </tbody>
    </table>
    </div>
    </div>
    ';

  }

  function tablaServiciosFacade(){
    $consulta = new Services();
    $consultaUsers = new Users();
    $filas = $consulta->tablaServicios();
    echo'<table id="table-servicio-vivo" class="table table-bordered table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 80px;">ID</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>';

    if ($filas > 0) {
      foreach($filas as $fila){
        $idFlecha = $fila['user_id'];
        $estado = $fila['status_id'];
        $nombre = $consultaUsers->obtenerNombre($idFlecha);
        $telefono = $consultaUsers->obtenerTelefono($idFlecha);
        $celular = $consultaUsers->obtenerCelular($idFlecha);

        echo '
        <td id="" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
        <td id="" name ="" class="text-center">'.$fila['address'].'</td>';
        if ($telefono != "null") {
          echo '<td id="" name ="" class="text-center">'.$telefono.'</td>';
        }else{
          echo '<td id="" name ="" class="text-center">'.$celular.'</td>';
        }
        switch ($estado) {
          case '1':
            echo '<td id="" name ="" class="text-center">En espera</td>';
            break;
            case '2':
            echo '<td id="" name ="" class="text-center">Asignado</td>';
            break;
            case '3':
            echo '<td id="" name ="" class="text-center">Conductor Espera</td>';
            break;
            case '4':
            echo '<td id="" name ="" class="text-center">Progreso</td>';
            break;
            case '5':
            echo '<td id="" name ="" class="text-center">Finalizado</td>';
            break;
            case '6':
            echo '<td id="" name ="" class="text-center">Cancelado</td>';
            break;
            case '7':
            echo '<td id="" name ="" class="text-center">Canc sistema</td>';
            break;
            case '8':
            echo '<td id="" name ="" class="text-center">Canc conductor</td>';
            break;
            case '9':
            echo '<td id="" name ="" class="text-center">Canc operadora</td>';
            break;

          default:
            # code...
            break;
        }
        echo'<td class="text-center">
              <div class="btn-group btn-group-xs">
                  <a href="modificarconductor.php?id_conductor='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                  <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
              </div>
          </td>

         </tr>';
      }

    }else{
      echo "No hay servicios";
    }
    echo'
    </tbody>
    </table>

    ';
  }

  function tablaServiciosUserCmsFacade($arg_id){
    $consulta = new Services();
    $consultaUsers = new Users();
    $id = $arg_id;
    $js = "$('#modal-services').modal('show');";
    $filas = $consulta->tablaServiciosXUsuario($id);
    echo'<table id="table-servicio-vivo" class="table table-bordered table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 80px;">ID</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Teléfono</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>';

    if ($filas > 0) {
      foreach($filas as $fila){
        $idFlecha = $fila['user_id'];
        $estado = $fila['status_id'];
        $nombre = $consultaUsers->obtenerNombre($idFlecha);
        $telefono = $consultaUsers->obtenerTelefono($idFlecha);
        $celular = $consultaUsers->obtenerCelular($idFlecha);

        echo '
        <td id="idservicio" name ="id" class="text-center">'.$fila['id'].'</td>
        <td id="idnombre" name ="nombre" class="text-center">'.$fila['user_name'].'</td>
        <td id="idaddres" name ="direccion" class="text-center">'.$fila['address'].'</td>';
        if ($telefono != "null") {
          echo '<td id="idtelefono" name ="telefono" class="text-center">'.$telefono.'</td>';
        }else{
          echo '<td id="idtelefono" name ="telefono" class="text-center">'.$celular.'</td>';
        }
        switch ($estado) {
          case '1':
            echo '<td id="idestado" name ="estado" class="text-center">En espera</td>';
            break;
            case '2':
            echo '<td id="idestado" name ="estado" class="text-center"><span class="label label-warning animation-pulse">Asignado</span></td>';
            break;
            case '3':
            echo '<td id="idestado" name ="estado" class="text-center">Conductor Espera</td>';
            break;
            case '4':
            echo '<td id="idestado" name ="estado" class="text-center">Progreso</td>';
            break;
            case '5':
            echo '<td id="idestado" name ="estado" class="text-center">Finalizado</td>';
            break;
            case '6':
            echo '<td id="idestado" name ="estado" class="text-center">Cancelado</td>';
            break;
            case '7':
            echo '<td id="idestado" name ="estado" class="text-center">Canc sistema</td>';
            break;
            case '8':
            echo '<td id="idestado" name ="estado" class="text-center">Canc conductor</td>';
            break;
            case '9':
            echo '<td id="idestado" name ="estado" class="text-center">Canc operadora</td>';
            break;

          default:
            # code...
            break;
        }
        echo'<td class="text-center">
              <div class="btn-group btn-group-xs">
                  <!--<a href="modificarcservicio?id_servicios='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>-->
                  <a href="" data-toggle="tooltip" title="Editar" id="btn-editar" class="btn btn-default" onclick='.$js.'><i class="fa fa-info-circle"></i></a>
                  <a href="" data-toggle="tooltip" title="Cancelar" id="cancelar_servicio" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
              </div>
          </td>

         </tr>';
      }

    }else{
      echo "No hay servicios";
    }
    echo'
    </tbody>
    </table>

    ';
  }

  function listServices($arg_idCompania){
    $consulta = new Services();
    $idCompania =  $arg_idCompania;
    $filas = $consulta->todosServiciosCompania($idCompania);
    foreach ($filas as $fila) {
      echo '<tr>
      <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>
      <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
      <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
      <td id="" name ="" class="text-center">'.$fila['address'].'</td>
      <td id="" name ="" class="text-center">'.$fila['units'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
      <td id="" name ="" class="text-center">'.$fila['value'].'</td>
      <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
      <td id="" name ="" class="text-center">'.$fila['destination'].'</td>
      <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
       </tr>';
    }

}

function listServicesAdministradorMes($arg_idCompania, $arg_mes, $arg_year){
  $consulta = new Services();
  //$prefijo = $consulta->prefijo($arg_idCc);
  $idCompania = $arg_idCompania;
  $mes = $arg_mes;
  $year = $arg_year;
  $filas = $consulta->todosServiciosAdministradorMesXAnio($idCompania, $mes, $year);
  foreach ($filas as $fila) {
    $dato1 = $fila['index_id'];
    $dato2 = $fila['comp1'];
    $dato3 = $fila['comp2'];
    $dato4 = $fila['no'];
    $dato5 = $fila['obs'];

    $direccion = $dato1.$dato2.' #'.$dato3.' - '.$dato4.' '.$dato5;
    echo '<tr>
    <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
    <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
    <td id="" name ="" class="text-center">'.$fila['address'].'</td>
    <td id="" name ="" class="text-center">'.$fila['units'].'</td>
    <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
    <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
    <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
    <td id="" name ="" class="text-center">'.$fila['value'].'</td>
    <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
    <td id="" name ="" class="text-center">'.$fila['destination'].'</td>
    <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
     </tr>';
  }


}

function listServicesManager($arg_idCc){
  $consulta = new Services();
  $prefijo = $consulta->prefijo($arg_idCc);

  $filas = $consulta->todosServiciosMangerMes($prefijo);
  foreach ($filas as $fila) {
    echo '<tr>
    <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
    <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
    <td id="" name ="" class="text-center">'.$fila['units'].'</td>
    <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
    <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
    <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
    <td id="" name ="" class="text-center">'.$fila['value'].'</td>
    <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
    <td id="" name ="" class="text-center">'.$fila['destination'].'</td>
     </tr>';
  }


}

function listServicesManagerMes($arg_idCc, $arg_mes, $arg_year){
  $consulta = new Services();
  $prefijo = $consulta->prefijo($arg_idCc);
  $mes = $arg_mes;
  $year = $arg_year;
  $filas = $consulta->todosServiciosMangerMes($prefijo, $mes, $year);

  if ($filas == '' || $filas == null) {
    echo '<h4>No hay servicios registrados para este centro de costos este mes.</h4>';
  }else{
    foreach ($filas as $fila) {

      echo '<tr>
      <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>
      <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
      <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
      <td id="" name ="" class="text-center">'.$fila['address'].'</td>
      <td id="" name ="" class="text-center">'.$fila['units'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
      <td id="" name ="" class="text-center">'.$fila['value'].'</td>
      <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
      <td id="" name ="" class="text-center">'.$fila['address'].'</td>
      <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
       </tr>';
    }

  }



}

function listaServicioParaPagosFacade($arg_empresa){

  $consulta = new Services();
  $empresa = $arg_empresa;
  $filas = $consulta->listaServiciosParaPagosSinPagar($empresa);
  $modal = "$('#modal-info-pagos').modal('show');";

  echo '
  <div class="tab-pane" id="asignados">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
          <thead>
              <tr>
                  <th class="hidden">ID</th>
                  <th class="text-center">Usuario</th>
                  <th class="text-center">Fecha</th>
                  <th class="text-center">Dirección</th>
                  <th class="text-center">Conductor</th>
                  <th class="text-center">Cond CC.</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Placa</th>
                  <th class="text-center">Vale</th>
                  <th class="text-center">Unit</th>
                  <th class="text-center">Aero</th>
                  <th class="text-center">Noct</th>
                  <th class="text-center">Mens</th>
                  <th class="text-center">PP</th>
                  <th class="text-center">Valor</th>
                  <th class="text-center">Fecha Pago</th>
                  <th class="text-center">Acciones</th>
                  <th class="text-center">Seleccion</th>
              </tr>
          </thead>
          <tbody>
  ';
  if ($filas > 0) {
    foreach ($filas as $fila) {
      $placa = strtoupper($fila['placa']);
      $nombreCond = $fila['name'];
      $apellidoCond = $fila['lastname'];

      if($apellidoCond != '' || $apellidoCond != null){
        $conductor = "$nombreCond $apellidoCond";
      }else{
        $conductor = "$nombreCond";
      }

      $pago = $fila['state_payment'];

      if ($pago == 0 || $pago == null) {
        $pay = '<span class="label label-danger">Sin Pagar</span>';
      }else {
        $pay = '<span class="label label-success">Pagado</span>';
      }

      echo '
      <tr>
      <td id="id_server" name ="" class="hidden">'.$fila['id'].'</td>
      <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
      <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
      <td id="" name ="" class="text-center">'.$fila['address'].'</td>
      <td id="" name ="" class="text-center">'.strtoupper($conductor).'</td>
      <td id="" name ="" class="text-center">'.$fila['cedula'].'</td>
      <td id="" name ="" class="text-center">'.$pay.'</td>
      <td id="" name ="" class="text-center">'.$placa.'</td>
      <td id="" name ="" class="text-center">'.$fila['user_card_reference'].'</td>
      <td id="" name ="" class="text-center">'.$fila['units'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge3'].'</td>
      <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
      <td id="" name ="" class="text-center">'.$fila['value'].'</td>
      <td id="" name ="" class="text-center">'.$fila['date_state_payment'].'</td>
      <td class="text-center">
            <div class="btn-group btn-group-xs">';
              if($pago == 0 || $pago == null){
                echo '
                <a href="pagar?serv='.$fila['id'].'&&empresa='.$empresa.'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" onclick="'.$modal.'" data-toggle="tooltip" title="Ver" class="btn btn-xs btn-info" id="ser_info"><i class="fa fa-info"></i></a>
                ';
              }else {
                echo '
                  <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-default" id=""><i class="fa fa-lock"></i></a>
                  <a href="javascript:void(0)" onclick="'.$modal.'" data-toggle="tooltip" title="Ver" class="btn btn-xs btn-info" id="ser_info"><i class="fa fa-info"></i></a>
                ';
              }
    echo'
            </div>
        </td>
        <th style="width: 80px;" class="text-center"><input type="checkbox" id="checkbox-1[]" name="checkbox-1[]" value="'.$fila['id'].'"></th>



       </tr>
      ';
    }
  }else {
    echo '<h4>No Hay registros</h4>';
  }


  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function listaServicioParaPagosBusquedaFacade($arg_empresa, $arg_campo, $arg_frase){

  $consulta = new Services();
  $empresa = $arg_empresa;
  $campo = $arg_campo;
  $frase = $arg_frase;
  $filas = $consulta->BusquedaServiciosParaPagos($empresa, $campo, $frase);
  $modal = "$('#modal-info-pagos').modal('show');";

  echo '
  <div class="tab-pane" id="asignados">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
          <thead>
              <tr>
              <th class="hidden">ID</th>
              <th class="text-center">Usuario</th>
              <th class="text-center">Fecha</th>
              <th class="text-center">Dirección</th>
              <th class="text-center">Conductor</th>
              <th class="text-center">Cond CC.</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Vale</th>
              <th class="text-center">Unit</th>
              <th class="text-center">Aero</th>
              <th class="text-center">Noct</th>
              <th class="text-center">Mens</th>
              <th class="text-center">PP</th>
              <th class="text-center">Valor</th>
              <th class="text-center">Fecha Pago</th>
              <th class="text-center">Acciones</th>
              <th class="text-center">Seleccion</th>
              </tr>
          </thead>
          <tbody>
  ';
  if ($filas > 0) {
    foreach ($filas as $fila) {
      $placa = strtoupper($fila['placa']);
      $nombreCond = $fila['name'];
      $apellidoCond = $fila['lastname'];

      if($apellidoCond != '' || $apellidoCond != null){
        $conductor = "$nombreCond $apellidoCond";
      }else{
        $conductor = "$nombreCond";
      }

      $pago = $fila['state_payment'];

      if ($pago == 0 || $pago == null) {
        $pay = '<span class="label label-danger">Sin Pagar</span>';
      }else {
        $pay = '<span class="label label-success">Pagado</span>';
      }

      echo '
      <tr>
          <td id="id_server" name ="" class="hidden">'.$fila['id'].'</td>
          <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
          <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['address'].'</td>
          <td id="" name ="" class="text-center">'.strtoupper($conductor).'</td>
          <td id="" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="" name ="" class="text-center">'.$pay.'</td>
          <td id="" name ="" class="text-center">'.$placa.'</td>
          <td id="" name ="" class="text-center">'.$fila['user_card_reference'].'</td>
          <td id="" name ="" class="text-center">'.$fila['units'].'</td>
          <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
          <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
          <td id="" name ="" class="text-center">'.$fila['charge3'].'</td>
          <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
          <td id="" name ="" class="text-center">'.$fila['value'].'</td>
          <td id="" name ="" class="text-center">'.$fila['date_state_payment'].'</td>
      <td class="text-center">
            <div class="btn-group btn-group-xs">';
              if($pago == 0 || $pago == null){
                echo '
                <a href="pagar?serv='.$fila['id'].'&&empresa='.$empresa.'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" onclick="'.$modal.'" data-toggle="tooltip" title="Ver" class="btn btn-xs btn-info" id="ser_info"><i class="fa fa-info"></i></a>
                ';
              }else {
                echo '
                  <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-default" id=""><i class="fa fa-lock"></i></a>
                  <a href="javascript:void(0)" onclick="'.$modal.'" data-toggle="tooltip" title="Ver" class="btn btn-xs btn-info" id="ser_info"><i class="fa fa-info"></i></a>
                ';
              }
    echo'
            </div>
        </td>';
        if ($pago == 0 || $pago == null) {
          echo '<th style="width: 80px;" class="text-center"><input type="checkbox" id="checkbox-1[]" name="checkbox-1[]" value="'.$fila['id'].'"></th>';
        }else {
          echo '<th style="width: 80px;" class="text-center"><a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-default" id=""><i class="fa fa-lock"></i></a></th>';
        }

    echo    '

       </tr>
      ';
    }
  }else {
    echo '<h4>No Hay registros</h4>';
  }


  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function formularioPagoFacade($arg_servicio, $arg_empresa, $arg_valorUnidades){

  $consulta = new Services();

  $idServicio = $arg_servicio;
  $empresa = $arg_empresa;
  $valorUnidades = $arg_valorUnidades;

  $filas = $consulta->cargarServiciosParaPagos($empresa, $idServicio);

  foreach($filas as $fila){
    $placa = strtoupper($fila['placa']);
    $nombreCond = $fila['name'];
    $apellidoCond = $fila['lastname'];

    if($apellidoCond != '' || $apellidoCond != null){
      $conductor = "$nombreCond $apellidoCond";
    }else{
      $conductor = "$nombreCond";
    }

    $aeropuerto = $fila['charge1'];
    if ($aeropuerto == NULL) {
      $recargoAeropuero = 0;
    }else {
      $recargoAeropuero = $aeropuerto;
    }

    $nocturno = $fila['charge2'];
    if ($nocturno == NULL) {
      $recargoNocturno = 0;
    }else {
      $recargoNocturno = $nocturno;
    }
    $mensajeria = $fila['charge3'];

    if ($mensajeria == NULL) {
      $recargoMensajeria = 0;
    }else{
      $recargoMensajeria = $mensajeria;
    }
    $puertaPuerta = $fila['charge4'];

    if ($puertaPuerta == NULL) {
      $recargoPp = 0;
    }else {
      $recargoPp = $puertaPuerta;
    }

    echo '
    <form id="form-pago" action="../../controllers/app/vales/modificarPagoController.php" method="post" class="form-horizontal form-bordered">
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
            <input type="text" id="unidades" name="unidades" class="form-control" value="'.$fila['units'].'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="unidades_valor" name="unidades_valor" class="form-control" value="'.$valorUnidades.'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="aeropuerto">Aeropuerto<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="aeropuerto" name="aeropuerto" class="form-control" value="'.$recargoAeropuero.'">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="nocturno">Nocturno<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="nocturno" name="nocturno" class="form-control" value="'.$recargoNocturno.'">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="mensajeria">Mensajeria<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="mensajeria" name="mensajeria" class="form-control" value="'.$recargoMensajeria.'">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="pp">Puerta a Puerta<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="pp" name="pp" class="form-control" value="'.$recargoPp.'">
          </div>
          <div class="col-md-6">
            <input type="hidden" id="empresa" name="empresa" class="form-control" value="'.$empresa.'">
          </div>
        </div>';

      echo '<div class="form-group">
          <label class="col-md-4 control-label" for="valor">Valor<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="valor" name="valor" class="form-control" value="'.$fila['value'].'">
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

function facturaFacade($arg_nPago, $arg_servicios, $arg_empresa){
  setlocale(LC_MONETARY, 'en_US');
  $consulta = new Services();
  $nPago = $arg_nPago;
  $servicios = $arg_servicios;
  $empresa = $arg_empresa;

  $total = 0;
if ($servicios != NULL) {
  foreach ($servicios as $servicio) {
    $filas = $consulta->cargarServicio($servicio);
    foreach ($filas as $fila) {
      $idServicio = $fila['id'];
      $direccion = $fila['address'];
      $fecha = $fila['created_at'];
      $vale = $fila['user_card_reference'];
      $unidades = $fila['units'];
      $valor = $fila['value'];
      $total = $total + $valor;

      if ($unidades == NULL) {
        $unid = "N/A";
      }else {
        $unid = $unidades;
      }

      echo  '
      <tr>
          <td class="text-center">'.$idServicio.'</td>
          <td>
              <h4>'.$direccion.'</h4>
              <span class="label label-info"><i class="fa fa-clock-o"></i>'.$fecha.'</span>
          </td>
          <td class="text-center"><strong> <span class="badge">'.$vale.'</span></strong></td>
          <td class="text-center"><strong> '.$unid.'</strong></td>
          <td class="text-right"><span class="label label-primary">$ '.$valor.'</span></td>
      </tr>
      ';
    }
  }
  $descuento = $total * 4 / 100;
  $pagar = $total - $descuento;
  echo '
  <tr class="active">
      <td colspan="4" class="text-right"><span class="h4">SUBTOTAL</span></td>
      <td class="text-right"><span class="h4">$ '.$total.'</span></td>
  </tr>
  <tr class="active">
      <td colspan="4" class="text-right"><span class="h4">ADMINISTRACION</span></td>
      <td class="text-right"><span class="h4">4%</span></td>
  </tr>
  <tr class="active">
      <td colspan="4" class="text-right"><span class="h4">DESCUENTO</span></td>
      <td class="text-right"><span class="h4">$ '.$descuento.'</span></td>
  </tr>
  <tr class="active">
      <td colspan="4" class="text-right"><span class="h3"><strong>TOTAL PAGAR</strong></span></td>
      <td class="text-right"><span class="h3"><strong>$ '.$pagar.'</strong></span></td>
  </tr>
  ';


}else {
  echo '<h4>No Selecciono servicios, De click en el boton para regresar   <a class="btn btn-primary" href="busquedaPagos?empresa='.$empresa.'">Volver</a></h4> ';
}






}



 ?>
