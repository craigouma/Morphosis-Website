<?php

if ( ! function_exists( 'uxb_port_create_plugin_options' ) ) {
		
	function uxb_port_create_plugin_options() {
	
	  // Only execute in admin & if OT is installed
	  if ( is_admin() && function_exists( 'ot_register_settings' ) ) {
	
	    // Register the pages
	    ot_register_settings( 
	      array(
	        array( 
	          'id'              => 'uxb_port_plugin_options',
	          'pages'           => array(
	            array(
	              'id'              => 'uxb_port_plugin_options_page',
	              'parent_slug'     => 'options-general.php',
	              'page_title'      => __( 'UXbarn Portfolio Options', 'uxb_port' ),
	              'menu_title'      => __( 'UXbarn Portfolio Options', 'uxb_port' ),
	              'capability'      => 'edit_theme_options',
	              'menu_slug'       => 'uxb_port_options',
	              'icon_url'        => null,
	              'position'        => null,
	              'updated_message' => __( 'Plugin options updated.', 'uxb_port' ),
	              'reset_message'   => __( 'Plugin options reset.', 'uxb_port' ),
	              'button_text'     => __( 'Save Changes', 'uxb_port' ),
	              'show_buttons'    => true,
	              'screen_icon'     => 'options-general',
	              'contextual_help' => null,
	              'sections'        => array(
	              		
		                array(
		                  'id'          => 'uxb_port_po_single_page_section',
		                  'title'       => __( 'Portfolio Single Page', 'uxb_port' )
		                ),
					
	              ),
	              'settings'        => array(
	              		
		                array(
			                'id'          => 'uxb_port_po_single_page_slider_transition',
			                'label'       => __( "Slider's Transition Effect", 'uxb_port' ),
			                'desc'        => __( 'Select the transition for the image slider.', 'uxb_port' ),
			                'std'         => 'fade',
			                'type'        => 'select',
			                'section'     => 'uxb_port_po_single_page_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => '',
			                'choices'     => array( 
			                  array(
			                    'value'       => 'fade',
			                    'label'       => __( 'Fade', 'uxb_port' ),
			                    'src'         => ''
			                  ),
			                  array(
			                    'value'       => 'slide',
			                    'label'       => __( 'Slide', 'uxb_port' ),
			                    'src'         => ''
			                  ),
			                ),
			              ),
			              
			              array(
			                'id'          => 'uxb_port_po_single_page_slider_transition_speed',
			                'label'       => __( "Slider's Transition Speed", 'uxb_port' ),
			                'desc'        => __( 'Enter a number of how fast you want the transition to animate, in milliseconds.', 'uxb_port' ),
			                'std'         => '600',
			                'type'        => 'text',
			                'section'     => 'uxb_port_po_single_page_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => ''
			              ),
			              
			              array(
			                'id'          => 'uxb_port_po_single_page_slider_auto_rotation',
			                'label'       => __( "Enable Slider's Auto Rotation?", 'uxb_port'),
			                'desc'        => __( 'Whether to enable the auto rotation mode for the slider.', 'uxb_port' ),
			                'std'         => 'true',
			                'type'        => 'radio',
			                'section'     => 'uxb_port_po_single_page_section',
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
			                  )
			                ),
			              ),
			              
			              array(
			                'id'          => 'uxb_port_po_single_page_slider_rotation_duration',
			                'label'       => __( "Slider's Rotation Delay", 'uxb_port' ),
			                'desc'        => __( 'Enter a number of how long to stay on the current slide before rotating to the next one, in milliseconds.', 'uxb_port' ),
			                'std'         => '5000',
			                'type'        => 'text',
			                'section'     => 'uxb_port_po_single_page_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => ''
			              ),
			              
						  array(
			                'id'          => 'uxb_port_po_single_page_display_related_works',
			                'label'       => __( 'Display Related Works?', 'uxb_port'),
			                'desc'        => __( 'Whether to display the Related Works section.', 'uxb_port' ),
			                'std'         => 'true',
			                'type'        => 'radio',
			                'section'     => 'uxb_port_po_single_page_section',
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
			                  )
			                ),
			              ),
			              
						  array(
			                'id'          => 'uxb_port_po_single_page_related_works_scopes',
			                'label'       => __( 'Related Works: Optional Scopes', 'uxb_port'),
			                'desc'        => __( 'By default, theme uses only portfolio category for displaying related works. This option lets you choose any optional scopes (from custom fields) to be used with the portfolio category. The operators are applied as:<br/><br/><strong>category AND (client OR website OR date)</strong><br/><br/>Also note that all scopes here use the exact match (=) to compare the values.', 'uxb_port' ),
			                'std'         => '',
			                'type'        => 'checkbox',
			                'section'     => 'uxb_port_po_single_page_section',
			                'rows'        => '',
			                'post_type'   => '',
			                'taxonomy'    => '',
			                'class'       => '',
			                'choices'     => array( 
			                  array(
			                    'value'       => 'client',
			                    'label'       => __( 'Client', 'uxb_port' ),
			                    'src'         => ''
			                  ),
			                  array(
			                    'value'       => 'website',
			                    'label'       => __( 'Website', 'uxb_port' ),
			                    'src'         => ''
			                  ),
			                  array(
			                    'value'       => 'date',
			                    'label'       => __( 'Date', 'uxb_port' ),
			                    'src'         => ''
			                  )
			                ),
			              ),
			              
						  array(
			                'id'          => 'uxb_port_po_single_page_enable_comment',
			                'label'       => __( 'Enable Portfolio Comment?', 'uxb_port' ),
			                'desc'        => __( 'Whether to enable the comment function for all portfolio items by default.<br/><br/>When you have enabled it, please make sure that each portfolio item is also marked as "Allow Comments". You can find that mark from the Quick Edit menu of each item on Portfolio menu.', 'uxb_port' ),
			                'std'         => 'false',
			                'type'        => 'radio',
			                'section'     => 'uxb_port_po_single_page_section',
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
			                  )
			                ),
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