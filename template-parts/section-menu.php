<?php

/*
Section - Menu
		
*/

if( ! function_exists( 'section_menu' ) ) {
 
    function section_menu() {
                
        $output = '';
              
        $prefix = 'menu';
        $prefix = set_field_prefix( $prefix );
        
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
        
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-menu' );
        $attributes->set( 'id', 'section-menu' );
        $attr = $attributes->get();
                      
        $links = '';
        
        foreach( $fields as $field ) {
            
            $link_text  = $field['link_text'];
            $url        = $field['url'];
            
            if( $link_text && $url ) {
                $links .= sprintf( '<li><a href="%s">%s</a></li>', $url, $link_text );
            }
        }
        
        if( empty( $links ) ) {
            return;
        }
            
        $attr['data-sticky-container'] = 'true';
        
        $args = array(
            'html5'   => '<section %s>',
            'context' => 'section',
            'attr' => $attr
        );
        
        _s_markup( $args );
        
        echo '<div class="wrap show-for-xxlarge" data-sticky data-top-anchor="hero:bottom" data-margin-top="0" data-sticky-on="xxlarge">';
        
        printf( '<div class="row column"><ul class="menu">%s</ul></div>', $links );
                 
        _s_section_close();
            
    }
    
}

section_menu();
    