<?php

/***** UXbarn Testimonials *****/
if ( ! function_exists( 'uxbarn_testimonials_custom' ) ) {
	
	function uxbarn_testimonials_custom() {
		
		// Remove plugin's because most styles are in style.css of the theme
		remove_action( 'wp_enqueue_scripts', 'uxb_tmnl_load_on_demand_assets' );
		remove_action( 'init', 'uxb_tmnl_register_cpt', 11 );
		
		add_action( 'init', 'uxb_tmnl_register_cpt', 12 );
		
	}
	
}



if ( ! function_exists( 'uxbarn_custom_tmnl_register_widgets' ) ) {
		
	function uxbarn_custom_tmnl_register_widgets() {
		
		unregister_widget( 'UXTestimonialWidget' );
		
		// This custom widget removes some "wp_enqueue_style" and "wp_enqueue_script" since they are already in the theme
    	register_widget( 'UXTestimonialWidget_Custom' );
		
	}
	
}