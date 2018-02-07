<?php
require_once('../models/conexion.php');
require_once('../models/cars.php');
require_once('../models/drivers.php');
require_once('../models/driversCars.php');
require_once('../models/cmsDocuments.php');
require_once('../vendor/autoload.php');
require_once('../views/mensajes/template_correo.php');
require_once('../views/mensajes/template_correo_administrativo.php');


//datos conductor
$nombre = strtoupper($_POST['nombre']);
$apellido = strtoupper($_POST['apellido']);
$email = $_POST['email'];
$clave = $_POST['password'];
$pass = md5($_POST['password']);
$celular = $_POST['celular'];
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$licencia = $_POST['cedula'];
$direccion = $_POST['direccion'];
$fecha = date('Y-m-d H:i:s');

//datos vehículo
$placa = strtoupper($_POST['placa']);
$movil = $_POST['movil'];
$marca = strtoupper($_POST['marca']);
$linea = strtoupper($_POST['linea']);
$modelo = $_POST['modelo'];
$empresa = $_POST['empresa'];
$pago = '2020-12-31';

// Imagenes del formulario
$temporal = $_FILES['foto_conductor']['tmp_name'];
$temporal1 = $_FILES['foto_documento']['tmp_name'];
$temporal2 = $_FILES['foto_licencia']['tmp_name'];
$temporal3 = $_FILES['foto_propiedad']['tmp_name'];
$temporal4 = $_FILES['foto_operacion']['tmp_name'];

$fotoConductor = $_FILES['foto_conductor']['name'];
$fotoDocumento = $_FILES['foto_documento']['name'];
$fotoLicencia = $_FILES['foto_licencia']['name'];
$fotoPropiedad = $_FILES['foto_propiedad']['name'];
$fotoOperacion = $_FILES['foto_operacion']['name'];

if (strlen($nombre) > 0 && strlen($apellido) > 0 && strlen($email) > 0 && strlen($pass) > 0 && strlen($celular) > 0 && strlen($licencia) > 0 && strlen($direccion) > 0 && strlen($movil) > 0){
  //var_dump($nombre, $apellido, $email, $pass, $celular, $telefono, $cedula, $licencia, $direccion, $placa, $movil, $marca, $linea, $modelo, $empresa);
  $consulta = new Drivers();
  $consultaVehiculo = new Cars();
  $consultaDriversCars = new DriversCars();
  $consultaCmsDocuments = new CmsDocuments();
  $paso = TRUE;
  $paso1 = TRUE;
  $paso2 = TRUE;

  //redimesionar imagenes
  $original = $fotoConductor;
  $original1 = $fotoDocumento;
  $original2 = $fotoLicencia;
  $original3 = $fotoPropiedad;
  $original4 = $fotoOperacion;

  //agregar Carro
  $flag = null;
  $flag = $consultaVehiculo->validarVehiculo($placa);
  if (!empty($flag)) {
    if($flag == 0){
      $mensajesCarro = $consultaVehiculo->modificarVehiculo($placa, $marca, $linea, $movil, $empresa, $pago, $modelo, $flag);
      if ($mensajeCarro == FALSE) {
        header("Location: ../views/mensajes/error.html");
      }

    }
    if ($flag == 1) {
      //header("Location: ../views/mensajes/error_existe?ref=vehículo");
      $idNuevoCarro = $consultaVehiculo->obtenerIdVehiculo($placa);
    }
  }else{
    $mensajeCarro = $consultaVehiculo->agregarVehiculo($placa, $marca, $linea, $movil, $empresa, $pago, $modelo);
    if ($mensajeCarro == FALSE) {
      header("Location: ../views/mensajes/error.php");
      $paso = FALSE;
    }else{
      $idNuevoCarro = $consultaVehiculo->obtenerUltimoIdVehiculo();
    }
  }


  //guardar y redimencionar fotos
  if ($paso == TRUE) {
        if($_FILES['foto_conductor']['type'] == 'image/jpeg'){
          $foto_original = imagecreatefromjpeg($temporal);
          $ancho_original = imagesx($foto_original);
          $altura_original = imagesy($foto_original);
          $ancho_nuevo = 250;
          $alto_nuevo = round($ancho_nuevo * $altura_original / $ancho_original);
          $copia = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
          imagecopyresampled($copia, $foto_original, 0,0,0,0, 250,250, $ancho_original, $altura_original);
          imagejpeg($copia, '../views/dis/img/conductores/'.$fotoConductor, 100);
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
          imagejpeg($copia, '../views/dis/img/conductores/'.$fotoConductor, 100);
          //imagepng($copia, '../views/dis/img/conductores'.$nombre_foto, 100);
          imagedestroy($foto_original);
          imagedestroy($copia);
        }
      if($_FILES['foto_documento']['type'] == 'image/jpeg'){
        $foto_original1 = imagecreatefromjpeg($temporal1);
        $ancho_original1 = imagesx($foto_original1);
        $altura_original1 = imagesy($foto_original1);
        $ancho_nuevo1 = 250;
        $alto_nuevo1 = round($ancho_nuevo1 * $altura_original1 / $ancho_original1);
        $copia1 = imagecreatetruecolor($ancho_nuevo1, $alto_nuevo1);
        imagecopyresampled($copia1, $foto_original1, 0,0,0,0, 250,250, $ancho_original1, $altura_original1);
        imagejpeg($copia1, '../views/dis/img/documentos/'.$fotoDocumento, 100);
        imagedestroy($foto_original1);
        imagedestroy($copia1);
      }else{
        $foto_original1 = imagecreatefrompng($temporal1);
        $ancho_original1 = imagesx($foto_original1);
        $altura_original1 = imagesy($foto_original1);
        $ancho_nuevo1 = 250;
        $alto_nuevo1 = round($ancho_nuevo1 * $altura_original1 / $ancho_original1);
        $copia1 = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
        imagecopyresampled($copia1, $foto_original1, 0,0,0,0, 250,250, $ancho_original1, $altura_original1);
        imagejpeg($copia1, '../views/dis/img/documentos/'.$fotoDocumento, 100);
        imagedestroy($foto_original1);
        imagedestroy($copia1);
      }
      if($_FILES['foto_licencia']['type'] == 'image/jpeg'){
        $foto_original2 = imagecreatefromjpeg($temporal2);
        $ancho_original2 = imagesx($foto_original2);
        $altura_original2 = imagesy($foto_original2);
        $ancho_nuevo2 = 250;
        $alto_nuevo2 = round($ancho_nuevo2 * $altura_original2 / $ancho_original2);
        $copia2 = imagecreatetruecolor($ancho_nuevo2, $alto_nuevo2);
        imagecopyresampled($copia2, $foto_original2, 0,0,0,0, 250,250, $ancho_original2, $altura_original2);
        imagejpeg($copia2, '../views/dis/img/documentos/'.$fotoLicencia, 100);
        imagedestroy($foto_original2);
        imagedestroy($copia2);
      }else{
        $foto_original2 = imagecreatefrompng($temporal2);
        $ancho_original2 = imagesx($foto_original2);
        $altura_original2 = imagesy($foto_original2);
        $ancho_nuevo2 = 250;
        $alto_nuevo2 = round($ancho_nuevo2 * $altura_original2 / $ancho_original2);
        $copia2 = imagecreatetruecolor($ancho_nuevo2, $alto_nuevo2);
        imagecopyresampled($copia2, $foto_original2, 0,0,0,0, 250,250, $ancho_original2, $altura_original2);
        imagejpeg($copia2, '../views/dis/img/documentos/'.$fotoLicencia, 100);
        imagedestroy($foto_original2);
        imagedestroy($copia2);
      }
      if($_FILES['foto_propiedad']['type'] == 'image/jpeg'){
        $foto_original3 = imagecreatefromjpeg($temporal3);
        $ancho_original3 = imagesx($foto_original3);
        $altura_original3 = imagesy($foto_original3);
        $ancho_nuevo3 = 250;
        $alto_nuevo3 = round($ancho_nuevo3 * $altura_original3 / $ancho_original3);
        $copia3 = imagecreatetruecolor($ancho_nuevo3, $alto_nuevo3);
        imagecopyresampled($copia3, $foto_original3, 0,0,0,0, 250,250, $ancho_original3, $altura_original3);
        imagejpeg($copia3, '../views/dis/img/documentos/'.$fotoPropiedad, 100);
        imagedestroy($foto_original3);
        imagedestroy($copia3);
      }else{
        $foto_original3 = imagecreatefrompng($temporal3);
        $ancho_original3 = imagesx($foto_original3);
        $altura_original3 = imagesy($foto_original3);
        $ancho_nuevo3 = 250;
        $alto_nuevo3 = round($ancho_nuevo3 * $altura_original3 / $ancho_original3);
        $copia3 = imagecreatetruecolor($ancho_nuevo3, $alto_nuevo3);
        imagecopyresampled($copia3, $foto_original3, 0,0,0,0, 250,250, $ancho_original3, $altura_original3);
        imagejpeg($copia3, '../views/dis/img/documentos/'.$fotoPropiedad, 100);
        imagedestroy($foto_original3);
        imagedestroy($copia3);
      }
      if($_FILES['foto_operacion']['type'] == 'image/jpeg'){
        $foto_original4 = imagecreatefromjpeg($temporal4);
        $ancho_original4 = imagesx($foto_original4);
        $altura_original4 = imagesy($foto_original4);
        $ancho_nuevo4 = 250;
        $alto_nuevo4 = round($ancho_nuevo4 * $altura_original4 / $ancho_original4);
        $copia4 = imagecreatetruecolor($ancho_nuevo4, $alto_nuevo4);
        imagecopyresampled($copia4, $foto_original4, 0,0,0,0, 250,250, $ancho_original4, $altura_original4);
        imagejpeg($copia4, '../views/dis/img/documentos/'.$fotoOperacion, 100);
        imagedestroy($foto_original4);
        imagedestroy($copia4);
      }else{
        $foto_original4 = imagecreatefrompng($temporal4);
        $ancho_original4 = imagesx($foto_original4);
        $altura_original4 = imagesy($foto_original4);
        $ancho_nuevo4 = 250;
        $alto_nuevo4 = round($ancho_nuevo4 * $altura_original4 / $ancho_original4);
        $copia4 = imagecreatetruecolor($ancho_nuevo4, $alto_nuevo4);
        imagecopyresampled($copia4, $foto_original4, 0,0,0,0, 250,250, $ancho_original4, $altura_original4);
        imagejpeg($copia4, '../views/dis/img/documentos/'.$fotoOperacion, 100);
        imagedestroy($foto_original4);
        imagedestroy($copia4);
      }
      //agregar Conductor
      $flagConductorEmail = $consulta->verificarCorreoConductor($email);
      if($flagConductorEmail == TRUE){
        header("Location: ../views/mensajes/registro_error.html");
      }else{
        $flagConductorDocumento = $consulta->verificarCedula($cedula);
        if ($flagConductorDocumento == TRUE) {
          header("Location: ../views/mensajes/registro_error.html");
        }else{

          $mensajeConductor = $consulta->agregarConductorWeb($email, $pass, $idNuevoCarro, $movil, $celular, $fotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono);
          if ($mensajeConductor == FALSE) {
            header("Location: ../views/mensajes/error.php");
          }else {
            $idNuevoConductor = $consulta->ultimoIdConductor();
            $mensajeDriversCars = $consultaDriversCars->agregarRegistro($idNuevoConductor, $idNuevoCarro);
            if ($mensajeDriversCars == FALSE) {
              header("Location: ../views/mensajes/error.php");
              $paso1 = FALSE;
            }
          }

        }
      }
  }

  if ($paso1 == TRUE) {
    //agregar Documentos
        $mensajeDocumentos = $consultaCmsDocuments->agregarFotoDocumentos($fotoDocumento, $fotoLicencia, $fotoPropiedad, $fotoOperacion, $idNuevoConductor);
        if ($mensajeDocumentos == FALSE) {
          header("Location: ../views/mensajes/error.php");
        }else {
          $mail = new PHPMailer;
          $mail->CharSet = "UTF-8";
          $mail->Encoding = "quoted-printable";
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username ='taxisya.cms@gmail.com';
          $mail->Password = 't4x1sy42015';
          $mail->SMTPSecure = 'tls';
          $mail->SMTPOptions = array(
              'tls' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
            ));

          $mail->Port = 587;
          $mail->setFrom('taxisya.cms@gmail.com', 'TaxisYa');
          $mail->addAddress($email, $nombre);
          $mail->isHTML(true);
          $mail->Subject = 'Inscripción a Taxisya';
          $mail->Body    = EmailTemplate($email, $nombre, $clave, $cedula);
          $mail->AltBody = 'Hola'. $nombre . ': Su solicitud fue enviada, espera que el administrador la active';

          if(!$mail->send()){
            $HTML = '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';

          }else{
            $HTML = 1;
          }
          // correo notificando a fabian
          $info = "Se ha registrado un nuevo conductor por APP/WEB de nombre: $nombre";
          //mail('fabian.gutierrez@celuvans.com.co', 'Nuevo Conductor Registrado', $info);
          //mail('olme_gms@hotmail.com', 'Nuevo Conductor Registrado', $info);
          $correo_admin = "olme_gms@hotmail.com";
          $nombre_admin = "administrador";
          $mail = new PHPMailer;
          $mail->CharSet = "UTF-8";
          $mail->Encoding = "quoted-printable";
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username ='taxisya.cms@gmail.com';
          $mail->Password = 't4x1sy42015';
          $mail->SMTPSecure = 'tls';
          $mail->SMTPOptions = array(
              'tls' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
            ));

          $mail->Port = 587;
          $mail->setFrom('taxisya.cms@gmail.com', 'TaxisYa');
          $mail->addAddress($correo_admin, $nombre_admin);
          $mail->isHTML(true);
          $mail->Subject = 'Inscripción a Taxisya';
          $mail->Body    = EmailTemplateAdministrativo($email, $nombre_admin, $nombre, $placa);
          $mail->AltBody = "Hola". $nombre_admin . ": Se ha registrado un nuevo conductor por APP/WEB de nombre: $nombre";

          if(!$mail->send()){
            $HTML = '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';

          }else{
            $HTML = 1;
          }
          echo "Se realizo el registro correctamente";
        }
      }else{
        echo "llene todo los campos";
      }

  }else{
    echo "llene todo los campos";
  }








 ?>
