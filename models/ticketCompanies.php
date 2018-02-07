<?php
class TicketCompanies{

public function nombreCompania($arg_idCompania){
  $modelo = new Conexion();
  $nombreCompania = null;
  $conexion = $modelo->get_conexion();
  $sql = "select name from ticket_companies where id = :idCompania LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  $nombreCompania = $statement->fetchColumn();

  return $nombreCompania;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaEmpresas(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from ticket_companies";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerTipoBloqueo($arg_idCompania){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select tipo_bloqueo from ticket_companies where id  = :idCompania LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  $nombreCompania = $statement->fetchColumn();

  return $nombreCompania;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerPorcentajeAdm($arg_idCompania){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select porcentaje_adm from ticket_companies where id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  $porcentaje = $statement->fetchColumn();

  return $porcentaje;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerPresupuestoAdm($arg_idCompania){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select presupuesto from ticket_companies where id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  $presupuesto = $statement->fetchColumn();

  return $presupuesto;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerFacturadoAdm($arg_idCompania){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select facturado from ticket_companies where id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  $presupuesto = $statement->fetchColumn();

  return $presupuesto;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerUsadoAdm($arg_idCompania){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select usado from ticket_companies where id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  $presupuesto = $statement->fetchColumn();

  return $presupuesto;

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarUsado($arg_usado, $arg_idCompania){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();

  $sql = "update ticket_companies set usado = :usado where id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':usado', $arg_usado);
  $statement->bindParam(':idCompania', $arg_idCompania);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }

  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarFacturado($arg_facturado, $arg_idCompania){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "updated ticket_companies set facturado = :facturado where id = :idCompania";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':facturado', $arg_facturado);
  $statement->bindParam(':idCompania', $arg_idCompania);
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
