<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>

</div><!-- #content -->

<?php
get_template_part( 'template-parts/section', 'footer-cta' );
  
?>


<div class="footer-widgets">

    <div class="wrap">
        <div class="row large-unstack">
        
            <div class="columns small-order-2 large-order-1">
            <?php
            if( is_active_sidebar( 'footer-1') ){
                dynamic_sidebar( 'footer-1' );
            }
            ?>
            </div>
            
            <div class="columns small-order-1 large-order-2">
            <?php
            if( is_active_sidebar( 'footer-2') ){
                dynamic_sidebar( 'footer-2' );
            }
            ?>
            </div>
            
            <div class="columns small-order-3">
            <?php
            if( is_active_sidebar( 'footer-3') ){
                dynamic_sidebar( 'footer-3' );
            }
            ?>
            </div>            
        
        </div>
    </div>

</div>

<footer id="colophon" class="site-footer" role="contentinfo">
     <div class="wrap">
        
        <div class="row">
                <div class="column text-center">
                <?php
                printf( '<p>&copy; %s Rex Electric & Technologies.</p>', date( 'Y' ) );
                
                ?>
				</div>
		</div>
	</div>
    
 </footer><!-- #colophon -->

<?php 
 
wp_footer(); 
?>
</body>
</html>
