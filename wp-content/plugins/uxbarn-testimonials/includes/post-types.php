<?php

if ( ! function_exists( 'uxb_tmnl_register_cpt' ) ) {

	function uxb_tmnl_register_cpt() {
		
		$args = array(
            'label' 			=> __( 'Testimonials', 'uxb_tmnl' ),
            'labels' 			=> array(
				                        'singular_name'		 => __( 'Testimonial', 'uxb_tmnl' ),
				                        'add_new' 			 => __( 'Add New Testimonial', 'uxb_tmnl' ),
				                        'add_new_item' 		 => __( 'Add New Testimonial', 'uxb_tmnl' ),
				                        'new_item' 			 => __( 'New Testimonial', 'uxb_tmnl' ),
				                        'edit_item' 		 => __( 'Edit Testimonial', 'uxb_tmnl' ),
				                        'all_items' 		 => __( 'All Testimonials', 'uxb_tmnl' ),
				                        'view_item' 		 => __( 'View Testimonials', 'uxb_tmnl' ),
				                        'search_items' 		 => __( 'Search Testimonials', 'uxb_tmnl' ),
				                        'not_found' 		 => __( 'Nothing found', 'uxb_tmnl' ),
				                        'not_found_in_trash' => __( 'Nothing found in Trash', 'uxb_tmnl' ),
			                        ),
            'menu_icon' 		=> UXB_TMNL_URL . 'images/uxbarn_sm2.jpg',
            'description' 		=> __( 'Testimonials of your business', 'uxb_tmnl' ),
            'public' 			=> false,
            'show_ui' 			=> true,
            'capability_type' 	=> 'post',
            'hierarchical' 		=> false,
            'has_archive' 		=> false,
            'supports' 			=> array( 'title', 'thumbnail' ),
            'rewrite' 			=> false
            );
        
        register_post_type( 'uxbarn_testimonials', $args );
        
        add_filter( 'manage_uxbarn_testimonials_posts_columns', 'uxb_tmnl_create_testimonial_columns_header' );  
        add_action( 'manage_uxbarn_testimonials_posts_custom_column', 'uxb_tmnl_create_testimonial_columns_content' );  
		
	}
	
}



if ( ! function_exists( 'uxb_tmnl_create_testimonial_columns_header' ) ) {
	   
    function uxb_tmnl_create_testimonial_columns_header( $defaults ) {
    	
        $custom_columns = array(
            'cb' 			=> '<input type=\"checkbox\" />',
            'title' 		=> __( 'Title', 'uxb_tmnl' ),
            'text' 			=> __( 'Testimonial', 'uxb_tmnl' ),
            'cover_image' 	=> __( 'Thumbnail', 'uxb_tmnl' ),
        );

        $defaults = array_merge( $custom_columns, $defaults );
        
        return $defaults;
		
    }
	
}



if ( ! function_exists( 'uxb_tmnl_create_testimonial_columns_content' ) ) {
	
    function uxb_tmnl_create_testimonial_columns_content($column) {
    	
        global $post;
		
        switch ( $column ) {
        	
            case "text":
                echo uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_testimonial_text'), 0);
                break;
            case "cover_image":
                the_post_thumbnail('thumbnail');
                break;
                
        }
        
    }
	
}