<?php

if ( ! function_exists( 'uxbarn_create_fullscreen_slider_meta_box' ) ) {
	
    function uxbarn_create_fullscreen_slider_meta_box() {
    	
		$args = array(
            'id'          => 'uxbarn_fullscreen_slider_meta_box',
            'title'       => __( 'Fullscreen Slider Settings', 'uxbarn' ),
            'desc'        => '',
            'pages'       => array( 'page', 'post', 'uxbarn_team' ), // Register this meta box for these post types
            'context'     => 'normal',
            'priority'    => 'default',
            'fields'      => array(
				array(
					'id'          => 'uxbarn_fullscreen_slider',
					'label'       => __( 'Slides', 'uxbarn' ),
					'desc'        => __( 'You can use this option to manage the slides of fullscreen slider to use with this page/post. <p>*If you want to use just a fullscreen background, simply create only one slide here.</p>', 'uxbarn' ),
					'std'         => '',
					'type'        => 'list-item',
					'section'     => 'uxbarn_sec_fullscreen_slider',
					'rows'        => '',
					'post_type'   => 'page',
					'taxonomy'    => '',
					'min_max_step'=> '',
					'class'       => 'uxbarn-fullscreen-slider',
					'condition'   => '',
					'operator'    => 'and',
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
						  
						  array(
							'id'          => 'uxbarn_fullscreen_slider_image',
							'label'       => __( 'Slide Image', 'uxbarn' ),
							'desc'        => __( 'Upload an image for this slide. Recommended size is "2048x1365".', 'uxbarn' ),
							'std'         => '',
							'type'        => 'upload',
							'rows'        => '',
							'post_type'   => '',
							'taxonomy'    => '',
							'min_max_step'=> '',
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
			),
				
		);
								  
		ot_register_meta_box( $args );
		
	}
	
}