<?php

function tablaReportesSecretaria($arg_empresa){

  $consulta = new SecretaryReports();
  $idEmpresa = $arg_empresa;
  $filas = $consulta->listaReportes($idEmpresa);
  foreach ($filas as $fila) {
    $nombre = $fila['name_report'];
    $fecha = $fila['fecha'];
    $color = rand (1,3);
    switch ($color) {
      case '1':
        $file = "success";
        break;
        case '2':
          $file = "info";
          break;
          case '3':
            $file = "danger";
            break;

      default:
        # code...
        break;
    }
    echo '
    <div class="col-sm-6 col-lg-4">
        <div class="media-items animation-fadeInQuickInv" data-category="music">
            <a href="../reportes/'.$nombre.'.csv" download="Reporte'.$fecha.'">
            <div class="media-items-content">
                <i class="fi fi-csv fa-5x text-'.$file.'"></i>
            </div>
            <h4>
                <strong>'.$nombre.'</strong>.csv<br>
                <small>'.$fecha.'</small>
            </h4>
            </a>
        </div>
    </div>

    ';
  }


}

 ?>
