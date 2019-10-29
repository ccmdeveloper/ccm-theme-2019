(function($){



	  // // Valid
	  // var $phoneNumber1 = "04112345678";
	  // var $phoneNumber2 = "(02) 3892 1111";
	  // var $phoneNumber3 = "38921111";
	  // var $phoneNumber4 = "0411234567";
	  // var $phoneNumber4 = "+61411234567";

	  // $phoneExpression = /^\({0,1}(04){0,1}\){0,1}(\|-){0,1}[0-9]{2}(\|-){0,1}[0-9]{2}(\|-){0,1}[0-9]{1}(\|-){0,1}[0-9]{3}$/;

	  // if ($phoneNumber1.match($phoneExpression)) {
	  //     console.log('Valid 10 digit mobile number');
	  // }

	  // if ($phoneNumber2.match($phoneExpression)) {
	  //     console.log('Valid 8 digit landline number with circular brackets wrapping area code');
	  // }

	  // if ($phoneNumber3.match($phoneExpression)) {
	  //     console.log('Valid 8 digit landline number with no spaces or area code');
	  // }

	  // if ($phoneNumber4.match($phoneExpression)) {
	  //     console.log('Valid 10 digit mobile number with no spaces or international dialing code');
	  // }	

	  // if ($phoneNumber4.match($phoneExpression)) {
	  //     console.log('Valid 10 +61');
	  // }	

 	$("#header").sticky({
		topSpacing: 0,
		bottomSpacing: 0
    });
 	
  	sliderLoader();
 	initialLoad();

  	if($('.sidebar').length){
    	stick();
  	}

  	if($('.matchContent').length){
	  $('.matchContent').matchHeight({
	    byRow : false
	  });
	}

	if($('.lazy').length){
		$('.lazy').Lazy({ chainable: false });
	}


	//Banner Area
  	if($('.banner-area .bg').length){

  		$('.banner-area .bg').each(function(){
			var heroImages = [],
				heroTitle = [],
				heroLocation = [],
				heroLink = [];
		    $(this).find('img').each(function(){
		    	heroImages.push({'src' : $(this).attr('src')});
		    });

			var slidesCount = heroImages.length;
	          
			$(this).vegas({
		        slides: heroImages,
		        timer: true,
		      	delay: $(this).data('speed'),
		      	transition : [$(this).data('transition')],
		      	overlay: false,
		     	autoplay: $(this).data('autoplay'),
		     	walk: function (index, slideSettings) {
		     		
		     		if($(this).closest('.banner-area').find('.slider-dots').length){
		     			$(this).closest('.banner-area').find('.slider-dots li').removeClass('active');
		     			$(this).closest('.banner-area').find('.slider-dots li').eq(index).addClass('active');
			    	}
			    // 	$('#home-banner .property-title').text(heroTitle[index]);
			    // 	$('#home-banner .property-location').text(heroLocation[index]);
			    // 	$('#home-banner .property-link').attr("href",heroLink[index]);
			    }
		    });

			
		});

		$(document).on('click','.slider-dots .dots', function () {
			var	selectedIndex = $(this).closest('li').index();
			$(this).closest('.banner-area').find('.slider-dots li').removeClass('active');
			$(this).closest('li').addClass('active');
			$(this).closest('.banner-area').find('.bg').vegas('jump', selectedIndex);
		});
		$(document).on('click','.prev', function () {
		    $(this).closest('.banner-area').find('.bg').vegas('previous');
		});
	    $(document).on('click','.next', function () {
		    $(this).closest('.banner-area').find('.bg').vegas('next');
		});
	}
	
})(jQuery);