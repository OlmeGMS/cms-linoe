<?php
require_once('../../models/conexion.php');
require_once('../../models/barrio.php');
require_once('../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

$nombreArchivo = '../../views/dis/documents/barrios.xlsx';

$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
$objPHPExcel->setActiveSheetIndex(0);
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

$consulta = new Barrio();

for ($i=0; $i < $filas; $i++) {
  $barrio = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
  $mensaje = $consulta->agregarbarrio($barrio);
}

echo "$mensaje";




 ?>
