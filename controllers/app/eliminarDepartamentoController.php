<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsDepartments.php');

$idDepartamento = $_POST['idDepartamento'];

$consulta = new CmsDepartments();

$mensaje = $consulta->EliminarDepartamento($idDepartamento);

 ?>
