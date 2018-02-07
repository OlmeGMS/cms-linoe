<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCountries.php');

$consulta = new CmsCountries();

$idPais = $_POST['idPais'];

$mensaje = $consulta->eliminarPais($idPais);


 ?>
