<?php
// Service Process

if( ! function_exists( 'service_process' ) ) {

    function service_process() {
       
        $output = '';
                
        // Markup attributes              
        $attributes = new Markup_Attributes();
        $attributes->set( 'class', 'section-process' );
        $attr = $attributes->get();
                
        $fields = get_field( 'process' );
        
        $heading = _s_get_heading( $fields['heading'], 'h2', array( 'class' => 'text-left' ) );
        
        $rows = $fields['grid'];
        
        if( empty( $rows ) ) {
            return;
        }
       
     
        $fg         = new Foundation_Grid( array( 'title_tag' => 'h4', 'echo' => false  ) );
        $grid       = $fg->generate( $rows ); 
                  
        if( !empty( $heading ) ) {
            $output   .= sprintf( '<div class="column row"><header class="entry-header">%s</header></div>', 
                        $heading );
        }   
        
        $output .= $grid;   
        
        
        // Do not change
        
        _s_section( $output, $attr );
    }

}

service_process();
