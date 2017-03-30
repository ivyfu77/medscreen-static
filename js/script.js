$(document).ready(function() {
	$(function(){ //Showing the rotating testimonials
		var items = (Math.floor(Math.random() * ($('#quotes li').length)));
		$('#quotes li').hide().eq(items).show();
		
	  function next(){
			$('#quotes li:visible').delay(5000).fadeOut('slow',function(){
				$(this).appendTo('#quotes ul');
				$('#quotes li:first').fadeIn('slow',next);
	    });
	   }
	  next();
	});

	$(function() {
	  $('#slides').slidesjs({
	    width: 1500,
	    height: 250,
	    play: {
	      active: false,
	      auto: true,
	      interval: 6000,
	      swap: true,
	      pauseOnHover: true,
	    },
	    navigation: {
	    	active: false
	    },
	    pagination: {
	    	active: true
	    }
	  });
	});
});