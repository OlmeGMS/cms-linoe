<?php
function todosBarriosFacade(){
  $consulta = new Barrio();
  $barrios = $consulta->todosBarrios();
  foreach($barrios as $barrio){
    echo '<option value="'.$barrio['barrio'].'">'.$barrio['barrio'].'</option>';
  }
}
?>
