<?php
Class ScheduleTypes{

public function listaTiposAgendamiento(){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from schedule_types";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}



}

 ?>
