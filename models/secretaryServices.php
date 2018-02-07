<?php
class SecretaryServices{

  public function agregarCalculoCarreraSecretaria(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into secretary_services(id_services, codigo_qr)values(:idServicio, :codigo_qr)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id_services", $arg_id_services);
    $statement->bindParam(":codigo_qr", $arg_codigo_qr);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerCodigoQR($arg_id_services){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select codigo_qr from secretary_services where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_id_services);
    $statement->execute();
    $codigoQr = $statement->fetchColumn();
    return $codigoQr;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

}

 ?>
