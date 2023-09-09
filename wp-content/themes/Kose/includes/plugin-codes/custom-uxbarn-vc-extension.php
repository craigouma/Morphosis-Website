<?php

/***** UXbarn VC Extension *****/
if ( ! function_exists( 'uxbarn_vc_extension_custom' ) ) {
	
	function uxbarn_vc_extension_custom() {
		
		// Remove default plugin's actions/functions
		remove_action( 'wp_enqueue_scripts', 'uxb_exte_load_on_demand_assets' ); // Remove plugin's because most styles are in style.css of the theme
		
		// Remove and re-enable using theme's code below
		remove_action( 'admin_init', 'uxb_exte_load_heading_element' );
		remove_action( 'admin_init', 'uxb_exte_load_icon_element' );
		remove_action( 'admin_init', 'uxb_exte_load_divider_element' );
		remove_shortcode( 'uxb_heading' );
		remove_shortcode( 'uxb_icon' );
		
		
		// Use theme's custom actions/functions
		
		// Customize this plugin's function to use Ionicons instead of default FontAwesome for Heading and Icon elements
		// (Only if Visual Composer is active)
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			
			add_action( 'admin_init', 'uxbarn_custom_vc_exte_load_heading_element' );
			add_action( 'admin_init', 'uxbarn_custom_vc_exte_load_icon_element' );
			add_action( 'admin_init', 'uxbarn_custom_vc_exte_load_divider_element' );
			
		}
		
		add_shortcode( 'uxb_heading', 'uxbarn_custom_vc_exte_register_heading_shortcode' );
		add_shortcode( 'uxb_icon', 'uxbarn_custom_vc_exte_register_icon_shortcode' );
		
	}
	
}



if ( ! function_exists( 'uxbarn_custom_vc_exte_load_heading_element' ) ) {
		
	function uxbarn_custom_vc_exte_load_heading_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Heading', 'uxb_exte' ),
		   'base' 		=> 'uxb_heading',
		   'icon' 		=> 'icon-wpb-uxb_heading',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_exte' ),
		   'weight'		=> 490, // to adjust the position of this element in the list. More number = to the top.
		   'params' 	=> array(
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Heading text', 'uxb_exte' ),
		         'param_name' 	=> 'text',
		         'value' 		=> __( 'Title', 'uxb_exte' ),
		         'description' 	=> '',
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Type', 'uxb_exte' ),
		         'param_name' 	=> 'type',
		         'value' 		=> array(
				                        'H1' => 'h1', 
				                        'H2' => 'h2',
				                        'H3' => 'h3',
				                        'H4' => 'h4',
				                        'H5' => 'h5',
				                    ),
		         'description' 	=> __( 'Choose the heading type.', 'uxb_exte' ),
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Alignment', 'uxb_exte' ),
		         'param_name' 	=> 'alignment',
		         'value' 		=> array(
				                        __( 'Left', 'uxb_exte' ) 	=> '', 
				                        __( 'Center', 'uxb_exte' ) 	=> 'h-center',
				                        __( 'Right', 'uxb_exte' ) 	=> 'h-right',
				                    ),
		         'description' 	=> __( 'Select text alignment for this heading.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Has line?', 'uxb_exte' ),
		         'param_name' 	=> 'has_line',
		         'value' 		=> array(
				                        __( 'No', 'uxb_exte' )  => 'false', 
				                        __( 'Yes', 'uxb_exte' ) => 'true',
				                    ),
		         'description' 	=> __( 'Whether to display a line at the bottom of the heading.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Has icon?', 'uxb_exte' ),
		         'param_name' 	=> 'has_icon',
		         'value' 		=> array(
				                        __( 'No', 'uxb_exte' ) 	=> '', 
				                        __( 'Yes', 'uxb_exte' ) => 'true',
				                    ),
		         'description' 	=> __( 'Whether to display the icon before heading text.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ),
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Icon code', 'uxb_exte' ),
		         'param_name' 	=> 'icon',
		         'value' 		=> '',
		         'description' 	=> sprintf( __( '<a href="%s" target="_blank">Click here to see all available icons</a>. Just copy and paste the icon code into the text field. For example: <em>icon-asterisk</em>. Leave this field blank when not to use icon.', 'uxb_exte' ), get_template_directory_uri() . '/css/Ionicons/cheatsheet.html' ),
		         'admin_label' 	=> false,
		         'dependency' 	=> array(
			                            'element' 	=> 'has_icon',
			                            'value' 	=> array( 'true' ),
			                        ),
		      ),
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Icon Size', 'uxb_exte' ),
		         'param_name' 	=> 'icon_size',
		         'value' 		=> '16',
		         'description' 	=> __( 'Specify the size number for the icon (px). Only number is allowed.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		         'dependency' 	=> array(
			                            'element' 	=> 'has_icon',
			                            'value' 	=> array( 'true' ),
			                        ),
		      ),
		      array(
		         'type' 		=> 'colorpicker',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Icon Color', 'uxb_exte' ),
		         'param_name' 	=> 'icon_color',
		         'value' 		=> '',
		         'description' 	=> __( 'Choose the color.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		         'dependency' 	=> array(
		                            'element' 	=> 'has_icon',
		                            'value' 	=> array( 'true' ),
		                        ),
		      ),
		      uxbarn_get_css_animation_param(), // Changed from plugin's to theme's
		      uxbarn_get_extra_class_name(), // Changed from plugin's to theme's
		   )
		   
		) );
		
	}
	
}



if ( ! function_exists( 'uxbarn_custom_vc_exte_register_heading_shortcode' ) ) {
    
    function uxbarn_custom_vc_exte_register_heading_shortcode( $atts ) {
    	
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
			
			$margin_right = 10;
            
            if ( $icon_size != '' ) {
            	
                if ( is_numeric( $icon_size ) ) {
                	$margin_right = $icon_size * 0.67;
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
                $style = ' style="' . $icon_size . $icon_color . ' margin-right: ' . $margin_right . 'px;"';
            }
            
            
            if ( trim( $icon ) != '' && trim( $icon ) != 'icon-' ) {
                $icon = '<i class="icon ' . $icon . '" ' . $style . '></i>';
            } else {
                $icon = '';
            }
        } else {
            $icon = '';
        }
        
        return '<div class="uxb-exte"><' . $type . ' class="' . $class . '">' . $icon . $text . '</' . $type . '></div>';
		
    }

}



if ( ! function_exists( 'uxbarn_custom_vc_exte_load_icon_element' ) ) {
		
	function uxbarn_custom_vc_exte_load_icon_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Icon', 'uxb_exte' ),
		   'base' 		=> 'uxb_icon',
		   'icon' 		=> 'icon-wpb-uxb_icon',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_exte' ),
		   'weight'		=> 470, // to adjust the position of this element in the list. More number = to the top.
		   'params' 	=> array(
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Icon code', 'uxb_exte' ),
		         'param_name' 	=> 'code',
		         'value' 		=> '',
		         'description' 	=> sprintf( __( '<a href="%s" target="_blank">Click here to see all available icons from Ionicons</a>. Just copy and paste the icon code into the text field. For example: <em>icon-asterisk</em>', 'uxb_exte' ), 'http://ionicons.com/' ),
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Size', 'uxb_exte' ),
		         'param_name' 	=> 'size',
		         'value' 		=> '16',
		         'description' 	=> __( 'Specify the size number for the icon (px). Only number is allowed.', 'uxb_exte' ),
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'colorpicker',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Color', 'uxb_exte' ),
		         'param_name' 	=> 'color',
		         'value' 		=> '',
		         'description' 	=> __( 'Choose the color.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ), 
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Alignment', 'uxb_exte' ),
		         'param_name' 	=> 'alignment',
		         'value' 		=> array(
				                        __( 'Left', 'uxb_exte' ) 	=> 'normal-align-left', 
				                        __( 'Center', 'uxb_exte' ) 	=> 'normal-align-center',
				                        __( 'Right', 'uxb_exte' ) 	=> 'normal-align-right',
				                        __( 'Float left (will be on the same line with adjacent text block)', 'uxb_exte' )  => 'float-left',
				                        __( 'Float right (will be on the same line with adjacent text block)', 'uxb_exte' ) => 'float-right',
				                    ),
		         'description' 	=> __( 'Select the alignment for this icon.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ),
		      uxbarn_get_css_animation_param(), // Changed from plugin's to theme's
		      uxbarn_get_extra_class_name(), // Changed from plugin's to theme's
		   )
		   
		) );
		
	}
	
}



if ( ! function_exists( 'uxbarn_custom_vc_exte_register_icon_shortcode' ) ) {
    
    function uxbarn_custom_vc_exte_register_icon_shortcode( $atts ) {
    	
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
        
        return '<div class="icon-shortcode ' . $alignment . ' ' . $css_animation . ' "><i class="icon ' . $code . ' ' . $el_class . ' uxb-icon ' . '" ' . $style . '></i></div>';
		
    }

}



if ( ! function_exists( 'uxbarn_custom_vc_exte_load_divider_element' ) ) {
		
	function uxbarn_custom_vc_exte_load_divider_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Divider', 'uxb_exte' ),
		   'base' 		=> 'uxb_divider',
		   'icon' 		=> 'icon-wpb-uxb_divider',
		   'class' 		=> '',
		   'weight'		=> 415,
		   'category' 	=> __( 'Content', 'uxb_exte' ),
		   'params' 	=> array(
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Style', 'uxb_exte' ),
		         'param_name' 	=> 'style',
		         'value' 		=> array(
				                        __( 'Thin', 'uxb_exte' ) 			=> 'thin',
				                        __( 'Light', 'uxb_exte' ) 			=> 'light',
				                        __( 'Bold', 'uxb_exte' ) 			=> 'bold',
				                        __( 'Thin + Dashed', 'uxb_exte' ) 	=> 'thin dashed',
				                        __( 'Light + Dashed', 'uxb_exte' ) 	=> 'light dashed',
				                        __( 'Bold + Dashed', 'uxb_exte' ) 	=> 'bold dashed',
				                    ),
		         'description' 	=> __( 'Choose the style for divider.', 'uxb_exte' ),
		         'admin_label' 	=> true,
		      ),
		      uxbarn_get_extra_class_name(),
		   )
		   
		) );
		
	}
	
}