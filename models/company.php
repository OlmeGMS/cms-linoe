<?php
Class Company{
  public function obtenerEmpresasAfiliadasAPPTaxisYaBog(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from company where app_taxisya = 1 and id_cities = 1 and secretary_bog = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaEmpresasActivas(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from company where estado = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaEmpresasAfiliadasApp(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from company where estado = 1 and app_taxisya = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function agregarEmpresa($arg_name_company, $arg_description, $arg_id_cities, $arg_id_departments, $arg_id_contry, $arg_secretary_bog, $arg_app_taxisya, $arg_estado){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into company (name_company, description, id_cities, id_departments, id_contry, secretary_bog, app_taxisya, estado) values (:name_company, :description, :id_cities, :id_departments, :id_contry, :secretary_bog, :app_taxisya, :estado)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name_company', $arg_name_company);
    $statement->bindParam(':description', $arg_description);
    $statement->bindParam(':id_cities', $arg_id_cities);
    $statement->bindParam(':id_departments', $arg_id_departments);
    $statement->bindParam(':id_contry', $arg_id_contry);
    $statement->bindParam(':secretary_bog', $arg_secretary_bog);
    $statement->bindParam(':app_taxisya', $arg_app_taxisya);
    $statement->bindParam(':estado', $arg_estado);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function cargarEmpresa($arg_company){

    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from company where id = :company LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":company", $arg_company);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarEmpresa($arg_name_company, $arg_description, $arg_id_cities, $arg_id_departments, $arg_id_contry, $arg_secretary_bog, $arg_app_taxisya, $arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update company set name_company = :name_company, description = :description, id_cities = :id_cities, id_departments = :id_departments, id_contry = :id_contry, secretary_bog = :secretary_bog, app_taxisya = :app_taxisya where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name_company', $arg_name_company);
    $statement->bindParam(':description', $arg_description);
    $statement->bindParam(':id_cities', $arg_id_cities);
    $statement->bindParam(':id_departments', $arg_id_departments);
    $statement->bindParam(':id_contry', $arg_id_contry);
    $statement->bindParam(':secretary_bog', $arg_secretary_bog);
    $statement->bindParam(':app_taxisya', $arg_app_taxisya);
    $statement->bindParam(':id', $arg_id);

    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function eliminarEmpresa($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update company set estado = 0 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNombreEmpresa($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select name_company from company where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerciudadEmpresa($arg_id){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id_cities from company where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $ciudad = $statement->fetchColumn();
    return $ciudad;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function validarNombreEmpresa($arg_name){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id from company where name_company = :name";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':name', $arg_name);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }





}
 ?>
