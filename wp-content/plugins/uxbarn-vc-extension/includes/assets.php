<?php

if ( ! function_exists( 'uxb_exte_load_admin_assets' ) ) {
		
	function uxb_exte_load_admin_assets( $page ) {
		
		global $post;
		
		// Only load the assets if the current page falls under these PHP pages
		if ( $page == 'post.php' || $page == 'post-new.php' ) {
			
			wp_enqueue_style( 'uxb-exte-backend', UXB_EXTE_URL . 'css/plugin-backend.css', array(), null );
			
		}
		
	}
	
}



if ( ! function_exists( 'uxb_exte_load_frontend_styles' ) ) {
		
	function uxb_exte_load_frontend_styles() {
		
		// Prepare styles
	    wp_register_style( 'uxb-exte-frontend', UXB_EXTE_URL . 'css/plugin-frontend.css', array(), null );
	    wp_register_style( 'uxbarn-font-awesome', UXB_EXTE_URL . 'css/font-awesome.min.css', array(), null );
		
	}
	
}




if ( ! function_exists( 'uxb_exte_load_on_demand_assets' ) ) {
		
	function uxb_exte_load_on_demand_assets() {
		
		// Load the prepared styles depending on the current page and shortcodes
		if ( is_page() || is_single() ) {
			
			global $post;
			
			if ( uxb_exte_has_shortcode( 'uxb_heading', $post->post_content ) ||
				 uxb_exte_has_shortcode( 'uxb_icon', $post->post_content ) ||
				 uxb_exte_has_shortcode( 'uxb_blockquote', $post->post_content ) ||
				 uxb_exte_has_shortcode( 'uxb_divider', $post->post_content ) ||
				 uxb_exte_has_shortcode( 'uxb_dropcap', $post->post_content ) ||
				 uxb_exte_has_shortcode( 'uxb_highlight', $post->post_content ) ) {
				
				wp_enqueue_style( 'uxb-exte-frontend' );
				
			}
			
			if ( uxb_exte_has_shortcode( 'uxb_heading', $post->post_content ) ||
				 uxb_exte_has_shortcode( 'uxb_icon', $post->post_content ) ) {
				 	
				wp_enqueue_style( 'uxbarn-font-awesome' );
			}
			
		}
		
	}
	
}
