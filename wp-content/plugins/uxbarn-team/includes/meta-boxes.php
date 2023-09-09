<?php

if ( ! function_exists( 'uxb_team_create_meta_boxes' ) ) {
	
	function uxb_team_create_meta_boxes() {
		
		uxb_team_create_team_excerpt_setting();
        uxb_team_create_team_single_page_image_setting();
        uxb_team_create_team_meta_info();
        uxb_team_create_team_social_network_setting();
		
	}

}



if ( ! function_exists( 'uxb_team_create_team_excerpt_setting' ) ) {

    function uxb_team_create_team_excerpt_setting() {
        
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



if( ! function_exists( 'uxb_team_create_team_meta_info' ) ) {
    
    function uxb_team_create_team_meta_info() {
    	
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



if ( ! function_exists( 'uxb_team_create_team_social_network_setting' ) ) {
    
    function uxb_team_create_team_social_network_setting() {
    	
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



if ( ! function_exists( 'uxb_team_create_team_single_page_image_setting' ) ) {
	
    function uxb_team_create_team_single_page_image_setting() {
    	
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
                    'desc'        => __( 'This image will be used in the single page of this team member only. <strong>Recommended dimension is 420x850.</strong>. To upload the member thumbnail, please use Featured Image.', 'uxb_team' ),
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