<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_sidebar_tab' ) ) {
    
    function uxbarn_ctmzr_init_sidebar_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_sidebar_section_tab( $wp_customize );
        uxbarn_ctmzr_register_sidebar_body_styles( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_sidebar_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_sidebar_section_tab( $wp_customize ) {
            
        $wp_customize->add_section( 'uxbarn_sc_sidebar_section', array(
                'title'    		=> __( 'Sidebar', 'uxbarn' ),
                'description' 	=> __( 'Customize the styles of sidebar area.', 'uxbarn' ),
                'priority' 		=> '40',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_sidebar_body_styles' ) ) {

    function uxbarn_ctmzr_register_sidebar_body_styles( $wp_customize ) {
        
        // Heading color
        $wp_customize->add_setting( 'uxbarn_sc_sidebar_body_styles[heading_color]', array(
                'default' 			=> '#ffffff',
                'type' 				=> 'option',
                'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_sidebar_body_styles[heading_color]', array(
                    'label' 	=> __( 'Sidebar Heading Color', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_sidebar_section',
                    'priority' 	=> '5',
                )
            )
        );
        
        // Text color
        $wp_customize->add_setting( 'uxbarn_sc_sidebar_body_styles[text_color]', array(
                'default' 			=> '',
                'type' 				=> 'option',
                //'transport' 		=> 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_sidebar_body_styles[text_color]', array(
                    'label' 	=> __( 'Sidebar Text Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_sidebar_section',
                    'priority' 	=> '10',
                )
            )
        );
        
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_sidebar_body_styles[use_custom_link_color]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_sidebar_body_styles[use_custom_link_color]', array(
            'label'   	=> __( 'Use custom color for sidebar link (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_sidebar_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '11',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_sidebar_body_styles_use_custom_sidebar_link_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_sidebar_body_styles_use_custom_sidebar_link_desc', 
                array(
                    'label' 	=> __( 'By default, the color depends on accent color that you have set in "Global" section. If you tick this checkbox, the theme will use below option for the color instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_sidebar_section',
                    'priority' 	=> '12',
                )
            )
        );
		
        // Link color
        $wp_customize->add_setting( 'uxbarn_sc_sidebar_body_styles[link_color]', array(
                'default'    		=> '',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_sidebar_body_styles[link_color]', array(
                    'label' 	=> __( 'Sidebar Link Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_sidebar_section',
                    'priority' 	=> '15',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_sidebar_body_styles_link_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_sidebar_body_styles_link_color_desc', 
                array(
                    'label' 	=> __( 'Only apply to general text hyperlinks. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_sidebar_section',
                    'priority' 	=> '16',
                )
            )
        );
        
    }

}