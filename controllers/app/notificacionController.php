<?php
require_once('../../models/conexion.php');
require_once('../../../application/libraries/Notifier.php');

$mensaje = $_POST['mensaje'];
$tipo = $_POST['tipo_usuario'];

if($tipo == 1){
  $result = Notifier::massive($mensaje, false);
}else{
  $result = Notifier::massive($mensaje, true);
}


 ?>
