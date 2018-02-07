/*
 *  Document   : login.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Login page
 */

var Login = function() {

    // Function for switching form views (login, reminder and register forms)
    var switchView = function(viewHide, viewShow, viewHash){
        viewHide.slideUp(250);
        viewShow.slideDown(250, function(){
            $('input').placeholder();
        });

        if ( viewHash ) {
            window.location = '#' + viewHash;
        } else {
            window.location = '#';
        }
    };

    return {
        init: function() {
            /* Switch Login, Reminder and Register form views */
            var formLogin       = $('#form-login'),
                formReminder    = $('#form-reminder'),
                formRegister    = $('#form-register');

            $('#link-register-login').click(function(){
                switchView(formLogin, formRegister, 'register');
            });

            $('#link-register').click(function(){
                switchView(formRegister, formLogin, '');
            });

            $('#link-reminder-login').click(function(){
                switchView(formLogin, formReminder, 'reminder');
            });

            $('#link-reminder').click(function(){
                switchView(formReminder, formLogin, '');
            });

            // If the link includes the hashtag 'register', show the register form instead of login
            if (window.location.hash === '#register') {
                formLogin.hide();
                formRegister.show();
            }

            // If the link includes the hashtag 'reminder', show the reminder form instead of login
            if (window.location.hash === '#reminder') {
                formLogin.hide();
                formReminder.show();
            }

            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Login form - Initialize Validation */
            $('#form-login').validate({
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
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'login-usuario': {
                        required: true,
                        minlength: 4

                    },
                    'usuario':{
                        required: true,
                        minlength: 4
                    },

                    'login-password': {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    'login-usuario': 'Por favor escriba su numero de documento',
                    'usuario':'Por favor escriba su usuario',
                    'login-password': {
                        required: 'Por favor escriba su contraseña',
                        minlength: 'Su contraseña debe tener mas de 5 caracteres'
                    }
                }
            });

            /* Reminder form - Initialize Validation */
            $('#form-reminder').validate({
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
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'reminder-email': {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    'reminder-email': 'Por favor digite su email'
                }
            });

            /* Register form - Initialize Validation */
            $('#form-register').validate({
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
                    if (e.closest('.form-group').find('.help-block').length === 2) {
                        e.closest('.help-block').remove();
                    } else {
                        e.closest('.form-group').removeClass('has-success has-error');
                        e.closest('.help-block').remove();
                    }
                },
                rules: {
                    'nombre': {
                        required: true,
                        minlength: 3
                    },
                    'apellido': {
                        required: true,
                        minlength: 3
                    },
                    'email': {
                        required: true,
                        email: true
                    },
                    'telefono': {
                        required: true,
                        minlength: 4
                    },
                    'tipo_documento': {
                        required: true,
                    },
                    'documento': {
                        required: true,
                        minlength: 4
                    },

                    'register-password': {
                        required: true,
                        minlength: 5
                    },
                    'register-password-verify': {
                        required: true,
                        equalTo: '#register-password'
                    },
                    'register-terms': {
                        required: true
                    }
                },
                messages: {
                    'nombre': {
                        required: 'Por favor digite su nombre',
                        minlength: 'Su nombre debe tener mínimo 3 letras'
                    },
                    'apellido': {
                        required: 'Please enter your lastname',
                        minlength: 'Su apellido debe tener mínimo 3 letras'
                    },
                    'telefono': {
                        required: 'Por favor digite su usuario',
                        minlength: 'Su usuario debe tener mínimo 4 caracteres'
                    },
                    'email': 'Por favor digite su email',
                    'tipo_documento': 'Selecciones un tipo de documento',
                    'register-password': {
                        required: 'Por favor digite su clave',
                        minlength: 'su clave debe tener como mínimo 3 caracteres'
                    },
                    'register-password-verify': {
                        required: 'Por favor digite su clave nuevamente',
                        minlength: 'Su clave debe tener como mínimo 3 caracteres',
                        equalTo: 'Su clave debe ser igual'
                    },
                    'register-terms': {
                        required: 'Por favor acepte los terminos!'
                    }
                }
            });
        }
    };
}();
