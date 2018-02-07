<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/drivers.php');
require_once('../../models/cars.php');
require_once('../../models/services.php');
require_once('../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

header('Content-Type: application/vdn.ms-excel');
header('Content-Disposition: attachment; filename=reporte-servicios.xls');

//$fecha1 = $_POST[''];
//$fecha2 = $_POST[''];
$fecha1 = '2017-09-21';
$fecha2 = '2017-11-14';


$excel = new PHPExcel();
$excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
$excel->setActiveSheetIndex(0);
$pagina = $excel->getActiveSheet();
$pagina->setTitle('Servicios');

$consulta = new Services();
$consultaConductor = new Drivers();
$consultaCarro = new Cars();

$filas = $consulta->reporteSercioTodo($fecha1, $fecha2);

//cabeceras
$pagina->setCellValue('A1','ID');
$pagina->setCellValue('B1','USUARIO');
$pagina->setCellValue('C1','COND NOMBRE');
$pagina->setCellValue('D1','COND APELLIDO');
$pagina->setCellValue('E1','VEHICULO');
$pagina->setCellValue('F1','DIRECCION');
$pagina->setCellValue('G1','BARRIO');
$pagina->setCellValue('H1','DESTINO');
$pagina->setCellValue('I1','T. PAGO');
$pagina->setCellValue('J1','Nº VALE');
$pagina->setCellValue('K1','UNIDADES');
$pagina->setCellValue('L1','AEROPUETO');
$pagina->setCellValue('M1','NOCTURNO');
$pagina->setCellValue('N1','MENSAJERIA');
$pagina->setCellValue('O1','PUERTA A PUERTA');
$pagina->setCellValue('P1','VALOR');
$pagina->setCellValue('Q1','F. INICIO');
$pagina->setCellValue('R1','F. FINAL');
$pagina->setCellValue('S1','CALIFICACION');

//negrita y tamaño
$pagina->getStyle('A1:R1')->getFont()->setBold(true);
$pagina->getStyle('A1:R1')->getFont()->setSize(12);



for ($i=0; $i < count($filas) ; $i++) {
  $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
  $pagina->setCellValue('B'.($i+2), $filas[$i]['user_name']);
  $pagina->setCellValue('C'.($i+2), $filas[$i]['name']);
  $pagina->setCellValue('D'.($i+2), $filas[$i]['lastname']);
  $pagina->setCellValue('E'.($i+2), $filas[$i]['placa']);
  $pagina->setCellValue('F'.($i+2), $filas[$i]['address']);
  $pagina->setCellValue('G'.($i+2), $filas[$i]['barrio']);
  $pagina->setCellValue('H'.($i+2), $filas[$i]['destination']);
  $pagina->setCellValue('I'.($i+2), $filas[$i]['pay_reference']);
  $pagina->setCellValue('J'.($i+2), $filas[$i]['user_card_reference']);
  $pagina->setCellValue('K'.($i+2), $filas[$i]['units']);
  $pagina->setCellValue('L'.($i+2), $filas[$i]['charge1']);
  $pagina->setCellValue('M'.($i+2), $filas[$i]['charge2']);
  $pagina->setCellValue('N'.($i+2), $filas[$i]['charge3']);
  $pagina->setCellValue('O'.($i+2), $filas[$i]['charge4']);
  $pagina->setCellValue('P'.($i+2), $filas[$i]['value']);
  $pagina->setCellValue('Q'.($i+2), $filas[$i]['created_at']);
  $pagina->setCellValue('R'.($i+2), $filas[$i]['updated_at']);
  $pagina->setCellValue('S'.($i+2), $filas[$i]['qualification']);
}

//Tamaño de las celdas
foreach (range('A', 'Q') as $column) {
  $pagina->getColumnDimension($column)->setAutoSize(true);
}

//Descargar excel
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');




?>
