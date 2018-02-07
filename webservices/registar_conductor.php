<?php
require_once('../models/conexion.php');
require_once('../models/cars.php');
require_once('../models/drivers.php');
require_once('../models/driversCars.php');
require_once('../models/cmsDocuments.php');
require_once('../models/company.php');
require_once('../models/brandsCars.php');
require_once('../models/lineCars.php');
require_once('../vendor/autoload.php');
require_once('../views/mensajes/template_correo.php');
require_once('../views/mensajes/template_correo_administrativo.php');

$consulta = new Drivers();
$consultaVehiculo = new Cars();
$consultaDriversCars = new DriversCars();
$consultaCmsDocuments = new CmsDocuments();
$consultaEmpresa = new Company();
$consultaMarca = new BrandsCars();
$consultaLinea = new LineCars();

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
$tc = $_POST['tc'];
$numeros = time();

//datos vehículo
$placa = strtoupper($_POST['placa']);
$movil = $_POST['movil'];
$marca = $_POST['marca'];
$linea = $_POST['linea'];
$modelo = $_POST['modelo'];
$empresa = $_POST['empresa'];
$pago = '2020-12-31';

if($movil == NULL || $movil = ''){
  $movil = 0;
}


$ciudad = $consultaEmpresa->obtenerciudadEmpresa($empresa);

// Imagenes del formulario
$temporal = $_FILES['foto_conductor']['tmp_name'];
$temporal1 = $_FILES['foto_documento']['tmp_name'];
$temporal2 = $_FILES['foto_licencia']['tmp_name'];
$temporal3 = $_FILES['foto_propiedad']['tmp_name'];
$temporal4 = $_FILES['foto_operacion']['tmp_name'];
/*
$fotoConductor = $_FILES['foto_conductor']['name'];
$fotoDocumento = $_FILES['foto_documento']['name'];
$fotoLicencia = $_FILES['foto_licencia']['name'];
$fotoPropiedad = $_FILES['foto_propiedad']['name'];
$fotoOperacion = $_FILES['foto_operacion']['name'];
*/
$fotoConductorCifrada = $_POST['foto_conductor'];
$fotoDocumentoCifrada = $_POST['foto_documento'];
$fotoLicenciaCifrada = $_POST['foto_licencia'];
$fotoPropiedadCifrada = $_POST['foto_propiedad'];
$fotoOperacionCifrada = $_POST['foto_operacion'];

//list(, $fotoConductorCifrada) = explode(';', $fotoConductorCifrada);
//list(, $fotoConductorCifrada) = explode(',', $fotoConductorCifrada);
//Decodificamos $Base64Img codificada en base64.
$fotoConductorCifrada = base64_decode($fotoConductorCifrada);
//escribimos la información obtenida en un archivo llamado
//unodepiera.png para que se cree la imagen correctamente
file_put_contents("../views/dis/img/conductores/conductor$numeros.png", $fotoConductorCifrada);
$nameFotoConductor = "conductor$numeros.png";

$fotoConductor = $fotoConductorCifrada;

//list(, $fotoDocumentoCifrada) = explode(';', $fotoDocumentoCifrada);
//list(, $fotoDocumentoCifrada) = explode(',', $fotoDocumentoCifrada);
//Decodificamos $Base64Img codificada en base64.
$fotoDocumentoCifrada = base64_decode($fotoDocumentoCifrada);

file_put_contents("../views/dis/img/documentos/documento$numeros.png", $fotoDocumentoCifrada);
$nameFotoDocumento = "documento$numeros.png";

$fotoDocumento = $fotoDocumentoCifrada;

//list(, $fotoLicenciaCifrada) = explode(';', $fotoLicenciaCifrada);
//list(, $fotoLicenciaCifrada) = explode(',', $fotoLicenciaCifrada);
//Decodificamos $Base64Img codificada en base64.
$fotoLicenciaCifrada = base64_decode($fotoLicenciaCifrada);

file_put_contents("../views/dis/img/documentos/licencia$numeros.png", $fotoLicenciaCifrada);
$nameFotoLicencia = "licencia$numeros.png";
$fotoLicencia = $fotoLicenciaCifrada;

//list(, $fotoPropiedadCifrada) = explode(';', $fotoPropiedadCifrada);
//list(, $fotoPropiedadCifrada) = explode(',', $fotoPropiedadCifrada);
//Decodificamos $Base64Img codificada en base64.
$fotoPropiedadCifrada = base64_decode($fotoPropiedadCifrada);

file_put_contents("../views/dis/img/documentos/pro$numeros.png", $fotoPropiedadCifrada);
$nameFotoPropiedad = "pro$numeros.png";
$fotoPropiedad = $fotoPropiedadCifrada;

//list(, $fotoOperacionCifrada) = explode(';', $fotoOperacionCifrada);
//list(, $fotoOperacionCifrada) = explode(',', $fotoOperacionCifrada);
//Decodificamos $Base64Img codificada en base64.
$fotoOperacionCifrada = base64_decode($fotoOperacionCifrada);

file_put_contents("../views/dis/img/documentos/oper$numeros.png", $fotoOperacionCifrada);
$nameFotoOperacion = "oper$numeros.png";
$fotoPropiedad = $fotoOperacionCifrada;

$fotoOperacion = $_POST['foto_operacion']['name'];

if (strlen($nombre) > 0 && strlen($email) > 0 && strlen($pass) > 0 && strlen($celular) > 0 && strlen($licencia) > 0 && strlen($direccion) > 0){
  //var_dump($nombre, $apellido, $email, $pass, $celular, $telefono, $cedula, $licencia, $direccion, $placa, $movil, $marca, $linea, $modelo, $empresa);


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
      $nombreEmpresa = $consultaEmpresa->obtenerNombreEmpresa($empresa);
      $ciudad = $consultaEmpresa->obtenerciudadEmpresa($empresa);
      $nombreMarca = $consultaMarca->obtenerNombreMarca($marca);
      $nombreLinea = $consultaLinea->obtenerNombreLinea($linea);
      $factor = 0;
      $mensajesCarro = $consultaVehiculo->actualizarVehiculoEstado($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago,  $modelo, $ciudad, $factor, $empresa, $marca, $linea, $flag);


      if ($mensajeCarro == FALSE) {
        $respuesta = array('success' => false, 'message' => 'No se pudo modificar el vehículo');
        header('Content-Type: application/json');
        echo json_encode($respuesta);
      }

    }
    if ($flag == 1) {
      //header("Location: ../views/mensajes/error_existe?ref=vehículo");
      $idNuevoCarro = $consultaVehiculo->obtenerIdVehiculo($placa);
    }
  }else{
    $nombreEmpresa = $consultaEmpresa->obtenerNombreEmpresa($empresa);
    $nombreMarca = $consultaMarca->obtenerNombreMarca($marca);
    $nombreLinea = $consultaLinea->obtenerNombreLinea($linea);
    $ciudad = $consultaEmpresa->obtenerciudadEmpresa($empresa);
    $factor = 0;
    $mensajeCarro = $consultaVehiculo->agregarVehiculo($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago,  $modelo, $ciudad, $factor, $empresa, $marca, $linea);

    if ($mensajeCarro == FALSE) {
      $respuesta = array('success' => false, 'message' => 'No se pudo agrear el vehículo');
      header('Content-Type: application/json');
      echo json_encode($respuesta);
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
        $respuesta = array('success' => false, 'message' => 'Hay un conductor asociado con el email');
        header('Content-Type: application/json');
        echo json_encode($respuesta);
      }else{
        $flagConductorDocumento = $consulta->verificarCedula($cedula);
        if ($flagConductorDocumento == TRUE) {
          $respuesta = array('success' => false, 'message' => 'Hay un conductor asosicado con la cedula');
          header('Content-Type: application/json');
          echo json_encode($respuesta);
        }else{

          $mensajeConductor = $consulta->agregarConductorWeb($email, $pass, $idNuevoCarro, $movil, $celular, $nameFotoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $ciudad, $tc);
          if ($mensajeConductor == FALSE) {
            $respuesta = array('success' => false, 'message' => 'No se puedo agregar el conductor');
            header('Content-Type: application/json');
            echo json_encode($respuesta);
          }else {
            $idNuevoConductor = $consulta->ultimoIdConductor();
            $mensajeDriversCars = $consultaDriversCars->agregarRegistro($idNuevoConductor, $idNuevoCarro);
            if ($mensajeDriversCars == FALSE) {
              $respuesta = array('success' => false, 'message' => 'No se pudo crear la asociación entre conductor y vehículo');
              header('Content-Type: application/json');
              echo json_encode($respuesta);
              $paso1 = FALSE;
            }
          }

        }
      }
  }

  if ($paso1 == TRUE) {
    //agregar Documentos
        $mensajeDocumentos = $consultaCmsDocuments->agregarFotoDocumentos($nameFotoDocumento, $nameFotoLicencia, $nameFotoPropiedad, $nameFotoOperacion, $idNuevoConductor);
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
          $correo_admin = "soportetaxisya@gmail.com";
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

          $idUltimoCarro = $consultaVehiculo->obtenerUltimoIdVehiculo();
          $datosCarro = $consultaVehiculo->cargarVehiculo($idUltimoCarro);

          $idUltimoConductor = $consulta->ultimoIdConductor();
          $datosCoductor = $consulta->cargarConductor($idUltimoConductor);

          foreach ($datosCarro as $dataCarro) {
            $idCarroArray = $dataCarro['id'];
            $placaCarroArray = $dataCarro['placa'];
            $marcaArray = $dataCarro['car_brand'];
            $lineaCarroArray = $dataCarro['model'];
            $movilArray = $dataCarro['movil'];
            $modeloArray = $dataCarro['year'];
            $idCiudadArray = $dataCarro['city_id'];
            $idEmpresaArray = $dataCarro['id_empresa'];
          }

          foreach ($datosCoductor as $data) {
            $idConductorArray = $data['id'];
            $nombreConductorArray = $data['name'];
            $apellidoConductorArray = $data['lastname'];
            $emailConductorArray = $data['email'];
            $cedulaConductorArray = $data['cedula'];
            $direccionConductorArray = $data['dir'];
            $celularConductorArray = $data['cellphone'];
            $telefonoConductorArray = $data['telephone'];
            $numeroTcConductorArray = $data['numero_tc'];
          }

          $respuesta = array('success' => true, 'data' => array(array('id_conductor' => $idConductorArray, 'nombre' => $nombreConductorArray, 'apellido' => $apellidoConductorArray, 'email' => $emailConductorArray, 'cedula' => $cedulaConductorArray,'direccion' => $direccionConductorArray, 'celular' => $celularConductorArray,
          'telefono' => $telefonoConductorArray, 'numeroTc' => $numeroTcConductorArray),array('id_vehiculo' => $idCarroArray, 'placa' => $placaCarroArray, 'marca' => $marcaArray, 'linea' => $lineaCarroArray , 'movil' => $movilArray,'modelo' => $modeloArray, 'id_ciudad' => $idCiudadArray,'id_empresa' => $idEmpresaArray)));
          header('Content-Type: application/json');
          echo json_encode($respuesta);
        }
      }else{
        echo "llene todo los campos";
      }

  }else{
    $respuesta = array('success' => false, 'message' => 'hay campos vacios');
    header('Content-Type: application/json');
    echo json_encode($respuesta);
  }








 ?>
