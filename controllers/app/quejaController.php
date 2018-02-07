<?php
session_start();
require_once('../../models/conexion.php');
require_once('../../models/complains.php');
require_once('../../models/services.php');
require_once('../../models/users.php');
require_once('../../vendor/autoload.php');
require_once('../../util/nocsrf.php');
require_once('../../views/mensajes/templateCorreoQueja.php');

$idQueja = $_POST['id_queja'];
$queja = $_POST['queja'];
$fecha = $_POST['fecha'];
$nombre = $_POST['nombre'];
$respuesta = $_POST['mensaje'];
$id_servicio = $_POST['id_servicio'];

//objetos
$consulta = new Complains();
$consultaServicio = new Services();
$consultaUsuario = new Users();

//obtener el usuario del servicio
$idUsuario = $consultaServicio->obtnerIdUsuarioXIdServicio($id_servicio);
//obtener el email del usuario_id
$email = $consultaUsuario->obtenerEmailUsuario($idUsuario);

if (isset($_POST['_token'])) {
  if(NoCSRF::check('_token', $_POST, false, 60*10, false)){
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
    $mail->Subject = 'Respuesta a tu inquietud';
    $mail->Body    = EmailTemplateRespuesta($respuesta, $queja, $nombre,$fecha);
    $mail->AltBody = 'Hola'. $nombre . ': Segun su inquietud: "'.$queja.'", reportada el  dia '.$fecha.', tiene la siguiente respuesta: '.$respuesta.'. Para TaxisYa nuestro principal objetivo es prestar el mejor servicio.';

    if(!$mail->send()){
      $HTML = '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';
      $mensaje = $consulta->guardarRespuesta($respuesta, $idQueja);
      if($mensaje == FALSE){
        echo "No se pudo guardar la respuesta ni enviar el correo";
      }else{
        header('Location: ../../views/mensajes/registro_exitoso_queja_correo');
      }
    }else{
      $HTML = 1;
      $mensaje = $consulta->guardarRespuesta($respuesta, $idQueja);
      if($mensaje == FALSE){
        echo "No se pudo guardar la respuesta ni enviar el correo";
      }else{
        header('Location: ../../views/mensajes/registro_exitoso_queja');
      }
    }

  }else {
    header("Location: ../../views/mensajes/error.php");
  }
}




?>
