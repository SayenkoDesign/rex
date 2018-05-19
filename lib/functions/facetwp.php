<?php

function my_facetwp_pager_html( $output, $params ) {
    $output = '';
    $page = $params['page'];
    $total_pages = $params['total_pages'];
    
    $previous = sprintf( '%s<span class="screen-reader-text">%s</span>', 
                                     get_svg( 'arrow' ), __( 'Previous', '_s') );
                
    $next = sprintf( '%s<span class="screen-reader-text">%s</span>', 
                         get_svg( 'arrow' ), __( 'Next', '_s') );
    
    if ( $page > 1 ) {
        $output .= sprintf( '<a class="facetwp-page previous" data-page="%s">%s</a>', ($page - 1), $previous );
    }
    if ( $page < $total_pages && $total_pages > 1 ) {
        $output .= sprintf( '<a class="facetwp-page next" data-page="%s">%s</a>', ($page + 1), $next );
    }
    return $output;
}

add_filter( 'facetwp_pager_html', 'my_facetwp_pager_html', 10, 2 );