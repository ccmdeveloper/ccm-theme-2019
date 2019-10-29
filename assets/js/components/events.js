(function($){

	/*
	* Mobile Menu
	*/
  	$(document).on('click tap','.mobile-menu-ctrl',function(){

	    if($('.mobile-menu-ctrl').hasClass('active')){
			$('.mobile-menu-ctrl').removeClass('active');
			$('body').removeClass('mobile-active').removeClass('overlay-open');
	    }else{
			$('.mobile-menu-ctrl').addClass('active');
			$('body').addClass('mobile-active').addClass('overlay-open');
	    }

	    return false;
 	});

  	//$('.mobile-menu-list .menu-item-has-children > a').append('<span class="sub-ctrl"><i class="fas fa-caret-right"></i></span>');
  	$('.mobile-menu-list').on('click tap','.sub-ctrl',function(){

	    if($(this).closest('li').hasClass('active')){
			$(this).closest('li').removeClass('active');
			$(this).next('.sub-menu').slideUp();
	    }else{
			$(this).closest('li').addClass('active');
			$(this).next('.sub-menu').slideDown();
	    }
	    return false;
  	});

	/*
	* Modal
	*/
	$(document).on('click tap','.btn-modal',function(){

    	$('#modalDefault').modal('show');

    	return false;
  	});
 
	/*
	* Scroll to Specific Div
	*/
  	$(document).on('click tap','.scroll-to-div',function(){
	    var divSelected = $(this).data('div');
	    $('html, body').animate({
	        scrollTop: $("#"+divSelected).offset().top - $('#header').outerHeight()
	    }, 2000);
	    return false;
  	});


	/*
	* Back to Top
	*/
	$(window).on('scroll',function () {
		if ($(this).scrollTop() > 100) {
			$('#back-top').addClass('active');
		} else {
			$('#back-top').removeClass('active');
		}

		if ($(this).scrollTop() > $('#header .top').outerHeight()) {
			$('#header').addClass('scrolled');
		}else{
			$('#header').removeClass('scrolled');
		}
	});
	$('#back-top').on('click tap',function () {
		$('#back-top').addClass('fired');
		$('body,html').animate({
		    scrollTop: 0
		}, 800, function() {  
		  $('#back-top').removeClass('fired');
		  $('#back-top').removeClass('active');
		});
		return false;
	});


	/*
	* Window Load
	*/
	$(window).on("load", function(){

    	/* Site Loader */
	    if($('.cssload-wrapper').length){
	       $('.cssload-wrapper').fadeOut();
	    }
	    $(window).resize();
	});

  	/*
	* Window Resize
	*/
	$(window).resize(function() {
    
 	 	/* Match Height JQuery */
    	jQuery.fn.matchHeight._update();

    	/* Sticky Sidebar */
    	if($('.sidebar').length){
  			$('.sidebar').sticky('update');

	      if (Modernizr.mq('(min-width: 992px)')) {
	        stick();
	      }else{
	        unstick();
	      }
	    }
 	});

 	$(window).on('orientationchange', function() {
    
 	 	/* Match Height JQuery */
    	jQuery.fn.matchHeight._update();

    	/* Sticky Sidebar */
    	if($('.sidebar').length){
			
			$('.sidebar').sticky('update');

	      	if (Modernizr.mq('(min-width: 992px)')) {
	        	stick();
	      	}else{
	        	unstick();
	      	}
	    }
 	});


})(jQuery);