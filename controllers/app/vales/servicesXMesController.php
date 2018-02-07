<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');

$mes = $_POST['mes'];
$year = $_POST['year'];
$empresa = $_POST['id_empresa'];
$cc = $_POST['cc'];

if(!empty($mes)){
  header("Location: ../../../views/app/serviciosAdministradorMes?year=$year&&idmes=$mes&&empresa=$empresa&&center=$cc");
}else{
  header("Location: ../../../views/app/ServicosValesXEmpresa");
}


 ?>
