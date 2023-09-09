<?php

if ( ! function_exists( 'uxb_tmnl_load_admin_assets' ) ) {
		
	function uxb_tmnl_load_admin_assets( $page ) {
		
		global $post;
		
		// For new-post, edit-post or list pages, and belongs to "uxbarn_testimonials" post type
		if ( ( $page == 'post.php' || $page == 'post-new.php' ) || 
			 ( $page == 'edit.php' && ( isset( $post ) && $post->post_type == 'uxbarn_testimonials' ) ) ) {
					
			wp_enqueue_style( 'uxb-tmnl-backend', UXB_TMNL_URL . 'css/plugin-backend.css', array(), null );
		}
		
	}
	
}



if ( ! function_exists( 'uxb_tmnl_load_frontend_styles' ) ) {
		
	function uxb_tmnl_load_frontend_styles() {
		
		wp_register_style( 'uxb-tmnl-frontend', UXB_TMNL_URL . 'css/plugin-frontend.css', array(), null );
		wp_register_style( 'uxb-tmnl-responsive', UXB_TMNL_URL . 'css/plugin-responsive.css', array( 'uxb-tmnl-frontend' ), null );
		
	}
	
}



if ( ! function_exists( 'uxb_tmnl_load_frontend_scripts' ) ) {
		
	function uxb_tmnl_load_frontend_scripts() {
		
		wp_register_script( 'uxb-tmnl-easing', UXB_TMNL_URL . 'js/jquery.easing.1.3.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxb-tmnl-touchswipe', UXB_TMNL_URL . 'js/jquery.touchSwipe.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxb-tmnl-caroufredsel', UXB_TMNL_URL . 'js/jquery.carouFredSel-6.2.1.js', array( 'jquery', 'uxb-tmnl-easing', 'uxb-tmnl-touchswipe' ), null, true );
		wp_register_script( 'uxb-tmnl-frontend', UXB_TMNL_URL . 'js/plugin-frontend.js', array( 'jquery' ), null, true );
		
	}
	
}



if ( ! function_exists( 'uxb_tmnl_load_on_demand_assets' ) ) {
		
	function uxb_tmnl_load_on_demand_assets() {
		
		global $post;
		
		if ( isset( $post ) && uxb_tmnl_has_shortcode( 'uxb_testimonials', $post->post_content ) ) {
			
			wp_enqueue_style( 'uxb-tmnl-frontend' );
			wp_enqueue_style( 'uxb-tmnl-responsive' );
			wp_enqueue_script( 'uxb-tmnl-caroufredsel' );
			wp_enqueue_script( 'uxb-tmnl-frontend' );
			
		}
		
	}
	
}