<?php

/*
Hero
		
*/

if( ! function_exists( 'section_hero' ) ) {
 
    function section_hero() {
        
        global $post;
                
        $prefix = 'hero';
        $prefix = set_field_prefix( $prefix );
        
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
              
        $heading 		= $fields['heading'];
        $description	= $fields['description'];
        
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
        
        if( !empty( $description ) ) {
            $description = _s_wrap_text( $description, "\n" );
            $description = _s_get_textarea( $description );
        }
        
        if( !empty( $button ) ) {
            $button = pb_get_cta_button( $button, array( 'class' => 'plus' ) ); 
        }
        
        
        $caption = sprintf( '<div class="caption">%s%s%s</div>', $heading, $description, $button );
        
        $slide = sprintf( '<div class="rsContent">%s%s</div>', $photo, $caption );
    
        $attr = array( 'id' => 'hero', 'class' => 'section-hero' );        	
        
        _s_section_open( $attr );	
           
        printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slide );
        
        _s_section_close();
                     
    }
    
}

section_hero();
    