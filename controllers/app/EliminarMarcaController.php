<?php
require_once('../../models/conexion.php');
require_once('../../models/brandsCars.php');

$idCiudad = $_POST['idMarca'];

$consulta = new BrandsCars();

$mensaje = $consulta->eliminarMarca($idCiudad);

 ?>
