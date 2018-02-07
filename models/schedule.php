<?php
Class Schedule{

public function crearAgendamiento($arg_user_id, $arg_service_date_time, $arg_schedule_type, $arg_address_index, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_obs, $arg_destination, $arg_created_at, $arg_updated_at, $arg_status, $arg_score, $arg_cms_users_id, $arg_address, $arg_city_lat, $arg_city_lng, $arg_name_user, $arg_lastname_user){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "insert into schedules (user_id, service_date_time, schedule_type, address_index, comp1, comp2, no, barrio, obs, destination, created_at, updated_at, status, score, cms_users_id, address, city_lat, city_lng, name_user, lastname_user)values(:user_id, :service_date_time, :schedule_type, :address_index, :comp1, :comp2, :no, :barrio, :obs, :destination, :created_at, :updated_at, :status, :score, :cms_users_id, :address, :city_lat, :city_lng, :name_user, :lastname_user)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':user_id', $arg_user_id);
  $statement->bindParam(':service_date_time', $arg_service_date_time);
  $statement->bindParam(':schedule_type', $arg_schedule_type);
  $statement->bindParam(':address_index', $arg_address_index);
  $statement->bindParam(':comp1', $arg_comp1);
  $statement->bindParam(':comp2', $arg_comp2);
  $statement->bindParam(':no', $arg_no);
  $statement->bindParam(':barrio', $arg_barrio);
  $statement->bindParam(':obs', $arg_obs);
  $statement->bindParam(':destination', $arg_destination);
  $statement->bindParam(':created_at', $arg_created_at);
  $statement->bindParam(':updated_at', $arg_updated_at);
  $statement->bindParam(':status', $arg_status);
  $statement->bindParam(':score', $arg_score);
  $statement->bindParam(':cms_users_id', $arg_cms_users_id);
  $statement->bindParam(':address', $arg_address);
  $statement->bindParam(':city_lat', $arg_city_lat);
  $statement->bindParam(':city_lng', $arg_city_lng);
  $statement->bindParam(':name_user', $arg_name_user);
  $statement->bindParam(':lastname_user', $arg_lastname_user);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerServicios20Minutes(){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from schedules where (status = 1) and service_date_time > now() and (timediff(service_date_time,now()) < '00:20:00')";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}


public function actualizarEstadoAgendamientoServicioCreado($arg_idAgendamiento){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = 10 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idAgendamiento);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cancelarAgendamientoSistemaAutomatico(){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = 7 where (status = 1) and (service_date_time = now() or service_date_time < now())";
  $statement = $conexion->prepare($sql);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerAgendamientosParaCentral(){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  //$sql = "select * from schedules where (timediff(service_date_time,now()) > '00:14:00') and (status = 10)";
  $sql = "select * from schedules  where (timediff(service_date_time,now()) > '00:10:00') and (timediff(service_date_time,now()) < '00:15:00') and (status = 10)";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cambiarEstadoCentralAgendamiento($arg_idAgendamiento){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = 11 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idAgendamiento);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaAgendamientos(){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from schedules order by id desc LIMIT 20";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cancelarAgendamientoIndividual($arg_idAgendamiento){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = 9 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idAgendamiento);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarAgendamiento($arg_idAgendamiento){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from schedules where id = :id LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idAgendamiento);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cancelarAgendamientoUsuario($arg_idAgendamiento, $arg_idUsuario){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = 6 where id = :id and user_id = :idUsuario and status = 1 or status = 10 or status = 11";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idAgendamiento);
  $statement->bindParam(":idUsuario", $arg_idUsuario);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function asignarServicioAgendamientoCentral($arg_idAgendamiento){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = 2 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idAgendamiento);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarEstadoAgendamientoAuto($arg_estado, $arg_idAgendamiento){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set status = :estado where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":estado", $arg_estado);
  $statement->bindParam(":id", $arg_idAgendamiento);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function AgregarIdServiceAgendamiento($arg_idServicio, $arg_idAgendamiento){

  $modelo  = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update schedules set service_id = :idServicio where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idServicio", $arg_idServicio);
  $statement->bindParam(":id", $arg_idAgendamiento);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function buscarAgendamiento($arg_campo, $arg_item){

  $rows = null;
  $campo = $arg_campo;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from schedules where id = :item";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":item", $arg_item);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

}
 ?>
