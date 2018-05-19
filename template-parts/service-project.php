<?php

/*
REX Story
*/

if( ! function_exists( 'service_project' ) ) {
 
    function service_project() {
        
        global $post;
                
        // Markup attributes              
        $attributes = new Markup_Attributes();
        $attributes->set( 'class', 'section-project' );                
        
        $fields = get_field( 'project' );
        
        if( empty( $fields ) ) {
            return;
        }
        
        $background  = $fields['background'];        
        
        $project = $fields['post'];
                
        $attr = $attributes->get();  	
        
        _s_section_open( $attr );	
        
        if( ! empty( $background ) ) {
            $size = 'hero';
            $background = wp_get_attachment_image_src( $background, $size );
            $background = sprintf( ' style="background-image: url(%s);"', $background[0] );
            printf( '<div class="project-background"%s></div>',$background );
        }
        
        $thumbnail = get_the_post_thumbnail_url( $project->ID );
         $style = '';
        if( !empty( $thumbnail ) ) {
            $style = sprintf( ' style="background-image: url(%s);"', $thumbnail );
        }
 
        $button = sprintf( '<div class="plus"><span>%s</span></div>', 'view project' );
        
        $thumbnail = sprintf( '<a href="%s" class="thumbnail"%s>%s</a>', get_permalink( $project->ID ), $style, $button ) ;
                   
        $details = sprintf( '<div class="details"><h3><a href="%s">%s</a></h3>%s</div>', 
                            get_permalink( $project->ID ), get_the_title( $project->ID ), apply_filters( 'pb_the_content', $project->post_excerpt ) );          
                   
        printf( '<div class="project-details"><div class="column row">%s%s</div></div>', $thumbnail, $details );
        
        _s_section_close();
                     
    }
    
}

service_project();
    