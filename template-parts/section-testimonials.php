<?php

/*
Hero
		
*/

if( ! function_exists( 'section_testimonials' ) ) {
 
    function section_testimonials() {
        
        global $post;
        
        $content = '';
                
        $prefix = 'testimonials_section';
        $prefix = set_field_prefix( $prefix );
        
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-testimonials' );
        $attr = $attributes->get();
        
        $heading = _s_get_heading( get_sub_field( sprintf( '%sheading', $prefix ) ) );
        
        $slides = '';
        
        $rows = get_sub_field( 'testimonials' );
        
        if( empty( $rows ) ) {
            return false;
        }
        
        foreach( $rows as $row ) {
            
            $cite = $row->post_title;
            
            if( !empty( $cite ) ) {
                $cite = _s_get_heading( '~ ' . $row->post_title, 'h4' );
            }
            
            $blockquote = sprintf( '<blockquote>%s%s</blockquote>', apply_filters( 'pb_the_content', $row->post_content ), $cite );
            
            $slides .= sprintf( '<div class="rsContent">%s</div>', $blockquote );
            
        }       
         

        $attr = wp_parse_args( array( 'data-aos' => 'fade-up', 'data-aos-once' => 'true', 
                                      'data-aos-offset' => '300' ), $attr );
        
        _s_section_open( $attr );	
           
        printf( '<div class="row column">%s<div class="quote-mark"><span></span></div><div class="royalSlider rsDefault">%s</div></div>', $heading, $slides );
        
        _s_section_close();
                     
    }
    
}

section_testimonials();
    