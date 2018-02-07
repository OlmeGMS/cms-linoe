<?php

function notificacion($mensaje, $tipo){
  $js = '<script type="text/javascript">
    Push.create("TaxisYa",{
      body: "'.$mensaje.'",
      icon: "../dis/img/icon57.png",
      timeout: 7000,
    });
  </script>';

  return $js;
}

if(isset($_POST['mensaje']) && isset($_POST['tipo_usuario'])){
  print notificacion($_POST['mensaje'], $_POST['tipo_usuario']);
}
 ?>
