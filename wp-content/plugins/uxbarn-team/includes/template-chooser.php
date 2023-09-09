<?php

if ( ! function_exists( 'uxb_team_template_chooser' ) ) {

	function uxb_team_template_chooser( $template ) {
		
		if ( ! is_404() && ! is_search() ) {
		
			// Get current post ID
			$post_id = get_the_ID();
			
			// For other post type that is not "uxbarn_team", simply return the default one
			if ( get_post_type( $post_id ) != 'uxbarn_team' ) {
				return $template;
			}
			
			// Otherwise, follow the conditions here to load the proper template
			if ( is_singular( 'uxbarn_team' ) ) {
				return uxb_team_get_template_hierarchy( 'single-team' );
			} else {
				return $template;
			}
		
		} else {
			return $template;
		}
		
	}

}



if ( ! function_exists( 'uxb_team_get_template_hierarchy' ) ) {
	
	function uxb_team_get_template_hierarchy( $template ) {
		
		// Get the template slug
		$template_slug = rtrim( $template, '.php' );
		$template = $template_slug . '.php';
		
		// Check if a custom template exists in the theme folder, if not, load the plugin template file
	    if ( $theme_file = locate_template( array( 'uxb_templates/' . $template ) ) ) {
	        $file = $theme_file;
	    } else {
	    	$file = UXB_TEAM_PATH . 'includes/templates/' . $template;
	    }
		
		return $file;
		
	}

}