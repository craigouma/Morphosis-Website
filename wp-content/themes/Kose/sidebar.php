<?php
    
    $sidebar = '';
    
    // If it's a blog-related pages
    if ( ( is_home() || is_archive() || is_single() ) && ! is_tax() ) {
        
        //if ( $sidebar != '' ) {
            $sidebar = 'uxbarn-blog-sidebar';
        //}
        
    } elseif ( is_search() ) {
        
        $sidebar = 'uxbarn-search-result-sidebar';
        
    } else { // For a normal page
        
        $sidebar = 'uxbarn-page-sidebar'; //uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_setting_select_custom_sidebar' ), 0 );
    	
    }
    
    dynamic_sidebar( $sidebar );