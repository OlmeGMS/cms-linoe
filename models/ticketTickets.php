<?php
class TicketTickets{

  //Modelo para listar los vales en la vista de crear vales
  public function todosValesXDependencia($arg_idDependencia){
    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select ticket_tickets.company_id, ticket_tickets.ticket, ticket_tickets.status, ticket_tickets.created_at, ticket_tickets.end_at, ticket_tickets.cost_center_id, ticket_tickets.commit from ticket_tickets where ticket_tickets.ticket_user_id = :idDepartamento";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idDepartamento', $arg_idDependencia);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }

    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function crearNuevoVale($arg_idCompania, $arg_ticket_user_id, $arg_ticket, $arg_created_at, $arg_end_at, $arg_const_center_id, $arg_commit){
    $modelo = new Conexion();

    $conexion = $modelo->get_conexion();
    $sql = "insert into ticket_tickets (company_id, ticket_user_id, ticket, status, created_at, end_at, cost_center_id, commit, time_expired)values(:idCompania, :ticket_users_id, :ticket, 0, :created_at, :end_at, :cost_center_id, :commit, 0)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idCompania", $arg_idCompania);
    $statement->bindParam(":ticket_users_id", $arg_ticket_user_id);
    $statement->bindParam(":ticket", $arg_ticket);
    $statement->bindParam(":created_at", $arg_created_at);
    $statement->bindParam(":end_at", $arg_end_at);
    $statement->bindParam(":cost_center_id", $arg_const_center_id);
    $statement->bindParam(":commit", $arg_commit);
    if (!$statement) {
      return FALSE;

    }else{
      $statement->execute();
      return TRUE;

    }

  }

  public function todosValesXCompania($arg_idCompania){
    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select ticket_tickets.id, ticket_tickets.company_id, ticket_tickets.ticket, ticket_tickets.status, ticket_tickets.created_at, ticket_tickets.end_at, ticket_tickets.cost_center_id, ticket_tickets.commit from ticket_tickets where ticket_tickets.company_id = :idCompania order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idCompania', $arg_idCompania);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }

    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerCompanyId($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select company_id from ticket_tickets where ticket = :vale LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    $statement->execute();
    $compania = $statement->fetchColumn();
    return $compania;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtenerEstadoVale($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select status from ticket_tickets where ticket = :vale LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    $statement->execute();
    $estado = $statement->fetchColumn();
    return $estado;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cambiarEstadoVale($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update ticket_tickets set status = 1 where ticket = :vale";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function busquedaPersonalizadaTickets($arg_empresa, $arg_campo, $arg_item){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $campo = $arg_campo;
    $item = '%'.$arg_item.'%';
    $sql = "select * from ticket_tickets where company_id = :empresa and $campo like :item order by id desc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":empresa", $arg_empresa);
    $statement->bindParam(":item", $item);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }

    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerTodosValesDisponiblesXCentroCosto($arg_idCostCenter){

    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from ticket_tickets where status = 0 and ticket_user_id = :idCostCenter order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idCostCenter', $arg_idCostCenter);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }

    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerTodosValesDisponiblesXEmpresa($arg_idCostCenter){

    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from ticket_tickets where status = 0 and company_id = :idCompany order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idCompany', $arg_idCostCenter);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }

    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cambiarEstadoValeCentral($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update ticket_tickets set status = 4 where id = :vale";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cambiarEstadoValeCentralDisponible($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update ticket_tickets set status = 0 where id = :vale";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerEstadoValeXId($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select status from ticket_tickets where id = :vale LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    $statement->execute();
    $estado = $statement->fetchColumn();
    return $estado;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cambiarEstadoValeDisponible($arg_vale){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update ticket_tickets set status = 0 where ticket = :vale";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':vale', $arg_vale);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function vencerVales($arg_idVale){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update ticket_tickets set status = 3 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_idVale);

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
