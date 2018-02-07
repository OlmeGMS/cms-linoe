var vencerVales = function() {

  return {
    init: function() {
          var compania = $('#idCompania').val();
          //var usuario = $('#idUsuario').val();
          var data = {idCompania: compania}
          $.post("../../controllers/vencerValesXDiaController.php", data, function(datos){
              $("#control_vencimiento").html(datos);
          });


    }
  };

}()
