<?php

register_deactivation_hook( 'Meow_WR2X_Admin', 'wr2x_deactivate' );
register_activation_hook( 'Meow_WR2X_Admin', 'wr2x_activate' );

class Meow_WR2X_Admin extends MeowCommon_Admin {

	public $core = null;

	public function __construct( $core ) {
		$this->core = $core;
		parent::__construct( WR2X_PREFIX, WR2X_ENTRY, WR2X_DOMAIN, class_exists( 'MeowPro_WR2X_Core' ) );
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'app_menu' ) );
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
	}

	function enqueue_scripts() {

		$physical_file = WR2X_PATH . '/app/vendor.js';
		$cache_buster = file_exists( $physical_file ) ? filemtime( $physical_file ) : WR2X_VERSION;
		wp_register_script( 'wr2x_perfect_images-vendor', WR2X_URL . 'app/vendor.js',
			['wp-element', 'wp-i18n'], $cache_buster
		);

		// Load the "admin" scripts
		$physical_file = WR2X_PATH . '/app/index.js';
		$cache_buster = file_exists( $physical_file ) ? filemtime( $physical_file ) : WR2X_VERSION;
		wp_register_script( 'wr2x_perfect_images-index', WR2X_URL . 'app/index.js', 
			['wr2x_perfect_images-vendor'], $cache_buster 
		);

		// Load the fonts
		wp_register_style( 'meow-neko-ui-lato-font', 
			'//fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap');
		wp_enqueue_style( 'meow-neko-ui-lato-font' );

		// Localize and options
		global $wplr;
		wp_localize_script( 'wr2x_perfect_images-index', 'wr2x_retina', array_merge( [
			//'api_nonce' => wp_create_nonce( 'mfrh_media_file_renamer' ),
			'home_url' => get_home_url(),
			'site_url' => get_site_url(),
			'api_url' => get_rest_url( null, '/wp-retina-2x/v1/' ),
			'upload_url' => $this->core->get_upload_root_url(),
			'rest_url' => get_rest_url(),
			'plugin_url' => WR2X_URL,
			'prefix' => WR2X_PREFIX,
			'domain' => WR2X_DOMAIN,
			'is_pro' => class_exists( 'MeowPro_WR2X_Core' ),
			'is_registered' => !!$this->is_registered(),
			'rest_nonce' => wp_create_nonce( 'wp_rest' ),
			//'image_sizes' => $this->core->get_image_sizes( ARRAY_A ),

			'options' => $this->core->get_all_options(),
		] ) );

		wp_enqueue_script( 'wr2x_perfect_images-index' );
	}

	function admin_notices() {
		if ( current_user_can( 'activate_plugins' ) ) {
			if ( delete_transient( 'wr2x_flush_rules' ) ) {
				global $wp_rewrite;
				Meow_WR2X_Admin::generate_rewrite_rules( $wp_rewrite, true );
			}
		}
		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
			echo "<div class='error' style='margin-top: 20px;'><p>";
			_e( "JetPack's <b>Photon</b> module breaks features built in WP Retina 2x (as Photos moves the files away). A common and better alternative to Photon is to use <a href='http://tracking.maxcdn.com/c/97349/3982/378'>MaxCDN</a> (very popular), CloudFlare or Fastly.", 'wp-retina-2x' );
			echo "</p></div>";
		}
	}

	static function activate() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

	static function deactivate() {
		remove_filter( 'generate_rewrite_rules', array( 'Meow_WR2X_Admin', 'generate_rewrite_rules' ) );
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}

	static function generate_rewrite_rules( $wp_rewrite, $flush = false ) {
		global $wp_rewrite;
		$options = get_option( Meow_WR2X_Core::get_plugin_option_name(), null );
		$method = $options["method"] ?? false;
		if ( $method == "Retina-Images" ) {

			// MODIFICATION: docwhat
			// get_home_url() -> trailingslashit(site_url())
			// REFERENCE: http://wordpress.org/support/topic/plugin-wp-retina-2x-htaccess-generated-with-incorrect-rewriterule

			// MODIFICATION BY h4ir9
			// .*\.(jpg|jpeg|gif|png|bmp) -> (.+.(?:jpe?g|gif|png))
			// REFERENCE: http://wordpress.org/support/topic/great-but-needs-a-little-update

			$handlerurl = str_replace( trailingslashit( site_url()), '', plugins_url( 'wr2x_image.php', __FILE__ ) );
			add_rewrite_rule( '(.+.(?:jpe?g|gif|png))', $handlerurl, 'top' );
		}
		if ( $flush == true ) {
			$wp_rewrite->flush_rules();
		}
	}

	// function common_url( $file ) {
	// 	return trailingslashit( plugin_dir_url( __FILE__ ) ) . 'common/' . $file;
	// }

	public function wr2x_settings() {
		echo '<div id="wr2x-admin-settings"></div>';
	}

	function app_menu() {
		add_submenu_page( 'meowapps-main-menu', __( 'Perfect Images', WR2X_DOMAIN ), __( 'Perfect Images', WR2X_DOMAIN ), 
			'manage_options', 'wr2x_settings', array( $this, 'wr2x_settings' )
		);
	}
}

?>
