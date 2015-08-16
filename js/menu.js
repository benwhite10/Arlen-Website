$(document).ready(function(){
    
    $("#dropdown").hide();
    		
    $("#menubutton").click(function(){
    	$("#dropdown").animate({
    		height: "toggle"
    	});
    });
    
    $(".profile").click(function(){
    	if($(this).children(".photo").css('background-position') == '0px 0px'){
    		$(this).children(".text").children(".extra").slideUp(500);
			$(this).children(".text").children(".readmore").show(500);
			$(this).children(".photo").css('background-position','-200px 0px');
    	}else{
    		$(this).children(".text").children(".extra").slideDown(500);
			$(this).children(".text").children(".readmore").hide(500);
			$(this).children(".photo").css('background-position','0px 0px');
    	}
    	
    });
    
    $(window).resize(function(){
      if($(window).width() > 940){
        $("#dropdown").slideUp(500);
      };
      $('#footer').css('margin-top', Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    });
    
    $("#sidecontent").children().hide();
    $(".aboutus").show();
    $(".createusers").show();
    
    $("#sidecontenttutor").children().hide();
    $(".introduction").show();
    
    $("#sidecontentcontact").children().hide();
    $(".enquiry").show();
    
    $('#footer').css('margin-top',Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    setTimeout(
    function() {
      $('#footer').css('margin-top',Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    }, 500);
    
    
    function clearAllBorders() {
    	$("ul#sidemenu li a").css('background-position','0px 0px');
    	/*$("ul#sidemenututor li a").css('background-position','0px 0px');
    	$("ul#sidemenucontact li a").css('background-position','0px 0px');*/
    	$("ul#extralist li a").css('background-position','0px 0px');
    };
    
   /* $("ul#extralist li a").click(function(){
      $("#sidecontent").children().hide();
      clearAllBorders();
      $(this).css('background-position','0px -50px');
      switch ($(this).parent().text()) {
    	case "About us":
        	$(".aboutus").show();
        	break;
        case "Core values":
        	alert("Hello");
        	$(".values").show();
        	break;
        case "Our Services":
        	$(".whyarlen").show();
        	break;
        case "Testimonials":
        	$(".testimonials").show();
        	break;
        case "FAQs":
        	$(".faqs").show();
        	break;
		}
	   $('#footer').css('margin-top',Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    });*/
    
    $("ul#sidemenu li a").click(function(){
      $("#sidecontent").children().hide();
      clearAllBorders();
      $(this).css('background-position','0px -50px');
      switch ($(this).parent().text()) {
    	case "About us":
        	$(".aboutus").show();
        	break;
        case "Core values":
        	$(".values").show();
        	break;
        case "Our Services":
        	$(".whyarlen").show();
        	break;
        case "Testimonials":
        	$(".testimonials").show();
        	break;
        case "FAQs":
        	$(".faqs").show();
        	break;
        case "Introduction":
        	$(".introduction").show();
        	break;
        case "11+ / 13+":
        	$(".prep").show();
        	break;
        case "GCSE":
        	$(".gcse").show();
        	break;
        case "Sixth Form":
        	$(".alevel").show();
        	break;
        case "University Applications":
        	$(".university").show();
        	break;
        case "Client Enquiry":
        	$(".enquiry").show();
        	break;
        case "Become a tutor":
        	$(".tutorapp").show();
        	break;
        case "Create":
        	$(".createusers").show();
        	break;
		}
	   $('#footer').css('margin-top',Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    });
    
    /*$("ul#sidemenututor li a").click(function(){
      $("#sidecontenttutor").children().hide();
      clearAllBorders();
      $(this).css('background-position', '-250px 0px');
      switch ($(this).parent().text()){
    	case "Introduction":
        	$(".introduction").show();
        	break;
        case "11+ / 13+":
        	$(".prep").show();
        	break;
        case "GCSE":
        	$(".gcse").show();
        	break;
        case "Sixth Form":
        	$(".alevel").show();
        	break;
        case "University Applications":
        	$(".university").show();
        	break;
		}
	   $('#footer').css('margin-top',Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    });
    
    $("ul#sidemenucontact li a").click(function(){
      $("#sidecontentcontact").children().hide();
      clearAllBorders();
      $(this).css('background-position', '-250px 0px');
      switch ($(this).parent().text()){
    	case "Enquire":
        	$(".enquiry").show();
        	break;
        case "Become a tutor":
        	$(".tutorapp").show();
        	break;
		}
	   $('#footer').css('margin-top',Math.max($(window).height()-$('#footer').height()-$('#site_content').height(),0));
    });*/
});