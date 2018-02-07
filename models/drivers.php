<?php
class Drivers {
  public function todosCoductores(){
    $modelo = new Conexion();
    $rows = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from drivers";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosCoductoresSistema(){
    $modelo = new Conexion();
    $rows = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from drivers where estado = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todosCoductoresEstado(){
    $modelo = new Conexion();
    $rows = null;
    $conexion = $modelo->get_conexion();
    $sql = "select * from drivers where estado = 1 order by id  desc LIMIT 400";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }


  public function agregarConductor($arg_email, $arg_password, $arg_placa, $arg_movil, $arg_celuar, $arg_foto, $arg_nombre, $arg_apellido, $arg_fechaCreacion, $arg_documento, $arg_direccion, $arg_telefono, $arg_Ciudad, $arg_numero_tc){
    $modelo = new Conexion();
    $rows = null ;
    //variables quemadas
    $score_driver = 5;
    $status = "true";
    $idCiudad = 1;
    $login = $arg_email;
    $licencia = $arg_documento;

    $conexion = $modelo->get_conexion();
    $sql = "insert into drivers (login, pwd, car_id, movil, cellphone, score_driver, picture, status, name, lastname, email, created_at, license, cedula, dir, telephone, city_id, numero_tc) values (:login, :password, :placa, :movil, :cellphone, :puntaje, :foto, :status, :name, :apellido, :email, :fechaCreacion, :license, :cedula, :direccion, :telefono, :idCiudad, :numero_tc)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":login", $login);
    $statement->bindParam(":password", $arg_password);
    $statement->bindParam(":placa", $arg_placa);
    $statement->bindParam(":movil", $arg_movil);
    $statement->bindParam(":cellphone", $arg_celuar);
    $statement->bindParam(":puntaje", $score_driver);
    $statement->bindParam(":foto", $arg_foto);
    $statement->bindParam(":status", $status);
    $statement->bindParam(":name", $arg_nombre);
    $statement->bindParam(":apellido", $arg_apellido);
    $statement->bindParam(":email", $arg_email);
    $statement->bindParam(":fechaCreacion", $arg_fechaCreacion);
    $statement->bindParam(":license", $licencia);
    $statement->bindParam(":cedula", $arg_documento);
    $statement->bindParam(":direccion", $arg_direccion);
    $statement->bindParam(":telefono", $arg_telefono);
    $statement->bindParam(":idCiudad", $arg_Ciudad);
    $statement->bindParam(":numero_tc", $arg_numero_tc);

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

  public function agregarConductorWeb($arg_email, $arg_password, $arg_placa, $arg_movil, $arg_celuar, $arg_foto, $arg_nombre, $arg_apellido, $arg_fechaCreacion, $arg_documento, $arg_direccion, $arg_telefono, $arg_Ciudad, $arg_numero_tc){
    $modelo = new Conexion();
    $rows = null ;
    //variables quemadas
    $score_driver = 5;
    $status = "nuevo";
    //$idCiudad = 1;
    $login = $arg_email;
    $licencia = $arg_documento;

    $conexion = $modelo->get_conexion();
    $sql = "insert into drivers (login, pwd, car_id, movil, cellphone, score_driver, picture, status, name, lastname, email, created_at, license, cedula, dir, telephone, city_id, numero_tc) values (:login, :password, :placa, :movil, :cellphone, :puntaje, :foto, :status, :name, :apellido, :email, :fechaCreacion, :license, :cedula, :direccion, :telefono, :idCiudad, :numero_tc)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":login", $login);
    $statement->bindParam(":password", $arg_password);
    $statement->bindParam(":placa", $arg_placa);
    $statement->bindParam(":movil", $arg_movil);
    $statement->bindParam(":cellphone", $arg_celuar);
    $statement->bindParam(":puntaje", $score_driver);
    $statement->bindParam(":foto", $arg_foto);
    $statement->bindParam(":status", $status);
    $statement->bindParam(":name", $arg_nombre);
    $statement->bindParam(":apellido", $arg_apellido);
    $statement->bindParam(":email", $arg_email);
    $statement->bindParam(":fechaCreacion", $arg_fechaCreacion);
    $statement->bindParam(":license", $licencia);
    $statement->bindParam(":cedula", $arg_documento);
    $statement->bindParam(":direccion", $arg_direccion);
    $statement->bindParam(":telefono", $arg_telefono);
    $statement->bindParam(":idCiudad", $arg_Ciudad);
    $statement->bindParam(":numero_tc", $arg_numero_tc);

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

  public function ultimoIdConductor(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $query = "select max(id) from drivers";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function verificarCorreoConductor($arg_email){
    $modelo = new Conexion();
    $rows = null;
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select id from drivers where email = :correo LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':correo', $arg_email);
    $statement->execute();
    $flag = $statement->fetchColumn();

      if ($flag == 0) {
        $flag = FALSE;
      }else{
        $flag = TRUE;
      }
    return $flag;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function verificarCedula($arg_cedula){
    $modelo = new Conexion();
    $flag = null;
    $conexion = $modelo->get_conexion();
    $sql = "select id from drivers where cedula = :cedula LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':cedula', $arg_cedula);
    $statement->execute();
    $flag = $statement->fetchColumn();

      if ($flag == 0) {
        $flag = FALSE;
      }else{
        $flag = TRUE;
      }
    return $flag;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function cargarConductor($arg_idConductor){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from drivers where id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function modificarConductor($arg_email, $arg_password, $arg_placa, $arg_movil, $arg_celuar, $arg_foto, $arg_nombre, $arg_apellido, $arg_fechaCreacion, $arg_documento, $arg_direccion, $arg_telefono, $arg_idConductor){

    //variables quemadas
    $score_driver = 5;
    $status = "true";
    $idCiudad = 1;
    $login = $arg_email;
    $licencia = $arg_documento;

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update drivers set login = :login, pwd = :password, car_id = :placa, movil = :movil, cellphone = :cellphone, score_driver = :puntaje, picture = :foto, status = :status, name = :name, lastname = :apellido, email = :email, updated_at = :fechaCreacion, license = :license, cedula = :cedula, dir = :direccion, telephone = :telefono, city_id = :idCiudad where id = :idConductor";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":login", $login);
    $statement->bindParam(":password", $arg_password);
    $statement->bindParam(":placa", $arg_placa);
    $statement->bindParam(":movil", $arg_movil);
    $statement->bindParam(":cellphone", $arg_celuar);
    $statement->bindParam(":puntaje", $score_driver);
    $statement->bindParam(":foto", $arg_foto);
    $statement->bindParam(":status", $status);
    $statement->bindParam(":name", $arg_nombre);
    $statement->bindParam(":apellido", $arg_apellido);
    $statement->bindParam(":email", $arg_email);
    $statement->bindParam(":fechaCreacion", $arg_fechaCreacion);
    $statement->bindParam(":license", $licencia);
    $statement->bindParam(":cedula", $arg_documento);
    $statement->bindParam(":direccion", $arg_direccion);
    $statement->bindParam(":telefono", $arg_telefono);
    $statement->bindParam(":idCiudad", $idCiudad);
    $statement->bindParam(":idConductor", $arg_idConductor);

    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function fotoConductor($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $query = "select picture from drivers where id = :idConductor";
    $statement = $conexion->prepare($query);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->execute();
    $foto = $statement->fetchColumn();
    return $foto;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function idCarroManeja($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select car_id from drivers where id = :idConductor";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaHistoricoCoductores(){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    //$sql = "select * from cms_documents left join drivers on cms_documents.driver_id = drivers.id union select * from cms_documents right join drivers on cms_documents.driver_id = drivers.id";
    //$sql = "select cms_documents.id as idDocumento, drivers.status, drivers.name, drivers.lastname, drivers.cellphone, drivers.email, cms_documents.documento1, drivers.id as idCond from cms_documents inner join drivers on cms_documents.driver_id = drivers.id";
    //$sql = "select * from drivers a left join cms_documents b on a.id = b.driver_id";
    $sql = "select a.id as idcont, a.status, a.name, a.lastname, a.cellphone, a.email, b.documento1 from drivers a left join cms_documents b on a.id = b.driver_id order by a.id desc";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }

    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaHistoricoCoductoresCentral(){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select a.id as idcont, a.status, a.name, a.lastname, a.cellphone, a.email, b.documento1 from drivers a left join cms_documents b on a.id = b.driver_id where (a.status = 'nuevo') or (a.status = 'false') order by a.id desc";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }

    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function listaHistoricoCoductoresBusqueda($arg_placa){
    $row = null;
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select drivers.id, drivers.status, drivers.name, drivers.lastname, drivers.cellphone, cars.placa, cms_documents.documento1 from drivers left join drivers_cars on drivers.id = drivers_cars.drivers_id left join cms_documents on drivers.id = cms_documents.driver_id left join cars on cars.id = drivers_cars.cars_id where cars.placa = :placa order by drivers.id desc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":placa", $arg_placa);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }

    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }




  public function cargarConductorDocumentos($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select a.id as idCond, a.login, a.pwd, a.car_id, a.movil, a.cellphone, a.score_driver, a.num_score, a.picture, a.status, a.account_status, a.name, a.lastname, a.email, a.created_at,a.crt_lat, a.crt_lng, a.uuid, a.updated_at, a.available, a.license, a.session_id, a.cedula, a.dir, a.telephone, a.join_date, a.token, a.city_id, b.id as idDoc, b.documento1, b.documento2, b.documento3, b.documento4, b.created_at, b.updated_at from drivers a left join cms_documents b on a.id = b.driver_id where a.id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":idConductor", $arg_idConductor);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $row[] = $result;
    }
    return $row;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarConductorD($arg_email, $arg_placa, $arg_celuar, $arg_foto, $arg_status, $arg_nombre, $arg_apellido, $arg_fechaCreacion, $arg_documento, $arg_direccion, $arg_telefono, $arg_idConductor){

    //variables quemadas
    $score_driver = 5;
    $idCiudad = 1;
    $login = $arg_email;
    $licencia = $arg_documento;
    $movil = 1;
    $estado = 1;

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update drivers set login = :login, movil = :movil, cellphone = :cellphone, score_driver = :puntaje, picture = :foto, status = :status, name = :name, lastname = :apellido, email = :email, updated_at = :fechaCreacion, license = :license, cedula = :cedula, dir = :direccion, telephone = :telefono, city_id = :idCiudad, estado = :estado where id = :idConductor";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":login", $login);
    $statement->bindParam(":movil", $movil);
    $statement->bindParam(":cellphone", $arg_celuar);
    $statement->bindParam(":puntaje", $score_driver);
    $statement->bindParam(":foto", $arg_foto);
    $statement->bindParam(":status", $arg_status);
    $statement->bindParam(":name", $arg_nombre);
    $statement->bindParam(":apellido", $arg_apellido);
    $statement->bindParam(":email", $arg_email);
    $statement->bindParam(":fechaCreacion", $arg_fechaCreacion);
    $statement->bindParam(":license", $licencia);
    $statement->bindParam(":cedula", $arg_documento);
    $statement->bindParam(":direccion", $arg_direccion);
    $statement->bindParam(":telefono", $arg_telefono);
    $statement->bindParam(":idCiudad", $idCiudad);
    $statement->bindParam(":estado", $estado);
    $statement->bindParam(":idConductor", $arg_idConductor);

    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function nombreConductor($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select name from drivers where id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idConductor', $arg_idConductor);
    $statement->execute();
    $nombreConductor = $statement->fetchColumn();
    return $nombreConductor;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function apellidoConductor($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select lastname from drivers where id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idConductor', $arg_idConductor);
    $statement->execute();
    $apellidoConductor = $statement->fetchColumn();
    return $apellidoConductor;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function celularConductor($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select cellphone from drivers where id = :idConductor LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idConductor', $arg_idConductor);
    $statement->execute();
    $celular = $statement->fetchColumn();
    return $celular;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtenerIdConductorCedula($arg_cedula){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select id from drivers where cedula = :cedula LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':cedula', $arg_cedula);
    $statement->execute();
    $id = $statement->fetchColumn();
    return $id;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function reporteExcel(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select drivers.id, drivers.name, drivers.lastname, drivers.cedula, drivers.cellphone, drivers.telephone, drivers.email, drivers.dir, drivers.created_at, drivers.status, cars.placa from drivers inner join cars on drivers.car_id = cars.id";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function EstadoConductor($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update drivers set estado = 2 where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idConductor);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();
      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerEstadoConductor($arg_cedula){
      $modelo = new Conexion();
      $conexion = $modelo->get_conexion();
      $query = "select estado from drivers where cedula = :cedula";
      $statement = $conexion->prepare($query);
      $statement->bindParam(":cedula", $arg_cedula);
      $statement->execute();
      $foto = $statement->fetchColumn();
      return $foto;
      $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function busquedaPersonalizadaConductor($arg_campo, $arg_item){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $campo = $arg_campo;
    $item = '%'.$arg_item.'%';
    $sql ="select * from drivers where $campo like :item";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":item", $item);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function reporteExcelBusqueda($arg_campo, $arg_item){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $campo = $arg_campo;
    $item = '%'.$arg_item.'%';
    $sql = "select drivers.id, drivers.name, drivers.lastname, drivers.cedula, drivers.cellphone, drivers.telephone, drivers.email, drivers.dir, drivers.created_at, drivers.status, cars.placa from drivers inner join cars on drivers.car_id = cars.id where $campo like :item";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":item", $item);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerConteoCondutoresAceptados(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $status = "true";
    $sql = "select count(*) from drivers where status = :status";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":status", $status);
    $statement->execute();
    $numero = $statement->fetchColumn();
    return $numero;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtenerConteoConductoresHabilitados(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select count(*) from drivers where  available = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $numero = $statement->fetchColumn();
    return $numero;
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function obtenerConductoresHabilitados(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from drivers where available = 1 or available = 2";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNumeroTc($arg_idConductor){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select numero_tc from drivers where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idConductor);
    $statement->execute();
    $numero = $statement->fetchColumn();
    return $numero;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerEstadoHabilitadoConductor($arg_idConductor){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select available from drivers where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_idConductor);
    $statement->execute();
    $estado = $statement->fetchColumn();
    return $estado;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerTodoUuidTaxisyas(){
    $modelo = new Conexion();
    $rows = null;
    $conexion = $modelo->get_conexion();
    $sql = "select uuid from drivers where available = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerUuidConductor($arg_id){
    $modelo = new Conexion();
    $rows = null;
    $conexion = $modelo->get_conexion();
    $sql = "select uuid from drivers where id = :id";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(":id", $arg_id);
    $statement->execute();
    $uuid = $statement->fetchColumn();
    return $uuid;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }


}
 ?>
