<?php

if ( ! function_exists( 'uxb_port_create_meta_boxes' ) ) {
	
	function uxb_port_create_meta_boxes() {
		
		uxb_port_create_alternate_content();
        uxb_port_create_meta_info();
        uxb_port_create_item_format_setting();
        uxb_port_create_image_slideshow_format_content();
        uxb_port_create_video_format_content();
		
	}

}



if ( ! function_exists( 'uxb_port_create_alternate_content' ) ) {
		
	function uxb_port_create_alternate_content() {
		
		$args = array(
	        'id'          => 'uxbarn_portfolio_alternate_content_meta_box',
	        'title'       => __( 'Alternate Content Settings', 'uxb_port' ),
	        'desc'        => '',
	        'pages'       => array( 'uxbarn_portfolio' ),
	        'context'     => 'normal',
	        'priority'    => 'high',
	        'fields'      => array(
	            array(
	                'id'          => 'uxbarn_portfolio_single_title',
	                'label'       => __( 'Alternate Title on Single Page', 'uxb_port' ),
	                'desc'        => __( 'You can use this field to enter the alternate title to be displayed on portfolio single page. You may use a basic HTML tag like "span" to create accent color on title.<br/><br/>If you leave this blank, the normal title will be used.<br/><br/><strong>Important:</strong> If you put HTML tag here, ensure that you open and close the tag properly.', 'uxb_port' ),
	                'std'         => '',
	                'type'        => 'text',
	                'section'     => 'uxbarn_portfolio_alternate_content_sec',
	                'rows'        => '',
	                'post_type'   => '',
	                'taxonomy'    => '',
	                'class'       => ''
	            ),
	            array(
	                'id'          => 'uxbarn_portfolio_alternate_thumbnail',
	                'label'       => __( 'Alternate Thumbnail for Portfolio Element', 'uxb_port' ),
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



if ( ! function_exists( 'uxb_port_create_meta_info' ) ) {
	
	function uxb_port_create_meta_info() {
		
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



if ( ! function_exists( 'uxb_port_create_item_format_setting' ) ) {
		
	function uxb_port_create_item_format_setting() {
		
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



if ( ! function_exists( 'uxb_port_create_image_slideshow_format_content' ) ) {
	
	function uxb_port_create_image_slideshow_format_content() {
		
		$args = array(
            'id'          => 'uxbarn_portfolio_image_slideshow_format_meta_box',
            'title'       => __( 'Meta Box for Image/Slideshow Format', 'uxb_port' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                'id'          => 'uxbarn_portfolio_image_slideshow',
                'label'       => __( 'Images', 'uxb_port' ),
                'desc'        => __( 'You can use this setting to add the images and rearrange the order by drag and drop. Slideshow mode will be enabled automatically on the front-end if there is more than one images added. <strong>Recommended image sizes should be equal or larger than 1100x676 for landscape view and 600x816 for portrait view</strong>.<br/><br/>Note that the field "Title" will only be used here in the backend. In the frontend, theme will use "alt", "title" and "caption" values from the image itself.', 'uxb_port' ),
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'uxbarn_portfolio_slideshow_format_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array( 
                    array(
                        'id'          => 'uxbarn_portfolio_image_slideshow_upload',
                        'label'       => __( 'Image', 'uxb_port' ),
                        'desc'        => '',
                        'std'         => '',
                        'type'        => 'upload',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => ''
                      ),
                ),
              ),
          
              array(
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
                  
				  
            )
        );
        
        ot_register_meta_box( $args );
		
	}

}



if ( ! function_exists( 'uxb_port_create_video_format_content' ) ) {

	function uxb_port_create_video_format_content() {
		
		$args = array(
            'id'          => 'uxbarn_portfolio_video_format_meta_box',
            'title'       => __( 'Meta Box for Video Format', 'uxb_port' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_video_url',
                    'label'       => __( 'Video URL', 'uxb_port' ),
                    'desc'        => __( 'Enter the URL to your YouTube or Vimeo video here. <br/><br/>For example, <em>"http://www.youtube.com/watch?v=G_G8SdXktHg"</em> for YouTube. Or, <em>"http://vimeo.com/7449107"</em> for Vimeo.', 'uxb_port' ),
                    'std'         => '',
                    'type'        => 'text',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                  ),
            )
        );
        
        ot_register_meta_box( $args );
		
	}

}