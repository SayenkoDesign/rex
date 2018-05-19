<?php

function set_field_prefix( $prefix = '' ) {
	if( empty( $prefix ) ) {
		return '';
	}
	
	$prefix = rtrim( $prefix, '_' );
	
	return $prefix . '_';
}

function _s_wrap_text( $string, $search = '#', $replace = 'span' ) {
	// add span and balance tags
 	$string = force_balance_tags( str_replace( "$search", sprintf('<%s>', $replace), $string ) );
	// remove empty tags
	return str_replace( sprintf('<%1$s></%1$s>', $replace), '', $string );
}

function _s_get_heading( $title, $wrap = 'h2', $attr = array() ) {
	
	if( empty( $title ) ) {
		return false;	
	}
    
    // incase we want to return a raw string
    if( $wrap == '' ) {
        return $title;
    }
	
	$args = array(
		'open'    => "<{$wrap} %s>",
		'close'   => "</{$wrap}>",
		'content' => $title,
		'context' => ' ',
		'attr'    => $attr,
		'params'  => array(
			'wrap'  => $wrap,
		),
		'echo'    => false,
	);
	
	$output =  _s_markup( $args );
	
	return $output;
}


function _s_get_textarea( $text, $wrap = 'p', $attr = array() ) {
	
	if( empty( $text ) ) {
		return false;
	}
	    
    $args = array(
		'open'    => "<{$wrap} %s>",
		'close'   => "</{$wrap}>",
		'content' => $text,
		'context' => ' ',
		'attr'    => $attr,
		'params'  => array(
			'wrap'  => $wrap,
		),
		'echo'    => false,
	);
	
	$output =  _s_markup( $args );
	
	return $output;
}

