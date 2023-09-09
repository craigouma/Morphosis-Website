<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_content_tab' ) ) {

    function uxbarn_ctmzr_init_content_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_content_section_tab( $wp_customize );
        uxbarn_ctmzr_register_content_body_styles( $wp_customize );
        uxbarn_ctmzr_register_content_background_styles( $wp_customize );
		uxbarn_ctmzr_register_content_scrollbar_styles( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_content_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_content_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_content_section', array(
                'title'    		=> __( 'Content', 'uxbarn' ),
                'description' 	=> __( 'Customize the styles of content area.', 'uxbarn' ),
                'priority' 		=> '35',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_content_body_styles' ) ) {

    function uxbarn_ctmzr_register_content_body_styles( $wp_customize ) {
        
        // Heading color
        $wp_customize->add_setting( 'uxbarn_sc_content_body_styles[heading_color]', array(
                'default'    		=> '#ffffff',
                'type' 				=> 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_content_body_styles[heading_color]', array(
                    'label' 	=> __( 'Content Heading Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '5',
                )
            )
        );
        
        // Text color
        $wp_customize->add_setting( 'uxbarn_sc_content_body_styles[text_color]', array(
                'default'    		=> '#dddddd',
                'type' 				=> 'option',
                //'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_content_body_styles[text_color]', array(
                    'label' 	=> __( 'Content Text Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '10',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_content_section_divider0', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_content_section_divider0', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '11',
                )
            )
        );
        
		
		
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_content_body_styles[use_custom_link_color]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_content_body_styles[use_custom_link_color]', array(
            'label'   	=> __( 'Use custom color for content link (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_content_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '15',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_content_body_styles_use_custom_link_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_content_body_styles_use_custom_link_color_desc', 
                array(
                    'label' 	=> __( 'By default, the color depends on accent color that you have set in "Global" section. If you tick this checkbox, the theme will use below option for the color instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '16',
                )
            )
        );
        
        
        // Link color
        $wp_customize->add_setting( 'uxbarn_sc_content_body_styles[link_color]', array(
                'default' 			=> '#fcda1c',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_content_body_styles[link_color]', array(
                    'label' 	=> __( 'Content Link Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '20',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_content_body_styles_link_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_content_body_styles_link_color_desc', 
                array(
                    'label' 	=> __( 'Only apply to general text hyperlinks of the content area. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '21',
                )
            )
        );
        
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_content_section_divider1', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_content_section_divider1', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '22',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_content_background_styles' ) ) {

    function uxbarn_ctmzr_register_content_background_styles( $wp_customize ) {
        
        // Content background color
        $wp_customize->add_setting( 'uxbarn_sc_content_background_styles[background_color]', array(
                'default'			=> '#202225',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_content_background_styles[background_color]', array(
                    'label' 	=> __( 'Content Background Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '25',
                )
            )
        );
		
		// Content opacity
        $wp_customize->add_setting('uxbarn_sc_content_background_styles_opacity', array(
                'default' => '0.7',
                'type' => 'option',
                'transport' => 'postMessage',
        )); 
        $wp_customize->add_control('uxbarn_sc_content_background_styles_opacity', array(
	            'label'   => __( 'Content Background Color Opacity', 'uxbarn' ),
	            'section' => 'uxbarn_sc_content_section',
	            'type'    => 'select',
	            'choices'    => uxbarn_ctmzr_get_opacity_array(),
	            'priority' => '26',
        ));
        
        // Content background image
        $wp_customize->add_setting( 'uxbarn_sc_content_background_styles[background_image]', array(
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'uxbarn_sc_content_background_styles[background_image]', array(
                    'label' 	=> __( 'Content Background Image', 'uxbarn' ),
                    'section'  	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '30',
                )
            )
        );
        
        // Content background attributes's title
        $wp_customize->add_setting( 'uxbarn_sc_content_background_styles_background_attr_title', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Title_Custom_Control( $wp_customize, 'uxbarn_sc_content_background_styles_background_attr_title', 
                array(
                    'label' 	=> __( 'Content Background Image Attributes', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '31',
                )
            )
        );
        
        // Content background repeat 
        $wp_customize->add_setting( 'uxbarn_sc_content_background_styles[background_repeat]', array(
                'default'	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_BackgroundRepeat_Custom_Control( $wp_customize, 'uxbarn_sc_content_background_styles[background_repeat]', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '32',
                )
            )
        );
        
        // Content background position 
        $wp_customize->add_setting( 'uxbarn_sc_content_background_styles[background_position]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_BackgroundPosition_Custom_Control( $wp_customize, 'uxbarn_sc_content_background_styles[background_position]', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '33',
                )
            )
        );
		
		// Divider
        $wp_customize->add_setting( 'uxbarn_sc_content_section_divider2', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_content_section_divider2', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '34',
                )
            )
        );
        
    }
    
}



if ( ! function_exists( 'uxbarn_ctmzr_register_content_scrollbar_styles' ) ) {

    function uxbarn_ctmzr_register_content_scrollbar_styles( $wp_customize ) {
        
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_content_scrollbar_styles[use_custom_color]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_content_scrollbar_styles[use_custom_color]', array(
            'label'   	=> __( 'Use custom color for content scrollbar (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_content_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '35',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_content_scrollbar_styles_use_custom_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_content_scrollbar_styles_use_custom_color_desc', 
                array(
                    'label' 	=> __( 'By default, the color depends on accent color that you have set in "Global" section. If you tick this checkbox, the theme will use below option for the color instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '36',
                )
            )
        );
		
        // Scrollbar color
        $wp_customize->add_setting( 'uxbarn_sc_content_scrollbar_color', array(
                'default'			=> '',
                'type' 				=> 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_content_scrollbar_color', array(
                    'label' 	=> __( 'Content Scrollbar Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_content_section',
                    'priority' 	=> '40',
                )
            )
        );
		
	}

}