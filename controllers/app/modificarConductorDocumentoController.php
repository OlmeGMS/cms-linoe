<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/drivers.php');
require_once('../../models/driversCars.php');
require_once('../../models/cmsDocuments.php');
require_once('../../models/company.php');
require_once('../../models/brandsCars.php');
require_once('../../models/lineCars.php');
require_once('../../vendor/autoload.php');
require_once('../../views/mensajes/template_correo_respuesta.php');
require_once('../../views/mensajes/template_correo_aceptado.php');
require_once('../../util/nocsrf.php');

if (isset($_POST['_token'])) {
    if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
      $consulta = new Drivers();
      $consultaVehiculo = new Cars();
      $consultaDriversCars = new DriversCars();
      $consultaCmsDocuments = new CmsDocuments();

      //banderas
      $paso = TRUE;
      $paso1 = TRUE;
      $paso2 = TRUE;

      //datos conductor
      $nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
      $apellido = htmlspecialchars(strtoupper($_POST['primer_apellido']), ENT_QUOTES,'UTF-8');
      $email = htmlspecialchars($_POST['email'], ENT_QUOTES,'UTF-8');
      $celular = htmlspecialchars($_POST['movil'], ENT_QUOTES,'UTF-8');
      $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES,'UTF-8');
      $cedula = htmlspecialchars($_POST['Documento'], ENT_QUOTES,'UTF-8');
      $licencia = $_POST['Documento'];
      $direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES,'UTF-8');
      $estadoConductor = $_POST['example-inline-radios'];
      $fecha = date('Y-m-d H:i:s');
      $idConductor = $_POST['id_conductor'];
      $idDocumento = $consultaCmsDocuments->obtenerIdDocumento($idConductor);
      $respuesta = $_POST['example-clickable-bio'];

      //datos vehículo
      $placa = strtoupper($_POST['placa']);
      $movil = $_POST['nafiliacion'];
      $marca = $_POST['marca'];
      $linea = $_POST['lineas'];
      $modelo = $_POST['modelo'];
      $empresa = $_POST['empresa'];
      $pago = '2020-12-31';
      $idVehiculo = $_POST['id_carro'];
      $factor = isset($_POST['factor']);

      if ($factor == true) {
        $factor = 1;
      }else {
        $factor = 0;
      }
      $consultaEmpresa = new Company();
      $consultaMarca = new brandsCars();
      $consultaLinea = new LineCars();

      $nombreEmpresa = $consultaEmpresa->obtenerNombreEmpresa($empresa);
      $ciudad = $consultaEmpresa->obtenerciudadEmpresa($empresa);
      $nombreMarca = $consultaMarca->obtenerNombreMarca($marca);
      $nombreLinea = $consultaLinea->obtenerNombreLinea($linea);

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

        if ($fotoConductor == ''){
          $fotoConductor = $consulta->fotoConductor($idConductor);
        }else{
          //redimesionar imagenes
          $original = $fotoConductor;
          if($_FILES['foto_conductor']['type'] == 'image/jpeg'){
            $foto_original = imagecreatefromjpeg($temporal);
            $ancho_original = imagesx($foto_original);
            $altura_original = imagesy($foto_original);
            $ancho_nuevo = 250;
            $alto_nuevo = round($ancho_nuevo * $altura_original / $ancho_original);
            $copia = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
            imagecopyresampled($copia, $foto_original, 0,0,0,0, 250,250, $ancho_original, $altura_original);
            imagejpeg($copia, '../../views/dis/img/conductores/'.$fotoConductor, 100);
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
            imagejpeg($copia, '../../views/dis/img/conductores/'.$fotoConductor, 100);
            //imagepng($copia, '../views/dis/img/conductores'.$nombre_foto, 100);
            imagedestroy($foto_original);
            imagedestroy($copia);
          }
        }



        //modificar vehiculo
        $mensajeCarro = $consultaVehiculo->modificarVehiculo($placa, $nombreMarca, $nombreLinea, $movil, $nombreEmpresa, $pago, $modelo, $ciudad, $factor, $empresa, $marca, $linea, $idVehiculo);


        if ($mensajeCarro == FALSE) {
          header("Location: ../../views/mensajes/error.php");
        }

        //modificar Conductor
        $mensajeConductor = $consulta->modificarConductorD($email, $idVehiculo, $celular, $fotoConductor, $estadoConductor, $nombre, $apellido, $fecha, $cedula, $direccion, $telefono, $idConductor);
        if ($mensajeConductor == FALSE) {
          header("Location: ../../views/mensajes/error.php");
        }

        if ($fotoDocumento == ''){
          $fotoDocumento = $consultaCmsDocuments->obtenerFotoDocumento1($idDocumento);
        }else {
          $original1 = $fotoDocumento;
          if($_FILES['foto_documento']['type'] == 'image/jpeg'){
            $foto_original1 = imagecreatefromjpeg($temporal1);
            $ancho_original1 = imagesx($foto_original1);
            $altura_original1 = imagesy($foto_original1);
            $ancho_nuevo1 = 250;
            $alto_nuevo1 = round($ancho_nuevo1 * $altura_original1 / $ancho_original1);
            $copia1 = imagecreatetruecolor($ancho_nuevo1, $alto_nuevo1);
            imagecopyresampled($copia1, $foto_original1, 0,0,0,0, 250,250, $ancho_original1, $altura_original1);
            imagejpeg($copia1, '../../views/dis/img/documentos/'.$fotoDocumento, 100);
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
            imagejpeg($copia1, '../../views/dis/img/documentos/'.$fotoDocumento, 100);
            imagedestroy($foto_original1);
            imagedestroy($copia1);
          }
        }

        if ($fotoLicencia == ''){
          $fotoLicencia = $consultaCmsDocuments->obtenerFotoDocumento1($idDocumento);
        }else {
          $original2 = $fotoLicencia;
          if($_FILES['foto_licencia']['type'] == 'image/jpeg'){
            $foto_original2 = imagecreatefromjpeg($temporal2);
            $ancho_original2 = imagesx($foto_original2);
            $altura_original2 = imagesy($foto_original2);
            $ancho_nuevo2 = 250;
            $alto_nuevo2 = round($ancho_nuevo2 * $altura_original2 / $ancho_original2);
            $copia2 = imagecreatetruecolor($ancho_nuevo2, $alto_nuevo2);
            imagecopyresampled($copia2, $foto_original2, 0,0,0,0, 250,250, $ancho_original2, $altura_original2);
            imagejpeg($copia2, '../../views/dis/img/documentos/'.$fotoLicencia, 100);
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
            imagejpeg($copia2, '../../views/dis/img/documentos/'.$fotoLicencia, 100);
            imagedestroy($foto_original2);
            imagedestroy($copia2);
          }
        }

        if ($fotoPropiedad == ''){
          $fotoPropiedad = $consultaCmsDocuments->obtenerFotoDocumento3($idDocumento);
        }else {
          $original3 = $fotoPropiedad;
          if($_FILES['foto_propiedad']['type'] == 'image/jpeg'){
            $foto_original3 = imagecreatefromjpeg($temporal3);
            $ancho_original3 = imagesx($foto_original3);
            $altura_original3 = imagesy($foto_original3);
            $ancho_nuevo3 = 250;
            $alto_nuevo3 = round($ancho_nuevo3 * $altura_original3 / $ancho_original3);
            $copia3 = imagecreatetruecolor($ancho_nuevo3, $alto_nuevo3);
            imagecopyresampled($copia3, $foto_original3, 0,0,0,0, 250,250, $ancho_original3, $altura_original3);
            imagejpeg($copia3, '../../views/dis/img/documentos/'.$fotoPropiedad, 100);
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
            imagejpeg($copia3, '../../views/dis/img/documentos/'.$fotoPropiedad, 100);
            imagedestroy($foto_original3);
            imagedestroy($copia3);
          }
        }

        if ($fotoOperacion == ''){
          $fotoOperacion = $consultaCmsDocuments->obtenerFotoDocumento4($idDocumento);
        }else {
          $original4 = $fotoOperacion;
          if($_FILES['foto_operacion']['type'] == 'image/jpeg'){
            $foto_original4 = imagecreatefromjpeg($temporal4);
            $ancho_original4 = imagesx($foto_original4);
            $altura_original4 = imagesy($foto_original4);
            $ancho_nuevo4 = 250;
            $alto_nuevo4 = round($ancho_nuevo4 * $altura_original4 / $ancho_original4);
            $copia4 = imagecreatetruecolor($ancho_nuevo4, $alto_nuevo4);
            imagecopyresampled($copia4, $foto_original4, 0,0,0,0, 250,250, $ancho_original4, $altura_original4);
            imagejpeg($copia4, '../../views/dis/img/documentos/'.$fotoOperacion, 100);
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
            imagejpeg($copia4, '../../views/dis/img/documentos/'.$fotoOperacion, 100);
            imagedestroy($foto_original4);
            imagedestroy($copia4);
          }
        }

        //modificar documentos
        $mensajeDocumentos = $consultaCmsDocuments->modificarFotoDocumentos($fotoDocumento, $fotoLicencia, $fotoPropiedad, $fotoOperacion, $idConductor, $fecha, $idDocumento);

        if ($mensajeDocumentos == FALSE) {
          header("Location: ../../views/mensajes/error.php");
        }else {
          if ($mensajeCarro == TRUE && $mensajeConductor == TRUE && $mensajeDocumentos == TRUE ) {
            switch ($estadoConductor) {
              case 'true':
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
                    $mail->Body    = EmailTemplateAceptado($nombre);
                    $mail->AltBody = 'Hola'. $nombre . ': Su solicitud fue aceptada, ya puede usar nuestra aplicación';

                    if(!$mail->send()){
                      $HTML = '<div class="alert alert-dismissible alert-danger">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';

                    }else{
                      $HTML = 1;
                    }
                    header("Location: ../../views/mensajes/registro_exitoso.php");
                break;
                case 'false':
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
                      $mail->Body    = EmailTemplateRespuesta($nombre, $apellido, $estadoConductor, $respuesta);
                      $mail->AltBody = 'Hola'. $nombre . ': Su estado es: '.$estadoConductor.' debido a: '.$respuesta;

                      if(!$mail->send()){
                        $HTML = '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';

                      }else{
                        $HTML = 1;
                      }
                      header("Location: ../../views/mensajes/registro_exitoso.php");
                  break;
                  case 'rechazado':
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
                        $mail->Body    = EmailTemplateRespuesta($nombre, $apellido, $estadoConductor, $respuesta);
                        $mail->AltBody = 'Hola'. $nombre . ': Su estado es: '.$estadoConductor.' debido a: '.$respuesta;

                        if(!$mail->send()){
                          $HTML = '<div class="alert alert-dismissible alert-danger">
                          <button type="button" class="close" data-dismiss="alert">x</button>
                          <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';

                        }else{
                          $HTML = 1;
                        }
                        header("Location: ../../views/mensajes/registro_exitoso.php");
                    break;

              default:
                echo "No se pudo enviar el correo";
                break;
            }






          }else{
            echo "error en alguna de las modificaciones";
          }
        }
    }else {
      header("Location: ../../views/mensajes/error.php");
    }
}






















 ?>
