<?php

// ---------------------------------------------- //
// Set up constants
// ---------------------------------------------- //
define( 'UXB_THEME_ROOT_IMAGE_URL', get_template_directory_uri() . '/images/' );
define( 'UXB_DEFAULT_GOOGLE_FONTS', 'Montserrat:400,700|Pontano+Sans|Lato' );



// ---------------------------------------------- //
// Included all required PHP assets
// ---------------------------------------------- //
require_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // for supporting "is_plugin_active()" usage
require_once( get_template_directory() . '/includes/assets.php' );
require_once( get_template_directory() . '/includes/theme-functions.php' );
require_once( get_template_directory() . '/includes/custom-widgets.php' );
require_once( get_template_directory() . '/includes/comment-item.php' );
require_once( get_template_directory() . '/includes/meta-boxes/shared-meta-fullscreen.php' );
require_once( get_template_directory() . '/includes/meta-boxes/shared-meta-content.php' );
require_once( get_template_directory() . '/includes/meta-boxes/meta-post.php' );
require_once( get_template_directory() . '/includes/meta-boxes/meta-page.php' );
require_once( get_template_directory() . '/includes/theme-options.php' );
require_once( get_template_directory() . '/includes/style-customizer/loader.php' );
require_once( get_template_directory() . '/includes/plugin-codes/custom-optiontree.php' );
require_once( get_template_directory() . '/includes/plugin-codes/tgm/class-tgm-plugin-activation.php' );



// ---------------------------------------------- //
// Initialize the theme
// ---------------------------------------------- //
add_action( 'after_setup_theme', 'uxbarn_init_theme' );



if ( ! function_exists( 'uxbarn_init_theme' ) ) {
	
	function uxbarn_init_theme() {
		
		/***** Register WP features *****/
	    if ( ! isset( $content_width ) ) $content_width = 900;
	  	add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
	    
		
	    
	    /***** Register theme scripts and styles *****/
	    // [assets.php]
	    add_action( 'wp_enqueue_scripts', 'uxbarn_load_css' );
	    add_action( 'wp_enqueue_scripts', 'uxbarn_load_js' );
	    add_action( 'wp_enqueue_scripts', 'uxbarn_load_on_demand_assets' );
	    add_action( 'admin_enqueue_scripts', 'uxbarn_load_admin_assets' );
	    
	    
		
	    /***** Register main WP modules *****/
	    // [theme-functions.php]
	    add_action( 'wp_head', 'uxbarn_print_bullet_style' );
	    add_action( 'init', 'uxbarn_register_menus' );
	    add_action( 'widgets_init', 'uxbarn_register_sidebars' );
	    add_filter( 'user_contactmethods', 'uxbarn_update_user_profile_fields' );
	    add_filter( 'wp_title', 'uxbarn_rewrite_site_title', 10, 3 ); // Handle the site title rewrite
	    add_filter( 'widget_text', 'do_shortcode' ); // Enable shortcode usage in widget area
		
		
		
		/***** Register meta boxes and Theme Options (OptionTree plugin is required) *****/
		// [theme-functions.php, theme-options.php]
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			
			add_action( 'admin_init', 'uxbarn_create_meta_boxes' );
			add_action( 'admin_init', 'uxbarn_custom_theme_options', 1 );
			
		}
		
	    
		
		/***** Register Style Customizer *****/
		// [loader.php, customizer-functions.php]
	    add_action( 'customize_register', 'uxbarn_ctmzr_register_customizer_sections' );
		add_action( 'customize_preview_init', 'uxbarn_ctmzr_load_customizer_live_preview' );
		add_action( 'customize_controls_enqueue_scripts', 'uxbarn_ctmzr_load_customizer_assets' );
		add_action( 'admin_menu', 'uxbarn_ctmzr_register_customizer_menu' );
		add_action( 'customize_controls_print_styles', 'uxbarn_ctmzr_fix_section_bug' );
	    
	    
		
		/***** Others *****/
		// [theme-functions.php]
		
		// Register theme's custom widgets
		add_action( 'widgets_init', 'uxbarn_register_widgets' );
		
	    // Register theme's image sizes
	    add_action( 'init', 'uxbarn_register_theme_image_sizes' );
		
	    // Add all image sizes into the list of media editor
	    add_filter( 'image_size_names_choose', 'uxbarn_merge_image_sizes' );  
	    
	    // Make the empty search value navigating to the correct page
	    add_filter( 'request', 'uxbarn_request_filter' );
	    
	    // Change the WP excerpt length (in words count)
	    add_filter( 'excerpt_length', 'uxbarn_custom_excerpt_length', 999 );
	    
	    // Change trimmed excerpt from "[...]" to just "..."
	    add_filter( 'excerpt_more', 'uxbarn_new_excerpt_more' );
		
		// Add "wmode" to the YouTube embed of WordPress
		add_filter( 'oembed_result', 'uxbarn_add_oembed_wmode', 10, 2 );
		
	    // Load available text domains for localization of the theme
	    load_theme_textdomain( 'uxbarn', get_template_directory() . '/languages' );
		load_theme_textdomain( 'uxb_exte', get_template_directory() . '/languages' ); // UXbarn VC Extension plugin's text domain
		load_theme_textdomain( 'uxb_port', get_template_directory() . '/languages' ); // UXbarn Portfolio plugin's text domain
		load_theme_textdomain( 'uxb_team', get_template_directory() . '/languages' ); // UXbarn Team plugin's text domain
		load_theme_textdomain( 'uxb_tmnl', get_template_directory() . '/languages' ); // UXbarn Testimonials plugin's text domain
		load_theme_textdomain( 'js_composer', get_template_directory() . '/languages' ); // Visual Composer plugin's text domain
	    load_theme_textdomain( 'tgmpa', get_template_directory() . '/languages' ); // TGM Plugin Activation's text domain
		
		// Load plugin requirements
		add_action( 'tgmpa_register', 'uxbarn_register_additional_plugins' );
		
		// Hide OptionTree menu
	    add_action( 'admin_head', 'uxbarn_hide_ot_admin_menu' );
		
		
		
		/***** Plugin-related *****/
		
		// Visual Composer plugin
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			
			require_once( get_template_directory() . '/includes/plugin-codes/visual-composer/custom-vc.php' );
			
			add_action( 'admin_init', 'uxbarn_remove_default_vc_elements' );
			add_action( 'admin_init', 'uxbarn_init_vc_element_interfaces' );
			add_filter( 'vc_shortcodes_css_class', 'uxbarn_customize_vc_rows_columns', 10, 2 );
			add_action( 'wp_enqueue_scripts', 'uxbarn_load_custom_vc_js' );
			
			// Disable frontend edit feature (since VC 4.0.2)
			if ( function_exists( 'vc_disable_frontend' ) ) vc_disable_frontend();
			
			// This will hide certain tabs under the Settings->Visual Composer page + disable auto update checker by passing "true"
			if ( function_exists( 'vc_set_as_theme' ) ) vc_set_as_theme( true );
			
		}
		
		
		// UXbarn VC Extension plugin
		if ( is_plugin_active( 'uxbarn-vc-extension/uxbarn-vc-extension.php' ) ) {
			
			require_once( get_template_directory() . '/includes/plugin-codes/custom-uxbarn-vc-extension.php' );
			
			// Run theme's custom code to override functions of the plugin
			add_action( 'init', 'uxbarn_vc_extension_custom' );
			
		}
		
		
		// UXbarn Portfolio plugin
		if ( is_plugin_active( 'uxbarn-portfolio/uxbarn-portfolio.php' ) ) {
			
			require_once( get_template_directory() . '/includes/plugin-codes/custom-uxbarn-portfolio.php' );
			
			// Run theme's custom code to override functions of the plugin
			add_action( 'init', 'uxbarn_portfolio_custom' );
			
		}
		
		
		// UXbarn Team plugin
		if ( is_plugin_active( 'uxbarn-team/uxbarn-team.php' ) ) {
			
			require_once( get_template_directory() . '/includes/plugin-codes/custom-uxbarn-team.php' );
			
			// Run theme's custom code to override functions of the plugin
			add_action( 'init', 'uxbarn_team_custom' );
			
		}
		
		
		// UXbarn Testimonials plugin
		if ( is_plugin_active( 'uxbarn-testimonials/uxbarn-testimonials.php' ) ) {
			
			require_once( get_template_directory() . '/includes/plugin-codes/uxbarn-testimonials/custom-widgets.php' );
			require_once( get_template_directory() . '/includes/plugin-codes/uxbarn-testimonials/custom-uxbarn-testimonials.php' );
			
			// Remove and add some actions that cannot be used in "uxbarn_testimonials_custom()" with "init" hook below
			remove_action( 'widgets_init', 'uxb_tmnl_register_widgets' );
			add_action( 'widgets_init', 'uxbarn_custom_tmnl_register_widgets' );
			
			// Run theme's custom code to override functions of the plugin
			add_action( 'init', 'uxbarn_testimonials_custom' );
		
			
		}
		
	}
	
}