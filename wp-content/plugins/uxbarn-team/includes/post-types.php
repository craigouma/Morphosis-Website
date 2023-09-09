<?php

if ( ! function_exists( 'uxb_team_register_cpt' ) ) {

	function uxb_team_register_cpt() {
		
		$args = array(
            'label' 			=> __( 'Team', 'uxb_team' ),
            'labels' 			=> array(
				                        'singular_name'		=> __( 'Team Member', 'uxb_team' ),
				                        'add_new' 			=> __( 'Add New Member', 'uxb_team' ),
				                        'add_new_item' 		=> __( 'Add New Member', 'uxb_team' ),
				                        'new_item' 			=> __( 'New Member', 'uxb_team' ),
				                        'edit_item' 		=> __( 'Edit Member', 'uxb_team' ),
				                        'all_items' 		=> __( 'All Members', 'uxb_team' ),
				                        'view_item' 		=> __( 'View', 'uxb_team' ),
				                        'search_items' 		=> __( 'Search Member', 'uxb_team' ),
				                        'not_found' 		=> __( 'Nothing found', 'uxb_team' ),
				                        'not_found_in_trash' => __( 'Nothing found in Trash', 'uxb_team' ),
			                        ),
            'menu_icon' 		=> UXB_TEAM_URL . 'images/uxbarn_sm2.jpg',
            'description' 		=> __( 'Team', 'uxb_team' ),
            'public' 			=> true,
            'show_ui' 			=> true,
            'capability_type' 	=> 'post',
            'hierarchical' 		=> false,
            'has_archive' 		=> false,
            'supports' 			=> array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'rewrite' 			=> array( 'slug' => __( 'team', 'uxb_team' ), 'with_front' => false ) );
        
        register_post_type( 'uxbarn_team', $args );
        
        add_filter('manage_uxbarn_team_posts_columns', 'uxb_team_create_team_columns_header');  
        add_action('manage_uxbarn_team_posts_custom_column', 'uxb_team_create_team_columns_content');  
		
	}
	
}



if ( ! function_exists( 'uxb_team_create_team_columns_header' ) ) {
	
    function uxb_team_create_team_columns_header( $defaults ) {
    	
        $custom_columns = array(
            'cb' 			=> '<input type=\"checkbox\" />',
            'title' 		=> __( 'Title', 'uxb_team' ),
            'cover_image' 	=> __( 'Thumbnail', 'uxb_team' ),
            'position' 		=> __( 'Position', 'uxb_team' ),
        );

        $defaults= array_merge( $custom_columns, $defaults );
		
        return $defaults;
        
    }
    
}



if ( ! function_exists( 'uxb_team_create_team_columns_content' ) ) {
	
    function uxb_team_create_team_columns_content( $column ) {
    	
        global $post;
        
        switch ( $column ) {
            case 'cover_image':
            	the_post_thumbnail( 'thumbnail' );
                break;
            case 'position':
                echo uxb_team_get_array_value( get_post_meta( $post->ID, 'uxbarn_team_meta_info_position' ), 0 );
                break;
        }
		
    }
    
}