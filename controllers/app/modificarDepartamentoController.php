<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsDepartments.php');
require_once('../../util/nocsrf.php');

$consulta = new CmsDepartments();
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$estado = 1;
$pais = $_POST['pais'];
$idDepartamento = $_POST['id_departamento'];

if (isset($_POST['_token'])){

    $mensaje = $consulta->modificarDepartamento($nombre, $pais, $idDepartamento);
    if ($mensaje == FALSE) {
      header("Location: ../../views/mensajes/error");
    }else {
      header("Location: ../../views/app/listaDepartamentos");

  }
}
 ?>
