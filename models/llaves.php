<?php
class Llaves{
  public function firebaseConductor(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select llave from llaves where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $key = $statement->fetchColumn();
    return $key;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function firebaseUsuario(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select llave from llaves where id = 2";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $key = $statement->fetchColumn();
    return $key;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }


}

 ?>
