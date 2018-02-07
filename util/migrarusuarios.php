<?php
require_once('../models/conexion.php');
require_once('../models/ticket_users.php');
require_once('../models/cmsUsers.php');

$consulta = new CmsUsers();
$consultaUsuariosTicket = new TicketUsers();


$cont = 0;
$filas = $consultaUsuariosTicket->usuariosSecretaria();

foreach($filas as $fila){
  $name = $fila['name'];
  $email = $fila['email'];
  $created_at = '2017-12-01 12:30:00';
  $pass = $fila['pass'];
  $company_id = $fila['company_id'];
  $parent_id = $fila['parent_id'];
  $role= $fila['role'];

  $mensaje = $consulta->migrarUsuariosSecretariaCms($name, $email, $created_at, $pass, $company_id, $parent_id, $role);

  if($mensaje == FALSE){
    echo "No se agrego";
  }else{
    $cont = $cont+1;
    echo "$cont -> se agrego";

  }
  echo "Termino";

}






 ?>
