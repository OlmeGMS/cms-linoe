<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');

$cantidad = $_POST['cantidad-select'];

$consulta = new Users();
$consultaDir = new UsersDirs();

  $url = 'solicitarSeriviciosMultiples?cant='.$cantidad;
  header("Location: ../../views/app/$url");



?>
