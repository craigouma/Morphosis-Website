<?php

if ( ! function_exists( 'uxb_tmnl_create_meta_boxes' ) ) {
	
	function uxb_tmnl_create_meta_boxes() {
		
		uxb_tmnl_create_testimonial_text();
		
	}

}



if ( ! function_exists( 'uxb_tmnl_create_testimonial_text' ) ) {
    
    function uxb_tmnl_create_testimonial_text() {
    	
        $args = array(
            'id'          => 'uxbarn_testimonial_text_meta_box',
            'title'       => __( 'Testimonial Text Setting', 'uxb_tmnl' ),
            'desc'        => '',
            'pages'       => array( 'uxbarn_testimonials' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_testimonial_text',
                    'label'       => __( 'Testimonial Text', 'uxb_tmnl' ),
                    'desc'        => __( 'Enter your testimonial text here. Note that the post title will be used as cite and Featured Image is for thumbnail.', 'uxb_tmnl' ),
                    'std'         => '',
                    'type'        => 'textarea-simple',
                    'section'     => 'uxbarn_sec_testimonial',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
            )
        );
        
        ot_register_meta_box( $args );
		
    }

}
