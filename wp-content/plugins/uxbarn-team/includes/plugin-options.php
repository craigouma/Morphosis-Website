<?php

if ( ! function_exists( 'uxb_team_create_plugin_options' ) ) {
		
	function uxb_team_create_plugin_options() {
	
	  // Only execute in admin & if OT is installed
	  if ( is_admin() && function_exists( 'ot_register_settings' ) ) {
	
	    // Register the pages
	    ot_register_settings( 
	      array(
	        array( 
	          'id'              => 'uxb_team_plugin_options',
	          'pages'           => array(
	            array(
	              'id'              => 'uxb_team_plugin_options_page',
	              'parent_slug'     => 'options-general.php',
	              'page_title'      => __( 'UXbarn Team Options', 'uxb_team' ),
	              'menu_title'      => __( 'UXbarn Team Options', 'uxb_team' ),
	              'capability'      => 'edit_theme_options',
	              'menu_slug'       => 'uxb_team_options',
	              'icon_url'        => null,
	              'position'        => null,
	              'updated_message' => __( 'Plugin options updated.', 'uxb_team' ),
	              'reset_message'   => __( 'Plugin options reset.', 'uxb_team' ),
	              'button_text'     => __( 'Save Changes', 'uxb_team' ),
	              'show_buttons'    => true,
	              'screen_icon'     => 'options-general',
	              'contextual_help' => null,
	              'sections'        => array(
	              		
		                array(
		                  'id'          => 'uxb_team_po_social_icons_section',
		                  'title'       => __( 'Social Icons of Team Member', 'uxb_team' )
		                ),
					
	              ),
	              'settings'        => array(
	              		
				  		array(
			                'id'          => 'uxb_team_po_social_set',
			                'label'       => __( 'Social Icon Set', 'uxb_team' ),
			                'desc'        => __( 'Select whether to use the default built-in set of the plugin or define your own set for social icons.', 'uxb_team' ),
			                'std'         => 'default',
			                'type'        => 'select',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => '',
			                'choices'     => array( 
			                  array(
			                    'value'       => 'default',
			                    'label'       => __( 'Default Set', 'uxb_team' ),
			                    'src'         => ''
			                  ),
			                  array(
			                    'value'       => 'custom',
			                    'label'       => __( 'Custom Set', 'uxb_team' ),
			                    'src'         => ''
			                  ),
			                ),
			              ),
			              
						  array(
					        'id'          => 'uxb_team_po_social_custom_set',
					        'label'       => __( 'Custom Social Network Icons', 'uxb_team' ),
					        'desc'        => __( 'You can use this option to add your own list of social network icon. Just click "Add New" button, enter the title, ID and upload the icon image. You can also rearrange the positions using drag-and-drop feature here. This will apply to every team member.', 'uxb_team' ),
					        'std'         => '',
					        'type'        => 'list-item',
					        'section'     => 'uxb_team_po_social_icons_section',
					        'rows'        => '',
					        'post_type'   => '',
					        'taxonomy'    => '',
					        'min_max_step'=> '',
					        'class'       => 'social-custom-set',
					        'condition'   => '',
					        'operator'    => 'and',
					        'settings'    => array( 
					        	array(
						            'id'          => 'uxb_team_po_social_custom_set_id',
						            'label'       => __( 'Unique ID', 'uxb_team' ),
						            'desc'        => __( '<p>Assign the ID for this social icon.</p><p><strong>Important: This field is required and must be only in plain English without special characters (underscore is allowed).</strong></p><p>For examples, if this is for Facebook, you might enter the ID as "social_facebook". Or, if it is Twitter, you can enter it as "social_twitter".</p>', 'uxb_team' ),
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
						            'id'          => 'uxb_team_po_social_custom_set_icon',
						            'label'       => __( 'Icon', 'uxb_team' ),
						            'desc'        => __( 'Upload an image for this social icon', 'uxb_team' ),
						            'std'         => '',
						            'type'        => 'upload',
						            'rows'        => '',
						            'post_type'   => '',
						            'taxonomy'    => '',
						            'min_max_step'=> '',
						            'class'       => '',
						            'condition'   => '',
						            'operator'    => 'and'
					          	),
					        )
					      ),
	              		
		                array(
			                'id'          => 'uxb_team_po_social_icon_twitter',
			                'label'       => __( 'Twitter Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
	              		array(
			                'id'          => 'uxb_team_po_social_icon_facebook',
			                'label'       => __( 'Facebook Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
			              array(
			                'id'          => 'uxb_team_po_social_icon_google_plus',
			                'label'       => __( 'Google+ Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
			              array(
			                'id'          => 'uxb_team_po_social_icon_linkedin',
			                'label'       => __( 'LinkedIn Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
			              array(
			                'id'          => 'uxb_team_po_social_icon_dribbble',
			                'label'       => __( 'Dribbble Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
			              array(
			                'id'          => 'uxb_team_po_social_icon_forrst',
			                'label'       => __( 'Forrst Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
			              array(
			                'id'          => 'uxb_team_po_social_icon_flickr',
			                'label'       => __( 'Flickr Icon', 'uxb_team' ),
			                'desc'        => __( "You can leave it blank to use plugin's default icon.", 'uxb_team' ),
			                'std'         => '',
			                'type'        => 'upload',
			                'section'     => 'uxb_team_po_social_icons_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => 'social-default-set',
			              ),
			              
					
	              )
	            )
	          )
	        )
	      )
	    );
	
	  }
	
	}

}
	              