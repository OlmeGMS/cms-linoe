<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/drivers.php');
require_once('../../models/cars.php');
require_once('../../models/services.php');
require_once('../../vendor/PHPExcel/Classes/PHPExcel.php');
require_once('../../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php');

//header('Content-Type: application/vdn.ms-excel');
//header('Content-Disposition: attachment; filename=reporte-servicios.xls');

$form = $_POST['form-services'];
$consulta = new Services();
$consultaConductor = new Drivers();
$consultaCarro = new Cars();
$consultaUsuario = new Users();

switch ($form) {
  case '1':
      $filtro = NULL;
      if (!empty($_POST['filtro'])) {
        $filtro = $_POST['filtro'];
      }

      $fecha1 = $_POST['fecha1'];
      $fecha2 = $_POST['fecha2'];

      $filas = $consulta->reporteSercioTodo($fecha1, $fecha2);

    

      if ($filtro == 1) {
      header('Content-Type: application/vdn.ms-excel');
      header('Content-Disposition: attachment; filename=reporte-servicios.xls');
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
        $pagina->getStyle('A1:S1')->getFont()->setBold(true);
        $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
        foreach (range('A', 'S') as $column) {
          $pagina->getColumnDimension($column)->setAutoSize(true);
        }

        //Descargar excel
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $objWriter->save('php://output');

      }else {
        header('Content-Type: application/vdn.ms-excel');
        header('Content-Disposition: attachment; filename=reporte-servicios.xls');
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
        $excel->setActiveSheetIndex(0);
        $pagina = $excel->getActiveSheet();
        $pagina->setTitle('Servicios');

        $consulta = new Services();
        $consultaConductor = new Drivers();
        $consultaCarro = new Cars();

        $filas = $consulta->reporteServicioTodoTodo($fecha1, $fecha2);

        //cabeceras
        $pagina->setCellValue('A1','ID');
        $pagina->setCellValue('B1','ID USUARIO');
        $pagina->setCellValue('C1','SOLICITANTE');
        $pagina->setCellValue('D1','ID CONDUCTOR');
        $pagina->setCellValue('E1','ID VEHICULO');
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
        $pagina->getStyle('A1:S1')->getFont()->setBold(true);
        $pagina->getStyle('A1:S1')->getFont()->setSize(12);



        for ($i=0; $i < count($filas) ; $i++) {
          $pagina->setCellValue('A'.($i+2), $filas[$i]['id']);
          $pagina->setCellValue('B'.($i+2), $filas[$i]['user_id']);
          $pagina->setCellValue('C'.($i+2), $filas[$i]['user_name']);
          $pagina->setCellValue('D'.($i+2), $filas[$i]['driver_id']);
          $pagina->setCellValue('E'.($i+2), $filas[$i]['car_id']);
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
        foreach (range('A', 'S') as $column) {
          $pagina->getColumnDimension($column)->setAutoSize(true);
        }

        //Descargar excel
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $objWriter->save('php://output');
      }
    break;
    case '2':
      $cedula = $_POST['cedulaConductor'];
      $tipo = $_POST['filtroConductor'];
      $fecha1 = $_POST['fecha1Conductor'];
      $fecha2 = $_POST['fecha2Conductor'];
      $consultaConductor = new Drivers();
      $consulta = new Services();
      $idConductor = $consultaConductor->obtenerIdConductorCedula($cedula);
      if ($idConductor != NULL) {
        if ($tipo == 0) {

          header('Content-Type: application/vdn.ms-excel');
          header('Content-Disposition: attachment; filename=reporte-servicios.xls');
          $excel = new PHPExcel();
          $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
          $excel->setActiveSheetIndex(0);
          $pagina = $excel->getActiveSheet();
          $pagina->setTitle('Servicios');

          $consulta = new Services();
          $consultaConductor = new Drivers();
          $consultaCarro = new Cars();

          $filas = $consulta->reporteServicioConductor($idConductor, $fecha1, $fecha2);

          //cabeceras
          $pagina->setCellValue('A1','ID');
          $pagina->setCellValue('B1','SOLICITANTE');
          $pagina->setCellValue('C1','NOMBRE CONDUCTOR');
          $pagina->setCellValue('D1','APELLIDO CONDUCTOR');
          $pagina->setCellValue('E1','PLACA');
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
          $pagina->getStyle('A1:S1')->getFont()->setBold(true);
          $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
          foreach (range('A', 'S') as $column) {
            $pagina->getColumnDimension($column)->setAutoSize(true);
          }

          //Descargar excel
          $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
          $objWriter->save('php://output');
        }else {

          $filas = $consulta->reporteServicioConductorTS($idConductor, $tipo, $fecha1, $fecha2);
          if ($filas == NULL) {
            header('Location: ../../views/mensajes/sin_registros?obj=conductor');
          }else{
            header('Content-Type: application/vdn.ms-excel');
            header('Content-Disposition: attachment; filename=reporte-servicios.xls');
            $excel = new PHPExcel();
            $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
            $excel->setActiveSheetIndex(0);
            $pagina = $excel->getActiveSheet();
            $pagina->setTitle('Servicios');


            //cabeceras
            $pagina->setCellValue('A1','ID');
            $pagina->setCellValue('B1','SOLICITANTE');
            $pagina->setCellValue('C1','NOMBRE CONDUCTOR');
            $pagina->setCellValue('D1','APELLIDO CONDUCTOR');
            $pagina->setCellValue('E1','PLACA');
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
            $pagina->getStyle('A1:S1')->getFont()->setBold(true);
            $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
            foreach (range('A', 'S') as $column) {
              $pagina->getColumnDimension($column)->setAutoSize(true);
            }

            //Descargar excel
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            $objWriter->save('php://output');
          }

        }
      }else {
        header('Location: ../../views/mensajes/error_reporte?obj=conductor');
      }

      break;
      case '3':
        $tipo = NULL;
        $placa = strtoupper($_POST['placa']);
        if (!empty($_POST['filtroCarro']) ) {
          $tipo = $_POST['filtroCarro'];
        }
        //$tipo = $_POST['filtro'];
        $fecha1 = $_POST['fecha1Carro'];
        $fecha2 = $_POST['fecha2Carro'];

        $idCarro = $consultaCarro->obtenerIdVehiculo($placa);



        if ($idCarro == NULL) {
          header('Location: ../../views/mensajes/error_reporte?obj=vehiculo');
        }else{

          if ($tipo == 0 || $tipo == NULL) {
              $filas = $consulta->reporteVehiculo($idCarro, $fecha1, $fecha2);

              if ($filas == NULL) {
                header('Location: ../../views/mensajes/sin_registros?obj=vehiculo');
              }else{
                header('Content-Type: application/vdn.ms-excel');
                header('Content-Disposition: attachment; filename=reporte-servicios.xls');
                $excel = new PHPExcel();
                $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
                $excel->setActiveSheetIndex(0);
                $pagina = $excel->getActiveSheet();
                $pagina->setTitle('Servicios');

                //cabeceras
                $pagina->setCellValue('A1','ID');
                $pagina->setCellValue('B1','SOLICITANTE');
                $pagina->setCellValue('C1','NOMBRE CONDUCTOR');
                $pagina->setCellValue('D1','APELLIDO CONDUCTOR');
                $pagina->setCellValue('E1','PLACA');
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
                $pagina->getStyle('A1:S1')->getFont()->setBold(true);
                $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
                foreach (range('A', 'S') as $column) {
                  $pagina->getColumnDimension($column)->setAutoSize(true);
                }

                //Descargar excel
                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
                $objWriter->save('php://output');

            }
          }else{

            $filas = $consulta->reporteServicioVehiculoTS($idCarro, $tipo, $fecha1, $fecha2);
            if ($filas == NULL) {
              header('Location: ../../views/mensajes/sin_registros?obj=vehiculo');
            }else {
              header('Content-Type: application/vdn.ms-excel');
              header('Content-Disposition: attachment; filename=reporte-servicios.xls');
              $excel = new PHPExcel();
              $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
              $excel->setActiveSheetIndex(0);
              $pagina = $excel->getActiveSheet();
              $pagina->setTitle('Servicios');

              //cabeceras
              $pagina->setCellValue('A1','ID');
              $pagina->setCellValue('B1','SOLICITANTE');
              $pagina->setCellValue('C1','NOMBRE CONDUCTOR');
              $pagina->setCellValue('D1','APELLIDO CONDUCTOR');
              $pagina->setCellValue('E1','PLACA');
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
              $pagina->getStyle('A1:S1')->getFont()->setBold(true);
              $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
              foreach (range('A', 'S') as $column) {
                $pagina->getColumnDimension($column)->setAutoSize(true);
              }

              //Descargar excel
              $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
              $objWriter->save('php://output');
            }

          }
        }

        break;
        case '4':
          $tipo = NULL;
          $telefono = $_POST['telefono'];
          $fecha1 = $_POST['fecha1Usuario'];
          $fecha2 = $_POST['fecha2Usuario'];
          if (!empty($_POST['filtroUsuario'])) {
            $tipo = $_POST['filtroUsuario'];
          }

          $id = $consultaUsuario->obtenerIdUsuararioXEmail($telefono);
          if ($id == NULL) {
            header('Location: ../../views/mensajes/error_reporte?obj=usuario');
          }else {
            if ($tipo == 0 || $tipo == NULL) {
              $filas = $consulta->reporteUsuario($id, $fecha1, $fecha2);
              if ($filas == NULL) {
                header('Location: ../../views/mensajes/sin_registros?obj=usuario');
              }else{
                header('Content-Type: application/vdn.ms-excel');
                header('Content-Disposition: attachment; filename=reporte-servicios.xls');
                $excel = new PHPExcel();
                $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
                $excel->setActiveSheetIndex(0);
                $pagina = $excel->getActiveSheet();
                $pagina->setTitle('Servicios');

                //cabeceras
                $pagina->setCellValue('A1','ID');
                $pagina->setCellValue('B1','SOLICITANTE');
                $pagina->setCellValue('C1','NOMBRE CONDUCTOR');
                $pagina->setCellValue('D1','APELLIDO CONDUCTOR');
                $pagina->setCellValue('E1','PLACA');
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
                $pagina->getStyle('A1:S1')->getFont()->setBold(true);
                $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
                foreach (range('A', 'S') as $column) {
                  $pagina->getColumnDimension($column)->setAutoSize(true);
                }

                //Descargar excel
                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
                $objWriter->save('php://output');
              }

            }else {
              $filas = $consulta->reporteServicioUsuarioTS($id, $tipo, $fecha1, $fecha2);
              if ($filas == NULL) {
                header('Location: ../../views/mensajes/sin_registros?obj=usuario');
              }else {
                header('Content-Type: application/vdn.ms-excel');
                header('Content-Disposition: attachment; filename=reporte-servicios.xls');
                $excel = new PHPExcel();
                $excel->getProperties()->setCreator('Taxisya')->setLastModifiedBy('Taxisya')->setTitle('Reporte');
                $excel->setActiveSheetIndex(0);
                $pagina = $excel->getActiveSheet();
                $pagina->setTitle('Servicios');

                //cabeceras
                $pagina->setCellValue('A1','ID');
                $pagina->setCellValue('B1','SOLICITANTE');
                $pagina->setCellValue('C1','NOMBRE CONDUCTOR');
                $pagina->setCellValue('D1','APELLIDO CONDUCTOR');
                $pagina->setCellValue('E1','PLACA');
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
                $pagina->getStyle('A1:S1')->getFont()->setBold(true);
                $pagina->getStyle('A1:S1')->getFont()->setSize(12);



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
                foreach (range('A', 'S') as $column) {
                  $pagina->getColumnDimension($column)->setAutoSize(true);
                }

                //Descargar excel
                $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
                $objWriter->save('php://output');
              }
            }
          }


  default:
    # code...
    break;
}

 ?>
