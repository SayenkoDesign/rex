<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

<?php
// Hero
get_template_part( 'template-parts/hero', 'program-archive' );


// Add top section
    intro();
    function intro() {
        
        $fields = get_field( 'program_archive', 'options' );
        
        $content  = _s_get_heading( $fields['intro_heading'] );
        $content .= $fields['intro_editor'];
        
        if( empty( $content ) ) {
            return;
        }
        
        $attr = array( 'id' => 'club-intro', 'class' => 'section-intro' );        	
        
        _s_section_open( $attr );	
           
        printf( '<div class="column row"><div class="box">%s</div></div>', $content );
        
        _s_section_close();
        
    }

?>

<div class="column row">

     <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            <?php
             
            if ( have_posts() ) : ?>
    
               <div class="row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="medium" data-equalize-by-row="true">
               
               <?php
                while ( have_posts() ) :
    
                    the_post();
                    
                    
                    printf( '<article id="post-%s" class="%s">', get_the_ID(), join( ' ', get_post_class( 'column column-block' ) ) );
    
                    $background = sprintf( ' style="background-image: url(%s)"', get_the_post_thumbnail_url( get_the_ID(), 'large' ) );
                    $title  = the_title( '<h3>', '</h3>', false );
                    $description  = apply_filters( 'the_content', get_the_excerpt() );
                    $permalink = sprintf( '<p><a href="%s" class="learn-more">%s</a></p>', get_permalink(), 'Learn More' );
                    
                    printf( '<div class="panel"><a href="%s" class="thumbnail"%s>%s</a><div class="entry-content"><div class="description" data-equalizer-watch>%s</div>%s</div></div>', get_permalink(), $background, $title, $description, $permalink );
                    
                    echo '</article>';
    
                endwhile;
                
                ?>
                </div>
                <?php

            endif; ?>
            
            
            <?php
            // Loop Through any additional terms and show them
            $post_type = 'program';
            $taxonomy  = 'program_cat';
            
            $terms = get_terms( $taxonomy );
		
            foreach ( $terms as $term_key => $term ) :
                
                $loop = new WP_Query( array(
                    'post_type' => $post_type,
                    'order' => 'ASC',
                    'orderby' => 'menu_order title',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'slug',
                            'terms' => array( $term->slug ),
                            'operator' => 'IN'
                        )
                    )
                ) );
                
                
                if ( $loop->have_posts() ) : 
                
                    printf( '<h2>%s</h2>', $term->name );
                ?>
    
                   <div class="row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="medium" data-equalize-by-row="true">
                   
                   <?php
                    while ( $loop->have_posts() ) :
        
                        $loop->the_post(); 
                        
                        
                        printf( '<article id="post-%s" class="%s">', get_the_ID(), join( ' ', get_post_class( 'column column-block' ) ) );
        
                        $background = sprintf( ' style="background-image: url(%s)"', get_the_post_thumbnail_url( get_the_ID(), 'large' ) );
                        $title  = the_title( '<h3>', '</h3>', false );
                        $description  = apply_filters( 'the_content', get_the_excerpt() );
                        $permalink = sprintf( '<p><a href="%s" class="learn-more">%s</a></p>', get_permalink(), 'Learn More' );
                        
                        printf( '<div class="panel"><div class="thumbnail"%s>%s</div><div class="entry-content"><div class="description" data-equalizer-watch>%s</div>%s</div></div>', $background, $title, $description, $permalink );
                        
                        echo '</article>';
        
                    endwhile;
                    
                    ?>
                    </div>
                <?php
    
                endif; 
                
                wp_reset_postdata();
            
            endforeach;
            ?>
    
        </main>
    
    </div>
  
</div>

<?php
get_footer();
