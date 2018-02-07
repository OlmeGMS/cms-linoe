<?php
require_once('../../../models/conexion.php');
require_once('../../../models/cars.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

$consulta = new Cars();
header('Content-Type: application/vdn.ms-excel');
header('Content-Disposition: attachment; filename=reporte-vehiculos.xls');

$excel = new PHPExcel();
$excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
$excel->setActiveSheetIndex(0);
$pagina = $excel->getActiveSheet();
$pagina->setTitle('Vehiculos');
$filas = $consulta->todosVehiculos();

//cabeceras
$pagina->setCellValue('A1', 'ID');
$pagina->setCellValue('B1', 'PLACA');
$pagina->setCellValue('C1', 'MARCA');
$pagina->setCellValue('D1', 'LINEA');
$pagina->setCellValue('E1', 'EMPRESA');
$pagina->setCellValue('F1', 'MODELO');

//negrita y tamaño
$pagina->getStyle('A1:F1')->getFont()->setBold(true);
$pagina->getStyle('A1:F1')->getFont()->setSize(12);

for ($i=0; $i < count($filas); $i++) {
  $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
  $pagina->setCellValue('B'.($i+2), $filas[$i]['placa']);
  $pagina->setCellValue('C'.($i+2), $filas[$i]['car_brand']);
  $pagina->setCellValue('D'.($i+2), $filas[$i]['model']);
  $pagina->setCellValue('E'.($i+2), $filas[$i]['empresa']);
  $pagina->setCellValue('F'.($i+2), $filas[$i]['year']);
}

//Tamaño de las celdas
foreach (range('A', 'F') as $column) {
  $pagina->getColumnDimension($column)->setAutoSize(true);
}

//Descargar excel
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');

 ?>
