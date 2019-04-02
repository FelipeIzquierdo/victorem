/*
 *  Document   : formsValidation.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Validation page
 */

var FormVoters = function() {

    return {
        init: function() {

            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Set default validation wizard options */
            var validationWizardOptions = {
                ignore: ":hidden:not(.select-chosen)",
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
                    'superior': {
                        required: true
                    },
                    'doc': {
                        digits: true,
                        required: true,
                        minlength: 7
                    },
                    'name': {
                        required: true
                    },
                    'sex': {
                        required: true
                    },
                    'location_id': {
                        required: true
                    },
                    'email': {
                        email: true
                    }
                },
                messages: {
                    'superior': 'Debe seleccionar la persona que lo refirió',
                    'doc': {
                        digits: 'El número de cédula no debe contener solo números',
                        required: 'El número de cédula es obligatorio',
                        minlength: 'Ingrese un número de cédula correcto'
                    },
                    'name': {
                        required: 'Por favor ingresa el nombre de la Persona',
                    },
                    'email': 'Por favor ingrese un E-mail valido',
                    'sex': 'Debe seleccionar el Género',
                    'location_id': 'Debe seleccionar una Ubicación'
                    
                }
            };

            /* Initialize Form Validation */
            var validationWizard = $('#form-voters');

            validationWizard.formwizard({
                disableUIStyles: true,
                validationEnabled: true,
                textBack: 'Anterior',
                textNext: 'Siguiente',
                textSubmit: 'Agregar',
                validationOptions: validationWizardOptions,
                inDuration: 0,
                outDuration: 0
            });

            $('.clickable-steps a').on('click', function(){
                var gotostep = $(this).data('gotostep');
                if(validationWizard.valid()){
                    validationWizard.formwizard('show', gotostep);
                }
            });

        },

        findNameAndPollingStation: function()
        {
            var doc = $('#form-voters input:text[name=doc]').val();
            var name = $('#form-voters input:text[name=name]').val();

            if( name.length === 0 )
            {
                $("#loading-gif").css("display", "inline");
                $.ajax({
                    url: "/database/voters/find-name/" + doc,
                    dataType: 'json'
                }).done(function(data) {
                    
                    if(data.name != 'Error')
                    {
                        $('input:text[name=name]').val(data.name); 
                    }
                    else
                    {
                        alert( "Por favor verifique el número de cédula" );
                    }  

                }).fail(function() {
                    alert( "Por favor verifique el número de cédula" );
                }).always(function() {
                    $("#loading-gif").css("display", "none");
                });    
            }

            $("#loading-polling-station-gif").css("display", "inline");
            $.ajax({
                url: "/database/voters/find-polling-station/" + doc,
                dataType: 'json'
            }).done(function(data) {
                if(data.result.status)
                {
                    $("#polling_station_location_name").html(data.result.polling_station.location.name);
                    $("#polling_station_name_and_table").html(data.result.polling_station.name + ' - Mesa ' + data.result.table_number);
                    $("#polling_station_address").html(data.result.polling_station.address);
                    $('input[name=polling_station_id]').val(data.result.polling_station.id); 
                    $('input[name=table_number]').val(data.result.table_number); 
                }
                else
                {
                    $("#polling_station_message").html('<strong>¡Atención!</strong> </br> ' + data.result.message);
                }
            }).fail(function() {
                console.log( "La registraduria no responde" );
            }).always(function() {
                $("#loading-polling-station-gif").css("display", "none");
            });  
        }
    };
}();