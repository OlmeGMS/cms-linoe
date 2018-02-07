<?php
class CmsRoles{
  public function todosRoles(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cms_roles";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function nombreRol($arg_rolId){
    $modelo = new Conexion();
    $nombre = null;
    $conexion = $modelo->get_conexion();
    $sql = "select type from cms_roles where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_rolId);
    $statement->execute();
    $nombre = $statement->fetchColumn();
    return $nombre;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }
}

 ?>
