<?php

if ( ! function_exists( 'uxb_team_get_image_size_array' ) ) {
	
    function uxb_team_get_image_size_array() {
    	
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