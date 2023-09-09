<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_side_panel_tab' ) ) {

    function uxbarn_ctmzr_init_side_panel_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_side_panel_section_tab( $wp_customize );
        uxbarn_ctmzr_register_side_panel_logo( $wp_customize );
        uxbarn_ctmzr_register_side_panel_text( $wp_customize );
        uxbarn_ctmzr_register_side_panel_background_styles( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_side_panel_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_side_panel_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_side_panel_section', array(
                'title'    		=> __( 'Side Panel', 'uxbarn' ),
                'description' 	=> __( 'Customize the styles of side panel', 'uxbarn' ),
                'priority' 		=> '10',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_side_panel_logo' ) ) {
    
    function uxbarn_ctmzr_register_side_panel_logo( $wp_customize ) {
        
        // Logo image upload
        $wp_customize->add_setting( 'uxbarn_sc_panel_site_logo', array(
                'default' 	=> '',
                'type' 		=> 'option',
        )); 
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'uxbarn_sc_panel_site_logo', array(
                'label' 	=> __( 'Site Logo (R)', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_side_panel_section',
                'priority' 	=> '5',
        )));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_panel_styles_logo_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_panel_styles_logo_desc', 
                array(
                    'label' 	=> __( 'If not set, site title will display.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '6',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_side_panel_section_divider1', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_side_panel_section_divider1', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '7',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_side_panel_text' ) ) {
    
    function uxbarn_ctmzr_register_side_panel_text( $wp_customize ) {
        
        // Site title color
        $wp_customize->add_setting( 'uxbarn_sc_panel_styles[site_title_color]', array(
                'default' 			=> '#ffffff',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_panel_styles[site_title_color]', array(
                    'label'		=> __( 'Site Title Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '10',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_panel_styles_title_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_panel_styles_title_color_desc', 
                array(
                    'label' 	=> __( 'This color is for site title (if the logo image is not used).', 'uxbarn'),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '11',
                )
            )
        );
		
		
		// Site tagline color
        $wp_customize->add_setting( 'uxbarn_sc_panel_styles[site_tagline_color]', array(
                'default' 			=> '#dddddd',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_panel_styles[site_tagline_color]', array(
                    'label'		=> __( 'Site Tagline Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '15',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_panel_styles_tagline_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_panel_styles_tagline_color_desc', 
                array(
                    'label' 	=> __( 'This color is for the site tagline.', 'uxbarn'),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '16',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_side_panel_section_divider2', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_side_panel_section_divider2', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '17',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_side_panel_background_styles' ) ) {
    
    function uxbarn_ctmzr_register_side_panel_background_styles( $wp_customize ) {
        
        // Panel background color
        $wp_customize->add_setting( 'uxbarn_sc_panel_background_styles[background_color]', array(
                'default'    		=> '#202225',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_panel_background_styles[background_color]', array(
                    'label' 	=> __( 'Background Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '20',
                )
            )
        );
		
		// Panel opacity
        $wp_customize->add_setting( 'uxbarn_sc_panel_styles_background_opacity', array(
                'default' => '0.5',
                'type' => 'option',
                'transport' => 'postMessage',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_panel_styles_background_opacity', array(
	            'label'   => __( 'Background Color Opacity', 'uxbarn' ),
	            'section' => 'uxbarn_sc_side_panel_section',
	            'type'    => 'select',
	            'choices'    => uxbarn_ctmzr_get_opacity_array(),
	            'priority' => '21',
        ));
        
        // Panel background image
        $wp_customize->add_setting( 'uxbarn_sc_panel_background_styles[background_image]', array(
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'uxbarn_sc_panel_background_styles[background_image]', array(
                    'label' 	=> __( 'Background Image', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '25',
                )
            )
        );
        
        // Panel background attributes's title
        $wp_customize->add_setting( 'uxbarn_sc_panel_background_styles_background_attr_title', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Title_Custom_Control( $wp_customize, 'uxbarn_sc_panel_background_styles_background_attr_title', 
                array(
                    'label' 	=> __( 'Background Image Attributes', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '26',
                )
            )
        );
        
        // Panel background repeat 
        $wp_customize->add_setting( 'uxbarn_sc_panel_background_styles[background_repeat]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_BackgroundRepeat_Custom_Control( $wp_customize, 'uxbarn_sc_panel_background_styles[background_repeat]', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '27',
                )
            )
        );
        
        // Panel background position 
        $wp_customize->add_setting( 'uxbarn_sc_panel_background_styles[background_position]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_BackgroundPosition_Custom_Control( $wp_customize, 'uxbarn_sc_panel_background_styles[background_position]', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_side_panel_section',
                    'priority' 	=> '28',
                )
            )
        );
		
        
    }

}