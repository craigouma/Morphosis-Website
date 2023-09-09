<?php

/**
 * Plugin Name: UXbarn Portfolio
 * Plugin URI: http://themeforest.net/user/UXbarn?ref=UXbarn
 * Description: This plugin allows you to create portfolio items to represent your works. <strong>Important:</strong> The plugin requires <a href="http://wordpress.org/plugins/option-tree/">OptionTree</a> plugin and the element interface is working via <a href="http://codecanyon.net/item/visual-composer-for-wordpress/242431?ref=UXbarn" target="_blank">Visual Composer</a> plugin.
 * Version: 1.1.2
 * Author: UXbarn
 * Author URI: http://themeforest.net/user/UXbarn?ref=UXbarn
 * License: GPL, ThemeForest License
*/


// ---------------------------------------------- //
// Set up constants
// ---------------------------------------------- //
define( 'UXB_PORT_PATH', plugin_dir_path( __FILE__ ) );
define( 'UXB_PORT_URL', plugins_url( '', __FILE__ ) . '/' );



// ---------------------------------------------- //
// Included all required PHP assets
// ---------------------------------------------- //
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( UXB_PORT_PATH . 'includes/post-types.php' );
require_once( UXB_PORT_PATH . 'includes/vc-param-array.php' );
require_once( UXB_PORT_PATH . 'includes/shortcodes.php' );
require_once( UXB_PORT_PATH . 'includes/plugin-functions.php' );
require_once( UXB_PORT_PATH . 'includes/assets.php' );
require_once( UXB_PORT_PATH . 'includes/meta-boxes.php' );
require_once( UXB_PORT_PATH . 'includes/plugin-options.php' );
require_once( UXB_PORT_PATH . 'includes/template-chooser.php' );
require_once( UXB_PORT_PATH . 'includes/filters.php' );



// ---------------------------------------------- //
// Initialize the plugin
// ---------------------------------------------- //
add_action( 'plugins_loaded', 'uxb_port_init_plugin' );



if ( ! function_exists( 'uxb_port_init_plugin' ) ) {

	function uxb_port_init_plugin() {
		
		/***** Load all scripts and styles *****/
		// [assets.php]
		add_action( 'admin_enqueue_scripts', 'uxb_port_load_admin_assets' );
		add_action( 'wp_enqueue_scripts', 'uxb_port_load_frontend_styles' );
		add_action( 'wp_enqueue_scripts', 'uxb_port_load_frontend_scripts' );
		add_action( 'wp_enqueue_scripts', 'uxb_port_load_on_demand_assets' );
		
		
		/***** Register post type and taxonomy *****/
		// [post-types.php]
		add_action( 'init', 'uxb_port_register_cpt', 11 );
		
		
		/***** Register meta boxes (OptionTree plugin is required) *****/
		// [meta-boxes.php]
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			add_action( 'admin_init', 'uxb_port_create_meta_boxes' );
		}
		
		
		/***** Load Portfolio element and shortcode *****/
		// [plugin-functions.php]
		
		// Register shortcode
		add_action( 'init', 'uxb_port_load_shortcodes' );
		
		// Only if Visual Composer is active
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			add_action( 'admin_init', 'uxb_port_load_portfolio_element', 11 );
		}
		
		
		/***** Register plugin options (OptionTree plugin is required) *****/
		// [plugin-options.php]
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			add_action( 'init', 'uxb_port_create_plugin_options' );
		}
		
		
		// Add custom function to the "template_include" filter hook to load the plugin templates for single and archive pages
		// [template-chooser.php]
		add_filter( 'template_include', 'uxb_port_template_chooser' );
		
		
		// This custom filter is for rendering the title on templates
		// [filters.php]
		add_filter( 'uxb_port_single_title', 'uxb_port_single_title_filter_function' );
		add_filter( 'uxb_port_tax_title', 'uxb_port_tax_title_filter_function', 10, 0 );
		
		
		// For any modification to global $query object before it's run
		// For example: reset posts per page for custom taxonomy template to be independent from blog posts 
		add_action( 'pre_get_posts', 'uxb_port_alter_query_object' );
	    
		
		// Register all plugin's image sizes
		add_action( 'init', 'uxb_port_register_plugin_image_sizes' );
		
		
		// Load available text domains for localization of the plugin
	    load_plugin_textdomain( 'uxb_port', false, basename( dirname( __FILE__ ) ) . '/languages' );
		
	}

}