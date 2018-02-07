<?php
class Barrio{
  public function agregarbarrio($arg_barrio){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into barrio (barrio)values(:barrio)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':barrio', $arg_barrio);
    if(!$statement){
      return FALSE;
    }else {
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosBarrios(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from barrio";
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
