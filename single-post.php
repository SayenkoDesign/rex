<?php

get_header(); ?>

<?php
get_template_part( 'template-parts/hero', 'post' );
?>

<div class="row align-center">

    <div class="large-8 columns">
    
        <div id="primary" class="content-area">
        
            <main id="main" class="site-main" role="main">
                <?php
                 
                if ( have_posts() ) : ?>
        
                   <?php
                    while ( have_posts() ) :
        
                        the_post();
        
                        get_template_part( 'template-parts/content', 'post' );
        
                    endwhile;
                    
                    $previous = sprintf( '%s<span class="%s"></span>', 
                                         get_svg( 'arrow' ), __( 'Previous Post', '_s') );
                    
                    $next = sprintf( '%s<span class="%s"></span>', 
                                         get_svg( 'arrow' ), __( 'Next Post', '_s') );
                    
                    the_post_navigation( array( 'prev_text' => $previous, 'next_text' => $next ) );
                    
                else :
        
                    get_template_part( 'template-parts/content', 'none' );
        
                endif; ?>
        
            </main>
        
        </div>
    
    </div>
    
    

</div>

<?php

// section_related_articles();
function section_related_articles() {
    global $post;
    
    $prefix = 'related';
    $prefix = set_field_prefix( $prefix );
    
    $posts = get_field( sprintf( '%sposts', $prefix ) );
    
    if( empty( $posts ) ) {
        return false;
    }
    
    $loop = new WP_Query( array(
        'post_type' => 'post',
        'order' => 'ASC',
        'orderby' => 'post__in',
        'posts_per_page' => -1,
        'post__in' => $posts
    ) );
            
    $items = '';
    
    if ( $loop->have_posts() ) : 
                                
        while ( $loop->have_posts() ) : $loop->the_post();
              
            $items .= _related_article();
 
        endwhile; 
         
    endif;
    
    // Reset things, for good measure
    $loop = null;
    
    wp_reset_postdata();
    
    if( empty( $items ) ) {
        return false;
    }
    
    $attr = array( 'id' => 'blog-articles', 'class' => 'section blog-articles' );
    
    _s_section_open( $attr );
        
        $heading = _s_get_heading( 'Related Articles' );
        printf( '<header class="entry-header">%s</header>', $heading );
                
        printf( '<div class="slick-posts">%s</div>', $items );
    
    _s_section_close();	
        
}


function _related_article() {
    
    $background = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    
    if( !empty( $background ) ) {
        $background = sprintf( ' style="background-image: url(%s);"', $background );
    }
    
          
    $title = sprintf( '<h3>%s</h3>', get_the_title() );
                      
    $excerpt = _s_get_the_excerpt( '', '', 20 );
    
    $button = sprintf( '<p><a href="%s" class="button blue">See Article</a></p>', 
                      get_permalink() );
                      
    $description = sprintf( '<div class="hover">%s%s</div>', $excerpt, $button );
     
    return sprintf( '<div class="post"><div class="background" %s></div><div class="details">%s%s</div></div>', $background, $title, $description );   
}
?>

<?php
get_footer();
