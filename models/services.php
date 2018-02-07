<?php
class Services{
  public function todosServicios(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function todosServiciosEspera(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 1 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosServiciosAsignado(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 2 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosServiciosFinalizado(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 5 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosServiciosCanceladoSistema(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 7 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosServiciosCanceladoSistemaLista(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 7 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosServiciosCanceladoConductor(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 8 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosServiciosOperadora(){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where status_id = 9 order by id desc LIMIT 500";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while($result = $statement->fetch()){
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerUltimoIdServicio(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select max(id) from services";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function crearServicio($arg_idUsuario, $arg_lat, $arg_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_kind_id, $arg_created_at, $arg_destination, $arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_userCarReference, $arg_code, $arg_companyId, $arg_commit){
    //variables quemadas
    //$status = 10;
    $status = 1;
    $update_at = $arg_created_at;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into services(user_id, from_lat, from_lng, status_id, index_id, comp1, comp2, no, barrio, kind_id, destination, user_name, address, cms_user_id, pay_type, pay_reference, user_card_reference, code, company_id, commit)values(:usuario_id, :lat, :lng, :status, :index_id, :comp1, :comp2, :no, :barrio, :kind_id, :updated_at, :created_at, :destination, :user_name, :address, :cms_user_id, :pay_type, :pay_reference, :user_card_reference, :code, :company_id, :commit)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':usuario_id',$arg_idUsuario);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':index_id',$arg_avenida);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':kind_id', $arg_kind_id);
    $statement->bindParam(':updated_at', $update_at);
    $statement->bindParam(':created_at', $arg_created_at);
    $statement->bindParam(':destination', $arg_destination);
    $statement->bindParam(':user_name', $arg_user_name);
    $statement->bindParam(':address', $arg_address);
    $statement->bindParam(':cms_user_id', $arg_cms_user_id);
    $statement->bindParam(':pay_type', $arg_pay_type);
    $statement->bindParam(':pay_reference', $arg_pay_reference);
    $statement->bindParam(':user_card_reference', $arg_userCarReference);
    $statement->bindParam(':code', $arg_code);
    $statement->bindParam(':company_id', $arg_companyId);
    $statement->bindParam(':commit', $arg_commit);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function crearServicioEfectivo($arg_idUsuario, $arg_lat, $arg_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_commit, $arg_kind_id, $arg_destination,$arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_code){
    //variables quemadas
    $status = 1;
    $schedule_id = 0;
    $user_card_reference = "0";
    $user_email = "0";
    $units = 0;
    $charge1 = "0";
    $charge2 = "0";
    $charge3 = "0";
    $charge4 = "0";
    $value = 0;
    $cedula = "0";
    $commit = "";




    //var_dump('modelo= ',  $arg_idUsuario, $arg_lat, $arg_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_kind_id, $arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_code, $arg_commit);

    //$update_at = $arg_created_at;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    $sql = "insert into services(user_id, from_lat, from_lng, status_id, index_id, comp1, comp2, no, barrio, obs, kind_id, schedule_id, destination, user_name, address, cms_users_id, pay_type, pay_reference, user_card_reference, user_email, units, charge1, charge2, charge3, charge4, value, code, cedula, commit)values(:usuario_id, :lat, :lng, :status, :index_id, :comp1, :comp2, :no, :barrio, :obs, :kind_id, :schedule_id,:destination, :user_name, :address, :cms_user_id, :pay_type, :pay_reference, :user_card_reference, :user_email, :units, :charge1, :charge2, :charge3, :charge4, :value, :code, :cedula, :commit)";

    $statement = $conexion->prepare($sql);
    $statement->bindParam(':usuario_id',$arg_idUsuario);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':index_id',$arg_avenida);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':obs', $arg_commit);
    $statement->bindParam(':kind_id', $arg_kind_id);
    $statement->bindParam(':schedule_id', $schedule_id);
    $statement->bindParam(':destination', $arg_destination);
    $statement->bindParam(':user_name', $arg_user_name);
    $statement->bindParam(':address', $arg_address);
    $statement->bindParam(':cms_user_id', $arg_cms_user_id);
    $statement->bindParam(':pay_type', $arg_pay_type);
    $statement->bindParam(':pay_reference', $arg_pay_reference);
    $statement->bindParam(':user_card_reference', $user_card_reference);
    $statement->bindParam(':user_email', $user_email);
    $statement->bindParam(':units', $units);
    $statement->bindParam(':charge1', $charge1);
    $statement->bindParam(':charge2', $charge2);
    $statement->bindParam(':charge3', $charge3);
    $statement->bindParam(':charge4', $charge4);
    $statement->bindParam(':value', $value);
    $statement->bindParam(':code', $arg_code);
    $statement->bindParam(':cedula', $cedula);
    $statement->bindParam(':commit', $commit);

    if (!$statement) {
      return FALSE;
    }else{
      //var_dump('verficar: ', $statement);
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function crearServicioVale($arg_idUsuario, $arg_lat, $arg_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_observaciones,$arg_kind_id,$arg_destination,$arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_vale,$arg_code, $arg_companiaId,$arg_commit){
    //variables quemadas
    $status = 1;
    $schedule_id = 0;
    $user_email = "0";
    $units = 0;
    $charge1 = "0";
    $charge2 = "0";
    $charge3 = "0";
    $charge4 = "0";
    $value = 0;
    $cedula = "0";



    //$update_at = $arg_created_at;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    $sql = "insert into services(user_id, from_lat, from_lng, status_id, index_id, comp1, comp2, no, barrio, obs, kind_id, schedule_id, destination, user_name, address, cms_users_id, pay_type, pay_reference, user_card_reference, user_email, units, charge1, charge2, charge3, charge4, value, code, company_id, cedula, commit) values (:usuario_id, :lat, :lng, :status, :index_id, :comp1, :comp2, :no, :barrio, :observaciones, :kind_id, :schedule_id, :destination, :user_name, :address, :cms_user_id, :pay_type, :pay_reference, :user_card_reference, :user_email, :units, :charge1, :charge2, :charge3, :charge4, :value, :code, :company_id, :cedula, :commit)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':usuario_id', $arg_idUsuario);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':index_id',$arg_avenida);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':observaciones', $arg_observaciones);
    $statement->bindParam(':kind_id', $arg_kind_id);
    $statement->bindParam(':schedule_id', $schedule_id);
    $statement->bindParam(':destination', $arg_destination);
    $statement->bindParam(':user_name', $arg_user_name);
    $statement->bindParam(':address', $arg_address);
    $statement->bindParam(':cms_user_id', $arg_cms_user_id);
    $statement->bindParam(':pay_type', $arg_pay_type);
    $statement->bindParam(':pay_reference', $arg_pay_reference);
    $statement->bindParam(':user_card_reference', $arg_vale);
    $statement->bindParam(':user_email', $user_email);
    $statement->bindParam(':units', $units);
    $statement->bindParam(':charge1', $charge1);
    $statement->bindParam(':charge2', $charge2);
    $statement->bindParam(':charge3', $charge3);
    $statement->bindParam(':charge4', $charge4);
    $statement->bindParam(':value', $value);
    $statement->bindParam(':code', $arg_code);
    $statement->bindParam(':company_id', $arg_companiaId);
    $statement->bindParam(':cedula', $cedula);
    $statement->bindParam(':commit', $arg_commit);
    if (!$statement) {
      return FALSE;
    }else{

      $statement->execute();

      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }
  public function crearServicioValeWS($arg_idUsuario, $arg_lat, $arg_lng, $arg_to_lat, $arg_to_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_observaciones,$arg_kind_id,$arg_destination,$arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_vale, $arg_charge1, $arg_charge2, $arg_charge3, $arg_charge4, $arg_code,
  $arg_companiaId,$arg_commit, $arg_km_recorrido, $arg_tiempo_recorido, $arg_valor_app){
    //variables quemadas
    $status = 1;
    $schedule_id = 0;
    $user_email = "0";
    $units = 0;
    $value = 0;
    $cedula = "0";

    //var_dump('modelo= ',  $arg_idUsuario, $arg_lat, $arg_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_kind_id, $arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_code, $arg_commit);

    //$update_at = $arg_created_at;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    $sql = "insert into services (user_id, from_lat, from_lng, status_id, to_lat, to_lng, index_id, comp1, comp2, no, barrio, obs, kind_id, schedule_id, destination, user_name, address, cms_users_id, pay_type, pay_reference, user_card_reference, user_email, units, charge1, charge2, charge3, charge4, value, code, company_id, cedula, commit, km_recorrido, tiempo_recorido, valor_app)values(:usuario_id, :lat, :lng, :status, :to_lat, :to_lng, :index_id, :comp1, :comp2, :no, :barrio, :observaciones, :kind_id, :schedule_id, :destination, :user_name, :address, :cms_user_id, :pay_type, :pay_reference, :user_card_reference, :user_email, :units, :charge1, :charge2, :charge3, :charge4, :value, :code, :company_id, :cedula, :commit, :km_recorrido, :tiempo_recorido, :valor_app)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':usuario_id', $arg_idUsuario);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':to_lat', $arg_to_lat);
    $statement->bindParam(':to_lng', $arg_to_lng);
    $statement->bindParam(':index_id',$arg_avenida);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':observaciones', $arg_observaciones);
    $statement->bindParam(':kind_id', $arg_kind_id);
    $statement->bindParam(':schedule_id', $schedule_id);
    $statement->bindParam(':destination', $arg_destination);
    $statement->bindParam(':user_name', $arg_user_name);
    $statement->bindParam(':address', $arg_address);
    $statement->bindParam(':cms_user_id', $arg_cms_user_id);
    $statement->bindParam(':pay_type', $arg_pay_type);
    $statement->bindParam(':pay_reference', $arg_pay_reference);
    $statement->bindParam(':user_card_reference', $arg_vale);
    $statement->bindParam(':user_email', $user_email);
    $statement->bindParam(':units', $units);
    $statement->bindParam(':charge1', $arg_charge1);
    $statement->bindParam(':charge2', $arg_charge2);
    $statement->bindParam(':charge3', $arg_charge3);
    $statement->bindParam(':charge4', $arg_charge4);
    $statement->bindParam(':value', $value);
    $statement->bindParam(':code', $arg_code);
    $statement->bindParam(':company_id', $arg_companiaId);
    $statement->bindParam(':cedula', $cedula);
    $statement->bindParam(':commit', $arg_commit);
    $statement->bindParam(':km_recorrido', $arg_km_recorrido);
    $statement->bindParam(':tiempo_recorido', $arg_tiempo_recorido);
    $statement->bindParam(':valor_app', $arg_valor_app);
    if (!$statement) {
      return FALSE;
    }else{
      //var_dump('verficar: ', $statement);
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function crearServicioEfectivoWS($arg_idUsuario, $arg_lat, $arg_lng,$arg_to_lat, $arg_to_lng, $arg_avenida, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_observaciones,$arg_kind_id,$arg_destination,$arg_user_name, $arg_address, $arg_cms_user_id, $arg_pay_type, $arg_pay_reference, $arg_charge1, $arg_charge2, $arg_charge3, $arg_charge4, $arg_code, $arg_companiaId, $arg_km_recorrido,
                                          $arg_tiempo_recorido, $arg_valor_app){
    //variables quemadas
    $status = 1;
    $schedule_id = 0;
    $user_card_reference = "0";
    $user_email = "0";
    $units = 0;
    $value = 0;
    $cedula = "0";
    $commit = "";

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    $sql = "insert into services (user_id, from_lat, from_lng, status_id, to_lat, to_lng, index_id, comp1, comp2, no, barrio, obs, kind_id, schedule_id, destination, user_name, address, cms_users_id, pay_type, pay_reference, user_card_reference, user_email, units, charge1, charge2, charge3, charge4, value, code, company_id, cedula, commit, km_recorrido, tiempo_recorido, valor_app)values(:usuario_id, :lat, :lng, :status, :to_lat, :to_lng, :index_id, :comp1, :comp2, :no, :barrio, :observaciones,:kind_id, :schedule_id, :destination, :user_name, :address, :cms_user_id, :pay_type, :pay_reference, :user_card_reference, :user_email, :units, :charge1, :charge2, :charge3, :charge4, :value, :code, :company_id, :cedula, :commit, :km_recorrido, :tiempo_recorido, :valor_app)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':usuario_id',$arg_idUsuario);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);
    $statement->bindParam(':status', $status);
    $statement->bindParam(':to_lat', $arg_to_lat);
    $statement->bindParam(':to_lng', $arg_to_lng);
    $statement->bindParam(':index_id',$arg_avenida);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':observaciones', $arg_observaciones);
    $statement->bindParam(':kind_id', $arg_kind_id);
    $statement->bindParam(':schedule_id', $schedule_id);
    $statement->bindParam(':destination', $arg_destination);
    $statement->bindParam(':user_name', $arg_user_name);
    $statement->bindParam(':address', $arg_address);
    $statement->bindParam(':cms_user_id', $arg_cms_user_id);
    $statement->bindParam(':pay_type', $arg_pay_type);
    $statement->bindParam(':pay_reference', $arg_pay_reference);
    $statement->bindParam(':user_card_reference', $user_card_reference);
    $statement->bindParam(':user_email', $user_email);
    $statement->bindParam(':units', $units);
    $statement->bindParam(':charge1', $arg_charge1);
    $statement->bindParam(':charge2', $arg_charge2);
    $statement->bindParam(':charge3', $arg_charge3);
    $statement->bindParam(':charge4', $arg_charge4);
    $statement->bindParam(':value', $value);
    $statement->bindParam(':code', $arg_code);
    $statement->bindParam(':company_id', $arg_companiaId);
    $statement->bindParam(':cedula', $cedula);
    $statement->bindParam(':commit', $commit);
    $statement->bindParam(':km_recorrido', $arg_km_recorrido);
    $statement->bindParam(':tiempo_recorido', $arg_tiempo_recorido);
    $statement->bindParam(':valor_app', $arg_valor_app);
    if (!$statement) {
      return FALSE;
    }else{
      //var_dump('verficar: ', $statement);
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }


  public function tablaServicios(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from services order by id desc LIMIT 50";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function tablaServiciosXUsuario($arg_idUserCms){

    $rows = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where cms_users_id = :idUserCms order by id desc LIMIT 10";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idUserCms', $arg_idUserCms);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cancelarServicioOperadora($arg_idServicio){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update services set status_id = 9 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idServicio);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarServicio($arg_idServicio){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from services where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idServicio);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarServicio($arg_idServicio){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "";
  }

  public function reporteSercioTodo($arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    //$sql = "select * from services where created_at between :fecha1 and :fecha2";
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function reporteServicioTodoFinalizados($arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    //$sql = "select * from services where created_at between :fecha1 and :fecha2";
    $sql = "select id, user_id, user_name, driver_id, car_id, address, barrio, destination, pay_reference, user_card_reference, units, charge1, charge2, charge3, charge4, value, created_at, updated_at, qualification from services where status_id = 5 and created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function reporteServicioTodoTodo($arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    //$sql = "select * from services where created_at between :fecha1 and :fecha2";
    $sql = "select id, user_id, user_name, driver_id, car_id, address, barrio, destination, pay_reference, user_card_reference, units, charge1, charge2, charge3, charge4, value, created_at, updated_at, qualification from services where created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function  reporteServicioConductor($arg_idConductor, $arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.driver_id = :idconductor and services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idconductor', $arg_idConductor);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function  reporteServicioConductorTS($arg_idConductor, $arg_tipo, $arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.driver_id = :idconductor and services.kind_id = :tipo and services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idconductor', $arg_idConductor);
    $statement->bindParam(':tipo', $arg_tipo);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function reporteVehiculo($arg_idVehiculo, $arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.car_id = :idVehiculo and services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function  reporteServicioVehiculoTS($arg_idVehiculo, $arg_tipo, $arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.car_id = :idVehiculo and services.kind_id = :tipo and services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idVehiculo', $arg_idVehiculo);
    $statement->bindParam(':tipo', $arg_tipo);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function reporteUsuario($arg_idusuario, $arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.user_id = :idUsusario and services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idUsusario', $arg_idusuario);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function  reporteServicioUsuarioTS($arg_idusuario, $arg_tipo, $arg_fecha1, $arg_fecha2){
    $modelo = new Conexion();
    $row = null;
    $conexion = $modelo->get_conexion();
    $sql = "select services.id,services.user_name, drivers.name, drivers.lastname, cars.placa, services.address, services.barrio, services.destination, services.pay_reference, services.user_card_reference, services.units, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.created_at,  services.updated_at, services.qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.user_id = :idUsusario and services.kind_id = :tipo and services.created_at between :fecha1 and :fecha2";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idUsusario', $arg_idusuario);
    $statement->bindParam(':tipo', $arg_tipo);
    $statement->bindParam(':fecha1', $arg_fecha1);
    $statement->bindParam(':fecha2', $arg_fecha2);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtnerIdUsuarioXIdServicio($arg_id){
    $id  = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select user_id from services where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

public function reporterExcelFinalizados(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 5";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function reporterExcelFinalizadosLimit($arg_limite){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $row = null;
  $limit = "LIMIT $arg_limite";
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 5 order by services.id desc $limit";
  $statement = $conexion->prepare($sql);
  //$statement->bindParam(':limite', $limit);
  $statement->execute();


  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function reporterExcelCanceladoSistema(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 7";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function reporterExcelCanceladosSistemaLimit($arg_limite){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $row = null;
  $limit = "LIMIT $arg_limite";
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 7 order by services.id desc $limit";
  $statement = $conexion->prepare($sql);
  //$statement->bindParam(':limite', $limit);
  $statement->execute();


  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function reporterExcelCanceladoConductor(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 8";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function reporterExcelCanceladosConductorLimit($arg_limite){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $row = null;
  $limit = "LIMIT $arg_limite";
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 8 order by services.id desc $limit";
  $statement = $conexion->prepare($sql);
  //$statement->bindParam(':limite', $limit);
  $statement->execute();


  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function reporterExcelCanceladoOperador(){
  $modelo = new Conexion();
  $rows = null;
  $conexion = $modelo->get_conexion();
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 9";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function reporterExcelCanceladosOperadorLimit($arg_limite){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $row = null;
  $limit = "LIMIT $arg_limite";
  $sql = "select services.id, services.user_id as idUsuario,services.user_name, drivers.name as nombreConductor, drivers.lastname as apellidoConductor, cars.placa, cars.car_brand, cars.model, services.created_at, services.updated_at, services.address, services.destination, services.pay_type, services.pay_reference, services.user_card_reference, services.commit, services.charge1, services.charge2, services.charge3, services.charge4, services.value, services.qualification, services.reason_qualification from services inner join drivers on services.driver_id = drivers.id inner join cars on services.car_id = cars.id where services.status_id = 9 order by services.id desc $limit";
  $statement = $conexion->prepare($sql);
  //$statement->bindParam(':limite', $limit);
  $statement->execute();


  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}


public function todosServiciosCompania($arg_idCompania){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.barrio, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination, services.index_id, services.comp1, services.comp2, services.no, services.obs, services.barrio, services.address, services.qualification from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where ticket_tickets.company_id = :idCompania order by services.id desc LIMIT 200";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }

  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function prefijo($arg_idCc){
  $row = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select prefix from ticket_cost_centers where id = :idDepartamento LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idDepartamento', $arg_idCc);
  $statement->execute();
  $prefijo = $statement->fetchColumn();
  return $prefijo;
}

public function todosServiciosCompaniaXDepartamento($arg_prefijo){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.barrio, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where services.pay_type = 3 like services.user_card_reference = :prefijo LIMIT 300";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':prefijo', $arg_prefijo);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }

  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function todosServiciosMangerMes($arg_prefijo, $arg_mes, $arg_year){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $prefijoa = "%".$arg_prefijo."%";
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.barrio, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination, services.index_id, services.comp1, services.comp2, services.no, services.obs, services.barrio, services.address, services.qualification from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where (YEAR(services.created_at) = :year) and (MONTH(services.created_at) = :mes) and (services.pay_type = 3) and (services.status_id = 5) and (services.user_card_reference like :prefijo) LIMIT 300";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':prefijo', $prefijoa);
  $statement->bindParam(':mes', $arg_mes);
  $statement->bindParam(':year', $arg_year);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function todosServiciosAdministradorMes($arg_idCompania, $arg_mes){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.barrio, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination,services.index_id, services.comp1, services.comp2, services.no, services.obs, services.address, services.qualification from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where (MONTH(services.created_at) = :mes) and (services.pay_type = 3) and (ticket_tickets.company_id = :idCompania)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':mes', $arg_mes);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function todosServiciosAdministradorMesXAnio($arg_idCompania, $arg_mes, $arg_year){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.barrio, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination,services.index_id, services.comp1, services.comp2, services.no, services.obs, services.address, services.qualification from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where (YEAR(services.created_at) = :year) and (MONTH(services.created_at) = :mes) and (services.pay_type = 3) and (ticket_tickets.company_id = :idCompania)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':mes', $arg_mes);
  $statement->bindParam(':year', $arg_year);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function ReporteTodosServiciosAdministradorMesXAnio($arg_idCompania, $arg_mes, $arg_year){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.address, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination, services.qualification from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where (YEAR(services.created_at) = :year) and (MONTH(services.created_at) = :mes) and (services.pay_type = 3) and (ticket_tickets.company_id = :idCompania)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':mes', $arg_mes);
  $statement->bindParam(':year', $arg_year);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function ReporteTodosServiciosManagerMesXAnio($arg_idCompania, $arg_mes, $arg_year, $arg_centroCosto){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ticket_tickets.ticket, services.created_at, services.updated_at, services.user_name, cars.placa, services.address, services.units, services.charge1, services.charge2, services.charge4, services.value, services.commit, services.destination, services.qualification from services inner join ticket_tickets on ticket_tickets.ticket = services.user_card_reference inner join cars on services.car_id = cars.id where (YEAR(services.created_at) = :year) and (MONTH(services.created_at) = :mes) and (services.pay_type = 3) and (ticket_tickets.company_id = :idCompania) and (ticket_tickets.ticket_user_id = :centroCosto)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCompania', $arg_idCompania);
  $statement->bindParam(':mes', $arg_mes);
  $statement->bindParam(':year', $arg_year);
  $statement->bindParam(':centroCosto', $arg_centroCosto);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function estadoServicioFacturado(){
  $modelo = new Conexion ();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where status_id = 5 and facturado = 1 and pay_type = 3";
  //$sql = "select * from services where status_id = 5 and facturado = 1 and pay_type = 3 and user_card_reference like '%JV%'";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function estadoServicioFacturadoXCC($arg_prefijo){

  $rows= null;
  $modelo = new Conexion ();
  $conexion = $modelo->get_conexion();
  $idCc = '%'.$arg_prefijo.'%';
  $sql = "select * from services where status_id = 5 and facturado = 1 and pay_type = 3 and user_card_reference like :centro";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':centro', $idCc);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}


public function listaServiciosParaPagos($arg_idEmpresa){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ser.id, ser.user_card_reference, ser.user_name, ser.created_at, car.placa, dri.name, dri.lastname, dri.cedula, ser.state_payment, ser.address, ser.units, ser.charge1, ser.charge2, ser.charge3, ser.charge4, ser.value, ser.date_state_payment from services ser inner join cars car on ser.car_id = car.id inner join drivers dri on ser.driver_id = dri.id where ser.status_id = 5 and ser.company_id = :idEmpresa order by ser.id desc LIMIT 500";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idEmpresa', $arg_idEmpresa);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaServiciosParaPagosSinPagar($arg_idEmpresa){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ser.id, ser.user_card_reference, ser.user_name, ser.created_at, car.placa, dri.name, dri.lastname, dri.cedula, ser.state_payment, ser.address, ser.units, ser.charge1, ser.charge2, ser.charge3, ser.charge4, ser.value, ser.date_state_payment from services ser inner join cars car on ser.car_id = car.id left join drivers dri on ser.driver_id = dri.id where (ser.status_id = 5) and (ser.company_id = :idEmpresa) and (ser.state_payment = 0 or ser.state_payment = null) order by ser.id desc LIMIT 500";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idEmpresa', $arg_idEmpresa);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}



public function BusquedaServiciosParaPagos($arg_idEmpresa, $arg_campo, $arg_frase){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $campo = $arg_campo;
  $frase = '%'.$arg_frase.'%';
  $sql = "select ser.id, ser.user_card_reference, ser.user_name, ser.created_at, car.placa, dri.name, dri.lastname, dri.cedula, ser.state_payment, ser.address, ser.units, ser.charge1, ser.charge2, ser.charge3, ser.charge4, ser.value, ser.date_state_payment from services ser inner join cars car on ser.car_id = car.id left join drivers dri on ser.driver_id = dri.id where ser.status_id = 5 and ser.company_id = :idEmpresa and $campo like :frase order by ser.id desc LIMIT 50";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idEmpresa', $arg_idEmpresa);
  $statement->bindParam(':frase', $frase);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarServiciosParaPagos($arg_idEmpresa, $arg_idServicio){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ser.id, ser.user_card_reference, ser.user_name, ser.created_at, car.placa, dri.name, dri.lastname, ser.state_payment, ser.units, ser.charge1, ser.charge2, ser.charge3, ser.charge4, ser.value from services ser inner join cars car on ser.car_id = car.id left join drivers dri on ser.driver_id = dri.id where ser.status_id = 5 and ser.company_id = :idEmpresa and ser.id = :idServicio LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idEmpresa', $arg_idEmpresa);
  $statement->bindParam(':idServicio', $arg_idServicio);
  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function modificarPago($arg_units, $arg_charge1, $arg_charge2, $arg_charge3, $arg_charge4, $arg_value, $arg_state_payment, $arg_date_state_payment, $arg_idServicio){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set units = :units, charge1 = :charge1, charge2 = :charge2, charge3 = :charge3, charge4 = :charge4, value = :value, state_payment = :state_payment, date_state_payment = :date_state_payment where id = :idServicio";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':units', $arg_units);
  $statement->bindParam(':charge1', $arg_charge1);
  $statement->bindParam(':charge2', $arg_charge2);
  $statement->bindParam(':charge3', $arg_charge3);
  $statement->bindParam(':charge4', $arg_charge4);
  $statement->bindParam(':value', $arg_value);
  $statement->bindParam(':state_payment', $arg_state_payment);
  $statement->bindParam(':date_state_payment', $arg_date_state_payment);
  $statement->bindParam(':idServicio', $arg_idServicio);

  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function infoPagos($arg_idServicio, $arg_idEmpresa){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ser.id, ser.user_card_reference, ser.user_name, ser.created_at, car.placa, dri.name, dri.lastname, ser.state_payment, ser.units, ser.charge1, ser.charge2, ser.charge3, ser.charge4, ser.value, ser.state_payment, ser.date_state_payment from services ser inner join cars car on ser.car_id = car.id inner join drivers dri on ser.driver_id = dri.id where ser.id = :idServicio and ser.company_id = :idEmpresa LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idServicio', $arg_idServicio);
  $statement->bindParam(':idEmpresa', $arg_idEmpresa);

  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function infoPagosfacturados($arg_idServicio, $arg_idEmpresa){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select ser.id, ser.user_card_reference, ser.user_name, ser.created_at, car.placa, dri.name, dri.lastname, ser.state_payment, ser.units, ser.charge1, ser.charge2, ser.charge3, ser.charge4, ser.value, ser.state_payment, ser.date_state_payment, pay.n_recibo, pay.estado_facturado, pay.fecha_facturado from services ser left join cars car on ser.car_id = car.id left join drivers dri on ser.driver_id = dri.id left join payments pay on ser.id = pay.id_services where ser.id = :idServicio and ser.company_id = :idEmpresa LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idServicio', $arg_idServicio);
  $statement->bindParam(':idEmpresa', $arg_idEmpresa);

  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cancelarServiciosAutomaticamente(){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  //$sql = "update services set status_id = 7 where (status_id = 1) and (timediff(created_at,now()) < '-00:05:00')";
  $sql = "update services set status_id = 7 where (kind_id = 3) and (status_id = 1) and (timediff(now(),created_at) > '00:01:30')";
  $statement = $conexion->prepare($sql);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function obtenerEstadoServicio($arg_idServicio){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select status_id from services where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idServicio);
  $statement->execute();
  $estado = $statement->fetchColumn();
  return $estado;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerServicioXId($arg_idServicio){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_idServicio);

  $statement->execute();
  while ($result = $statement->fetch()) {

    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function cambiarEstadoServicioPrevio($arg_idServicio){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set status_id = 1 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_idServicio);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerEstadoPagoServicio($arg_idServicio){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select state_payment from services where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idServicio);
  $statement->execute();
  $estado = $statement->fetchColumn();
  return $estado;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerValorServicio($arg_idServicio){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select value from services where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idServicio);
  $statement->execute();
  $estado = $statement->fetchColumn();
  return $estado;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function modificarEstadoPago($arg_idServicio, $arg_fechaPago){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set state_payment = 1, date_state_payment = :fecha where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_idServicio);
  $statement->bindParam(':fecha', $arg_fechaPago);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerIdConductorServicio(){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select driver_id from services where id = :idServicio";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idServicio', $arg_idServicio);
  $statement->execute();
  $estado = $statement->fetchColumn();
  return $estado;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerEstadoServicioXVehiculo($arg_idVehiculo){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select status_id from services where car_id = :idVehiculo order by id desc LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idVehiculo', $arg_idVehiculo);
  $statement->execute();
  $estado = $statement->fetchColumn();
  return $estado;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function obtenerIdCarreraXVehiculo($arg_idVehiculo){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select id from services where car_id = :idVehiculo and status_id = 4  order by id desc LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idVehiculo', $arg_idVehiculo);
  $statement->execute();
  $idCarrera = $statement->fetchColumn();
  return $idCarrera;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function actualizarServicio($arg_to_lat,$arg_to_lng, $arg_qualification, $arg_km_recorrido, $arg_tiempo_recorido, $arg_valor_app, $arg_id){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set to_lat = :to_lat, to_lng = :to_lng, qualification = :qualification, km_recorrido = :km_recorrido, tiempo_recorido = :tiempo_recorido, valor_app = :valor_app where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":to_lat", $arg_to_lat);
  $statement->bindParam(":to_lng", $arg_to_lng);
  $statement->bindParam(":qualification", $arg_qualification);
  $statement->bindParam(":km_recorrido", $arg_km_recorrido);
  $statement->bindParam(":tiempo_recorido", $arg_tiempo_recorido);
  $statement->bindParam(":valor_app", $arg_valor_app);
  $statement->bindParam(":id", $arg_id);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function crearServicioInterrumpido($arg_user_id,$arg_driver_id,$arg_car_id,$arg_from_lat,$arg_from_lng,$arg_status_id,$arg_to_lat,$arg_to_lng,$arg_barrio,$arg_obs,$arg_kind_id,$arg_created_at,$arg_destination,$arg_user_name,$arg_address,$arg_cms_users_id,$arg_pay_type,$arg_pay_reference,$arg_user_card_reference,$arg_charge1,$arg_charge2,$arg_charge3,$arg_charge4,$arg_code,$arg_company_id,$arg_state_payment,$arg_commit,$arg_km_recorrido,$arg_tiempo_recorido,$arg_valor_app,$arg_n_pasajeros,$arg_id_carrera_ant,$arg_valor_total){

  //Variables quemadas

  $schedule_id = 0;
  $user_email = "0";
  $units = 0;
  $value = 0;
  $cedula = "0";

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "insert into services(user_id, driver_id, car_id, from_lat, from_lng, status_id, to_lat, to_lng, barrio, obs, kind_id, schedule_id, created_at, destination, user_name, address, cms_users_id, pay_type, pay_reference, user_card_reference, user_email, units, charge1, charge2, charge3, charge4, value, code, company_id, state_payment, cedula, commit, km_recorrido, tiempo_recorido, valor_app, n_pasajeros, id_carrera_ant, valor_total) values (:user_id, :driver_id, :car_id, :from_lat, :from_lng, :status_id, :to_lat, :to_lng, :barrio, :obs, :kind_id, :schedule_id, :created_at, :destination, :user_name, :address, :cms_users_id, :pay_type, :pay_reference, :user_card_reference, :user_email, :units, :charge1, :charge2, :charge3, :charge4, :value, :code, :company_id, :state_payment, :cedula, :commit, :km_recorrido, :tiempo_recorido, :valor_app, :n_pasajeros, :id_carrera_ant, :valor_total)";

  $statement = $conexion->prepare($sql);
  $statement->bindParam(':user_id', $arg_user_id);
  $statement->bindParam(':driver_id', $arg_driver_id);
  $statement->bindParam(':car_id', $arg_car_id);
  $statement->bindParam(':from_lat', $arg_from_lat);
  $statement->bindParam(':from_lng', $arg_from_lng);
  $statement->bindParam(':status_id', $arg_status_id);
  $statement->bindParam(':to_lat', $arg_to_lat);
  $statement->bindParam(':to_lng', $arg_to_lng);
  $statement->bindParam(':barrio', $arg_barrio);
  $statement->bindParam(':obs', $arg_obs);
  $statement->bindParam(':kind_id', $arg_kind_id);
  $statement->bindParam(':schedule_id', $schedule_id);
  $statement->bindParam(':created_at', $arg_created_at);
  $statement->bindParam(':destination', $arg_destination);
  $statement->bindParam(':user_name', $arg_user_name);
  $statement->bindParam(':address', $arg_address);
  $statement->bindParam(':cms_users_id', $arg_cms_users_id);
  $statement->bindParam(':pay_type', $arg_pay_type);
  $statement->bindParam(':pay_reference', $arg_pay_reference);
  $statement->bindParam(':user_card_reference', $arg_user_card_reference);
  $statement->bindParam(':user_email', $user_email);
  $statement->bindParam(':units', $units);
  $statement->bindParam(':charge1', $arg_charge1);
  $statement->bindParam(':charge2', $arg_charge2);
  $statement->bindParam(':charge3', $arg_charge3);
  $statement->bindParam(':charge4', $arg_charge4);
  $statement->bindParam(':value', $value);
  $statement->bindParam(':code', $arg_code);
  $statement->bindParam(':company_id', $arg_company_id);
  $statement->bindParam(':state_payment', $arg_state_payment);
  $statement->bindParam(':cedula', $cedula);
  $statement->bindParam(':commit', $arg_commit);
  $statement->bindParam(':km_recorrido', $arg_km_recorrido);
  $statement->bindParam(':tiempo_recorido', $arg_tiempo_recorido);
  $statement->bindParam(':valor_app', $arg_valor_app);
  $statement->bindParam(':n_pasajeros', $arg_n_pasajeros);
  $statement->bindParam(':id_carrera_ant', $arg_id_carrera_ant);
  $statement->bindParam(':valor_total', $arg_valor_total);

  if (!$statement) {
    return FALSE;

    echo "\nPDO::errorInfo():\n";
    print_r($statement->errorInfo());
  }else{

  $statement->execute();


    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function finalizarServicioInterrumpido($arg_idServicio){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set status_id = 5 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id',$arg_idServicio);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}


public function terminarServicioOtraCiudad($arg_updated_at, $arg_units, $arg_charge1, $arg_charge2, $arg_charge3, $arg_charge4, $arg_value, $arg_idServicio){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set status_id = 5, updated_at = :updated_at, units = :units, charge1 = :charge1, charge2 = :charge2, charge3 = :charge3, charge4 = :charge4, value = :value where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':updated_at',$arg_updated_at);
  $statement->bindParam(':units',$arg_units);
  $statement->bindParam(':charge1',$arg_charge1);
  $statement->bindParam(':charge2',$arg_charge2);
  $statement->bindParam(':charge3',$arg_charge3);
  $statement->bindParam(':charge4',$arg_charge4);
  $statement->bindParam(':value',$arg_value);
  $statement->bindParam(':id',$arg_idServicio);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function terminarServicioWS($arg_updated_at, $arg_n_pasajeros, $arg_tiempo_recorido, $arg_idServicio){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update services set status_id = 5, updated_at = :updated_at, n_pasajeros = :n_pasajeros, tiempo_recorido = :tiempo_recorido where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':updated_at',$arg_updated_at);
  $statement->bindParam(':n_pasajeros',$arg_n_pasajeros);
  $statement->bindParam(':tiempo_recorido',$arg_tiempo_recorido);
  $statement->bindParam(':id',$arg_idServicio);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerServiciosXStatus($arg_campo, $arg_idCampo){

  $campo = $arg_campo;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where $campo = :idCampo and status_id = 1 or status_id = 2 or status_id =  3 or status_id = 4";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idCampo', $arg_idCampo);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function obtenerServiciosXStatusConductorSevicio($arg_idServicio, $arg_idConductor){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where (id = :idServicio and driver_id = :idCounductor) and (status_id = 1 or status_id = 2 or status_id =  3 or status_id = 4);";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idServicio', $arg_idServicio);
  $statement->bindParam(':idCounductor', $arg_idConductor);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function obtenerServiciosXValeCanceladosSistema(){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where (status_id = 7) and (pay_type = 3) order by id desc limit 10";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerServicioXVale($arg_user_card_reference){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where user_card_reference = :user_card_reference";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':user_card_reference', $arg_user_card_reference);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerServiciosXIdVehiculo($arg_idVehiculo){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from services where car_id = :idVehiculo";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idVehiculo', $arg_idVehiculo);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);

}



}

 ?>
