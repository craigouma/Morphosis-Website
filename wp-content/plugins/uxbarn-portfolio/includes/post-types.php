<?php

if ( ! function_exists( 'uxb_port_register_cpt' ) ) {

	function uxb_port_register_cpt() {
	
		$args = array(
		            'label' 			=> __( 'Portfolio', 'uxb_port' ),
		            'labels' 			=> array(
						                        'singular_name'		=> __( 'Portfolio', 'uxb_port' ),
						                     	'add_new' 			=> __( 'Add New Portfolio Item', 'uxb_port' ),
						                        'add_new_item' 		=> __( 'Add New Portfolio Item', 'uxb_port' ),
						                        'new_item' 			=> __( 'New Portfolio Item', 'uxb_port' ),
						                        'edit_item' 		=> __( 'Edit Portfolio Item', 'uxb_port' ),
						                        'all_items' 		=> __( 'All Portfolio Items', 'uxb_port' ),
						                        'view_item' 		=> __( 'View Portfolio', 'uxb_port' ),
						                        'search_items' 		=> __( 'Search Portfolio', 'uxb_port' ),
						                        'not_found' 		=> __( 'Nothing found', 'uxb_port' ),
						                        'not_found_in_trash' => __( 'Nothing found in Trash', 'uxb_port' ),
			                        		),
		            'menu_icon' 		=> UXB_PORT_URL . 'images/uxbarn_sm2.jpg',
		            'description' 		=> __( 'Portfolio of your business', 'uxb_port' ),
		            'public' 			=> true,
		            'show_ui' 			=> true,
		            'capability_type' 	=> 'post',
		            'hierarchical' 		=> false,
		            'has_archive' 		=> false,
		            'supports' 			=> array( 'title', 'editor', 'thumbnail', 'revisions', 'comments' ),
		            'rewrite' 			=> array( 'slug' => __( 'portfolio', 'uxb_port' ), 'with_front' => false )
	        	);
		
		// Register post type
		register_post_type( 'uxbarn_portfolio', $args );
		
		
		
		$labels = array(
			'singular_name' => __( 'Portfolio Category', 'uxb_port' ),
            'search_items' 	=> __( 'Search Categories', 'uxb_port' ),
            'all_items' 	=> __( 'All Categories', 'uxb_port' ),
            'edit_item' 	=> __( 'Edit Category', 'uxb_port' ), 
            'update_item' 	=> __( 'Update Category', 'uxb_port' ),
            'add_new_item' 	=> __( 'Add New Category', 'uxb_port' ),
        );
		
		// Register taxonomy
		register_taxonomy( 'uxbarn_portfolio_tax', array( 'uxbarn_portfolio' ),
            array(
                'hierarchical' 		=> true, 
                'labels' 			=> $labels,
                'label' 			=> __( 'Portfolio Categories', 'uxb_port' ), 
                'singular_label' 	=> __( 'Portfolio Category', 'uxb_port' ),
                'rewrite' 			=> array( 'slug' => __( 'portfolio-category', 'uxb_port' ) ),
            )
        );
        
		// Custom columns
        add_filter( 'manage_uxbarn_portfolio_posts_columns', 'uxb_port_create_columns_header' );  
        add_action( 'manage_uxbarn_portfolio_posts_custom_column', 'uxb_port_create_columns_content' );  
		
	}

}



if ( ! function_exists( 'uxb_port_create_columns_header' ) ) {
	
    function uxb_port_create_columns_header( $defaults ) {
    	
        $custom_columns = array(
            'cb' 			=> '<input type=\"checkbox\" />',
            'title' 		=> __( 'Title', 'uxb_port' ),
            'cover_image' 	=> __( 'Thumbnail', 'uxb_port' ),
            'item_format' 	=> __( 'Item Format', 'uxb_port' ),
            'layout_mode' 	=> __( 'Layout Mode', 'uxb_port' ),
            'terms' 		=> __( 'Categories', 'uxb_port' )
        );

        $defaults= array_merge( $custom_columns, $defaults );
        return $defaults;
        
    }
    
}



if ( ! function_exists( 'uxb_port_create_columns_content') ) {
	
    function uxb_port_create_columns_content( $column ) {
    	
        global $post;
        switch ( $column )
        {
            case 'cover_image':
                the_post_thumbnail( 'thumbnail' );
                break;
            case 'item_format':
                echo ucwords( uxb_port_get_array_value(get_post_meta( $post->ID, 'uxbarn_portfolio_item_format' ), 0 ) );
                break;
            case 'layout_mode':
				
				if ( uxb_port_get_array_value(get_post_meta( $post->ID, 'uxbarn_portfolio_item_format' ), 0 ) == 'image-slideshow' ) {
                	echo ucwords( uxb_port_get_array_value(get_post_meta( $post->ID, 'uxbarn_portfolio_image_slideshow_layout' ), 0 ) );
                } else {
                	echo '-';
                }

                break;
            case 'terms':
                $terms = get_the_terms( $post->ID, 'uxbarn_portfolio_tax' );
				
                if ( ! empty( $terms ) ) {
                    $out = array();
                    foreach ( $terms as $term )
                        $out[] = '<a href="' . get_term_link( $term->slug, 'uxbarn_portfolio_tax' ) .'">' . $term->name . '</a>';
                        $return = join( ', ', $out );
                        echo $return;
                
                } else {
                    echo ' ';
                }
                break;
        }
		
    }
	
}