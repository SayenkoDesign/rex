<?php
// Locations

if( ! function_exists( 'section_locations' ) ) {

    function section_locations() {
                
        $output = '';
        
        $prefix = 'locations';
        $prefix = set_field_prefix( $prefix );
                        
        
        $locations = get_sub_field( 'locations_grid' );
        
        if( empty( $locations ) ) {
            return;
        }
                
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-locations' );
        $attr = $attributes->get();
          
        $columns = '';
        
        foreach( $locations as $location ) {
            
            $name = $location['name'];
            $address = $location['address'];
            $directions = $location['directions'];
            $phone = $location['phone'];
            $fax = $location['fax'];
            
            $name = _s_get_heading( $name, 'h4' );
            
            if( !empty( $address ) ) {
                $icon = sprintf( '<img src="%sicons/address.svg" />', trailingslashit( THEME_IMG ) );
                $address = _s_get_textarea( $icon . $address, 'p', array( 'class' => 'address' ) );
            }
            
            if( !empty( $directions ) ) {
                $directions = sprintf( '<p><a href="%s"><strong>Get Directions ></strong></a></p>', $directions );
            }
            
            if( !empty( $phone ) ) {
                $phone_number = _s_format_telephone_url( $phone );
                $phone = _s_get_textarea( sprintf( '<strong>Phone:</strong> <a href="%s">%s</a>', $phone_number, $phone ) );
            }
            
            if( !empty( $fax ) ) {
                $fax = _s_get_textarea( sprintf( '<strong>Fax:</strong> %s', $fax ) );
            }
            
            $details = sprintf( '<div class="panel"><div class="title-address" data-equalizer-watch>%s%s</div>%s%s%s</div>', $name, $address, $directions, $phone, $fax );
            
            $columns .= sprintf( '<div class="column column-block">%s</div>', $details );
        }
        
        
        $output = sprintf( '<div class="row small-up-1 large-up-3" data-equalizer>%s</div>', $columns );
        
        // Do not change
        _s_section( $output, $attr );
    }

}

section_locations();
