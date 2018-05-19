<?php

/*
Section - Footer CTA
*/

 _s_footer_cta();
function _s_footer_cta() {
	        
    $fields = get_field( 'footer_cta', 'options' );
    
    $editor        = $fields['editor'];
    $button        = $fields['button'];
    
    if( empty( $editor ) ) {
        return;
    }
        
    if( !empty( $button ) ) {
        $button = pb_get_cta_button( $button, array( 'class' => 'button green' ) ); 
    }
		
	$attr = array( 'id' => 'footer-cta', 'class' => 'section-footer-cta' );
					
	_s_section_open( $attr );  
		printf( '<div class="row align-center align-middle"><div class="column shrink">%s</div><div class="column shrink">%s</div></div>', 
                $editor, $button );
	_s_section_close();		
 }