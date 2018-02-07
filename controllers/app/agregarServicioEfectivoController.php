htmlspecialchars(<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/services.php');

ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaUsers = new Users();
$consultaUserDir = new UsersDirs();

//CAPTURA
$direccionCompleta = $_POST['capturaDireccion-name'];
$usuario = $_POST['usuarioDir'];
$lati = $_POST['latitude-name-1'];
$longi = $_POST['longitude-name-2'];
$dir = $_POST['select-dir-name'];
$nombreDIr = $_POST['nombre_direccion-name'];
$nDos = $_POST['ndos-name'];
$numm = $_POST['noo-name'];
$barrio = $_POST['barrio-name'];
$kind_id = 3;
$nombre = strtoupper($_POST['nombre']);
$apellido = strtoupper($_POST['apellido']);
$direccion = "$dir $nombreDIr #$nDos-$numm, $barrio";
$usuarioSistema = $_POST['id_usuariosis'];
$pay_type = 1;
$pay_reference = "EFECTIVO";
$observaciones = $_POST['obaservaciones'];
$destino = $_POST['destino'];
$tel = $_POST['tel'];

$fechaCreacion = date('Y-m-d h:m:s');

$nombreCompleto = "$nombre $apellido";

// Obtener el codigo de confirmación
/*
$telefono = $consultaUsers->obtenerCelular($usuario);

if($telefono == NULL){
  $telefono = $consultaUsers->obtenerTelefono($usuario);
}*/


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

//LOGICA







?>
