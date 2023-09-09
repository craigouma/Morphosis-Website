<?php

if ( ! function_exists( 'uxbarn_ctmzr_init_menu_tab' ) ) {

    function uxbarn_ctmzr_init_menu_tab( $wp_customize ) {
        
        uxbarn_ctmzr_register_menu_section_tab( $wp_customize );
        uxbarn_ctmzr_register_menu( $wp_customize );
        uxbarn_ctmzr_register_submenu( $wp_customize );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_menu_section_tab' ) ) {
    
    function uxbarn_ctmzr_register_menu_section_tab( $wp_customize ) {
            
        $wp_customize->add_section('uxbarn_sc_menu_section', array(
                'title'    		=> __( 'Menu', 'uxbarn' ),
                'description' 	=> __( 'Customize the menu styles', 'uxbarn' ),
                'priority' 		=> '20',
            )
        );
        
    }
	
}



if ( ! function_exists( 'uxbarn_ctmzr_register_menu' ) ) {
    
    function uxbarn_ctmzr_register_menu( $wp_customize ) {
        
        // Menu color
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles[color]', array(
                'default'    		=> '#ffffff',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_menu_styles[color]', array(
                    'label' 	=> __( 'Menu Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '5',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_menu_styles_color_desc', 
                array(
                    'label' 	=> __( 'Adjust text color for menu items.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '6',
                )
            )
        );
		
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_menu_styles[use_custom_color]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_menu_styles[use_custom_color]', array(
            'label'   	=> __( 'Use custom color for hovered and active menu (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_menu_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '7',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles_use_custom_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_menu_styles_use_custom_color_desc', 
                array(
                    'label' 	=> __( 'By default, the colors depend on accent color that you have set in "Global" section. If you tick this checkbox, the theme will use below options for the colors instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '8',
                )
            )
        );
        
        // Menu hover color
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles[hover_color]', array(
                'default'    		=> '#fcda1c',
                'type' 				=> 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_menu_styles[hover_color]', array(
                    'label' 	=> __( 'Hovered Menu Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '10',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles_hover_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_menu_styles_hover_color_desc', 
                array(
                    'label' 	=> __( 'Adjust text color for hovered menu items. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '11',
                )
            )
        );
        
        // Menu active color
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles[active_color]', array(
                'default'			=> '#fcda1c',
                'type' 				=> 'option',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_menu_styles[active_color]', array(
                    'label' 	=> __( 'Active Menu Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '15',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_menu_styles_active_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_menu_styles_active_color_desc', 
                array(
                    'label' 	=> __( 'Adjust text color for active menu items. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '16',
                )
            )
        );
		
        // Divider
        $wp_customize->add_setting( 'uxbarn_sc_menu_section_divider1', array(
                'default' 	=> '',
                'type' 		=> 'option',
                'transport' => 'postMessage',
            )
        );
        $wp_customize->add_control( new WP_Customize_Divider_Custom_Control( $wp_customize, 'uxbarn_sc_menu_section_divider1', array(
                    'label' 	=> '',
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '17',
                )
            )
        );
        
        
    }

}



if ( ! function_exists( 'uxbarn_ctmzr_register_submenu' ) ) {

    function uxbarn_ctmzr_register_submenu( $wp_customize ) {
        
        // Submenu panel color
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles[background_color]', array(
                'default' 			=> '#202225',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_submenu_styles[background_color]', array(
                    'label' 	=> __( 'Submenu Background Color (R)', 'uxbarn' ),
                    'section'	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '20',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles_panel_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_submenu_styles_panel_color_desc', 
                array(
                    'label' 	=> __( 'Adjust the background color of submenu panel.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '21',
                )
            )
        );
        
        
        // Submenu color
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles[color]', array(
                'default'			=> '#ffffff',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_submenu_styles[color]', array(
                    'label' 	=> __( 'Submenu Color (R)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '25',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_submenu_styles_color_desc', 
                array(
                    'label' 	=> __( 'Adjust text color for submenu items.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '26',
                )
            )
        );
        
		// Custom color checkbox
		$wp_customize->add_setting( 'uxbarn_sc_submenu_styles[use_custom_hovered_color]', array(
                'default' 			=> false,
                'type' 				=> 'option',
                'sanitize_callback' => 'uxbarn_ctmzr_sanitize_checkbox',
        )); 
        $wp_customize->add_control( 'uxbarn_sc_submenu_styles[use_custom_hovered_color]', array(
            'label'   	=> __( 'Use custom color for hovered submenu (R)', 'uxbarn' ),
            'section' 	=> 'uxbarn_sc_menu_section',
            'type'    	=> 'checkbox',
            'priority' 	=> '32',
        ));
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles_use_custom_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_submenu_styles_use_custom_color_desc', 
                array(
                    'label' 	=> __( 'By default, the color depends on accent color that you have set in "Global" section. If you tick this checkbox, the theme will use below option for the color instead.', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '33',
                )
            )
        );
		
		
        // Submenu hover color
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles[hover_color]', array(
                'default' 			=> '#fcda1c',
                'type' 				=> 'option',
                //'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uxbarn_sc_submenu_styles[hover_color]', array(
                    'label' 	=> __('Hovered Submenu Color (R)', 'uxbarn'),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '35',
                )
            )
        );
        // Description
        $wp_customize->add_setting( 'uxbarn_sc_submenu_styles_hover_color_desc', array(
            'default' => '',
        ));
        $wp_customize->add_control( new WP_Customize_Description_Custom_Control( $wp_customize, 'uxbarn_sc_submenu_styles_hover_color_desc', 
                array(
                    'label' 	=> __( 'Adjust text color for hovered submenu items. (You need to check the above checkbox to make this option working.)', 'uxbarn' ),
                    'section' 	=> 'uxbarn_sc_menu_section',
                    'priority' 	=> '36',
                )
            )
        );
		
		
        
    }

}