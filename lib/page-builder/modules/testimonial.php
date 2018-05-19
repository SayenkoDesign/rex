<?php

function get_module_testimonial( $prefix = '' ) {
	
	$prefix = set_field_prefix( $prefix );
	
	$out = '';
		
	$text = get_post_meta( get_the_ID(), sprintf( '%sblock_quote_text', $prefix ), true );
	if( !empty( $text ) )
		$out = sprintf( '<div class="quote">%s</div>', _s_get_textarea( $text ) );
		
	$name = get_post_meta( get_the_ID(), sprintf( '%sblock_quote_name', $prefix ), true );
	if( !empty( $name ) ) {
		$out .= sprintf( '<p class="name">%s</p>', get_post_meta( get_the_ID(), sprintf( '%sblock_quote_name', $prefix ), true ) );
	}
	
	if( empty( $out ) ) {
		return false;
	}
		
	return sprintf( '<div class="entry-content">%s</div>', $out );	
}


function get_module_provider_testimonial( $prefix = '' ) {
 
	$prefix = set_field_prefix( $prefix );
	
	$right_column = $left_column = '';
	
	// important use get_post_meta to get raw field value from oembed
	$provider_video = get_post_meta( get_the_ID(), sprintf( '%sprovider_video', $prefix ), true );
	$provider_video_thumbnail = '';
	$custom_video_thumbnail = get_post_meta( get_the_ID(), sprintf( '%sprovider_video_custom_thumbnail', $prefix ), true );
	$provider_video_link = '';
		
	if( empty( $provider_video ) ) {
		return false;	
		
	}
				
	// provider title
	$provider_testimonial_title = get_post_meta( get_the_ID(), sprintf( '%sprovider_testimonial_title', $prefix ), true );
	$provider_testimonial_title = _s_get_heading( $provider_testimonial_title );
			
	// provider text
	$provider_testimonial = get_post_meta( get_the_ID(), sprintf( '%sprovider_testimonial_text', $prefix ), true );
	$provider_testimonial = _s_get_textarea( $provider_testimonial );
	
	// provider video link text
	$provider_video_link_text = get_post_meta( get_the_ID(), sprintf( '%sprovider_video_link_text', $prefix ), true );
	if( !empty( $provider_video_link_text ) ) {
		$provider_video_link = sprintf( '<p><a href="%s" class="video-link external foobox" rel="foobox">%s</a></p>', $provider_video, $provider_video_link_text );
	}
	
	// provider video - if no video let's not show section
	$provider_video_thumbnail = sprintf( '<img src="%s" />', get_vimeo_thumb( $provider_video ) );
	
	// custom video thmbnail?
	if( !empty( $custom_video_thumbnail ) ) {
		
		$attachment_id = $background_image;
		$size = 'large';
	
		// Add check for mobile size
		$provider_video_thumbnail = wp_get_attachment_image( $attachment_id, $size );
		
	}
	
	$provider_video_thumbnail = sprintf( '<a href="%s" class="video-link foobox" rel="foobox"><i class="video-play"></i>%s</a>', $provider_video, $provider_video_thumbnail );
	
	
	// provider name
	$provider_name = get_post_meta( get_the_ID(), sprintf( '%sprovider_name', $prefix ), true );
	if( !empty( $provider_name ) ) {
		$provider_name = sprintf( '<h4>%s</h4>', $provider_name );
	}
	
	// provider specialties
	$provider_specialties = get_post_meta( get_the_ID(), sprintf( '%sprovider_specialties', $prefix ), true );
	if( !empty( $provider_specialties ) ) {
		$provider_specialties = sprintf( '<div class="provider-specialties">%s</div>', wpautop( $provider_specialties ) );
	}
	
	// left column
	$left_column = sprintf( '<div class="small-12 large-7 columns"><div class="entry-content left-content">%s%s%s</div></div>', $provider_testimonial_title, $provider_testimonial,  $provider_video_link );
	
	
	// right column		
	$right_column = sprintf( '<div class="small-12 large-5 columns"><div class="entry-content right-content">%s%s%s</div></div>', $provider_video_thumbnail, $provider_name, $provider_specialties );
	
	return sprintf( '<div class="row">%s%s</div>', $left_column, $right_column );
}