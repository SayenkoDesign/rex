<?php

function _s_parse_section_settings( $settings ) {
    
    _deprecated_function( __FUNCTION__, '2.0' );
    
}

if( ! function_exists( '_s_section' ) ) {
 
    function _s_section( $content = '', $attr = array() ) {
                
        if( empty( $content ) ) {
            return;
        }
         
        static $counter;
        $counter++;
                
        $defaults = array(
            'id' => sprintf( 'section-%s', $counter ),
            'class' => array(),
            'style' => array()
        );
        
        // Parse default attributes
        $attr = wp_parse_args( $attr, $defaults );
        
        _s_section_open( $attr );
           
        echo $content;
        
        _s_section_close();
                     
    }
    
}






function _s_section_open( $attr ) {
		
	$args = array(
		'html5'   => '<section %s>',
		'context' => 'section',
		'attr' => $attr,
		'echo' => false
	);
	
	$out = _s_markup( $args );
	
	$out .= _s_structural_wrap( 'open', false );
	
	echo $out;
}

function _s_section_close() {
	$out = _s_structural_wrap( 'close', false );
	$out .= '</section>';
	echo $out;
}

/**
 * Potentially echo or return a structural wrap div.
 *
 * A check is made to see if the `$context` is in the `_s-structural-wraps` theme support data. If so, then the
 * `$output` may be echoed or returned.
 *
 * @since 1.6.0
 *
 * @param string $context The location ID.
 * @param string $output  Optional. The markup to include. Can also be 'open'
 *                        (default) or 'closed' to use pre-determined markup for consistency.
 * @param boolean $echo   Optional. Whether to echo or return. Default is true (echo).
 *
 * @return string Wrap HTML.
 */
function _s_structural_wrap( $output = 'open', $echo = true ) {
	
	$context = 'wrap';
	
	switch ( $output ) {
		case 'open':
			$output = sprintf( '<div %s>', _s_attr( $context ) );
			break;
		case 'close':
			$output = '</div>';
			break;
	}


	if ( $echo )
		echo $output;
	else
		return $output;

}