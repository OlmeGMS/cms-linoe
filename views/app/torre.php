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
require_once('../../models/usersDirs.php');
require_once('../../models/users.php');
require_once('../../models/services.php');
require_once('../../models/barrio.php');
require_once('../../models/drivers.php');
require_once('../../models/driversCars.php');
require_once('../../models/cars.php');
require_once('../../facades/servicesFacade.php');
require_once('../../facades/barrioFacade.php');
require_once('../../facades/torreFacade.php');



?>
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="fa fa-map-marker"></i>Torre de control<br><small>Aquí podras ver todas los taxis del sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Torre</li>
        <li><a href="">Control</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Torre</strong> Control</h2>
          </div>
        <!-- END All Orders Title -->
<div class="table-responsive remove-margin-bottom">
        <!-- All Orders Content -->
        <div class="block" class="" id="id_mapa">
          <div id="map_canvas" style="width: 980px; height: 500px;" class=""></div>
          <?php //echo mapaFacade(); ?>
          <button id="add-markers">Add markers</button>
          <button id="remove-markers">Remove markers</button>

        </div>
        <div class="" id="maca">
            <script type="text/javascript" id="macas">

            </script>
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
<script src="../dis/js/pages/validador.js"></script>
<script src="../dis/js/pages/validadorVales.js"></script>
<script src="../dis/js/pages/formsValidation.js"></script>
<script src="../dis/js/pages/tablaFinalizados.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwNDt0qiUwpZ0F7U9TAKf5mY8kSPGmxd8&callback=initialize"
    async defer></script>

<script type="text/javascript">

var map;
var markers = [];

function initialize() {

  var mapOptions = {
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: new google.maps.LatLng(4.6097100, -74.0817500)
  };

  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
  var trafficLayer = new google.maps.TrafficLayer();
  trafficLayer.setMap(map);


  google.maps.event.addDomListener(document.getElementById('add-markers'), 'click', addMarkers);
  google.maps.event.addDomListener(document.getElementById('remove-markers'), 'click', removeMarkers);

  //setInterval(removeMarkers, 2000);
  //setInterval(addMarkers, 2000);
  setInterval(refrescarTabla, 4000);




}



initialize();
setTimeout(initialize, 2000);

</script>

<script type="text/javascript" id="crear">
function addMarkers() {

var coords = [
  <?php echo marcadoresVehiculosFacades(); ?>
];

for (var i = 0; i < coords.length; i++) {

    var marker = new google.maps.Marker({
        map: map,
        position: coords[i]
    });

    markers.push(marker);
}
console.log('creado');
}

function removeMarkers() {

for (var i = 0; i < markers.length; i++) {

    markers[i].setMap(null);
}
console.log('borrado');
}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    //setInterval(refrescarTabla, 3000);
    console.log('se actualizo lat');
});
function refrescarTabla(){
  var id = 1;
  $('#crear').load("../../facades/torreControlFacade.php",{id:id}, function(){

  });
  console.log('se actualizo lat');
}
</script>





<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
