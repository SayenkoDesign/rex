<?php

/**
 * Module - Grid
 *
 *
 * @param string $prefix - ACF clone prefix
 *
 * @return formatted list
 */
function kr_module_get_grid( $prefix = '', $post_id = false ) {
	
	$prefix = set_field_prefix( $prefix );
		
	$grid = _kr_module_get_grid_items( $prefix );
	
	if( empty( $grid ) ) {
		return false;
	}
	
	return sprintf( '<ul class="list">%s</ul>', $grid );
}

//* get list items
function _kr_module_get_grid_items( $args = '' ) {
	
	// Just incase this isn't an array
	if( !is_array( $args ) ) {
		$args = array( 'prefix' => $args );
	}
    	
	$prefix = set_field_prefix( $prefix );
	
	$rows = get_field( sprintf( '%sgrid', $prefix ), $post_id );
		
	$list_items = _kr_grid_items( $rows, $args );
    
    if( $ret == 'string' ) {
		return implode( '', $list_items );
	}
	
	return $list_items;
}


function _kr_grid_items( $rows, $args = array() ) {
    
    if( empty( $rows ) ) {
		return;
	}
	
    
    $defaults = array(
		'prefix' => '',
		'ret' => 'string',
		'image_size' => 'large',
		'title_position' => 'after',
		'title_tag' => 'h3',
		'show_link' => false,
		'target' => 'target="_blank"',
		'post_id' => false
	);
    
    $args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	foreach ($rows as $row) {
		if( isset( $row['photo'] ) && !empty( $row['photo'] ) )
		$ids[] = $row['photo'];
	}
	
	if( !empty( $ids ) ) {
		$cache = get_posts(array('post_type' => 'attachment', 'numberposts' => -1, 'post__in' => $ids));
	}
		
	$list_items = array();
	
	foreach( $rows as $row ) {
				
		$photo = isset(  $row['grid_photo'] ) ? $row['grid_photo']: '';
				
		if( $photo ) {
			
			if( wp_is_mobile() ) {
				$image_size = 'thumbnail';
			}
			
			$photo = sprintf( '<div class="thumbnail">%s</div>', wp_get_attachment_image( $photo, $image_size ) );
		}
		
		$title = !empty(  $row['grid_title'] ) ? sprintf( '<%1$s>%2$s</%1$s>', $title_tag, $row['grid_title'] ) : '';
		$title_before = $title_after = $title;
 		if( $title_position == 'before' ) {
			$title_after = '';
		} else {
			$title_before = '';
		}
		
		$description = isset(  $row['grid_description'] ) ? $row['grid_description']: '';
		
		$anchor_open = $anchor_close = '';
		$url = isset(  $row['grid_url'] ) ? $row['grid_url']: '';
		
		if( !empty( $url ) && $show_link ) {
			$anchor_open = sprintf( '<a href="%s" %s>', $url, $target );
			$anchor_close = '</a>';
		}
		
		$list_items[] = sprintf( '<div class="column">%s%s%s%s%s%s</div>', $title_before, $anchor_open, $photo, $anchor_close, $title_after, $description );
	}
	
	return $list_items;
}