<?php
require_once('../../../models/conexion.php');
require_once('../../../models/users.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

$item = $_GET['item'];
$frase = $_GET['frase'];
$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];
$consulta = new Users();
header('Content-Type: application/vdn.ms-excel');
header('Content-Disposition: attachment; filename=reporte-usuarios-aplicacion.xls');

$excel = new PHPExcel();
$excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
$excel->setActiveSheetIndex(0);
$pagina = $excel->getActiveSheet();
$pagina->setTitle('Usuarios-Aplicacion');
$filas = $consulta->busquedaXFecha($item, $frase, $fecha1, $fecha2);

//cabeceras
$pagina->setCellValue('A1', 'ID');
$pagina->setCellValue('B1', 'NOMBRE');
$pagina->setCellValue('C1', 'EMAIL');
$pagina->setCellValue('D1', 'FECHA MODIFICACION');
$pagina->setCellValue('E1', 'FECHA CREACION');


//negrita y tamaño
$pagina->getStyle('A1:F1')->getFont()->setBold(true);
$pagina->getStyle('A1:F1')->getFont()->setSize(12);

for ($i=0; $i < count($filas); $i++) {
  $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
  $pagina->setCellValue('B'.($i+2), $filas[$i]['name']);
  $pagina->setCellValue('C'.($i+2), $filas[$i]['email']);
  $pagina->setCellValue('D'.($i+2), $filas[$i]['updated_at']);
  $pagina->setCellValue('E'.($i+2), $filas[$i]['created_at']);

}

//Tamaño de las celdas
foreach (range('A', 'E') as $column) {
  $pagina->getColumnDimension($column)->setAutoSize(true);
}

//Descargar excel
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');

?>
