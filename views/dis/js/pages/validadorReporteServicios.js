var ValidadorReporteServicios = function(){
  return {
    init: function(){
      $('#todosReporteServicio').validate({
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
          filtro:{
            required: true
          },
          fecha1:{
            required: true
          },
          fecha2:{
            required: true
          }
        },
        messages:{
          filtro:{
            required: 'Seleccione el filtro'
          },
          fecha1:{
            required: 'Seleccione la fecha'
          },
          fecha2:{
            required: 'seleccione la fecha'
          }

        }
      });
      $('#todosReporteServicioConductor').validate({
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
          filtroConductor:{
            required: true
          },
          cedulaConductor:{
            required: true,
            minlength: 6,
            maxlength: 17
          },
          fecha1Conductor:{
            required: true
          },
          fecha2Conductor:{
            required: true
          }
        },
        messages:{
          filtroConductor:{
            required: 'Seleccione el filtro'
          },
          cedulaConductor:{
            required: 'Digite la cedula del conductor',
            minlength: 'La cedula debe tener minimo 6 caracteres',
            maxlength: 'Este no es un número de documento valido'
          },
          fecha1Conductor:{
            required: 'Seleccione la fecha'
          },
          fecha2Conductor:{
            required: 'seleccione la fecha'
          }

        }
      });
      $('#todosReporteServicioVehiculo').validate({
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
          filtroCarro:{
            required: true
          },
          placa:{
            required: true
          },
          fecha1Carro:{
            required: true
          },
          fecha2Carro:{
            required: true
          }
        },
        messages:{
          filtroCarro:{
            required: 'Seleccione el filtro'
          },
          placa:{
            required: 'Digite la placa del vehículo'
          },
          fecha1Carro:{
            required: 'Seleccione la fecha'
          },
          fecha2Carro:{
            required: 'seleccione la fecha'
          }

        }
      });
      $('#todosReporteServicioUsuario').validate({
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
          filtroUsuario:{
            required: true
          },
          telefono:{
            required: true,
            minlength: 7,
            maxlength: 10
          },
          fecha1Usuario:{
            required: true
          },
          fecha2Usuario:{
            required: true
          }
        },
        messages:{
          filtroUsuario:{
            required: 'Seleccione el filtro'
          },
          telefono:{
            required: 'Digite el email',
            minlength: 'El teléfono debe tener minimo 7 digitos',
            maxlength: 'El teléfono no puede tener más de 10 digitos'
          },
          fecha1Usuario:{
            required: 'Seleccione la fecha'
          },
          fecha2Usuario:{
            required: 'seleccione la fecha'
          }

        }
      });
      //Mascaras
      $('#placa').mask('aaa999');
    }
  };
}();
