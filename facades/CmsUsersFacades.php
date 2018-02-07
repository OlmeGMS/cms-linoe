<?php

function listaUsuariosCmsTodos(){
  $consulta = new CmsUsers();
  $filas = $consulta->todosUsuariosOperador();
  $rolUsuario = $fila['role_id'];
  echo '<table id="table-usuarios" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Email</th>
              <th class="text-center">Cedula</th>
              <th class="text-center">Rol</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
  foreach($filas as $fila){
    echo '
    <tr>
        <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>';
        switch ($rolUsuario ) {
          case '1':
            echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-info">Super</span></td>';
            break;
            case '2':
              echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-success">Administrador</span></td>';
              break;
              case '3':
                echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-warning">Operador</span></td>';
                break;
                case '4':
                  echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-Danger">Pagos</span></td>';
                  break;
                  case '5':
                    echo'<td id="email_usuario" name ="" class="text-center"><span class="label" style="background: #503ce7;">Cliente</span></td>';
                    break;
                    case '6':
                      echo'<td id="email_usuario" name ="" class="text-center"><span class="label" style="background: #503ce7;">Ministerio</span></td>';
                      break;

          default:
            # code...
            break;
        }

      echo  '<td id="accion" class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
              </div>
          </td>

     </tr>';
  }

  echo '  <!-- END Responsive Full Block -->
  </tbody>
</table>
<a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelUsurioCmsController.php" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
<a id="reportePDF" href="../../controllers/app/reportes/pdf/reportePdfUsuariosCmsCotrollers.php" data-toggle="tooltip" title="PDF" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>
<!-- END All Orders Content -->';
}

function listaUsuariosCms(){
  $consulta = new CmsUsers();
  $filas = $consulta->todosUsuariosOperadorEstado();
  echo '<table id="table-usuarios" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 100px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Email</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
  foreach($filas as $fila){
    echo '
    <tr>
        <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
        <td id="accion" class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
              </div>
          </td>

     </tr>';
  }

  echo '  <!-- END Responsive Full Block -->
  </tbody>
</table>
<a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelUsurioCmsController.php" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
<a id="reportePDF" href="../../controllers/app/reportes/pdf/reportePdfUsuariosCmsCotrollers.php" data-toggle="tooltip" title="PDF" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>
<!-- END All Orders Content -->';
}

function listaUsuariosApp(){
  $consulta = new CmsUsers();
  $filas = $consulta->todosUsuariosApp();
  foreach($filas as $fila){
    echo '<tr>
    <td id="" name ="" class="text-center">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['name'].'</td>
    <td id="" name ="" class="text-center">'.$fila['email'].'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">
              <a href="modificarUsuarioCliente.php?id_client='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
              <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
          </div>
      </td>

     </tr>';
  }
}

function modificarUsuarioCmsFacade($arg_idUsuarioCms){
  if (isset($_GET['id_operador'])) {
    $consulta = new CmsUsers();
    $consultaRol = new CmsRoles();
    $idUsuarioCms = $arg_idUsuarioCms;
    $filas = $consulta->cargarUsuarioCms($idUsuarioCms );
    foreach($filas as $fila){
      $nombreRol = $consultaRol->nombreRol($fila['role_id']);

      echo '
      <form id="form-validation" action="../../controllers/app/modificarUsuarioCmsController.php" method="post" class="form-horizontal form-bordered">
        <fieldset>
          <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="idUsuario" name="idUsuario" class="form-control" value="'.$idUsuarioCms.'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="Documento">Documento<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="Documento" id="Documento" name="Documento" class="form-control" value="'.$fila['cedula'].'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="email" id="email" name="email" class="form-control" value="'.$fila['email'].'">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="rol">Rol del Usuario<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <select type="text" id="rol" name="rol" class="form-control" placeholder="">
                <option value="'.$fila['role_id'].'" selected disabled>'.$nombreRol.'</option>';
                echo listaRolesTodoFacade();
          echo    '</select>
            </div>
          </div>

          <div class="form-group ">
            <div class="col-md-8 col-md-offset-4">
              <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Editar usuario</button>
            </div>
          </div>
        </fieldset>
      </form>
      ';
    }

  }else{
    return header("Location: ../views/administrador/usuarioCms.php");
  }
}

function modificarUsuarioAppFacade($arg_idUsuarioApp){
  if (isset($_GET['id_client'])) {
    $consulta = new CmsUsers();
    $idUsuarioApp = $arg_idUsuarioApp;
    $filas = $consulta->cargarUsuarioApp($idUsuarioApp);
    foreach($filas as $fila){
      echo '
      <form id="form-validation" action="../../controllers/app/modificarUsuarioAppController.php" method="post" class="form-horizontal form-bordered">
        <fieldset>
          <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="idUsuario" name="idUsuario" class="form-control" value="'.$idUsuarioApp.'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="Documento">Documento<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="Documento" id="Documento" name="Documento" class="form-control" value="'.$fila['cedula'].'">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="email" id="email" name="email" class="form-control" value="'.$fila['email'].'">
            </div>
          </div>

          <div class="form-group ">
            <div class="col-md-8 col-md-offset-4">
              <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Editar usuario</button>
            </div>
          </div>
        </fieldset>
      </form>
      ';
    }

  }else{
    return header("Location: ../views/administrador/usuarioCms.php");
  }
}

function tablaSuperAministradorFacade(){
  $consulta = new CmsUsers();
  $filas = $consulta->listaSuperAdministradores();
  echo '
  <div class="tab-pane active" id="superadministrador">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="table-super" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 100px;">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Cedula</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';
  if (!(empty($filas))) {
    foreach($filas as $fila){
      echo '
      <tr>
          <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="email_usuario" name ="" class="text-center"><span class="label label-info">super</span></td>
          <td id="accion" class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>-->
                </div>
            </td>

       </tr>';
    }
  }else{
    echo '<h4>No hay registros</h4>';
  }
  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function tablaAdministradorFacade(){
  $consulta = new CmsUsers();
  $filas = $consulta->listaAdministradores();
  echo '
  <div class="tab-pane" id="administrador">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="table-admin" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 100px;">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Cedula</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';
  if (!(empty($filas))) {
    foreach($filas as $fila){
      echo '
      <tr>
          <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="email_usuario" name ="" class="text-center"><span class="label label-success">administrador</span></td>
          <td id="accion" class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                  <!--  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a> -->
                </div>
            </td>

       </tr>';
    }
  }else{
    echo '<h4>No hay registros</h4>';
  }
  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function tablaOperadoresFacade(){
  $consulta = new CmsUsers();
  $filas = $consulta->listaOperadora();
  echo '
  <div class="tab-pane" id="operadores">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="table-operador" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 100px;">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Cedula</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';
  if (!(empty($filas))) {
    foreach($filas as $fila){
      echo '
      <tr>
          <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="email_usuario" name ="" class="text-center"><span class="label label-warning">Operador</span></td>
          <td id="accion" class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
                </div>
            </td>

       </tr>';
    }
  }else{
    echo '<h4>No hay registros</h4>';
  }
  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function tablaPagosFacade(){
  $consulta = new CmsUsers();
  $filas = $consulta->listaPagos();
  echo '
  <div class="tab-pane" id="pagos">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="table-pagos" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 100px;">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Cedula</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';
  if (!(empty($filas))) {
    foreach($filas as $fila){
      echo '
      <tr>
          <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="email_usuario" name ="" class="text-center"><span class="label label-danger">Pagos</span></td>
          <td id="accion" class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
                </div>
            </td>

       </tr>';
    }
  }else{
    echo '<h4>No hay registros</h4>';
  }
  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function tablaClientesFacade(){
  $consulta = new CmsUsers();
  $filas = $consulta->listaClientes();
  echo '
  <div class="tab-pane" id="cliente">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="table-cliente" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 100px;">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Cedula</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';
  if (!(empty($filas))) {
    foreach($filas as $fila){
      echo '
      <tr>
          <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="email_usuario" name ="" class="text-center"><span class="label" style="background: #503ce7;">'.$fila['role'].'</span></td>
          <td id="accion" class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
                </div>
            </td>

       </tr>';
    }
  }else{
    echo '<h4>No hay registros</h4>';
  }
  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function tablaMinisterioFacade(){
  $consulta = new CmsUsers();
  $filas = $consulta->listaMinisterio();
  echo '
  <div class="tab-pane" id="ministerio">
      <!-- Intro Category -->
      <div class="table-responsive remove-margin-bottom">
      <table id="table-ministerio" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 100px;">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Cedula</th>
                  <th class="text-center">Rol</th>
                  <th class="text-center">Acción</th>
              </tr>
          </thead>
          <tbody>
  ';
  if (!(empty($filas))) {
    foreach($filas as $fila){
      echo '
      <tr>
          <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
          <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
          <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>
          <td id="email_usuario" name ="" class="text-center"><span class="label" style="background: #ef790c;">Ministerio</span></td>
          <td id="accion" class="text-center">
                <div class="btn-group btn-group-xs">
                    <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                    <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
                </div>
            </td>

       </tr>';
    }
  }else{
    echo '<h4>No hay registros</h4>';
  }
  echo '
        </tbody>
        </table>
      </div>
      </div>
  ';
}

function tablaUsuariosCmsTabsFacade(){
  echo '
  <div class="block-title">
      <ul class="nav nav-tabs" data-toggle="tabs">
          <li class="active"><a href="#superadministrador">SuperAministrador</a></li>
          <li><a href="#administrador">Administradores</a></li>
          <li><a href="#operadores">Operadores</a></li>
          <li><a href="#pagos">Pagos</a></li>
          <li><a href="#cliente">Clientes</a></li>
          <li><a href="#ministerio">Ministerio</a></li>
      </ul>
  </div>
  <div class="tab-content">';
  tablaSuperAministradorFacade();
  tablaAdministradorFacade();
  tablaOperadoresFacade();
  tablaPagosFacade();
  tablaClientesFacade();
  tablaMinisterioFacade();
echo  '</div>
  ';
}

function listaUsuariosCmsTodosBusqueda($arg_item, $arg_frase){
  $consulta = new CmsUsers();
  $item = $arg_item;
  $frase = $arg_frase;
  $filas = $consulta->busquedaPersonalizdaUsuarioCms($item, $frase);

  foreach($filas as $fila){
    $rolUsuario = $fila['role_id'];
    echo '
    <tr>
        <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="nombre_usuario" name ="" class="text-center">'.$fila['name'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['cedula'].'</td>';
        switch ($rolUsuario ) {
          case '1':
            echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-info">Super</span></td>';
            break;
            case '2':
              echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-success">Administrador</span></td>';
              break;
              case '3':
                echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-warning">Operador</span></td>';
                break;
                case '4':
                  echo'<td id="email_usuario" name ="" class="text-center"><span class="label label-Danger">Pagos</span></td>';
                  break;
                  case '5':
                    echo'<td id="email_usuario" name ="" class="text-center"><span class="label" style="background: #503ce7;">Cliente</span></td>';
                    break;
                    case '6':
                      echo'<td id="email_usuario" name ="" class="text-center"><span class="label" style="background: #ef790c;">Ministerio</span></td>';
                      break;

          default:
            # code...
            break;
        }

      echo  '<td id="accion" class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="editar_usuario" href="modificarUsuarioOperador.php?id_operador='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
              </div>
          </td>

     </tr>';
  }


}

function listaManagerFacade($arg_idCompania){

  $consulta = new CmsUsers();
  $consultaTicketUsers = new TicketUsers();
  $consultaCC = new TicketCostCenters();
  $idCompania = $arg_idCompania;
  $filas = $consulta->listaUsuarioManagerSecretaria($idCompania);
  foreach($filas as $fila){
    $nombreCC = $consultaCC->nombreCostCenter($fila['cost_center_id']);
    $celular = $consultaTicketUsers->obtnerCelularXCorreo($fila['email']);
    $idTablaUsersTicket = $consultaTicketUsers->obtenerIdUsuarioIntegracion($fila['email']);


    echo '<tr>
    <td id="idManager" name ="" class="text-center">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$nombreCC.'</td>
    <td id="" name ="" class="text-center">'.$fila['name'].'</td>
    <td id="" name ="" class="text-center">'.$fila['email'].'</td>
    <td id="" name ="" class="text-center">'.$celular.'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">
              <a href="modificarUsuarioManager?id_manager='.$fila['id'].'&&id_rep='.$idTablaUsersTicket.'" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-pencil"></i></a>
              <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_manger"><i class="fa fa-times"></i></a>
          </div>
      </td>

     </tr>';
  }
}

function listUsariosReporters($arg_idCompania, $arg_idCc){

    $consulta = new CmsUsers();
    $consultaTicketUsers = new TicketUsers();
    $consultaCC = new TicketCostCenters();

    $idCompania = $arg_idCompania;
    $idCentroCostos = $arg_idCc;
    $filas = $consulta->listaUsuarioReportersSecretaria($idCompania, $idCentroCostos);
    if ($filas == '' || $filas == null) {
      echo "<h4>No hay usuarios reporters creados para este centro de costo</h4>";
    }else {
            foreach($filas as $fila){
              $nombreCC = $consultaCC->nombreCostCenter($fila['cost_center_id']);
              $celular = $consultaTicketUsers->obtnerCelularXCorreo($fila['email']);
              $idTablaUsersTicket = $consultaTicketUsers->obtenerIdUsuarioIntegracion($fila['email']);

              echo '<tr>
              <td id="idReporter" name ="" class="text-center">'.$fila['id'].'</td>
              <td id="" name ="" class="text-center">'.$nombreCC.'</td>
              <td id="" name ="" class="text-center">'.$fila['name'].'</td>
              <td id="" name ="" class="text-center">'.$fila['email'].'</td>
              <td id="" name ="" class="text-center">'.$celular.'</td>
              <td class="text-center">
                    <div class="btn-group btn-group-xs">
                        <a href="modificarUsuarioReport?id_reporter='.$fila['id'].'&&id_rep='.$idTablaUsersTicket.'" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                        <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_reporter"><i class="fa fa-times"></i></a>
                    </div>
                </td>

               </tr>';
            }
    }

}


function modificarUsuarioMangerCmsFacade($arg_idUsuarioManager){
    if (isset($_GET['id_manager'])) {
        $consulta = new CmsUsers();
        $consultaTicketUsers = new TicketUsers();
        $consultaCC = new TicketCostCenters();
        $idUsuarioManager = $arg_idUsuarioManager;

        $filas = $consulta->cargarUsuarioManagerCms($idUsuarioManager);
        if ($filas == '' || $filas == null) {
          echo '<h4>No hay usuarios manager registrados para este centro de costos</h4>';
        }else {
          foreach ($filas as $fila) {
            $centroCosto = $consultaCC->nombreCostCenter($fila['cost_center_id']);
            $celular = $consultaTicketUsers->obtnerCelularXCorreo($fila['email']);
            echo '
              <form id="form-validation" action="../../controllers/app/vales/modificarUsuarioMangerController.php" method="post" class="form-horizontal form-bordered">
              <fieldset>
                <legend><i class="fa fa-angle-right"></i> Datos del Usuario</legend>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="centro_costo">Centro de costo</label>
                  <div class="col-md-6">
                  <select class="form-control" name="centro_costo" id="centro_costo">
                    <option value="'.$fila['cost_center_id'].'">'.$centroCosto.'</option>';
                    selectCentroCostosXIdCompania($fila['company_id']);


                echo  '</select>
                </div>
              </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre">Nombre</label>
                  <div class="col-md-6">
                    <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="id_usuario_manager" name="id_usuario_manager" class="form-control" value="'.$fila['id'].'" readonly>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre">Email</label>
                  <div class="col-md-6">
                    <input type="email" id="email" name="email" class="form-control" value="'.$fila['email'].'">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre">Teléfono</label>
                  <div class="col-md-6">
                    <input type="text" id="telefono" name="telefono" class="form-control" value="'.$celular.'">
                  </div>
                </div>
                <div class="form-group ">
                  <div class="col-md-8 col-md-offset-4">
                    <button href="" type="submit" class="btn btn-sm btn-success" id="btn-modificar-curso"><i class="fa fa-arrow-right"></i> Modificar</button>
                    <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
                  </div>
                </div>
              </fieldset>
            </form>';

          }
        }

    }else{
      return header("Location: ../views/manager/usuarioReport.php");
    }
}

function modificarUsuarioReportCmsFacade($arg_idUsuarioReport, $arg_idTabla){
    if (isset($_GET['id_reporter'])) {
        $consulta = new TicketUsers();
        $idUsuarioReport = $arg_idUsuarioReport;
        $idUsuarioTablaUserTicket = $arg_idTabla;
        $filas = $consulta->cargarUsuarioReport($idUsuarioTablaUserTicket);
        foreach ($filas as $fila) {
          echo '<form id="form-validation" action="../../controllers/app/vales/modificarUsuarioReportController.php" method="post" class="form-horizontal form-bordered">
            <fieldset>
              <legend><i class="fa fa-angle-right"></i> Datos del Usuario</legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="nombre">Nombre</label>
                <div class="col-md-6">
                  <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name'].'">
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="id_usuario_report" name="id_usuario_report" class="form-control" value="'.$idUsuarioTablaUserTicket.'" readonly>
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="id_usuario_cms" name="id_usuario_cms" class="form-control" value="'.$idUsuarioReport.'" readonly>
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="id_usuario_parent" name="id_usuario_parent" class="form-control" value="'.$fila['parent_id'].'" readonly>
                </div>
                <div class="col-md-6">
                  <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="nombre">Email</label>
                <div class="col-md-6">
                  <input type="email" id="email" name="email" class="form-control" value="'.$fila['email'].'">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="telefono">Teléfono</label>
                <div class="col-md-6">
                  <input type="text" id="telefono" name="telefono" class="form-control" value="'.$fila['cellphone'].'">
                </div>
              </div>
              <div class="form-group ">
                <div class="col-md-8 col-md-offset-4">
                  <button href="" type="submit" class="btn btn-sm btn-success" id="btn-modificar-curso"><i class="fa fa-arrow-right"></i> Modificar</button>
                  <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
                </div>
              </div>
            </fieldset>
          </form>';

        }

    }else{
      return header("Location: ../views/manager/usuarioReport.php");
    }
}

 ?>
