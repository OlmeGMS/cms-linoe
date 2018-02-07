/*
 *  Document   : formsWizard.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Wizard page
 */

 var FormsWizard = function() {

    return {
        init: function() {
            /*
             *  Jquery Wizard, Check out more examples and documentation at http://www.thecodemine.org
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

             /* Initialize Progress Wizard */
             $('#progress-wizard').formwizard({focusFirstInput: true, disableUIStyles: true, inDuration: 0, outDuration: 0});

            // Get the progress bar and change its width when a step is shown
            var progressBar = $('#progress-bar-wizard');
            progressBar
            .css('width', '33%')
            .attr('aria-valuenow', '33');

            $("#progress-wizard").bind('step_shown', function(event, data){
              if (data.currentStep === 'progress-first') {
                progressBar
                .css('width', '33%')
                .attr('aria-valuenow', '33')
                .removeClass('progress-bar-warning progress-bar-success')
                .addClass('progress-bar-danger');
            }
            else if (data.currentStep === 'progress-second') {
                progressBar
                .css('width', '66%')
                .attr('aria-valuenow', '66')
                .removeClass('progress-bar-danger progress-bar-success')
                .addClass('progress-bar-warning');
            }
            else if (data.currentStep === 'progress-third') {
                progressBar
                .css('width', '100%')
                .attr('aria-valuenow', '100')
                .removeClass('progress-bar-danger progress-bar-warning')
                .addClass('progress-bar-success');
            }
        });

            /* Initialize Basic Wizard */
            $('#basic-wizard').formwizard({disableUIStyles: true, inDuration: 0, outDuration: 0});

            /* Initialize Advanced Wizard with Validation */
            $('#advanced-wizard').formwizard({
                disableUIStyles: true,
                validationEnabled: true,
                validationOptions: {
                    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
                    errorElement: 'span',
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
                        empresa:{
                            required: true
                        },
                        servicio_ruta:{
                            required: true
                        },
                        val_username: {
                            required: true,
                            minlength: 2
                        },
                        numeroContrato:{
                            required: true,
                        },
                        ciudad:{
                            required: true,
                        },
                        departamento:{
                            required: true,
                        },
                        fechaIni:{
                            required: true,
                        },
                        fechaFin:{
                            required: true,
                        },
                        placa:{
                            required: true
                        },
                        nruta:{
                            required: true
                        },

                        val_password: {
                            required: true,
                            minlength: 5
                        },
                        Observaciones:{
                            required: true,
                            minlength: 3
                        },
                        barrios:{
                            required: true,
                            minlength: 3
                        },
                        paraderos:{
                            required: true
                        },
                        Observaciones:{
                            required: true,
                            minlength: 3
                        },
                        Documento_Conductor: {

                            required: true,
                            digits: true

                        },
                        val_confirm_password: {
                            required: true,
                            equalTo: '#val_password'
                        },
                        val_email: {
                            required: true,
                            email: true
                        },
                        val_terms: {
                            required: true
                        }
                    },
                    messages: {
                        val_username: {
                            required: 'Please enter a username',
                            minlength: 'Your username must consist of at least 2 characters'
                        },
                        numeroContrato:{
                            required: 'Digite el numero de contrato ej:0001'
                        },
                        val_password: {
                            required: 'Please provide a password',
                            minlength: 'Your password must be at least 5 characters long'
                        },
                        val_confirm_password: {
                            required: 'Please provide a password',
                            minlength: 'Your password must be at least 5 characters long',
                            equalTo: 'Please enter the same password as above'
                        },
                        ciudad:{
                            required:'Seleccione la ciudad de la ruta'
                        },
                        departamento:{
                            required: 'Seleccione el departamento '
                        },
                        fechaIni:{
                            required: 'Seleccione la fecha de inico'
                        },
                        fechaFin:{
                            required: 'Seleccione la fecha de final'
                        },
                        placa:{
                            required: 'Digite el número de placa'
                        },
                        Documento_Conductor: {
                            required: 'Digite el número de documento del conductor'
                        },

                        empresa:{
                            required: 'Seleccione una empresa'
                        },
                        servicio_ruta:{
                            required: 'Seleccione el tipo de ruta'
                        },
                        Observaciones: 'Escriba si el servicio requiere observaciones o de lo contrario escriba N/A',
                        barrios: 'digite los barrios del recorrido',
                        paraderos: 'Digite los paraderos',
                        nruta: 'Digite el número de la ruta ej: 01',
                        val_email: 'Please enter a valid email address',
                        val_number: 'Por favor digite solo números!',
                        val_terms: 'Please accept the terms to continue'
                    }
                },
                inDuration: 0,
                outDuration: 0
            });

/* Initialize Clickable Wizard */
var clickableWizard = $('#clickable-wizard');

clickableWizard.formwizard({disableUIStyles: true, inDuration: 0, outDuration: 0});

$('.clickable-steps a').on('click', function(){
    var gotostep = $(this).data('gotostep');

    clickableWizard.formwizard('show', gotostep);
});
$('#numeroContrato').mask('9999');
$('#placa').mask('aaa999');
$('#nruta').mask('99');
}
};
}();
