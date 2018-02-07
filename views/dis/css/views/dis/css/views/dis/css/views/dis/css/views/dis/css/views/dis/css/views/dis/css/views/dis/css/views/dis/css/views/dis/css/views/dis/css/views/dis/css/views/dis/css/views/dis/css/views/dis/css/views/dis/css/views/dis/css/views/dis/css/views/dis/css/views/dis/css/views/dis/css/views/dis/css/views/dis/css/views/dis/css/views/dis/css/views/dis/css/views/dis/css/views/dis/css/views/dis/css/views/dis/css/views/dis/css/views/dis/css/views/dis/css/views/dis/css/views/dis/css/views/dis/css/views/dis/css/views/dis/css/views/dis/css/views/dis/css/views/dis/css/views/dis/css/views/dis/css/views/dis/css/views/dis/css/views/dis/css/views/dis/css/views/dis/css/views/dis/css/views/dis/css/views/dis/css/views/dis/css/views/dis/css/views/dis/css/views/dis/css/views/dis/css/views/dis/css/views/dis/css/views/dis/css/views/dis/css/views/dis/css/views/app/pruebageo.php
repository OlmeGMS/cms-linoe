<?php
require_once('../inc/header.php');
if (isset($_SESSION['nombre'])){
  switch ($rol) {
    case '1':
      require_once('../inc/menu_administrador.php');
      break;
      case '2':
        require_once('../inc/menu_administrador.php');
        break;
        case '3':
          require_once('../inc/menu_operadora.php');
          break;
          case '4':
            require_once('../inc/menu_pagos.php');
            break;
            case '5':
              require_once('../inc/menu_cliente.php');
              break;
              case '6':
                require_once('../inc/menu_ministerio.php');
                break;

    default:
      # code...
      break;
  }
require_once('../inc/cabecera_contenido.php');
require_once('../../models/conexion.php');
require_once('../../models/cars.php');
require_once('../../facades/carsFacades.php');
$consulta = new Cars();
?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Vehículos Registrados<br><small>Aquí podras ver todos los vehículos registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta de los Vehículos</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Prueba</strong> geo</h2>
        </div>
        <!-- END All Orders Title -->
        <!-- All Orders Content -->
        <h2>Geocode Simple: Buscar direcciones y obtener coordenadas</h2>
        <div class="column width1 first" id="fb">
          <div id="fb-root"></div>
          <div class="fb-like" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false"></div>
        </div>
        <div class="column width1" id="tw">

        </div>
        <div class="column width1" id="gp">
          <div class="g-plusone" data-size="medium"></div>
        </div>
        <div class="column width1" id="in">
          <script type="IN/Share" data-counter="right"></script>
        </div>
        <div class="column first" id="info">
          <p>Ejercicio donde muestra cómo funciona la búsqueda de una dirección, transformarlas en coordenadas y mostrarlas en mapa.</p><br/>
          <div class="demo column width4 first">
            <div class="width2">Dirección <input type="text" maxlength="100" id="address" placeholder="Dirección">
              <table class="unitx3">
                <tr>
                  <td class="unitx1"><strong>Latitud:</strong></td>
                  <td class="unitx2">
                    <div id="latitude"></div>
                  </td>
                </tr>
                <tr>
                  <td><strong>Longitud:</strong></td>
                  <td>
                    <div id="longitude"></div>
                  </td>
                </tr>
              </table>
              <label for="submit" class="unitx2 first button"><a href="javascript:void(0)" class="send" id="search">Buscar Dirección</a></label></div><br/>
            <div id="map_canvas" style="width: 700px; height: 500px;" class=""></div>
          </div>
        </div>



<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
require_once('../inc/footer.php');
require_once('../inc/script.php');?>

<!-- Load and execute javascript code used only in this page -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN6j1ecy66D7_ZPWPkVY_m0qklTvh9c18&callback=initialize"
    async defer></script>


<!-- GoogleMaps -->
<script>
var map = null;
var marker = null;

function initialize() {  
  var myLatlng = new google.maps.LatLng(4.6097100, -74.0817500);  
  var myOptions = {    
    zoom: 11,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP  
  };  
  map = new google.maps.Map($("#map_canvas").get(0), myOptions);
  marker = new google.maps.Marker({
    map: map
  });
}

$('#search').click(function() {
   // Obtenemos la dirección y la asignamos a una variable
    var address = $('#address').val();
    // Creamos el Objeto Geocoder
    var geocoder = new google.maps.Geocoder();
    // Hacemos la petición indicando la dirección e invocamos la función
    // geocodeResult enviando todo el resultado obtenido
    geocoder.geocode({ 'address': address}, geocodeResult);
});

function geocodeResult(results, status) {  
  if (status == 'OK') {
    map.setCenter(results[0].geometry.location);    
    $('#latitude').text(results[0].geometry.location.lat());
    $('#longitude').text(results[0].geometry.location.lng());    
    map.fitBounds(results[0].geometry.viewport);    
    marker.setPosition(results[0].geometry.location);  
  } else {    
    alert("Geocoding no tuvo éxito debido a: " + status);  
  }
}

$(document).ready(function() {  
  initialize();
  gmaps_ads();
});
</script>

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
