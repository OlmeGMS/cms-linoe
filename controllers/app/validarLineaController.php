<?php
require_once('../../models/conexion.php');
require_once('../../models/lineCars.php');

$idMarca = $_POST['idMarca'];
$consulta = new LineCars();
$filas = $consulta->listaMarcasActivasXMarca($idMarca);

$html ='<option value=""disabled selected>Seleccione la linea</option>';
foreach ($filas as $fila) {
  $html .= '<option value="'.$fila['id'].'">'.$fila['name_line'].'</option>';
}

echo $html;

 ?>
