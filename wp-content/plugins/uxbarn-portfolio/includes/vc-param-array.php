<?php

if ( ! function_exists( 'uxb_port_get_image_size_array' ) ) {
	
    function uxb_port_get_image_size_array() {
    	
        // Prepare image size array
        $size_array = array( __( 'Original size', 'uxb_port' ) => 'full' );
        
        foreach ( get_intermediate_image_sizes() as $s ) {
            
            global $_wp_additional_image_sizes;
            
            if ( isset( $_wp_additional_image_sizes[$s] ) ) {
            	
                $width = intval( $_wp_additional_image_sizes[ $s ]['width'] );
                $height = intval( $_wp_additional_image_sizes[ $s ]['height'] );
				
            } else {
            	
                $width = get_option( $s.'_size_w' );
                $height = get_option( $s.'_size_h' );
				
            }
            
            $clean_name = ucwords( str_replace( 'cropped', '', str_replace( '-', ' ', $s ) ) );
            
            $size_array[ $clean_name . ' (' . $width . 'x' . $height . ')' ] = $s;
            
        }
        
        return $size_array;
		
    }
	
}



if ( ! function_exists( 'uxb_port_get_auto_rotation' ) ) {
	
    function uxb_port_get_auto_rotation( $dependency_param_name = '', $dependency_value_array = array() ) {
        
        $param = array(
                 'type' 		=> 'dropdown',
                 'holder' 		=> 'div',
                 'class' 		=> '',
                 'heading' 		=> __( 'Auto rotation duration', 'uxb_port' ),
                 'param_name' 	=> 'interval',
                 'value' 		=> array(
		                                __( 'Disable auto rotation', 'uxb_port' ) => '0',
		                                '5' => '5',
		                                '6' => '6',
		                                '7' => '7',
		                                '8' => '8',
		                                '9' => '9',
		                                '10' => '10',
		                                '12' => '12',
		                                '14' => '14',
		                                '16' => '16',
		                                '18' => '18',
		                                '20' => '20',
		                                '25' => '25',
		                                '30' => '30',
		                                '40' => '40',
		                                '60' => '60',
		                                '80' => '80',
		                                '100' => '100',
		                            ),
                 'description' 	=> __( 'Select how many seconds to stay on current slide before rotating to the next one.', 'uxb_port' ),
                 'admin_label' 	=> false,
                 'dependency' 	=> array(
	                                    'element' 	=> $dependency_param_name,
	                                    'value' 	=> $dependency_value_array,
	                                ),
              );
              
        return $param;
		
    }

}



if ( ! function_exists( 'uxb_port_get_show_bullets' ) ) {
	
    function uxb_port_get_show_bullets( $dependency_param_name = '', $dependency_value_array = array() ) {
    	
    	return array(
	         'type' 		=> 'dropdown',
	         'holder' 		=> 'div',
	         'class' 		=> '',
	         'heading' 		=> __( 'Show bullets?', 'uxb_port' ),
	         'param_name' 	=> 'show_bullets',
	         'value' 		=> array(
			                        __( 'Yes', 'uxb_port' ) => 'true', 
			                        __( 'No', 'uxb_port' )  => 'false',
			                    ),
	         'description' 	=> __( "Whether to display the slider's bullets.", 'uxb_port' ),
	         'admin_label' 	=> false,
	         'dependency' 	=> array(
		                            'element' 	=> $dependency_param_name,
		                            'value' 	=> $dependency_value_array,
		                        ),
	      );
		  
	}
	
}



if ( ! function_exists( 'uxb_port_get_orderby' ) ) {
	
    function uxb_port_get_orderby() {
    	
        $param = array(
             'type' 		=> 'dropdown',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Order by', 'uxb_port' ),
             'param_name' 	=> 'orderby',
             'value' 		=> array(
		                            __( 'ID', 'uxb_port' ) 			 	=> 'ID', 
		                            __( 'Title', 'uxb_port' ) 		 	=> 'title',
		                            __( 'Slug', 'uxb_port' ) 			=> 'name',
		                            __( 'Published Date', 'uxb_port' ) 	=> 'date',
		                            __( 'Modified Date', 'uxb_port' )  	=> 'modified',
		                            __( 'Random', 'uxb_port' ) 		 	=> 'rand',
		                        ),
             'description' 	=> __( 'Select the which parameter to be used for ordering. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxb_port' ),
             'admin_label' 	=> false,
          );
          
        return $param;
		
    }
	
}



if ( ! function_exists( 'uxb_port_get_order' ) ) {
	
    function uxb_port_get_order() {
    	
        $param = array(
             'type' 		=> 'dropdown',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Order', 'uxb_port' ),
             'param_name' 	=> 'order',
             'value' 		=> array(
		                            __( 'Ascending', 'uxb_port' )  => 'ASC', 
		                            __( 'Descending', 'uxb_port' ) => 'DESC',
		                        ),
             'description' 	=> __( '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxb_port' ),
             'admin_label' 	=> false,
          );
          
        return $param;
		
    }
	
}



if ( ! function_exists( 'uxb_port_get_extra_class_name' ) ) {
	
    function uxb_port_get_extra_class_name() {
        
        $param = array(
             'type' 		=> 'textfield',
             'holder' 		=> 'div',
             'class' 		=> '',
             'heading' 		=> __( 'Extra class name', 'uxb_port' ),
             'param_name' 	=> 'el_class',
             'value' 		=> '',
             'description' 	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'uxb_port' ),
             'admin_label' 	=> false,
          );
          
        return $param;
		
    }
	
}