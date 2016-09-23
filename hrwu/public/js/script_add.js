var Login = function () {
    var runLoginButtons = function () {
        $('.forgot').bind('click', function () {
            $('.box-login').hide();
            $('.box-forgot').show();
        });
        $('.register').bind('click', function () {
            $('.box-login').hide();
            $('.box-register').show();
        });
        $('.go-back').click(function () {
            $('.box-login').show();
            $('.box-forgot').hide();
            $('.box-register').hide();
        });
    };
    var runSetDefaultValidation = function () {
        $.validator.setDefaults({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
                    error.appendTo($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: ':hidden',
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error');
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').addClass('has-error');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            }
        });
    };
    var runLoginValidator = function () {
        var form = $('.form-login');
        var errorHandler = $('.errorHandler', form);
        form.validate({
            rules:
				 {
					 deptname: {
						 required: true,
						 minlength: 3
					 },
				 },
				 messages:
				 {
					 deptname: "Please enter Department name"
				 },
		   submitHandler: submitForm
        });
		/* data submit */
	   function submitForm()
	   {		
			var data = $('.form-login').serialize();
				
			$.ajax({
				
			type : 'POST',
			/*url  : 'login_process.php',*/
            url    : 'http://'+document.domain+'/information/addDept',
			data : data,
			beforeSend: function()
			{	
				$(".errorHandler").fadeOut();
				$("#btn-login").html('<i class="fa fa-retweet"></i> &nbsp; កំពុងផ្ទុក ...');
			},
			success :  function(response)
			   {	
			   		var response = JSON.parse(response);					
					if(response.result){
									
						$("#btn-login").html('រក្សាទុក &nbsp; <img src="/assets/ajax_login/loader-spinner-white.gif" width="25" /> &nbsp;');
						$(".errorHandler").fadeIn(4000, function(){				
							$(".errorHandler").html('<div class="alert alert-success"> <i class="fa fa-info-circle"></i> '+response.message+' </div>');		
							$("#btn-login").html('រក្សាទុក &nbsp;<i class="fa fa-arrow-circle-right"></i>');
                        	setTimeout( 'window.location.href = "information/dept";', 4000);
						});
					}else{	
						$(".errorHandler").fadeIn(1000, function(){						
							$(".errorHandler").html('<div class="alert alert-danger"> <i class="fa fa-info-circle"></i> &nbsp; '+response.message+' </div>');
							$("#btn-login").html('&nbsp;  រក្សាទុក  &nbsp;<i class="fa fa-arrow-circle-right"></i>');
						});
					}
			  }
			});
				return false;
		}
	   /* data submit */
    };
	
	   
    var runForgotValidator = function () {
        var form2 = $('.form-forgot');
        var errorHandler2 = $('.errorHandler', form2);
        form2.validate({
            rules: {
                email: {
                    required: true
                }
            },
            submitHandler: function (form) {
                errorHandler2.hide();
                form2.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler2.show();
            }
        });
    };
    var runRegisterValidator = function () {
        var form3 = $('.form-register');
        var errorHandler3 = $('.errorHandler', form3);
        form3.validate({
            rules: {
                full_name: {
                    minlength: 2,
                    required: true
                },
                address: {
                    minlength: 2,
                    required: true
                },
                city: {
                    minlength: 2,
                    required: true
                },
                gender: {
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    minlength: 6,
                    required: true
                },
                password_again: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                agree: {
                    minlength: 1,
                    required: true
                }
            },
            submitHandler: function (form) {
                errorHandler3.hide();
                form3.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler3.show();
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runLoginButtons();
            runSetDefaultValidation();
			runLoginValidator();
            runForgotValidator();
            runRegisterValidator();
        }
    };
}();