var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#company_add');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    'master_form_type[name]': {
                        minlength: 2,
                        required: true
                    },
                    'master_form_type[description]': {
                        required: false
                    },
                    'master_form_type[url]': {
                        required: false,
                        url: true
                    },
                    'master_form_type[siret]': {
                        required: false
                    },
                    'master_form_type[tva]': {
                        required: false
                    },
                    'master_form_type[email]': {
                        required: false,
                        email: true
                    },
                    'master_form_type[phone]': {
                        required: false
                    },
                    'master_form_type[mobile]': {
                        required: false
                    },
                    'master_form_type[fax]': {
                        required: false
                    },
                    'master_form_type[address][street]': {
                        required: false,
                        minlength: 5
                    },
                    'master_form_type[address][postal_code]': {
                        required: false,
                        minlength: 3,
                        maxlength: 5,
                        digits: true
                    },
                    'master_form_type[address][city]': {
                        required: false,
                        minlength: 2
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight

                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                    $(element).closest('.form-group').addClass('has-success');
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                    label.closest('.form-group').addClass('has-success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form.submit();
                }
            });


    };

    return {
        //main function to initiate the module
        init: function () {

            handleValidation1();

        }

    };

}();