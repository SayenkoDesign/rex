<?php
// Grid Section

if( ! function_exists( 'section_rex_culture' ) ) {

    function section_rex_culture() {
        
        
        $output = '';
        
        $prefix = 'rex_culture';
        $prefix = set_field_prefix( $prefix );
        
        // Settings   
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-rex-culture' );
        $attr = $attributes->get();
        
          
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
        
        $heading = $fields['heading'];
        $description = $fields['description'];
                  
        if( !empty( $heading ) ) {
            $heading        = _s_get_heading( $heading );
            $description    = _s_get_heading( $description, 'h4' );
            $heading        = sprintf( '<div class="column row"><header class="entry-header">%s%s</header></div>', 
                        $heading, $description );
        }   
        
        
        
        $rows = get_sub_field( 'rex_culture_grid_grid' ); 
                
        if( empty( $rows ) ) {
            return;   
        }
        
        $columns = '';
        
        foreach( $rows as $row ) {
            $background = $row['grid_photo'];
            $style = '';
            if( ! empty( $background ) ) {
                $background = _s_get_acf_image( $background, 'large', true );
                $style = sprintf( ' style="background-image: url(%s);"', $background );
            }
            
            $button = $row['grid_button'];
            $link = '';
            if( !empty( $button ) ) {
                $link_text = $button['text'];
                $link = pb_get_cta_url( $button ); 
                $button = sprintf( '<div class="plus"><span>%s</span></div>', $link_text );
            }
            
            $columns .= sprintf( '<div class="column column-block"><a href="%s" class="panel"%s>%s</a></div>', $link, $style, $button ) ;
            
        }
        
        if( empty( $columns ) ) {
            return;
        }
        
        $output = $heading;
        $output .= sprintf( '<div class="row small-up-1 large-up-3">%s</div>', $columns );
                        
        _s_section( $output, $attr );
    }

}

section_rex_culture();
