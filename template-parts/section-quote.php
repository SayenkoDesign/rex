<?php

/*
Quote		
*/

if( ! function_exists( 'section_quote' ) ) {
 
    function section_quote() {
        
        global $post;
        
        $content = '';
                
        $prefix = 'quote_section';
        $prefix = set_field_prefix( $prefix );
        
        $settings = get_sub_field( 'quote_settings' );
                
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-quote' );
        $attr = $attributes->get();
        
        $heading = _s_get_heading( get_sub_field( 'quote_heading' ) );
        
        $quote = get_sub_field( 'quote' );
        
        if( empty( $quote ) ) {
            return false;
        }

        $blockquote = sprintf( '<blockquote>%s</blockquote>', $quote );
        
        _s_section_open( $attr );	
           
        printf( '<div class="row column">%s<div class="quote-mark"><span></span></div>%s</div>', $heading, $blockquote );
        
        _s_section_close();
                     
    }
    
}

section_quote();
    