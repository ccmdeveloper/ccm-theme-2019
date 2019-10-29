function stick(){

  var $topHeight = $('#header').outerHeight() + 20; 
  var $contentPadding = parseInt($('.sidebar-wrapper').closest('section').css('padding-bottom'),10);
  var $botHeight = $('#footer').outerHeight() + $contentPadding;

  $windowwrapper = $(window).height() - $topHeight;
  $sidebarwrapper = $('.sidebar-wrapper').outerHeight();

  if(!$('.sidebar-wrapper .sticky-wrapper').length && $windowwrapper > $sidebarwrapper){   
    
    $(".sidebar").sticky({
      topSpacing: $topHeight,
      bottomSpacing: $botHeight
    });

  }

}

function unstick() {
  $('.sidebar').unstick();
}


function detectSafari(){
  var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

  return is_safari;
}

function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
       // Edge (IE 12+) => return version number
       return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}

function initialLoad(){
  
  (function($){

    $('.lazy').Lazy({
      scrollDirection: 'vertical',
      effect: 'fadeIn',
      effect: "fadeIn",
      effectTime: 500,
      threshold: 0,
      chainable: true,
      visibleOnly: true,
      onError: function(element) {
          console.log('error loading ' + element.data('src'));
      }
    });

  })(jQuery);
}

function sliderLoader(){

  (function($){


    $('.post-slider').each(function(){

      if( $(this).length && !$(this).hasClass('slick-initialized')){

        var $speed = $(this).data('speed');
        var $auto = $(this).data('auto') ? true : false;
        var $xl = $(this).data('xl');
        var $lg = $(this).data('lg');
        var $xs = $(this).data('xs');
        var $scrollxl = $(this).data('scroll-xl');
        var $scrolllg = $(this).data('scroll-lg');
        var $scrollxs = $(this).data('scroll-xs');
        var $arrow = $(this).data('arrow') ? true : false;
        var $swipe = $(this).data('swipe') ? true : false;
        var $dots = $(this).data('dots') ? true : false;



        $(this).slick({
          dots: $dots,
          infinite: true,
          autoplay: $auto,
          autoplaySpeed: $speed,
          speed: 800,
          slidesToShow: $xl,
          slidesToScroll: $scrollxl,
          arrows: $arrow,
          swipe: $swipe,
          cssEase: 'linear',
          prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
          nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
          responsive: [
            {
              breakpoint: 993,
              settings: {
                slidesToShow: $lg,
                slidesToScroll: $scrolllg,
              }
            },
            {
              breakpoint: 769,
              settings: {
                slidesToShow:  $xs,
                slidesToScroll: $scrollxs,
              }
            },
          ]
        });

      }
    });

  })(jQuery);

}


