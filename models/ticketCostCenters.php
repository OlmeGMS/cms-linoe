<?php
class TicketCostCenters{

public function crearCentroConsto($arg_idCompania, $arg_nombre, $arg_prefijo, $arg_presupuesto, $arg_disponible){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "insert into ticket_cost_centers(company_id, name, prefix, numerator, budget, available, used) values (:idCompania, :nombre, :prefijo, 0, :presupuesto, :disponible, 0)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':nombre', $arg_nombre);
  $statement->bindParam(':prefijo', $arg_prefijo);
  $statement->bindParam(':presupuesto', $arg_presupuesto);
  $statement->bindParam(':disponible', $arg_disponible);

  if(!$statement){
    return header("Location: ../../views/mensajes/error.php");
  }else{
    $statement->execute();
    return header("Location: ../../views/mensajes/registro_exitoso.php");
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}


public function nombreCostCenter($arg_idCostCenter){
  $modelo = new Conexion();
  $nombreCostCenter = null;
  $conexion = $modelo->get_conexion();
  $sql = "select name from ticket_cost_centers where id = :idCostCenter LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCostCenter', $arg_idCostCenter);
  $statement->execute();
  $nombreCostCenter = $statement->fetchColumn();

  return $nombreCostCenter;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function ultimoNumeroVale($arg_idCostCenter){
  $modelo = new Conexion();
  $nombreCostCenter = null;
  $conexion = $modelo->get_conexion();
  $sql = "select numerator from ticket_cost_centers where id = :idCostCenter LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCostCenter', $arg_idCostCenter);
  $statement->execute();
  $numero = $statement->fetchColumn();

  return $numero;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarNumeroVale($arg_nuevoNumero, $arg_idCostCenter){
  $modelo = new Conexion();
  $conexion =  $modelo->get_conexion();
  $sql = "update ticket_cost_centers set numerator = :nuevoNumero where id = :idCostCenter";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':nuevoNumero', $arg_nuevoNumero);
  $statement->bindParam(':idCostCenter', $arg_idCostCenter);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }

  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function listaCentrosCostos($arg_idCompania){
  $row = null ;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_cost_centers where company_id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function verificarPrefijo($arg_prefijo){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select id from ticket_cost_centers where prefix = :prefijo LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':prefijo', $arg_prefijo);
  $statement->execute();

  $flag = $statement->fetchColumn();

  if ($flag == 0) {
    $flag = FALSE;
  }else {
    $flag = TRUE;
  }
  return $flag;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarCentroCosto($arg_idCostCenter){
  $row = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_cost_centers where id = :idCentroCostos LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idCentroCostos", $arg_idCostCenter);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }

  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function modificarCentroCosto($arg_nombre, $arg_presupuesto, $arg_idCostCenter){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_cost_centers set name = :nombre, budget = :presupuesto where id = :idCentroCostos";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":nombre", $arg_nombre);
  $statement->bindParam(":presupuesto", $arg_presupuesto);
  $statement->bindParam(":idCentroCostos", $arg_idCostCenter);
  if (!$statement) {
    return header("Location: ../../../views/mensajes/error");
  }else{
    $statement->execute();
    return header("Location: ../../../views/app/centroCostos");
  }
}

public function obtnerIDCentroXPrefijo($arg_prefijo){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $prefijo = '%'.$arg_prefijo.'%';
  $sql = "select id from ticket_cost_centers where prefix like :prefijo";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":prefijo", $prefijo);
  $statement->execute();
  $idCostCenter = $statement->fetchColumn();

  return $idCostCenter;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerPorcentaje($arg_idCc){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select porciento from ticket_cost_centers where id = :id LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idCc);
  $statement->execute();
  $porcentaje = $statement->fetchColumn();

  return $porcentaje;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerAvaliableCentroCosto($arg_idCc){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select available from ticket_cost_centers where id = :id LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idCc);
  $statement->execute();
  $facturado = $statement->fetchColumn();

  return $facturado;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerPresupuestoCentroCosto($arg_idCc){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select budget from ticket_cost_centers where id = :id LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idCc);
  $statement->execute();
  $presupuesto = $statement->fetchColumn();

  return $presupuesto;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaPrefijos($arg_idCompania){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select prefix from ticket_cost_centers where company_id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idCompania", $arg_idCompania);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }

  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function nombrePrefijoXPrefijo($arg_prefijo){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $prefijo = '%'.$arg_prefijo.'%';
  $sql = "select name from ticket_cost_centers where prefix like :prefijo LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":prefijo", $prefijo);
  $statement->execute();
  $nombre = $statement->fetchColumn();

  return $nombre;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarGasto($arg_gasto, $arg_idCentroCosto){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_cost_centers set gasto = :gasto where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":gasto", $arg_gasto);
  $statement->bindParam(":id", $arg_idCentroCosto);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }

  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function actualizarUsed($arg_saldo, $arg_idCentroCosto){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_cost_centers set used = :saldo where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":saldo", $arg_saldo);
  $statement->bindParam(":id", $arg_idCentroCosto);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerPrefijoXIdCentroCostos($arg_idCc){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select prefix from ticket_cost_centers where id = :centroCosto LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":centroCosto", $arg_idCc);
  $statement->execute();
  $prefijo = $statement->fetchColumn();

  return $prefijo;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerGastoXCentroCosto($arg_idCc){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select gasto from ticket_cost_centers where id = :centroCosto LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":centroCosto", $arg_idCc);
  $statement->execute();
  $gasto = $statement->fetchColumn();

  return $gasto;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarPorcentaje($arg_porticiento, $arg_idCentroCosto){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_cost_centers set porciento = :porciento where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":porciento", $arg_porticiento);
  $statement->bindParam(":id", $arg_idCentroCosto);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }

  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function modificarBloqueo($arg_bloqueo, $arg_idCentroCosto){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_cost_centers set bloqueo = :bloqueo where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":bloqueo", $arg_bloqueo);
  $statement->bindParam(":id", $arg_idCentroCosto);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerBloqueo($arg_idCentroCosto){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select bloqueo from ticket_cost_centers where id = :idCC LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCC', $arg_idCentroCosto);
  $statement->execute();
  $nombreCompania = $statement->fetchColumn();

  return $nombreCompania;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerUsed($arg_idCentroCosto){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select used from ticket_cost_centers where id = :idCC LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCC', $arg_idCentroCosto);
  $statement->execute();
  $nombreCompania = $statement->fetchColumn();

  return $nombreCompania;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerIDCompaniaXCC($arg_idCentroCosto){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select company_id from ticket_cost_centers where id = :idCC LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCC', $arg_idCentroCosto);
  $statement->execute();
  $nombreCompania = $statement->fetchColumn();

  return $nombreCompania;

  $conexion = $modelo->close_conexion($statement, $conexion);
}


}

 ?>
