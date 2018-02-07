<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

$consulta = new Services();

$mes = $_GET['mes'];
$year = $_GET['year'];
$empresa = $_GET['empresa'];
$centroCosto = $_GET['cc'];

header('Content-Type: application/vdn.ms-excel');
header('Content-Disposition: attachment; filename=reporte-usuarios-cms.xls');

$excel = new PHPExcel();
$excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
$excel->setActiveSheetIndex(0);
$pagina = $excel->getActiveSheet();
$pagina->setTitle('Servicios-Mes');

$filas = $consulta->ReporteTodosServiciosManagerMesXAnio($empresa, $mes, $year, $centroCosto);

//cabeceras

$pagina->setCellValue('A1', 'VALE');
$pagina->setCellValue('B1', 'FECHA INICIO');
$pagina->setCellValue('C1', 'FECHA FIN');
$pagina->setCellValue('D1', 'USUARIO');
$pagina->setCellValue('E1', 'PLACA');
$pagina->setCellValue('F1', 'DIRECCION');
$pagina->setCellValue('G1', 'UNT');
$pagina->setCellValue('H1', 'AER');
$pagina->setCellValue('I1', 'NOCT');
$pagina->setCellValue('J1', 'PP');
$pagina->setCellValue('K1', 'VALOR');
$pagina->setCellValue('L1', 'MOTIVO');
$pagina->setCellValue('M1', 'DESTINO');
$pagina->setCellValue('N1', 'CALIFICACION');

//negrita y tamaño
$pagina->getStyle('A1:N1')->getFont()->setBold(true);
$pagina->getStyle('A1:N1')->getFont()->setSize(12);

for ($i=0; $i < count($filas); $i++) {
  $pagina->setCellValue('A'.($i+2), $filas[$i]['ticket']);
  $pagina->setCellValue('B'.($i+2), $filas[$i]['created_at']);
  $pagina->setCellValue('C'.($i+2), $filas[$i]['updated_at']);
  $pagina->setCellValue('D'.($i+2), $filas[$i]['user_name']);
  $pagina->setCellValue('E'.($i+2), $filas[$i]['placa']);
  $pagina->setCellValue('F'.($i+2), $filas[$i]['address']);
  $pagina->setCellValue('G'.($i+2), $filas[$i]['units']);
  $pagina->setCellValue('H'.($i+2), $filas[$i]['charge1']);
  $pagina->setCellValue('I'.($i+2), $filas[$i]['charge2']);
  $pagina->setCellValue('J'.($i+2), $filas[$i]['charge4']);
  $pagina->setCellValue('K'.($i+2), $filas[$i]['value']);
  $pagina->setCellValue('L'.($i+2), $filas[$i]['commit']);
  $pagina->setCellValue('M'.($i+2), $filas[$i]['destination']);
  $pagina->setCellValue('N'.($i+2), $filas[$i]['qualification']);

}

//Tamaño de las celdas
foreach (range('A', 'O') as $column) {
  $pagina->getColumnDimension($column)->setAutoSize(true);
}

//Descargar excel
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');




 ?>
