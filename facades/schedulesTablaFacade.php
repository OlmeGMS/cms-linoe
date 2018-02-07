<?php
require_once('../models/conexion.php');
require_once('../models/usersDirs.php');
require_once('../models/users.php');;
require_once('../models/schedule.php');
require_once('../facades/schedulesFacade.php');
require_once('../facades/schedulesTablaFacade.php');
//$id = $_POST['id'];
$consulta = new Schedule();
$consultaUsers = new Users();
$js = "$('#modal-services').modal('show');";
$filas = $consulta->listaAgendamientos();
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
    if($fila['name_user'] != null || $fila['name_user'] != ''){
      $nombreCms = $fila['name_user'];
    }else{
      $nombreCms = null;
    }

    if ($fila['lastname_user'] != null || $fila['lastname_user'] != '') {
      $apellidoCms = $fila['lastname_user'];
    }else {
      $apellidoCms = null;
    }

    $estado = $fila['status'];
    $nombre = $consultaUsers->obtenerNombre($idFlecha);
    $telefono = $consultaUsers->obtenerTelefono($idFlecha);

    $celular = $consultaUsers->obtenerCelular($idFlecha);


    if ($nombreCms != null || $apellidoCms != null) {
      $name = "$nombreCms $apellidoCms";
    }else{
      $name = "$nombre";
    }


    echo '
    <td id="idagendamiento" name ="id" class="text-center">'.$fila['id'].'</td>
    <td id="idnombre" name ="nombre" class="text-center">'.$name.'</td>
    <td id="idaddres" name ="direccion" class="text-center">'.$fila['address'].'</td>';
    if ($telefono != null) {
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
        case '10':
        echo '<td id="idestado" name ="estado" class="text-center">Buscando Serv.</td>';
        break;
        case '11':
        echo '<td id="idestado" name ="estado" class="text-center">Central</td>';
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
              <a href="" data-toggle="tooltip" title="Cambiar a asignado" id="asignado_agendamiento" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
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


 ?>
