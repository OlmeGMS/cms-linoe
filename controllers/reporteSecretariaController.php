 <?php
 //require_once('../models/conexion.php');
 $idEmpresa = $_POST['empresa'];
 if (isset($idEmpresa)) {
   header("Location: ../views/lista_reportes?empresa=$idEmpresa");
 }else {
   header("Location: ../views/reportes");
 }

  ?>
