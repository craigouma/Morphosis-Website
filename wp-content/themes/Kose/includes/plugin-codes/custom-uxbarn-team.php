<?php

/***** UXbarn Team *****/
if ( ! function_exists( 'uxbarn_team_custom' ) ) {
	
	function uxbarn_team_custom() {
		
		// Remove default plugin's actions/functions
		remove_image_size( 'uxb-team-single-page' ); 
		remove_action( 'admin_init', 'uxb_team_create_meta_boxes' );
		// Remove plugin's because most styles are in style.css of the theme
		remove_action( 'wp_enqueue_scripts', 'uxb_team_load_on_demand_assets' );
		remove_action( 'init', 'uxb_team_register_cpt', 11 );
		remove_shortcode( 'uxb_team' );
		
		// Use theme's custom actions/functions
		add_image_size( 'uxb-team-single-page', 314, 9999, true ); // Set a new size for the same "uxb-team-single-page" name defined by the plugin (after removing it above)
		add_action( 'init', 'uxbarn_custom_team_register_cpt', 11 );
		add_shortcode( 'uxb_team', 'uxbarn_custom_team_load_team_shortcode' ); // Re-enable this shortcode to use the custom function of the theme
		
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			add_action( 'admin_init', 'uxbarn_custom_team_create_meta_boxes' );
		}
		

	}
	
}



if ( ! function_exists( 'uxbarn_custom_team_register_cpt' ) ) {

	function uxbarn_custom_team_register_cpt() {
		
		$args = array(
            'label' 			=> __( 'Team', 'uxb_team' ),
            'labels' 			=> array(
				                        'singular_name'		=> __( 'Team Member', 'uxb_team' ),
				                        'add_new' 			=> __( 'Add New Member', 'uxb_team' ),
				                        'add_new_item' 		=> __( 'Add New Member', 'uxb_team' ),
				                        'new_item' 			=> __( 'New Member', 'uxb_team' ),
				                        'edit_item' 		=> __( 'Edit Member', 'uxb_team' ),
				                        'all_items' 		=> __( 'All Members', 'uxb_team' ),
				                        'view_item' 		=> __( 'View', 'uxb_team' ),
				                        'search_items' 		=> __( 'Search Member', 'uxb_team' ),
				                        'not_found' 		=> __( 'Nothing found', 'uxb_team' ),
				                        'not_found_in_trash' => __( 'Nothing found in Trash', 'uxb_team' ),
			                        ),
            'menu_icon' 		=> UXB_TEAM_URL . 'images/uxbarn_sm2.jpg',
            'description' 		=> __( 'Team', 'uxb_team' ),
            'public' 			=> true,
            'show_ui' 			=> true,
            'capability_type' 	=> 'post',
            'hierarchical' 		=> false,
            'has_archive' 		=> false,
            'supports' 			=> array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'rewrite' 			=> array( 'slug' => __( 'team', 'uxb_team' ), 'with_front' => false ) );
        
		// Register post type (DO NOT CHANGE THE CODE HERE!)
        register_post_type( 'uxbarn_team', $args );
        
        add_filter('manage_uxbarn_team_posts_columns', 'uxb_team_create_team_columns_header'); // this function is in the plugin
        add_action('manage_uxbarn_team_posts_custom_column', 'uxb_team_create_team_columns_content'); // this function is in the plugin 
		
	}
	
}



if ( ! function_exists( 'uxbarn_custom_team_create_meta_boxes' ) ) {
	
	function uxbarn_custom_team_create_meta_boxes() {
		
		uxbarn_custom_team_create_team_excerpt_setting();
        uxbarn_custom_team_create_team_single_page_image_setting();
        uxbarn_custom_team_create_team_meta_info();
        uxbarn_custom_team_create_team_social_network_setting();
		
	}

}



if ( ! function_exists( 'uxbarn_custom_team_create_team_excerpt_setting' ) ) {

    function uxbarn_custom_team_create_team_excerpt_setting() {
        
        $args = array(
            'id'          => 'uxbarn_team_excerpt_meta_box',
            'title'       => __( 'Team Member Excerpt Setting', 'uxb_team' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                'id'          => 'uxbarn_team_excerpt',
                'label'       => __( 'Excerpt', 'uxb_team' ),
                'desc'        => __( 'The excerpt or short description of this member. It will only be used in the team member element. This should be short and concise.', 'uxb_team' ),
                'std'         => '',
                'type'        => 'textarea-simple',
                'section'     => 'uxbarn_team_excerpt_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              )
            )
        );
        
        ot_register_meta_box( $args );
        
    }

}



if( ! function_exists( 'uxbarn_custom_team_create_team_meta_info' ) ) {
    
    function uxbarn_custom_team_create_team_meta_info() {
    	
        $args = array(
            'id'          => 'uxbarn_team_meta_info_meta_box',
            'title'       => __( 'Team Member Meta Info Setting', 'uxb_team' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_team_meta_info_position',
                    'label'       => __( 'Position', 'uxb_team' ),
                    'desc'        => __( 'Enter the position of this member. Example: <em>Co-founder</em>', 'uxb_team' ),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_team_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_team_meta_info_email',
                    'label'       => __( 'Email', 'uxb_team' ),
                    'desc'        => __( 'Enter the email of this member', 'uxb_team' ),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_team_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
            )
        );
        
        ot_register_meta_box( $args );
		
    }

}



if ( ! function_exists( 'uxbarn_custom_team_create_team_social_network_setting' ) ) {
    
    function uxbarn_custom_team_create_team_social_network_setting() {
    	
		$social_url_desc = __( 'Please make sure to put "http://" at the front of the URL.', 'uxb_team' );
        
		$plugin_options = get_option( 'uxb_team_plugin_options', '' );
		$social_set = isset( $plugin_options['uxb_team_po_social_set'] ) ? $plugin_options['uxb_team_po_social_set'] : 'default';
		
		$args = array(
		            'id'          => 'uxbarn_team_social_network_meta_box',
		            'title'       => __( 'Social Network Setting', 'uxb_team' ),
		            'desc'        => '',
		            'pages'       => array( 'uxbarn_team' ),
		            'context'     => 'normal',
		            'priority'    => 'high',
		            'fields'      => array(),
				);
				
		$top_desc = array(
	                'id'          => 'uxbarn_team_social_top_desc',
	                'label'       => '',
	                'desc'        => __( 'Enter the URL for each social network of this member below. If you want to manage the team social icon set, please go to "Settings > UXbarn Team Options"', 'uxb_team' ),
	                'std'         => '',
	                'type'        => 'textblock',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              );
		
		// Default set
		if ( $social_set == '' || $social_set == 'default' ) {
		
	        $args['fields'] = array(
	        		$top_desc,
	                array(
	                'id'          => 'uxbarn_team_social_twitter',
	                'label'       => __( 'Twitter URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	              array(
	                'id'          => 'uxbarn_team_social_facebook',
	                'label'       => __( 'Facebook URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	              array(
	                'id'          => 'uxbarn_team_social_googleplus',
	                'label'       => __( 'Google+ URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	              array(
	                'id'          => 'uxbarn_team_social_linkedin',
	                'label'       => __( 'LinkedIn URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	              array(
	                'id'          => 'uxbarn_team_social_dribbble',
	                'label'       => __( 'Dribbble URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	              array(
	                'id'          => 'uxbarn_team_social_forrst',
	                'label'       => __( 'Forrst URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	              array(
	                'id'          => 'uxbarn_team_social_flickr',
	                'label'       => __( 'Flickr URL', 'uxb_team' ),
	                'desc'        => $social_url_desc,
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_team_social_network_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	              ),
	        );
			
		} else { // custom set
			
			$custom_set = ( isset( $plugin_options['uxb_team_po_social_custom_set'] ) ? $plugin_options['uxb_team_po_social_custom_set'] : array() );
			//echo var_dump($plugin_options);
			
			if ( ! empty( $custom_set ) ) {
				
				$final_custom_set_array = array();
				$counter = 1;
				
				$args['fields'][] = $top_desc;
				
				foreach ( $custom_set as $icon ) {
					
					// Make it lowercase and remove all special chars
					$id = uxb_team_clean_string_for_id( $icon['uxb_team_po_social_custom_set_id'] );
					
					if ( ! empty( $id ) ) {
						
						$title = $icon['title'];
						$image_url = $icon['uxb_team_po_social_custom_set_icon'];
						
						// Push a custom entry into the final array
						$args['fields'][] = array(
							                'id'          => 'uxb_team_po_social_custom_set_' . $id, // custom generated ID
							                'label'       => $title . ' ' . __( 'URL', 'uxb_team' ),
							                'desc'        => $social_url_desc,
							                'std'         => '',
							                'type'        => 'text',
							                'section'     => 'uxbarn_team_social_network_sec',
							                'rows'        => '',
							                'post_type'   => '',
							                'taxonomy'    => '',
							                'class'       => ''
										);
										
					} else {
						
						$desc = '';
						
						$args['fields'][] = 
									array(
											'id'          => 'uxb_team_po_social_custom_set_id_empty_' . $counter,
											'label'       => '',
											'desc'        => sprintf( __( 'You have not assigned the ID for the "%s" social icon yet. Please go to "Settings > UXbarn Team Options" to manage the custom icon list', 'uxb_team' ), $icon['title'] ),
											'std'         => '',
											'type'        => 'textblock',
											'section'     => 'uxbarn_team_social_network_sec',
											'rows'        => '',
											'post_type'   => '',
											'taxonomy'    => '',
											'class'       => ''
										);
						
					}
					
					$counter += 1;
					
				}
			
			} else {
				
				
				$args['fields'] = array(
									array(
											'id'          => 'uxb_team_po_social_custom_set_empty',
											'label'       => '',
											'desc'        => __( 'You have not added any custom social icons yet. Please go to "Settings > UXbarn Team Options" to manage the custom icon list', 'uxb_team' ),
											'std'         => '',
											'type'        => 'textblock',
											'section'     => 'uxbarn_team_social_network_sec',
											'rows'        => '',
											'post_type'   => '',
											'taxonomy'    => '',
											'class'       => ''
										),
									);
				
				
			}
			
		}
        
        ot_register_meta_box( $args );
        
    }

}



if ( ! function_exists( 'uxbarn_custom_team_create_team_single_page_image_setting' ) ) {
	
    function uxbarn_custom_team_create_team_single_page_image_setting() {
    	
        $args = array(
            'id'          => 'uxbarn_team_header_single_page_image_meta_box',
            'title'       => __( 'Single Page Image Setting', 'uxb_team' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_team' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_team_single_page_image_upload',
                    'label'       => __( 'Upload Single Page Image', 'uxb_team' ),
                    'desc'        => __( 'This image will be used in the single page of this team member only. <strong>Recommended dimension is 314x720</strong>. To upload the member thumbnail, please use Featured Image.', 'uxb_team' ),
                    'std'         => '',
                    'type'        => 'upload',
                    'section'     => 'uxbarn_team_single_page_image_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
            )
        );
        
        ot_register_meta_box( $args );
		
    }

}



if ( ! function_exists( 'uxbarn_custom_team_get_member_social_list_string' ) ) {
	
	function uxbarn_custom_team_get_member_social_list_string( $member_id ) {
		
		$plugin_options = get_option( 'uxb_team_plugin_options', '' );
		$social_set = isset( $plugin_options['uxb_team_po_social_set'] ) ? $plugin_options['uxb_team_po_social_set'] : 'default';
		
		// Default set
		if ( $social_set == '' || $social_set == 'default' ) {
			
		    $social_name_array = array(
		        __('Twitter', 'uxb_team') 	=> 'uxbarn_team_social_twitter', 
		        __('Facebook', 'uxb_team') 	=> 'uxbarn_team_social_facebook', 
		        __('Google+', 'uxb_team') 	=> 'uxbarn_team_social_googleplus',  
		        __('LinkedIn', 'uxb_team') 	=> 'uxbarn_team_social_linkedin', 
		        __('Dribbble', 'uxb_team') 	=> 'uxbarn_team_social_dribbble', 
		        __('Forrst', 'uxb_team') 	=> 'uxbarn_team_social_forrst', 
		        __('Flickr', 'uxb_team') 	=> 'uxbarn_team_social_flickr',
		    );
		    
		    $social_list_item_string = '';
			
		    foreach ( $social_name_array as $key => $value ) {
		        $social_list_item_string .= uxbarn_custom_team_get_member_social_list_item( $member_id, $value, $key );
		    }
		    
		    return $social_list_item_string;
			
		} else { // Custom set
		
			$custom_set = ( isset( $plugin_options['uxb_team_po_social_custom_set'] ) ? $plugin_options['uxb_team_po_social_custom_set'] : array() );
			
			if ( ! empty( $custom_set ) ) {
				
				$social_list_item_string = '';
				
				foreach ( $custom_set as $icon ) {
					
					$social_unique_id = 'uxb_team_po_social_custom_set_' . uxb_team_clean_string_for_id ( $icon['uxb_team_po_social_custom_set_id'] );
					
					$title = $icon['title'];
					$url = trim( uxb_team_get_array_value( get_post_meta( $member_id, $social_unique_id ), 0 ) ); // custom generated ID of meta field
					$image_url = $icon['uxb_team_po_social_custom_set_icon'];
					
					$icon_width = 22;
					$icon_height = 22;
					$icon_attachment = wp_get_attachment_image_src( uxbarn_get_attachment_id_from_src( $image_url ) );
					
					if ( $icon_attachment ) {
						
						$icon_width = $icon_attachment[1];
						$icon_height = $icon_attachment[2];
						
					}
					
					if ( $url ) {
						$social_list_item_string .= '<li><a href="' . $url . '" target="_blank"><img src="' . $image_url . '" alt="' . $title . '" title="' . $title . '" width="' . $icon_width . '" height="' . $icon_height . '" /></a></li>';
					}
					
				}
				
				return $social_list_item_string;
				
			} else {
				return '';
			}
		
		}
		
	}
	
}

if ( ! function_exists( 'uxbarn_custom_team_get_member_social_list_item' ) ) {
	
	function uxbarn_custom_team_get_member_social_list_item( $member_id, $custom_field_id, $name ) {
	    
	    $link = trim( uxb_team_get_array_value( get_post_meta( $member_id, $custom_field_id ), 0 ) );
		$filename = strtolower( $name );
	    
		if ( $filename == 'google+' ) {
			$filename = 'google_plus';
		}

		// Default plugin icon, width and height
		$icon_image_src = UXB_THEME_ROOT_IMAGE_URL . 'social/team/' . $filename . '.png';
		$icon_width = 22;
		$icon_height = 22;
		
		// If there is custom icon specified, use it instead
		$plugin_options = get_option( 'uxb_team_plugin_options' );
		$option_icon = $plugin_options[ 'uxb_team_po_social_icon_' . $filename ];
		
		if ( trim( $option_icon ) != '' ) {
			
			$icon_image_src = $option_icon;
			$icon_attachment = wp_get_attachment_image_src( uxbarn_get_attachment_id_from_src( $option_icon ) );
			
			if ( $icon_attachment ) {
				
				$icon_width = $icon_attachment[1];
				$icon_height = $icon_attachment[2];
				
			}
			
		}
		
	    if ( $link ) {
	        return '<li><a href="' . $link . '" target="_blank"><img src="' . $icon_image_src . '" alt="' . $name . '" title="' . $name . '" width="' . $icon_width . '" height="' . $icon_height . '" /></a></li>';
	    } else {
	        return '';
	    }
	}
	
}



if ( ! function_exists( 'uxbarn_custom_team_load_team_shortcode' ) ) {
    
    function uxbarn_custom_team_load_team_shortcode( $atts ) {
    	
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
                
                $social_list_item_string = uxbarn_custom_team_get_member_social_list_string( $member_id );
                
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