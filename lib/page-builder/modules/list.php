<?php

/**
 * Module - List
 *
 *
 * @param string $prefix - ACF clone prefix
 *
 * @return formatted list
 */
function kr_module_get_list( $prefix = '' ) {
	
	$prefix = set_field_prefix( $prefix );
	
	$rows = get_field( sprintf( '%slist', $prefix ) );
		
	if( empty( $rows ) ) {
		return;
	}
	
	$list_items = _kr_get_list_items( $prefix );
	
	return sprintf( '<ul class="list">%s</ul>', $list_items );
}

//* get list items
function _kr_get_list_items( $args = array() ) {
	
	// Just incase this isn't an array
	if( !is_array( $args ) ) {
		$args = array( 'prefix' => $args );
	}
	
	$defaults = array(
		'prefix' => '',
		'ret' => 'string',
 		'title_tag' => '',
 	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	$prefix = set_field_prefix( $prefix );
	
	$rows = get_field( sprintf( '%slist', $prefix ) );
		
	if( empty( $rows ) ) {
		return;
	}
	
	$list_items = array();
	
	foreach( $rows as $row ) {
		
        $list_title = $row['list_title'];
        
        $anchor_open = '';
        $anchor_close = '';
        
        if( !empty( $row['list_page'] ) || !empty( $row['list_url'] ) ) {
                        
            if( !empty( $row['list_page'] ) ) {
                $link = $row['list_page'];
            }
            
            if( !empty( $row['list_url'] ) ) {
                $link = $row['list_url'];
            }
            
            $anchor_open = sprintf( '<a href="%s">', $link );
            $anchor_close = '</a>';
            
        }
		
        if( !empty( $list_title ) ) {
			$list_title = sprintf( '%s%s%s', $anchor_open, _s_get_heading( $list_title, $title_tag ), $anchor_close );
		}
		$list_description = isset(  $row['list_description'] ) ? $row['list_description']: '';
		
		$list_items[] = sprintf( '<li>%s%s</li>', $list_title, $list_description );
	}
	
	if( $ret == 'string' ) {
		return implode( '', $list_items );
	}
	
	return $list_items;
}