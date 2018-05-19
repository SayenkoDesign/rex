<?php

/*
*
    Usage:
    $attr = new Markup_Attributes;
    
    // all attributes can be set multiple times as either a string or an array
    
    $attr->set( 'class', 'another-class' ); // class="another-class"
    $attr->set( 'class', 'fourth fifth' );
    $attr->set( 'class', array( 'second', 'third' ) ); // class="another-class second third"'
    $attr->set( 'id', 'id-name' );
    
    // Set multiple styles at any time
    $attr->set( 'style', 'background-color: red;' );
    $attr->set( 'style', array( 'color' => 'blue' ) );
    $attr->set( 'style', array( 'padding-top' => '10px', 'padding-bottom' => '10px' ) );
    
    TODO:
    method unset() // unset class/style/id
*
*/

class Markup_Attributes {
 
    private $attributes = array();
    private $allowed_attributes = array( 'id', 'class', 'style' );
    
    public function __construct( $settings = array() ) {
        
        if( empty( $settings ) ) {
            return;
        }
        
        $defaults = array();
    
        foreach( $settings as $name => $value ) {
            
            if( empty( $value ) ) {
                continue;
            }
            
            switch( $name ) {
                case 'class':
                    $defaults[$name] = explode( ' ', $value );
                break;
                case 'background_color':
                    $defaults['class'] = sprintf( 'background-%s', strtolower( $value ) );
                break;
                case 'margin_top':
                case 'margin_bottom':
                case 'padding_top':
                case 'padding_bottom':
                    $name = str_replace( '_', '-', $name );
                    $defaults['style'][$name] = sprintf( '%spx', $value );
                break;
                default:
                $defaults[$name] = $value;
            }
            
        }  
                
        $this->init( $defaults );
	}
    
    
    public function init( $attr ) {
        foreach( $attr as $name => $value ) {
            $this->set( $name, $value );
        }
    }
    
    
    public function set( $name = '', $value = '' ) 
    {
        if( empty( $name ) ) {
            error_log( 'Undefined property via set(): $name is required' );
            return;
        }
        
        if( !in_array( $name, $this->allowed_attributes ) ) {
            error_log( sprintf( 'Disallowed property via set(): allowed attributes (%s) ', print_r( $this->allowed_attributes, 1 ) ) );
            return;
        }
        
        // attribute must be an array if not an id
        /*
        if( 'style' == $name ) {
            
            if( !is_array( $value ) )  {
                error_log( sprintf( '%s attribute must be an array', $name ) );
                return;
            }
        }
        */
        
        
        // Class needs to be stored as an array
        if( 'class' == $name ) {
            
            // incase this is an array
            if( is_array( $value ) ) {
                foreach( $value as $v ) {
                    $this->attributes[$name][] = $v;
                }
            }
            else {
                $this->attributes[$name][] = $value;
            }
            
            
        }
        else if( 'style' == $name ) {
            // adding multiple styles at once
            if( is_array( $value ) ) {
                foreach( $value as $k => $v ) {
                    $this->attributes[$name][$k] = $v;
                }
            }
            else {
               $this->attributes[$name][] = $value; 
            }
           
        }
        else {
           $this->attributes[$name] = $value; 
        }
        
        
    }
    
    
    public function get( $name  = '' )
    {             
        $this->filter_attributes( $this->attributes );
        
        if( empty( $name ) ) {
            return $this->attributes;
        }
        
        if ( array_key_exists( $name, $this->attributes ) ) {
            return $this->attributes[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }
    
    
    private function filter_attributes( $attributes ) 
    {        
        if( ! is_array( $attributes ) )
            return;
            
        foreach( $attributes as $name => $values ) {
            
            // Make sure we've only processed once
            if( !is_array( $values ) || empty( $values ) ) {
                continue;
            }
            
            if( 'class' == $name ) {
                $this->attributes[$name] = join( ' ', $values );
            }
            else if( 'style' == $name ) {
                $this->attributes[$name] = $this->parse_attributes( $values );
            }
            else {
                
            }
        }
    }

    
    private function parse_attributes( $val, $divider = ':', $sep = '; ' ) {
        if( is_array( $val ) ) {
            $t = array();
            foreach( $val as $k => $v ) {
                
                if( empty( $v ) ) {
                    continue;
                }
                
                if( ! is_int( $k ) ) {
                    $t[] = sprintf('%s%s%s', $k, $divider, $v);
                }
                else {
                    $t[] = str_replace( ';', '', $v );  // remove traling ;
                }
            }
            
            return implode( $sep, $t );
        }
        else {
            return $val;	
        }
    }
    
}