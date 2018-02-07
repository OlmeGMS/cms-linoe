<?php
Class CmsDepartments{
  public function listaDepartamentos($arg_country_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_departments where country_id = :country_id order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':country_id', $arg_country_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaDepartamentosActivos($arg_country_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_departments where country_id = :country_id and estado = 1 order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':country_id', $arg_country_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaTodosDepartamentos(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_departments where estado = 1 order by name asc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':country_id', $arg_country_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }
  public function agregarDepartamento($arg_name, $arg_country_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into cms_departments (name, country_id) values (:name, :country_id)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':country_id', $arg_country_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarDepartamento($arg_idDepartamento){

    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_departments where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_idDepartamento);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarDepartamento($arg_name, $arg_country_id, $arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_departments set name = :name, country_id = :country_id where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':country_id', $arg_country_id);
    $statement->bindParam(':id', $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNombreDepartamento($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select name from cms_departments where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function filtroDepartamentos($arg_name){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_departments where name = :nombre";
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

  public function EliminarDepartamento($arg_idDepartamento){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_departments set estado = 0 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idDepartamento);
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
