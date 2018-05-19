<?php

// Make sure attachments don't conflict with post type permalinks
//add_filter( 'wp_unique_post_slug', '_s_unique_post_slug', 10, 6 );
function wpse17916_unique_post_slug( $slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug ) {
  
    global $wp_post_types;
    $post_types = [];
    foreach ( $wp_post_types as $type ) {
        if( isset( $type->rewrite['slug'] ) ) {
            $post_types[] = $type->rewrite['slug'];
        }
    }
    
    if( empty( $post_types ) ) {
        return $slug;
    }
      
    if ( 'attachment' == $post_type ) {
        if( in_array( $original_slug, $post_types ) ) {
            $slug = $original_slug . uniqid( '-' );
        }
    }
    
    return $slug;
}


// Enable the Styles dropdown menu item
// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');
// end of part I


// Add the Button CSS to the Dropdown Menu
// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {

    // Define the style_formats array
    $style_formats = array(
    
    // Each array child is a format with it's own settings
    array(
        'title' => 'Button',
        'selector' => 'a',
        'classes' => 'button green',
        )
    );
    
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}

// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
// end of part II