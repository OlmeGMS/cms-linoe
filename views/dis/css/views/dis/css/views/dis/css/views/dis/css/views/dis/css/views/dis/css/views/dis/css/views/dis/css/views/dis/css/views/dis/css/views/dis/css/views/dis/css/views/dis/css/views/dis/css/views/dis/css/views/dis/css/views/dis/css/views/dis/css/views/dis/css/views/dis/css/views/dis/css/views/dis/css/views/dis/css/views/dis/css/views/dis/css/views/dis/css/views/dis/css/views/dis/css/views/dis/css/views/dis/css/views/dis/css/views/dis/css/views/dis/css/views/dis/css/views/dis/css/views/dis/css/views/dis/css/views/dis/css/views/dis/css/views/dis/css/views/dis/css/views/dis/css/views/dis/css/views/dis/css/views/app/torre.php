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
        <div class="block" class="">
          <?php echo mapaFacade(); ?>

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
<script src="../dis/js/pages/route.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwNDt0qiUwpZ0F7U9TAKf5mY8kSPGmxd8&signed_in=true&callback=initMap"
    async defer></script>


<!--<script type="text/javascript">
function marcadores(){
  <?php //echo marcadoresVehiculosFacades(); ?>
  //var tiempo = setInterval(marcadores, 3000);
  //alert('hi');
}
</script>-->

<script type="text/javascript">
function ventanas(){
  <?php echo infoVehiculosTorreFacade(); ?>
}
</script>

<!-- GoogleMaps -->
<!--<script>

var map = null;
var infoWindow = null;

function openInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    infoWindow.setContent([
        'Oficinas Taxisya: ',
        'Calle 1C Bis # 18 - 34; Barrio Eduardo Santos; Bogotá ',
        ', ',
        'Horario de atención: ',
        ' Lunes a Viernes 8:00am - 5:00pm'
    ].join(''));
    infoWindow.open(map, marker);
}

ventanas();

function initialize() {
    var myLatlng = new google.maps.LatLng(4.6097100, -74.0817500);
    var uluru = {lat: 4.614834, lng: -74.1278853};
     
    var myOptions = {
      zoom: 13,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    //map = new google.maps.Map($("&quot#map_canvas&quot;").get(0), myOptions);
    map = new google.maps.Map($("#map_canvas").get(0), myOptions);
    infoWindow = new google.maps.InfoWindow();

    function geocodeResult(results, status) {  
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);    

        var caplat = results[0].geometry.location.lat();
        var caplng = results[0].geometry.location.lng();

        var onChangeHandler = function(){
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };


      
        map.fitBounds(results[0].geometry.viewport);    
        marker.setPosition(results[0].geometry.location);  
      } else {    
        //alert("Geocoding no tuvo éxito debido a: " + status); 
        alert("ERROR: La dirección no puedo ser ubicada. Por favor verifique el barrio y/o los campos de la dirección");  
      }
    }

    var marker = new google.maps.Marker({
        position: myLatlng,
        //draggable: true,
        map: map,
        title: "Taxisya"

    });




    marcadores();
    setInterval(marcadores, 5000);

    google.maps.event.addListener(marker,'mouseup', function(){
        openInfoWindow(marker);
        var markerLatLng = marker.getPosition();

        var caplat = markerLatLng.lat();
        var caplng = markerLatLng.lng();


    });

    <?php// echo ventanaInfoTorreFacade(); ?>

}

$(document).ready(function() {
    initialize();
    //gmaps_ads();
});



</script>-->

<script type="text/javascript">
  $(document).ready(function(){
    setInterval(refrescarTabla, 3000);
});
function refrescarTabla(){
  var id = $('#idusuarioid').val();
  $('#map_canvas').load("../../facades/torreControlFacade.php",{id:1}, function(){

  });
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
