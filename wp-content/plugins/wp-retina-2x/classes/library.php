<?php

class Meow_WR2X_Library {

	public $core = null;

	public function __construct( $core ) {
		$this->core = $core;
		add_filter( 'manage_media_columns', array( $this, 'manage_media_columns' ) );
		add_action( 'manage_media_custom_column', array( $this, 'manage_media_custom_column' ), 10, 2 );
	}

	function manage_media_columns( $cols ) {
		$cols["wr2x_column"] = "Retina";
		return $cols;
	}

	function manage_media_custom_column( $column_name, $id ) {
		if ( $column_name == 'wr2x_column' ) {
			echo wp_kses_post( '<div class="wr2x-retina-field" data-id="' . $id . '"></div>' );
	  }
	}
}


?>
