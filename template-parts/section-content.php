<?php

/*
Section - Content
		
*/

if( ! function_exists( 'section_content' ) ) {
 
    function section_content() {
                
        $output = '';
              
        $prefix = 'content';
        $prefix = set_field_prefix( $prefix );
        
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
        
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-content-block' );
        $attr = $attributes->get();
                      
        $heading 		        = $fields['heading'];
        $editor	                = $fields['editor'];
        $photo	                = $fields['photo'];
        $photo_alignment	    = strtolower( $fields['photo_alignment'] );
        $button                 = $fields['button'];
                  
        $content = '';
        
        $row_class = '';
         
        if( !empty( $photo ) ) {
            $left = ' small-order-1';
            $right = ' small-order-2';
            $attachment_id = $photo;
            $size = 'large';
            $photo = wp_get_attachment_image( $attachment_id, $size );
            
            if( 'right' == $photo_alignment ) {
                 $left = ' small-order-1 large-order-2';
                 $right = ' small-order-2 large-order-1';
            }
            
            $row_class = ' two-column';
            
            $photo = sprintf( '<div class="column column-block%s">%s</div>', $left, $photo );
        }
        
        if( !empty( $heading ) ) {
            $content .= _s_get_heading( $heading, 'h2', array( 'class' => 'text-left' ) );
        }
        
        if( !empty( $editor ) ) {
            $content .= $editor;
         }

        if( !empty( $button ) ) {
            $content .= sprintf( '<p>%s</p>', pb_get_cta_button( $button, array( 'class' => 'button blue' ) ) );
        }        
                 
        $content = sprintf( '<div class="columns%s"><div class="entry-content">%s</div></div>', $right, $content );
        
        
        $output = sprintf( '<div class="row large-unstack%s">%s%s</div>', $row_class, $photo, $content );
        
        // Do not change
                 
        _s_section( $output, $attr );
            
    }
    
}

section_content();
    