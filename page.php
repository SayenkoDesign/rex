<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
	<?php
 	// Default
	section_default();
	function section_default() {
				
		global $post;
		
		$attr = array( 'class' => 'section default' );
		
		_s_section_open( $attr );		
		
		print( '<div class="column row">' );
		
		while ( have_posts() ) :

			the_post();
            
            printf( '<header>%s</header>', the_title( '<h1>', '</h1>', false ) );
			
            echo '<div class="entry-content">';
            
			the_content();
            
            echo '</div>';
				
		endwhile;
		
		print( '</div>' );
		_s_section_close();	
	}
	?>
	</main>


</div>

<?php
get_footer();
