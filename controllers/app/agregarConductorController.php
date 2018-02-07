<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/drivers.php');
require_once('../../models/driversCars.php');
require_once('../../util/nocsrf.php');

//falta buscar el movil del vehiculo
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$apellido = htmlspecialchars(strtoupper($_POST['primer_apellido']), ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$pass = md5($_POST['password']);
$celular = htmlspecialchars($_POST['movil'], ENT_QUOTES,'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$cedula = htmlspecialchars($_POST['Documento'], ENT_QUOTES,'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES,'UTF-8');
$vehiculos = $_POST['example-chosen-multiple'];
$foto = $_FILES['example-file-input'];
$fecha = date('Y-m-d H:i:s');
$cantVehiculos = count($vehiculos);
$pla = array_values($vehiculos)[0];

//var_dump($nombre, $apellido, $email, $pass, $celular, $telefono, $cedula, $direccion, $vehiculos, $foto, $fecha, $cantVehiculos, $pla);
//exit;

$consulta = new Drivers();
$consultaVehiculo = new Cars();
$consultaDriversCars = new DriversCars();

if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
    $estado = $consulta->obtenerEstadoConductor($cedula);
    if ($estado == 2) {
      $status = "true";
      $temporal = $_FILES['example-file-input']['tmp_name'];
      $nombre_foto = $_FILES['example-file-input']['name'];
      $movilVehiculo = $consultaVehiculo->buscarMovil($pla);
      $placa = $consultaVehiculo->buscarPlaca($pla);
      $idConductor = $consulta->obtenerIdConductorCedula($cedula);
      $mensaje = $consulta->modificarConductorD($email, $placa, $celular, $nombre_foto, $status, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);
      if ($mesaje == FALSE) {
        header("Location: ../../views/mensajes/error.php");
      }else{
        header("Location: ../../views/mensajes/registro_exitoso");
      }
    }elseif ($estado == 1) {
      header("Location: ../../views/mensajes/error_existe?ref=conductor");
    }else{
      $flag = $consulta->verificarCorreoConductor($email);
      if ($flag == TRUE) {
        header("Location: ../../views/mensajes/registro_error.html");
      }else {
        $flag2 = $consulta->verificarCedula($cedula);
        if ($flag2 == TRUE) {
          header("Location: ../../views/mensajes/registro_error.html");
        }else {
          //guardar foto
          //$_FILES['example-file-input'];
          $temporal = $_FILES['example-file-input']['tmp_name'];
          $nombre_foto = $_FILES['example-file-input']['name'];
          if ($nombre_foto != '') {
            $original = $nombre_foto;
            if($_FILES['example-file-input']['type'] == 'image/jpeg'){
              $foto_original = imagecreatefromjpeg($temporal);
              $ancho_original = imagesx($foto_original);
              $altura_original = imagesy($foto_original);
              $ancho_nuevo = 250;
              $alto_nuevo = round($ancho_nuevo * $altura_original / $ancho_original);
              $copia = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
              imagecopyresampled($copia, $foto_original, 0,0,0,0, 250,250, $ancho_original, $altura_original);
              imagejpeg($copia, '../../views/dis/img/conductores/'.$nombre_foto, 100);
              //imagepng($copia, '../views/dis/img/conductores'.$nombre_foto, 100);
              imagedestroy($foto_original);
              imagedestroy($copia);
            }else {
              $foto_original = imagecreatefrompng($temporal);
              $ancho_original = imagesx($foto_original);
              $altura_original = imagesy($foto_original);
              $ancho_nuevo = 250;
              $alto_nuevo = round($ancho_nuevo * $altura_original / $ancho_original);
              $copia = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
              imagecopyresampled($copia, $foto_original, 0,0,0,0, 250,250, $ancho_original, $altura_original);
              imagejpeg($copia, '../../views/dis/img/conductores/'.$nombre_foto, 100);
              //imagepng($copia, '../views/dis/img/conductores'.$nombre_foto, 100);
              imagedestroy($foto_original);
              imagedestroy($copia);
            }

          }
          //obtener el movil del vehiculo
          $movilVehiculo = $consultaVehiculo->buscarMovil($pla);
          //obtener placa
          $placa = $consultaVehiculo->buscarPlaca($pla);
          //agregar el conductor
          //var_dump($email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
          //exit;
          $mensaje = $consulta->agregarConductor($email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);

          //obtener el id del conductor creado
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
            $idConductor = $consulta->ultimoIdConductor();
            foreach($vehiculos as $id){
              $registro = $consultaDriversCars->agregarRegistro($idConductor, $id);
            }
            header("Location: ../../views/mensajes/registro_exitoso.php");
          }
        }

      }
    }

  }else {
    header("Location: ../../views/mensajes/error.php");
  }
}







 ?>
