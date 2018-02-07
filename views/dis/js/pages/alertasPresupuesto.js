var alertasPresupuesto = function(){

    return {
       init: function() {
           var compania = $('#idCompania').val();
           var usuario = $('#idUsuario').val();
           var data = {idCompania: compania, id_usuario: usuario}

           $.post("../../controllers/conteoDiarioServicios.php", data, function(datos){
               $("#mensaje_factura").html(datos);
           });
       }
    };
}();
