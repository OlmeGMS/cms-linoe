<?php
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../models/company.php');

$idEmpresa = $_POST['id'];

$consultaEmpresa = new Company();

$idCiudad = $consultaEmpresa->obtenerciudadEmpresa($idEmpresa);

if ($idCiudad == 1) {
  echo '
  <label class="col-md-4 control-label" for="">Factor de calidad<span class="text-danger">*</span></label>
  <div class="col-md-6">
    <label class="switch switch-danger"><input type="checkbox" name="factor" value="factor"><span></span></input></label>
  </div>
  ';
}else {
  echo '
      <input type="hidden" id="factor" name="factor" class="form-control" value="false" >
  ';
}


 ?>
