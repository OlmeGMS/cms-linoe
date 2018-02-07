<?php
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/drivers.php');
require_once('../../models/driversCars.php');

$vehiculos = null;
$idConductor = $_POST['id_conductor'];
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$apellido = htmlspecialchars(strtoupper($_POST['primer_apellido']), ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
$clave = $_POST['passwords'];
$pwd = $_POST['pass'];
$pass = md5($_POST['passwords']);
$celular = htmlspecialchars($_POST['movil'], ENT_QUOTES,'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
$cedula = htmlspecialchars($_POST['Documento'], ENT_QUOTES,'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES,'UTF-8');
$vehiculos = $_POST['example-chosen-multiple'];
$foto = $_FILES['example-file-input'];
$fecha = date('Y-m-d H:i:s');
$cantVehiculos = count($vehiculos);
$pla = array_values($vehiculos)[0];


$consulta = new Drivers();
$consultaVehiculo = new Cars();
$consultaDriversCars = new DriversCars();
$fotoConductor = $consulta->fotoConductor($idConductor);
//var_dump($fotoConductor);
$fotoo = $_FILES['example-file-input']['name'];

if($clave == ''){
  if ($fotoo == '') {

        //obtener el movil del vehiculo
        $movilVehiculo = $consultaVehiculo->buscarMovil($pla);
        //obtener placa
        $placa = $consultaVehiculo->buscarPlaca($pla);
        if ($vehiculos == '') {
        //agregar el conductor
        $placaGuardada = $consulta->idCarroManeja($idConductor);
        //$n = "2";

        $mensaje = $consulta->modificarConductor($email, $pwd, $placaGuardada, $movilVehiculo, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);

          //Validar si pusieron datos en el campo vehiculos y agregarlos sí se ingresaron
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
              //si esta vacio se envia el mensaje de modificacion
              header("Location: ../../views/mensajes/registro_exitoso.php");
          }
        }else{
          //$n = "3";
          //var_dump($n, $email, $pass, $pla, $movilVehiculo, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
          //exit;
          $mensaje = $consulta->modificarConductor($email, $pwd, $pla, $movilVehiculo, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
            foreach($vehiculos as $id){
              $registro = $consultaDriversCars->modificarCarrosManejados($idConductor, $id);
            }
            header("Location: ../../views/mensajes/registro_exitoso.php");
          }

        }



  }else{

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
        if ($vehiculos == '') {
        //agregar el conductor
        $placaGuardada = $consulta->idCarroManeja($idConductor);
        //$n = "4";
        //var_dump($n, $email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
        //exit;
        $mensaje = $consulta->modificarConductor($email, $pwd, $placaGuardada, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);

          //Validar si pusieron datos en el campo vehiculos y agregarlos sí se ingresaron
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{

              //si esta vacio se envia el mensaje de modificacion
              header("Location: ../../views/mensajes/registro_exitoso.php");



          }
        }else{
          //$n = "5";
          //var_dump($n, $email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
          //exit;
          $mensaje = $consulta->modificarConductor($email, $pwd, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
          foreach($vehiculos as $id){
            $registro = $consultaDriversCars->modificarCarrosManejados($idConductor, $id);
          }
          header("Location: ../../views/mensajes/registro_exitoso.php");
          }
        }


  }
}else{
  if ($fotoo == '') {

        //obtener el movil del vehiculo
        $movilVehiculo = $consultaVehiculo->buscarMovil($pla);
        //obtener placa
        $placa = $consultaVehiculo->buscarPlaca($pla);
        if ($vehiculos == '') {
        //agregar el conductor
        $placaGuardada = $consulta->idCarroManeja($idConductor);
        //$n = "2";

        $mensaje = $consulta->modificarConductor($email, $pass, $placaGuardada, $movilVehiculo, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);

          //Validar si pusieron datos en el campo vehiculos y agregarlos sí se ingresaron
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
              //si esta vacio se envia el mensaje de modificacion
              header("Location: ../../views/mensajes/registro_exitoso.php");
          }
        }else{
          //$n = "3";
          //var_dump($n, $email, $pass, $pla, $movilVehiculo, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
          //exit;
          $mensaje = $consulta->modificarConductor($email, $pass, $pla, $movilVehiculo, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
            foreach($vehiculos as $id){
              $registro = $consultaDriversCars->modificarCarrosManejados($idConductor, $id);
            }
            header("Location: ../../views/mensajes/registro_exitoso.php");
          }

        }



  }else{

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
        if ($vehiculos == '') {
        //agregar el conductor
        $placaGuardada = $consulta->idCarroManeja($idConductor);
        //$n = "4";
        //var_dump($n, $email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
        //exit;
        $mensaje = $consulta->modificarConductor($email, $pass, $placaGuardada, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);

          //Validar si pusieron datos en el campo vehiculos y agregarlos sí se ingresaron
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{

              //si esta vacio se envia el mensaje de modificacion
              header("Location: ../../views/mensajes/registro_exitoso.php");



          }
        }else{
          //$n = "5";
          //var_dump($n, $email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
          //exit;
          $mensaje = $consulta->modificarConductor($email, $pass, $pla, $movilVehiculo, $celular, $nombre_foto, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error.php");
          }else{
          foreach($vehiculos as $id){
            $registro = $consultaDriversCars->modificarCarrosManejados($idConductor, $id);
          }
          header("Location: ../../views/mensajes/registro_exitoso.php");
          }
        }


  }
}



 ?>
