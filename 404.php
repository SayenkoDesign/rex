<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _s
 */

get_header(); ?>

<?php
// Hero
page_404_hero();
function page_404_hero() {
        
    $post_id = 'options';    

    $fields = get_field( 'hero_404', 'options' );
    
    if( empty( $fields ) ) {
        return;
    }
          
    $heading 		= $fields['heading'];
    $description	= $fields['description'];
    
    $background_image       = $fields['background_image'];
    $background_position_x  = $fields['background_position_x'];
    $background_position_y  = $fields['background_position_y'];
    $hero_overlay           = $fields['overlay'];
    $hero_overlay           = $hero_overlay ? ' hero-overlay' : '';
        
    $style = '';
    $content = '';
     
    if( !empty( $background_image ) ) {
        $attachment_id = $background_image;
        $size = 'hero';
        $background = wp_get_attachment_image_src( $attachment_id, $size );
        $style = sprintf( 'background-image: url(%s);', $background[0] );
        
        if( !empty( $style ) ) {
            $style .= sprintf( ' background-position: %s %s;', $background_position_x, $background_position_y );
        }
    }
    
    
    if( !empty( $heading ) ) {
        $content .= _s_get_heading( $heading, 'h1' );
    }
    
    
    if( !empty( $description ) ) {
        $description = _s_wrap_text( $description, "\n" );
        $description = _s_get_heading( nl2br( $description ), 'h3' );
        $content .= $description;
     }

    $attr = array( 'id' => 'hero', 'class' => 'section hero flex', 'style' => $style );
    
    $attr['class'] .= $hero_overlay;
        
    
    _s_section_open( $attr );	
       
    printf( '<div class="column row"><div class="entry-content">%s</div></div>', $content );
    
     _s_section_close();
     
     printf( '<div class="wave-bottom show-for-medium">%s</div>', get_svg( 'wave-bottom' ) );
        
}


?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
	
		<section class="section-default">
			<div class="column row">
	
				<div class="entry-content">
					<p><?php echo get_field( 'content_404', 'option' ); ?></p>
				</div><!-- .page-content -->
				
				</div>
		</section>

	</main><!-- #main -->

</div><!-- #primary -->

	

<?php
get_footer();
