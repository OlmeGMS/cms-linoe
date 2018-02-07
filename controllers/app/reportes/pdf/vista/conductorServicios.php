<?php
require_once('../../../../../models/conexion.php');
require_once('../../../../../models/users.php');
require_once('../../../../../models/usersDirs.php');
require_once('../../../../../models/drivers.php');
require_once('../../../../../models/cars.php');
require_once('../../../../../models/services.php');

$consulta = new Services();
$consultaConductor = new Drivers();
$consultaCarro = new Cars();
$consultaUsuario = new Users();

$cedula = $_GET['cedulaConductor'];
$ts = $_GET['filtroConductor'];
$fecha1 = $_GET['fecha1Conductor'];
$fecha2 = $_GET['fecha2Conductor'];


$idConductor = $consultaConductor->obtenerIdConductorCedula($cedula);
$filas = $consulta->reporteServicioConductor($idConductor, $fecha1, $fecha2);

?>
<!DOCTYPE html>
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
      <h2>USUARIOS CMS</h2>
    </div>
    <table id="table-usuarios" class="table table-bordered table-striped table-vcenter">
        <thead>
            <tr>
                <th class="text-center" style="width: 100px;">ID</th>
                <th class="text-center">Solicitante</th>
                <th class="text-center">Nombre Conductor</th>
                <th class="text-center">Apellido Conductor</th>
                <th class="text-center">Placa</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Barrio</th>
                <th class="text-center">Destino</th>
                <th class="text-center">T. Pago</th>
                <th class="text-center">Nº Vale</th>
                <th class="text-center">Unidades</th>
                <th class="text-center">Aeropuerto</th>
                <th class="text-center">Nocturno</th>
                <th class="text-center">Mensajeria</th>
                <th class="text-center">Puerta a Puerta</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Fecha Inicio</th>
                <th class="text-center">Fecha Final</th>
                <th class="text-center">Calificación</th>
            </tr>
        </thead>
        <tbody>
          <?php
          foreach($filas as $fila){
            echo '
            <tr>
                <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
                <td id="" name ="" class="text-center">'.$fila['user_name'].'</td>
                <td id="" name ="" class="text-center">'.$fila['name'].'</td>
                <td id="" name ="" class="text-center">'.$fila['lastname'].'</td>
                <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
                <td id="" name ="" class="text-center">'.$fila['address'].'</td>
                <td id="" name ="" class="text-center">'.$fila['barrio'].'</td>
                <td id="" name ="" class="text-center">'.$fila['destination'].'</td>
                <td id="" name ="" class="text-center">'.$fila['pay_reference'].'</td>
                <td id="" name ="" class="text-center">'.$fila['user_card_reference'].'</td>
                <td id="" name ="" class="text-center">'.$fila['units'].'</td>
                <td id="" name ="" class="text-center">'.$fila['charge1'].'</td>
                <td id="" name ="" class="text-center">'.$fila['charge2'].'</td>
                <td id="" name ="" class="text-center">'.$fila['charge3'].'</td>
                <td id="" name ="" class="text-center">'.$fila['charge4'].'</td>
                <td id="" name ="" class="text-center">'.$fila['value'].'</td>
                <td id="" name ="" class="text-center">'.$fila['created_at'].'</td>
                <td id="" name ="" class="text-center">'.$fila['updated_at'].'</td>
                <td id="" name ="" class="text-center">'.$fila['qualification'].'</td>
             </tr>';
          }
          ?>
        </tbody>
      </table>
  </body>
</html>
