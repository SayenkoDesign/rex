<?php
// REX Leadership

if( ! function_exists( 'section_rex_leadership' ) ) {

    function section_rex_leadership() {
                
        $output = '';
        
        $prefix = 'rex_leadership';
        $prefix = set_field_prefix( $prefix );
                        
        
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-rex-leadership' );
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
                
        $rows = get_sub_field( 'staff_staff' ); 
                
        if( empty( $rows ) ) {
            return;   
        }
        
        
        
        $columns = '';
        
        foreach( $rows as $row ) {
            $photo = $row['staff_photo'];
            $photo = _s_get_acf_image( $photo );
            
            $name = _s_get_heading( $row['staff_name'], 'h4' );
            $position = _s_get_textarea( $row['staff_position'] );
            $linkedin = $row['linkedin'];
            if( !empty( $linkedin ) ) {
                $linkedin = sprintf( '<a href="%s">%s</a>', $linkedin, get_svg( 'linkedin' ) );
            }
            
            $columns .= sprintf( '<div class="column column-block"><div class="panel" data-equalizer-watch>%s</div><div class="description">%s%s%s</div></div>', $photo, $name, $position, $linkedin ) ;
            
        }
        
        if( empty( $columns ) ) {
            return;
        }
        
        // Careers block
        
        $careers = get_sub_field( 'careers' );
        
        $editor = _s_get_heading( $careers['editor'], 'h3' );
        $button = $careers['button'];
        
        if( !empty( $editor ) & !empty( $button )  ) {
            $button = pb_get_cta_button( $button, array( 'class' => 'plus' ) ); 
            $columns .= sprintf( '<div class="column column-block column-careers"><div class="panel" data-equalizer-watch><div class="text">%s%s</div></div></div>', $editor, $button ) ;
        }
        
        $output = $heading;
        $output .= sprintf( '<div class="row small-up-1 medium-up-2 large-up-3" data-equalizer>%s</div>', $columns );
        
        
        // Do not change
        _s_section( $output, $attr );
    }

}

section_rex_leadership();
