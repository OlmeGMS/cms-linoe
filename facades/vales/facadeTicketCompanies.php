<?php
function listaEmpresasFacade(){
  $consulta = new TicketCompanies();
  $filas = $consulta->listaEmpresas();
  foreach($filas as $fila){
    echo '<tr>
              <td class="text-center">'.$fila['id'].'</td>
              <td class="text-center">'.$fila['name'].'</td>
              <td class="text-center">'.$fila['identity'].'</td>
              <td class="text-center">'.$fila['phone'].'</td>
              <td class="text-center">'.$fila['address'].'</td>
              <td class="text-center">'.$fila['contract'].'</td>
              <td class="text-center">'.$fila['contractDate'].'</td>
              <td class="text-center">'.$fila['description'].'</td>
              <td class="text-center">
                    <div class="btn-group btn-group-xs">
                        <a href="modificarCentroCosto.php?id_company='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                        <!--<a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_Curso"><i class="fa fa-times"></i></a>-->
                    </div>
                </td>
     </tr>';
  }
}

function selectEmpresasTickets(){
  $consulta = new TicketCompanies();
  $filas = $consulta->listaEmpresas();
  foreach ($filas as $fila) {
    echo '
      <option value="'.$fila['id'].'">'.$fila['name'].'</option>
    ';
  }
}


 ?>
