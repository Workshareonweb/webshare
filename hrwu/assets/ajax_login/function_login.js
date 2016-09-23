/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/

$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			username: {
            required: true,
            email: true
            },
	   },
       messages:
	   {
            password:{
                      required: "Please enter your password"
                     },
            username: "Please enter your email/username address",
       },
	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function submitForm()
	   {		
			var data = $("#login-form").serialize();
				
			$.ajax({
				
			type : 'POST',
			/*url  : 'login_process.php',*/
            url    : 'login/run',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<i class="fa fa-retweet"></i> &nbsp; Sending ...');
			},
			success :  function(response)
			   {						
					if(response=="admin"){
									
						$("#btn-login").html('<img src="/assets/ajax_login/loader-spinner-white.gif" width="25" /> &nbsp; Loging In');
						/*setTimeout(' window.location.href = "home"; ',4000);*/
                        setTimeout( 'window.location.href = "pagemanager/";', 4000);
					}
					else{	
						$("#error").fadeIn(1000, function(){						
							$("#error").html('<div class="alert alert-danger"> <i class="fa fa-info-circle"></i> &nbsp; '+response+' Username or password not found!</div>');
							$("#btn-login").html('<i class="fa fa-sign-in"></i> &nbsp; Log In');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});