<?php
require_once('../../models/conexion.php');
require_once('../../models/lineCars.php');

$idLinea = $_POST['idLinea'];

$consulta = new LineCars();

$mensaje = $consulta->eliminarLinea($idLinea);

 ?>
