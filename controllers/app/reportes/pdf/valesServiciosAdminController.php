<?php
require_once('../../../../vendor/vendor/autoload.php');
require_once('../../../../models/conexion.php');
require_once('../../../../models/services.php');

$consulta = new Services();


$mes = $_GET['mes'];
$year = $_GET['year'];
$prefijo = $_GET['prefijo'];


$filas = $consulta->todosServiciosMangerMes($prefijo , $mes, $year);



use Spipu\Html2Pdf\Html2Pdf;

if ($filas == null) {
  $html = '<h4>No hay registros</h4>';
}else {
  $html = '<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="utf-8">
      <title>Reporte PDF</title>

      <style media="screen" type="text/css">
      #table-usuarios {
          font-family: "arial", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
      }
      #table-usuarios td, #table-usuarios th {
      border: 1px solid #ddd;
      padding: 8px;
      }
      #table-usuarios tr:nth-child(even){background-color: #f2f2f2;}

      #table-usuarios tr:hover {background-color: #ddd;}

      #table-usuarios th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #043e50; /* verde 4CAF50 */
          color: white;
      }
      th{
        width: auto;
        font-size: 10px;
      }
      td{
        width: auto;
        font-size: 10px;
      }
      #cabeceraId img{
        float: right;
      }
      h1{
        text-align: center;
      }
      </style>
    </head>
    <body>
      <div class="cabecera" id="cabeceraId">
        <img src="../../../../views/dis/img/icon76.png" alt="logo taxisyaApp">
        <h1>TAXISYA</h1>
        <h2>Reporte Conductor</h2>
      </div>
      <table id="table-usuarios" class="table table-bordered table-striped table-vcenter">
          <thead>
              <tr>
                  <th class="text-center" style="width: 10px;">Vales</th>
                  <th class="text-center">F.Inicio</th>
                  <th class="text-center">F.Fin</th>
                  <th class="text-center">Usuario</th>
                  <th class="text-center">Placa</th>
                  <th class="text-center">Dirección</th>
                  <th class="text-center">Unit</th>
                  <th class="text-center">Aero</th>
                  <th class="text-center">Noct</th>
                  <th class="text-center">PP</th>
                  <th class="text-center">Valor</th>
                  <th class="text-center">Motivo</th>
                  <th class="text-center">Destino</th>
                  <th class="text-center">Calificación</th>
              </tr>
          </thead>
          <tbody>';
            foreach($filas as $fila){
              $vale = $fila['ticket'];
              $fInicio = $fila['created_at'];
              $fFinal = $fila['updated_at'];
              $nombreUser = $fila['user_name'];
              $placa = $fila['placa'];
              $direccion = $fila['address'];
              $unidad = $fila['units'];
              $aereo = $fila['charge1'];
              $nocturno = $fila['charge2'];
              $pp = $fila['charge4'];
              $valor = $fila['value'];
              $motivo = $fila['commit'];
              $destino = $fila['destination'];
              $calificacion = $fila['qualification'];

              $html.='<tr>
                    <td id="id_usuario" name ="" class="text-center">'.$vale.'</td>
                    <td id="" name ="" class="text-center">'.$fInicio.'</td>
                    <td id="" name ="" class="text-center">'.$fFinal.'</td>
                    <td id="" name ="" class="text-center">'.$nombreUser.'</td>
                    <td id="" name ="" class="text-center">'.$placa.'</td>
                    <td id="" name ="" class="text-center">'.$direccion.'</td>
                    <td id="" name ="" class="text-center">'.$unidad.'</td>
                    <td id="" name ="" class="text-center">'.$aereo.'</td>
                    <td id="" name ="" class="text-center">'.$nocturno.'</td>
                    <td id="" name ="" class="text-center">'.$pp.'</td>
                    <td id="" name ="" class="text-center">'.$valor.'</td>
                    <td id="" name ="" class="text-center">'.$motivo.'</td>
                    <td id="" name ="" class="text-center">'.$destino.'</td>
                    <td id="" name ="" class="text-center">'.$calificacion.'</td>
                 </tr>';



            }



          $html.='</tbody>
        </table>
    </body>
  </html>';

}



$html2Pdf = new Html2Pdf('L','A4','es','true', 'UTF-8');
$html2Pdf->writeHTML($html);
$html2Pdf->output('usuarios-servicios.pdf');

?>
