var alertasPresupuestoManager = function(){

    return {
       init: function() {
         var compania = $('#idCompania').val();
         var usuario = $('#idUsuario').val();
         var centroCosto = $('#idCentroCosto').val();
         var data = {idCompania: compania, id_usuario: usuario, idCC: centroCosto};
         $.post("../../controllers/conteoDiarioServiciosManager.php", data, function(datos){
             $("#mensaje_factura").html(datos);
         });
       }
    };
}();
