<?php

if ( ! function_exists( 'uxbarn_load_css' ) ) {
	
	function uxbarn_load_css() {
	    
	    // Google fonts
	    if ( function_exists( 'ot_get_option' ) ) {
	    	
	    	$google_fonts = ot_get_option( 'uxbarn_to_setting_google_fonts_loader' );
			
		    if ( trim( $google_fonts ) == '' ) {
		        $google_fonts = UXB_DEFAULT_GOOGLE_FONTS; // Default ones
		    }
			
		} else {
			$google_fonts = UXB_DEFAULT_GOOGLE_FONTS;
		}
	    
	    $protocol = 'https';
		
		// Font list
	    $query_args = array( 'family' => $google_fonts );
		
		// Character sets
		if ( function_exists( 'ot_get_option' ) ) {
			$char_sets = ot_get_option( 'uxbarn_to_setting_google_fonts_character_sets', '' );
		} else {
			$char_sets = '';
		}
		
		if ( $char_sets != '' ) {
			
			$imp_char_sets = implode(',', $char_sets);
			if ( $imp_char_sets != 'latin' ) {
				
				$query_args = array(
									 'family' => $google_fonts,
									 'subset' => $imp_char_sets,
								);
							
			}
			
		}
		
	    // Prepare all styles
	    wp_register_style( 'uxbarn-google-fonts', add_query_arg($query_args, $protocol . '://fonts.googleapis.com/css' ), array(), null );
	    
	    wp_register_style( 'uxbarn-reset', get_template_directory_uri() . '/css/reset.css', array(), null );
	    wp_register_style( 'uxbarn-foundation', get_template_directory_uri() . '/css/foundation.css', array(), null );
		wp_register_style( 'uxbarn-isotope', get_template_directory_uri() . '/css/isotope.css', array(), null );
	    //wp_register_style( 'uxbarn-ionicons', get_template_directory_uri() . '/css/ionicons.min.css', array(), null );
	    wp_register_style( 'uxbarn-ionicons', 'http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css', array(), null );
		wp_register_style( 'uxbarn-fonticons', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), null );
		wp_register_style( 'uxbarn-flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), null );
	    wp_register_style( 'uxbarn-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), null );
		wp_register_style( 'uxbarn-fancybox-helpers-thumbs', get_template_directory_uri() . '/css/fancybox/helpers/jquery.fancybox-thumbs.css', array(), null );
	    wp_register_style( 'uxbarn-theme', get_stylesheet_directory_uri() . '/style.css', array( 'uxbarn-reset', 'uxbarn-foundation', 'uxbarn-flexslider' ), null );
		wp_register_style( 'uxbarn-theme-responsive', get_template_directory_uri() . '/css/kose-responsive.css', array( 'uxbarn-theme' ), null );
		wp_register_style( 'uxbarn-component', get_template_directory_uri() . '/css/component.css', array(), null );
		wp_register_style( 'uxbarn-dialog-sally', get_template_directory_uri() . '/css/dialog-sally.css', array(), null );
		
		
		
		
		// Initially load the prepared styles
	    wp_enqueue_style( 'uxbarn-google-fonts' );
	    wp_enqueue_style( 'uxbarn-reset' );
	    wp_enqueue_style( 'uxbarn-foundation' );
	    wp_enqueue_style( 'uxbarn-ionicons' );
		wp_enqueue_style( 'uxbarn-fonticons' );
		wp_enqueue_style( 'uxbarn-theme' );
	    wp_enqueue_style( 'uxbarn-theme-responsive' );
		wp_enqueue_style( 'uxbarn-component' );
		wp_enqueue_style( 'uxbarn-dialog-sally' );
		
	    //wp_enqueue_style( 'uxbarn-color-scheme' );
		
	}

}



if ( ! function_exists( 'uxbarn_load_js' ) ) {
	
	function uxbarn_load_js() {
	    
		// Prepare all scripts
	    wp_register_script( 'uxbarn-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), null );
	    wp_register_script( 'uxbarn-google-map', 'http://maps.google.com/maps/api/js?sensor=false&v=3.5', array(), null);
	    wp_register_script( 'uxbarn-foundation', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-hoverintent', get_template_directory_uri() . '/js/jquery.hoverIntent.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.6.pack.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array( 'jquery' ), null, true );
	    wp_register_script( 'uxbarn-fancybox-helpers-thumbs', get_template_directory_uri() . '/js/fancybox-helpers/jquery.fancybox-thumbs.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-transit', get_template_directory_uri() . '/js/jquery.transit.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-caroufredsel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1.js', array( 'jquery', 'uxbarn-easing', 'uxbarn-touchswipe', 'uxbarn-transit' ), null, true );
	    wp_register_script( 'uxbarn-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-blackandwhite', get_template_directory_uri() . '/js/jquery.BlackAndWhite.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-videojs', get_template_directory_uri() . '/js/video.js', array( 'jquery' ), null, true ); // enqueue in "header.php"
		wp_register_script( 'uxbarn-bigvideojs', get_template_directory_uri() . '/js/bigvideo.js', array( 'jquery', 'uxbarn-isotope', 'uxbarn-videojs' ), null, true ); // enqueue in "header.php"
	    wp_register_script( 'uxbarn-theme', get_template_directory_uri() . '/js/kose.js', array( 'jquery', 'uxbarn-isotope' ), null, true );
		//wp_register_script( 'uxbarn-cbpBGSlideshow', get_template_directory_uri() . '/js/cbpBGSlideshow.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-imagesloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ), null, true );
		wp_register_script( 'uxbarn-dialogFx', get_template_directory_uri() . '/js/dialogFx.js', array( 'jquery' ), null, true );
		
		// Initially load the prepared scripts
	    wp_enqueue_script( 'uxbarn-modernizr' );
		wp_enqueue_script( 'uxbarn-classie' );
		wp_enqueue_script( 'uxbarn-dialogFx' );
		
	    wp_enqueue_script( 'uxbarn-foundation' );
	    wp_enqueue_script( 'uxbarn-hoverintent' );
	    wp_enqueue_script( 'uxbarn-superfish' );
	    wp_enqueue_script( 'uxbarn-caroufredsel' );
	    wp_enqueue_script( 'uxbarn-isotope' );
	    wp_enqueue_script( 'uxbarn-nicescroll' );
		wp_enqueue_script( 'uxbarn-imagesloaded' );
		//wp_enqueue_script( 'uxbarn-cbpBGSlideshow' );
	    
		// Prepare any values from Theme Options to be used in the front-end JS
		if ( function_exists( 'ot_get_option' ) ) {
	    	$enable_lightbox_wp_gallery = ot_get_option( 'uxbarn_to_setting_enable_lightbox_wp_gallery' ) == 'off' ? false : true;
		} else {
			$enable_lightbox_wp_gallery = true;
		}
	    
		$content_scrollbar_color = '#fcda1c';
		$option_set = get_option( 'uxbarn_sc_content_scrollbar_styles' );
		if ( $option_set ) {
			
			$use_custom_color = false;
            $use_custom_color = isset( $option_set['use_custom_color'] ) ? $option_set['use_custom_color'] : $use_custom_color;
            
            if ( $use_custom_color ) { // if user wants to use custom color for scrollbar
				$content_scrollbar_color = get_option( 'uxbarn_sc_content_scrollbar_color', '#fcda1c' );
            }
			
		}
	    
	    $params = array(
		            'enable_lightbox_wp_gallery' => $enable_lightbox_wp_gallery,
		            'swipe_text' => __( 'Swipe down for more', 'uxbarn' ),
		            'content_scrollbar_color' => $content_scrollbar_color,
		        );
			
	    wp_localize_script( 'uxbarn-theme', 'ThemeOptions', $params );
	
	}

}



if ( ! function_exists( 'uxbarn_load_on_demand_assets' ) ) {
	
	function uxbarn_load_on_demand_assets() {
		
		// For home slider
	    /*if ( is_front_page() || uxbarn_is_frontpage_child() ) {
	    	
	    	wp_enqueue_style( 'uxbarn-flexslider' );
	        wp_enqueue_script( 'uxbarn-flexslider' );
			
	    }*/
		
		
		// For content section
		if ( is_page() || is_single() ) {
			
			global $post;
			
			if ( uxbarn_has_shortcode( 'vc_single_image', $post->post_content ) ) {
				
	            wp_enqueue_script( 'uxbarn-mousewheel' );
				wp_enqueue_style( 'uxbarn-fancybox' );
				wp_enqueue_script( 'uxbarn-fancybox' );
				wp_enqueue_style( 'uxbarn-fancybox-helpers-thumbs' );
				wp_enqueue_script( 'uxbarn-fancybox-helpers-thumbs' );
				
			}
			
			if ( uxbarn_has_shortcode( 'gallery', $post->post_content ) ) { // WP gallery
			
	            wp_enqueue_script( 'uxbarn-mousewheel' );
				wp_enqueue_style( 'uxbarn-fancybox' );
				wp_enqueue_script( 'uxbarn-fancybox' );
				wp_enqueue_style( 'uxbarn-fancybox-helpers-thumbs' );
				wp_enqueue_script( 'uxbarn-fancybox-helpers-thumbs' );
				
			}
			
			if ( uxbarn_has_shortcode( 'vc_gallery', $post->post_content ) ) {
				
				wp_enqueue_script( 'uxbarn-isotope' );
	            wp_enqueue_script( 'uxbarn-mousewheel' );
				wp_enqueue_style( 'uxbarn-fancybox' );
				wp_enqueue_script( 'uxbarn-fancybox' );
				wp_enqueue_style( 'uxbarn-fancybox-helpers-thumbs' );
				wp_enqueue_script( 'uxbarn-fancybox-helpers-thumbs' );
				wp_enqueue_script( 'uxbarn-flexslider' );
				wp_enqueue_style( 'uxbarn-flexslider' );
				
			}
			
			if ( uxbarn_has_shortcode( 'vc_gmaps', $post->post_content ) ) {
				wp_enqueue_script('uxbarn-google-map');
			}
			
			if ( uxbarn_has_shortcode( 'vc_accordion', $post->post_content ) ) {
				wp_enqueue_script( 'jquery-ui-accordion' );
			}
			
			if ( uxbarn_has_shortcode( 'vc_progress_bar', $post->post_content ) ) {
				wp_enqueue_script( 'waypoints' );
				wp_enqueue_script( 'uxbarn-easing' );
			}
			
			
			/***** UXbarn Portfolio *****/
			if ( uxbarn_has_shortcode( 'uxb_portfolio', $post->post_content ) ) {
				
				wp_enqueue_style( 'uxbarn-isotope' );
				wp_enqueue_style( 'uxbarn-flexslider' );
				wp_enqueue_script( 'uxbarn-flexslider' );
	    		wp_enqueue_script( 'uxbarn-blackandwhite' );
				
			}
			
		}

			
		// Disable plugin's to avoid conflict
		if ( is_singular( 'uxbarn_portfolio' ) || is_tax( 'uxbarn_portfolio_tax' ) ) {
			
			wp_dequeue_style( 'uxb-port-foundation' );
			wp_dequeue_script( 'uxb-port-foundation' );
			
			wp_enqueue_style( 'uxbarn-isotope' );
    		wp_enqueue_script( 'uxbarn-blackandwhite' );
			
		}
		
		if ( is_singular( 'uxbarn_team' ) ) {
			
			wp_dequeue_style( 'uxb-team-foundation' );
			wp_dequeue_script( 'uxb-team-foundation' );
			
		}

		// Finally load the theme JS
	    wp_enqueue_script( 'uxbarn-theme' );
		
	}

}



if ( ! function_exists( 'uxbarn_load_admin_assets' ) ) {
	
	function uxbarn_load_admin_assets( $page ) {
	    
		global $post;
		
	     // Edit screen
	    if ( $page == 'post.php' || 
	         $page == 'post-new.php' || 
	         $page == 'wpml-translation-management/menu/translations-queue.php' ) {
	            
	        wp_enqueue_style( 'uxbarn-admin', get_template_directory_uri() . '/css/admin.css', false );
	        
			if ( ( $page == 'post.php' || $page == 'post-new.php' ) && ( isset( $post ) && ( $post->post_type == 'page' ) ) ) {
				
				wp_enqueue_script( 'uxbarn-admin', get_template_directory_uri() . '/js/theme-admin.js', false, false, true );
				
				$params = array(
					'sidebar_text' 			  => __( '"Default Sidebar" is the sidebar that you have set in "Settings > Reading" on your admin panel.', 'uxbarn' ),
		        	'sidebar_appearance_text' => __( 'This is for page sidebar only. For blog sidebar, you can see the option in "Theme Options > Blog".', 'uxbarn' ),
		        );
				
		        wp_localize_script( 'uxbarn-admin', 'AdminSettings', $params );
				
			}
			
		}
		
		
		// Item list page in backend
		/*if ( $page == 'edit.php' && ( isset( $post ) && $post->post_type == 'uxbarn_homeslider' ) ) { 
			wp_enqueue_style( 'admin-edit-css', get_template_directory_uri() . '/css/admin-edit.css', false );
		}*/
		
		//echo $page;
		// Load some custom code in Theme Options
        if ( $page == 'toplevel_page_ot-theme-options' ) {
        	
			wp_enqueue_script( 'uxbarn-theme-options', get_template_directory_uri() . '/js/theme-options.js', false );
			wp_enqueue_style( 'uxbarn-theme-options', get_template_directory_uri() . '/css/theme-options.css', false );
			
			$theme = wp_get_theme( 'Kose' );
			
	        $params = array(
	        	'theme_version' => __( 'Theme Version ', 'uxbarn' ) . $theme->get( 'Version' ),
	            'welcome_text' 	=> __( 'Welcome to theme options page! In case you need the support, you can find me at', 'uxbarn' ),
	        );
			
	        wp_localize_script( 'uxbarn-theme-options', 'ThemeOptions', $params );
	    
        }
		
		
		// UXbarn plugins settings 
		if ( $page == 'settings_page_uxb_port_options' || $page == 'settings_page_uxb_team_options' ) {
			wp_enqueue_style( 'uxbarn-theme-options', get_template_directory_uri() . '/css/theme-options.css', false );
		}
        

		// For VC plugin settings
		if ( $page == 'settings_page_wpb_vc_settings' || $page == 'settings_page_vc_settings' ) { // settings_page_vc_settings since VC 4.2.2
			wp_enqueue_style( 'admin-vc-settings', get_template_directory_uri() . '/css/admin-vc-settings.css', false );
		}

	}

}
