<?php
require_once('../../../models/conexion.php');
require_once('../../../models/drivers.php');
require_once('../../../models/cars.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

$consulta = new Drivers();
$consultaVehiculo = new Cars();

$campo = $_GET['campo'];
$item = $_GET['item'];

header('Content-Type: application/vdn.ms-excel');
header('Content-Disposition: attachment; filename=reporte-conductores.xls');

$excel = new PHPExcel();
$excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
$excel->setActiveSheetIndex(0);
$pagina = $excel->getActiveSheet();
$pagina->setTitle('Conductores');
$filas = $consulta->reporteExcelBusqueda($campo, $item);

//cabeceras
$pagina->setCellValue('A1', 'ID');
$pagina->setCellValue('B1', 'NOMBRE');
$pagina->setCellValue('C1', 'APELLIDO');
$pagina->setCellValue('D1', 'CEDULA');
$pagina->setCellValue('E1', 'CELULAR');
$pagina->setCellValue('F1', 'TELEFONO');
$pagina->setCellValue('G1', 'EMAIL');
$pagina->setCellValue('H1', 'DIRECCION');
$pagina->setCellValue('I1', 'FECHA CREACION');
$pagina->setCellValue('J1', 'ESTADO');
$pagina->setCellValue('K1', 'PLACA');


//negrita y tamaño
$pagina->getStyle('A1:K1')->getFont()->setBold(true);
$pagina->getStyle('A1:K1')->getFont()->setSize(12);

for ($i=0; $i < count($filas); $i++) {
  $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
  $pagina->setCellValue('B'.($i+2), $filas[$i]['name']);
  $pagina->setCellValue('C'.($i+2), $filas[$i]['lastname']);
  $pagina->setCellValue('D'.($i+2), $filas[$i]['cedula']);
  $pagina->setCellValue('E'.($i+2), $filas[$i]['cellphone']);
  $pagina->setCellValue('F'.($i+2), $filas[$i]['telephone']);
  $pagina->setCellValue('G'.($i+2), $filas[$i]['email']);
  $pagina->setCellValue('H'.($i+2), $filas[$i]['dir']);
  $pagina->setCellValue('I'.($i+2), $filas[$i]['created_at']);
  $pagina->setCellValue('J'.($i+2), $filas[$i]['status']);
  $pagina->setCellValue('K'.($i+2), $filas[$i]['placa']);
}

//Tamaño de las celdas
foreach (range('A', 'K') as $column) {
  $pagina->getColumnDimension($column)->setAutoSize(true);
}

//Descargar excel
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');

 ?>
