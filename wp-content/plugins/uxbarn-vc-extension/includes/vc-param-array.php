<?php

// ---------------------------------------------- //
// Param array functions for VC
// ---------------------------------------------- //

// image, message box, 
if ( ! function_exists( 'uxb_exte_get_css_animation_param' ) ) {
	
    function uxb_exte_get_css_animation_param() {
    	
        // CSS animation param code copied from "config/map.php" of VC plugin v3.6.5
        $add_css_animation = array(
          'type' 		=> 'dropdown',
          'heading' 	=> __( 'CSS Animation', 'uxb_exte' ),
          'param_name' 	=> 'css_animation',
          'admin_label' => false,
          'value' 		=> array( 
	          					__( 'No', 'uxb_exte' ) 				 => '', 
	          					__( 'Top to bottom', 'uxb_exte' ) 	 => 'top-to-bottom', 
	          					__( 'Bottom to top', 'uxb_exte' ) 	 => 'bottom-to-top', 
	          					__( 'Left to right', 'uxb_exte' ) 	 => 'left-to-right', 
	          					__( 'Right to left', 'uxb_exte' ) 	 => 'right-to-left', 
	          					__( 'Appear from center', 'uxb_exte' ) => 'appear',
							),
          'description' => __( 'Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'uxb_exte' )
        );
        
        return $add_css_animation;
		
    }
	
}



// button, image, video, message box, google maps, gallery, cta box, blog posts (vc teaser grid), 
if ( ! function_exists( 'uxb_exte_get_extra_class_name' ) ) {
	
    function uxb_exte_get_extra_class_name() {
        
        $param = array(
             'type' 		=> 'textfield',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Extra class name', 'uxb_exte' ),
             'param_name' 	=> 'el_class',
             'value' 		=> '',
             'description' 	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uxb_exte' ),
             'admin_label' 	=> false,
          );
          
        return $param;
		
    }
	
}


