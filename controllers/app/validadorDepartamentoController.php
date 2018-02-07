<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCities.php');


$idDepartamento = $_POST['departamento'];

$consultaCiudad = New CmsCities();

$filas = $consultaCiudad->listaCiudades($idDepartamento);

$html ='<option value=""disabled selected>Seleccione la ciudad</option>';
foreach ($filas as $fila) {
  $html .= '<option value="'.$fila['id'].'">'.$fila['name'].'</option>';
}

echo $html;

 ?>
