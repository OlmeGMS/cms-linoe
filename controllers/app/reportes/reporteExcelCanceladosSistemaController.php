<?php
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

$consulta = new Services();

$filtro = $_POST['filtro_excel_sistema'];

if (empty($_POST['filtro_excel_sistema'])) {
  $filtro = "0";
}



if($filtro == "1" || $filtro == "0" ){
  header('Content-Type: application/vdn.ms-excel');
  header('Content-Disposition: attachment; filename=reporte-servicios-cancelados-sistema.xls');

  $excel = new PHPExcel();
  $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
  $excel->setActiveSheetIndex(0);
  $pagina = $excel->getActiveSheet();
  $pagina->setTitle('Servicios-cancelados-sistema');
  $filas = $consulta->reporterExcelCanceladoSistema();

  //cabeceras
  $pagina->setCellValue('A1', 'ID');
  $pagina->setCellValue('B1', 'ID USUARIO');
  $pagina->setCellValue('C1', 'USUARIO');
  $pagina->setCellValue('D1', 'NOMBRE CONDUCTOR');
  $pagina->setCellValue('E1', 'APELLIDO CONDUCTOR');
  $pagina->setCellValue('F1', 'PLACA');
  $pagina->setCellValue('G1', 'MARCA');
  $pagina->setCellValue('H1', 'LINEA');
  $pagina->setCellValue('I1', 'FECHA INICIO');
  $pagina->setCellValue('J1', 'FECHA FINAL');
  $pagina->setCellValue('K1', 'ORIGEN');
  $pagina->setCellValue('L1', 'DESTINO');
  $pagina->setCellValue('M1', 'TIPO DE PAGO');
  $pagina->setCellValue('N1', 'Nº VALE');
  $pagina->setCellValue('O1', 'MOTIVO');
  $pagina->setCellValue('P1', 'RECARGO AEROPUERTO');
  $pagina->setCellValue('Q1', 'RECARGO EXPRESO');
  $pagina->setCellValue('R1', 'RECARGO MENSAJERIA');
  $pagina->setCellValue('S1', 'RECARGO PUERTA A PUERTA');
  $pagina->setCellValue('T1', 'VALOR');
  $pagina->setCellValue('U1', 'CALIFICACION');
  $pagina->setCellValue('V1', 'MOTIVO CALIF');

  //negrita y tamaño
  $pagina->getStyle('A1:V1')->getFont()->setBold(true);
  $pagina->getStyle('A1:V1')->getFont()->setSize(12);

  for ($i=0; $i < count($filas); $i++) {
    $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
    $pagina->setCellValue('B'.($i+2), $filas[$i]['idUsuario']);
    $pagina->setCellValue('C'.($i+2), $filas[$i]['user_name']);
    $pagina->setCellValue('D'.($i+2), $filas[$i]['nombreConductor']);
    $pagina->setCellValue('E'.($i+2), $filas[$i]['apellidoConductor']);
    $pagina->setCellValue('F'.($i+2), $filas[$i]['placa']);
    $pagina->setCellValue('G'.($i+2), $filas[$i]['car_brand']);
    $pagina->setCellValue('H'.($i+2), $filas[$i]['model']);
    $pagina->setCellValue('I'.($i+2), $filas[$i]['created_at']);
    $pagina->setCellValue('J'.($i+2), $filas[$i]['updated_at']);
    $pagina->setCellValue('K'.($i+2), $filas[$i]['address']);
    $pagina->setCellValue('L'.($i+2), $filas[$i]['destination']);
    $pagina->setCellValue('M'.($i+2), $filas[$i]['pay_reference']);
    $pagina->setCellValue('N'.($i+2), $filas[$i]['user_card_reference']);
    $pagina->setCellValue('O'.($i+2), $filas[$i]['commit']);
    $pagina->setCellValue('P'.($i+2), $filas[$i]['charge1']);
    $pagina->setCellValue('Q'.($i+2), $filas[$i]['charge2']);
    $pagina->setCellValue('R'.($i+2), $filas[$i]['charge3']);
    $pagina->setCellValue('S'.($i+2), $filas[$i]['charge4']);
    $pagina->setCellValue('T'.($i+2), $filas[$i]['value']);
    $pagina->setCellValue('U'.($i+2), $filas[$i]['qualification']);
    $pagina->setCellValue('V'.($i+2), $filas[$i]['reason_qualification']);

  }

  //Tamaño de las celdas
  foreach (range('A', 'V') as $column) {
    $pagina->getColumnDimension($column)->setAutoSize(true);
  }

  //Descargar excel
  $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
  $objWriter->save('php://output');
}else {
  header('Content-Type: application/vdn.ms-excel');
  header('Content-Disposition: attachment; filename=reporte-servicios-cancelados-sistema.xls');

  $excel = new PHPExcel();
  $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
  $excel->setActiveSheetIndex(0);
  $pagina = $excel->getActiveSheet();
  $pagina->setTitle('Servicios-cancelados-sistema');
  $filas = $consulta->reporterExcelCanceladosSistemaLimit($filtro);

  //cabeceras
  $pagina->setCellValue('A1', 'ID');
  $pagina->setCellValue('B1', 'ID USUARIO');
  $pagina->setCellValue('C1', 'USUARIO');
  $pagina->setCellValue('D1', 'NOMBRE CONDUCTOR');
  $pagina->setCellValue('E1', 'APELLIDO CONDUCTOR');
  $pagina->setCellValue('F1', 'PLACA');
  $pagina->setCellValue('G1', 'MARCA');
  $pagina->setCellValue('H1', 'LINEA');
  $pagina->setCellValue('I1', 'FECHA INICIO');
  $pagina->setCellValue('J1', 'FECHA FINAL');
  $pagina->setCellValue('K1', 'ORIGEN');
  $pagina->setCellValue('L1', 'DESTINO');
  $pagina->setCellValue('M1', 'TIPO DE PAGO');
  $pagina->setCellValue('N1', 'Nº VALE');
  $pagina->setCellValue('O1', 'MOTIVO');
  $pagina->setCellValue('P1', 'RECARGO AEROPUERTO');
  $pagina->setCellValue('Q1', 'RECARGO EXPRESO');
  $pagina->setCellValue('R1', 'RECARGO MENSAJERIA');
  $pagina->setCellValue('S1', 'RECARGO PUERTA A PUERTA');
  $pagina->setCellValue('T1', 'VALOR');
  $pagina->setCellValue('U1', 'CALIFICACION');
  $pagina->setCellValue('V1', 'MOTIVO CALIF');

  //negrita y tamaño
  $pagina->getStyle('A1:V1')->getFont()->setBold(true);
  $pagina->getStyle('A1:V1')->getFont()->setSize(12);

  for ($i=0; $i < count($filas); $i++) {
    $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
    $pagina->setCellValue('B'.($i+2), $filas[$i]['idUsuario']);
    $pagina->setCellValue('C'.($i+2), $filas[$i]['user_name']);
    $pagina->setCellValue('D'.($i+2), $filas[$i]['nombreConductor']);
    $pagina->setCellValue('E'.($i+2), $filas[$i]['apellidoConductor']);
    $pagina->setCellValue('F'.($i+2), $filas[$i]['placa']);
    $pagina->setCellValue('G'.($i+2), $filas[$i]['car_brand']);
    $pagina->setCellValue('H'.($i+2), $filas[$i]['model']);
    $pagina->setCellValue('I'.($i+2), $filas[$i]['created_at']);
    $pagina->setCellValue('J'.($i+2), $filas[$i]['updated_at']);
    $pagina->setCellValue('K'.($i+2), $filas[$i]['address']);
    $pagina->setCellValue('L'.($i+2), $filas[$i]['destination']);
    $pagina->setCellValue('M'.($i+2), $filas[$i]['pay_reference']);
    $pagina->setCellValue('N'.($i+2), $filas[$i]['user_card_reference']);
    $pagina->setCellValue('O'.($i+2), $filas[$i]['commit']);
    $pagina->setCellValue('P'.($i+2), $filas[$i]['charge1']);
    $pagina->setCellValue('Q'.($i+2), $filas[$i]['charge2']);
    $pagina->setCellValue('R'.($i+2), $filas[$i]['charge3']);
    $pagina->setCellValue('S'.($i+2), $filas[$i]['charge4']);
    $pagina->setCellValue('T'.($i+2), $filas[$i]['value']);
    $pagina->setCellValue('U'.($i+2), $filas[$i]['qualification']);
    $pagina->setCellValue('V'.($i+2), $filas[$i]['reason_qualification']);

  }

  //Tamaño de las celdas
  foreach (range('A', 'V') as $column) {
    $pagina->getColumnDimension($column)->setAutoSize(true);
  }

  //Descargar excel
  $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
  $objWriter->save('php://output');

}






 ?>
