<?php
Class BrandsCars{

public function listaMarcas(){

  $modelo = new Conexion();
  $conexion = $modelo-> get_conexion();
  $sql = "select * from brands_cars";
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
  $sql = "select * from brands_cars where estado = 1 order by name_brands asc";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function agregarMarca($arg_name_brands, $arg_estado){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "insert into brands_cars (name_brands, estado) values (:name_brands, :estado)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':name_brands', $arg_name_brands);
  $statement->bindParam(':estado', $arg_estado);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarMarca($arg_marca){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from brands_cars where id = :id LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_marca);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function modificarMarca($arg_name, $arg_id){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update brands_cars set name_brands = :name_brands where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':name_brands', $arg_name);
  $statement->bindParam(':id', $arg_id);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerNombreMarca($arg_id){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select name_brands from brands_cars where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_id);
  $statement->execute();
  $nombre = $statement->fetchColumn();
  return $nombre;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function filtroMarca($arg_name){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from brands_cars where name_brands = :name limit 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":name", $arg_name);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function eliminarMarca($arg_id){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update brands_cars set estado = 0 where id = :id";
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
