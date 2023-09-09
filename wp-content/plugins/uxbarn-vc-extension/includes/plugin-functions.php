<?php

// Unused since v1.0.2. Each function is loaded in "uxbarn-vc-extension" using "admin_init" action directly
if ( ! function_exists( 'uxb_exte_load_elements' ) ) {
	
	function uxb_exte_load_elements() {
		
		/*uxb_exte_load_heading_element();
		uxb_exte_load_icon_element();
		uxb_exte_load_blockquote_element();
		uxb_exte_load_divider_element();*/
		
	}
	
}



if ( ! function_exists( 'uxb_exte_load_heading_element' ) ) {
		
	function uxb_exte_load_heading_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Heading', 'uxb_exte' ),
		   'base' 		=> 'uxb_heading',
		   'icon' 		=> 'icon-wpb-uxb_heading',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_exte' ),
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
		         'description' 	=> sprintf( __( '<a href="%s" target="_blank">Click here to see all available icons</a>. Just copy and paste the icon code into the text field. For example: <em>icon-asterisk</em>. Leave this field blank when not to use icon.', 'uxb_exte' ), UXB_EXTE_URL . 'css/FontAwesome/preview.html' ),
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
		      uxb_exte_get_css_animation_param(),
		      uxb_exte_get_extra_class_name(),
		   )
		   
		) );
		
	}
	
}



if ( ! function_exists( 'uxb_exte_load_icon_element' ) ) {
		
	function uxb_exte_load_icon_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Icon', 'uxb_exte' ),
		   'base' 		=> 'uxb_icon',
		   'icon' 		=> 'icon-wpb-uxb_icon',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_exte' ),
		   'params' 	=> array(
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Icon code', 'uxb_exte' ),
		         'param_name' 	=> 'code',
		         'value' 		=> '',
		         'description' 	=> sprintf( __( '<a href="%s" target="_blank">Click here to see all available icons</a>. Just copy and paste the icon code into the text field. For example: <em>icon-asterisk</em>', 'uxb_exte' ), UXB_EXTE_URL . 'css/FontAwesome/preview.html' ),
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
		      uxb_exte_get_css_animation_param(),
		      uxb_exte_get_extra_class_name(),
		   )
		   
		) );
		
	}
	
}



if ( ! function_exists( 'uxb_exte_load_blockquote_element' ) ) {
		
	function uxb_exte_load_blockquote_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Blockquote', 'uxb_exte' ),
		   'base' 		=> 'uxb_blockquote',
		   'icon' 		=> 'icon-wpb-uxb_blockquote',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_exte' ),
		   'params' 	=> array(
		      array(
		         'type' 		=> 'textarea_html',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Text', 'uxb_exte' ),
		         'param_name' 	=> 'content',
		         'value' 		=> "Everything is okay in the end, if it's not ok, then it's not the end.",
		         'description' 	=> __( 'Enter the text for this quote.', 'uxb_exte' ),
		      ),
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Cite', 'uxb_exte' ),
		         'param_name' 	=> 'cite',
		         'value' 		=> '',
		         'description' 	=> __( 'Enter the name or source of the quote.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Type', 'uxb_exte' ),
		         'param_name' 	=> 'type',
		         'value' 		=> array(
				                        __( 'Normal', 'uxb_exte' ) 		=> '', 
				                        __( 'Float left', 'uxb_exte' ) 	=> 'left',
				                        __( 'Float right', 'uxb_exte' ) => 'right',
				                    ),
		         'description' 	=> __( 'Choose the display type.', 'uxb_exte' ),
		         'admin_label' 	=> false,
		      ),
		      uxb_exte_get_extra_class_name(),
		   )
		   
		) );
		
	}
	
}



if ( ! function_exists( 'uxb_exte_load_divider_element' ) ) {
		
	function uxb_exte_load_divider_element() {
		
		vc_map( array(
		   'name' 		=> __( 'Divider', 'uxb_exte' ),
		   'base' 		=> 'uxb_divider',
		   'icon' 		=> 'icon-wpb-uxb_divider',
		   'class' 		=> '',
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
				                        __( 'Special', 'uxb_exte' ) 		=> 'special',
				                    ),
		         'description' 	=> __( 'Choose the style for divider.', 'uxb_exte' ),
		         'admin_label' 	=> true,
		      ),
		      uxb_exte_get_extra_class_name(),
		   )
		   
		) );
		
	}
	
}



if ( ! function_exists( 'uxb_exte_load_shortcodes' ) ) {
		
	function uxb_exte_load_shortcodes() {
		
		add_shortcode( 'uxb_heading', 'uxb_exte_register_heading_shortcode' );
		add_shortcode( 'uxb_icon', 'uxb_exte_register_icon_shortcode' );
		add_shortcode( 'uxb_blockquote', 'uxb_exte_register_blockquote_shortcode' );
		add_shortcode( 'uxb_divider', 'uxb_exte_register_divider_shortcode' );
		add_shortcode( 'uxb_dropcap', 'uxb_exte_register_dropcap_shortcode' );
		add_shortcode( 'uxb_highlight', 'uxb_exte_register_highlight_shortcode' );
		
	}
	
}



if ( ! function_exists( 'uxb_exte_get_css_animation_complete_class' ) ) {
    
    function uxb_exte_get_css_animation_complete_class( $css_animation ) {
    	
        // Code copied from "/lib/shortcodes.php" of VC plugin v3.6.5. Function: getCSSAnimation()
        if ( $css_animation != '' ) {
        	
            wp_enqueue_script( 'waypoints' );
            return ' wpb_animate_when_almost_visible wpb_' . $css_animation;
			
        } else {
            return '';
        }
        
    }
	
}



// For checking whether there is specified shortcode incluced in the current post
if ( ! function_exists( 'uxb_exte_has_shortcode' ) ) {
		
	function uxb_exte_has_shortcode( $shortcode = '', $content ) {
	    
	    // false because we have to search through the post content first
	    $found = false;
	    
	    // if no short code was provided, return false
	    if ( ! $shortcode ) {
	        return $found;
	    }
	    // check the post content for the short code
	    if ( stripos( $content, '[' . $shortcode ) !== false ) {
	        // we have found the short code
	        $found = true;
	    }
	    
	    // return our final results
	    return $found;
	}

}