<?php
// Columns

if( ! function_exists( 'section_columns' ) ) {

    function section_columns() {
                
        $output = '';
        
        $prefix = 'columns_section';
        $prefix = set_field_prefix( $prefix );
                        
        
        $rows = get_sub_field( 'columns_section' );
        
        //var_dump( $columns );
        
        if( empty( $rows ) ) {
            return;
        }
                
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-columns' );
        $attr = $attributes->get();
          
        $columns = '';
        
        foreach( $rows as $row ) {
                                    
            $columns .= sprintf( '<div class="column column-block">%s</div>', $row['editor'] );
        }
        
        
        $output = sprintf( '<div class="row small-up-1 large-up-2">%s</div>', $columns );
        
        // Do not change
        
        _s_section( $output, $attr );
    }

}

section_columns();
