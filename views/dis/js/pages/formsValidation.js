/*
 *  Document   : formsValidation.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Validation page
 */

 var FormsValidation = function() {

    return {
        init: function() {
            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

             /* Initialize Form Validation */
             $('#form-validation').validate({
                errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
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
                    val_username: {
                        required: true,
                        minlength: 3
                    },
                    primer_nombre:{
                        required: true,
                        minlength: 3
                    },
                    segundo_nombre:{
                     required: true,
                     minlength: 3
                 },
                nombreRazon:{
                    required: true
                },
                nombre:{
                    required: true,
                    minlength:3,
                    maxlength:45
                },
                primer_apellido:{
                 required: true,
                 minlength: 3
             },
             segundo_apellido:{
                 required: true,
                 minlength: 3
             },
             nafiliacion:{
               required: true,
             },
             nombre_completo:{
                 required: true,
                 minlength: 3,
                 maxlength: 47
             },
             telefono:{
               required: true,
               minlength: 7,
               maxlength: 15
             },
             direccion:{
                 required: true,
                 minlength: 3,
                 maxlength: 47
             },
             codigo_linea:{
                required: true
            },
            val_email: {
                required: true,
                email: true
            },
            Codigo_Marca:{
                required:true
            },
            Codigo_Modelo:{
                required: true
            },
            val_password: {
                required: true,
                minlength: 5
            },
            password:{
              required: true,
            },
            tipo_documento:{
              required: true,

            },
            movil:{
              required: true,
              minlength: 10
            },

            Documento:{
              required: true
            },
            val_confirm_password: {
                required: true,
                equalTo: '#val_password'
            },
            val_bio: {
                required: true,
                minlength: 5
            },
            Observaciones:{
                required: true,
                minlength: 3
            },
            val_skill: {
                required: true
            },
            val_website: {
                required: true,
                url: true
            },
            val_digits: {
                required: true,
                digits: true
            },
            val_number: {
                required: true,
                number: true
            },

            Tipo_Servicio:{
                required: true,

            },
            Ruta_Origen:{
                required: true,
            },
            centro_costo:{
              required: true,
            },
            prefijo:{
              required: true,
            },
            licencia:{
                required: true,
            },
            Ruta_Destino:{
                required: true,
            },
            numero_prorroga:{
                required: true,
            },
            RUT:{
                required: true
            },
            NIT:{
                required: true
            },
            masked_date:{
                required: true
            },
            marca:{
                required: true
            },
            t_servicio:{
                required: true

            },
            numeroContrato:{
                required: true,
            },
            empresa:{
                required: true
            },
            ciudadLiquidacion:{
                required: true
            },
            departamentoCirculacion:{
                required: true
            },
            radio:{
                required: true
            },
            modelo:{
                required: true
            },
            lineas:{
                required: true
            },
            Blindaje:{
                required: true
            },
            estado:{
                required: true
            },
            tipo_carroceria:{
                required: true
            },
            fecha_servicio:{
                required: true
            },
            fechaIni:{
                required: true
            },
            fechaFin:{
                required: true
            },
            Fecha_registro:{
                required: true
            },
            fechaConductor: {
                required: true
            },
            fecha_soat:{
                required: true
            },
            fecha_contractual:{
                required: true
            },
            registroMerantil:{
                required: true
            },
            tipoCliente:{
                required: true
            },
            fecha_excontractual:{
                required: true
            },
            placa:{
                required: true
            },
            tarjeta_operacion:{
                required: true
            },
            tarjeta_propiedad:{
                required: true
            },
            num_soat:{
                required: true
            },
            Codigo_Carroceria:{
                required: true
            },
            Nombre_Carroceria:{
                required: true,
                maxlength: 45,
                minlength: 3
            },
            Codigo_Blindaje:{
                required: true
            },
            Nombre_Blindaje:{
                required: true,
                maxlength: 45,
                minlength:3
            },
            nombre:{
                required: true,
                minlength: 3,
                maxlength: 45
            },
            capacidad_peso:{
                required:true
            },
            identificacionContacto:{
                required: true,
            },
            descriCombustible:{
                required: true
            },
            nombreCombustible:{
                required: true,
                maxlength: 45,
                minlength: 3
            },
            rol:{
              required: true,

            },
            Cilindraje:{
                required: true,
                maxlength: 4
            },
            Numero_vin:{
                required: true,
                maxlength: 4
            },
            Numero_chasis:{
                required: true,
                maxlength: 32,
            },
            Numero_motor:{
                required: true,
                maxlength: 32
            },
            n_serie:{
                required: true,
                maxlength: 32
            },
            potencia_veh:{
                required: true,
                maxlength: 4
            },

            capacidad_pasajeros:{
                required: true
            },
            num_contractual:{
                required: true
            },
            presupuesto:{
              required: true
            },
            num_excontractual:{
                required: true
            },
            puertas_vehiculo:{
                required: true,
            },
            Nombre_Modelo:{
                required: true,
                minlength: 3,
                maxlength: 45
            },
            Nombre_Linea:{
                required: true,
                minlength: 4,
                maxlength: 45
            },
            nombreContacto:{
                required: true,
                minlength: 4,
                maxlength: 45
            },
            apellidoContacto:{
                required: true,
                minlength: 4,
                maxlength: 45
            },
            email:{
              required: true,
            },
            masked_telefono:{
                required: true
            },
            masked_movil:{
                required: true
            },
            mes:{
              required: true
            },
            val_terms: {
                required: true
            }
        },
        messages: {
            val_username: {
                required: 'Please enter a username',
                minlength: 'Your username must consist of at least 3 characters'
            },
            nafiliacion: {
              required: 'Digite el móvil de afilicación',
            },
            mes:{
              required: 'Seleccione un mes',
            },
            numeroContrato: {
                required: 'Digite el número de  contrato ej:0001',
            },
            nombre:{
                required: 'Digite el nombre de la marca',
                maxlength: 'El nombre puede tener maximo 45 caracteres',
                minlength: 'El nombre pude tener minimo 3 caracteres'
            },
            Nombre_Linea:{
                required: 'Digite el nombre de la línea',
                minlength:'El nombre debe tener minimo tres letras',
                maxlength: 'máximo 45 caracteres'
            },
            puertas_vehiculo:{
                required: true
            },
            movil:{
              required: 'Digite el numero teléfonico',
              minlength: 'El número debe tener mínimo 10 digitos',
            },
            password:{
              required: 'Digite el password',
            },

            primer_nombre:{
                required: 'Digite el nombre del conductor',
                minlength:'El nombre debe tener minimo tres letras',
                regexp: 'Solo se aceptan letras'
            },
            segundo_nombre:{
                required: 'Digite el  segundo nombre del conductor',
                minlength:'El nombre debe tener minimo tres letras',
                regexp: 'Solo se aceptan letras'
            },
            email:{
              required: 'Digite el email'
            },
            primer_apellido:{
                required: 'Digite el primer apellido del conductor',
                minlength:'El nombre debe tener minimo tres letras',
                regexp: 'Solo se aceptan letras'
            },
            segundo_apellido:{
                required: 'Digite el segundo apellido del conductor',
                minlength:'El nombre debe tener minimo tres letras',
                regexp: 'Solo se aceptan letras'
            },
            nombre_completo:{
                required: 'Digite el nombre completo del conductor',
                minlength:'El nombre debe tener minimo tres letras',
                regexp: 'Solo se aceptan letras',
                maxlength: 'El nombre no puede tener mas de 47 caracteres'
            },
            Documento:{
              required: 'Digite el número de documento',
              minlength: 'El documento no puede tener menos de 5 digitos',
              maxlength: 'El docuemento no puede tener más de 15 digitos'
            },
            direccion:{
                required: 'Digite la dirección del conductor',
                minlength:'verifique la dirección',
                maxlength: 'El nombre no puede tener mas de 47 caracteres'
            },
            numero_prorroga:{
                required: 'Digite el numero de prorroga ej: 0001'
            },
            Nombre_Carroceria:{
                required: 'Digite el nombre de la carroceria',
                maxlength: 'El nombre puede tener máximo 45 caracteres',
                minlength:' El nombre puede tener mínimo 3 caracteres'
            },
            Codigo_Blindaje:{
                required: 'Digite el codigo del blindaje'
            },
            Nombre_Blindaje:{
                required: 'Digite el nombre del blindaje',
                maxlength: 'El nombre puede tener máximo 45 caracteres',
                minlength: 'El nombre puede tener mínimo 3 caracteres'
            },
            descriCombustible:{
                required: 'Escriba la descripcion del combustible'
            },
            RUT:{
                required: 'Digite el número del rut'
            },
            prefijo:{
              required: 'Digite el prefijo'
            },
            tipoCliente:{
                required: 'Digite el tipo de cliente'
            },
            NIT:{
                required: 'Digite el número del nit'
            },
            Tipo_Prorroga:{
                required: true
            },
            fechaIni:{
                required: 'Digite la fecha de inicio del contrato'
            },
            capacidad_pasajeros:{
                required: 'Digite la capacidad de pasajeros',
                maxlength: 'maximo 45 pasajeros'
            },
            fechaFin:{
                required: 'Digite la fecha del fin del contrato'
            },
            Fecha_registro:{
                required: 'Digite la fecha de registro'
            },
            nombreContacto:{
                required: 'DIgite el nombre del contacto',
                minlength: 'El nombre debe tener minimo 3 caracteres',
                maxlength: 'El nombre debe tener maximo 45 caracteres'
            },
            nombre:{
                required: 'Digite el nombre',
                maxlength: 'máximo 45 caracteres',
                minlength: 'mínimo 3 caracteres'
            },
            val_email: 'Por favor digite el email del conductor',
            val_password: {
                required: 'Please provide a password',
                minlength: 'Your password must be at least 5 characters long'
            },
            val_confirm_password: {
                required: 'Please provide a password',
                minlength: 'Your password must be at least 5 characters long',
                equalTo: 'Please enter the same password as above'
            },
            radio: {
                required: 'Seleccione el tipo '
            },
            fecha_servicio:{
                required: 'Seleccione la fecha de servicio'
            },
            fechaConductor:{
                required: 'Seleccione la fecha de vincualción del conductor'
            },
            fecha_soat:{
                required: 'Seleccione la fecha de vencimineto del seguro soat'
            },
            fecha_contractual:{
                required: 'Seleccione la fecha de vencimineto del seguro contractual'

            },
            fecha_excontractual:{
                required: 'Seleccione la fecha de vencimineto del seguro excontractual'
            },
            empresa:{
                required: 'Seleccione la empresa'
            },
            departamentoCirculacion:{
                required: 'Seleccione el departamento'
            },
            ciudadLiquidacion:{
                required: 'Seleccione la ciudad'
            },
            lineas:{
                required: 'Digite la línea del vehículo'
            },
            placa:{
                required: 'Digite el número de placa',
            },
            tarjeta_operacion:{
                required: 'Digite el número de la tarjeta de operacion'
            },
            tarjeta_propiedad:{
                required: 'Digite el número de la tarjeta de propiedad'
            },
            num_soat:{
                required: 'Digite el número del soat'
            },
            num_contractual:{
                required: ' Digite el número del seguro contractual'
            },
            num_excontractual:{
                required: 'Digite el número del seguro excontractual'
            },
            presupuesto:{
              required: 'Digite el presupuesto'
            },
            Codigo_Marca:{
                required: 'Digite el codigo de la marca'
            },
            apellidoContacto:{
                required: 'Digite el apellido del contacto',
                minlength: 'El apellido debe tener minimo 3 caracteres',
                maxlength: 'El apellido debe tener maximo 45 caracteres'
            },
            identificacionContacto:{
                required: 'Digite el documento del contacto',
            },
            nombreCombustible:{
                required: 'Digite el nombre del combustible',
                maxlength: 'El nombre puede tener máximo 45 caracteres',
                minlength: 'El nombre puede tener mínimo 3 caracteres'
            },
            Blindaje:{
                required: 'Digite sí el vehículo cuenta con blindaje'
            },
            Codigo_Carroceria:{
                required: 'Digite el codigo de la carroceria'
            },
            Nombre_Modelo:{
                required: 'Digite el nombre del modelo',
                minlength: 'El nombre puede tener mínimo 3 caracteres',
                maxlength: 'El nombre puede tener máximo 45 caracteres'
            },
            telefono:{
              required: 'Digite el teléfono',
              minlength: 'mínimo 7 caracteres',
              maxlength: 'máximo 15 caracteres'
            },
            capacidad_peso:{
                required: 'Digite el peso en kilogramos'
            },
            puertas_vehiculo:{
                required: 'Digite la cantidad de puertas del vehículo'
            },
            Codigo_Modelo:{
                required: 'Digite el codigo del modelo'
            },
            Tipo_Prorroga:{
                required: 'Digite el tipo de prorroga'
            },
            registroMerantil:{
                required: 'Digite el registro mercantil'
            },
            codigo_linea:{
                required: 'Digite el codigo de la línea'
            },
            nombreRazon:{
                required: 'Digite el nombre de la razon social'
            },
            centro_costo:{
              required: 'Seleccione el centro de costo'
            },
            estado:{
                required: 'Seleccione el estado'
            },
            Cilindraje:{
                required: 'Seleccione el Cilindraje del vehículo',
                maxlength: 'ese Cilindraje no existe'
            },
            Numero_vin:{
                required: 'Seleccione el número vin',
                maxlength: 'el número es muy grande'
            },
            Numero_chasis:{
                required: 'Seleccione el número de chasis',
                maxlength: 'execede el numero de caracteres'
            },
            Numero_motor:{
                required: 'Seleccione el número de motor',
                maxlength: 'Excede el número de caracteres'
            },

            n_serie:{
                required: 'Seleccione el número de serie',
                maxlength: 'Excede el número de caracteres'
            },
            potencia_veh:{
                required: 'Seleccione el número de potencia',
                maxlength: 'Excede el número de caracteres'
            },



            val_bio: 'Don\'t be shy, share something with us :-)',
            Observaciones: 'Escriba si el servicio requiere observaciones o de lo contrario escriba N/A',
            val_skill: 'Please select a skill!',
            Tipo_Servicio: 'seleccione un tipo de servicio',
            Ruta_Destino: 'Seleccione la ciudad de destiono',
            Ruta_Origen: 'Seleccione la ciudad de origen',
            licencia:'Seleccione un tipo de licencia',
            marca:'Seleccione una marca',
            t_servicio:'Seleccione el tipo de servicio',
            modelo:'Seleccione el modelo del vehiculo',
            tipo_carroceria:'Seleccione el tipo de carroceria del vehículo',
            val_website: 'Please enter your website!',
            val_digits: 'Please enter only digits!',
            val_number: 'Por favor digite solo números!',
            val_range: 'Por favor digite números menores de 4 digitos!',
            masked_date: 'Seleccione la fecha del servicio',
            masked_telefono:'Digite un teléfono fijo',
            tipo_documento:'Seleccione el tipo de documento',
            rol:'Seleccione un rol',
            masked_movil:'Digite un teléfono movil',
            val_terms: 'You must agree to the service terms!'
        }
    });

            // Initialize Masked Inputs
            // a - Represents an alpha character (A-Z,a-z)
            // 9 - Represents a numeric character (0-9)
            // * - Represents an alphanumeric character (A-Z,a-z,0-9)
            $('#masked_date').mask('99/99/9999');
            $('#masked_date2').mask('99-99-9999');
            $('#masked_phone').mask('(999) 999-9999');
            $('#masked_telefono').mask('999-9999');
            $('#masked_movil').mask('(999)999-9999');
            $('#masked_phone_ext').mask('(999) 999-9999? x99999');
            $('#masked_taxid').mask('99-9999999');
            $('#masked_ssn').mask('999-99-9999');
            $('#masked_pkey').mask('a*-999-a999');
            $('#numeroContrato').mask('9999');
            $('#placa').mask('aaa999');
            $('#tarjeta_propiedad').mask('99999999999');
            $('#num_soat').mask('9999999999');
            $('#num_contractual').mask('9999999999');
            $('#num_excontractual').mask('9999999999');
            $('#Codigo_Marca').mask('999');
            $('#Codigo_Carroceria').mask('*****************');
            $('#Codigo_Blindaje').mask('999');
            $('#Codigo_Modelo').mask('9999');
            $('#codigo_linea').mask('9999');
            $('#capacidad_peso').mask('999999');
            $('#capacidad_pasajeros').mask('99');
            $('#puertas_vehiculo').mask('9');
            $('#numero_prorroga').mask('9999');
            $('#NIT').mask('999999999');
            $('#RUT').mask('99999999999-9');
            $('#prefijo').mask('aa');
            $('#registroMerantil').mask('999999')
            $('#tarjeta_operacion').mask('99999999')
        }
    };

}();
