<?php
require_once('../../../models/conexion.php');
require_once('../../../models/cmsUsers.php');

if(isset($_POST['idmanager'])){
  $idManager = $_POST['idmanager'];
  $consulta = new CmsUsers();
  $mensaje = $consulta->EstadoManager($idManager);
  if ($mensaje == TRUE) {
    return "ELIMINADO";
  }else {
    return "ERROR: El manager no se pudo eliminar";
  }
}


 ?>
