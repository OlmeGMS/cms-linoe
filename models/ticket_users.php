<?php

class TicketUsers{

// Todos los metodo de la creacion de usuarios en los vales

public function todosUsuarioReportXCC($arg_idCompania, $arg_idCc){

$row = null;
$modelo = new Conexion();
$conexion = $modelo->get_conexion();
$sql = "select * from ticket_users where company_id = :idCompania and cost_center_id = :idCentroCostos and role = 'report'";
$statement = $conexion->prepare($sql);
$statement->bindParam(':idCompania', $arg_idCompania);
$statement->bindParam(':idCentroCostos', $arg_idCc);
$statement->execute();
while($result = $statement->fetch()){
  $row[] = $result;
}

return $row;
$conexion = $modelo->close_conexion($statement, $conexion);

}

public function todosUsuarioManager($arg_idCompania ){

$row = null;
$modelo = new Conexion();
$conexion = $modelo->get_conexion();
$rol = 'manager';
//$sql = "select ticket_users.id, ticket_cost_centers.name as centro, ticket_users.name, ticket_users.cellphone, ticket_users.email FROM ticket_users inner join ticket_cost_centers on ticket_cost_centers.id = ticket_users.company_id where ticket_users.company_id = :idCompania and ticket_users.role = 'manager'";
//$sql = "select ticket_users.id, ticket_users.cost_center_id, ticket_users.name, ticket_users.cellphone, ticket_users.email FROM ticket_users where ticket_users.company_id = :idCompania and ticket_users.role = :rol";
$sql = "select * from ticket_users where ticket_users.company_id = :idCompania and ticket_users.role = :rol";
$statement = $conexion->prepare($sql);
$statement->bindParam(':idCompania', $arg_idCompania);
$statement->bindParam(':rol', $rol);
$statement->execute();
while($result = $statement->fetch()){
  $row[] = $result;
}

return $row;
$conexion = $modelo->close_conexion($statement, $conexion);

}

public function todosusuariosAdmin(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_users where role = 'admin'";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function crearUsuarioManager($arg_idCompania, $arg_idCostCenter, $arg_parentId, $arg_rol, $arg_nombre, $arg_movil, $arg_email, $arg_pass){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "insert into ticket_users(company_id, cost_center_id, parent_id, role, name, cellphone, email, pass) values (:idCompania, :idCostCenter, :parentId, :rol, :nombre, :movil, :email, :pass)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':idCostCenter', $arg_idCostCenter);
  $statement->bindParam(':parentId', $arg_parentId);
  $statement->bindParam(':rol', $arg_rol);
  $statement->bindParam(':nombre', $arg_nombre);
  $statement->bindParam(':movil', $arg_movil);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':pass', $arg_pass);

  if(!$statement){
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function crearUsuarioReport($arg_idCompania, $arg_idCostCenter, $arg_parentId, $arg_rol, $arg_nombre, $arg_movil, $arg_email, $arg_pass){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "insert into ticket_users(company_id, cost_center_id, parent_id, role, name, cellphone, email, pass) values (:idCompania, :idCostCenter, :parentId, :rol, :nombre, :movil, :email, :pass)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':idCostCenter', $arg_idCostCenter);
  $statement->bindParam(':parentId', $arg_parentId);
  $statement->bindParam(':rol', $arg_rol);
  $statement->bindParam(':nombre', $arg_nombre);
  $statement->bindParam(':movil', $arg_movil);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':pass', $arg_pass);

  if(!$statement){
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarUsuarioReport($arg_idUsuarioReport){
  $row = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_users where id = :idUsuarioReport LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idUsuarioReport", $arg_idUsuarioReport);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }

  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function cargarUsuarioManager($arg_idUsuarioManager){
  $row = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_users where id = :idUsuarioManager LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idUsuarioManager", $arg_idUsuarioManager);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }

  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}


public function modificarUsuarioReport($arg_nombre, $arg_email, $arg_movil, $arg_idUsuarioReport){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_users set name = :nombre, email = :email, cellphone= :movil where id = :idUsuarioReport";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":nombre", $arg_nombre);
  $statement->bindParam(":email", $arg_email);
  $statement->bindParam(":movil", $arg_movil);
  $statement->bindParam(":idUsuarioReport", $arg_idUsuarioReport);
  if (!$statement) {
    return header("Location: ../../../views/mensajes/error.php");

  }else{
    $statement->execute();
    return header("Location: ../../../views/app/listareporters");
  }
  $conexion = $modelo->close_conexion($statement, $conexion);



}

public function modificarUsuarioManager($arg_idCostCenter, $arg_nombre, $arg_email, $arg_movil, $arg_idUsuarioManager){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_users set cost_center_id = :idCentroCostos, name = :nombre, email = :email, cellphone= :movil where id = :idUsuarioManager";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idCentroCostos", $arg_idCostCenter);
  $statement->bindParam(":nombre", $arg_nombre);
  $statement->bindParam(":email", $arg_email);
  $statement->bindParam(":movil", $arg_movil);
  $statement->bindParam(":idUsuarioManager", $arg_idUsuarioManager);
  if (!$statement) {
    return header("Location: ../../../views/mensajes/error.php");

  }else{
    $statement->execute();
    return header("Location: ../../../views/app/usuarioManager.php");
  }
  $conexion = $modelo->close_conexion($statement, $conexion);



}


public function verificarCorreo($arg_email){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql="select name from ticket_users where email = :correo LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':correo', $arg_email);
  $statement->execute();

  $flag = $statement->fetchColumn();

  if ($flag == 0) {
    $flag = FALSE;
  }else{
    $flag = TRUE;
  }
  return $flag;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function verificarMovil($arg_movil){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql="select name from ticket_users where cellphone = :movil LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':movil', $arg_movil);
  $statement->execute();

  $flag = $statement->fetchColumn();

  if ($flag == 0) {
    $flag = FALSE;
  }else{
    $flag = TRUE;
  }
  return $flag;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function usuariosSecretaria(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_users where company_id = 9";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $row[] = $result;
  }

  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerCelularXCorreo($arg_email){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select cellphone from ticket_users where email = :email";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->execute();
  $celular = $statement->fetchColumn();
  return $celular;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function obtenerIdUsuarioIntegracion($arg_email){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select id from ticket_users where email = :email LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->execute();
  $id = $statement->fetchColumn();
  return $id;
  $conexion = $modelo->close_conexion($statement, $conexion);
}





}
 ?>
