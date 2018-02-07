<?php
$empresa = $_POST['empresa'];
$rol = $_POST['rolusu'];
if($rol == 3){
  header("location: ../../../views/app/valesCentral?compania=$empresa");
}else{
  header("location: ../../../views/app/valesAdministrador?compania=$empresa");
}


 ?>
