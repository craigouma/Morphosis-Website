<?php

/***** Visual Composer *****/
// Remove default VC elements
if ( ! function_exists( 'uxbarn_remove_default_vc_elements' ) ) {
	
    function uxbarn_remove_default_vc_elements() {
        
		wpb_remove( 'vc_row' ); // re-enable in mapping.php
        wpb_remove( 'vc_button' ); // re-enable in mapping.php
        wpb_remove( 'vc_twitter' );
        wpb_remove( 'vc_googleplus' );
        wpb_remove( 'vc_tweetmeme' );
        wpb_remove( 'vc_facebook' );
        wpb_remove( 'vc_pinterest' );
        wpb_remove( 'vc_single_image' ); // re-enable in mapping.php
        wpb_remove( 'vc_gallery' ); // re-enable in mapping.php
        wpb_remove( 'vc_tabs' ); // re-enable in mapping.php
        wpb_remove( 'vc_tour' ); // re-enable in mapping.php
        wpb_remove( 'vc_accordion' ); // re-enable in mapping.php
        wpb_remove( 'vc_toggle' );
        //wpb_remove( 'vc_separator' );
        wpb_remove( 'vc_progress_bar' ); // re-enable in mapping.php
        wpb_remove( 'vc_cta_button' ); // re-enable in mapping.php
		wpb_remove( 'vc_dialog_box' ); // re-enable in mapping.php
        wpb_remove( 'vc_message' ); // re-enable in mapping.php
        wpb_remove( 'vc_text_separator' );
        wpb_remove( 'vc_teaser_grid' ); // depreciated since VC 3.7.1. use vc_posts_grid instead
        wpb_remove( 'vc_posts_slider' );
        wpb_remove( 'vc_video' ); // re-enable in mapping.php
        wpb_remove( 'vc_gmaps' ); // re-enable in mapping.php
        wpb_remove( 'vc_raw_html' ); // re-enable in mapping.php
        wpb_remove( 'vc_raw_js' ); // re-enable in mapping.php
        wpb_remove( 'vc_flickr' ); // re-enable in mapping.php
        wpb_remove( 'vc_wp_search' ); // re-enable in mapping.php
        wpb_remove( 'vc_wp_meta' );
        wpb_remove( 'vc_wp_recentcomments' );
        wpb_remove( 'vc_wp_calendar' );
        wpb_remove( 'vc_wp_pages' );
        wpb_remove( 'vc_wp_tagcloud' );
        wpb_remove( 'vc_wp_custommenu' );
        wpb_remove( 'vc_wp_text' );
        wpb_remove( 'vc_wp_posts' );
        wpb_remove( 'vc_wp_links' );
        wpb_remove( 'vc_wp_categories' );
        wpb_remove( 'vc_wp_archives' );
        wpb_remove( 'vc_wp_rss' );
        wpb_remove( 'vc_widget_sidebar' );
        wpb_remove( 'contact-form-7' ); // re-enable in mapping.php
        wpb_remove( 'layerslider_vc' ); // re-enable in mapping.php
        wpb_remove( 'gravityform' ); // re-enable in mapping.php
		wpb_remove( 'vc_pie' ); // re-enable in mapping.php
		
		// From 3.7.1
		wpb_remove( 'vc_posts_grid' ); // re-enable in mapping.php
		wpb_remove( 'vc_carousel' );
		wpb_remove( 'vc_images_carousel' );
		
		// From 4.0.2
		//wpb_remove( 'vc_button2' );
		wpb_remove( 'vc_cta_button2' );
        
    }

}



// Register custom params and customize some interfaces of VC elements
if ( ! function_exists( 'uxbarn_init_vc_element_interfaces' ) ) {
		
	function uxbarn_init_vc_element_interfaces() {
		
		require_once( get_template_directory() . '/includes/plugin-codes/visual-composer/param-array.php' );
		require_once( get_template_directory() . '/includes/plugin-codes/visual-composer/mapping.php' );
		
		
		// Modify VC element orders (since theme v1.5.0)
		if ( function_exists( 'vc_map_update' ) ) {
			
			vc_map_update( 'vc_row', array( 'weight' => 500 ) );
			vc_map_update( 'vc_column_text', array( 'weight' => 495 ) );
			
			if ( shortcode_exists( 'uxb_heading' ) ) {
				// Set the weight directly in "custom-uxbarn-vc-extension.php"
				//vc_map_update( 'uxb_heading', array( 'weight' => 490 ) );
			}
			
			// New VC element since VC 4.3.2
			if ( shortcode_exists( 'vc_custom_heading' ) ) {
				vc_map_update( 'vc_custom_heading', array( 'weight' => 485 ) );
			}
			
			vc_map_update( 'vc_button', array( 'weight' => 480 ) );
			vc_map_update( 'vc_button2', array( 'weight' => 475 ) );
			
			if ( shortcode_exists( 'uxb_icon' ) ) {
				// Set the weight directly in "custom-uxbarn-vc-extension.php"
				//vc_map_update( 'uxb_icon', array( 'weight' => 470 ) );
			}
			vc_map_update( 'vc_dialog_box', array( 'weight' => 470 ) );
			vc_map_update( 'vc_single_image', array( 'weight' => 465 ) );
			vc_map_update( 'vc_video', array( 'weight' => 460 ) );
			
			if ( shortcode_exists( 'uxb_blockquote' ) ) {
				vc_map_update( 'uxb_blockquote', array( 'weight' => 455 ) );
			}
			
			vc_map_update( 'vc_message', array( 'weight' => 450 ) );
			vc_map_update( 'vc_gmaps', array( 'weight' => 445 ) );
			vc_map_update( 'vc_gallery', array( 'weight' => 440 ) );
			vc_map_update( 'vc_flickr', array( 'weight' => 435 ) );
			vc_map_update( 'vc_tabs', array( 'weight' => 430 ) );
			vc_map_update( 'vc_tour', array( 'weight' => 425 ) );
			vc_map_update( 'vc_accordion', array( 'weight' => 420 ) );
			
			if ( shortcode_exists( 'uxb_divider' ) ) {
				// Set the weight directly in "custom-uxbarn-vc-extension.php"
				//vc_map_update( 'uxb_divider', array( 'weight' => 415 ) );
			}
				
			vc_map_update( 'vc_separator', array( 'weight' => 410 ) );
			
			// New VC element since VC 4.3.2
			if ( shortcode_exists( 'vc_empty_space' ) ) {
				vc_map_update( 'vc_empty_space', array( 'weight' => 405 ) );
			}
				
			vc_map_update( 'vc_pie', array( 'weight' => 400 ) );
			vc_map_update( 'vc_progress_bar', array( 'weight' => 395 ) );
			vc_map_update( 'vc_cta_button', array( 'weight' => 390 ) );
			vc_map_update( 'vc_posts_grid', array( 'weight' => 370 ) );
			vc_map_update( 'vc_wp_search', array( 'weight' => 365 ) );
			
		}
		
	}
	
}



// Customize the VC rows and columns to use theme's Foundation framework
if ( ! function_exists( 'uxbarn_customize_custom_css_classes' ) ) {
	
    function uxbarn_customize_vc_rows_columns( $class_string, $tag ) {
            
        // vc_row 
        if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
        	
            $replace = array(
                'vc_row-fluid' 	=> 'row',
                'wpb_row' 		=> '',
            );
			
            $class_string = uxbarn_replace_string_with_assoc_array( $replace, $class_string );
			
        }
        
        // vc_column
        if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
        	
            $replace = array(
                'wpb_column' 		=> '',
                'column_container' 	=> '',
            );
			
            $to_be_replaced = array( '', '' );
            
            $class_string = uxbarn_replace_string_with_assoc_array(
                                $replace, preg_replace( '/vc_span(\d{1,2})/', 'uxb-col large-$1 columns', $class_string )
                            );
							
			// Custom columns	
			$class_string = uxbarn_replace_string_with_assoc_array(
                                $replace, preg_replace( '/vc_(\d{1,2})\\/12/', 'uxb-col large-$1 columns', $class_string )
                            );
							
			// VC 4.3.x (it changed the tags)
			$class_string = uxbarn_replace_string_with_assoc_array(
                                $replace, preg_replace('/vc_col-(xs|sm|md|lg)-(\d{1,2})/', 'uxb-col large-$2 columns', $class_string)
                            );
							
        }
        
        return $class_string;
		
    }

}



// Unused for now (use CSS in admin.css instead)
if ( ! function_exists( 'uxbarn_remove_vc_metabox' ) ) {
	
	function uxbarn_remove_vc_metabox() {
		
		remove_meta_box( 'vc_teaser', 'post', 'side' );
		remove_meta_box( 'vc_teaser', 'page', 'side' );
		
	}

}



if ( ! function_exists( 'uxbarn_load_custom_vc_js' ) ) {
	
    function uxbarn_load_custom_vc_js() {
        // ---------------------------------
        // wpb_composer_front_js (v4.3.2)
        // ---------------------------------
        // Main purposes are to: 
        // 1. Unload script of vc accordion to use our own
        // 2. Fix the conflict with Theme Customizer in "vc_tabsBehaviour()", so the function is commented out
        // 3. Adjust the options of WayPoint JS for the context area for Kose theme
        wp_deregister_script( 'wpb_composer_front_js' );
        wp_register_script( 'wpb_composer_front_js', get_template_directory_uri() . '/includes/plugin-codes/visual-composer/js/js_composer_front.js', array( 'jquery' ), WPB_VC_VERSION, true );
		
		
		// ---------------------------------
        // jquery.vc_chart.js (v4.2.2)
        // ---------------------------------
        // Main purposes is to: 
        // 1. Add options to waypoint code to use the context as "#inner-content-container" for animating the element
		wp_deregister_script( 'vc_pie' );
		wp_register_script( 'vc_pie', get_template_directory_uri() . '/includes/plugin-codes/visual-composer/js/jquery.vc_chart.js', array('jquery', 'waypoints', 'progressCircle'));
		
    }
	
}