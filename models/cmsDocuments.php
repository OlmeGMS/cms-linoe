<?php
class CmsDocuments{
  public function agregarFotoDocumentos($arg_documento1, $arg_documento2, $arg_documento3, $arg_documento4, $arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into cms_documents(documento1,documento2,documento3,documento4,driver_id)values(:documento1, :documento2, :documento3, :documento4, :idConductor)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':documento1', $arg_documento1);
    $statement->bindParam(':documento2', $arg_documento2);
    $statement->bindParam(':documento3', $arg_documento3);
    $statement->bindParam(':documento4', $arg_documento4);
    $statement->bindParam(':idConductor', $arg_idConductor);


    if (!$statement) {
      return FALSE;
    }else{
      
      $statement->execute();

      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);


  }

  public function modificarFotoDocumentos($arg_documento1, $arg_documento2, $arg_documento3, $arg_documento4, $arg_idConductor, $arg_fecha, $arg_idDocumento){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cms_documents set documento1 = :documento1, documento2 = :documento2, documento3 = :documento3, documento4 = :documento4, driver_id = :idConductor, updated_at = :fecha where id = :idDocumento";

    $statement = $conexion->prepare($sql);
    $statement->bindParam(":documento1", $arg_documento1);
    $statement->bindParam(":documento2", $arg_documento2);
    $statement->bindParam(":documento3", $arg_documento3);
    $statement->bindParam(":documento4", $arg_documento4);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->bindParam(":fecha", $arg_fecha);
    $statement->bindParam(":idDocumento", $arg_idDocumento);

    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerIdDocumento($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id from cms_documents where driver_id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerFotoDocumento1($arg_idDocumento){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select documento1 from cms_documents where id = :idDocumento";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idDocumento", $arg_idDocumento);
    $statement->execute();
    $foto = $statement->fetchColumn();
    return $foto;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerFotoDocumento2($arg_idDocumento){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select documento2 from cms_documents where id = :idDocumento";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idDocumento", $arg_idDocumento);
    $statement->execute();
    $foto = $statement->fetchColumn();
    return $foto;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerFotoDocumento3($arg_idDocumento){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select documento3 from cms_documents where id = :idDocumento";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idDocumento", $arg_idDocumento);
    $statement->execute();
    $foto = $statement->fetchColumn();
    return $foto;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerFotoDocumento4($arg_idDocumento){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select documento4 from cms_documents where id = :idDocumento";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idDocumento", $arg_idDocumento);
    $statement->execute();
    $foto = $statement->fetchColumn();
    return $foto;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

}
 ?>
