<?php
require_once('../models/conexion.php');
require_once('../models/drivers.php');
require_once('../models/services.php');
require_once('../models/driversCars.php');
require_once('../models/cars.php');
require_once('../facades/torreFacade.php');
  $id = $_POST['id'];
  $consultaConductores = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();

  $filas = $consultaConductores->obtenerConductoresHabilitados();


  echo '
  <script type="text/javascript" id="crear">
  function addMarkers() {
  var hola = "hola";';

  echo'  var coords = [';
     echo marcadoresVehiculosFacades();
  echo '];

  var datos =[';
        echo ventanaF();
  echo'];

  var placas =[';
        echo placasF();
  echo'];

  var icono =[';
        echo colorIconoFacade();
  echo'];


    for (var i = 0; i < coords.length; i++) {

        var marker = new google.maps.Marker({
            map: map,
            position: coords[i],
            title: placas[i]
        });
        marker.setIcon(icono[i]);';


      echo '   var objtHTML = datos[i];

                var infowindow = new google.maps.InfoWindow()
                google.maps.event.addListener(marker,"click", (function(marker,objtHTML,infowindow){
                      return function() {
                        infowindow.setContent(objtHTML);
                        infowindow.open(map,marker);
                      };
                })(marker,objtHTML,infowindow));
        ';

        //echo ventana();

  echo '  markers.push(marker);

        ';

        echo '

    }
    console.log("creado");
  }

  function removeMarkers() {

    for (var i = 0; i < markers.length; i++) {

        markers[i].setMap(null);
    }
    console.log("borrado");
  }
  removeMarkers();
  addMarkers();


  </script>
  ';

 ?>
