<?php
Class CmsCountries{

  public function listaPaises(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_countries order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaPaisesActivos(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_countries where estado = 1 order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function agregarPais($arg_name, $arg_estado){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into cms_countries (name, estado) values (:name, :estado)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':estado', $arg_estado);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarPais($arg_idPais){

    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_countries where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_idPais);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarPais($arg_name, $arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_countries set name = :name where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':id', $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNombrePais($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select name from cms_countries where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function filtroPais($arg_name){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_countries where name = :name limit 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":name", $arg_name);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function eliminarPais($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_countries set estado = 0 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }




}
 ?>
