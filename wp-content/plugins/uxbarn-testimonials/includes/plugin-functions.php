<?php


if ( ! function_exists( 'uxb_tmnl_register_plugin_image_sizes' ) ) {
	
	function uxb_tmnl_register_plugin_image_sizes() {
		add_image_size( 'uxb-tmnl-testimonial-thumbnail', 230, 230, true );
	}
	
}



// For getting array value when using with OptionTree meta box
if ( ! function_exists( 'uxb_tmnl_get_array_value' ) ) {
	
	function uxb_tmnl_get_array_value( $array, $index ) {
	    return isset( $array[ $index ] ) ? $array[ $index ] : '';
	}
	
}



// For checking whether there is specified shortcode incluced in the current post
if ( ! function_exists( 'uxb_tmnl_has_shortcode' ) ) {
		
	function uxb_tmnl_has_shortcode( $shortcode = '', $content ) {
	    
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



if ( ! function_exists( 'uxb_tmnl_load_testimonials_element' ) ) {
	
	function uxb_tmnl_load_testimonials_element() {
		
		// Prepare ID list array for selection
		$id_array = array();
		
		$args = array(
		            'post_type' => 'uxbarn_testimonials',
		            'nopaging' 	=> true,
		            'orderby' 	=> 'title',
		            'order' 	=> 'ASC',
		        );
				
		$testimonials = get_posts( $args );
		
		if ( ! empty( $testimonials ) ) {
			
			foreach ( $testimonials as $post ) : setup_postdata( $post );
			
				// If WPML is active
				if ( function_exists( 'icl_object_id' ) ) {
					
					$original_id = $post->ID;
					
					global $sitepress;
					$default_lang = $sitepress->get_default_language();
					$post_lang_info = wpml_get_language_information( $original_id ); // WPML's function
					
					// If the post is the translated one (not default lang)
					if ( strpos( $post_lang_info['locale'], $default_lang ) !== false ) {
						
						// If the post is translated, display it or else, display the original title
						$title = get_the_title( icl_object_id( $original_id, 'uxbarn_testimonials', true ) );
						$id_array[ $title ] = $original_id;
						
					}
					
					
				} else { // If there is no WPML
					$id_array[ $post->post_title ] = $post->ID;
				}
				
			endforeach;
			
		} else {
			//echo 'No!';
		}

		wp_reset_postdata();
		
		$list_heading = __( 'Available items', 'uxb_tmnl' );
		
		vc_map( array(
		   'name' 		=> __( 'Testimonials', 'uxb_tmnl' ),
		   'base' 		=> 'uxb_testimonials',
		   'icon' 		=> 'icon-wpb-uxb_testimonials',
		   'class' 		=> '',
		   'category' 	=> __( 'Content', 'uxb_tmnl' ),
		   'params' 	=> array(
		      array(
		         'type' 		=> 'checkbox',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> $list_heading,
		         'param_name' 	=> 'id_list',
		         'value' 		=> $id_array,
		         'description' 	=> __( 'Select the items from the list.', 'uxb_tmnl' ),
		         'admin_label' 	=> false,
		      ),
		      array(
		         'type' 		=> 'dropdown',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Style', 'uxb_tmnl' ),
		         'param_name' 	=> 'type',
		         'value' 		=> array(
				                        __( 'Full-width + thumbnail (work best on 1/1 column)', 'uxb_tmnl' ) => 'full-width', 
				                        __( 'Text only + float left', 'uxb_tmnl' ) 	=> 'left',
				                        __( 'Text only + float right', 'uxb_tmnl' ) => 'right',
				                    ),
		         'description' 	=> __( 'Choose the testimonial style.', 'uxb_tmnl' ),
		         'admin_label' 	=> true,
		      ),
		      array(
		         'type' 		=> 'textfield',
		         'holder' 		=> 'div',
		         'class' 		=> '',
		         'heading' 		=> __( 'Width', 'uxb_tmnl' ),
		         'param_name' 	=> 'width',
		         'value' 		=> '',
		         'description' 	=> __( 'Specify the width in % or px unit. Example: <em>400px</em> OR <em>50%</em>. Leave it blank to use 100% width as default.', 'uxb_tmnl' ),
		         'dependency' 	=> array(
		                            'element' 	=> 'type',
		                            'value' 	=> array( 'left', 'right' ),
		                        ),
		         'admin_label' 	=> false,
		      ),
		      array(
                 'type' 		=> 'dropdown',
                 'holder' 		=> 'div',
                 'class' 		=> '',
                 'heading' 		=> __( 'Auto rotation duration', 'uxb_tmnl' ),
                 'param_name' 	=> 'interval',
                 'value' 		=> array(
		                                __( 'Disable auto rotation', 'uxb_tmnl' ) => '0',
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
                 'description' 	=> __( 'Select how many seconds to stay on current slide before rotating to the next one.', 'uxb_tmnl' ),
                 'admin_label' 	=> false,
              ),
              array(
	             'type' 		=> 'dropdown',
	             'holder' 		=> 'div',
	             'class' 		=> '',
	             'heading' 		=> __( 'Order by', 'uxb_tmnl' ),
	             'param_name' 	=> 'orderby',
	             'value' 		=> array(
			                            __( 'ID', 'uxb_tmnl' ) 			 	=> 'ID', 
			                            __( 'Title', 'uxb_tmnl' ) 		 	=> 'title',
			                            __( 'Slug', 'uxb_tmnl' ) 			=> 'name',
			                            __( 'Published Date', 'uxb_tmnl' ) 	=> 'date',
			                            __( 'Modified Date', 'uxb_tmnl' )  	=> 'modified',
			                            __( 'Random', 'uxb_tmnl' ) 		 	=> 'rand',
			                        ),
	             'description' 	=> __( 'Select the which parameter to be used for ordering. <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxb_tmnl' ),
	             'admin_label' 	=> false,
	          ),
	          array(
	             'type' 		=> 'dropdown',
	             'holder' 		=> 'div',
	             'class' 		=> '',
	             'heading' 		=> __( 'Order', 'uxb_tmnl' ),
	             'param_name' 	=> 'order',
	             'value' 		=> array(
			                            __( 'Ascending', 'uxb_tmnl' )  => 'ASC', 
			                            __( 'Descending', 'uxb_tmnl' ) => 'DESC',
			                        ),
	             'description' 	=> __( '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">See more info here</a>', 'uxb_tmnl' ),
	             'admin_label' 	=> false,
	          ),
		   )
		) );
		
	}
	
}



if ( ! function_exists( 'uxb_tmnl_load_shortcodes' ) ) {
		
	function uxb_tmnl_load_shortcodes() {
		
		add_shortcode( 'uxb_testimonials', 'uxb_tmnl_load_testimonials_shortcode' );
		
	}
	
}



if ( ! function_exists( 'uxb_tmnl_register_widgets' ) ) {
		
	function uxb_tmnl_register_widgets() {
		
    	register_widget( 'UXTestimonialWidget' );
		
	}
	
}

