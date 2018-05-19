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
	
	<div class="entry-content">
	
		<?php 
		the_content(); 		
		?>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
        
        <?php   			
        printf( '<h4 class="text-left">%s</h4>', __( 'Share This:', '_s' ) );
        
        printf( '<div class="column row">%s</div>', _s_get_addtoany_share_icons() );
        ?>   
              
	</footer><!-- .entry-footer -->
    
</article><!-- #post-## -->
