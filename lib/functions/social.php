<?php
global $social_profiles;

 
/**
 * Echo social icons.
 */
function _s_get_social_icons( $profiles = array(), $post_id = 'options' ) { 

	if( !is_array( $profiles ) || empty( array_filter( $profiles ) ) ) {
		
        // defaults
        $profiles = array( 
              'linkedin' => get_field( 'linkedin', 'options' ),
              'facebook' => get_field( 'facebook', 'options' ),
              'twitter' => get_field( 'twitter', 'options' ),
              'instagram' => get_field( 'instagram', 'options' ),
              'youtube' => get_field( 'youtube', 'options' ),
         );
  	}
    
    $profiles = array_filter( $profiles );
    
    if( empty( $profiles ) ) {
        return false;
    }
 	
	$out = '';
	
	foreach( $profiles as $type => $url ) {
		
        $icon = get_svg( $type );
        
        if( !empty( $icon ) ) {
			$out .= sprintf( '<li class="social-icon"><a href="%s" title="%s">%s</a></li>', $url, ucwords( $type ), $icon );
		}
	}
	
	return sprintf( '<ul class="social-icons">%s</ul>', $out );

 }
 
 
 function _s_do_social_icons( $profiles = array() ) { 
	if( !empty( $profiles ) ) {
		echo _s_get_social_icons( $profiles );
	}
	
 }
 
 add_shortcode( 'social-icons', '_s_get_social_icons' );
 
 
 
 function get_icon( $type ) {
     
     $icons = array( 
     
        'facebook' => '<i class="fa fa-facebook-square" aria-hidden="true"></i>',
        
        'twitter' => '<i class="fa fa-twitter-square" aria-hidden="true"></i>',
        
        'instagram' => '<i class="fa fa-instagram" aria-hidden="true"></i>'
     
     );
     
     if( isset( $icons[ $type ] ) )
        return $icons[ $type ];
 }