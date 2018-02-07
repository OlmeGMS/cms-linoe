<?php
require_once('../../../../vendor/vendor/autoload.php');
require_once('../../../../models/conexion.php');
require_once('../../../../models/users.php');
require_once('../../../../models/usersDirs.php');
require_once('../../../../models/drivers.php');
require_once('../../../../models/cars.php');
require_once('../../../../models/services.php');

$consulta = new Services();
$consultaConductor = new Drivers();
$consultaCarro = new Cars();
$consultaUsuario = new Users();

$cedula = $_GET['cedulas'];
$ts = $_GET['servicio'];
$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];
$idConductor = $consultaConductor->obtenerIdConductorCedula($cedula);
if($ts == 0){
  $filas = $consulta->reporteServicioConductor($idConductor, $fecha1, $fecha2);
}else{
  $filas = $consulta->reporteServicioConductorTS($idConductor, $ts, $fecha1, $fecha2);
}




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
                  <th class="text-center" style="width: 10px;">ID</th>
                  <th class="text-center">Solicitante</th>
                  <th class="text-center">Conductor</th>
                  <th class="text-center">Placa</th>
                  <th class="text-center">Dirección</th>
                  <th class="text-center">Barrio</th>
                  <th class="text-center">Destino</th>
                  <th class="text-center">T. Pago</th>
                  <th class="text-center">Nº Vale</th>
                  <th class="text-center">Unidades</th>
                  <th class="text-center">Valor</th>
                  <th class="text-center">Fecha Inicio</th>
                  <th class="text-center">Fecha Final</th>
                  <th class="text-center">Calificación</th>
              </tr>
          </thead>
          <tbody>';
            foreach($filas as $fila){
              $id = $fila['id'];
              $solicitante =$fila['user_name'];
              $nombre = $fila['name'];
              $apellido = $fila['lastname'];
              $cond = "$nombre $apellido";
              $placa = $fila['placa'];
              $direccion = $fila['address'];
              $barrio = $fila['barrio'];
              $destino = $fila['destination'];
              $pago = $fila['pay_reference'];
              $nVale = $fila['user_card_reference'];
              $unidades = $fila['units'];
              $aero = $fila['charge1'];
              $nocturno = $fila['charge2'];
              $mensajeria = $fila['charge3'];
              $puerta = $fila['charge4'];
              $valor = $fila['value'];
              $fecha_inicio = $fila['created_at'];
              $fecha_final = $fila['updated_at'];
              $calificacion = $fila['qualification'];

              $html.='<tr>
                    <td id="id_usuario" name ="" class="text-center">'.$id.'</td>
                    <td id="" name ="" class="text-center">'.$solicitante.'</td>
                    <td id="" name ="" class="text-center">'.$cond.'</td>
                    <td id="" name ="" class="text-center">'.$placa.'</td>
                    <td id="" name ="" class="text-center">'.$direccion.'</td>
                    <td id="" name ="" class="text-center">'.$barrio.'</td>
                    <td id="" name ="" class="text-center">'.$destino.'</td>
                    <td id="" name ="" class="text-center">'.$pago.'</td>
                    <td id="" name ="" class="text-center">'.$nVale.'</td>
                    <td id="" name ="" class="text-center">'.$unidades.'</td>
                    <td id="" name ="" class="text-center">'.$valor.'</td>
                    <td id="" name ="" class="text-center">'.$fecha_inicio.'</td>
                    <td id="" name ="" class="text-center">'.$fecha_final.'</td>
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
$html2Pdf->output('usuarios-conductor.pdf');

?>
