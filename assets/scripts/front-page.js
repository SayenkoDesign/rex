(function($) {
	'use strict';	
    
	
    $('.project-grid').isotope({
      itemSelector: '.grid-item',
      percentPosition: true,
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: '.grid-sizer',
        // gutter: 5
      }
    });
    
    AOS.init({
      disable: 'mobile'
    });
	
})(jQuery);
