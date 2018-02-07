<?php
class CmsUsers{

public function login($arg_email, $arg_password){
  $modelo = new Conexion();
  $idUsuario = null;
  $conexion = $modelo->get_conexion();
  $sql = "select id from cms_users where email = :email and pass = :password LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':password', $arg_password);
  $statement->execute();
  $idUsuario = $statement->fetchColumn();
  return $idUsuario;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function rol($arg_email){
  $modelo = new Conexion();
  $idRolUsuario = null;
  $conexion = $modelo->get_conexion();
  $sql = "select role_id from cms_users where email = :email LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->execute();
  $idRolUsuario = $statement->fetchColumn();
  return $idRolUsuario;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function customer_id($arg_email){
  $modelo = new Conexion();
  $idCustomer = null;
  $conexion = $modelo->get_conexion();
  $sql = "select customer_id from cms_users where where email = :email LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->execute();
  $idCustomer = $statement->fetchColumn();
  return $idCustomer;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function iniciarSesion($arg_idUsuario){
  $modelo = new Conexion();
  $rol = null;
  $conexion = $modelo->get_conexion();
  $sql = "select role_id from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_idUsuario);
  $statement->execute();
  $rol = $statement->fetchColumn();
  return $rol;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function nombreUsuarioApp($arg_idUsuario){
  $modelo = new Conexion();
  $nombreUser = null;
  $conexion = $modelo->get_conexion();
  $sql = "select name from users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_idUsuario);
  $statement->execute();
  $nombreUser = $statement->fetchColumn();
  return $nombreUser;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function nombreUsuario($arg_idUsuario){
  $modelo = new Conexion();
  $nombreUser = null;
  $conexion = $modelo->get_conexion();
  $sql = "select name from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_idUsuario);
  $statement->execute();
  $nombreUser = $statement->fetchColumn();
  return $nombreUser;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function apellidoUsuario($arg_idUsuario){
  $modelo = new Conexion();
  $nombreUser = null;
  $conexion = $modelo->get_conexion();
  $sql = "select lastname from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_idUsuario);
  $statement->execute();
  $nombreUser = $statement->fetchColumn();
  return $nombreUser;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerEmailUsuario($arg_idUsuario){
  $modelo = new Conexion();
  $nombreUser = null;
  $conexion = $modelo->get_conexion();
  $sql = "select email from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_idUsuario);
  $statement->execute();
  $email = $statement->fetchColumn();
  return $email;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cambiarContrasena($arg_password, $arg_idUsuario){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set pass = :password where id = :idUsuario";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':password', $arg_password);
  $statement->bindParam(':idUsuario', $arg_idUsuario);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function verificarCorreo($arg_email){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select cedula from cms_users where email = :correo LIMIT 1";
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

public function todosUsuarios(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function todosUsuariosOperador(){
  $modelo = new Conexion();
  $rows = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function todosUsuariosOperadorEstado(){
  $modelo = new Conexion();
  $rows = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 3 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function todosUsuariosApp(){
  $modelo = new Conexion();
  $rows = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 5";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function agregarUsuarioOperador($arg_nombre, $arg_documento, $arg_email, $arg_rol, $arg_password, $arg_fecha){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $customer_id = 42;

  $sql = "insert into cms_users(name, email, role_id, created_at, cedula, customer_id, pass) values (:nombre, :email, :rol, :fecha, :documento, :customer_id, :pass)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':nombre', $arg_nombre);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':rol', $arg_rol);
  $statement->bindParam(':fecha', $arg_fecha);
  $statement->bindParam(':customer_id', $customer_id);
  $statement->bindParam(':documento', $arg_documento);
  $statement->bindParam('pass', $arg_password);

  if (!$statement) {
    return header("Location: ../../views/mensajes/error.php");
  }else{

    $statement->execute();
    return header("Location: ../../views/mensajes/registro_exitoso.php");
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function agregarUsuarioCmsVales($arg_name, $arg_email, $arg_created_at, $arg_cedula, $arg_pass, $arg_company_id, $arg_parent_id, $arg_cost_center_id, $arg_role){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $customer_id = 42;
  $role_id = 5;
  $estado = 1;

  $sql = "insert into cms_users(name, email, role_id, created_at, cedula, customer_id, pass, estado, company_id, parent_id, cost_center_id, role) values (:name, :email, :role_id, :created_at, :cedula, :customer_id, :pass, :estado, :company_id, :parent_id, :cost_center_id, :role)";
  $statement = $conexion->prepare($sql);

  $statement->bindParam(':name', $arg_name);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':role_id', $role_id);
  $statement->bindParam(':created_at', $arg_created_at);
  $statement->bindParam(':cedula', $arg_cedula);
  $statement->bindParam(':customer_id', $customer_id);
  $statement->bindParam(':pass', $arg_pass);
  $statement->bindParam(':estado', $estado);
  $statement->bindParam(':company_id', $arg_company_id);
  $statement->bindParam(':parent_id', $arg_parent_id);
  $statement->bindParam(':cost_center_id', $arg_cost_center_id);
  $statement->bindParam(':role', $arg_role);

  if (!$statement) {
    return FALSE;
  }else{

    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function agregarUsuarioApp($arg_nombre, $arg_documento, $arg_email, $arg_rol, $arg_password, $arg_fecha){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $customer_id = 42;

  $sql = "insert into cms_users(name, email, role_id, created_at, cedula, customer_id, pass) values (:nombre, :email, :rol, :fecha, :documento, :customer_id, :pass)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':nombre', $arg_nombre);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':rol', $arg_rol);
  $statement->bindParam(':fecha', $arg_fecha);
  $statement->bindParam(':customer_id', $customer_id);
  $statement->bindParam(':documento', $arg_documento);
  $statement->bindParam('pass', $arg_password);

  if (!$statement) {
    return header("Location: ../../views/mensajes/error.php");
  }else{

    $statement->execute();
    return header("Location: ../../views/mensajes/registro_exitoso.php");
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarUsuarioCms($arg_idUsuario){
  $row = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idUsuario", $arg_idUsuario);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarUsuarioApp($arg_idUsuario){
  $row = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":idUsuario", $arg_idUsuario);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function modificarUsuarioCms($arg_nombre, $arg_rol, $arg_email, $arg_fecha, $arg_documento, $arg_idUsuario){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set name = :nombre, role_id = :rol, email = :email, updated_at = :fecha, cedula = :documento where id = :idUsuario";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":nombre", $arg_nombre);
  $statement->bindParam(":rol", $arg_rol);
  $statement->bindParam(":email", $arg_email);
  $statement->bindParam(":fecha", $arg_fecha);
  $statement->bindParam(":documento", $arg_documento);
  $statement->bindParam(":idUsuario", $arg_idUsuario);
  if (!$statement) {
    return FALSE;

  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function modificarUsuarioCmsReingreso($arg_nombre, $arg_email, $arg_fecha, $arg_documento, $arg_pass, $arg_estado, $arg_idUsuario){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set name = :nombre, email = :email, updated_at = :fecha, cedula = :documento, pass = :pass, estado = :estado where id = :idUsuario";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":nombre", $arg_nombre);
  $statement->bindParam(":email", $arg_email);
  $statement->bindParam(":fecha", $arg_fecha);
  $statement->bindParam(":documento", $arg_documento);
  $statement->bindParam(":pass", $arg_pass);
  $statement->bindParam(":estado", $arg_estado);
  $statement->bindParam(":idUsuario", $arg_idUsuario);
  if (!$statement) {
    return FALSE;

  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function modificarUsuarioApp($arg_nombre, $arg_email, $arg_fecha, $arg_documento, $arg_idUsuario){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set name = :nombre, email = :email, updated_at = :fecha, cedula = :documento where id = :idUsuario";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":nombre", $arg_nombre);
  $statement->bindParam(":email", $arg_email);
  $statement->bindParam(":fecha", $arg_fecha);
  $statement->bindParam(":documento", $arg_documento);
  $statement->bindParam(":idUsuario", $arg_idUsuario);
  if (!$statement) {
    return header("Location: ../../views/mensajes/error.php");

  }else{
    $statement->execute();
    return header("Location: ../../views/administrador/usuariosApp.php");
  }
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function EstadoUsuarioCms($arg_idUsuario){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set estado = 2 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_idUsuario);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}
public function obtenerIdDUserCms($arg_email){
  $modelo = new Conexion();
  $idUsuario = null;
  $conexion = $modelo->get_conexion();
  $sql = "select id from cms_users where email = :email LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->execute();
  $idUsuario = $statement->fetchColumn();
  return $idUsuario;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerEstadoUsuarioCms($arg_email){
  $modelo = new Conexion();
  $estado = null;
  $conexion = $modelo->get_conexion();
  $sql = "select estado from cms_users where email = :email LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':email', $arg_email);
  $statement->execute();
  $estado = $statement->fetchColumn();
  return $estado;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaSuperAdministradores(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 1 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaAdministradores(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 2 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaOperadora(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 3 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaPagos(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 4 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaClientes(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 5 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaMinisterio(){
  $modelo = new Conexion();
  $rows = null;
  $flag = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role_id = 6 and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function busquedaPersonalizdaUsuarioCms($arg_item, $arg_frase){
  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $busqueda = '%'.$arg_frase.'%';
  $item = "$arg_item";
  $sql = "select * from cms_users where $item like :busqueda";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":busqueda", $busqueda);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerRoleUsuario($arg_id){
  $modelo = new Conexion();
  $role = null;
  $conexion = $modelo->get_conexion();
  $sql = "select role from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_id);
  $statement->execute();
  $role = $statement->fetchColumn();
  return $role;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerCentroCosto($arg_id){
  $modelo = new Conexion();
  $role = null;
  $conexion = $modelo->get_conexion();
  $sql = "select cost_center_id from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_id);
  $statement->execute();
  $role = $statement->fetchColumn();
  return $role;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtenerCompany($arg_id){
  $modelo = new Conexion();
  $role = null;
  $conexion = $modelo->get_conexion();
  $sql = "select company_id from cms_users where id = :idUsuario LIMIT 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':idUsuario', $arg_id);
  $statement->execute();
  $role = $statement->fetchColumn();
  return $role;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function migrarUsuariosSecretariaCms($arg_name, $arg_email, $arg_created_at, $arg_pass, $arg_company_id, $arg_parent_id, $arg_role){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $role_id = 5;
  $customer_id = 42;
  $estado = 1;
  $sql = "insert into cms_users (name, email, role_id, created_at, customer_id, pass, estado, company_id, parent_id, role) values (:name, :email, :role_id, :created_at, :customer_id, :pass, :estado, :company_id, :parent_id, :role)";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':name', $arg_name);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':role_id', $role_id);
  $statement->bindParam(':created_at', $arg_created_at);
  $statement->bindParam(':customer_id', $customer_id);
  $statement->bindParam(':pass', $arg_pass);
  $statement->bindParam(':estado', $estado);
  $statement->bindParam(':company_id', $arg_company_id);
  $statement->bindParam(':parent_id', $arg_parent_id);
  $statement->bindParam(':role', $arg_role);

  if (!$statement) {
    return FALSE;
  }else{

    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaUsuarioManagerSecretaria($arg_company_id){
  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role = 'manager' and company_id = :company_id and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':company_id', $arg_company_id);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function cargarUsuarioManagerCms($arg_id){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_id);
  $statement->execute();
  while($result = $statement->fetch()){
    $row[] = $result;
  }
  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function modificarManagerCms($arg_name, $arg_email, $arg_updated_at, $arg_cost_center_id, $arg_idManger){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set name = :name, email = :email, updated_at = :updated_at, cost_center_id = :cost_center_id where id = :idManger";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':name', $arg_name);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':updated_at', $arg_updated_at);
  $statement->bindParam(':cost_center_id', $arg_cost_center_id);
  $statement->bindParam(':idManger', $arg_idManger);

  if (!$statement) {
    return FALSE;

  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function EstadoManager($arg_idManager){
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users  set estado = 2 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':id', $arg_idManager);
  if (!$statement) {
    return FALSE;
  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function listaUsuarioReportersSecretaria($arg_company_id, $arg_cost_center_id){

  $rows = null;
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role = 'report' and company_id = :company_id and cost_center_id = :cost_center_id and estado = 1";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':company_id', $arg_company_id);
  $statement->bindParam(':cost_center_id', $arg_cost_center_id);
  $statement->execute();
  while($result = $statement->fetch()){
    $rows[] = $result;
  }
  return $rows;
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function modificarReporterCms($arg_name, $arg_email, $arg_updated_at, $arg_id){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $sql = "update cms_users set name = :name, email = :email, updated_at = :updated_at where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(':name', $arg_name);
  $statement->bindParam(':email', $arg_email);
  $statement->bindParam(':updated_at', $arg_updated_at);
  $statement->bindParam(':id', $arg_id);

  if (!$statement) {
    return FALSE;

  }else{
    $statement->execute();
    return TRUE;
  }
  $conexion = $modelo->close_conexion($statement, $conexion);
}

public function obtnerUsuarioAdminXIdCompania($arg_idCompania){
  $modelo = new Conexion();
  $row = null;
  $conexion = $modelo->get_conexion();
  $sql = "select * from cms_users where role = 'admin' and company_id = :id;
";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_idCompania);
  $statement->execute();
  while ($result = $statement->fetch()) {
    $row[] = $result;
  }

  return $row;
  $conexion = $modelo->close_conexion($statement, $conexion);

}

public function eliminarUsuarioCms(){

  $modelo = new Conexion();
  $conexion = $modelo->get_conexion($arg_id);
  $sql = "update cms_users set estado = 2 where id = :id";
  $statement = $conexion->prepare($sql);
  $statement->bindParam(":id", $arg_id);
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
