var conteoGastoAdmin = function() {

  return {
    init: function() {

      var compania = $('#idCompania').val();
      //var usuario = $('#idUsuario').val();
      var data = {idCompania: compania}
      $.post("../../controllers/conteoAdministracionController.php", data, function(datos){
          $("#control_admin").html(datos);
      });
    }
  };

}()
