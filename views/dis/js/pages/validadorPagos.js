var ValidadorPagos = function(){
  return {
    init: function(){
          $('#form-pago').validate({
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

            rules:{
              unidades:{
                required: true,
                minlength: 2,
                maxlength: 4
              },
              aeropuerto:{
                required: true
              },
              nocturno:{
                required: true
              },
              mensajeria:{
                required: true
              },
              pp:{
                required: true
              },
              valor:{
                required: true
              },
              recibo:{
                required: true
              }
            },
            messages:{
              unidades:{
                required: 'Digite el número de unidades',
                minlength: 'Mínimo deber tener dos caracters',
                maxlength: 'Máximo puede tener 4 caracteres'
              },
              aeropuerto:{
                required: 'Digite sí el servicio fue al aeropuerto, si no es así digite 0'
              },
              nocturno:{
                required: 'Digite sí el servicio tuvo recargo nocturno, si no es así digite 0'
              },
              mensajeria:{
                required: 'Digite sí el servicio tuvo recargo de mensajería, si no es así digite 0'
              },
              pp:{
                required: 'Digite sí el servicio tuvo recargo de puerta a puerta, si no es así digite 0'
              },
              valor:{
                required: 'Digite el valor del servicio'
              },
              recibo:{
                required: 'Digite el número del recibo'
              }
            }
      });
    }
  };


}();
