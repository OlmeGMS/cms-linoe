<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    !window.jQuery && document.write(decodeURI('%3Cscript src="../dis/js/vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));
</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->

<script type="text/javascript">
  $(document).ready(function(){
    setInterval(cancelarSeviciosAut, 90000);
  });
  function cancelarSeviciosAut(){
    $('#cancelarServiciosAutoDiv').load("../../controllers/app/cancelarServicioAutoController.php", function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
                //alert("External content loaded".responseTxt);
            if(statusTxt == "error")
                console.log("Error: " + xhr.status + ": " + xhr.statusText);
    });

  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    setInterval(agendarSeviciosAut, 60000);
  });
  function agendarSeviciosAut(){
    $('#cancelarServiciosAutoDiv').load("../../controllers/app/agendarServicio.php", function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
                //alert("External content loaded".responseTxt);
            if(statusTxt == "error")
                console.log("Error: " + xhr.status + ": " + xhr.statusText);
    });

  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    setInterval(notificarCentarl, 60000);
  });
  function notificarCentarl(){
    $('#cancelarServiciosAutoDiv').load("../../controllers/app/notificacionAgendamientoCentralController.php", function(responseTxt, statusTxt, xhr){
      if(statusTxt == "success")
                //alert("External content loaded".responseTxt);
            if(statusTxt == "error")
                console.log("Error: " + xhr.status + ": " + xhr.statusText);
    });

  }
</script>
<script src="../dis/js/pages/notificacion.js"></script>
<!--<script>$(function(){ Notificacion.init(); });</script>-->

<script src="../dis/js/vendor/bootstrap.min.js"></script>
<script src="../dis/js/plugins.js"></script>
<script src="../dis/js/app.js"></script>
