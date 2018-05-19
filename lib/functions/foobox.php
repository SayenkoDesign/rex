<?php
// Foobox Gallery

add_image_size( 'foobox-thumbnail', 400, 400, true ); // 1140 x 100 upload @ 2280 x 369
add_image_size( 'foobox-large', 1200, 1200 ); // 1140 x 100 upload @ 2280 x 369
add_image_size( 'foobox-mobile', 600, 600 ); // 1140 x 100 upload @ 2280 x 369

function get_foobox_gallery( $args = array() ) {
	
	$defaults = array(
		'photos' => false,
		'show_captions' => false,
		'thumbnail_size' => 'foobox-thumbnail', 
		'default_size' => 'foobox-large', 
		'mobile_size' => 'foobox-mobile',
		'num' => 9,
		'orderby' => false
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	static $gallery_num;
	
	$gallery_num++;
										
	if( empty( $photos ) )
		return FALSE;
		
	$size = $default_size;
															
	if( wp_is_mobile() ) {
		$size = $mobile_size;
	}
					
	$items = '';
		
	foreach( $photos as $photo ):
		
		$attachment_id = $photo['ID'];
		$img = sprintf( '<div class="lazyload" ><!--%s--></div>', wp_get_attachment_image( $attachment_id, 'foobox-thumbnail', '', '' ) );
		$items .= sprintf(
					'<li class="gallery-item"><a href="%s" title="%s" class="foobox" rel="fb-%s">%s</a></li>', 
				  	$photo['sizes'][$size], 
				  	esc_html( $photo['caption'] ), 
				  	$gallery_num, $img );
	
	endforeach;
	
    return sprintf('<div class="row small-up-1 medium-up-3 large-up-2 gallery">%s</div>', $items );

}



// =======================================================================//
// Foundation 6 Gallery
// =======================================================================//

// add_filter( 'post_gallery', 'f5_gallery', 10, 2 );

function f5_gallery( $output, $attr ) {
	global $post;
	
	/*
	if ( isset( $attr['type'] ) && $attr['type'] == 'sponsors' ) {
		f5_sponsors_gallery( $output, $attr );
	}
	*/

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	extract( shortcode_atts( array(
		'order'   => 'ASC',
		'orderby' => 'menu_order ID',
		'id'      => $post->ID,
		'columns' => 3,
		'size'    => 'thumbnail',
		'include' => '',
		'exclude' => '',
	), $attr ) );


	$id = intval( $id );
	if ( 'RAND' === $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$include         = preg_replace( '/[^0-9,]+/', '', $include );
		$attachments_arr = get_posts( array(
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
		) );

		$attachments = array();
		foreach ( $attachments_arr as $key => $val ) {
			$attachments[ $val->ID ] = $attachments_arr[ $key ];
		}
	}

	if ( empty( $attachments ) ) {
		return '';
	}
	
	$classes = 'gallery';
	
	if( $size == 'logo' ) {
		$classes = 'sponsors';
	}
	
	$output = sprintf( '<div class="row small-up-2 medium-up-%s %s">', $columns, $classes );

	foreach ( $attachments as $id => $attachment ) {
		$img     = wp_get_attachment_image_src( $id, $size );
		$img_big = wp_get_attachment_image_src( $id, 'full' );
		$link    = get_field( 'custom_link', $id );
		
		$caption = ( ! $attachment->post_excerpt ) ? '' :  esc_attr( $attachment->post_excerpt ) ;
		
		if( $size == 'logo' && $link != '' ) {
			$output .= sprintf( '<div class="column"><a href="%s" title="%s" target="_blank"><img src="%s" alt="%s" /></a></div>', $link, $caption, $img[0], esc_attr( $post->title ) );
		}
		else {
			$output .= sprintf( '<div class="column"><a href="%s" title="%s"><img src="%s" title="" alt="%s" /></a></div>', $img_big[0], $caption, $img[0], esc_attr( $post->title ) );
		}

	}

	$output .= '</div>';

	return $output;
}