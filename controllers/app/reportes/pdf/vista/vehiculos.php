<?php
require_once('../../../../models/conexion.php');
require_once('../../../../models/cars.php');
$consulta = new Cars();
$filas = $consulta->todosVehiculos();
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
              <th class="text-center">Placa</th>
              <th class="text-center">Móvil</th>
              <th class="text-center">Marca</th>
              <th class="text-center">Línea</th>
              <th class="text-center">Modelo</th>
              <th class="text-center">Empresa</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($filas as $fila){
            echo '
            <tr>
                <td id="" name ="" class="text-center">'.$fila['id'].'</td>
                <td id="" name ="" class="text-center">'.$fila['placa'].'</td>
                <td id="" name ="" class="text-center">'.$fila['movil'].'</td>
                <td id="" name ="" class="text-center">'.$fila['car_brand'].'</td>
                <td id="" name ="" class="text-center">'.$fila['model'].'</td>
                <td id="" name ="" class="text-center">'.$fila['year'].'</td>
                <td id="" name ="" class="text-center">'.$fila['empresa'].'</td>
            </tr>';
          }
          ?>
        </tbody>
      </table>
  </body>
</html>
