<?php
class UsersDirs{
  public function todosUsersDirs(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from users_dirs";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function agregarUsersDirs($arg_index, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_obs, $arg_idUser, $arg_user_pref, $arg_lat, $arg_lng){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into users_dirs(index_id, comp1, comp2, no, barrio, obs, user_id, user_pref_order, lat, lng) values (:index_id, :comp1, :comp2, :no, :barrio, :obs, :user_id, :user_pref_order, :lat, :lng)";
    $statement->bindParam(':index_id', $arg_index);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':obs', $arg_obs);
    $statement->bindParam(':user_id', $arg_idUser);
    $statement->bindParam(':user_pref_order', $arg_user_pref);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);

    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();

      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerUserPrefOrder($arg_idUser){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select user_pref_order from users_dirs where user_id = :idUser";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idUser', $arg_idUser);
    if (!$statement) {
      return FALSE;
    }else {
      $statement->execute();
      $id = $statement->fetchColumn();
      return $id;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todasDireccionesUser($arg_idUser){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from users_dirs where user_id = :idUser";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idUser', $arg_idUser);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function todasDireccionesUserUso($arg_idUser){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from users_dirs where user_id = :idUser order by user_pref_order desc";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':idUser', $arg_idUser);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function direccionExpesifica($arg_id){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from users_dirs where id = :id LIMIT 1";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':id', $arg_id);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function agregarNuevaDirTel($arg_index_id, $arg_comp1, $arg_comp2, $arg_no, $arg_barrio, $arg_obs, $arg_user_id, $arg_user_pref_order, $arg_name, $arg_address, $arg_lat, $arg_lng){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "insert into users_dirs(index_id, comp1, comp2, no, barrio, obs, user_id, user_pref_order, name, address, lat, lng)values(:index_id, :comp1, :comp2, :no, :barrio, :obs, :user_id, :user_pref_order, :name, :address, :lat, :lng)";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':index_id', $arg_index_id);
    $statement->bindParam(':comp1', $arg_comp1);
    $statement->bindParam(':comp2', $arg_comp2);
    $statement->bindParam(':no', $arg_no);
    $statement->bindParam(':barrio', $arg_barrio);
    $statement->bindParam(':obs', $arg_obs);
    $statement->bindParam(':user_id', $arg_user_id);
    $statement->bindParam(':user_pref_order', $arg_user_pref_order);
    $statement->bindParam(':name', $arg_name);
    $statement->bindParam(':address', $arg_address);
    $statement->bindParam(':lat', $arg_lat);
    $statement->bindParam(':lng', $arg_lng);
    if (!$statement) {
      return FALSE;
    }else{
      $statement->execute();

      return TRUE;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);

  }

  public function buscarDireccionExacta($arg_direccion, $arg_idUsuario){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select user_pref_order from users_dirs where address = :direcion and 	user_id = :idUsuario";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':direcion', $arg_direccion);
    $statement->bindParam(':idUsuario', $arg_idUsuario);
    if (!$statement) {
      return FALSE;
    }else {
      $statement->execute();
      $conteo = $statement->fetchColumn();
      return $conteo;
    }
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function modificarUserPrefOrder($arg_numero, $arg_idUsuario){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "update users_dirs set user_pref_order = :numero where user_id = :idUsuario";
    $statement = $conexion->prepare($sql);
    $statement->bindParam(':numero', $arg_numero);
    $statement->bindParam(':idUsuario', $arg_idUsuario);
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
