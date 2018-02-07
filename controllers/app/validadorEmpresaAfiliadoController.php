<?php
require_once('../../models/conexion.php');

$idCiudad = $_POST['id'];


if ($idCiudad == 1) {
  echo '
  <label class="col-md-4 control-label" for="">Afiliada app TaxisYa<span class="text-danger">*</span></label>
  <div class="col-md-6">
    <label class="switch switch-danger"><input type="checkbox" name="afiliacion" value="afiliacion"><span></span></input></label>
  </div>
  ';
}else {
  echo '

  ';
}

 ?>
