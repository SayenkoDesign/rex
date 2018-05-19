<?php

/*
Hero
		
*/

if( ! function_exists( 'service_testimonials' ) ) {
 
    function service_testimonials() {
        
        global $post;
        
        $content = '';
                
        
        // Markup attributes              
        $attributes = new Markup_Attributes();
        $attributes->set( 'class', 'section-testimonials' );
        $attr = $attributes->get();
        
        $fields = get_field( 'testimonials' );
        
        $heading = _s_get_heading( $fields['heading'] );
        
        $slides = '';
        
        $rows = $fields['posts'];
        
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
                 
        _s_section_open( $attr );	
           
        printf( '<div class="row column">%s<div class="quote-mark"><span></span></div><div class="royalSlider rsDefault">%s</div></div>', $heading, $slides );
        
        _s_section_close();
                     
    }
    
}

service_testimonials();
    