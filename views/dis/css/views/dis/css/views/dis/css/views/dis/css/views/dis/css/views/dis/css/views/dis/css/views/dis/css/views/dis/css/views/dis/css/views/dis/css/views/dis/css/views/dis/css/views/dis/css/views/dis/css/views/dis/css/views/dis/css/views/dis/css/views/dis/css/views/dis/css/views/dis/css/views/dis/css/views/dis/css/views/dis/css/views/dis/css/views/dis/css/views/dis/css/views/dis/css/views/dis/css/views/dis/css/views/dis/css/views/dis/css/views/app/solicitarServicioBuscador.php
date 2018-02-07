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
require_once('../../facades/servicesFacade.php');
require_once('../../facades/barrioFacade.php');

$flecha = $_GET['id_usu'];
$tel = $_GET['tel'];
?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <!-- Mini Top Stats Row -->
  <div class="row">
    <div class="content-header">
      <div class="header-section">
        <h1>
          <i class="fa fa-edit"></i>Solicitar Servicio<br><small>Complete el siguiente formulario para solicitar un servicio</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Solicitar Servicio</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Teléfono del servicio</strong></h2>
        </div>
        <form id="form-validation" action="../../controllers/app/buscarTelefonoServicioController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del servicio</legend>

            <div class="form-group">
              <label class="col-md-4 control-label" for="telefono">Teléfono<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Digite el número telefónico" >
              </div>
            </div>

            <div class="form-group ">
              <div class="col-md-8 col-md-offset-4">
                <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Buscar</button>
                <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      <?php direccionesUserDirFacade($flecha)?>
      <div class="block">
        <div class="block-title">
          <h2><strong>Ubicación</strong></h2>
        </div>
        <div class="form-horizontal form-bordered" id="fom-dir">
        <div class="form-group" id="resultadoss">
          <div class="form-group">
                  <label class="col-md-2 control-label" for="dir">Dirección<span class="text-danger">*</span></label>
                  <div class="col-md-2">
                    <select class="form-control" name="dir" id="dir">
                    <option value="" selecteddisabled>Seleccione la dirección</option>
                    <option value="Calle">Calle</option>
                    <option value="Carrera">Carrera</option>
                    <option value="Diagonal">Diagonal</option>
                    <option value="Transversal">Transversal</option>
                    </select>
                    <!--<input type="text" id="dir" name="dir" class="form-control" placeholder="Digite el número telefónico" value="'.$fila['index_id'].'" style="text-align: center;"required>-->
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="nombre_direccion" name="nombre_direccion" class="form-control" placeholder="Digite el número telefónico" required>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="ndos" name="ndos" class="form-control" placeholder="Digite el número telefónico" required>
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="noo" name="noo" class="form-control" placeholder="Digite el número telefónico" required>
                  </div>
                  <div class="col-md-2">
                    <input type="hidden" id="usuarioDir" name="usuarioDir" class="form-control" placeholder="Digite el número telefónico" required>
                  </div>
                </div>
          </div>


        <div class="form-group">
          <label class="col-md-4 control-label" for="barrio-select">Barrio</label>
          <div class="col-md-6">
            <select id="barrio-select" name="barrio-select" class="select-chosen" data-placeholder="Seleccione el barrio" style="width: 250px;">
              <option value=""></option>
              <?php echo todosBarriosFacade();?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
            <button id="btn-conf-dir" href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Buscar dirección</button>
            <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
          </div>
        </div>
      </div>
      </div>

      <div class="block" class="">
        <div id="map_canvas" style="width: 980px; height: 500px;" class=""></div>

      </div>


      <div class="block">
        <div class="block-title">
          <h2><strong>Medio de pago</strong></h2>
        </div>
        <div class="block-title">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a id="sel-efectivo" href="#efectivo">Efectivo</a></li>
                <li><a id="sel-vale" href="#vale">Vale</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="efectivo">
            <form id="formulario-efectivo" action="../../controllers/app/agregarServicioEfectivoController.php" method="post" class="form-horizontal form-bordered" name="form-efectivo">
              <fieldset>
                <legend><i class="fa fa-angle-right"></i> Datos del servicio</legend>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
                  <div class="col-md-6">
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Digite del usuario">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="id_usuariosis" name="id_usuariosis" class="form-control" value="<?php echo $idUsuario;?>">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="usuarioDir" name="usuarioDir" class="form-control" value="<?php echo $flecha;?>">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="select-dir" name="select-dir-name" class="form-control" placeholder="dir" value=""required>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="nombre_direccion-form" name="nombre_direccion-name" class="form-control" placeholder="Digite el número telefónico" value=""required>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="ndos-form" name="ndos-name" class="form-control" placeholder="Digite el número telefónico" value=""required>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="noo-form" name="noo-name" class="form-control" placeholder="Digite el número telefónico" value=""required>
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="barrio-form" name="barrio-name" class="form-control" placeholder="Digite el barrio" value="" required>
                  </div>

                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nombre">Apellido<span class="text-danger">*</span></label>
                  <div class="col-md-6">
                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Digite del usuario">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="obaservaciones">Observaciones</label>
                  <div class="col-md-6">
                    <input type="text" id="obaservaciones" name="obaservaciones" class="form-control" placeholder="Digite si hay obervaciones">
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="tel" name="tel" class="form-control" placeholder="Digite si hay obervaciones" value="<?php echo $tel ?>">
                  </div>
                  <div class="col-md-6" id="lulu" class="hidden">
                    <input type="hidden" id="capturaDireccion" name="capturaDireccion-name" class="form-control" placeholder="Direccion">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="destino">Destino<span class="text-danger">*</span></label>
                  <div class="col-md-6">
                    <input type="text" id="destino" name="destino" class="form-control" placeholder="Digite el destino">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6" id="latitude" name="latitude">
                    <input type="hidden" id="latitude-id" name="latitude-name-1" class="form-control" placeholder="longitude">
                  </div>
                  <div class="col-md-6" id="longitude" name="longitude">
                    <input type="hidden" id="longitude-id" name="longitude-name-2" class="form-control" placeholder="latitude" value="">
                  </div>
                </div>

                <div class="form-group ">
                  <div class="col-md-8 col-md-offset-4">
                    <button id="btn-efectivo" href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Solicitar Servicio</button>
                    <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
                  </div>
                </div>
              </fieldset>
            </form>
            </div>
        <!--Formulario vales-->
        <div class="tab-pane" id="vale">
        <form id="formulario-vale"  action="../../controllers/app/agregarServicioValeController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del servicio</legend>

            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Digite el nombre">
              </div>
              <div class="col-md-6">
                <input type="hidden" id="id_usuariosis" name="id_usuariosis" class="form-control" value="<?php echo $idUsuario;?>">
              </div>
              <div class="col-md-6">
                <input type="hidden" id="usuarioDir" name="usuarioDir" class="form-control" value="<?php echo $flecha;?>">
              </div>
              <div class="col-md-6">
                <input type="hidden" id="select-dir" name="select-dir-name" class="form-control" placeholder="dir" value=""required>
              </div>
              <div class="col-md-6">
                <input type="hidden" id="nombre_direccion-form" name="nombre_direccion-name" class="form-control" placeholder="Digite el número telefónico" value=""required>
              </div>
              <div class="col-md-6">
                <input type="hidden" id="ndos-form" name="ndos-name" class="form-control" placeholder="Digite el número telefónico" value=""required>
              </div>
              <div class="col-md-6">
                <input type="hidden" id="noo-form" name="noo-name" class="form-control" placeholder="Digite el número telefónico" value=""required>
              </div>
              <div class="col-md-6">
                <input type="hidden" id="barrio-form" name="barrio-name" class="form-control" placeholder="Digite el barrio" value="" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Apellido<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Digite del usuario">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="obaservaciones">Observaciones</label>
              <div class="col-md-6">
                <input type="text" id="obaservaciones" name="obaservaciones" class="form-control" placeholder="Digite sí hay observaciones">
              </div>
              <div class="col-md-6">
                <input type="hidden" id="tel" name="tel" class="form-control" placeholder="Digite si hay obervaciones" value="<?php echo $tel ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="nVale">Número de vale<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nVale" name="nVale" class="form-control" placeholder="Digite el número de vale">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="motivoVale">Motivo del vale<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="motivoVale" name="motivoVale" class="form-control" placeholder="Digite el motivo" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="destino">Destino<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="destino" name="destino" class="form-control" placeholder="Digite el destino">
              </div>
              <div class="col-md-6" id="lulu" class="hidden">
                <input type="hidden" id="capturaDireccion" name="capturaDireccion-vale" class="form-control" placeholder="Direccion">
              </div>
              <div class="col-md-6" id="latitude" name="latitude">
                <input type="hidden" id="latitude-id" name="latitude-name-vale" class="form-control" placeholder="longitude">
              </div>
              <div class="col-md-6" id="longitude" name="longitude">
                <input type="hidden" id="longitude-id" name="longitude-name-vale" class="form-control" placeholder="latitude" value="">
              </div>
            </div>
            <div class="form-group ">
              <div class="col-md-8 col-md-offset-4">
                <button id="btn-vale" href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Solicitar Servicio</button>
                <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
              </div>
            </div>
          </fieldset>
        </form>
        <div class="" id="ressp"></div>
        </div>

      </div>


      <div class="block">
        <div class="" id="resspuesta">

        </div>
      </div>
      <!--<div class="block">

        <?php //echo tablaServiciosUserCmsFacade($idUsuario); ?>
      </div>-->
    </div>
  </div>
  <!-- END Widgets Row -->
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
<script>$(function(){ Validador.init(); });</script>
<script>$(function(){ ValidadorVales.init(); });</script>
<script>$(function(){ FormsValidation.init(); });</script>
<script>$(function(){ FormsValidation.init(); });</script>
<script>$(function(){ TablesServiciosVivo.init(); });</script>
<script type="text/javascript">
  $(document).ready(function(e){
    var tel = $('#tel').val();
    alert('El teléfono seleccionado es: '+tel);
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('tr #direccion').click(function(e){
      var fila = $(this).parent().parent().parent();
      var dir = fila.find('#idDireccion').text();
      var data = {id: dir};
      $.post("../../controllers/app/formularioCrearServicioController.php", data, function(datos){
        $("#resultadoss").html(datos);
        $("#resultado").html(datos);
        $("#resultados").html(datos);

      });
    });
  });
</script>

<!-- PONER LA DIRECCION -->
<script type="text/javascript">
$(document).ready(function(){
  $('tr #direccion').click(function(e){
    var fila = $(this).parent().parent().parent();
    //varables de la direccion
    var dir = $('#dir').val();
    var nombre_dir = $('#nombre_direccion').val();
    var nDos = $('#ndos').val();
    var numm = $('#noo').val();
    //var barrio = $('#barrio').val();
    var barrio = $('#barrio-select').val();
    var nombre = $('#nombre').val();
    var observaciones = $('#observaciones').val();
    var destino = $('#destino').val();
    var direcionCompleta = dir+' '+nombre_dir+' #'+nDos+'-'+numm+','+barrio;
    $('#sss').text(barrio);
    //$('#lulu').text(direcionCompleta);
    //document.forms['form-efectivo']['noo-name'].value = numm;
  });
});
</script>

<!-- GoogleMaps -->
<script>

var map = null;
var infoWindow = null;

function openInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    infoWindow.setContent([
        'La posicion del marcador es: ',
        markerLatLng.lat(),
        ', ',
        markerLatLng.lng(),
        ' Arrástrame para actualizar la posición..'
    ].join(''));
    infoWindow.open(map, marker);
}

function initialize() {
    var myLatlng = new google.maps.LatLng(4.6097100, -74.0817500);
     
    var myOptions = {
      zoom: 13,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    //map = new google.maps.Map($("&quot#map_canvas&quot;").get(0), myOptions);
    map = new google.maps.Map($("#map_canvas").get(0), myOptions);
    infoWindow = new google.maps.InfoWindow();


    $('#btn-conf-dir').click(function() {
      var dir = $('#dir').val();
      var nombre_dir = $('#nombre_direccion').val();
      var nDos = $('#ndos').val();
      var numm = $('#noo').val();
      //var barrio = $('#barrio').val();
      var barrio = $('#barrio-select').val();
      var nombre = $('#nombre').val();
      var observaciones = $('#observaciones').val();
      var destino = $('#destino').val();
      var direcionCompleta = dir+' '+nombre_dir+' #'+nDos+'-'+numm+', '+barrio;
      var millos = direcionCompleta;

      if (dir === undefined || nombre_dir === undefined || nDos === undefined || numm === undefined || barrio === undefined) {
        alert('No han seleccionado la dirección del servicio');
        return false;
      }else if (dir === '' || nombre_dir === '' || nDos === '' || numm === '' || barrio === '') {
        alert('Por favor llenar todos los campos de la dirección');
        return false;
      }else{
        // Obtenemos la dirección y la asignamos a una variable
         var address = millos;
         // Creamos el Objeto Geocoder
         var geocoder = new google.maps.Geocoder();
         // Hacemos la petición indicando la dirección e invocamos la función
         // geocodeResult enviando todo el resultado obtenido
         geocoder.geocode({ 'address': address}, geocodeResult);
         document.forms['form-efectivo']['capturaDireccion-name'].value = address;
         document.forms['form-efectivo']['select-dir-name'].value = dir;
         document.forms['form-efectivo']['nombre_direccion-name'].value = nombre_dir ;
         document.forms['form-efectivo']['ndos-name'].value = nDos;
         document.forms['form-efectivo']['noo-name'].value = numm;
         document.forms['form-efectivo']['barrio-name'].value = barrio;

         document.forms['formulario-vale']['capturaDireccion-vale'].value = address;
         document.forms['formulario-vale']['select-dir-name'].value = dir;
         document.forms['formulario-vale']['nombre_direccion-name'].value = nombre_dir ;
         document.forms['formulario-vale']['ndos-name'].value = nDos;
         document.forms['formulario-vale']['noo-name'].value = numm;
         document.forms['formulario-vale']['barrio-name'].value = barrio;
      }

    });

    function geocodeResult(results, status) {  
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);    
        //$('#latitude').text(results[0].geometry.location.lat());
        //$('#longitude').text(results[0].geometry.location.lng());  
        var caplat = results[0].geometry.location.lat();
        var caplng = results[0].geometry.location.lng();
        document.forms['form-efectivo']['latitude-name-1'].value = caplat;
        document.forms['form-efectivo']['longitude-name-2'].value = caplng;
        document.forms['formulario-vale']['latitude-name-vale'].value = caplat;
        document.forms['formulario-vale']['longitude-name-vale'].value = caplng;

      
        map.fitBounds(results[0].geometry.viewport);    
        marker.setPosition(results[0].geometry.location);  
      } else {    
        //alert("Geocoding no tuvo éxito debido a: " + status); 
        alert("ERROR: La dirección no puedo ser ubicada. Por favor verifique el barrio y/o los campos de la dirección");  
      }
    }

    var marker = new google.maps.Marker({
        position: myLatlng,
        draggable: true,
        map: map,
        title: "Taxisya"

    });
     
    google.maps.event.addListener(marker, 'mouseup', function(){
        openInfoWindow(marker);
        var markerLatLng = marker.getPosition();
        var caplat = markerLatLng.lat();
        var caplng = markerLatLng.lng();
        document.forms['form-efectivo']['latitude-name-1'].value = caplat;
        document.forms['form-efectivo']['longitude-name-2'].value = caplng;
        document.forms['formulario-vale']['latitude-name-vale'].value = caplat;
        document.forms['formulario-vale']['longitude-name-vale'].value = caplng; 
        //document.getElementsByName('latitude-name').value = caplat;
        //document.getElementsById('latitude-id').value = markerLatLng.lat();
        //$('#latitude').text(markerLatLng.lat());
        //$('#longitude').text(markerLatLng.lng());

    });

}

$(document).ready(function() {
    initialize();
    //gmaps_ads();
});
</script>

<script type="text/javascript">

  $('#btn-efectivo').click(function(e){
    var dir = $('#dir').val();
    var nombre_dir = $('#nombre_direccion').val();
    var nDos = $('#ndos').val();
    var numm = $('#noo').val();
    //var barrio = $('#barrio').val();
    var barrio = $('#barrio-select').val();
    var nombre = $('#nombre').val();
    var observaciones = $('#observaciones').val();
    var destino = $('#destino').val();
    var latitud = $('#latitude-id').val();
    var longitud = $('#longitude-id').val();

    if (dir === undefined || nombre_dir === undefined || nDos === undefined || numm === undefined || barrio === undefined) {
      alert('No han seleccionado la dirección del servicio');
      return false;
    }else if (dir === '' || nombre_dir === '' || nDos === '' || numm === '' || barrio === '') {
      alert('Por favor llenar todos los campos de la dirección');
      return false;
    }else if (latitud === '' || longitud === '') {
      alert('Por favor Confirme a dirección, De click en buscar dirección para confirmar en el mapa la ubicación de recogida. Gracias');
      return false;
    }else {

    }

  });

</script>

<script type="text/javascript">
$('#btn-vale').click(function(e){
  var dir = $('#dir').val();
  var nombre_dir = $('#nombre_direccion').val();
  var nDos = $('#ndos').val();
  var numm = $('#noo').val();
  //var barrio = $('#barrio').val();
  var barrio = $('#barrio-select').val();
  var nombre = $('#nombre').val();
  var observaciones = $('#observaciones').val();
  var destino = $('#destino').val();
  var latitud = $('#latitude-id').val();
  var longitud = $('#longitude-id').val();

  if (dir === undefined || nombre_dir === undefined || nDos === undefined || numm === undefined || barrio === undefined) {
    alert('No han seleccionado la dirección del servicio');
    return false;
  }else if (dir === '' || nombre_dir === '' || nDos === '' || numm === '' || barrio === '') {
    alert('Por favor llenar todos los campos de la dirección');
    return false;
  }else if (latitud === '' || longitud === '') {
    alert('Por favor Confirme a dirección, De click en buscar dirección para confirmar en el mapa la ubicación de recogida. Gracias');
    return false;
  }else {

  }

});

</script>

<script type="text/javascript">
    $('#btn-mas').click(function(e){
      var cant = $('#cantidad-select').val();
      var data = {cantidad: cant};
      $.post("../../controllers/app/cantidadServiciosMultiplesController.php", data, function(datos){
        $("#formularios-efectivos").html(datos);
      });
    });

</script>

<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
