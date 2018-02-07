<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/services.php');
require_once('../../models/ticketTickets.php');

$consulta = new Services();
$consultaUsers = new Users();
$consultaTickets = new TicketTickets();
$consultaDir = new UsersDirs();

//CAPTURA
$telefono = $_POST['telefono-nuevo'];
$cuenta = strlen($telefono);

$direccionCompleta = $_POST['capturaDireccion-vale'];
$usuario = $_POST['usuarioDir'];
$lati = $_POST['latitude-name-vale'];
$longi = $_POST['longitude-name-vale'];
$dir = htmlspecialchars($_POST['select-dir-name'], ENT_QUOTES,'UTF-8');
$nombreDIr = htmlspecialchars($_POST['nombre_direccion-name'], ENT_QUOTES,'UTF-8');
$nDos = htmlspecialchars($_POST['ndos-name'], ENT_QUOTES,'UTF-8');
$numm = htmlspecialchars($_POST['noo-name'], ENT_QUOTES,'UTF-8');
$barrio = $_POST['barrio-name'];
$kind_id = 3;
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$apellido = htmlspecialchars(strtoupper($_POST['apellido']), ENT_QUOTES,'UTF-8');
$direccion = "$dir $nombreDIr #$nDos-$numm, $barrio";
$usuarioSistema = $_POST['id_usuariosis'];
$pay_type = 3;
$pay_reference = "VALE";
$observaciones = htmlspecialchars($_POST['obaservaciones'], ENT_QUOTES,'UTF-8');
$destino = htmlspecialchars($_POST['destino'], ENT_QUOTES,'UTF-8');
$nvale = strtoupper($_POST['nVale']);
$motivoVale = htmlspecialchars($_POST['motivoVale'], ENT_QUOTES,'UTF-8');
$estadoVale = $consultaTickets->obtenerEstadoVale($nvale);

$nombreCompleto = "$nombre $apellido";

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


//logica de creación
if($estadoVale != NULL){
  if ($estadoVale == '1') {
    header("Location: ../../views/mensajes/error_vale_usado");
  }elseif ($estadoVale == '2') {
    header("Location: ../../views/mensajes/error_vale_uso");
  }elseif ($estadoVale == '3') {
    header("Location: ../../views/mensajes/error_vale_vencido");
  }else {
      $companiaId = $consultaTickets->obtenerCompanyId($nvale);

      $user_pref_order = 1;
      $nuevaRelacion = $consultaDir->agregarNuevaDirTel($dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $usuario, $user_pref_order, $nombreCompleto, $direccion, $lati, $longi);
      if ($nuevaRelacion == FALSE) {
        echo "ERRO: No se puedo crear la relacion del usuario";
        exit;
      }else{
        $flag = $consulta->crearServicioVale($usuario, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $kind_id, $destino, $nombreCompleto, $direccion, $usuarioSistema, $pay_type, $pay_reference, $nvale, $code, $companiaId, $motivoVale);

        if ($flag == FALSE) {
          echo "error";
          exit;
        }else {
              $query = $consultaTickets->cambiarEstadoVale($nvale);
              if ($query == FALSE) {
                echo "error al modificar el vale";
              }else{
                header("Location: ../../views/app/serviciosActivos");
              }
        }
      }

  }
}else{
  header("Location: ../../views/mensajes/error_vale_noexiste");
}







 ?>
