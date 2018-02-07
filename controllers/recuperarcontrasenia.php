<?php
require_once('../models/conexion.php');
require_once('../models/cmsUsers.php');
require_once('../util/passwordRadom.php');
require_once('../util/Cifrado.php');
require_once('../vendor/autoload.php');
require_once('../views/mensajes/TemplateEmailLost.php');

$email = htmlspecialchars($_POST['reminder-email'], ENT_QUOTES,'UTF-8');

$consulta = new CmsUsers();
$password = password_random();
$clave = Cifrado($password);
$idUsuario = $consulta->obtenerIdDUserCms($email);
$nombre = $consulta->nombreUsuario($idUsuario);


if(!empty($idUsuario)){
  $mensaje = $consulta->cambiarContrasena($clave, $idUsuario);
  if ($mensaje == FALSE) {
    header('Location: ../views/mensajes/error.html');
  }else{

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
      $mail->Subject = 'Recuper contraseña de Taxisya';
      $mail->Body    = EmailLostTemplate($nombre, $password);
      $mail->AltBody = 'Hola'. $nombre . ': Su solicitud clave temporal es: '.$password;

      if(!$mail->send()){
        $HTML = '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>ERROR:</strong> ' . $mail->ErrorInfo . ' </div>';

      }else{
        $HTML = 1;
      }
      header("Location: ../views/mensajes/info_contrasenia?ref=$nombre");
    }



}else{
  header('Location: ../views/mensajes/error.html');
}





?>
