<?php

/**
 * Plugin Name: UXbarn Testimonials
 * Plugin URI: http://themeforest.net/user/UXbarn?ref=UXbarn
 * Description: This plugin allows you to create and add testimonials into the page. <strong>Important:</strong> The plugin requires <a href="http://wordpress.org/plugins/option-tree/">OptionTree</a> plugin and the element interface is working via <a href="http://codecanyon.net/item/visual-composer-for-wordpress/242431?ref=UXbarn" target="_blank">Visual Composer</a> plugin.
 * Version: 1.0.2
 * Author: UXbarn
 * Author URI: http://themeforest.net/user/UXbarn?ref=UXbarn
 * License: GPL, ThemeForest License
*/


// ---------------------------------------------- //
// Set up constants
// ---------------------------------------------- //
define( 'UXB_TMNL_PATH', plugin_dir_path( __FILE__ ) );
define( 'UXB_TMNL_URL', plugins_url( '', __FILE__ ) . '/' );



// ---------------------------------------------- //
// Included all required PHP assets
// ---------------------------------------------- //
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( UXB_TMNL_PATH . 'includes/post-types.php' );
require_once( UXB_TMNL_PATH . 'includes/shortcodes.php' );
require_once( UXB_TMNL_PATH . 'includes/custom-widgets.php' );
require_once( UXB_TMNL_PATH . 'includes/plugin-functions.php' );
require_once( UXB_TMNL_PATH . 'includes/assets.php' );
require_once( UXB_TMNL_PATH . 'includes/meta-boxes.php' );



// ---------------------------------------------- //
// Initialize the plugin
// ---------------------------------------------- //
add_action( 'plugins_loaded', 'uxb_tmnl_init_plugin' );



if ( ! function_exists( 'uxb_tmnl_init_plugin' ) ) {

	function uxb_tmnl_init_plugin() {
		
		/***** Load all scripts and styles *****/
		// [assets.php]
		add_action( 'admin_enqueue_scripts', 'uxb_tmnl_load_admin_assets' );
		add_action( 'wp_enqueue_scripts', 'uxb_tmnl_load_frontend_styles' );
		add_action( 'wp_enqueue_scripts', 'uxb_tmnl_load_frontend_scripts' );
		add_action( 'wp_enqueue_scripts', 'uxb_tmnl_load_on_demand_assets' );
		
		
		/***** Register post type *****/
		// [post-types.php]
		add_action( 'init', 'uxb_tmnl_register_cpt', 11 );
		
		
		/***** Register meta boxes (OptionTree plugin is required) *****/
		// [meta-boxes.php]
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			add_action( 'admin_init', 'uxb_tmnl_create_meta_boxes' );
		}
		
		
		/***** Load Portfolio element and shortcode *****/
		// [plugin-functions.php]
		
		// Register shortcode
		add_action( 'init', 'uxb_tmnl_load_shortcodes' );
		
		// Only if Visual Composer is active
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			add_action( 'admin_init', 'uxb_tmnl_load_testimonials_element', 11 );
		}
		
		
		// Register all plugin's image sizes
		add_action( 'init', 'uxb_tmnl_register_plugin_image_sizes' );
		
		
		// Register custom widgets
		add_action( 'widgets_init', 'uxb_tmnl_register_widgets' );
		
		
	    // Load available text domains for localization of the plugin
		load_plugin_textdomain( 'uxb_tmnl', false, basename( dirname( __FILE__ ) ) . '/languages' );
		
	}
	
}
		