<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_global_tab' ) ) {
    
    function uxbarn_ctmzr_init_global_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_global_section_tab( $wp_customize );
        uxbarn_ctmzr_register_global_colors( $wp_customize );
        uxbarn_ctmzr_register_global_fonts( $wp_customize );
		uxbarn_ctmzr_register_global_site_bg_styles( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_global_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_global_section', array(
                'title'    		=> __( 'Global', 'uxbarn' ),
                'description' 	=> __( 'Customize the global styles', 'uxbarn' ),
                'priority' 		=> '5',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_colors' ) ) {

    function uxbarn_ctmzr_register_global_colors( $wp_customize ) {
        
        // Primary color
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[accent_color]', array(
                'default' 	=> '#fcda1c',
                'type' 		=> 'option',
                //'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_global_styles[accent_color]', array(
                    'label'     => __( 'Accent Color (R)', 'uxbarn' ),
                    'section'   => 'uxbarn_sc_global_section',
                    'priority' 	=> '10',
                )
            )
        );
		
		// Description
        $wp_customize->add_setting( 'uxbarn_sc_global_accent_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_accent_color_desc', 
                array(
                    'label' 	=> __( 'Select the accent color for the theme.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '11',
                )
            )
        );
        
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_global_section_divider2', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_global_section_divider2', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '12',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_fonts' ) ) {

    function uxbarn_ctmzr_register_global_fonts( $wp_customize ) {
        
        // Primary font
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[primary_font]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_FontFamily_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles[primary_font]', 
            array(
                'label'   	=> __( 'Primary Font', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_global_section',
                'priority' 	=> '15',
            )
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_global_styles_primary_font_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles_primary_font_desc', 
                array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '16',
                )
            )
        );
        
        // Secondary font
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[secondary_font]', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_FontFamily_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles[secondary_font]', 
            array(
                'label'   	=> __( 'Secondary Font', 'uxbarn' ),
                'section' 	=> 'uxbarn_sc_global_section',
                'priority' 	=> '20',
            )
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_global_styles_secondary_font_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_styles_secondary_font_desc', 
                array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '21',
                )
            )
        );
		
		// Divider
        $wp_customize->add_setting( 'uxbarn_sc_global_section_divider3', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_global_section_divider3', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '22',
                )
            )
        );
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_global_site_bg_styles' ) ) {
    
    function uxbarn_ctmzr_register_global_site_bg_styles( $wp_customize ) {
			
		// Site background color
        $wp_customize->add_setting( 'uxbarn_sc_global_styles[background_color]', array(
                'default'    		=> '#202225',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_global_styles[background_color]', array(
                    'label' 	=> __( 'Site Background Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '25',
                )
            )
        );
		
		// Description
        $wp_customize->add_setting( 'uxbarn_sc_global_site_background_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_global_site_background_color_desc', 
                array(
                    'label' 	=> __( 'You will see this background color when the fullscreen slider is loading.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_global_section',
                    'priority' 	=> '26',
                )
            )
        );
		
	}

}