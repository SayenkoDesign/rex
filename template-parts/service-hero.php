<?php

/*
Hero
		
*/

if( ! function_exists( 'service_hero' ) ) {
 
    function service_hero() {
        
        global $post;
        
        $fields = get_field( 'hero' );
              
        $heading 		= $fields['heading'];
        
        $photo          = $fields['background_image'];
        
        $button         = $fields['button'];
        
        $content = '';
        
         
        if( ! empty( $photo ) ) {
            $photo = _s_get_acf_image( $photo, 'hero', true );
            $photo = sprintf( '<img src="%s" class="rsImg" />', $photo );
        }
        
        if( !empty( $heading ) ) {
            $heading = _s_get_heading( $heading, 'h1' );
        }

        if( !empty( $button ) ) {
            $button = pb_get_cta_button( $button, array( 'class' => 'plus' ) ); 
        }
        
        $caption = sprintf( '<div class="caption">%s%s</div>', $heading, $button );
        
        $slide = sprintf( '<div class="rsContent">%s%s</div>', $photo, $caption );
    
        $attr = array( 'id' => 'hero', 'class' => 'section-hero' );        	
        
        _s_section_open( $attr );	
           
        printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slide );
        
        _s_section_close();
                     
    }
    
}

service_hero();
    