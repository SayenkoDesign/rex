<?php

// Register scripts to load later as needed
add_action( 'wp_enqueue_scripts', '_s_register_scripts' );
function _s_register_scripts() {

	// Foundation
	wp_register_script( 'foundation', trailingslashit( THEME_JS ) . 'foundation.min.js', array('jquery'), '', true );
        
    // Isotopes
    wp_register_script( 'isotope', trailingslashit( THEME_JS ) . 'isotope.pkgd.min.js', array('jquery'), '', true );
    wp_register_script( 'packery', trailingslashit( THEME_JS ) . 'packery-mode.pkgd.min.js', array('jquery' ), '', true );
    
    wp_register_script( 'aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js', array('jquery' ), '', true );
    
    wp_register_style( 'aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css' );
        
    // Frontpage
	wp_register_script( 'front-page', trailingslashit( THEME_JS ) . 'front-page.min.js', array('jquery', 'isotope', 'packery', 'aos' ), '', true );

	// Project
 	wp_register_script( 'project' , trailingslashit( THEME_JS ) . 'project.js',
			array(
					'jquery',
 					'foundation',
 					),
				NULL, TRUE );
                
    
    
    // Localize responsive menus script.
    wp_localize_script( 'project', 'genesis_responsive_menu', array(
        'mainMenu'         => __( 'Menu', '_s' ),
        'subMenu'          => __( 'Menu', '_s' ),
        'menuIconClass'    => null,
        'subMenuIconClass' => null,
        'menuClasses'      => array(
            'combine' => array(
                '.nav-primary',
            ),
            //'others'  => array( '.nav-secondary' ),
        ),
    ) );
    
}


// Load Scripts
add_action( 'wp_enqueue_scripts', '_s_load_scripts' );
function _s_load_scripts() {

		wp_enqueue_script( 'project' );

		if( is_front_page() ) {
 			wp_enqueue_script( 'front-page');
            wp_enqueue_style( 'aos');
		}
}

// Testing Async and Defer
function add_defer_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_defer = array( 'project', 'front-page' );

   foreach($scripts_to_defer as $defer_script) {
      if ($defer_script === $handle) {
         return str_replace(' src', ' defer="defer" src', $tag);
      }
   }
   return $tag;
}

//add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);


function add_async_attribute($tag, $handle) {
   // add script handles to the array below
   $scripts_to_defer = array( 'project' );

   foreach($scripts_to_defer as $defer_script) {
      if ($defer_script === $handle) {
         return str_replace(' src', ' async src', $tag);
      }
   }
   return $tag;
}

//add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
