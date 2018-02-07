<?php

function infoVehiculosTorreFacade(){
  $consultaConductores = new Drivers();
  $filas = $consultaConductores->obtenerConductoresHabilitados();
  foreach ($filas as $fila) {
    $id = $fila['id'];
    echo '
    function openInfoWindow(marker) {
        var markerLatLng = marker.getPosition();
        infoWindow.setContent([
            "nombre: ",
            "'.$fila['name'].'",
            ", ",
            "apellido: ",
            "'.$fila['email'].'"
        ].join(""));
        infoWindow.open(map, marker);
    }
    ';
  }
}

function ventanaF(){
  $consultaConductores = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();

  $filas = $consultaConductores->obtenerConductoresHabilitados();
    foreach ($filas as $fila) {
      $idVehiculo = $consultaDriversCars->carrosManejados($fila['id']);
      $placa = strtoupper($consultaVehiculo->obtenerPlacas($idVehiculo));
      $nombre = '"nombre: " + "'.strtoupper($fila['name']).'\n" +  "</h3>" + "Apellido: "+"'.strtoupper($fila['lastname']).'\n" +  "</h3>" + "Placas: "+"'.$placa.'\n" +  "</h3>" ,';
      echo $nombre;
    }
}

function placasF(){
  $consultaConductores = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();

  $filas = $consultaConductores->obtenerConductoresHabilitados();
    foreach ($filas as $fila) {
      $idVehiculo = $consultaDriversCars->carrosManejados($fila['id']);
      $placa = strtoupper($consultaVehiculo->obtenerPlacas($idVehiculo));
      $placas = ' "Placas: "+"'.$placa.'\n",';
      echo $placas;
    }
}

function colorIconoFacade(){
  $consultaConductores = new Drivers();
  $consultaDriversCars = new DriversCars();
  $consultaVehiculo = new Cars();
  $filas = $consultaConductores->obtenerConductoresHabilitados();
  foreach ($filas as $fila) {
    $habilitado = $fila['available'];
    if ($habilitado == 1) {
      $icono = '"../../views/dis/img/taxi.png",';
    }elseif ($habilitado == 2) {
      $icono = '"../../views/dis/img/taxi_verde.png",';
    }
    echo $icono;
  }
}


function marcadoresVehiculosFacades(){
  $consultaConductores = new Drivers();
  $filas = $consultaConductores->obtenerConductoresHabilitados();
  foreach ($filas as $fila) {
    $id = $fila['id'];
    echo '
     new google.maps.LatLng('.$fila['crt_lat'].', '.$fila['crt_lng'].'),






    ';
  }
}

function ventanaInfoTorreFacade(){
  $consultaConductores = new Drivers();
  $filas = $consultaConductores->obtenerConductoresHabilitados();
  foreach ($filas as $fila) {
    $id = $fila['id'];
    echo '
    google.maps.event.addListener(n'.$id.',"mouseup", function(){
        openInfoWindow'.$id.'(n'.$id.');
        var markerLatLng = n'.$id.'.getPosition();

        var caplat = n'.$id.'LatLng.lat();
        var caplng = n'.$id.'LatLng.lng();


    });

    ';
  }
}

function mapaFacade(){
  $consultaConductores = new Drivers();
  echo '
    <div id="map_canvas" style="width: 980px; height: 500px;" class=""></div>
    <script type="text/javascript" id="yiyis">
    function marcadoress(){';
      echo marcadoresVehiculosFacades();
echo'

    }
    </script>
  ';
}

//n'.$id.'.setMapOnAll(null);

/*

function borrarMarcas(){';
foreach ($filas as $fila) {
  $id = $fila['id'];
  echo '
  n'.$id.'.setMapOnAll(null);
  n'.$id.'= [];

  ';
}

echo '
console.log("borrado");
  }';


*/

function limpiarMarcadores(){
  $consultaConductores = new Drivers();
  $filas = $consultaConductores->obtenerConductoresHabilitados();

  echo '

  function borrarMarcas(){';


  echo '
  alert(puntos.length);
  for (p in puntos) {
    puntos[p].setMap(null);
  }
  console.log("borrado");
    }';

}
 ?>
