<?php
class SecretaryCars{

  public function insertarLocalizacion($arg_id_car, $arg_id_driver, $arg_lat, $arg_lng, $arg_fecha, $arg_estado, $arg_idCarrera){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into secretary_cars (id_car, id_driver, lat, lng, fecha, estado, idCarrera)values(:id_car, :id_driver, :lat, :lng, :fecha, :estado, :idCarrera)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id_car", $arg_id_car);
    $statement->bindParam(":id_driver", $arg_id_driver);
    $statement->bindParam(":lat", $arg_lat);
    $statement->bindParam(":lng", $arg_lng);
    $statement->bindParam(":fecha", $arg_fecha);
    $statement->bindParam(":estado", $arg_estado);
    $statement->bindParam(":idCarrera", $arg_idCarrera);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerEstado($arg_id_car){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select estado from secretary_cars where id_car = :idVehiculo order by id desc LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_id_car);
    $statement->execute();
    $estado = $statement->fetchColumn();
    return $estado;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cantidadReportesXVehiculo($arg_id_car){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select count(*) from secretary_cars where fecha between date(now()-1) and now() and id_car = :idVehiculo";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_id_car);
    $statement->execute();
    $cantidad = $statement->fetchColumn();
    return $cantidad;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function seleccionarDatosCarro($arg_id_car){

    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select secretary_cars.id, secretary_cars.id_car, secretary_cars.id_driver, secretary_cars.lat, secretary_cars.lng, secretary_cars.fecha, secretary_cars.estado, secretary_cars.idCarrera, drivers.numero_tc from secretary_cars left join drivers on secretary_cars.id_driver = drivers.id where fecha between date(now()-1) and now() and secretary_cars.id_car = :idVehiculo";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_id_car);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function seleccionarDatosCarroId($arg_id_car){
    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from secretary_cars where id_car = :idVehiculo order by id desc limit 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_id_car);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function buscarUbicacionXfecha($arg_id_car, $arg_fecha){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select secretary_cars.id, secretary_cars.id_car, secretary_cars.id_driver, secretary_cars.lat, secretary_cars.lng, secretary_cars.fecha, secretary_cars.estado, secretary_cars.idCarrera, drivers.numero_tc from secretary_cars left join drivers on  secretary_cars.id_driver = drivers.id where id_car = :idVehiculo and fecha <= :fecha order by fecha desc limit 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_id_car);
    $statement->bindParam(":fecha", $arg_fecha);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function buscarUbicacionXfechaPosiciones($arg_id_car, $arg_fecha){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select secretary_cars.id, secretary_cars.id_car, secretary_cars.id_driver, secretary_cars.lat, secretary_cars.lng, secretary_cars.fecha, secretary_cars.estado, secretary_cars.idCarrera, drivers.numero_tc from secretary_cars left join drivers on  secretary_cars.id_driver = drivers.id where id_car = :idVehiculo and fecha <= :fecha order by fecha desc limit 2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_id_car);
    $statement->bindParam(":fecha", $arg_fecha);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function insertarAveriado($arg_id_car, $arg_id_driver, $arg_lat, $arg_lng, $arg_fecha, $arg_estado, $arg_idCarrera){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into secretary_cars (id_car, id_driver, lat, lng, fecha, estado, idCarrera)values(:id_car, :id_driver, :lat, :lng, :fecha, :estado, :idCarrera)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id_car", $arg_id_car);
    $statement->bindParam(":id_driver", $arg_id_driver);
    $statement->bindParam(":lat", $arg_lat);
    $statement->bindParam(":lng", $arg_lng);
    $statement->bindParam(":fecha", $arg_fecha);
    $statement->bindParam(":estado", $arg_estado);
    $statement->bindParam(":idCarrera", $arg_idCarrera);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function insertarFueraServicio($arg_id_car, $arg_id_driver, $arg_lat, $arg_lng, $arg_fecha, $arg_estado, $arg_idCarrera){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into secretary_cars (id_car, id_driver, lat, lng, fecha, estado, idCarrera)values(:id_car, :id_driver, :lat, :lng, :fecha, :estado, :idCarrera)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id_car", $arg_id_car);
    $statement->bindParam(":id_driver", $arg_id_driver);
    $statement->bindParam(":lat", $arg_lat);
    $statement->bindParam(":lng", $arg_lng);
    $statement->bindParam(":fecha", $arg_fecha);
    $statement->bindParam(":estado", $arg_estado);
    $statement->bindParam(":idCarrera", $arg_idCarrera);
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
