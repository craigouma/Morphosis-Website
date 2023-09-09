<?php

/***** UXbarn Portfolio *****/
if ( ! function_exists( 'uxbarn_portfolio_custom' ) ) {
	
	function uxbarn_portfolio_custom() {
		
		// Remove default plugin's actions/functions
		remove_image_size( 'uxb-port-element-thumbnails' );
		remove_image_size( 'uxb-port-related-items' );
		remove_image_size( 'uxb-port-single-landscape' );
		remove_image_size( 'uxb-port-single-portrait' );
		remove_image_size( 'uxb-port-large-square' );
		
		remove_action( 'admin_enqueue_scripts', 'uxb_port_load_admin_assets' );
		remove_action( 'wp_enqueue_scripts', 'uxb_port_load_on_demand_assets' );
		remove_action( 'init', 'uxb_port_register_cpt', 11 );
		remove_action( 'admin_init', 'uxb_port_create_meta_boxes' );
		remove_shortcode( 'uxb_portfolio' );
		
		
		// Use theme's custom actions/functions
		add_image_size( 'uxb-port-element-thumbnails', 265, 265, true );
		add_image_size( 'uxb-port-related-items', 198, 198, true );
		
		add_action( 'admin_enqueue_scripts', 'uxbarn_custom_port_load_admin_assets' );
		add_action( 'init', 'uxbarn_custom_port_register_cpt', 11 );
		
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			add_action( 'admin_init', 'uxbarn_custom_port_create_meta_boxes' );
		}
		
		add_shortcode( 'uxb_portfolio', 'uxbarn_custom_port_load_portfolio_shortcode' ); 
		

	}
	
}



if ( ! function_exists( 'uxbarn_custom_port_load_admin_assets' ) ) {
		
	function uxbarn_custom_port_load_admin_assets( $page ) {
		
		global $post;
		
		// For new-post, edit-post or portfolio list pages, and belongs to "uxbarn_portfolio" post type
		if ( ( $page == 'post.php' || $page == 'post-new.php' ) || 
			 ( $page == 'edit.php' && ( isset( $post ) && $post->post_type == 'uxbarn_portfolio' ) ) ) {
					
			wp_enqueue_style( 'uxb-port-backend', UXB_PORT_URL . 'css/plugin-backend.css', array(), null );
		}
		
		
		// For plugin options page
		if ( $page == 'settings_page_uxb_port_options' ) {
			
			wp_enqueue_script( 'uxb-port-options', UXB_PORT_URL . 'js/plugin-options.js', false );
			wp_enqueue_style( 'uxb-port-options', UXB_PORT_URL . 'css/plugin-options.css', false );
			
	        $params = array(
	            'header_text' 	=> __( 'Please find below for some options that you can set for UXbarn Portfolio plugin.', 'uxb_port' ),
	        );
			
	        wp_localize_script( 'uxb-port-options', 'UXbarnPortOptions', $params );
			
		}
		
	}
	
}



if ( ! function_exists( 'uxbarn_custom_port_register_cpt' ) ) {

	function uxbarn_custom_port_register_cpt() {
	
		$args = array(
		            'label' 			=> __( 'Portfolio', 'uxb_port' ),
		            'labels' 			=> array(
						                        'singular_name'		=> __( 'Portfolio', 'uxb_port' ),
						                     	'add_new' 			=> __( 'Add New Portfolio Item', 'uxb_port' ),
						                        'add_new_item' 		=> __( 'Add New Portfolio Item', 'uxb_port' ),
						                        'new_item' 			=> __( 'New Portfolio Item', 'uxb_port' ),
						                        'edit_item' 		=> __( 'Edit Portfolio Item', 'uxb_port' ),
						                        'all_items' 		=> __( 'All Portfolio Items', 'uxb_port' ),
						                        'view_item' 		=> __( 'View Portfolio', 'uxb_port' ),
						                        'search_items' 		=> __( 'Search Portfolio', 'uxb_port' ),
						                        'not_found' 		=> __( 'Nothing found', 'uxb_port' ),
						                        'not_found_in_trash' => __( 'Nothing found in Trash', 'uxb_port' ),
			                        		),
		            'menu_icon' 		=> UXB_PORT_URL . 'images/uxbarn_sm2.jpg',
		            'description' 		=> __( 'Portfolio of your business', 'uxb_port' ),
		            'public' 			=> true,
		            'show_ui' 			=> true,
		            'capability_type' 	=> 'post',
		            'hierarchical' 		=> false,
		            'has_archive' 		=> false,
		            'supports' 			=> array( 'title', 'editor', 'thumbnail', 'revisions', 'comments' ),
		            'rewrite' 			=> array( 'slug' => __( 'portfolio', 'uxb_port' ), 'with_front' => false )
	        	);
		
		// Register post type (DO NOT CHANGE THE CODE HERE!)
		register_post_type( 'uxbarn_portfolio', $args );
		
		
		
		$labels = array(
			'singular_name' => __( 'Portfolio Category', 'uxb_port' ),
            'search_items' 	=> __( 'Search Categories', 'uxb_port' ),
            'all_items' 	=> __( 'All Categories', 'uxb_port' ),
            'edit_item' 	=> __( 'Edit Category', 'uxb_port' ), 
            'update_item' 	=> __( 'Update Category', 'uxb_port' ),
            'add_new_item' 	=> __( 'Add New Category', 'uxb_port' ),
        );
		
		// Register taxonomy (DO NOT CHANGE THE CODE HERE!)
		register_taxonomy( 'uxbarn_portfolio_tax', array( 'uxbarn_portfolio' ),
            array(
                'hierarchical' 		=> true, 
                'labels' 			=> $labels,
                'label' 			=> __( 'Portfolio Categories', 'uxb_port' ), 
                'singular_label' 	=> __( 'Portfolio Category', 'uxb_port' ),
                'rewrite' 			=> array( 'slug' => __( 'portfolio-category', 'uxb_port' ) ),
            )
        );
        
		// Custom columns
        add_filter( 'manage_uxbarn_portfolio_posts_columns', 'uxbarn_custom_port_create_columns_header' );  
        add_action( 'manage_uxbarn_portfolio_posts_custom_column', 'uxbarn_custom_port_create_columns_content' );  
		
	}

}



if ( ! function_exists( 'uxbarn_custom_port_create_columns_header' ) ) {
	
    function uxbarn_custom_port_create_columns_header( $defaults ) {
    	
        $custom_columns = array(
            'cb' 			=> '<input type=\"checkbox\" />',
            'title' 		=> __( 'Title', 'uxb_port' ),
            'cover_image' 	=> __( 'Thumbnail', 'uxb_port' ),
            'terms' 		=> __( 'Categories', 'uxb_port' )
        );

        $defaults= array_merge( $custom_columns, $defaults );
        return $defaults;
        
    }
    
}



if ( ! function_exists( 'uxbarn_custom_port_create_columns_content') ) {
	
    function uxbarn_custom_port_create_columns_content( $column ) {
    	
        global $post;
        switch ( $column )
        {
            case 'cover_image':
                the_post_thumbnail( 'thumbnail' );
                break;
            case 'terms':
                $terms = get_the_terms( $post->ID, 'uxbarn_portfolio_tax' );
				
                if ( ! empty( $terms ) ) {
                    $out = array();
                    foreach ( $terms as $term )
                        $out[] = '<a href="' . get_term_link( $term->slug, 'uxbarn_portfolio_tax' ) .'">' . $term->name . '</a>';
                        $return = join( ', ', $out );
                        echo $return;
                
                } else {
                    echo ' ';
                }
                break;
        }
		
    }
	
}



if ( ! function_exists( 'uxbarn_custom_port_create_meta_boxes' ) ) {
	
	function uxbarn_custom_port_create_meta_boxes() {
		
		uxbarn_custom_port_create_alternate_content();
        uxbarn_custom_port_create_meta_info();
		uxbarn_custom_port_create_porfolio_slideshow();
        uxbarn_custom_port_create_item_format_setting();
        uxbarn_custom_port_create_image_slideshow_format_content();
        //uxb_port_create_video_format_content();
		
	}

}



if ( ! function_exists( 'uxbarn_custom_port_create_alternate_content' ) ) {
		
	function uxbarn_custom_port_create_alternate_content() {
		
		$args = array(
	        'id'          => 'uxbarn_portfolio_alternate_content_meta_box',
	        'title'       => __( 'Alternate Content Settings', 'uxb_port' ),
	        'desc'        => '',
	        'pages'       => array( 'uxbarn_portfolio' ),
	        'context'     => 'normal',
	        'priority'    => 'high',
	        'fields'      => array(
	            array(
	                'id'          => 'uxbarn_portfolio_alternate_thumbnail',
	                'label'       => __( 'Alternate Thumbnail for Slider Type of Portfolio Element', 'uxb_port' ),
	                'desc'        => __( 'By default, when using Portfolio Element (via Visual Composer) on a page with "Grid Columns" type, it will use Featured Image for each item thumbnail. If you want to use the "Slider" type with different thumbnail, you can use this option.<br/><br/>Note that if you leave this blank, the "Slider" type will also use Featured Image for the thumbnail.', 'uxb_port' ),
	                'std'         => '',
	                'type'        => 'upload',
	                'section'     => 'uxbarn_portfolio_alternate_content_sec',
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



if ( ! function_exists( 'uxbarn_custom_port_create_meta_info' ) ) {
	
	function uxbarn_custom_port_create_meta_info() {
		
		$args = array(
            'id'          => 'uxbarn_portfolio_meta_info_meta_box',
            'title'       => __( 'Portfolio Meta Info Setting', 'uxb_port' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_display',
                    'label'       => __( 'Show meta info of this item?', 'uxb_port' ),
                    'desc'        => __( 'Use this option if you want to show or hide meta information on single page.', 'uxb_port' ),
                    'std'         => 'true',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'true',
                        'label'       => __( 'Yes', 'uxb_port' ),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'false',
                        'label'       => __( 'No', 'uxb_port' ),
                        'src'         => ''
                      ),
                  )
              ),
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_date',
                    'label'       => __( 'Date', 'uxb_port' ),
                    'desc'        => __( 'Enter the creation date of this item. Example: <em>March 15, 2013</em>', 'uxb_port' ),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_client',
                    'label'       => __( 'Client', 'uxb_port' ),
                    'desc'        => __( 'Enter the client name', 'uxb_port' ),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_website',
                    'label'       => __( 'Website', 'uxb_port' ),
                    'desc'        => __( 'Enter the website. Example: <em>www.uxbarn.com</em>', 'uxb_port' ),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
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


if ( ! function_exists( 'uxbarn_custom_port_create_porfolio_slideshow' ) ) {
	
	function uxbarn_custom_port_create_porfolio_slideshow() {
		
		$args = array(
            'id'          => 'uxbarn_portfolio_porfolio_slideshow_meta_box',
            'title'       => __( 'Portfolio Background Slideshow', 'uxb_port' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
               array(
                'id'          => 'uxbarn_portfolio_slideshow',
                'label'       => __( 'Image Slides', 'uxb_port' ),
                'desc'        => __( 'You can use this setting to add the images/video clips for this portfolio item. They will be displayed as fullscreen slider.', 'uxb_port' ),
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'uxbarn_portfolio_slideshow_format_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array( 

					// UXbarn Portfolio plugin's field	  
                    array(
                        'id'          => 'uxbarn_portfolio_slideshow_upload',
                        'label'       => __( 'Image', 'uxb_port' ),
                        'desc'        => __( 'Upload an image for this slide. Recommended size is "2048x1365".', 'uxbarn' ),
                        'std'         => '',
                        'type'        => 'upload',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => 'slide-image-type',
						//'condition'   => 'uxbarn_fullscreen_slider_slide_type:is(image)',
						'operator'    => 'and'
                      ),
                ),
              ),
            )
        );
        
        ot_register_meta_box( $args );
		
	}

}


if ( ! function_exists( 'uxbarn_custom_port_create_item_format_setting' ) ) {
		
	function uxbarn_custom_port_create_item_format_setting() {
		
		$args = array(
            'id'          => 'uxbarn_portfolio_item_format_meta_box',
            'title'       => __( 'Portfolio Item Format Setting', 'uxb_port' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_item_format',
                    'label'       => __( 'Portfolio Item Format', 'uxb_port' ),
                    'desc'        => __( 'Select the format for this item. Then you can manage its specific content using the meta box below.<br/><br/>Every format uses <strong>Featured Image for thumbnail</strong> and <strong>meta box below for content</strong> (in single page).', 'uxb_port' ),
                    'std'         => 'image-slideshow',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_portfolio_item_format_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'image-slideshow',
                        'label'       => __( 'Image/Slideshow', 'uxb_port' ),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'video',
                        'label'       => __( 'Video', 'uxb_port' ),
                        'src'         => ''
                      ),
                    ),
                ),
            )
        );
        
        ot_register_meta_box( $args );
		
	}

}



if ( ! function_exists( 'uxbarn_custom_port_create_image_slideshow_format_content' ) ) {
	
	function uxbarn_custom_port_create_image_slideshow_format_content() {
		
		$args = array(
            'id'          => 'uxbarn_portfolio_image_slideshow_format_meta_box',
            'title'       => __( 'Meta Box for Fullscreen Slider', 'uxb_port' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                'id'          => 'uxbarn_portfolio_image_slideshow',
                'label'       => __( 'Slides', 'uxb_port' ),
                'desc'        => __( 'You can use this setting to add the images/video clips for this portfolio item. They will be displayed as fullscreen slider.', 'uxb_port' ),
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'uxbarn_portfolio_slideshow_format_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array( 
                	array(
						'id'          => 'uxbarn_fullscreen_slider_caption_text',
						'label'       => __( 'Caption Text', 'uxbarn' ),
						'desc'        => __( 'Enter the caption text for this slide.', 'uxbarn' ),
						'std'         => '',
						'type'        => 'textarea-simple',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and'
					  ),
	                  array(
						'id'          => 'uxbarn_fullscreen_slider_caption_optional_link_text',
						'label'       => __( 'Optional Link Text', 'uxbarn' ),
						'desc'        => __( 'Enter the text for the optional link to display with caption. You can leave it blank if you do not want to use the link.', 'uxbarn' ),
						'std'         => '',
						'type'        => 'text',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and'
					  ),
					  array(
						'id'          => 'uxbarn_fullscreen_slider_caption_optional_link_url',
						'label'       => __( 'Optional Link URL', 'uxbarn' ),
						'desc'        => __( 'Enter the target URL for the link. For example: http://www.uxbarn.com', 'uxbarn' ),
						'std'         => '',
						'type'        => 'text',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and'
					  ),
					  array(
	                    'id'          => 'uxbarn_fullscreen_slider_caption_color',
	                    'label'       => __( 'Caption Color', 'uxbarn' ),
	                    'desc'        => __( 'Select custom color for the caption.', 'uxbarn' ),
	                    'std'         => '',
	                    'type'        => 'colorpicker',
	                    'rows'        => '',
	                    'post_type'   => '',
	                    'taxonomy'    => '',
	                    'class'       => '',
	                  ),
					  array(
						'id'          => 'uxbarn_fullscreen_slider_caption_display',
						'label'       => __( 'Display Caption?', 'uxbarn' ),
						'desc'        => __( 'Whether to display the caption for this slide.', 'uxbarn' ),
						'std'         => 'on',
						'type'        => 'on-off',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and'
					  ),
					  array(
						'id'          => 'uxbarn_fullscreen_slider_slide_type',
						'label'       => __( 'Type', 'uxbarn' ),
						'desc'        => __( 'Select the type for this slide.', 'uxbarn' ),
						'std'         => '',
						'type'        => 'select',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and',
		                'choices'     => array( 
		                  array(
		                    'value'       => 'image',
		                    'label'       => __( 'Image', 'uxbarn' ),
		                    'src'         => ''
		                  ),
		                  array(
		                    'value'       => 'video',
		                    'label'       => __( 'Video', 'uxbarn' ),
		                    'src'         => ''
		                  )
		                ),
					  ),
					
					// UXbarn Portfolio plugin's field	  
                    array(
                        'id'          => 'uxbarn_portfolio_image_slideshow_upload',
                        'label'       => __( 'Image', 'uxb_port' ),
                        'desc'        => __( 'Upload an image for this slide. Recommended size is "2048x1365".', 'uxbarn' ),
                        'std'         => '',
                        'type'        => 'upload',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => 'slide-image-type',
						'condition'   => 'uxbarn_fullscreen_slider_slide_type:is(image)',
						'operator'    => 'and'
                      ),
                      
					  array(
						'id'          => 'uxbarn_fullscreen_slider_video_cover_image',
						'label'       => __( 'Video Cover Image', 'uxbarn' ),
						'desc'        => __( 'Upload a cover image for this video-type slide. The cover image will display when the video clip is loading and will be used on mobile devices.', 'uxbarn' ),
						'std'         => '',
						'type'        => 'upload',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => 'slide-video-type',
						'condition'   => 'uxbarn_fullscreen_slider_slide_type:is(video)',
						'operator'    => 'and'
					  ),
					  array(
						'id'          => 'uxbarn_fullscreen_slider_video_upload',
						'label'       => __( 'Video Clip', 'uxbarn' ),
						'desc'        => __( 'Upload a video clip for this slide. The video file should be in <strong>".mp4"</strong> format and the file size should not be too large.', 'uxbarn' ),
						'std'         => '',
						'type'        => 'upload',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'min_max_step'=> '',
						'class'       => 'slide-video-type',
						'condition'   => 'uxbarn_fullscreen_slider_slide_type:is(video)',
						'operator'    => 'and'
					  ),
					  
                ),
              ),
          		
				array(
					'id'          => 'uxbarn_fullscreen_slider_caption_style',
					'label'       => __( 'Caption Style', 'uxbarn' ),
					'desc'        => __( 'Select the caption style for the slider.', 'uxbarn' ),
					'std'         => '',
					'type'        => 'select',
					'rows'        => '',
					'post_type'   => '',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => '',
					'condition'   => '',
					'operator'    => 'and',
	                'choices'     => array( 
	                  array(
	                    'value'       => 'animating',
	                    'label'       => __( 'Animating', 'uxbarn' ),
	                    'src'         => ''
	                  ),
	                  array(
	                    'value'       => 'normal',
	                    'label'       => __( 'Normal', 'uxbarn' ),
	                    'src'         => ''
	                  )
	                ),
				  ),
				  array(
                    'id'          => 'uxbarn_fullscreen_slider_bullet_color',
                    'label'       => __( 'Slider Bullet Color', 'uxbarn' ),
                    'desc'        => __( 'Select custom color for the bullets.', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'colorpicker',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                  ),
                  
              /*array(
                    'id'          => 'uxbarn_portfolio_image_slideshow_layout',
                    'label'       => __( 'Layout Mode', 'uxb_port' ),
                    'desc'        => __( 'Select which layout to use for the single page.', 'uxb_port' ),
                    'std'         => 'landscape',
                    'type'        => 'select',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'landscape',
                        'label'       => __( 'Landscape', 'uxb_port' ),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'portrait',
                        'label'       => __( 'Portrait', 'uxb_port' ),
                        'src'         => ''
                      ),
                    ),
                  ),
                  */
				  
            )
        );
        
        ot_register_meta_box( $args );
		
	}

}



if ( ! function_exists( 'uxbarn_custom_port_load_portfolio_shortcode' ) ) {
    
    function uxbarn_custom_port_load_portfolio_shortcode( $atts ) {
    	
        $default_atts = array(
                            'categories' 	=> '',
                            'max_item' 		=> '',
                            'type' 			=> 'col4', // col3, col4, flexslider_fade, flexslider_slide
                            'show_filter' 	=> 'true', // true, false
                            'show_title' 	=> 'true', // true, false
                            'img_size' 		=> '',
                            'interval' 		=> '', // 0, 5, ..
                            'show_bullets' 	=> 'true', // true, false
                            'orderby' 		=> '',
                            'order' 		=> '',
                            'el_class' 	=> '',
                        );              
						
        extract( shortcode_atts( $default_atts, $atts ) );
        
		if ( trim( $categories ) == '' ) {
            return '<div class="error box">' . __( 'Cannot generate Portfolio element. Categories must be defined.', 'uxb_port' ) . '</div>';
        }

        $category_id_list = explode( ',', $categories );
		
		// If WPML is active, get translated category's ID
		if ( function_exists( 'icl_object_id' ) ) {
			
			$wpml_cat_list = array();
			
			foreach ( $category_id_list as $cat_id ) {
				$wpml_cat_list[] = icl_object_id( $cat_id, 'uxbarn_portfolio_tax', false, ICL_LANGUAGE_CODE );
			}
			
			$category_id_list = $wpml_cat_list;
			
		}
		
		
		if ( ! is_numeric( $max_item ) ) {
            $max_item = '';
        }
        
		// Prepare WP_Query args
        if ( $max_item == '' ) {
        	
            $args = array(
                'post_type' 	=> 'uxbarn_portfolio',
                'nopaging' 		=> true,
                'tax_query' 	=> array(
	                                    array(
		                                    'taxonomy'  => 'uxbarn_portfolio_tax',
		                                    'field' 	=> 'id',
		                                    'terms' 	=> $category_id_list,
                                    	),
                                	),
                'orderby' 		=> $orderby,
                'order' 		=> $order,
            );
            
        } else {
            
            $args = array(
                'post_type' 		=> 'uxbarn_portfolio',
                'posts_per_page' 	=> $max_item,
                'tax_query' 		=> array(
		                                    array(
			                                    'taxonomy'  => 'uxbarn_portfolio_tax',
			                                    'field' 	=> 'id',
			                                    'terms' 	=> $category_id_list,
		                                    ),
		                                ),
                'orderby' 			=> $orderby,
                'order' 			=> $order,
            );
            
        }
        
        $portfolio = new WP_Query( $args );
		
		if ( ! $portfolio->have_posts() ) {
			return '<div class="error box">' . __( 'There are no portfolio items available in the selected categories.', 'uxb_port' ) . '</div>';
		}
		
		if ( $type == 'col3' || $type == 'col4' ) {
			
			$output = 
				'<div class="uxb-port-root-element-wrapper ' . $type . ' ' . $el_class . '">
					<span class="uxb-port-loading-text"><span>' . __( 'Loading', 'uxb_port' ) . '</span></span>
					
					<div class="uxb-port-loaded-element-wrapper">';
					
			if ( $show_filter == 'true' ) {
						
				$filter_string = 
						'<div class="filcats"><span>Categories</span><i class="fa fa-reorder"></i></div>
						  <ul class="uxb-port-element-filters invisble">
							<li><a href="#" class="active" data-filter="*">' . __( 'All', 'uxb_port' ) . '</a></li>';
				
				// Generate filter items
				$terms_args = array(
		            'include' => $category_id_list,
		            'orderby' => 'menu_order',
		        );
				
		        $terms = get_terms( 'uxbarn_portfolio_tax', $terms_args );
				$theterm = array();
				foreach ( $terms as $parent ) {$theterm = $parent;}
				
				$termchildren = get_terms('uxbarn_portfolio_tax', array(
  				'child_of'     => $theterm->term_id,
  				'hierarchical' => 0,
  				'fields'       => 'ids',
  				'hide_empty'   => 1,
				'orderby'      => 'slug', 
    			'order'        => 'ASC',
				));
				
		        if ( $termchildren && ! is_wp_error( $termchildren ) )  {
		        	
		            foreach ( $termchildren as $child ) {
						$term = get_term_by( 'id', $child, 'uxbarn_portfolio_tax');
		                $filter_string .= '<li><a href="#" data-filter=".term_' . $term->term_id . '">' . $term->name . '</a></li>';
		            }
		        }
				
				$filter_string .= '</ul>'; // close filter list
				$output .= $filter_string;
				
			}
			
			$output .= '<div class="uxb-port-element-wrapper">';
			
			// Generate grid columns
	        if ( $portfolio->have_posts() ) {
	        	
	            while ( $portfolio->have_posts() ) {
	            	
	                $portfolio->the_post();
	                
					// Prepare category string for each item's class
	                $term_list = '';
	                $terms = get_the_terms( get_the_ID(), 'uxbarn_portfolio_tax' );
	                
	                if ( $terms && ! is_wp_error( $terms ) )  {
	                	
	                    foreach ( $terms as $term ) {
	                        $term_list .= 'term_' . $term->term_id . ' ';
	                    }
						
	                }
	                
	                $thumbnail = '';
	                if ( has_post_thumbnail( get_the_ID() ) ) {
	                    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-port-element-thumbnails' );
	                } else {
	                    $thumbnail = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-grid.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
	                }
					
					$show_title_code = '<h3 class="portfolio-item-title">' . get_the_title() . '</h3>';
					if ( $show_title == 'false' ) {
						$show_title_code = '';
					}
					
					$output .= 
						'<div class="uxb-port-element-item black-white ' . $term_list . '">
							<a href="' . get_permalink() . '"></a>
							<div class="uxb-port-element-item-hover">
								<div class="uxb-port-element-item-hover-info">' . $show_title_code . '</div>
							</div>
							' . $thumbnail . '
						</div>';
					
				}

			} else {
				
			}
			
			$output .= '</div>'; // close class="portfolio-wrapper"
			$output .= '</div>'; // close class="portfolio-loaded-wrapper"
			$output .= '</div>'; // close class="portfolio-root-wrapper
			
		} else { // if($type == 'col3' ... ) and this is for "flexslider" type
			
			$transition_effect = 'fade';
			
			if ( $type == 'flexslider_slide' ) {
				$transition_effect = 'slide';
			}
			
			if ( $show_bullets == 'false' ) {
				$show_bullets = ' hide-bullets ';
			}
			/*

			$border_class_array = array( 'class' => 'border' );
			
			if ( $border == 'no' ) {
				$border_class_array = array();
			}
			*/

		    $output = '<div class="image-slider-root-container ' . $el_class . '">';
			$output .= '<div class="image-slider-wrapper slider-set ' . $show_bullets . '" data-auto-rotation="' . $interval . '" data-effect="' . $transition_effect . '">';
		    $output .= '<ul class="image-slider">';
		    
			if ( $portfolio->have_posts() ) {
				
	            while ( $portfolio->have_posts() ) {
	            	
	                $portfolio->the_post();
					
					// Default case if there is no thumbnail assigned
					$img_tag = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-slider.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
					
					if ( has_post_thumbnail( get_the_ID() ) ) {
							
						$attachment_id = get_post_thumbnail_id( get_the_ID() );
						
						// If there is an alternate thumbnail specified, use it instead
						$alternate_thumbnail_url = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_alternate_thumbnail' ), 0 );
						
						if( $alternate_thumbnail_url != '' ) {
							$attachment_id = uxb_port_get_attachment_id_from_src( $alternate_thumbnail_url );
						}
						
						$attachment = uxb_port_get_attachment( $attachment_id );
	       
						$img_fullsize = $attachment['src']; 
						
						// Get an array: [0] => url, [1] => width, [2] => height
				        $img_thumbnail = wp_get_attachment_image_src( $attachment_id, $img_size );
				        
				        $title = $attachment['title']; //trim(esc_attr(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )));
				        
				        $anchor_title = '';
						
				        if ( $title != '' ) {
				            $anchor_title = ' title="' . $title . '" ';
				        }
				        
				        $img_tag = '<img src="' . $img_thumbnail[0] . '" alt="' . $attachment['alt'] . '" width="' . $img_thumbnail[1] . '" height="' . $img_thumbnail[2] . '" />';
						
	                }
					
					// Don't need to apply "width" or "height" here, it's aleady done in css for 100% width.
					$output .= '<li class="image-slider-item">';
					
					$output .= '<a href="' . get_permalink() . '"' . $anchor_title . ' class="image-link">' . $img_tag . '</a>';
			        
			        if ( trim( $attachment['caption'] ) != '' ) {
			            $output .= '<div class="image-caption-wrapper"><div class="image-caption">' . $attachment['caption'] . '</div></div>';
			        }
			        
			        $output .= '</li>'; // close "image-slider-item"
					
				}
			}
			
		    $output .= '</ul>'; // close "image-slider"
		    $output .= '</div>'; // close "image-slider-wrapper slider-set"
		    $output .= 
		            	'<a href="#" class="slider-controller slider-prev"><i class="ion-ios7-arrow-left"></i></a>
						<a href="#" class="slider-controller slider-next"><i class="ion-ios7-arrow-right"></i></a>';
		    $output .= '</div>'; // close "image-slider-root-container"
		    
		}
		
		wp_reset_postdata();
		
        return $output;
        
    }

}