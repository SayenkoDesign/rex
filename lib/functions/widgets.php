<?php
// Example: change sidebar params

function _s_widget_display_callback($instance, $widget, $args) {
    
    $sidebar_id = 'footer-1';
    
    if ( strpos( $args['id'], $sidebar_id ) === FALSE ) {
      return $instance;
    }
    
    $total_widgets = wp_get_sidebars_widgets();
    $sidebar_widgets = count($total_widgets[$sidebar_id]);
    
    if( ! $sidebar_widgets ) {
        return;
    }
    
    $columns = floor(12 / $sidebar_widgets);
    
    $column_classes = sprintf( 'small-12 medium-%s columns', $columns );
    
    $args['before_widget'] = sprintf( '<aside class="widget %s %s">', $widget->widget_options['classname'], $column_classes );
    $args['after_widget'] = '</aside>';
    $args['before_title'] = '<h3 class="widget-title">';
    $args['after_title'] = '</h3>';
    
    $widget->widget($args, $instance);
    
    return;
} 

// add_filter( 'widget_display_callback', '_s_widget_display_callback', 10, 3 );