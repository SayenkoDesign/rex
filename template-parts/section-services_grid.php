<?php
// Service Grid

if( ! function_exists( 'section_services_grid' ) ) {

    function section_services_grid() {
                
       
        $output = '';
        
        $prefix = 'services_grid';
        $prefix = set_field_prefix( $prefix );
                                    
        $settings = get_sub_field( 'services_grid_settings' );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'class', 'section-services-grid' );
        $attr = $attributes->get();
          
        $terms = get_terms( 'service_cat', array(
            'hide_empty' => false,
        ) );
        
        if( is_wp_error( $terms ) || empty( $terms ) ) {
            return;
        }
        
        $columns = '';
        
        $count = 0;
        
        foreach( $terms as $term ) {
            
            $term_id = $term->term_id;
            $slug    = $term->slug;
            
            
            $background_image = get_field( 'background_image', $term );
            $background_image = wp_get_attachment_image_src( $background_image, 'large' );
            $style            = sprintf( 'style="background-image: url(%s);"', $background_image[0] );
            
                                    
            $heading        = _s_get_heading( $term->name, 'h3' );
            $description    = _s_get_textarea( $term->description );
            
            $button         = '<span class="plus">see all services</span>';
            
            $services       = _s_service_list( $term );
            
            $default = sprintf( '<div class="default" data-equalizer data-equalizer-watch>%s%s%s</div>', $heading, $description, $button );
            
            $hover   = sprintf( '<div class="hover" data-equalizer-watch>%s%s</div>', $heading, $services );
            
            
            $aos = array( 
                          'data-aos' => 'fade', 
                          'data-aos-once' => 'true', 
                          'data-aos-offset' => '300', 
                          'data-aos-delay' => 150 * ( ++$count ) );
            $aos_attr = shortcode_parse_args( $aos );
            
            $columns .= sprintf( '<div class="column %s" %s %s><div class="panel">%s%s</div></div>', $slug, $style, $aos_attr, $default, $hover );
            
        }
        
        $output = sprintf( '<div class="row expanded medium-unstack" data-equalize-on="large">%s</div>', $columns );
        

        _s_section( $output, $attr );
    }

}

function _s_service_list( $term ) {
    
    $loop = new WP_Query( array(
        'post_type' => 'service',
        'order' => 'ASC',
        'orderby' => 'menu_order title',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'service_cat',
                'field' => 'slug',
                'terms' => array( $term->slug ),
                'operator' => 'IN'
            )
        )
    ) );
    
    $items = '';
    
    $output = '';
    
    if ( $loop->have_posts() ) : 
    
        while ( $loop->have_posts() ) :
        
            $loop->the_post(); 
            
            $icon = get_field( 'service_icon' );
            
            if( !empty( $icon ) ) {
                
                $icon = sprintf( '<span class="icon">%s</span>', _s_get_acf_image( $icon, 'medium' ) );
            }
                        
            $items .= sprintf( '<li><a href="%s">%s<span class="text">%s</span></a></li>', get_permalink(), $icon, get_the_title() );
            
        endwhile;
        
        $output = sprintf( '<ul class="no-bullet">%s</ul>', $items );
    
    endif;
    
    wp_reset_query();
    
    return $output;
}


section_services_grid();


