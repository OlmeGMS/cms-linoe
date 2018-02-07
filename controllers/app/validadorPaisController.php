<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCountries.php');
require_once('../../models/cmsDepartments.php');

$idPais = $_POST['id'];

$consultaDepartamento = New CmsDepartments();

$filas = $consultaDepartamento->listaDepartamentos($idPais);

$html ='<option value=""disabled selected>Seleccione el departamento</option>';
foreach ($filas as $fila) {
  $html .= '<option value="'.$fila['id'].'">'.$fila['name'].'</option>';
}
echo $html;



 ?>
