<?php

if ( ! function_exists( 'uxb_team_load_admin_assets' ) ) {
		
	function uxb_team_load_admin_assets( $page ) {
		
		global $post;
		
		// For new-post, edit-post or list pages, and belongs to "uxbarn_team" post type
		if ( ( $page == 'post.php' || $page == 'post-new.php' ) || 
			 ( $page == 'edit.php' && ( isset( $post ) && $post->post_type == 'uxbarn_team' ) ) ) {
					
			wp_enqueue_style( 'uxb-team-backend', UXB_TEAM_URL . 'css/plugin-backend.css', array(), null );
		}
		
		
		// For plugin options page
		if ( $page == 'settings_page_uxb_team_options' ) {
			
			wp_enqueue_script( 'uxb-team-options', UXB_TEAM_URL . 'js/plugin-options.js', false );
			wp_enqueue_style( 'uxb-team-options', UXB_TEAM_URL . 'css/plugin-options.css', false );
			
	        $params = array(
	            'header_text' 	=> __( 'Please find below for some options that you can set for UXbarn Team plugin.', 'uxb_team' ),
	        );
			
	        wp_localize_script( 'uxb-team-options', 'UXbarnTeamOptions', $params );
			
		}
		
	}
	
}



if ( ! function_exists( 'uxb_team_load_frontend_styles' ) ) {
		
	function uxb_team_load_frontend_styles() {
		
	    wp_register_style( 'uxb-team-foundation', UXB_TEAM_URL . 'css/foundation-lite.css', array(), null ); // only contains row, columns stuff
		wp_register_style( 'uxb-team-frontend', UXB_TEAM_URL . 'css/plugin-frontend.css', array(), null );
		
	}
	
}



if ( ! function_exists( 'uxb_team_load_frontend_scripts' ) ) {
	
	function uxb_team_load_frontend_scripts() {
		
	    wp_register_script( 'uxb-team-modernizr', UXB_TEAM_URL . 'js/custom.modernizr.js', array( 'jquery' ), null );
	    wp_register_script( 'uxb-team-foundation', UXB_TEAM_URL . 'js/foundation.min.js', array( 'jquery' ), null, true );
		
	}
	
}



if ( ! function_exists( 'uxb_team_load_on_demand_assets' ) ) {
		
	function uxb_team_load_on_demand_assets() {
		
		global $post;
			
		if ( isset( $post ) && uxb_team_has_shortcode( 'uxb_team', $post->post_content ) ) {
			
			wp_enqueue_style( 'uxb-team-frontend' );
			
		}
		
		if ( is_singular( 'uxbarn_team' ) ) {
		
	    	wp_enqueue_style( 'uxb-team-foundation' );
			
		    wp_enqueue_script( 'uxb-team-modernizr' );
		    wp_enqueue_script( 'uxb-team-foundation' );
			wp_enqueue_style( 'uxb-team-frontend' );
			
			// Conditional comment for IE8
		    global $wp_styles;
		    wp_enqueue_style( 'uxb-team-foundation-ie8', UXB_TEAM_URL . 'css/foundation-ie8.css', array(), null);
		    $wp_styles->add_data( 'uxb-team-foundation-ie8', 'conditional', 'IE 8' );
			
		}
		
	}
	
}