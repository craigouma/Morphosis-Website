<?php

/**
 * Plugin Name: UXbarn Extension for Visual Composer
 * Plugin URI: http://themeforest.net/user/UXbarn?ref=UXbarn
 * Description: This plugin includes some additional elements for working with Visual Composer plugin and two more shortcodes. The elements are Heading, Icon, Blockquote and Divider. The shortcodes are Drop Cap, and Highlight. <strong>Important:</strong> The plugin's element interfaces are working via <a href="http://codecanyon.net/item/visual-composer-for-wordpress/242431?ref=UXbarn" target="_blank">Visual Composer</a> plugin.
 * Version: 1.0.3
 * Author: UXbarn
 * Author URI: http://themeforest.net/user/UXbarn?ref=UXbarn
 * License: GPL, ThemeForest License
*/


// ---------------------------------------------- //
// Set up constants
// ---------------------------------------------- //
define( 'UXB_EXTE_PATH', plugin_dir_path( __FILE__ ) );
define( 'UXB_EXTE_URL', plugins_url( '', __FILE__ ) . '/' );



// ---------------------------------------------- //
// Included all required PHP assets
// ---------------------------------------------- //
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( UXB_EXTE_PATH . 'includes/vc-param-array.php' );
require_once( UXB_EXTE_PATH . 'includes/shortcodes.php' );
require_once( UXB_EXTE_PATH . 'includes/assets.php' );
require_once( UXB_EXTE_PATH . 'includes/plugin-functions.php' );



// ---------------------------------------------- //
// Initialize the plugin
// ---------------------------------------------- //
add_action( 'plugins_loaded', 'uxb_exte_init_plugin' );



if( ! function_exists( 'uxb_exte_init_plugin' ) ) {

	function uxb_exte_init_plugin() {
		
		/***** Load all scripts and styles *****/
		// [assets.php]
		add_action( 'admin_enqueue_scripts', 'uxb_exte_load_admin_assets' );
		add_action( 'wp_enqueue_scripts', 'uxb_exte_load_frontend_styles' );
		add_action( 'wp_enqueue_scripts', 'uxb_exte_load_on_demand_assets' );
		
		
		
		/***** Initialize the functions *****/
		// [plugin-functions.php]
		add_action( 'init', 'uxb_exte_load_shortcodes' );
		
		// Only if Visual Composer is active
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			
			// Load extended custom elements
			//add_action( 'admin_init', 'uxb_exte_load_elements' );
			add_action( 'admin_init', 'uxb_exte_load_heading_element' );
			add_action( 'admin_init', 'uxb_exte_load_icon_element' );
			add_action( 'admin_init', 'uxb_exte_load_blockquote_element' );
			add_action( 'admin_init', 'uxb_exte_load_divider_element' );
			
		}
		
		
		// Load available text domains for localization of the plugin
		load_plugin_textdomain( 'uxb_exte', false, basename( dirname( __FILE__ ) ) . '/languages' );
		
	}
	
}
		