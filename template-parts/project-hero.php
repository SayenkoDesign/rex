<?php

/*
Hero
		
*/

if( ! function_exists( 'service_hero' ) ) {
 
    function service_hero() {
        
        global $post;
        
        $fields = get_field( 'hero' );
                      
        $photo  = $fields['background_image'];        
         
        if( ! empty( $photo ) ) {
            $photo = _s_get_acf_image( $photo, 'hero', true );
            $photo = sprintf( '<img src="%s" class="rsImg" />', $photo );
        }        
        
        $slide = sprintf( '<div class="rsContent">%s</div>', $photo );
    
        $attr = array( 'id' => 'hero', 'class' => 'section-hero' );        	
        
        _s_section_open( $attr );	
           
        printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slide );
        
        _s_section_close();
                     
    }
    
}

service_hero();
    