<?php

/*
REX Story
*/

if( ! function_exists( 'section_rex_story' ) ) {
 
    function section_rex_story() {
        
        global $post;
                
        $prefix = 'rex_story';
        $prefix = set_field_prefix( $prefix );
        
        $settings = get_sub_field( sprintf( '%ssettings', $prefix ) );
        
        // Markup attributes              
        $attributes = new Markup_Attributes( $settings );
        $id = $attributes->get('id');
        if(empty( $attributes->get('id') ) ) {
            $attributes->set( 'id', 'rex-story' );
        }
        $attributes->set( 'class', 'section-rex-story' );
        $attr = $attributes->get();
        
        
        $entry_heading = get_sub_field( sprintf( '%sheading', $prefix ) );
        
        if( !empty( $entry_heading ) ) {
            $entry_heading        = _s_get_heading( $entry_heading, 'h2', array( 'class' => 'text-left' ) );
            $entry_heading        = sprintf( '<div class="column row expanded"><header class="entry-header">%s</header></div>', $entry_heading );
        }   
        
        
        $fields = get_sub_field( sprintf( '%ssection', $prefix ) );
              
        $heading        = $fields['heading'];
        $description	= $fields['description'];
        
        $photo          = $fields['background_image'];
        
        $buttons         = $fields['buttons'];
        
        $content = '';
        
         
        if( ! empty( $photo ) ) {
            $photo = _s_get_acf_image( $photo, 'hero', true );
            $photo = sprintf( '<img src="%s" class="rsImg" />', $photo );
        }
        
        if( !empty( $heading ) ) {
            $heading = _s_get_heading( $heading, 'h1' );
        }
        
        if( !empty( $description ) ) {
            $description = _s_wrap_text( $description, "\n" );
            $description = _s_get_textarea( $description );
        }

        $button_group = '';
        
        if( !empty( $buttons ) ) {
            foreach( $buttons as $button ) {
                 $button_group .= pb_get_cta_button( $button['button'], array( 'class' => 'plus' ) ); 
            }
            
            $button_group = sprintf( '<p class="button-group">%s</p>', $button_group );
        }
        
        
        $caption = sprintf( '<div class="caption">%s%s%s</div>', $heading, $description, $button_group );
        
        $slide = sprintf( '<div class="rsContent">%s%s</div>', $photo, $caption );     	
        
        _s_section_open( $attr );	
        
        echo $entry_heading;
           
        printf( '<div id="slider" class="royalSlider rsCustom">%s</div>', $slide );
        
        _s_section_close();
                     
    }
    
}

section_rex_story();
    