<?php
// Tabs

if( ! function_exists( 'section_tabs' ) ) {

    function section_tabs() {
                
        $output = '';
        
        $prefix = 'tabs';
        $prefix = set_field_prefix( $prefix );
                                    
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'id', 'section-tabs' );
        $attributes->set( 'class', 'section-tabs' );
        $attr = $attributes->get();
        
        $heading  = _s_get_heading( get_sub_field( sprintf( '%sheading', $prefix ) ), 'h2', array( 'class' => 'text-left' ) );
          
        $background_image = get_sub_field( sprintf( '%sbackground_image', $prefix ) );
        $background_image = wp_get_attachment_image_src( $background_image, 'hero' );
        $style            = sprintf( 'style="background-image: url(%s);"', $background_image[0] );
                
        $content = '';
                
        $rows = get_sub_field( 'tabs' );
        
        if( empty( $rows ) ) {
            return;
        }
        
        $args = [ 
            'data' => array( 'data-responsive-accordion-tabs' => 'tabs small-accordion large-tabs', 'data-allow-all-closed' => 'true' ),
            //'tabs_content' => ['styles' => $style ]
            // 'data-allow-all-closed' => 'true'
        ];        
        
        $foundation_tabs = new Foundation_Tabs( $args );
        
        foreach( $rows as $key => $row ) {
            
            $tab_heading = _s_get_heading( $row['heading'], 'h3' );
            $button = pb_get_cta_button( $row['button'], array( 'class' => 'plus' ) ); 
            $content = sprintf( '<div class="entry-content">%s%s%s</div>', $tab_heading, $row['editor'], $button );
            
            $args = [
                'title' => $row['tab'],
                'active' => ! $key ? true : false,
                'content' => $content
            ];
                        
            $foundation_tabs->add_tab( $args );
            
        }
        
        $tabs = $foundation_tabs->get_tabs();
        
        $panels = $foundation_tabs->get_panels();
        
        if( ! empty( $heading ) ) {
            $heading = sprintf( '<div class="row column expanded">%s</div>', $heading );
        }
        
        $aos = array( 
                      'data-aos-anchor' => '#section-tabs',
                      'data-aos' => 'fade', 
                      'data-aos-once' => 'true', 
                      'data-aos-duration' => 600,
                      'data-aos-offset' => '500' );
        $aos_attr = shortcode_parse_args( $aos );
    
        $output = sprintf( '%s<div class="row column expanded" %s %s>%s%s</div>', $heading, $style, $aos_attr, $tabs, $panels );
        
        // Do not change
                
        _s_section( $output, $attr );
    }

}

section_tabs();