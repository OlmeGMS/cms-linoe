<?php
class Complains{

  public function listaQuejas(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from complains order by created_at desc";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarQueja($arg_id){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    //$sql = "select * from complains where id = :id";
    $sql = "select complains.id, complains.service_id, services.user_name, complains.descript, complains.answer, complains.answered, complains.created_at, complains.updated_at from complains inner join services on complains.service_id = services.id where complains.id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function lisataQuejasYReclamos(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select complains.id, complains.service_id, services.user_name, complains.descript, complains.answer, complains.answered, complains.created_at, complains.updated_at from complains inner join services on complains.service_id = services.id order by services.created_at desc";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function guardarRespuesta($arg_respuesta, $arg_id){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update complains set answer = :respuesta, answered = 1 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':respuesta', $arg_respuesta);
    $statement->bindParam(':id', $arg_id);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function busquedaPersonalizada($arg_campo, $arg_item){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $rows = null;
    $campo = $arg_campo;
    $item = '%'.$arg_item.'%';
    $sql = "select complains.id, complains.service_id, services.user_name, complains.descript, complains.answer, complains.answered, complains.created_at, complains.updated_at from complains inner join services on complains.service_id = services.id  where $campo like :item order by services.created_at desc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":item", $item);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

}
 ?>
