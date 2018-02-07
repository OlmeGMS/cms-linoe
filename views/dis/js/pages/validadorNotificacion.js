var validadorNotificacion = function(){
  return {
    init: function(){
      $('#form-notificacion').validate({
        errorClass: 'help-block animation-slideDown',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            e.parents('.form-group > div').append(error);
        },
        highlight: function(e) {
            $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
            $(e).closest('.help-block').remove();
        },
        success: function(e) {
            // You can use the following if you would like to highlight with green color the input after successful validation!
            e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
            e.closest('.help-block').remove();
        },
        rules: {
          mensaje:{
            required: true
          },
          tipo_usuario:{
            required: true
          },
          empresa:{
            required: true
          }
        },
        messages:{
          mensaje:{
            required: 'Digite el mensaje de la notificación'
          },
          tipo_usuario:{
            required: 'Seleccione el tipo de usuario'
          },
          empresa:{
            required: 'Seleccione una empresa'
          }
        }

      });

    }

  };

}();
