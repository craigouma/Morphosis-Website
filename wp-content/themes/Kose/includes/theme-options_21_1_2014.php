<?php

/**
 * Build the custom settings & update OptionTree.
 */
if ( ! function_exists( 'uxbarn_custom_theme_options' ) ) {
    
    function uxbarn_custom_theme_options() {
      /**
       * Get a copy of the saved settings array. 
       */
      $saved_settings = get_option( 'option_tree_settings', array() );
      
      /**
       * Custom settings array that will eventually be 
       * passes to the OptionTree Settings API Class.
       */
      $custom_settings = array( 
        'contextual_help' => array(
          
          'sidebar'       => ''
        ),
        
        // Sections
        
        'sections'        => array( 
          array(
            'id'          => 'uxbarn_to_general_section',
            'title'       => __( 'General', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_fullscreen_slider_section',
            'title'       => __( 'Fullscreen Slider', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_blog_section',
            'title'       => __( 'Blog', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_social_network_section',
            'title'       => __( 'Social Network', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_google_fonts_section',
            'title'       => __( 'Google Fonts', 'uxbarn' )
          ),
          array(
            'id'          => 'uxbarn_to_wpml_section',
            'title'       => __( 'WPML Plugin', 'uxbarn' )
          ),
        ),
        'settings'        => array( 
            
              // General Tab
            
              array(
                'id'          => 'uxbarn_to_setting_upload_favicon',
                'label'       => __( 'Upload Favicon', 'uxbarn' ),
                'desc'        => __( 'Favicon will be displayed on the address bar and tab of the browser. Click the icon to upload the image or if you already know the URL of the image, just paste it to the box.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
			  array(
                'id'          => 'uxbarn_to_setting_display_tagline',
                'label'       => __( 'Display Tagline?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the site tagline under the logo.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
			  
              array(
                'id'          => 'uxbarn_to_setting_enable_lightbox_wp_gallery',
                'label'       => __( 'Enable Lightbox for WordPress Gallery?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable lightbox feature for WordPress gallery shortcode. <br/><br/><strong>Note:</strong> Also make sure that you already set the "Link To" option to "Media File" in your gallery shortcode.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_enable_page_comment',
                'label'       => __( 'Enable Page Comment?', 'uxbarn' ),
                'desc'        => __( 'Whether to enable the comment function for all Page by default.<br/><br/>When you have enabled it, please make sure that each Page is also marked as "Allow Comments". You can find that mark from the Quick Edit menu of the Page.', 'uxbarn' ),
                'std'         => 'off',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
			  array(
                'id'          => 'uxbarn_to_setting_copyright_text',
                'label'       => __( 'Copyright Text', 'uxbarn' ),
                'desc'        => __( 'This copyright text will be displayed in the side panel.<br/><br/><strong>Important: </strong>If you use some HTML tag like anchor tag for a link, make sure to have the opening and closing tag properly.', 'uxbarn' ),
                'std'         => __( '2014 &copy; Kose.<br/>Premium Theme by <a href="http://themeforest.net/user/UXbarn?ref=UXbarn">UXbarn</a>.', 'uxbarn' ),
                'type'        => 'text',
                'section'     => 'uxbarn_to_general_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
			  array(
				'id'          => 'uxbarn_to_setting_template_404_image',
				'label'       => __( 'Upload Background Image for 404 Template', 'uxbarn' ),
				'desc'        => __( 'Upload a fullscreen background image for 404 template. Recommended size is "2048x1365".', 'uxbarn' ),
				'std'         => '',
				'type'        => 'upload',
                'section'     => 'uxbarn_to_general_section',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			  ),
			  
			  array(
				'id'          => 'uxbarn_to_setting_template_search_result_image',
				'label'       => __( 'Upload Background Image for Search Result Template', 'uxbarn' ),
				'desc'        => __( 'Upload a fullscreen background image for search result template. Recommended size is "2048x1365".', 'uxbarn' ),
				'std'         => '',
				'type'        => 'upload',
                'section'     => 'uxbarn_to_general_section',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			  ),
			  
			  array(
				'id'          => 'uxbarn_to_setting_template_portfolio_taxonomy_image',
				'label'       => __( 'Upload Background Image for Portfolio Category Template', 'uxbarn' ),
				'desc'        => __( 'Upload a fullscreen background image for portfolio category template. Recommended size is "2048x1365".', 'uxbarn' ),
				'std'         => '',
				'type'        => 'upload',
                'section'     => 'uxbarn_to_general_section',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			  ),
              
              
              
              
              // Fullscreen Slider Tab
              
              array(
                'id'          => 'uxbarn_to_setting_fullscreen_slider_transition',
                'label'       => __( "Transition Effect", 'uxbarn' ),
                'desc'        => __( 'Select the transition for the slider.', 'uxbarn' ),
                'std'         => 'crossfade',
                'type'        => 'select',
                'section'     => 'uxbarn_to_fullscreen_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'crossfade',
                    'label'       => __( 'Fade', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'directscroll',
                    'label'       => __( 'Slide', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cover-fade',
                    'label'       => __( 'Cover Fade', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'uncover-fade',
                    'label'       => __( 'Uncover Fade', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_fullscreen_slider_transition_speed',
                'label'       => __( "Transition Speed", 'uxbarn' ),
                'desc'        => __( 'Enter a number of how fast you want the transition to animate, in milliseconds.', 'uxbarn' ),
                'std'         => '1000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_fullscreen_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_fullscreen_slider_auto_rotation',
                'label'       => __( "Enable Auto Rotation?", 'uxbarn'),
                'desc'        => __( 'Whether to enable the auto rotation mode for the slider.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_fullscreen_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_fullscreen_slider_rotation_duration',
                'label'       => __( "Rotation Delay", 'uxbarn' ),
                'desc'        => __( 'Enter a number of how long to stay on the current slide before rotating to the next one, in milliseconds.', 'uxbarn' ),
                'std'         => '5000',
                'type'        => 'text',
                'section'     => 'uxbarn_to_fullscreen_slider_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              
			  
              
			  
              // Blog Tab
             
              array(
                'id'          => 'uxbarn_to_setting_blog_sidebar',
                'label'       => __( 'Blog Sidebar', 'uxbarn' ),
                'desc'        => __( 'Select how the blog sidebar displayed on the blog page (Posts page). You can manage its widgets in "Appearance > Widgets > Blog Sidebar"', 'uxbarn' ),
                'std'         => 'right',
                'type'        => 'select',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'none',
                    'label'       => __( 'Hide blog sidebar', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'right',
                    'label'       => __( 'Right side', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'left',
                    'label'       => __( 'Left side', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
              array(
                'id'          => 'uxbarn_to_setting_override_post_meta_info',
                'label'       => __( 'Override Post Meta Info?', 'uxbarn' ),
                'desc'        => __( 'Whether to override the meta info custom fields of all individual posts with this global setting.', 'uxbarn' ),
                'std'         => 'off',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_date',
                'label'       => __( 'Show Date?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the date on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
              array(
                'id'          => 'uxbarn_to_post_meta_info_author',
                'label'       => __( 'Show Author Name?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the author name on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_comment',
                'label'       => __( 'Show Comment Count?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the comment count on blog posts page and single page.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_single_author_box',
                'label'       => __( 'Show Author Box on Single Page?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the author box on the post single page.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
			  array(
                'id'          => 'uxbarn_to_post_meta_info_single_tags',
                'label'       => __( 'Show Tags on Single Page?', 'uxbarn' ),
                'desc'        => __( 'Whether to display the tags list on the post single page.', 'uxbarn' ),
                'std'         => 'on',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
              
              
    		  
    		  
    		  // Social Network Tab
              
              array(
                'id'          => 'uxbarn_to_setting_social_set',
                'label'       => __( 'Social Icon Set', 'uxbarn' ),
                'desc'        => __( 'Select whether to use the default built-in set or define your own set for social icons.', 'uxbarn' ),
                'std'         => 'default',
                'type'        => 'select',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'default',
                    'label'       => __( 'Default Set', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'custom',
                    'label'       => __( 'Custom Set', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
              
			  array(
		        'id'          => 'uxbarn_to_setting_social_custom_set',
		        'label'       => __( 'Custom Social Network Icons', 'uxbarn' ),
		        'desc'        => __( 'You can use this option to add your own list of social network icon. Just click "Add New" button, enter the title, URL and upload the icon image. You can also rearrange the positions using drag-and-drop feature here.', 'uxbarn' ),
		        'std'         => '',
		        'type'        => 'list-item',
		        'section'     => 'uxbarn_to_social_network_section',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'min_max_step'=> '',
		        'class'       => 'social-custom-set',
		        'condition'   => '',
		        'operator'    => 'and',
		        'settings'    => array( 
		          array(
		            'id'          => 'uxbarn_to_setting_social_custom_set_url',
		            'label'       => __( 'URL', 'uxbarn' ),
		            'desc'        => __( 'Enter the URL for this social icon. Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
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
		            'id'          => 'uxbarn_to_setting_social_custom_set_icon',
		            'label'       => __( 'Icon', 'uxbarn' ),
		            'desc'        => __( 'Upload an image for this social icon.', 'uxbarn' ),
		            'std'         => '',
		            'type'        => 'upload',
		            'rows'        => '',
		            'post_type'   => '',
		            'taxonomy'    => '',
		            'min_max_step'=> '',
		            'class'       => '',
		            'condition'   => '',
		            'operator'    => 'and'
		          )
		        )
		      ),
              
              array(
                'id'          => 'uxbarn_to_setting_social_facebook',
                'label'       => __( 'Facebook URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_facebook_upload',
                'label'       => __( 'Facebook Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_twitter',
                'label'       => __( 'Twitter URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_twitter_upload',
                'label'       => __( 'Twitter Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_google_plus',
                'label'       => __( 'Google+ URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_google_plus_upload',
                'label'       => __( 'Google+ Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_linkedin',
                'label'       => __( 'LinkedIn URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_linkedin_upload',
                'label'       => __( 'LinkedIn Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_flickr',
                'label'       => __( 'Flickr URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_flickr_upload',
                'label'       => __( 'Flickr Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_behance',
                'label'       => __( 'Behance URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_behance_upload',
                'label'       => __( 'Behance Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_dribbble',
                'label'       => __( 'Dribbble URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_dribbble_upload',
                'label'       => __( 'Dribbble Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_forrst',
                'label'       => __( 'Forrst URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_forrst_upload',
                'label'       => __( 'Forrst Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_vimeo',
                'label'       => __( 'Vimeo URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_vimeo_upload',
                'label'       => __( 'Vimeo Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_youtube',
                'label'       => __( 'YouTube URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_youtube_upload',
                'label'       => __( 'YouTube Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_rss',
                'label'       => __( 'RSS URL', 'uxbarn' ),
                'desc'        => __( 'Please make sure to put "http://" at the front of the URL.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'text',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              array(
                'id'          => 'uxbarn_to_setting_social_rss_upload',
                'label'       => __( 'RSS Icon', 'uxbarn' ),
                'desc'        => __( "You can leave it blank to use theme's default icon.", 'uxbarn' ),
                'std'         => '',
                'type'        => 'upload',
                'section'     => 'uxbarn_to_social_network_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => 'social-default-set'
              ),
              
              
              
              // Google Fonts Tab
              
              array(
                'id'          => 'uxbarn_to_setting_google_fonts_loader',
                'label'       => __( 'Google Fonts Loader', 'uxbarn' ),
                'desc'        => __( 'To enable Google Fonts selection, please go to <a href="http://www.google.com/webfonts#" target="_blank">Google Web Fonts website</a>, select the fonts you like, copy the family list then paste them to this textbox. After that simply press "Save Changes" button and the fonts will be loaded to all font select lists in Style Customizer.<br/><br/>Please read more detail about this in the provided documentation under the section of "Getting Started > Google Fonts".</p>', 'uxbarn' ),
                'std'         => UXB_DEFAULT_GOOGLE_FONTS,
                'type'        => 'textarea-simple',
                'section'     => 'uxbarn_to_google_fonts_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'id'          => 'uxbarn_to_setting_google_fonts_character_sets',
                'label'       => __( 'Character Sets', 'uxbarn'),
                'desc'        => __( 'Choose the character sets you want. If you have no idea what is this, just leave them unchecked.', 'uxbarn' ),
                'std'         => '',
                'type'        => 'checkbox',
                'section'     => 'uxbarn_to_google_fonts_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array(
                  array(
                    'value'       => 'latin',
                    'label'       => __( 'Latin (latin)', 'uxbarn' ),
                    'src'         => ''
                  ), 
                  array(
                    'value'       => 'latin-ext',
                    'label'       => __( 'Latin Extended (latin-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cyrillic',
                    'label'       => __( 'Cyrillic (cyrillic)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'cyrillic-ext',
                    'label'       => __( 'Cyrillic Extended (cyrillic-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'greek',
                    'label'       => __( 'Greek (greek)', 'uxbarn' ),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'greek-ext',
                    'label'       => __( 'Greek Extended (greek-ext)', 'uxbarn' ),
                    'src'         => ''
                  ),
                ),
              ),
			  
			  
			  
			  
			  
			  // WPML Plugin Tab
              
              array(
                'id'          => 'uxbarn_to_setting_display_theme_wpml_lang_selector',
                'label'       => __( 'Display WPML Language Selector?', 'uxbarn' ),
                'desc'        => __( 'If WPML is activated, use this option to display the WPML language selector in the header location defined by theme. <br/><br/><strong>Note: </strong>Theme will use the configuration that you set in "WPML > Languages > Language switcher options".', 'uxbarn' ),
                'std'         => 'off',
                'type'        => 'on-off',
                'section'     => 'uxbarn_to_wpml_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
              ),
              
        )
      );
       
      /* settings are not the same update the DB */
      if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings ); 
      }
      
    }

}