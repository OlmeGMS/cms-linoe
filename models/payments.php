<?php
Class Payments{
  public function agregarPago($arg_id_services, $arg_fecha_pago, $arg_n_recibo, $arg_estado_pago){

    $estado_facturado = 1;
    $fecha_facturado = '0000-00-00 00:00:00';

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into payments (id_services, fecha_pago, n_recibo, estado_pago, estado_facturado, fecha_facturado) values (:id_services, :fecha_pago, :n_recibo, :estado_pago, :estado_facturado, :fecha_facturado)";
    $statement = $conexion->prepare($sql);



    $statement->bindParam(':id_services', $arg_id_services);
    $statement->bindParam(':fecha_pago', $arg_fecha_pago);
    $statement->bindParam(':n_recibo', $arg_n_recibo);
    $statement->bindParam(':estado_pago', $arg_estado_pago);
    $statement->bindParam(':estado_facturado', $estado_facturado);
    $statement->bindParam(':fecha_facturado', $fecha_facturado);

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
