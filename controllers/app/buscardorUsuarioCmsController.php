<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsUsers.php');

$consulta = new CmsUsers();

$item = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$frase = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');



$mensaje = $consulta->busquedaPersonalizdaUsuarioCms($item, $frase);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../views/app/busquedaUsuariosCms?item='.$item.'&&frase='.$frase);
}


 ?>
