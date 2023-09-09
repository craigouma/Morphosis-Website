<?php

class Meow_WR2X_Dashboard {

	public $core = null;

	public function __construct( $core ) {
		$this->core = $core;
		add_action( 'admin_menu', array( $this, 'admin_menu_dashboard' ) );
	}

	function admin_menu_dashboard () {
		$flagged = count( $this->core->get_issues() );
		$warning_title = __( "Perfect Images", 'wp-retina-2x' );
		$menu_label_nui = sprintf( __( 'Perfect Images %s' ), "<span class='update-plugins count-$flagged' title='$warning_title'><span class='update-count'>" . number_format_i18n( $flagged ) . "</span></span>" );
		add_media_page( 'Perfect Images', $menu_label_nui, 'manage_options', 'wr2x_dashboard', array( $this, 'wr2x_dashboard' ) );
	}

	public function wr2x_dashboard() {
		echo '<div id="wr2x-dashboard"></div>';
	}
}
?>
