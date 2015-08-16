$(document).ready(function(){
    $("#applicationform").validate(
      {
        errorPlacement: function(label, element) {
        	if (element.attr('name') === "subject1" || element.attr('name') === "Sub1[]" || element.attr('name') === "Sub2[]" || element.attr('name') === "Sub3[]" || element.attr('name') === "Sub4[]" || element.attr('name') === "Sub5]"){
        		label.insertBefore($('#table'));
        	}else if (element.attr('name') === "terms"){
        		element.parent().append(label);
        	}else{
        		label.insertAfter(element);
        	}
        },
        
        rules: 
        {
          firstname: "required",
          surname: "required",
          email: {required: true, email: true},
          number: {required: true, phonesUK: true},
          addline1: "required",
          addcity: "required",
          postcode: {required: true, postcodeUK: true},
          university: "required",
          course: "required",
          degree: "required",
          biography: "required",
          experience: "required",
          situation: "required",
          terms: "required",
          heard: "required",
          heardother: {required: function(){return $('#heard').val() == 'other';}},
          subject1: "required",
          'Sub1[]': {required: function(){return $('#subject1').val() != ''} , minlength: 1},
          'Sub2[]': {required: function(){return $('#subject2').val() != ''} , minlength: 1},
          'Sub3[]': {required: function(){return $('#subject3').val() != ''} , minlength: 1},
          'Sub4[]': {required: function(){return $('#subject4').val() != ''} , minlength: 1},
          'Sub5[]': {required: function(){return $('#subject5').val() != ''} , minlength: 1}
        },
        
        messages: 
        {
          firstname: "Please enter your name",
          surname: "Please enter your surname",
          email: "Please enter a valid email address",
          number: "Please enter a valid UK phone number",
          addline1: "Please enter the first line of your address",
          addcity: "Please enter your town/city",
          postcode: "Please enter your postcode",
          university: "Please enter your university",
          course: "Please enter the course you studied at university",
          degree: "Please enter the result from your degree",
          biography: "Please enter a biography",
          experience: "Please enter your teaching experience",
          situation: "Please enter your current situation",
          terms: "You must accept our terms and conditions",
          heard: "Please tell us how you found out about us",
          heardother: "Please tell us which other way you found out about us",
          subject1: "Please enter at least one subject",
          'Sub1[]': " Please enter at least one age range for any selected subjects",
          'Sub2[]': " Please enter at least one age range for any selected subjects",
          'Sub3[]': " Please enter at least one age range for any selected subjects",
          'Sub4[]': " Please enter at least one age range for any selected subjects",
          'Sub5[]': " Please enter at least one age range for any selected subjects"
        },
        
        submitHandler: function(form){
          $(form).ajaxSubmit({
          	type:"POST",
          	data: $(form).serialize(),
          	url: "../includes/submitform.php",
          	success: function(){
          		$('#applicationform :input').attr('disabled', 'disabled');
          		$('#applicationform').fadeTo("slow", 0.15, function(){
          			$('#success').fadeIn();
          		});
          	},
          	failure: function(){
          	  $('#applicationform :input').attr('disabled', 'disabled');
          		$('#applicationform').fadeTo("slow", 0.15, function(){
          			$('#failure').fadeIn();
          		});
          	}
          });
        }
    }); 
    
    $("#clientapplicationform").validate(
      {
        errorPlacement: function(label, element) {
        	if (element.attr('name') === "terms"){
        		element.parent().append(label);
        	}else{
        		label.insertAfter(element);
        	}
        },
        
        rules: 
        {
          name: "required",
          email: {required: true, email: true},
          number: {required: true, phonesUK: true},
          method: "required",
          level: "required",
          levelother: {required: function(){return $('#level').val() == 'Other';}},
          heard: "required",
          heardother: {required: function(){return $('#heard').val() == 'other';}}
        },
        
        messages: 
        {
          name: "Please enter your name",
          email: "Please enter a valid email address",
          level: "Please enter the level of tutoring you are looking for",
          heardother: "Please tell us which other level of tutoring you are looking for",
          heard: "Please tell us how you found out about us",
          heardother: "Please tell us which other way you found out about us"
        },
        
        submitHandler: function(form){
          $(form).ajaxSubmit({
          	type:"POST",
          	data: $(form).serialize(),
          	url: "../includes/submitclientform.php",
          	success: function(){
          		$('#clientapplicationform :input').attr('disabled', 'disabled');
          		$('#clientapplicationform').fadeTo("slow", 0.15, function(){
          			$('#success2').fadeIn();
          		});
          	},
          	failure: function(){
          	  $('#clientapplicationform :input').attr('disabled', 'disabled');
          		$('#clientapplicationform').fadeTo("slow", 0.15, function(){
          			$('#failure2').fadeIn();
          		});
          	}
          });
        }
    }); 
}); 