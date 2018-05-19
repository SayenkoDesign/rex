(function($) {
	
	'use strict';	
	
	// Hero Options  
	var hero_slider_opts = {
		transitionType: 'move',
		controlNavigation:'bullets',
        controlsInside: false,
        navigateByClick: false,
		imageScaleMode: 'fill',
		imageAlignCenter:false,
		arrowsNav: true,
		arrowsNavAutoHide: false,
		sliderTouch: false,
		addActiveClass: true,
		sliderDrag:false,
		fullscreen: false,
		loop: true,
		autoHeight: true,
		slidesSpacing: 0,
		transitionSpeed: 500,
        autoScaleSlider: true, 
		autoScaleSliderWidth: 1440,     
		autoScaleSliderHeight: 536,
        
		autoPlay: {
				// autoplay options go gere
				enabled: true,
				pauseOnHover: true,
				delay: 4000
			}
	  };
      
    
    var hero_opts = {
		transitionType: 'move',
		controlNavigation:'none',
        controlsInside: false,
        navigateByClick: false,
		imageScaleMode: 'fill',
		imageAlignCenter:false,
		arrowsNav: false,
		arrowsNavAutoHide: false,
		sliderTouch: false,
		addActiveClass: true,
		sliderDrag:false,
		fullscreen: false,
		loop: true,
		autoHeight: true,
		slidesSpacing: 0,
		transitionSpeed: 500,
        autoScaleSlider: true, 
		autoScaleSliderWidth: 1440,     
		autoScaleSliderHeight: 456,
	  };
      
      
    // Testimonials Options  
	var testimonials_opts = {
		transitionType: 'move',
		controlNavigation:'none',
		imageAlignCenter:false,
		arrowsNav: true,
		arrowsNavAutoHide: false,
		sliderTouch: false,
		addActiveClass: true,
		sliderDrag:false,
		fullscreen: false,
		loop: true,
		autoHeight: true,
		slidesSpacing: 0,
		transitionSpeed: 500,
        
		autoPlay: {
				// autoplay options go gere
				enabled: true,
				pauseOnHover: true,
				delay: 4000
			}
	  };
      
      
    //$(window).load(function() {
        
        var $hero = $(".section-hero .royalSlider");
        $hero.royalSlider(hero_opts);
        
        var $rex_story = $(".section-rex-story .royalSlider");
        $rex_story.royalSlider(hero_opts);
        
        var $hero_slider = $(".section-hero-slider .royalSlider");
        $hero_slider.royalSlider(hero_slider_opts);
        
        if ( $hero_slider.data('royalSlider') && $hero_slider.data('royalSlider').numSlides <= 1 ) { 
            $hero_slider.find('.rsNav').hide();
            $hero_slider.find('.rsArrow').hide();
        }
        else {
            $('.rsNav').wrap('<div class="controls">').parent().append( $('.rsArrow') );   
        }
        
        var $testimonials = $(".section-testimonials .royalSlider");
        $testimonials.royalSlider(testimonials_opts);
	      
        if ( $testimonials.data('royalSlider') && $testimonials.data('royalSlider').numSlides <= 1 ) { 
            $testimonials.find('.rsNav').hide();
        }
        else {
            $testimonials.find('.rsArrow').appendTo('.section-testimonials .royalSlider');
        }
        
   // });
	
})(jQuery);