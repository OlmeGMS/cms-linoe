<?php

//Todos los facedes de la tabla de tickets_user

function listUsariosXCentrosCostos($arg_idCompania, $arg_idCc){
    $consulta = new TicketUsers();
    $idCompania = $arg_idCompania;
    $idCc = $arg_idCc;
    $filas = $consulta->todosUsuarioReportXCC($idCompania, $idCc);
    foreach($filas as $fila){
      echo '<tr>
      <td id="" name ="" class="text-center">'.$fila['id'].'</td>
      <td id="" name ="" class="text-center">'.$fila['name'].'</td>
      <td id="" name ="" class="text-center">'.$fila['email'].'</td>
      <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
      <td class="text-center">
            <div class="btn-group btn-group-xs">
                <a href="modificarUsuarioReport.php?id_report='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
            </div>
        </td>

       </tr>';
    }
}

function listUsariosManger($arg_idCompania){
    $consulta = new TicketUsers();
    $consultaCC = new TicketCostCenters();
    $idCompania = $arg_idCompania;
    $filas = $consulta->todosUsuarioManager($idCompania);
    foreach($filas as $fila){
      $nombreCC = $consultaCC->nombreCostCenter($fila['cost_center_id']);


      echo '<tr>
      <td id="" name ="" class="text-center">'.$fila['id'].'</td>
      <td id="" name ="" class="text-center">'.$nombreCC.'</td>
      <td id="" name ="" class="text-center">'.$fila['name'].'</td>
      <td id="" name ="" class="text-center">'.$fila['email'].'</td>
      <td id="" name ="" class="text-center">'.$fila['cellphone'].'</td>
      <td class="text-center">
            <div class="btn-group btn-group-xs">
                <a href="modificarUsuarioManager?id_manager='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
            </div>
        </td>

       </tr>';

     }
}
function modificarUsuarioReportFC($arg_idUsuarioReport){
    if (isset($_GET['id_report'])) {
        $consulta = new TicketUsers();
        $idUsuarioReport = $arg_idUsuarioReport;
        $filas = $consulta->cargarUsuarioReport($idUsuarioReport);
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
                  <input type="hidden" id="id_usuario_report" name="id_usuario_report" class="form-control" value="'.$fila['id'].'" readonly>
                </div>
                <div class="col-md-6">
                  <input type="text" id="id_usuario_parent" name="id_usuario_parent" class="form-control" value="'.$fila['parent'].'" readonly>
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
                  <input type="text" id=telefono" name=telefono" class="form-control" value="'.$fila['cellphone'].'">
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

function modificarUsuarioMangerFacade($arg_idUsuarioManager){
    if (isset($_GET['id_manager'])) {
        $consulta = new TicketUsers();
        $consultaCC = new TicketCostCenters();
        $idUsuarioManager = $arg_idUsuarioManager;

        $filas = $consulta->cargarUsuarioManager($idUsuarioManager);
        foreach ($filas as $fila) {
          $centroCosto = $consultaCC->nombreCostCenter($fila['cost_center_id']);
          echo '<form id="form-validation" action="../../controllers/administrador/modificarUsuarioMangerController.php" method="post" class="form-horizontal form-bordered">
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
                  <input type="text" id="movil" name="movil" class="form-control" value="'.$fila['cellphone'].'">
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
