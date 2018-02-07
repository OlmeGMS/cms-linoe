<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');

$consulta = new Services();

$empresa = $_POST['empresa'];


  header('Location: ../../../views/app/ServicosValesXEmpresa?empresa='.$empresa);






 ?>
