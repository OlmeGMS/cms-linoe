var CancerlarServiciosAutoJs = function(){

  return {
    init: function(){
      $('#cancelarServiciosAutoDiv').load("../../controllers/app/cancelarServicioAutoController.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
                  //alert("External content loaded".responseTxt);
              if(statusTxt == "error")
                  console.log("Error: " + xhr.status + ": " + xhr.statusText);
      });
    }
  };
}();
