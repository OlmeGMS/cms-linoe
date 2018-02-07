<?php
Class SecretaryStatus{

  public function obtenerEstado($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select letra from secretary_status where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $numero = $statement->fetchColumn();
    return $numero;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }
  
}
 ?>
