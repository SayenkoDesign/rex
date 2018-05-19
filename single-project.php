<?php

get_header(); ?>

<?php
get_template_part( 'template-parts/project', 'hero' );
?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">
        <?php
         
        if ( have_posts() ) : ?>

           <?php
            while ( have_posts() ) :

                the_post();
                
                echo '<div class="entry-content"><div class="row large-unstack">';
                
                echo '<div class="large-7 columns">';
                
                the_title( '<h2>', '</h2>' );
                  
                // Location
                $location = get_field( 'location' );
                $location = sprintf( '<div class="column"><h5>Location</h5>%s</div>', $location );
                
                $services = sprintf( '<div class="column"><h5>Services</h5>%s</div>', _get_project_services() );
                
                printf( '<div class="row small-up-1 medium-up-2">%s%s</div>', $location, $services );
                
                echo '<hr />';
                
                echo '<div class="details">';
                
                the_content();
                
                echo '</div>';
                
                echo '</div>';
                
                printf( '<div class="columns">%s</div>', _project_gallery() );
                
                echo '</div></div>';
                
                get_template_part( 'template-parts/service', 'testimonials' );

            endwhile;
                                
        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

    </main>

</div>


<?php

function _project_gallery() {
    
    global $post;
    
    $photos = get_field( 'gallery' );
    
    $items = '';
    
    foreach( $photos as $key => $photo ):
		
		$attachment_id = $photo['ID'];
        $thumbnail = wp_get_attachment_image_src( $attachment_id, 'medium' );
		$thumbnail = sprintf( '<div class="photo" style="background-image: url(%s);"></div>', $thumbnail[0] );
        $img       = wp_get_attachment_image_src( $attachment_id, 'large' );
		$items .= sprintf(
					'<div class="column"><a href="%s" title="%s" class="foobox" rel="fb-%s">%s</a></div>', 
				  	$img[0],
                    esc_html( $photo['caption'] ), 
				  	$key, 
                    $thumbnail 
                    );
	
	endforeach;
	
    return sprintf('<div class="row small-collapse small-up-1 medium-up-3 large-up-2 gallery">%s</div>', $items );
    
}

function _get_project_services() {
    
    global $post;
    
    $services = get_field( 'services' );
    
    if( empty( $services ) ) {
        return;
    }
    
    $links = [];
    
    foreach( $services as $service ) {
        $links[] = sprintf( '<li><a href="%s">%s</a></li>', get_permalink( $service->ID ), get_the_title( $service->ID ) );
    }
    
    $links = join( '', $links );
    
    return sprintf( '<ul class="services">%s</ul>', $links );
}


get_footer();
