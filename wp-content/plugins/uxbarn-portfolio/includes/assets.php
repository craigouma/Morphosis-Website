<?php

if ( ! function_exists( 'uxb_port_load_admin_assets' ) ) {
		
	function uxb_port_load_admin_assets( $page ) {
		
		global $post;
		
		// Only load the assets if the current page falls under these PHP pages and belongs to "uxbarn_portfolio" post type
		if ( ( $page == 'post.php' || $page == 'post-new.php' ) && 
				( isset( $post ) && $post->post_type == 'uxbarn_portfolio' ) ) {
					
			wp_enqueue_script( 'uxb-port-backend-meta-boxes', UXB_PORT_URL . 'js/plugin-backend-meta-boxes.js', false, false, true );
		}
		
		
		// For new-post, edit-post or portfolio list pages, and belongs to "uxbarn_portfolio" post type
		if ( ( $page == 'post.php' || $page == 'post-new.php' ) || 
			 ( $page == 'edit.php' && ( isset( $post ) && $post->post_type == 'uxbarn_portfolio' ) ) ) {
					
			wp_enqueue_style( 'uxb-port-backend', UXB_PORT_URL . 'css/plugin-backend.css', array(), null );
		}
		
		
		// For plugin options page
		if ( $page == 'settings_page_uxb_port_options' ) {
			
			wp_enqueue_script( 'uxb-port-options', UXB_PORT_URL . 'js/plugin-options.js', false );
			wp_enqueue_style( 'uxb-port-options', UXB_PORT_URL . 'css/plugin-options.css', false );
			
	        $params = array(
	            'header_text' 	=> __( 'Please find below for some options that you can set for UXbarn Portfolio plugin.', 'uxb_port' ),
	        );
			
	        wp_localize_script( 'uxb-port-options', 'UXbarnPortOptions', $params );
			
		}
		
	}
	
}



if ( ! function_exists( 'uxb_port_load_frontend_styles' ) ) {
	
	function uxb_port_load_frontend_styles() {
		
		// Prepare all styles
	    wp_register_style( 'uxb-port-foundation', UXB_PORT_URL . 'css/foundation-lite.css', array(), null ); // only contains row, columns stuff
	    wp_register_style( 'uxb-port-isotope', UXB_PORT_URL . 'css/isotope.css', array(), null );
	    wp_register_style( 'uxbarn-fancybox', UXB_PORT_URL . 'css/jquery.fancybox.css', array(), null ); // named the handle as same as the theme's
		wp_register_style( 'uxbarn-fancybox-helpers-thumbs', UXB_PORT_URL . 'css/fancybox/helpers/jquery.fancybox-thumbs.css', array(), null ); // named the handle as same as the theme's
		wp_register_style( 'uxbarn-flexslider', UXB_PORT_URL . 'css/flexslider.css', array(), null ); // named the handle as same as the theme's
	    wp_register_style( 'uxbarn-font-awesome', UXB_PORT_URL . 'css/font-awesome.min.css', array(), null );
		wp_register_style( 'uxb-port-frontend', UXB_PORT_URL . 'css/plugin-frontend.css', array(), null );
		wp_register_style( 'uxb-port-responsive', UXB_PORT_URL . 'css/plugin-responsive.css', array( 'uxb-port-frontend' ), null );
		
	}

}



if ( ! function_exists( 'uxb_port_load_frontend_scripts' ) ) {
	
	function uxb_port_load_frontend_scripts() {
		
		// Prepare all scripts
	    wp_register_script( 'uxb-port-modernizr', UXB_PORT_URL . 'js/custom.modernizr.js', array( 'jquery' ), null );
	    wp_register_script( 'uxb-port-foundation', UXB_PORT_URL . 'js/foundation.min.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-isotope', UXB_PORT_URL . 'js/jquery.isotope.min.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxb-port-mousewheel', UXB_PORT_URL . 'js/jquery.mousewheel-3.0.6.pack.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-flexslider', UXB_PORT_URL . 'js/jquery.flexslider.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxbarn-fancybox', UXB_PORT_URL . 'js/jquery.fancybox.pack.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxbarn-fancybox-helpers-thumbs', UXB_PORT_URL . 'js/fancybox-helpers/jquery.fancybox-thumbs.js', array( 'jquery' ), null, true ); // named the handle as same as the theme's
	    wp_register_script( 'uxb-port-frontend', UXB_PORT_URL . 'js/plugin-frontend.js', array( 'jquery' ), null, true );
		
		
		// Prepare any values from the plugin options to be used in the front-end JS
		if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
			
			$plugin_options = get_option( 'uxb_port_plugin_options' );
			
			$portfolio_slider_transition = $plugin_options['uxb_port_po_single_page_slider_transition'];
			
			if ( $portfolio_slider_transition == '' ) {
				$portfolio_slider_transition = 'fade';
			}
			
		    $portfolio_slider_transition_speed = uxb_port_sanitize_numeric_input( $plugin_options['uxb_port_po_single_page_slider_transition_speed'], 600 );
		    $portfolio_slider_auto_rotation = $plugin_options['uxb_port_po_single_page_slider_auto_rotation'] == 'false' ? false : true;
		    $portfolio_slider_rotation_duration = uxb_port_sanitize_numeric_input( $plugin_options['uxb_port_po_single_page_slider_rotation_duration'], 5000 );
													
		} else {
			
			$portfolio_slider_transition = 'fade';
		    $portfolio_slider_transition_speed = 600;
		    $portfolio_slider_auto_rotation = false;
		    $portfolio_slider_rotation_duration = 5000;
			
		}
												
		$params = array(
	            'portfolio_slider_transition' 			=> $portfolio_slider_transition,
	            'portfolio_slider_transition_speed' 	=> $portfolio_slider_transition_speed,
	            'portfolio_slider_auto_rotation' 		=> $portfolio_slider_auto_rotation,
	            'portfolio_slider_rotation_duration' 	=> $portfolio_slider_rotation_duration,
	        );
			
	    wp_localize_script( 'uxb-port-frontend', 'UXbarnPortOptions', $params );
		
	}
	
}



if ( ! function_exists( 'uxb_port_load_on_demand_assets' ) ) {
	
	function uxb_port_load_on_demand_assets() {
		
		// Load the prepared styles depending on the current page and shortcode
		if ( is_page() || is_single() ) {
			
			global $post;
			
			if ( uxb_port_has_shortcode( 'uxb_portfolio', $post->post_content ) ) {
				
				wp_enqueue_style( 'uxb-port-isotope' );
				wp_enqueue_style( 'uxbarn-flexslider' );
				wp_enqueue_style( 'uxb-port-frontend' );
				wp_enqueue_style( 'uxb-port-responsive' );
				
				wp_enqueue_script( 'uxbarn-isotope' );
				wp_enqueue_script( 'uxbarn-flexslider' );
    			wp_enqueue_script( 'uxb-port-frontend' );
				
			}
			
		}
		
		
		if ( is_singular( 'uxbarn_portfolio' ) ) {
			
	    	wp_enqueue_style( 'uxb-port-foundation' );
			wp_enqueue_style( 'uxb-port-isotope' );
			wp_enqueue_style( 'uxbarn-fancybox' );
			wp_enqueue_style( 'uxbarn-fancybox-helpers-thumbs' );
			wp_enqueue_style( 'uxbarn-flexslider' );
			wp_enqueue_style( 'uxbarn-font-awesome' );
			wp_enqueue_style( 'uxb-port-frontend' );
			wp_enqueue_style( 'uxb-port-responsive' );
			
		    wp_enqueue_script( 'uxb-port-modernizr' );
		    wp_enqueue_script( 'uxb-port-foundation' );
		    wp_enqueue_script( 'uxbarn-isotope' );
		    wp_enqueue_script( 'uxb-port-mousewheel' );
		    wp_enqueue_script( 'uxbarn-flexslider' );
		    wp_enqueue_script( 'uxbarn-fancybox' );
		    wp_enqueue_script( 'uxbarn-fancybox-helpers-thumbs' );
			wp_enqueue_script( 'uxb-port-frontend' );
			
			// Conditional comment for IE8
		    global $wp_styles;
		    wp_enqueue_style( 'uxb-port-foundation-ie8', UXB_PORT_URL . 'css/foundation-ie8.css', array(), null);
		    $wp_styles->add_data( 'uxb-port-foundation-ie8', 'conditional', 'IE 8' );
			
		}
		
		if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
			
	    	wp_enqueue_style( 'uxb-port-foundation' );
			wp_enqueue_style( 'uxb-port-isotope' );
			wp_enqueue_style( 'uxb-port-frontend' );
			wp_enqueue_style( 'uxb-port-responsive' );
			
		    wp_enqueue_script( 'uxb-port-modernizr' );
		    wp_enqueue_script( 'uxb-port-foundation' );
		    wp_enqueue_script( 'uxbarn-isotope' );
			wp_enqueue_script( 'uxb-port-frontend' );
			
			
		}
		
	}
	
}
		