<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/services.php');
require_once('../../models/schedule.php');
ini_set('date.timezone','America/Bogota');
$consulta = new Services();
$consultaUsers = new Users();
$consultaDir = new UsersDirs();
$consultaAgendamiento = new Schedule();

//CAPTURA
$telefono = $_POST['telefono-nuevo'];
$cuenta = strlen($telefono);


$direccionCompleta = $_POST['capturaDireccion-name'];
$lati = $_POST['latitude-name-1'];
$longi = $_POST['longitude-name-2'];
$dir = $_POST['select-dir-name'];
$nombreDIr = htmlspecialchars($_POST['nombre_direccion-name'], ENT_QUOTES,'UTF-8');
$nDos = htmlspecialchars($_POST['ndos-name'], ENT_QUOTES,'UTF-8');
$numm = htmlspecialchars($_POST['noo-name'], ENT_QUOTES,'UTF-8');
$barrio = $_POST['barrio-name'];
$kind_id = 3;
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$apellido = htmlspecialchars(strtoupper($_POST['apellido']), ENT_QUOTES,'UTF-8');
$direccion = "$dir $nombreDIr #$nDos-$numm, $barrio";
$usuarioSistema = htmlspecialchars($_POST['id_usuariosis'], ENT_QUOTES,'UTF-8');
$pay_type = 1;
$pay_reference = "EFECTIVO";
$observaciones = htmlspecialchars($_POST['obaservaciones'], ENT_QUOTES,'UTF-8');
$destino = htmlspecialchars($_POST['destino'], ENT_QUOTES,'UTF-8');
$tipoAgendamiento = $_POST['tipoAgendamiento'];
$fechaAgendamiento = $_POST['fechaFin'];
$horaAgendamiento = $_POST['example-timepicker24'];
$fechaCompleta = "$fechaAgendamiento $horaAgendamiento";
$fechaCreacion = date('Y-m-d h:m:s');
$fechaActualizacion = "0000-00-00 00:00:00";
$status = 1;
$score = null;

$nombreCompleto = "$nombre $apellido";

//var_dump($telefono, $cuenta, $direccionCompleta, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $kind_id, $nombre, $apellido, $direccion, $usuarioSistema, $pay_type, $pay_reference, $observaciones, $destino, $tipoAgendamiento, $fechaAgendamiento, $horaAgendamiento, $fechaCompleta,
//$fechaCreacion, $fechaActualizacion,$status,$score);
//exit;

// Crear logica para capturar el ultimo id
$nuevoUser = $consultaUsers->crearUsuarioTel($nombre, $telefono, $apellido);
if ($nuevoUser == FALSE) {
  echo "Error al crear el usuario";
}else {
  $usuario = $consultaUsers->obtenerUltimoIdUser();
}



// Obtener el codigo de confirmación

if ($cuenta == '7') {
  $flecha = chunk_split($telefono, 3, " ");
  $flecha1 = substr($telefono, 0, 2);
  $flecha2 = substr($telefono, 3, 2);
  $flecha3 = substr($telefono, 5, 3);
  $code = $flecha3;
}elseif ($cuenta == '10') {
  $flecha = chunk_split($telefono, 3, " ");
  $flecha1 = substr($telefono, 0, 3);
  $flecha2 = substr($telefono, 3, 2);
  $flecha3 = substr($telefono, 5, 3);
  $flecha4 = substr($telefono, 8, 2);
  $code = $flecha4;
}



$user_pref_order = 1;
$nuevaRelacion = $consultaDir->agregarNuevaDirTel($dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $usuario, $user_pref_order, $nombreCompleto, $direccion, $lati, $longi);
if ($nuevaRelacion == FALSE) {
  echo "ERRO: No se puedo crear la relacion del usuario";
  exit;
}else{
  $mensaje = $consultaAgendamiento->crearAgendamiento($usuario, $fechaCompleta, $tipoAgendamiento, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $destino, $fechaCreacion, $fechaActualizacion, $status, $score, $usuarioSistema, $direccion, $lati, $longi, $nombre, $apellido);

  if($mensaje == FALSE){
    header('location: ../../views/mensajes/error');
  }else{
    header('location: ../../views/mensajes/registro_exitoso');
  }
}




?>
