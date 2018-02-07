<?php
class SecretaryReports{

  public function agregarReporte($arg_name_report, $arg_id_company, $arg_fecha){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert secretary_reports (name_report, id_company, fecha) values (:name_report, :id_company, :fecha)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":name_report", $arg_name_report);
    $statement->bindParam(":id_company", $arg_id_company);
    $statement->bindParam(":fecha", $arg_fecha);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaReportes($arg_empresa){

    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from secretary_reports where id_company = :idEmpresa and datediff(fecha,now())< 15";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idEmpresa", $arg_empresa);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }



}
 ?>
