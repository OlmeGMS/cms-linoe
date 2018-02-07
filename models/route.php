<?php
class Route{
  public function agregarPuntoRuta(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into route (id_services, lat, lng)values(:id_services, :lat, :lng)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id_services", $argid_services);
    $statement->bindParam(":lat", $arg_lat);
    $statement->bindParam(":lng", $arg_lng);
    if (!$statement) {
      return FALSE;
    }else{
      //var_dump('verficar: ', $statement);
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtnerRuta($arg_idServicio){
    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from route where id_services = :idServicio";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idServicio", $arg_idServicio);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }
}

 ?>
