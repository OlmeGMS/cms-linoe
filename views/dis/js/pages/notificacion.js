var Notificacion = function(){

  return {
      init: function(){

              setTimeout(function() {
                  $.bootstrapGrowl("Hola Central, Debes crear un servicio de agendamiento!", {
                      type: 'info',
                      align: 'center',
                      width: 'auto',
                      stackup_spacing: 30
                  });
              }, 1000);



      }
  };
}();
