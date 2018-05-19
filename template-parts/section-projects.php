<?php
// Projects

if( ! function_exists( 'section_projects' ) ) {

    function section_projects() {
                
        $output = '';
        
        $prefix = 'projects';
        $prefix = set_field_prefix( $prefix );
                                    
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $attributes->set( 'id', 'projects' );
        $attributes->set( 'class', 'section-projects' );
        $attr = $attributes->get();
        
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
        
        $heading        = get_sub_field( sprintf( '%sheading', $prefix ) );
        $description	= get_sub_field( sprintf( '%sdescription', $prefix ) );
        
        $projects   	= get_sub_field( 'projects' );
        
        if( empty( $projects ) ) {
            return;
        }
        
        
        if( !empty( $heading ) ) {
            
            $heading = _s_get_heading( $heading, 'h2' );
            
            if( !empty( $description ) ) {
                $description = _s_wrap_text( $description, "\n" );
                $description = _s_get_heading( nl2br( $description ), 'h4' );
            }
            
            $heading = sprintf( '<header class="column row">%s%s</header>', $heading, $description );
            
        }
        
        $grid = _s_project_grid( $projects );
        
        
        $output = sprintf( '%s<div class="row small-collapse large-uncollapse"><div class="column">%s</div></div>', $heading, $grid );
        
        // Do not change
                
        _s_section( $output, $attr );
    }

}

function _s_project_grid( $post_ids ) {
    
    if( empty( $post_ids ) ) {
        return false;
    }
        
    $loop = new WP_Query( array(
        'post_type' => 'project',
        'posts_per_page' => -1,
        'post__in' => $post_ids
    ) );
    
    $items = '';
    
    $output = '';
    
    if ( $loop->have_posts() ) : 
    
        while ( $loop->have_posts() ) :
        
            $loop->the_post(); 

            $background = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            if( ! empty( $background ) ) {
                $background = sprintf( ' style="background-image:url(%s);"', $background );
            }
            
            $plus = sprintf( '<a href="%s" class="plus"></a>', get_permalink() );
            
            $title = sprintf( '<h3><a href="%s">%s</a></h3>', get_permalink(), the_title( '', '', false ) );
            $services = _get_project_services();
            $location = _s_get_textarea( get_field( 'location' ), 'p', array( 'class' => 'location' ) );
            
            $details = sprintf( '<div class="hover"><div class="hover"><div class="details">%s%s%s%s</div></div></div>', 
                                $plus, $title, $services, $location );
            
            $aos = array( 
                          'data-aos-anchor' => '#project-grid', 
                          'data-aos' => 'fade', 
                          'data-aos-once' => 'true', 
                          'data-aos-offset' => '300', 
                          'data-aos-delay' => 150 * ( $loop->current_post +1 ) );
            
            $aos_attr = shortcode_parse_args( $aos );
            
            $items .= sprintf( '<div class="grid-item grid-item-%s" %s %s>%s</div>', $loop->current_post +1, $background, $aos_attr, $details );
                        
        endwhile;
        
        $items .= '<div class="grid-sizer"></div>';
        
        $output = sprintf( '<div id="project-grid" class="project-grid">%s</div>', $items );
    
    endif;
    
    wp_reset_query();
    
    return $output;
}

section_projects();



function _get_project_services() {
    
    global $post;
    
    $services = get_field( 'services' );
    
    if( empty( $services ) ) {
        return;
    }
    
    $links = [];
    
    foreach( $services as $service ) {
        $links[] = sprintf( '<a href="%s">%s</a>', get_permalink( $service->ID ), get_the_title( $service->ID ) );
    }
    
    $links = join( ', ', $links );
    
    return sprintf( '<p>%s</p>', $links );
}

