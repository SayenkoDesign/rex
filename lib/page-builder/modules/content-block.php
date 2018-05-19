<?php

function kr_module_get_content_block( $prefix = '', $wrap = 'div', $attr = array() ) {
		
	$prefix = set_field_prefix( $prefix );
    
    $photo = get_post_meta( get_the_ID(), sprintf( '%sphoto', $prefix ), true );
	if( $photo ) {
		$photo = wp_get_attachment_image( $photo, 'full' );
	}
		
	$heading = get_post_meta( get_the_ID(), sprintf( '%sheading', $prefix ), true );
	$heading = _s_get_heading( $heading );
					
	$content = get_post_meta( get_the_ID(), sprintf( '%scontent', $prefix ), true );
	$content = _s_get_textarea( $content );
      
    $content = sprintf( '%s%s%s', $photo, $heading, $content );
    
    if( false == $wrap ) {
        return $content;
    }
    
    $args = array(
		'open'    => "<{$wrap} %s>",
		'close'   => "</{$wrap}>",
		'content' => $title,
		'context' => 'entry-content',
		'attr'    => $attr,
		'params'  => array(
			'wrap'  => $wrap,
		),
		'echo'    => false,
	);
	
	return  _s_markup( $args );
	
}