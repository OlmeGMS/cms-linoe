<?php
require_once('../../models/conexion.php');
require_once('../../models/cmsCities.php');
require_once('../../util/nocsrf.php');

$consulta = new CmsCities();
$nombre = htmlspecialchars(strtoupper($_POST['nombre']), ENT_QUOTES,'UTF-8');
$estado = 1;
$pais = $_POST['pais'];
$departamento = $_POST['departamento'];
$direccion = "$nombre, $pais";

$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($direccion).'&sensor=false');
// Convertir el JSON en array.
$geo = json_decode($geo, true);

// Si todo esta bien
if ($geo['status'] = 'OK') {
	// Obtener los valores
	$latitud = $geo['results'][0]['geometry']['location']['lat'];
	$longitud = $geo['results'][0]['geometry']['location']['lng'];
}

if (isset($_POST['_token'])){
  $filtro = $consulta->filtroCiudad($nombre);
  if ($filtro != NULL || $filtro != 0) {
    header("Location: ../../views/mensajes/error_existe?ref=ciudad");
  }else{
    if ($latitud != NULL && $longitud != NULL) {
          $mensaje = $consulta->agregarCiudad($nombre, $pais, $departamento, $latitud, $longitud, $estado);
          if ($mensaje == FALSE) {
            header("Location: ../../views/mensajes/error");
          }else {
            header("Location: ../../views/mensajes/registro_exitoso");

        }
    }else {
      header("Location: ../../views/mensajes/error");
    }

  }
}
 ?>
