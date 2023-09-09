<?php

if ( ! function_exists( 'uxb_exte_register_heading_shortcode' ) ) {
    
    function uxb_exte_register_heading_shortcode( $atts ) {
    	
        $default_atts = array(
                            'text' 			=> __( 'Title', 'uxb_exte' ),
                            'type' 			=> 'h2', // h1, h2, h3, h4, h5
                            'alignment' 	=> '',
                            'has_line' 		=> 'false', // true, false
                            'has_icon'		=> 'false', // true, false
                            'icon'			=> '',
                            'icon_size'		=> '',
                            'icon_color'	=> '',
                            'css_animation'	=> '',
                            'el_class' 	=> '',
                        );
						
        extract( shortcode_atts( $default_atts, $atts ) );
        
        $class = '';
        $indicator = 0;
        
        if ( trim( $el_class ) != '' ) {
            $indicator += 1;
        }
        
        if( $css_animation != '' ) {
        	
        	$css_animation = uxb_exte_get_css_animation_complete_class( $css_animation );
            $indicator += 1;
			
        }
        
        if ( $alignment != '' ) {
            $indicator += 1;
        }
        
        if ( $has_line != 'false' ) {
        	
            $has_line = ' has-line ';
            $indicator += 1;
			
        } else {
            $has_line = '';
        }
        
        //if ( $indicator > 0 ) {
            $class = $el_class . ' ' . $alignment . ' ' . $has_line . ' ' . $css_animation . ' uxb-heading';
        //}
        
        
        if ( $has_icon == 'true' ) {
            
            $icon_size = trim( $icon_size );
            $icon_color = trim( $icon_color );
            
            if ( $icon_size != '' ) {
            	
                if ( is_numeric( $icon_size ) ) {
                    $icon_size = ' font-size: ' . $icon_size . 'px;';
                } else {
                    $icon_size = ' font-size: 16px;';
                }
				
            } else {
                $icon_size = ' font-size: 16px;';
            }
            
            
            if ( $icon_color != '' ) {
            	
                if ( strpos( $icon_color, '#' ) === false ) {
                    $icon_color = ' color: #' . $icon_color . ';';
                } else {
                	
                    if ( $icon_color == '#' ) {
                        $icon_color = '';
                    } else {
                        $icon_color = ' color: ' . $icon_color . ';';
                    }
					
                }
				
            } else {
                $icon_color = '';
            }
            
            $style = '';
            if ( $icon_color != '' || $icon_size != '' ) {
                $style = ' style="' . $icon_size . $icon_color . ' margin-right: 12px;"';
            }
            
            
            if ( trim( $icon ) != '' && trim( $icon ) != 'icon-' ) {
                $icon = '<i class="' . $icon . '" ' . $style . '></i>';
            } else {
                $icon = '';
            }
        } else {
            $icon = '';
        }
        
        return '<div class="uxb-exte"><' . $type . ' class="' . $class . '">' . $icon . $text . '</' . $type . '></div>';
		
    }

}



if ( ! function_exists( 'uxb_exte_register_icon_shortcode' ) ) {
    
    function uxb_exte_register_icon_shortcode( $atts ) {
    	
        $default_atts = array(
                            'code' 		  	=> '', // icon-asterisk (sample)
                            'size' 		  	=> '', // numeric value
                            'color' 	  	=> '', // #FFFFFF (example)
                            'alignment'   	=> '',
                            'css_animation'	=> '',
                            'el_class' 	  	=> '',
                        );          
						    
        extract( shortcode_atts( $default_atts, $atts ) );
        
        $code = trim( $code );
        $size = trim( $size );
        $color = trim( $color );
        
        if ( $size != '' ) {
        	
            if ( is_numeric( $size ) ) {
                $size = ' font-size: ' . $size . 'px;';
            } else {
                $size = ' font-size: 16px;';
            }

        } else {
            $size = ' font-size: 16px;';
        }
        
        
        if ( $color != '' ) {
        	
            if ( strpos( $color, '#' ) === false ) {
                $color = ' color: #' . $color . ';';
            } else {
            	
                if ( $color == '#' ) {
                    $color = '';
                } else {
                    $color = ' color: ' . $color . ';';
                }
				
            }
			
        } else {
            $color = '';
        }
        
        $style = '';
		
        if ( $color != '' || $size != '' ) {
            $style = ' style="' . $size . $color . '"';
        }
		
		$css_animation = uxb_exte_get_css_animation_complete_class( $css_animation );
        
        return '<i class="' . $code . ' ' . ' ' . $alignment . ' ' . $el_class . ' uxb-icon ' . $css_animation . '" ' . $style . '></i>';
		
    }

}



if ( ! function_exists( 'uxb_exte_register_blockquote_shortcode' ) ) {
    
    function uxb_exte_register_blockquote_shortcode( $atts, $content = null ) {
    	
        $default_atts = array(
                            'type' 		=> '', // '', left, right
                            'cite' 		=> '',
                            'el_class' 	=> '',
                        );
						
        extract( shortcode_atts( $default_atts, $atts ) );
        
        $cite = trim( $cite );
        
        $class = '';
		
        if ( $type == 'left' || $type == 'right' ) {
            $class = $type;
        } elseif ( $type == '' ) {
            $class = 'normal';
        }

        $class = ' class="' . $class . ' ' . $el_class . ' uxb-blockquote"';
        
        if ( $cite ) {
        	
            return 
            '<blockquote ' . $class . '>
                <p>
                    ' . $content . '
                </p>
                <cite>' . $cite . '</cite>
            </blockquote>';
        
        } else {
        	
            return 
            '<blockquote ' . $class . '>
                <p>
                    ' . $content . '
                </p>
            </blockquote>';
			
        }
        
    }

}



if ( ! function_exists( 'uxb_exte_register_divider_shortcode' ) ) {
    
    function uxb_exte_register_divider_shortcode( $atts ) {
    	
        $default_atts = array(
                            'style' 	=> 'dark', 
                            'el_class' 	=> '',
                        );   
						           
        extract( shortcode_atts( $default_atts, $atts ) );
        
		if( $style != 'special' ) {
			
	        $style = str_replace( '_', ' ', $style );
	        return '<hr class="' . $style . ' ' . $el_class . ' divider uxb-divider" />';
			
		} else {
			
			return '<div class="divider-set1 ' . $el_class . ' uxb-divider">
						<hr class="short" />
						<hr class="middle" />
					</div>';
					
		}

    }
	
}



if ( ! function_exists( 'uxb_exte_register_dropcap_shortcode' ) ) {
    
    function uxb_exte_register_dropcap_shortcode( $atts ) {
    	
        $default_atts = array(
                            'style' 	=> 'dark', 
                            'character' => '',
                            'el_class' 	=> '',
                        );  
						            
        extract( shortcode_atts( $default_atts, $atts ) );
        
        return '<span class="' . $style . ' uxb-dropcap ' . $el_class . '">' . $character . '</span>';
		
    }
	
}



if ( ! function_exists( 'uxb_exte_register_highlight_shortcode' ) ) {
    
    function uxb_exte_register_highlight_shortcode( $atts, $content = null ) {
    	
        $default_atts = array(
                            'style' => 'dark',
                            'el_class' 	=> '',
                        );          
						    
        extract( shortcode_atts( $default_atts, $atts ) );
        
        return '<span class="' . $style . ' uxb-highlight ' . $el_class . '">' . $content . '</span>';
		
    }

}