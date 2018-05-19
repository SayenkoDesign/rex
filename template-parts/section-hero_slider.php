<?php

/*
Hero
		
*/

if( ! function_exists( 'section_hero_slider' ) ) {
 
    function section_hero_slider() {
        
        global $post;
        
        $content = '';
                
        $prefix = 'hero_slider';
        $prefix = set_field_prefix( $prefix );
        
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
        
        $slides = '';
        
        foreach( $fields as $field ) {
            
            $heading 		    = $field['heading'];
            $description	    = $field['description'];
            $photo              = $field['photo'];
            $button             = $field['button'];
            
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
            
            $caption = sprintf( '<div class="caption">%s%s</div>', $heading, $description );
                        
            if( !empty( $button ) ) {
                $button = pb_get_cta_button( $button, array( 'class' => 'plus' ) ); 
            }
            
            
            $slides .= sprintf( '<div class="rsContent">%s%s%s</div>', $photo, $caption, $button );
            
        }        

        $attr = array( 'id' => 'hero-slider', 'class' => 'section-hero-slider' );
        
        _s_section_open( $attr );	
           
        printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slides );
        
        _s_section_close();
                     
    }
    
}

section_hero_slider();
    