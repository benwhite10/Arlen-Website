$(document).ready(function(){
	/*$('#create_form').submit(function() {
  		$('#password').val(hex_sha512($('#password').val()));
  		$('#confpassword').val(hex_sha512($('#confpassword').val()));
	});*/
    
    $("#create_form").validate(
      {
        rules: 
        {
          email: {required: true, email: true},
          password: "required",
          confpassword: {equalTo: '#password'}
        },
        
        messages: 
        {
          email: "Please enter a valid email address",
          password: "Please enter a password",
          confpassword: "Your passwords do not match"
        },
        
        submitHandler: function(form){
          $(form).ajaxSubmit({
          	type:"POST",
          	data: $(form).serialize(),
          	url: "../includes/submitcreateform.php",
          	success: function(data){
          	  	/*$('#password').val('');
  				$('#confpassword').val('');*/
          	  	alert(data);
          	  	if(data == 'success'){
          	  		//It worked
          	  		alert('success');
          	  	}else{
          	  		alert('fail');
          	  	}
          	}
          });
        }
    }); 
}); 