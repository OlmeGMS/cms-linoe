<?php
require_once('../../../../models/conexion.php');
require_once('../../../../models/cmsUsers.php');
$consulta = new CmsUsers();
$filas = $consulta->todosUsuariosApp();
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
                <th class="text-center">Nombre</th>
                <th class="text-center">Email</th>
                <th class="text-center">Cedula</th>
                <th class="text-center">Rol</th>
            </tr>
        </thead>
        <tbody>
          <?php
          foreach($filas as $fila){
            $id = $fila['id'];
            $nombre = $fila['name'];
            $email = $fila['email'];
            $cedula = $fila['cedula'];
            $rolUsuario = $fila['role_id'];

            $html.='<tr>
                  <td id="id_usuario" name ="" class="text-center">'.$id.'</td>
                  <td id="" name ="" class="text-center">'.$nombre.'</td>
                  <td id="" name ="" class="text-center">'.$email.'</td>
                  <td id="" name ="" class="text-center">'.$cedula.'</td>
                  <td id="" name ="" class="text-center">'.$rolUsuario.'</td>
               </tr>';

          }
           ?>
        </tbody>
      </table>
  </body>
</html>
