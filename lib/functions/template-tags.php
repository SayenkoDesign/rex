<?php

/**
 * Load a template part into a template
 *
 * Makes it easy for a theme to reuse sections of code in a easy to overload way
 * for child themes.
 *
 * Includes the named template part for a theme or if a name is specified then a
 * specialised part will be included. If the theme contains no {slug}.php file
 * then no template will be included.
 *
 * The template is included using require, not require_once, so you may include the
 * same template part multiple times.
 *
 * For the $name parameter, if the file is called "{slug}-special.php" then specify
 * "special".
 *
 *
 * @param string      $slug The slug name for the generic template.
 * @param null|string $name
 * @param array       $data optional array of vars to inject into the template part
 * @param boolean     $return Whether to return or output the template
 */
function _s_get_template_part( $slug, $name = null, $data = array(), $return = false ) {
    
    do_action( "get_template_part_{$slug}", $slug, $name );
     
    $name = (string) $name;
	if ( '' !== $name )
		$templates[] = "{$slug}-{$name}.php";

	$templates[] = "{$slug}.php";
    
    if( is_array( $data ) ) {
        extract( $data );
    }
    
    // Return instead of echo
    if( $return ) {
        
        ob_start();
        include( locate_template( $templates ) );
        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
    }
        
    include( locate_template( $templates ) );
    
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s
 */

if ( ! function_exists( '_s_get_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _s_get_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', '_s' ),
		$time_string
	);

	return '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;




if ( ! function_exists( '_s_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _s_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
		if ( $categories_list && _s_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', '_s' ) );
		if ( $tags_list ) {
						printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_s' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', '_s' ), esc_html__( '1 Comment', '_s' ), esc_html__( '% Comments', '_s' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', '_s' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _s_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_s_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( '_s_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so _s_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so _s_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in _s_categorized_blog.
 */
function _s_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( '_s_categories' );
}
add_action( 'edit_category', '_s_category_transient_flusher' );
add_action( 'save_post',     '_s_category_transient_flusher' );

 

/**
 * Limit the excerpt.
 *
 * @param  int     $num_words  The word limit.
 * @param  string  $more       The "read more" text.
 *
 * @return string              The shortened excerpt.
 */
//* Get the post excerpt

function _s_the_excerpt( $more, $read_more, $length ) {
	echo _s_get_the_excerpt( $more, $read_more, $length );
}

function _s_get_the_excerpt( $more = '', $read_more = '', $length = 40 ) {
	
	global $post;
		
	$post_content = $post->post_content;
    $post_excerpt = $post->post_excerpt;
	
	return _s_maybe_get_excerpt( $post_content, $post_excerpt, $more, $read_more, $length );
}


function _s_maybe_get_excerpt( $post_content, $post_excerpt, $more = '<span class="meta-nav">&#8230;</span>', $read_more = 'read more', $length = 40 ) {
	
	$out = '';
                    
    if( strstr( $post_content,'<!--more-->') ) {
        $content_arr = get_extended ( $post_content );
		$excerpt = sprintf( '%s%s', $content_arr['main'], $more );
    }
    elseif( $post_excerpt ) {
        $excerpt = sprintf( '%s%s', $post_excerpt, $more );
    }
    else {
        $excerpt = wp_trim_words( $post_content, $length, $more );
    }
	
	                    
   	if( $read_more ) {
		$out =  wpautop( sprintf( '%s <a href="%s">%s</a>', $excerpt, get_permalink(), $read_more ) );
	}	
	else {
		$out =  wpautop( $excerpt );
	}
	
	
	return $out;
}


/**
 * Echo an image, no matter what.
 *
 * @param string  $size  The image size you want to display.
 */
function _s_do_post_image( $size = 'thumbnail' ) {

	// If featured image is present, use that
	if ( has_post_thumbnail() ) {
		return the_post_thumbnail( $size );
	}

	// Check for any attached image
	$media = get_attached_media( 'image', get_the_ID() );
	$media = current( $media );

	// Set up default image path
	$media_url = get_stylesheet_directory_uri() . '/images/placeholder.png';

	// If an image is present, then use it
	if ( is_array( $media ) && 0 < count( $media ) ) {
		$media_url = ( 'thumbnail' === $size ) ? wp_get_attachment_thumb_url( $media->ID ) : wp_get_attachment_url( $media->ID );
	}

	echo '<img src="' . esc_url( $media_url ) . '" class="attachment-thumbnail wp-post-image" alt="' . esc_html( get_the_title() )  . '" />';
}

/**
 * Return an image URI, no matter what.
 *
 * @param  string  $size  The image size you want to return.
 * @return string         The image URI.
 */
function _s_get_post_image_uri( $size = 'thumbnail' ) {

	// If featured image is present, use that
	if ( has_post_thumbnail() ) {

		$featured_image_id = get_post_thumbnail_id( get_the_ID() );
		$media = wp_get_attachment_image_src( $featured_image_id, $size );

		if ( is_array( $media ) ) {
			return current( $media );
		}
	}

	// Check for any attached image
	$media = get_attached_media( 'image', get_the_ID() );
	$media = current( $media );

	// Set up default image path
	$media_url = get_stylesheet_directory_uri() . '/images/placeholder.png';

	// If an image is present, then use it
	if ( is_array( $media ) && 0 < count( $media ) ) {
		$media_url = ( 'thumbnail' === $size ) ? wp_get_attachment_thumb_url( $media->ID ) : wp_get_attachment_url( $media->ID );
	}

	return $media_url;
}



// Convert phone number field to tel: link
function _s_format_telephone_url( $number = false ) {
    
    if( empty( $number ) ) {
        return;
    }
    
	return sprintf( 'tel:%s', preg_replace( '/[^0-9]/','', $number ) );
}