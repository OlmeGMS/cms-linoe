<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');

$consulta = new Users();

$item = htmlspecialchars($_POST['item-busqueda'], ENT_QUOTES,'UTF-8');
$frase = htmlspecialchars($_POST['frase'], ENT_QUOTES,'UTF-8');

$mensaje = $consulta->busquedaPersonalizdaUsuario($item, $frase);

if ($mensaje == 0 || $mensaje == "" || $mensaje == null) {
  header('Location: ../../views/mensajes/error_busqueda');
}else{
  header('Location: ../../views/app/busquedaUsuariosApp?item='.$item.'&&frase='.$frase);
}


 ?>
