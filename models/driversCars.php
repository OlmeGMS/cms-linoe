<?php
class DriversCars{
  public function agregarRegistro($arg_idConductor, $arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into drivers_cars (drivers_id, cars_id) values (:idConductor, :idVehiculo)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idConductor', $arg_idConductor);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    if (!$statement) {
      return FALSE;
    }else {
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function carrosManejados($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select cars_id from drivers_cars where drivers_id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idConductor', $arg_idConductor);
    $statement->execute();
    $row = $statement->fetchColumn();
    /*while ($result = $statement->fetch()) {
      $row[] = $result;
    }*/
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerConductroesXCarro($arg_idVehiculo){

    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from drivers_cars where cars_id = :idCar";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idCar', $arg_idVehiculo);
    $statement->execute();

    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarCarrosManejados($arg_idConductor, $arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    //terminar la modificacion
    $sql = "update drivers_cars set cars_id = :idVehiculo where drivers_id = :idConductor";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->bindParam(":idVehiculo", $arg_idVehiculo);
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
