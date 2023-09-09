<?php


if ( ! function_exists( 'uxb_port_register_plugin_image_sizes' ) ) {
	
	function uxb_port_register_plugin_image_sizes() {
		
	    add_image_size( 'uxb-port-element-thumbnails', 320, 9999 );
		add_image_size( 'uxb-port-related-items', 232, 232, true );
		add_image_size( 'uxb-port-single-landscape', 1100, 676, true );
		add_image_size( 'uxb-port-single-portrait', 600, 816, true );
		add_image_size( 'uxb-port-large-square', 400, 400, true );
		
	}
	
}



// For getting array value when using with OptionTree meta box
if ( ! function_exists( 'uxb_port_get_array_value' ) ) {
	
	function uxb_port_get_array_value( $array, $index ) {
	    return isset( $array[ $index ] ) ? $array[ $index ] : '';
	}
	
}



if ( ! function_exists( 'uxb_port_get_portfolio_meta_text' ) ) {
	
	function uxb_port_get_portfolio_meta_text( $string ) {
	    if ( trim( $string ) == '' || trim( $string ) == 'http://' ) {
	        return '-';
	    } else {
	        return $string;
	    }
	}
	
}



if ( ! function_exists( 'uxb_port_get_attachment' ) ) {
	
	function uxb_port_get_attachment( $attachment_id ) {
	    
	    $attachment = get_post( $attachment_id );
	    
	    // Need to check it first
	    if( isset( $attachment ) ) {
	            
	       	return array(
	            'alt' 			=> get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
	            'caption' 		=> $attachment->post_excerpt,
	            'description' 	=> $attachment->post_content,
	            'href' 			=> get_permalink($attachment->ID),
	            'src' 			=> $attachment->guid,
	            'title' 		=> $attachment->post_title,
	        );
	    
	    } else {
	        return array(
	            'alt' 			=> 'N/A',
	            'caption' 		=> 'N/A',
	            'description' 	=> 'N/A',
	            'href' 			=> 'N/A',
	            'src' 			=> 'N/A',
	            'title' 		=> 'N/A',
	        );
	    }
	}
	
}




if ( ! function_exists( 'uxb_port_get_attachment_id_from_src' ) ) {
	
	function uxb_port_get_attachment_id_from_src( $image_src ) {
		
	    global $wpdb;
	    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	    $id = $wpdb->get_var( $query );
	    return $id;
		
	}

}



if ( ! function_exists( 'uxb_port_alter_query_object' ) ) {
	
	function uxb_port_alter_query_object( $query ) {
		
		if ( ! is_admin() && $query->is_main_query() ) {
			
			if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
				$query->set( 'posts_per_page', -1 ); // Reset posts-per-page for taxonomy-portfolio.php
			}
			
		}
		
	}
	
}



// For checking whether there is specified shortcode incluced in the current post
if ( ! function_exists( 'uxb_port_has_shortcode' ) ) {
		
	function uxb_port_has_shortcode( $shortcode = '', $content ) {
	    
	    // false because we have to search through the post content first
	    $found = false;
	    
	    // if no short code was provided, return false
	    if ( ! $shortcode ) {
	        return $found;
	    }
	    // check the post content for the short code
	    if ( stripos( $content, '[' . $shortcode) !== false ) {
	        // we have found the short code
	        $found = true;
	    }
	    
	    // return our final results
	    return $found;
	}

}



if ( ! function_exists( 'uxb_port_load_portfolio_element' ) ) {
	
	function uxb_port_load_portfolio_element() {
		
		global $post;
		
		$id_array = array();
		//$id_array[''] = ''; // Set first dummy item (not used)
		$args = array(
					'hide_empty' 	=> 0,
		            'orderby' 		=> 'title',
		            'order' 		=> 'ASC',
		        );
				
		$terms = get_terms( 'uxbarn_portfolio_tax', $args );
		
		if ( count( $terms ) > 0 ) {
			
			foreach ( $terms as $term ) {
				
		      	// If WPML is active (function is available)
				if ( function_exists( 'icl_object_id' ) ) {
					
					global $sitepress;
					
					$default_lang = $sitepress->get_default_language();
					
					// Text will be changed depending on current active lang, but the IDs are still original ones from default lang
					$id_array[ $term->name ] = icl_object_id( $term->term_id, 'uxbarn_portfolio_tax', true, $default_lang );
					
				} else { // If there is no WPML
					$id_array[ $term->name ] = $term->term_id;
				}
				
			}
			
		}
		 
		
		vc_map( array(
		   'name' 		=> __( 'Portfolio', 'uxb_port' ),
		   'base' 		=> 'uxb_portfolio',
		   'icon' 		=> 'icon-wpb-uxb_portfolio',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_port' ),
		   'params' 	=> array(
		      array(
		         'type' 		=> 'checkbox',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Portfolio categories', 'uxb_port' ),
		         'param_name' 	=> 'categories',
		         'value' 		=> $id_array,
		         'description' 	=> __( 'Select the categories from the list.', 'uxb_port' ),
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Maximum number of items to be displayed', 'uxb_port' ),
		         'param_name' 	=> 'max_item',
		         'value' 		=> '',
		         'description' 	=> __( 'Enter a number to limit the max number of items to be listed. Leave it blank to show all items from the selected categories above. Only number is allowed.', 'uxb_port' ),
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Type', 'uxb_port'),
		         'param_name' 	=> 'type',
		         'value' 		=> array(
				                        __( 'Grid 3 Columns', 'uxb_port' ) 		=> 'col3',
				                        __( 'Grid 4 Columns', 'uxb_port' ) 		=> 'col4',
				                        __( 'Slider (fade transition)', 'uxb_port' )  => 'flexslider_fade',
				                        __( 'Slider (slide transition)', 'uxb_port' ) => 'flexslider_slide',
				                    ),
		         'description' => __('Select the display type for this element.', 'uxb_port'),
		         'admin_label' => true,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Show category filter', 'uxb_port' ),
		         'param_name' 	=> 'show_filter',
		         'value' 		=> array(
				                        __( 'Yes', 'uxb_port' ) => 'true',
				                        __( 'No', 'uxb_port' ) 	=> 'false',
				                    ),
		         'description' 	=> __( 'Whether to display the category filter at the top of the element.', 'uxb_port' ),
		         'dependency' 	=> array(
			                            'element' => 'type',
			                            'value' => array( 'col3', 'col4' ),
			                        ),
		         'admin_label' 	=> false,
		      ),
		      /*
			  array(
							   'type' 		=> 'dropdown',
							   'holder' 		=> 'div',
							   'class' 		=> '',
							   'heading' 		=> __( 'Show title on hover', 'uxb_port' ),
							   'param_name' 	=> 'show_title',
							   'value' 		=> array(
													  __( 'Yes', 'uxb_port' ) => 'true',
													  __( 'No', 'uxb_port' ) 	=> 'false',
												  ),
							   'description' 	=> __( 'Whether to display the item title on mouse hover.', 'uxb_port' ),
							   'dependency' 	=> array(
													  'element' => 'type',
													  'value' => array( 'col3', 'col4' ),
												  ),
							   'admin_label' 	=> false,
							),*/
			  
			  array(
		         'type'			=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Thumbnail size', 'uxb_port' ),
		         'param_name' 	=> 'img_size',
		         'value' 		=> uxb_port_get_image_size_array(),
		         'description' 	=> __( 'Select which size to be used for the thumbnails. Anyway, the image will be scaled depending on its original size and containing column. If you are not sure which one to use, try <em>Large Square</em> or <em>Original size</em>.', 'uxb_port' ),
		         'admin_label' 	=> false,
		         'dependency' 	=> array(
			                            'element' 	=> 'type',
			                            'value' 	=> array( 'flexslider_fade', 'flexslider_slide' ),
			                        ),
		      ),
		      uxb_port_get_auto_rotation( 'type', array( 'flexslider_fade', 'flexslider_slide' ) ),
		      uxb_port_get_show_bullets( 'type', array( 'flexslider_fade', 'flexslider_slide' ) ),
		      uxb_port_get_orderby(),
		      uxb_port_get_order(),
		      uxb_port_get_extra_class_name(),
		   )
		   
		) );
		
	}

}



if ( ! function_exists( 'uxb_port_load_shortcodes' ) ) {
		
	function uxb_port_load_shortcodes() {
		
		add_shortcode( 'uxb_portfolio', 'uxb_port_load_portfolio_shortcode' );
		
	}
	
}



if ( ! function_exists( 'uxb_port_sanitize_numeric_input' ) ) {
		
	function uxb_port_sanitize_numeric_input( $input, $default ) {
	    
	    if ( trim( $input ) != '' ) {
	        
	        if ( is_numeric( $input ) ) {
	            return $input;
	        } else {
	            return $default;
	        }
	        
	    } else {
	        return $default;
	    }
	    
	}
	
}




if ( ! function_exists( 'uxb_port_is_using_vc' ) ) {
	
	function uxb_port_is_using_vc() {
	    
	    // If user is using VC for the content
	    if ( uxb_port_has_shortcode( 'vc_row', get_the_content() ) ) {
	    	return true;
	    } else { // In case the user is using normal post editor (no "vc_row" shortcode found)
	    	return false;
	    }
	}

}