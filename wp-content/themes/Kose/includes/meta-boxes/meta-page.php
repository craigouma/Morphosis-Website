<?php

if ( ! function_exists( 'uxbarn_create_page_meta_boxes' ) ) {
	
	function uxbarn_create_page_meta_boxes() {
		
		uxbarn_create_page_intro_meta_box();
		uxbarn_create_fullscreen_slider_meta_box(); // From "shared-meta-fullscreen.php"
		uxbarn_create_content_area_meta_box(); // From "shared-meta-content.php"
		uxbarn_create_sidebar_meta_box();
		
	}
	
}



if ( ! function_exists( 'uxbarn_create_page_intro_meta_box' ) ) {
	
    function uxbarn_create_page_intro_meta_box() {
    	
        $args = array(
            'id'          => 'uxbarn_page_intro_meta_box',
            'title'       => __( 'Page Intro Settings', 'uxbarn' ),
            'desc'        => '',
            'pages'       => array( 'page', 'uxbarn_portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_page_intro_display',
                    'label'       => __( 'Display Page Intro?', 'uxbarn' ),
                    'desc'        => __( 'Whether to show Page Intro which will be displayed at the top of this page/post.', 'uxbarn' ),
                    'std'         => 'on',
                    'type'        => 'on-off',
                    'section'     => 'uxbarn_sec_page_intro',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                ),
                array(
                    'id'          => 'uxbarn_page_intro_title',
                    'label'       => __( 'Intro Title', 'uxbarn' ),
                    'desc'        => __( 'If it is left blank, general title will be used instead.', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_sec_page_intro',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_page_intro_body',
                    'label'       => __( 'Intro Body Text', 'uxbarn' ),
                    'desc'        => __( 'To be displayed as a Page Intro\'s body.', 'uxbarn' ),
                    'std'         => '',
                    'type'        => 'textarea-simple',
                    'section'     => 'uxbarn_sec_page_intro',
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



if ( ! function_exists( 'uxbarn_create_sidebar_meta_box' ) ) {
	
	function uxbarn_create_sidebar_meta_box() {
		
		$args = array(
			'id'          => 'uxbarn_sidebar_meta_box',
			'title'       => __( 'Sidebar Setting', 'uxbarn' ),
			'desc'        => '',
			'pages'       => array( 'page' ),
			'context'     => 'side',
			'priority'    => 'default',
			'fields'      => array(
			      array(
                    'id'          => 'uxbarn_page_sidebar_appearance',
                    'label'       => __( 'Sidebar Appearance', 'uxbarn' ),
                    'desc'        => '',
                    'std'         => 'none',
                    'type'        => 'select',
                    'section'     => 'uxbarn_sec_sidebar',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'none',
                        'label'       => __( 'Hide sidebar selected above', 'uxbarn' ),
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
			),
		);
		
		ot_register_meta_box( $args );
		
	}

}