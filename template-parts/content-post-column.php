<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php        
    $post_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    if( !empty( $post_image ) ) {
        $post_image = sprintf( 'background-image: url(%s);', $post_image );
    }        
    $post_title = sprintf( '<h3><a href="%s">%s</a></h3>', get_permalink(), get_the_title() );

    printf( '<div class="post-hero" style="%s"></div>', $post_image );
                
        
	?>
	
	<div class="entry-content" data-equalizer-watch>
	
		<?php 
	
        printf( '<header class="entry-header">%s</header>', $post_title );
        
        _s_the_excerpt( '', '', 80 );       
		?>
		
	</div><!-- .entry-content -->
    
    <footer class="entry-footer">
        <?php 
        printf( '<p class="read-more"><a href="%s" class="more">%s</a></p>', get_permalink(), __( 'Read More', '_s' ) ) ;
        ?>         
	</footer><!-- .entry-footer -->
    
</article><!-- #post-## -->
