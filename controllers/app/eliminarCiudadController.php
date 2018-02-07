<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCities.php');

$idCiudad = $_POST['idCiudad'];

$consulta = new CmsCities();

$mensaje = $consulta->EliminarCiudad($idCiudad);

 ?>
