<?php

get_header(); ?>

<?php
get_template_part( 'template-parts/service', 'hero' );
?>

<div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">
        <?php
         
        if ( have_posts() ) : ?>

           <?php
            while ( have_posts() ) :

                the_post();
                
                echo '<div class="column row"><div class="entry-content">';
                        
                the_content();
                
                echo '</div></div>';
                
                get_template_part( 'template-parts/service', 'process' );
                
                get_template_part( 'template-parts/service', 'project' );
                
                get_template_part( 'template-parts/service', 'testimonials' );

            endwhile;
                                
        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

    </main>

</div>


<?php
get_footer();
