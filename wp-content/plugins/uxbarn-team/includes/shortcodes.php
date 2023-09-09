<?php

if ( ! function_exists( 'uxb_team_load_team_shortcode' ) ) {
    
    function uxb_team_load_team_shortcode( $atts ) {
    	
		$default_atts = array(
                            'member_id' 		=> '', // Name|ID
                            'image_size' 		=> '', 
                            'link' 				=> 'true', // true, false
                            'heading_size' 		=> 'large',
                            'display_social' 	=> 'true', // true, false
                            'css_animation' 	=> '',
                        );  
						            
        extract( shortcode_atts( $default_atts, $atts ) );
		
        if ( $member_id != '' ) {
        	
            $member_id = explode( '|', $member_id );
            $member_id = $member_id[1];
				
			// If WPML is active, get translated ID
			if ( function_exists( 'icl_object_id' ) ) {
				$member_id = icl_object_id( $member_id, 'uxbarn_team', false, ICL_LANGUAGE_CODE );
				// If the returned ID is NULL (meaning no translated post), return empty string.
				if ( ! isset( $member_id ) ) {
					return '';
				}
			}
            
            
            $thumbnail ='';
            if ( has_post_thumbnail( $member_id ) ) {
                $thumbnail = get_the_post_thumbnail( $member_id, $image_size, array( 'class' => 'border' ) );
            }
			
            $name = get_the_title( $member_id );
            if ( $link == 'true' ) {
            	
                $thumbnail = '<a href="' . get_permalink( $member_id ) . '" class="image-link">' . $thumbnail . '</a>';
                $name = '<a href="' . get_permalink( $member_id ) . '">' . $name . '</a>';
				
            }
            
            $position = uxb_team_get_array_value( get_post_meta( $member_id, 'uxbarn_team_meta_info_position' ), 0 );
            
            $excerpt = uxb_team_get_array_value( get_post_meta( $member_id, 'uxbarn_team_excerpt' ), 0 );
            
            $heading_name = 'h2';
            $heading_position = 'h3';
			
            if ( $heading_size == 'small' ) {
            	
                $heading_name = 'h3';
                $heading_position = 'h4';
				
            }
            
            $css_animation = uxb_team_get_css_animation_complete_class( $css_animation );
            
            $output = '<div class="uxb-team-wrapper ' . $css_animation . '">';
            $output .= '
                <div class="uxb-team-thumbnail">
                    ' . $thumbnail . '
                </div>
                <' . $heading_name . ' class="uxb-team-name">' . $name . '</' . $heading_name . '>
                <' . $heading_position . ' class="uxb-team-position">' . $position . '</' . $heading_position . '>
                <p>
                    ' . $excerpt . '
                </p>';
            
            if ( $display_social == 'true' ) {
                
                $social_list_item_string = uxb_team_get_member_social_list_string( $member_id );
                
                if ( $social_list_item_string != '' ) {
                    $output .= '<ul class="uxb-team-social">' . $social_list_item_string . '</ul>';
                }
            }
            
            $output .= '</div>'; // close "team-member-wrapper"
            
            return $output;
            
        } else { // If no member selected
            return '';
        }
		
	}
	
}