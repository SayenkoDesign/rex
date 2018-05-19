<?php

/*
Hero
		
*/

if( ! function_exists( 'blog_hero' ) ) {
 
    function blog_hero() {
        
        global $post;
                
        $fields = get_field( 'hero' );
              
        $heading 		= $fields['heading'];
        $description	= $fields['description'];
        
        $photo          = $fields['background_image'];
        
        $button         = '';
        
        $content = '';
        
        // Is this a FacetWP filtered category?
        
        if( isset( $_GET['fwp_categories'] ) ) {
            $category = sanitize_text_field( $_GET['fwp_categories'] );
            
            if( ! is_wp_error( get_term_by( 'slug', $category, 'category' ) ) ) {
                $term = get_term_by( 'slug', $category, 'category' );
                $heading = $term->name;
                $description = $term->description;
            }
        }
        
         
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
        
        
        $slide = sprintf( '<div class="rsContent">%s%s%s</div>', $photo, $caption, $button );
    
        $attr = array( 'id' => 'hero', 'class' => 'section-hero' );
        
        _s_section_open( $attr );	
           
        printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slide );
        
        _s_section_close();
                     
    }
    
}

blog_hero();
    