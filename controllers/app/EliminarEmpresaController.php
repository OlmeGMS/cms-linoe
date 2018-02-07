<?php
require_once('../../models/conexion.php');
require_once('../../models/company.php');

if (isset($_POST['idEmpresa'])){
  $idEmpresa = $_POST['idEmpresa'];
  $consulta = new Company();
  $mensaje = $consulta->eliminarEmpresa($idEmpresa);
  
}else{

}
 ?>
