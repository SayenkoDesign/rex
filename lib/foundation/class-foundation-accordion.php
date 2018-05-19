<?php

// Foundation Accordion


class Foundation_Accordion extends Foundation {
    
    var $accordion_items;
    
    public function __construct() {
        parent::__construct();
	}
    
    
    public function add_item( $title = '', $content = '', $active = false ) {
		$this->accordion_items[] = array( 'title' => $title, 'content' => $content, 'active' => $active );
	}


	public function get_accordion( $items = '' ) {

		$accordion_content = '';
         
        if ( empty( $items ) ) {
			$items = $this->accordion_items;
		}

		if ( empty( $items ) ) {
			return false;
		}

		foreach ( $items as $item ) {

			$title   = $item['title'];
			$content = $item['content'];
			$active  = $item['active'];

			if ( ! empty( $title ) && ! empty( $content ) ) {
				$accordion_title   = sprintf( '<a href="#" class="accordion-title"><h4>%s</h4></a>', $title );
				$is_active         = ( true == $active ) ? ' is-active' : '';
				$accordion_content .= sprintf( '<li class="accordion-item%s" data-accordion-item>%s
                <div class="accordion-content" data-tab-content>%s</div></li>', $is_active, $accordion_title, $content );
			}
		}

		return sprintf( '<ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">%s</ul>',
			$accordion_content );

	}
}