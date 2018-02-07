<?php
Class LineCars{

  public function listaLineas(){

    $modelo = new Conexion();
    $conexion = $modelo-> get_conexion();
    $sql = "select * from line_cars";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaMarcasActivas(){

    $modelo = new Conexion();
    $conexion = $modelo-> get_conexion();
    $sql = "select * from line_cars where estado = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaMarcasActivasXMarca($arg_id_brand){

    $modelo = new Conexion();
    $conexion = $modelo-> get_conexion();
    $sql = "select * from line_cars where estado = 1 and id_brand = :id_brand order by name_line asc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id_brand', $arg_id_brand);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function agregarLinea($arg_name_line, $arg_id_brand, $arg_estado){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into line_cars (name_line, id_brand, estado) values (:name_line, :id_brand, :estado)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name_line', $arg_name_line);
    $statement->bindParam(':id_brand', $arg_id_brand);
    $statement->bindParam(':estado', $arg_estado);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarLinea($arg_linea){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from line_cars where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_linea);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarLinea($arg_name_line, $arg_id_brand, $arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update line_cars set name_line = :name_line, id_brand = :id_brand where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name_line', $arg_name_line);
    $statement->bindParam(':id_brand', $arg_id_brand);
    $statement->bindParam(':id', $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNombreLinea($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select name_line from line_cars where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function filtroLinea($arg_name){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from line_cars where name_line = :name limit 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":name", $arg_name);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function eliminarLinea($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update line_cars set estado = 0 where id = :id";
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
