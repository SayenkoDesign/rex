<?php
// Grid Section

if( ! function_exists( 'section_grid' ) ) {

    function section_grid() {
                
        
        // Classes & Styles need to be an array
        $classes = array( 'section-grid' );
        $styles = array();
        $output = '';
        
        $prefix = 'grid';
        $prefix = set_field_prefix( $prefix );
                
        
        $grid_type = get_sub_field( 'grid_type' );
        
        $class = 'default' == strtolower( $grid_type ) ? 'learn-more' : 'button green';
        
        $grid_items = get_sub_field( 'grid_grid' );
        if( !empty( $grid_items ) ) {
            foreach( $grid_items as &$grid_item ) {
                 $grid_item['grid_button'] = sprintf( '<p>%s</p>', 
                 pb_get_cta_button( $grid_item['grid_button'], array( 'class' => $class ) ) );
             }
        }
                
        $fg         = new Foundation_Grid( array( 'echo' => false  ) );
        $grid       = $fg->generate( $grid_items ); 
        
            
        $settings = get_sub_field( 'grid_settings' );
          
        $section = get_sub_field( sprintf( '%ssection', $prefix ) );
        $heading = $section['heading'];
        $description = $section['description'];
                  
        if( !empty( $heading ) ) {
            $heading    = _s_get_heading( $heading );
            $output   .= sprintf( '<div class="column row"><header class="entry-header">%s%s</header></div>', 
                        $heading, $description );
        }   
        
        $output .= $grid;   
        
        
        // Do not change
        
        $args = array( 'class' => $classes, 'style' => $styles );
        
        _s_section( $output, $settings, $args );
    }

}

section_grid();
