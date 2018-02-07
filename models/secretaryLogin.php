<?php
class SecretaryLogin{

  public function login(){

    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from secretary_login where id = 1 LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idUsuario", $arg_idUsuario);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtenerUser(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select user from secretary_login where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $user = $statement->fetchColumn();
    return $user;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPassword(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select pass from secretary_login where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $pass = $statement->fetchColumn();
    return $pass;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerToken(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select token from secretary_login where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $pass = $statement->fetchColumn();
    return $pass;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function controlTiempo(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select token from secretary_login where id = 1 and timediff(secretary_login.time,now()) < '24:00:00'";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $token = $statement->fetchColumn();
    return $token;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function actualizarToken($arg_token, $arg_time){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update secretary_login set token = :token, time = :tiempo where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":token", $arg_token);
    $statement->bindParam(":tiempo", $arg_time);
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
