<?php
Class CmsCities{

  public function listaCiudades($arg_department_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_cities where department_id = :department_id order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':department_id', $arg_department_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }
  public function listaCiudadesSistema(){
    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_cities where estado = 1 order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':department_id', $arg_department_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }
  public function agregarCiudad($arg_name, $arg_country_id, $arg_department_id, $arg_center_lat, $arg_center_lng, $arg_estado){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into cms_cities (name, country_id, department_id, center_lat, center_lng, estado) values (:name, :country_id, :department_id, :center_lat, :center_lng, :estado)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':country_id', $arg_country_id);
    $statement->bindParam(':department_id', $arg_department_id);
    $statement->bindParam(':center_lat', $arg_center_lat);
    $statement->bindParam(':center_lng', $arg_center_lng);
    $statement->bindParam(':estado', $arg_estado);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarCiudad($arg_idCiudad){

    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_cities where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_idCiudad);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarCiudad($arg_name, $arg_country_id, $arg_department_id, $arg_center_lat, $arg_center_lng, $arg_estado, $arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_cities set name = :name, country_id = :country_id, department_id = :department_id, center_lat = :center_lat, center_lng = :center_lng, estado = :estado where id = :id";
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':country_id', $arg_country_id);
    $statement->bindParam(':department_id', $arg_department_id);
    $statement->bindParam(':center_lat', $arg_center_lat);
    $statement->bindParam(':center_lng', $arg_center_lng);
    $statement->bindParam(':estado', $arg_estado);
    $statement->bindParam(':id', $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNombreCiudad($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select name from cms_cities where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function EliminarCiudad($arg_idCiudad){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_cities set estado = 0 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_idCiudad);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function filtroCiudad($arg_name){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_cities where name = :nombre";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
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
