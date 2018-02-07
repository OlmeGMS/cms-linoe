<?php
require_once('../../../vendor/dompdf/dompdf_config.inc.php');
require_once('../../../models/conexion.php');
require_once('../../../models/services.php');
require_once('../../../facades/vales/facade_service.php');

session_start();
$idCc = $_SESSION['idCc'];
$mes = $_GET['idmes'];
$idCompania = $_SESSION['idCompania'];
            $codigoHTML='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Reporte</title>
            </head>
            <body>
            <table width="80%" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="14" bgcolor="skyblue"><CENTER><strong>REPORTE DE LA TABLA VALES</strong></CENTER></td>
              </tr>
              <tr>
              <th class="text-center">Vale</th>
              <th class="text-center">Fecha inicio</th>
              <th class="text-center">Fecha fin</th>
              <th class="text-center">Usuario</th>
              <th class="text-center">Placa</th>
              <th class="text-center">Dirección</th>
              <th class="text-center">Barrio</th>
              <th class="text-center">Unt</th>
              <th class="text-center">Aer</th>
              <th class="text-center">Noct</th>
              <th class="text-center">PP</th>
              <th class="text-center">Valor</th>
              <th class="text-center">Motivo</th>
              <th class="text-center">Destino</th>
              </tr>';
            $consulta = new Services();
            $prefijo = $consulta->prefijo($idCc);
            $filas = $consulta->todosServiciosAdministradorMes($idCompania, $mes);

            foreach ($filas as $fila) {
              $dato1 = $fila['index_id'];
              $dato2 = $fila['comp1'];
              $dato3 = $fila['comp2'];
              $dato4 = $fila['no'];
              $dato5 = $fila['obs'];

              $direccion = $dato1.$dato2.' #'.$dato3.' - '.$dato4.' '.$dato5;
              $codigoHTML.='<tr>
              <td id="" name ="" class="text-center">'.$fila['ticket'].'</td>
              <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
              <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
              <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
              <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
              <td id="" name ="" class="text-center">'.$direccion.'</td>
              <td id="" name ="" class="text-center">'.$fila['barrio'].'</td>
              <td id="" name ="" class="text-center">'.$fila['units'].'</td>
              <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
              <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
              <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
              <td id="" name ="" class="text-center">'.$fila['value'].'</td>
              <td id="" name ="" class="text-center">'.$fila['commit'].'</td>
              <td id="" name ="" class="text-center">'.$fila['destination'].'</td>
               </tr>';
            }
            $codigoHTML.='
            </table>
            </body>
            </html>';

          $codigoHTML=utf8_encode($codigoHTML);
          $dompdf= new DOMPDF();
          $dompdf->load_html($codigoHTML);
          ini_set("memory_limit","150M");
          //$dompdf->set_paper('A4', 'landscape');
          $dompdf->render();
          //$pdf = $dompdf->output();
          $dompdf->stream("Reporte.pdf");


 ?>
