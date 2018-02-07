<?php
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

function listServicesManager($arg_idCc){
  $consulta = new Services();
  $prefijo = $consulta->prefijo($arg_idCc);

  $filas = $consulta->todosServiciosCompania($prefijo);
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

function listServicesManagerMes($arg_idCc, $arg_mes){
  $consulta = new Services();
  $prefijo = $consulta->prefijo($arg_idCc);
  $mes = $arg_mes;
  $filas = $consulta->todosServiciosMangerMes($prefijo, $mes);
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

function listServicesAdministradorMes($arg_idCompania, $arg_mes){
  $consulta = new Services();
  //$prefijo = $consulta->prefijo($arg_idCc);
  $idCompania = $arg_idCompania;
  $mes = $arg_mes;
  $filas = $consulta->todosServiciosAdministradorMes($idCompania, $mes);
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

function listValesXDependecia($arg_idDependencia){
  $consulta = new TicketTickets();
  $consultaCompania = new TicketCompanies();
  $idDependencia = $arg_idDependencia;
  $filas = $consulta->todosValesXDependencia($idDependencia);
  foreach ($filas as $fila) {
    $estado = $fila['status'];
    $compania = $consultaCompania->nombreCompania($fila['company_id']);
    echo '<tr>
    <td id="" name ="" class="text-center">'.$compania.'</td>
    <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>';
    switch ($estado) {
      case 0:
        echo '<td class="text-center"><span class="label label-success">Disponible</span></td>';
        break;
        case 1:
          echo '<td class="text-center"><span class="label label-info">Utilizado</span></td>';
          break;
          case 2:
            echo '<td class="text-center"><span class="label label-warning">Solicitado</span></td>';
            break;
            case 3:
              echo '<td class="text-center"><span class="label label-danger">Vencido</span></td>';
              break;
              case 4:
              echo '<td class="text-center"><span class="label " style="background: #503ce7;">Central</span></td>';
              break;
      default:
        # code...
        break;
    }
    echo '
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['end_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['cost_center_id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
     </tr>';
  }
}

function listValesXCompania($arg_idCompania){
  $consulta = new TicketTickets();
  $consultaCompania = new TicketCompanies();
  $idCompania = $arg_idCompania;
  $filas = $consulta->todosValesXCompania($idCompania);
  foreach ($filas as $fila) {
    $estado = $fila['status'];
    $compania = $consultaCompania->nombreCompania($fila['company_id']);
    echo '<tr>
    <td id="" name ="" class="text-center">'.$compania.'</td>
    <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>';
    switch ($estado) {
      case 0:
        echo '<td class="text-center"><span class="label label-success">Disponible</span></td>';
        break;
        case 1:
          echo '<td class="text-center"><span class="label label-info">Utilizado</span></td>';
          break;
          case 2:
            echo '<td class="text-center"><span class="label label-warning">Solicitado</span></td>';
            break;
            case 3:
              echo '<td class="text-center"><span class="label label-danger">Vencido</span></td>';
              break;
              case 4:
                echo '<td class="text-center"><span class="label" style="background: #503ce7;">Central</span></td>';
                break;
      default:
        # code...
        break;
    }
    echo '
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['end_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['cost_center_id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
     </tr>';
  }
}

function listValesXCompaniaCentral($arg_idCompania){
  $consulta = new TicketTickets();
  $consultaCompania = new TicketCompanies();
  $idCompania = $arg_idCompania;
  //$filas = $consulta->todosValesXCompania($idCompania);
  $filas = $consulta->obtenerTodosValesDisponiblesXEmpresa($idCompania);
  foreach ($filas as $fila) {
    $estado = $fila['status'];
    $compania = $consultaCompania->nombreCompania($fila['company_id']);
    echo '
    <tr>
          <td id="idVale" name="" class="hidden">'.$fila['id'].'</td>
          <td id="" name ="" class="text-center">'.$compania.'</td>
          <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>';
          switch ($estado) {
            case 0:
              echo '<td id="estadoValeId" class="text-center"><span class="label label-success">Disponible</span></td>';
              break;
              case 1:
                echo '<td id="estadoValeId" class="text-center"><span class="label label-info">Utilizado</span></td>';
                break;
                case 2:
                  echo '<td id="estadoValeId" class="text-center"><span class="label label-warning">Solicitado</span></td>';
                  break;
                  case 3:
                    echo '<td id="estadoValeId" class="text-center"><span class="label label-danger">Vencido</span></td>';
                    break;
                    case 4:
                      echo '<td id="estadoValeId" class="text-center"><span class="label" style="background: #503ce7;">Central</span></td>';
                      break;
            default:
              # code...
              break;
          }
          echo '
          <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['end_at'].'</td>
          <td id="" name ="" class="text-center">'.$fila['cost_center_id'].'</td>
          <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
          <td class="text-center">
                <div class="btn-group btn-group-xs">
                    <a href="" id="btn-central" data-toggle="tooltip" title="Central" class="btn btn-default" ><i class="fa fa-building"></i></a>
                    <a href="" id="btn-dis" data-toggle="tooltip" title="Disponible" class="btn btn-info" ><i class="fa fa-pencil"></i></a>
                </div>
            </td>
     </tr>';
  }
}

function BusquedaValesXCompania($arg_idCompania, $arg_campo, $arg_frase){
  $consulta = new TicketTickets();
  $consultaCompania = new TicketCompanies();
  $idCompania = $arg_idCompania;
  $campo = $arg_campo;
  $frase = $arg_frase;
  $filas = $consulta->busquedaPersonalizadaTickets($idCompania, $campo, $frase);
  foreach ($filas as $fila) {
    $estado = $fila['status'];
    $compania = $consultaCompania->nombreCompania($fila['company_id']);
    echo '<tr>
    <td id="" name ="" class="text-center">'.$compania.'</td>
    <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>';
    switch ($estado) {
      case 0:
        echo '<td class="text-center"><span class="label label-success">Disponible</span></td>';
        break;
        case 1:
          echo '<td class="text-center"><span class="label label-info">Utilizado</span></td>';
          break;
          case 2:
            echo '<td class="text-center"><span class="label label-warning">Solicitado</span></td>';
            break;
            case 3:
              echo '<td class="text-center"><span class="label label-danger">Vencido</span></td>';
              break;
              case 4:
                echo '<td class="text-center"><span class="label" style="background: #503ce7;">Central</span></td>';
                break;
      default:
        # code...
        break;
    }
    echo '
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['end_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['cost_center_id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
     </tr>';
  }
}

function BusquedaValesXCompaniaCentral($arg_idCompania, $arg_campo, $arg_frase){
  $consulta = new TicketTickets();
  $consultaCompania = new TicketCompanies();
  $idCompania = $arg_idCompania;
  $campo = $arg_campo;
  $frase = $arg_frase;
  $filas = $consulta->busquedaPersonalizadaTickets($idCompania, $campo, $frase);
  foreach ($filas as $fila) {
    $estado = $fila['status'];
    $compania = $consultaCompania->nombreCompania($fila['company_id']);
    echo '<tr>
    <td id="idVale" name="" class="hidden">'.$fila['id'].'</td>
    <td id="" name ="" class="text-center">'.$compania.'</td>
    <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>';
    switch ($estado) {
      case 0:
        echo '<td id="estadoValeId" class="text-center"><span class="label label-success">Disponible</span></td>';
        break;
        case 1:
          echo '<td id="estadoValeId" class="text-center"><span class="label label-info">Utilizado</span></td>';
          break;
          case 2:
            echo '<td id="estadoValeId" class="text-center"><span class="label label-warning">Solicitado</span></td>';
            break;
            case 3:
              echo '<td id="estadoValeId" class="text-center"><span class="label label-danger">Vencido</span></td>';
              break;
              case 4:
                echo '<td id="estadoValeId" class="text-center"><span class="label" style="background: #503ce7;">Central</span></td>';
                break;
      default:
        # code...
        break;
    }
    echo '
    <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['end_at'].'</td>
    <td id="" name ="" class="text-center">'.$fila['cost_center_id'].'</td>
    <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
    <td class="text-center">
          <div class="btn-group btn-group-xs">
              <a href="" id="btn-central" data-toggle="tooltip" title="Central" class="btn btn-default" ><i class="fa fa-building"></i></a>
              <a href="" id="btn-dis" data-toggle="tooltip" title="Disponible" class="btn btn-info" ><i class="fa fa-pencil"></i></a>
          </div>
      </td>
     </tr>';
  }
}

?>
