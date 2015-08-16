$(document).ready(function(){

    setImageHeight();
    
    function setImageHeight(){
    	var width = $('#slideshowcontainer').width();
    	var height = width*0.41;
    	$('#slideshowcontainer').css('height', height);
    	$('#nextbutton').css('top', (height/2));
    	$('#previousbutton').css('top', (height/2));
    	var margin = ($(window).width()-width)/2;
    	$('#nextbutton').css('right', margin);
    	$('#previousbutton').css('left', margin);
    };
    
    $(window).resize(function(){
      setImageHeight();
    });

    $('#slideshowcontainer div:gt(0)').hide();
    
    function nextimage(){
      var current = $('#slideshowcontainer div:visible');
      var next = current.next().length ? current.next() : $('#slideshowcontainer div:eq(0)');
      current.fadeOut(1500);
      next.fadeIn(1500);
    };
    
    function previousimage(){
      var current = $('#slideshowcontainer div:visible');
      var previous = current.prev().length ? current.prev(): $('#slideshowcontainer div:last');
      current.fadeOut(1500);
      previous.fadeIn(1500);
    };
  
    var int = setInterval(function(){
      nextimage();
    }, 5000);
    
    $('#nextbutton').click(function(){
      clearInterval(int);
      nextimage();
      int = setInterval(function(){
        nextimage()
      }, 5000);
    });
    
    $('#previousbutton').click(function(){
      clearInterval(int);
      previousimage();
      int = setInterval(function(){
        nextimage()
      }, 5000);
    });
    
    
    $('#slideshowcontainer').mouseover(function(){
      $('#nextbutton').show();
      $('#previousbutton').show();
    });
    
    $('#header').mouseover(function(){
      $('#nextbutton').hide();
      $('#previousbutton').hide();
    });
    
    $('.about').mouseover(function(){
      $('#nextbutton').hide();
      $('#previousbutton').hide();
    });
    
    
});