<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/services.php');
require_once('../../models/schedule.php');

ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaUsers = new Users();
$consultaUserDir = new UsersDirs();
$consultaAgendamiento = new Schedule();

//CAPTURA
$direccionCompleta = htmlspecialchars($_POST['capturaDireccion-name'], ENT_QUOTES,'UTF-8');
$usuario = $_POST['usuarioDir'];
$lati = $_POST['latitude-name-1'];
$longi = $_POST['longitude-name-2'];
$dir = htmlspecialchars($_POST['select-dir-name'], ENT_QUOTES,'UTF-8');
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
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES,'UTF-8');
$tipoAgendamiento = $_POST['tipoAgendamiento'];
$fechaAgendamiento = $_POST['fechaFin'];
$horaAgendamiento = $_POST['example-timepicker24'];
$fechaCompleta = "$fechaAgendamiento $horaAgendamiento";
$fechaCreacion = date('Y-m-d h:m:s');
$fechaActualizacion = "0000-00-00 00:00:00";
$status = 1;
$score = null;

$nombreCompleto = "$nombre $apellido";

// Obtener el codigo de confirmación


$cuenta = strlen($tel);

if ($cuenta == '7') {
  $flecha = chunk_split($tel, 3, " ");
  $flecha1 = substr($tel, 0, 2);
  $flecha2 = substr($tel, 3, 2);
  $flecha3 = substr($tel, 5, 3);
  $code = $flecha3;
}elseif ($cuenta == '10') {
  $flecha = chunk_split($tel, 3, " ");
  $flecha1 = substr($tel, 0, 3);
  $flecha2 = substr($tel, 3, 2);
  $flecha3 = substr($tel, 5, 3);
  $flecha4 = substr($tel, 8, 2);
  $code = $flecha4;
}


$mensaje = $consultaAgendamiento->crearAgendamiento($usuario, $fechaCompleta, $tipoAgendamiento, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $destino, $fechaCreacion, $fechaActualizacion, $status, $score, $usuarioSistema, $direccion, $lati, $longi, $nombre, $apellido);

if($mensaje == FALSE){
  header('location: ../../views/mensajes/error');
}else{
  header('location: ../../views/mensajes/registro_exitoso');
}



/*
$flag = $consulta->crearServicioEfectivo($usuario, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $kind_id, $destino, $nombreCompleto, $direccion, $usuarioSistema, $pay_type, $pay_reference, $code);

if ($flag == FALSE) {
  echo "ERROR: No se pudo crear el servicio";
  exit;
}else {
  $conteo = $consultaUserDir->buscarDireccionExacta($direccion, $usuario);
  if ($conteo == NULL) {
    $user_pref_order = 1;
    $nuevaRelacion = $consultaUserDir->agregarNuevaDirTel($dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $usuario, $user_pref_order, $nombreCompleto, $direccion, $lati, $longi);
    header("Location: ../../views/app/serviciosActivos");
  }else{
    $numero = $conteo + 1;
    $favorito = $consultaUserDir->modificarUserPrefOrder($numero, $usuario);
    if ($favorito == FALSE) {
      echo "ERROR: No se pudo aumentar el item de dirección favorita";
      exit;
    }else {
      header("Location: ../../views/app/serviciosActivos");
    }
  }


}
*/








?>
