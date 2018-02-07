<?php
class Cars{
  public function todosVehiculos(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosVehiculosSistema(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars where estado = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosVehiculosEstado(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars where estado = 1 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function agregarVehiculo($arg_placa, $arg_marca, $arg_lineaVehiculo, $arg_movil, $arg_empresa, $arg_pago,  $arg_modelo, $arg_city_id, $arg_factor, $arg_id_empresa, $arg_id_brand, $arg_id_line){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into cars(placa, car_brand, model, movil, empresa, pay_date, year, city_id, factor, id_empresa, id_brand, id_line)values(:placa, :marca, :linea, :movil, :empresa, :pago, :modelo, :city_id, :factor, :id_empresa, :id_brand, :id_line)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':placa', $arg_placa);
    $statement->bindParam(':marca', $arg_marca);
    $statement->bindParam(':linea', $arg_lineaVehiculo);
    $statement->bindParam(':movil', $arg_movil);
    $statement->bindParam(':empresa', $arg_empresa);
    $statement->bindParam(':pago', $arg_pago);
    $statement->bindParam(':modelo', $arg_modelo);
    $statement->bindParam(':city_id', $arg_city_id);
    $statement->bindParam(':factor', $arg_factor);
    $statement->bindParam(':id_empresa', $arg_id_empresa);
    $statement->bindParam(':id_brand', $arg_id_brand);
    $statement->bindParam(':id_line', $arg_id_line);

    if (!$statement) {
      //return header("Location: ../../views/mensajes/error.php");
      return FALSE;
    }else{
      $statement->execute();
      //return header("Location: ../../views/mensajes/registro_exitoso.php");
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarVehiculo($arg_idVehiculo){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars where id = :idVehiculo LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_idVehiculo);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarVehiculo($arg_placa, $arg_marca, $arg_lineaVehiculo, $arg_movil, $arg_empresa, $arg_pago, $arg_modelo, $arg_city_id, $arg_estado, $arg_factor, $arg_id_empresa, $arg_id_marca, $arg_id_linea, $arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cars set placa = :placa, car_brand = :marca, model = :linea, movil= :movil, empresa = :empresa, pay_date = :pago, year = :modelo, city_id = :city_id, estado = :estado, factor = :factor, id_empresa = :id_empresa, id_brand = :id_brand, id_line = :id_line where id = :idVehiculo";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':placa', $arg_placa);
    $statement->bindParam(':marca', $arg_marca);
    $statement->bindParam(':linea', $arg_lineaVehiculo);
    $statement->bindParam(':movil', $arg_movil);
    $statement->bindParam(':empresa', $arg_empresa);
    $statement->bindParam(':pago', $arg_pago);
    $statement->bindParam(':modelo', $arg_modelo);
    $statement->bindParam(':city_id', $arg_city_id);
    $statement->bindParam(':estado', $arg_estado);
    $statement->bindParam(':factor', $arg_factor);
    $statement->bindParam(':id_empresa', $arg_id_empresa);
    $statement->bindParam(':id_brand', $arg_id_marca);
    $statement->bindParam(':id_line', $arg_id_linea);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    if (!$statement) {
      //return header("Location: ../../views/mensajes/error.php");
      return FALSE;
    }else{
      $statement->execute();
      //return header("Location: ../../views/administrador/home.php");
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function buscarPlaca($arg_idVehiculo){
     $modelo = new Conexion();
     $rows = null;
     $conexion = $modelo->get_conexion();
     $sql = "select placa from cars where id = :idVehiculo LIMIT 1";
     $statement = $conexion->prepare($sql);
     $statement->bindParam(':idVehiculo', $arg_idVehiculo);
     if (!$statement) {
       return header("Location: ../../views/mensajes/error.php");

     }else{
       $statement->execute();
       $rows = $statement->fetchColumn();

       return $rows;
     }
     $conexion = $modelo->close_conexion($statement, $conexion);


  }

  public function placasMarcas(){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id, placa, car_brand from cars";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function placasMarcasXConductor($arg_idVehiculo){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id, placa, car_brand from cars where id = :idVehiculo";
    $statement = $conexion->prepare($sql);
        $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function buscarMovil($arg_id){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select movil from cars where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $row = $statement->fetchColumn();
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarVehiculoD($arg_placa, $arg_marca, $arg_lineaVehiculo, $arg_movil, $arg_empresa, $arg_pago,  $arg_modelo, $arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cars set placa = :placa, car_brand = :marca, model = :linea, movil= :movil, empresa = :empresa, pay_date = :pago, year = :modelo where id = :idVehiculo";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':placa', $arg_placa);
    $statement->bindParam(':marca', $arg_marca);
    $statement->bindParam(':linea', $arg_lineaVehiculo);
    $statement->bindParam(':movil', $arg_movil);
    $statement->bindParam(':empresa', $arg_empresa);
    $statement->bindParam(':pago', $arg_pago);
    $statement->bindParam(':modelo', $arg_modelo);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    if (!$statement) {
      return FALSE;

    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function validarVehiculo($arg_placa){
    $modelo = new Conexion();
    $rows = null;
    $conexion = $modelo->get_conexion();
    $sql = "select estado from cars where placa = :placa LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':placa', $arg_placa);
    if (!$statement) {
      return header("Location: ../../views/mensajes/error.php");
    }else{
      $statement->execute();
      $rows = $statement->fetchColumn();
      return $rows;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }


  public function obtenerUltimoIdVehiculo(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select max(id) from cars";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPlacas($arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select placa from cars where id = :idVehiculo LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    $statement->execute();
    $placa = $statement->fetchColumn();
    return $placa;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }


  public function obtenerMarca($arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select car_brand from cars where id = :idVehiculo LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    $statement->execute();
    $marca = $statement->fetchColumn();
    return $marca;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerLinea($arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select model from cars where id = :idVehiculo LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    $statement->execute();
    $linea = $statement->fetchColumn();
    return $linea;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function eliminarVehiculo($arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "delete from cars where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idVehiculo);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function EstadoVehiculo($arg_idVehiculo){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cars set estado = 2 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idVehiculo);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerIdVehiculo($arg_placa){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id from cars where placa = :placa LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':placa', $arg_placa);
    $statement->execute();
    $placa = $statement->fetchColumn();
    return $placa;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function actualizarVehiculoEstado($arg_placa, $arg_marca, $arg_lineaVehiculo, $arg_movil, $arg_empresa, $arg_pago, $arg_modelo, $arg_city_id, $arg_factor, $arg_id_empresa, $arg_id_marca, $arg_id_linea, $arg_idVehiculo){

    $estado = 1;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update cars set placa = :placa, car_brand = :marca, model = :linea, movil= :movil, empresa = :empresa, pay_date = :pago, year = :modelo, city_id = :city_id, estado = :estado, factor = :factor, id_empresa = :id_empresa, id_brand = :id_brand, id_line = :id_line where id = :idVehiculo";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':placa', $arg_placa);
    $statement->bindParam(':marca', $arg_marca);
    $statement->bindParam(':linea', $arg_lineaVehiculo);
    $statement->bindParam(':movil', $arg_movil);
    $statement->bindParam(':empresa', $arg_empresa);
    $statement->bindParam(':pago', $arg_pago);
    $statement->bindParam(':modelo', $arg_modelo);
    $statement->bindParam(':city_id', $arg_city_id);
    $statement->bindParam(':estado', $estado);
    $statement->bindParam(':factor', $arg_factor);
    $statement->bindParam(':id_empresa', $arg_id_empresa);
    $statement->bindParam(':id_brand', $arg_id_marca);
    $statement->bindParam(':id_line', $arg_id_linea);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);

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
    $sql = "select * from cars where $campo like :item and estado = 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":item", $item);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNumeroCarros(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select count(*) from cars where estado = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $numero = $statement->fetchColumn();
    return $numero;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtenerFactorVehiculo($arg_idVehiculo){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select factor from cars where id = :idVehiculo";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idVehiculo", $arg_idVehiculo);
    $statement->execute();
    $factor = $statement->fetchColumn();
    return $factor;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function todosVehiculosXEmpresa($arg_idEmpresa){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars where estado = 1 and id_empresa = :idEmpresa";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idEmpresa", $arg_idEmpresa);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNumeroCarrosXEmpresa($arg_idEmpresa){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select count(*) from cars where estado = 1 and id_empresa = :idEmpresa";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idEmpresa", $arg_idEmpresa);
    $statement->execute();
    $numero = $statement->fetchColumn();
    return $numero;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function listaCarrosFueraServicio(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars where estado = 1 ";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaCarrosFueraServicioXEmpresa($arg_idEmpresa){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from cars where estado = 1 and id_empresa = :idEmpresa";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idEmpresa", $arg_idEmpresa);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

}

 ?>
