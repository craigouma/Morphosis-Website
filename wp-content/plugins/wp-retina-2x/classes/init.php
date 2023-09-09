<?php

if ( class_exists( 'MeowPro_WR2X_Core' ) && class_exists( 'Meow_WR2X_Core' ) ) {
	function wr2x_admin_notices() {
		echo '<div class="error"><p>Thanks for installing the Pro version of Perfect Images (WP Retina 2x) :) However, the free version is still enabled. Please disable or uninstall it.</p></div>';
	}
	add_action( 'admin_notices', 'wr2x_admin_notices' );
	return;
}

spl_autoload_register(function ( $class ) {
  $necessary = true;
  $file = null;
  if ( strpos( $class, 'Meow_WR2X' ) !== false ) {
    $file = WR2X_PATH . '/classes/' . str_replace( 'meow_wr2x_', '', strtolower( $class ) ) . '.php';
  }
  else if ( strpos( $class, 'MeowCommon_' ) !== false ) {
    $file = WR2X_PATH . '/common/' . str_replace( 'meowcommon_', '', strtolower( $class ) ) . '.php';
  }
  else if ( strpos( $class, 'MeowCommonPro_' ) !== false ) {
    $necessary = false;
    $file = WR2X_PATH . '/common/premium/' . str_replace( 'meowcommonpro_', '', strtolower( $class ) ) . '.php';
  }
  else if ( strpos( $class, 'MeowPro_WR2X' ) !== false ) {
    $necessary = false;
    $file = WR2X_PATH . '/premium/' . str_replace( 'meowpro_wr2x_', '', strtolower( $class ) ) . '.php';
  }
  if ( $file ) {
    if ( !$necessary && !file_exists( $file ) ) {
      return;
    }
    require( $file );
  }
});

new Meow_WR2X_Core();

?>