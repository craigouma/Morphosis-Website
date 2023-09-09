<?php

if ( ! function_exists( 'uxbarn_create_content_area_meta_box' ) ) {
	
    function uxbarn_create_content_area_meta_box() {
    	
		$args = array(
            'id'          => 'uxbarn_content_area_meta_box',
            'title'       => __( 'Content Area Settings', 'uxbarn' ),
            'desc'        => '',
            'pages'       => array( 'page', 'post', 'uxbarn_portfolio', 'uxbarn_team' ),
            'context'     => 'normal',
            'priority'    => 'default',
            'fields'      => array(
          		array(
					'id'          => 'uxbarn_content_area_display',
					'label'       => __( 'Display Content Area on Load?', 'uxbarn' ),
					'desc'        => __( 'Whether to display the content area on page load.', 'uxbarn' ),
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
					'id'          => 'uxbarn_content_show_hide_button_display',
					'label'       => __( 'Display Show/Hide Toggle Button?', 'uxbarn' ),
					'desc'        => __( 'Whether to display the toggle button for showing/hiding the content area.', 'uxbarn' ),
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
            ),
        );
		
		ot_register_meta_box( $args );
		
	}
	
}