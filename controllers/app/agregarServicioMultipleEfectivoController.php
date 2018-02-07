htmlspecialchars(<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/services.php');

ini_set('date.timezone','America/Bogota');

$consulta = new Services();
$consultaUsers = new Users();
$consultaUserDir = new UsersDirs();

$fechaCreacion = date('Y-m-d h:m:s');
//CAPTURA
$direccionCompleta = $_POST['capturaDireccion-name'];
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
$usuarioSistema = $_POST['id_usuariosis'];
$pay_type = 1;
$pay_reference = "EFECTIVO";
$observaciones = htmlspecialchars($_POST['obaservaciones'], ENT_QUOTES,'UTF-8');
$destino = htmlspecialchars($_POST['destino'], ENT_QUOTES,'UTF-8');
$tel = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$nombreCompleto = "$nombre $apellido";

$cantidad = $_POST['cantidad'];
$cant = $cantidad -1;

//ARRAYS SERVICIO MULTIPLES

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$telefonos = $_POST['telefonos'];
$obss = $_POST['obaservacioness'];
$destinos = $_POST['destinos'];




// Obtener el codigo de confirmación

$cuenta = strlen($tel);

if ($cuenta == '7') {
  $t = $tel;
  $c = null;
  $flecha = chunk_split($tel, 3, " ");
  $flecha1 = substr($tel, 0, 2);
  $flecha2 = substr($tel, 3, 2);
  $flecha3 = substr($tel, 5, 3);
  $code = $flecha3;

}elseif ($cuenta == '10') {
  $t = null;
  $c = $tel;
  $flecha = chunk_split($tel, 3, " ");
  $flecha1 = substr($tel, 0, 3);
  $flecha2 = substr($tel, 3, 2);
  $flecha3 = substr($tel, 5, 3);
  $flecha4 = substr($tel, 8, 2);
  $code = $flecha4;
}

$idUsuario = $consultaUsers->obtenerIdXNombreANDTelefono($nombre, $tel);
if ($idUsuario == null) {
  $createUser = $consultaUsers->nuevoUsers($nombre, null, null, null, null, null, $c, $t, $apellido, $fechaCreacion, null, '0000-00-00 00:00:00',0, null, 0, null);
  if ($createUser == FALSE) {
    echo "ERROR: nose puedo crear el usuario";
  }else{
    $idUsuario = $consultaUsers->obtenerUltimoIdUser();
  }

}

  $flag = $consulta->crearServicioEfectivo($idUsuario, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $kind_id, $destino, $nombreCompleto, $direccion, $usuarioSistema, $pay_type, $pay_reference, $code);

  if ($flag == FALSE) {
    echo "ERROR: No se pudo crear el servicio";
    exit;
  }else {
    $conteo = $consultaUserDir->buscarDireccionExacta($direccion, $idUsuario);
    if ($conteo == NULL) {
      $user_pref_order = 1;
      $nuevaRelacion = $consultaUserDir->agregarNuevaDirTel($dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $usuario, $user_pref_order, $nombreCompleto, $direccion, $lati, $longi);
      header("Location: ../../views/app/serviciosActivos");
      echo "nueva direccion";
      if($nombres == null && $apellidos == null && $telefonos == null && $obss == null && $destinos == null){
        header("Location: ../../views/app/serviciosActivos");
        //echo "no tomo los array";
      }else{
        for ($i=0; $i < $cant; $i++) {
          $name = strtoupper($nombres[$i]);
          $lastname = strtoupper($apellidos[$i]);
          $phone = $telefonos[$i];
          $obser = $obss[$i];
          $detination = $destinos[$i];
          $fullName = "$name $lastname";

          $cuenta = strlen($phone);

          if ($cuenta == '7') {
            $t = $phone;
            $c = null;
            $flecha = chunk_split($phone, 3, " ");
            $flecha1 = substr($phone, 0, 2);
            $flecha2 = substr($phone, 3, 2);
            $flecha3 = substr($phone, 5, 3);
            $codes = $flecha3;
          }elseif ($cuenta == '10') {
            $t = null;
            $c = $phone;
            $flecha = chunk_split($phone, 3, " ");
            $flecha1 = substr($phone, 0, 3);
            $flecha2 = substr($phone, 3, 2);
            $flecha3 = substr($phone, 5, 3);
            $flecha4 = substr($phone, 8, 2);
            $codes = $flecha4;
          }
          $idUser = $consultaUsers->obtenerIdXNombreANDTelefono($name, $phone);
          if ($idUser == null) {
            $createUser = $consultaUsers->nuevoUsers($name, null, null, null, null, null, $c, $t, $lastname, $fechaCreacion, null, '0000-00-00 00:00:00',0, null, 0, null);
            if ($createUser == FALSE) {
              echo "ERROR: nose puedo crear el usuario";
            }else{
              $idUser = $consultaUsers->obtenerUltimoIdUser();
            }

          }
          $creador = $consulta->crearServicioEfectivo($idUser, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $obser, $kind_id, $detination, $fullName, $direccion, $usuarioSistema, $pay_type, $pay_reference, $codes);
          if ($creador == FALSE) {
            echo "ERROR: No se pudo crear el servicio";
            exit;
          }
        }
        echo "bien nueva direccion ";
        header("Location: ../../views/app/serviciosActivos");


      }
    }else{
      $numero = $conteo + 1;
      $favorito = $consultaUserDir->modificarUserPrefOrder($numero, $usuario);
      if ($favorito == FALSE) {
        echo "ERROR: No se pudo aumentar el item de dirección favorita";
        exit;
      }else {

        if($nombres == null && $apellidos == null && $telefonos == null && $obss == null && $destinos == null){
          header("Location: ../../views/app/serviciosActivos");
          //echo "no tomo los array";
        }else{
          for ($i=0; $i < $cant; $i++) {
            $name = strtoupper($nombres[$i]);
            $lastname = strtoupper($apellidos[$i]);
            $phone = $telefonos[$i];
            $obser = $obss[$i];
            $detination = $destinos[$i];
            $fullName = "$name $lastname";

            $cuenta = strlen($phone);

            if ($cuenta == '7') {
              $t = $phone;
              $c = null;
              $flecha = chunk_split($phone, 3, " ");
              $flecha1 = substr($phone, 0, 2);
              $flecha2 = substr($phone, 3, 2);
              $flecha3 = substr($phone, 5, 3);
              $codes = $flecha3;
            }elseif ($cuenta == '10') {
              $t = null;
              $c = $phone;
              $flecha = chunk_split($phone, 3, " ");
              $flecha1 = substr($phone, 0, 3);
              $flecha2 = substr($phone, 3, 2);
              $flecha3 = substr($phone, 5, 3);
              $flecha4 = substr($phone, 8, 2);
              $codes = $flecha4;
            }

            $idUser = $consultaUsers->obtenerIdXNombreANDTelefono($name, $phone);
            if ($idUser == null) {
              $createUser = $consultaUsers->nuevoUsers($name, null, null, null, null, null, $c, $t, $lastname, $fechaCreacion, null, '0000-00-00 00:00:00',0, null, 0, null);
              if ($createUser == FALSE) {
                echo "ERROR: nose puedo crear el usuario";
              }else{
                $idUser = $consultaUsers->obtenerUltimoIdUser();
              }

            }

            $creador = $consulta->crearServicioEfectivo($idUser, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $obser, $kind_id, $detination, $fullName, $direccion, $usuarioSistema, $pay_type, $pay_reference, $codes);
            if ($creador == FALSE) {
              echo "ERROR: No se pudo crear el servicio";
              exit;
            }
          }
          header("Location: ../../views/app/serviciosActivos");


        }






      }
    }


  }




//LOGICA







?>
