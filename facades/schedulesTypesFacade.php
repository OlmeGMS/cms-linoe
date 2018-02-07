<?php
function todosSchedulesTypeFacade(){
  $consulta = new ScheduleTypes();
  $filas = $consulta->listaTiposAgendamiento();
  foreach($filas as $fila){
    echo '<option value="'.$fila['id'].'">'.$fila['descrip'].'</option>';
  }
}
?>
