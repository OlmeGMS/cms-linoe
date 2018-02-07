<?php
function listaRolesTodoFacade(){
  $consulta = new CmsRoles();
  $filas = $consulta->todosRoles();
  foreach($filas as $fila){
    echo'
    <option value="'.$fila['id'].'">'.$fila['type'].'</option>
    ';
  }
}

 ?>
