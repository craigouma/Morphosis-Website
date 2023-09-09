<?php

// Register custom controls to be used in customizer
require_once( get_template_directory() . '/includes/style-customizer/custom-controls.php' );

// Include customizer functions
require_once( get_template_directory() . '/includes/style-customizer/customizer-functions.php' );

// Include customizer sections
$section_path = get_template_directory() . '/includes/style-customizer/sections';
require_once( $section_path . '/readme.php' );
require_once( $section_path . '/global.php' );
require_once( $section_path . '/side-panel.php' );
require_once( $section_path . '/menu.php' );
require_once( $section_path . '/page-intro.php' );
require_once( $section_path . '/content.php' );
require_once( $section_path . '/sidebar.php' );
require_once( $section_path . '/others.php' );
require_once( get_template_directory() . '/includes/style-customizer/output.php' );



if ( ! function_exists( 'uxbarn_ctmzr_register_customizer_sections' ) ) {

    function uxbarn_ctmzr_register_customizer_sections( $wp_customize ) {
        
		uxbarn_ctmzr_register_readme( $wp_customize );
		uxbarn_ctmzr_init_global_tab( $wp_customize );
		uxbarn_ctmzr_init_side_panel_tab( $wp_customize );
		uxbarn_ctmzr_init_menu_tab( $wp_customize );
		uxbarn_ctmzr_init_intro_tab( $wp_customize );
		uxbarn_ctmzr_init_content_tab( $wp_customize );
		uxbarn_ctmzr_init_sidebar_tab( $wp_customize );
		uxbarn_ctmzr_init_others_tab( $wp_customize );
        
        // Remove any default sections
        $wp_customize->remove_section( 'title_tagline' );
        $wp_customize->remove_section( 'nav' );
        $wp_customize->remove_section( 'static_front_page' );
        
    }

}