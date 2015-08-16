$(document).ready(function(){
    var response;
    $.validator.addMethod(
        "uniqueQuestion", 
        function(value, element) {
            if(value == $('#question1').val()){
            	return false;
            }else{
            	return true;
            }
        },
        "Non Unique Question"
    );
    
    $("#questionform").validate(
      {
        rules: 
        {
          question1: "required",
          question2: {
          	required: true,
          	uniqueQuestion: true
          },
          answer1: {
          	required: true,
          	minlength: 2
          },
          answer2: {
          	required: true,
          	minlength: 2
          }
        },
        
        messages: 
        {
          question1: "Please select a question",
          question2: "Please select a unique second question",
          answer1: "Please enter an answer to your first question",
          answer2: "Please enter an answer to your second question"
        },
        
        submitHandler: function(form){
          $(form).ajaxSubmit({
          	type: "POST",
          	data: $(form).serialize(),
          	url: "../includes/submitquestions.php",
          	success: function(data){
          		window.location="http://bweduapps.webuda.com/includes/portalredirect.php";
          	}
          });
        }
    });
}); 