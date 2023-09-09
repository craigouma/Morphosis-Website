<?php

// ---------------------------------------------- //
// Theme functions that are used in various parts
// ---------------------------------------------- //

// TGMPA to create a notification box for user to install the specified plugins
if ( ! function_exists( 'uxbarn_register_additional_plugins' ) ) {
	
	function uxbarn_register_additional_plugins() {
		
	    $plugins = array(
	        array(
	            'name' 		=> 'OptionTree',
	            'slug' 		=> 'option-tree',
	            'required' 	=> true,
	            'version' 	=> '',
	        ),
	    	array(
	            'name' 		=> 'Visual Composer',
	            'slug' 		=> 'js_composer',
	            'source' 	=> get_template_directory() . '/includes/plugin-packages/VisualComposer_4.3.2.zip',
	            'required' 	=> true,
	            'version' 	=> '4.3.2',
	        ),
	        
			array(
				'name' 		=> 'UXbarn Extension for Visual Composer',
				'slug' 		=> 'uxbarn-vc-extension',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnVCExtension_1.0.3.zip',
				'required' 	=> true,
				'version' 	=> '1.0.3',
			),
			array(
				'name' 		=> 'UXbarn Portfolio',
				'slug' 		=> 'uxbarn-portfolio',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnPortfolio_1.1.2.zip',
				'required' 	=> true,
				'version' 	=> '1.1.2',
			),
			array(
				'name' 		=> 'UXbarn Team',
				'slug' 		=> 'uxbarn-team',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnTeam_1.1.1.zip',
				'required' 	=> true,
				'version' 	=> '1.1.1',
			),
			array(
				'name' 		=> 'UXbarn Testimonials',
				'slug' 		=> 'uxbarn-testimonials',
				'source'	=> get_template_directory() . '/includes/plugin-packages/UXbarnTestimonials_1.0.2.zip',
				'required' 	=> true,
				'version' 	=> '1.0.2',
			),
			
	        array(
	            'name' 		=> 'Contact Form 7',
	            'slug' 		=> 'contact-form-7',
	            'required' 	=> false,
	            'version' 	=> '',
	        ),
	        array(
	        	'name' 		=> 'WP Retina 2x',
	            'slug' 		=> 'wp-retina-2x',
	            'required' 	=> false,
	            'version' 	=> '',
			),
	        array(
	            'name' 		=> 'Simple Page Sidebars',
	            'slug' 		=> 'simple-page-sidebars',
	            'required' 	=> true,
	            'version' 	=> '',
	        ),
	        
	    );
	
	    $config = array(
	        'parent_menu_slug'  => 'themes.php', // Default parent menu slug
	        'parent_url_slug'   => 'themes.php', // Default parent URL slug
	        'menu'              => 'install-required-plugins', // Menu slug
	    );
		
	    tgmpa( $plugins, $config );
		
	}

}



if ( ! function_exists( 'uxbarn_print_bullet_style' ) ) {
	
	function uxbarn_print_bullet_style() {
		
		if ( is_page() || is_single() ) {
				
			global $post;
			$bullet_color = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_fullscreen_slider_bullet_color' ), 0 );
			
			if ( $bullet_color != '' ) {
					
				echo 
				'<style type="text/css">
					#full-scrn-bullets a, #full-scrn-bullets a.selected:hover { border-color: ' . $bullet_color . '; } 
					#full-scrn-bullets a.selected { background: ' . $bullet_color . '; }
				</style>';
				
			}
			
		}
		
	}
	
}



if ( ! function_exists( 'uxbarn_render_nav_menu' ) ) {
	
	function uxbarn_render_nav_menu() {
		
		$args = array(
            'theme_location' 	=> 'main_menu',
            'container' 		=> false,
            'menu_class' 		=> 'sf-menu sf-vertical',
            'fallback_cb' 		=> false,
        );
        
        wp_nav_menu( $args );
		
	}
	
}

							


if ( ! function_exists( 'uxbarn_register_theme_image_sizes' ) ) {
	
	function uxbarn_register_theme_image_sizes() {
		
		add_image_size( 'theme-fullscreen-image', 2048, 1365, true );
	    add_image_size( 'theme-blog-thumbnail', 170, 170, true );
	    add_image_size( 'theme-blog-element', 400, 278, true );
	    add_image_size( 'theme-large-square', 400, 400, true );
	    add_image_size( 'theme-medium-square', 280, 280, true );
	    add_image_size( 'theme-small-square', 120, 120, true );
	    add_image_size( 'theme-tiny-square', 60, 60, true );
		
	}

}



if ( ! function_exists( 'uxbarn_create_meta_boxes' ) ) {
	
	function uxbarn_create_meta_boxes() {
		
		uxbarn_create_post_meta_boxes();
		uxbarn_create_page_meta_boxes();
		
	}
	
}



if ( ! function_exists( 'uxbarn_register_menus' ) ) {
	
	function uxbarn_register_menus() {
		
        // Default header menu
        register_nav_menus( array(
            	'main_menu' => __( 'Main Menu', 'uxbarn' ),
            )
        );
		
	}

}



if ( ! function_exists( 'uxbarn_register_sidebars' ) ) {
	
	function uxbarn_register_sidebars() {
	    
		// Blog's sidebar
		register_sidebar( array (
		        'name' 			=> __( 'Blog Sidebar', 'uxbarn' ),
		        'id' 			=> 'uxbarn-blog-sidebar',
		        'description' 	=> __( 'Blog and archive page widget area.', 'uxbarn' ),
		        'before_widget' => '<div id="%1$s" class="%2$s widget-item row"><div class="uxb-col large-12 columns"><div class="inner-widget-item">',
		        'after_widget'	=> '</div></div></div>',
		        'before_title' 	=> '<h4><span>',
		        'after_title'	=> '</span></h4>',
	        )
	    );
		
		// Search page's sidebar
		register_sidebar( array (
		        'name' 			=> __( 'Search Result Sidebar', 'uxbarn' ),
		        'id' 			=> 'uxbarn-search-result-sidebar',
		        'description' 	=> __( 'Search result widget area.', 'uxbarn' ),
		        'before_widget' => '<div id="%1$s" class="%2$s widget-item row"><div class="uxb-col large-12 columns"><div class="inner-widget-item">',
		        'after_widget' 	=> '</div></div></div>',
		        'before_title' 	=> '<h4>',
		        'after_title' 	=> '</h4>',
	        )
	    );
		
		// Default page's sidebar
		register_sidebar( array (
		        'name' 			=> __( 'Page Sidebar', 'uxbarn' ),
		        'id' 			=> 'uxbarn-page-sidebar',
		        'description' 	=> __( 'Default page widget area.', 'uxbarn' ),
		        'before_widget' => '<div id="%1$s" class="%2$s widget-item row"><div class="uxb-col large-12 columns"><div class="inner-widget-item">',
		        'after_widget' 	=> '</div></div></div>',
		        'before_title' 	=> '<h4><span>',
		        'after_title' 	=> '</span></h4>',
	        )
	    );
		
	}

}



if ( ! function_exists( 'uxbarn_rewrite_site_title' ) ) {
	
	function uxbarn_rewrite_site_title( $title, $sep, $seplocation ) {
		
	    global $page, $paged;
	    // Don't affect in feeds.
	    if ( is_feed() ) {
	        return $title;
		}
		
	    // Add the blog name
	    if ( $seplocation == 'right' ) {
	        $title .= get_bloginfo( 'name' );
	    } else {
	        $title = get_bloginfo( 'name' ) . $title;
		}
		
		// Only for WooCommerce shop page when using as front page. This will remove "Products" out
		if ( class_exists( 'Woocommerce' ) && is_front_page() ) {
			$title = get_bloginfo( 'name' );
		}
		
	    // Add the blog description for the home/front page.
	    $site_description = get_bloginfo( 'description', 'display' );
		
	    if ( $site_description && is_front_page() ) {
	        $title .= " {$sep} {$site_description}";
		}
		
	    // Add a page number if necessary:
	    if ( $paged >= 2 || $page >= 2 ) {
	        $title .= " - " . sprintf( __( 'Page %s', 'uxbarn' ), max( $paged, $page ) );
		}
		
	    return $title;
		
	}
	
}



if ( ! function_exists( 'uxbarn_merge_image_sizes' ) ) {
	
	function uxbarn_merge_image_sizes( $sizes ) {
		  
	    $size_array = array();
	    
	    foreach ( get_intermediate_image_sizes() as $s ) {
	        
	        global $_wp_additional_image_sizes;
	        
	        if ( isset( $_wp_additional_image_sizes[$s] ) ) {
	        	
	            $width = intval( $_wp_additional_image_sizes[ $s ]['width'] );
	            $height = intval( $_wp_additional_image_sizes[ $s ]['height'] );
				
	        } else {
	        	
	            $width = get_option( $s.'_size_w' );
	            $height = get_option( $s.'_size_h' );
				
	        }
	        
	        $clean_name = ucwords( str_replace( 'cropped', '', str_replace( '-', ' ', $s ) ) );
	        
	        $size_array[ $s ] = $clean_name;
	        
	    } 
		
	    return array_merge( $sizes, $size_array ); 
		 
	}
	
}



if ( ! function_exists( 'uxbarn_update_user_profile_fields' ) ) {
	
	function uxbarn_update_user_profile_fields( $field ) {
	
	    $field['twitter'] 	= __( 'Twitter URL', 'uxbarn' );
	    $field['facebook'] 	= __( 'Facebook URL', 'uxbarn' );
	    $field['google'] 	= __( 'Google+ URL', 'uxbarn' );
	    $field['linkedin'] 	= __( 'LinkedIn URL', 'uxbarn' );
	    $field['dribbble'] 	= __( 'Dribbble URL', 'uxbarn' );
	    $field['forrst'] 	= __( 'Forrst URL', 'uxbarn' );
	    $field['flickr'] 	= __( 'Flickr URL', 'uxbarn' );
	     
	    return $field;
		
	}

}



if ( ! function_exists( 'uxbarn_the_excerpt_max_charlength' ) ) {
	
	function uxbarn_the_excerpt_max_charlength( $excerpt, $charlength ) {
		
	    $charlength++;
	
	    if ( mb_strlen( $excerpt ) > $charlength ) {
	    	
	        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
	        $exwords = explode( ' ', $subex );
	        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			
	        if ( $excut < 0 ) {
	            $excerpt = mb_substr( $subex, 0, $excut );
	        } else {
	            $excerpt = $subex;
	        }
			
	        return $excerpt . ' ... ';
			
	    } else {
	        return $excerpt;
	    }
		
	}
	
}



// Use in "vc_teaser_grid"
if ( ! function_exists( 'uxbarn_trim_string' ) ) {
	
	function uxbarn_trim_string( $string, $charlength ) {
	    return uxbarn_the_excerpt_max_charlength( $string, $charlength );
	}
	
}




if ( ! function_exists( 'uxbarn_custom_excerpt_length' ) ) {
	
	function uxbarn_custom_excerpt_length( $length ) {
	    return 30;
	}
	
}



if ( ! function_exists( 'uxbarn_new_excerpt_more' ) ) {
	
	function uxbarn_new_excerpt_more( $more ) {
	    return ' ... ';
	}
	
}



// For social icons in "footer.php"
if ( ! function_exists( 'uxbarn_get_footer_social_list_string' ) ) {
	
	function uxbarn_get_footer_social_list_string() {
		
		if ( function_exists( 'ot_get_option' ) ) {
			
			$social_set = ot_get_option( 'uxbarn_to_setting_social_set', '' );
			
			// Default set
			if ( $social_set == '' || $social_set == 'default' ) {
				
			    $social_name_array = array(
			        __( 'Facebook', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_facebook', 
			        __( 'Twitter', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_twitter', 
			        __( 'Google+', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_google_plus',  
			        __( 'LinkedIn', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_linkedin', 
			        __( 'Flickr', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_flickr',
					__( 'Instagram', 'uxbarn' ) => 'uxbarn_to_setting_social_instagram',
			        __( 'Behance', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_behance',
			        __( 'Dribbble', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_dribbble', 
			        __( 'Forrst', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_forrst', 
			        __( 'Vimeo', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_vimeo', 
			        __( 'YouTube', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_youtube', 
			        __( 'Tumblr', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_tumblr', 
			        __( 'Github', 'uxbarn' ) 	=> 'uxbarn_to_setting_social_github', 
			        __( 'RSS', 'uxbarn' ) 		=> 'uxbarn_to_setting_social_rss', 
			    );
			    
			    $social_list_item_string = '';
				
			    foreach ( $social_name_array as $key => $value ) {
			        $social_list_item_string .= uxbarn_get_footer_social_list_item( $value, $key );
			    }
			    
			    return $social_list_item_string;
				
			} else { // Custom set
			
				$custom_set = ot_get_option( 'uxbarn_to_setting_social_custom_set', array() );
				
				if ( ! empty( $custom_set ) ) {
					
					$social_list_item_string = '';
					
					foreach ( $custom_set as $icon ) {
						
						$title = $icon['title'];
						$url = $icon['uxbarn_to_setting_social_custom_set_url'];
						$image_url = $icon['uxbarn_to_setting_social_custom_set_icon'];
						
						$icon_width = 25;/*Edited*/
						$icon_height = 25;/*Edited*/
						$icon_attachment = wp_get_attachment_image_src( uxbarn_get_attachment_id_from_src( $image_url ) );
						
						if ( $icon_attachment ) {
							
							$icon_width = $icon_attachment[1];
							$icon_height = $icon_attachment[2];
							
						}
						
						$social_list_item_string .= '<li><a href="' . $url . '" target="_blank"><img src="' . $image_url . '" alt="' . $title . '" title="' . $title . '" width="' . $icon_width . '" height="' . $icon_height . '" /></a></li>';
						
					}
					
					return $social_list_item_string;
					
				} else {
					return '';
				}
				
			}

		}
		
	}

}

// To be used by "get_footer_social_list_string()"
if ( ! function_exists( 'uxbarn_get_footer_social_list_item' ) ) {
	
	function uxbarn_get_footer_social_list_item( $option_id, $name ) {
	    
	    $link = trim( ot_get_option( $option_id ) );
	    $filename = strtolower( $name );
	    
		if ( $filename == 'google+' ) {
			$filename = 'google_plus';
		}
		
		// Default theme icon, width and height
		$icon_image_src = UXB_THEME_ROOT_IMAGE_URL . 'social/' . $filename . '.png';
		$icon_width = 25;/*Edited*/
		$icon_height = 25;/*Edited*/
		
		// If there is custom icon specified, use it instead
		$option_icon = ot_get_option( 'uxbarn_to_setting_social_' . $filename . '_upload' );
		
		if ( trim( $option_icon ) != '' ) {
			
			$icon_image_src = $option_icon;
			$icon_attachment = wp_get_attachment_image_src( uxbarn_get_attachment_id_from_src( $option_icon ) );
			
			if ( $icon_attachment ) {
				
				$icon_width = $icon_attachment[1];
				$icon_height = $icon_attachment[2];
				
			}
			
		}
	    
	    if ( $link ) {
	        return '<li><a href="' . $link . '" target="_blank"><img src="' . $icon_image_src . '" alt="' . $name . '" title="' . $name . '" width="' . $icon_width . '" height="' . $icon_height . '" /></a></li>';
	    } else {
	        return '';
	    }
		
	}

}



if ( ! function_exists( 'uxbarn_request_filter' ) ) {
	
	function uxbarn_request_filter( $query_vars ) {
		
	    if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
	        $query_vars['s'] = " ";
	    }
		
	    return $query_vars;
		
	}

}



if ( ! function_exists( 'uxbarn_get_attachment' ) ) {
	
	function uxbarn_get_attachment( $attachment_id ) {
	    
	    $attachment = get_post( $attachment_id );
	    
	    // Need to check it first
	    if ( isset( $attachment ) ) {
	            
	       	return array(
	            'alt' 			=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
	            'caption' 		=> $attachment->post_excerpt,
	            'description' 	=> $attachment->post_content,
	            'href' 			=> get_permalink( $attachment->ID ),
	            'src' 			=> $attachment->guid,
	            'title' 		=> $attachment->post_title,
	        );
	    
	    } else {
	    	
	        return array(
	            'alt' 			=> 'N/A',
	            'caption' 		=> 'N/A',
	            'description' 	=> 'N/A',
	            'href' 			=> 'N/A',
	            'src' 			=> 'N/A',
	            'title' 		=> 'N/A',
	        );
			
	    }
	}
	
}



if ( ! function_exists( 'uxbarn_get_attachment_id_from_src' ) ) {
	
	function uxbarn_get_attachment_id_from_src( $image_src ) {
		
	    global $wpdb;
	    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	    $id = $wpdb->get_var( $query );
	    return $id;
		
	}

}



// For checking whether there is specified shortcode incluced in the current post
if ( ! function_exists( 'uxbarn_has_shortcode' ) ) {
		
	function uxbarn_has_shortcode( $shortcode = '', $content ) {
	    
	    // false because we have to search through the post content first
	    $found = false;
	    
	    // if no short code was provided, return false
	    if ( ! $shortcode ) {
	        return $found;
	    }
	    // check the post content for the short code
	    if ( stripos( $content, '[' . $shortcode ) !== false ) {
	        // we have found the short code
	        $found = true;
	    }
	    
	    // return our final results
	    return $found;
	}

}



// Helper function for retrieving the content plus the fix to any invalid HTML tags (that might caused by WP auto p tag). Need to use within the loop.
if ( ! function_exists( 'uxbarn_get_final_post_content' ) ) {
	
	function uxbarn_get_final_post_content() {
	    
	    $content = get_the_content();
	    
	    // Need to use filter for applying the format back when using "get_the_content()" above
	    $content = apply_filters( 'the_content', $content );
	    $content = str_replace( ']]>', ']]&gt;', $content );
		
		return uxbarn_get_html_validated_content( $content ); //uxbarn_DOMinnerHTML($dom->getElementById('dummy-wrapper'));
		
	}

}



// Whether the current page is a child of the page that is specified as WP "front page"
if ( ! function_exists( 'uxbarn_is_frontpage_child' ) ) {
	
	function uxbarn_is_frontpage_child() {
		
		$is_frontpage_child = false;
		
		if ( get_option( 'show_on_front' ) == 'page' ) {
			
			global $post;
			
			if ( $post ) {
				
				if ( $post->post_parent == get_option( 'page_on_front' ) ) {
					$is_frontpage_child = true;
				}
				
			}
		
		}
		
		return $is_frontpage_child;
		
	}
	
}



// For getting array value when using with OptionTree meta box
if ( ! function_exists( 'uxbarn_get_array_value' ) ) {
	
	function uxbarn_get_array_value( $array, $index ) {
	    return isset( $array[ $index ] ) ? $array[ $index ] : '';
	}
	
}



// Used in "uxbarn_customize_vc_rows_columns()" [plugin-custom-functions.php]
if ( ! function_exists( 'uxbarn_replace_string_with_assoc_array' ) ) {
	
	function uxbarn_replace_string_with_assoc_array( array $replace, $subject ) { 
	   return str_replace( array_keys( $replace ), array_values( $replace ), $subject );    
	}
	
}



if ( ! function_exists( 'uxbarn_get_comment_count_text' ) ) {
		
	function uxbarn_get_comment_count_text( $num_comments ) {
		
	    if ( $num_comments == 0 ) {
	        return __( '0 Comment', 'uxbarn' );
	    } elseif ( $num_comments > 1 ) {
	        return $num_comments . __( ' Comments', 'uxbarn' );
	    } else {
	        return __( '1 Comment', 'uxbarn' );
	    }
	    
	}
	
}



if ( ! function_exists( 'uxbarn_hex2rgb' ) ) {
	
	function uxbarn_hex2rgb( $hex ) {
		
	   $hex = str_replace( "#", "", $hex );
	 
	   if ( strlen( $hex ) == 3 ) {
	   	
	      $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
	      $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
	      $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
		  
	   } else {
	   	
	      $r = hexdec( substr( $hex, 0, 2 ) );
	      $g = hexdec( substr( $hex, 2, 2 ) );
	      $b = hexdec( substr( $hex, 4, 2 ) );
		  
	   }
	   
	   $rgb = array( $r, $g, $b );
	   
	   return $rgb; // returns an array with the rgb values
	   
	}
	
}



if ( ! function_exists( 'uxbarn_sanitize_numeric_input' ) ) {
		
	function uxbarn_sanitize_numeric_input( $input, $default ) {
	    
	    if( trim( $input ) != '' ) {
	        
	        if ( is_numeric( $input ) ) {
	            return $input;
	        } else {
	            return $default;
	        }
	        
	    } else {
	        return $default;
	    }
	    
	}
	
}



if ( ! function_exists( 'uxbarn_is_old_android' ) ) {
	
	function uxbarn_is_old_android( $version = '4.0.0' ){
	 
		if ( strstr( $_SERVER['HTTP_USER_AGENT'], 'Android' ) ){
			
			preg_match( '/Android (\d+(?:\.\d+)+)[;)]/', $_SERVER['HTTP_USER_AGENT'], $matches );
	 
			return version_compare( $matches[1], $version, '<=' );
	 
		}
	 
	}
}




if ( ! function_exists( 'uxbarn_register_widgets' ) ) {
	
    function uxbarn_register_widgets() {
    	
    	register_widget( 'UXRecentPostsWidget' );
        register_widget( 'UXContactInfoWidget' );
    	register_widget( 'UXFlickrWidget' );
        register_widget( 'UXVideoWidget' );
    	register_widget( 'UXBannerWidget' );
    	register_widget( 'UXGoogleMapWidget' );
		
    }
    
}



if ( ! function_exists( 'uxbarn_add_oembed_wmode' ) ) {
		
	function uxbarn_add_oembed_wmode( $html, $url ){
		
	    if ( 'www.youtube.com' !== parse_url( $url, PHP_URL_HOST ) )
	        return $html;
	
	    return str_replace( '=oembed', '=oembed&amp;wmode=transparent', $html );
		
	}

}



// Clear oEmbed cache for all youtube embeds.
if ( ! function_exists( 'uxbarn_clear_oembed_cache' ) ) {
		
	function uxbarn_clear_oembed_cache() {
		
	    global $wpdb;
	
	    $posts = $wpdb->get_results(
	        "SELECT post_id, meta_key
	            FROM  `$wpdb->postmeta`
	            WHERE  `meta_key` LIKE  '_oembed%'
	                AND `meta_value` LIKE  '%youtube%'"
	    );
	
	    if ( ! $posts )
	        return;
	
	    /*
	    return print '<pre>$posts = ' . htmlspecialchars( print_r( $posts, TRUE ), ENT_QUOTES, 'utf-8', FALSE ) . "</pre>\n";
	    /*/
	    foreach ( $posts as $post )
	        delete_post_meta( $post->post_id, $post->meta_key );
	    /**/
	    
	}
	
}



// Function to validate and fix any HTML tag issue
if ( ! function_exists( 'uxbarn_get_html_validated_content' ) ) {
	
	function uxbarn_get_html_validated_content( $content ) {
		
		// Below is to fix any strange invalid HTML issues (missing opening or closing tags) 
		// which caused by shortcode + wpautop or from user error 
		$dom = new MyDOMDocument(); 
		$dom->validateOnParse = false;
		$dom->preserveWhiteSpace = false;
		
		// Suppress the warning messages of invalid HTML since they are properly fixed, no need to display
		libxml_use_internal_errors(true);
		
		// UTF-8 Fix
		$content = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" ); 
		$dom->loadHTML( '<div id="dummy-wrapper">' . $content . '</div>' );
		
		// Reset suppressing back to normal state 
		libxml_clear_errors();
		
		//echo var_dump($dom->getElementById('dummy-wrapper')) . '<br><br>';
		
		return uxbarn_DOMinnerHTML( $dom->getElementById( 'dummy-wrapper' ) );
		
	}
	
}

if ( ! function_exists( 'uxbarn_DOMinnerHTML' ) ) {
	
	function uxbarn_DOMinnerHTML( $node ) {
		
		$doc = new DOMDocument();
		if ( isset( $node->childNodes ) ) {
			
			foreach ( $node->childNodes as $child ) {
				$doc->appendChild( $doc->importNode( $child, true ) );
			}
			
			return $doc->saveHTML();
			
		} 
		
		return 'N/A';
		
	} 
	
}

// This extending class is for solving a problem when "getElementById()" returns NULL
class MyDOMDocument extends DOMDocument {

    function getElementById( $id ) {

        //thanks to: http://www.php.net/manual/en/domdocument.getelementbyid.php#96500
        $xpath = new DOMXPath( $this );
        return $xpath->query( "//*[@id='$id']" )->item(0);
        
    }

    function output() {

        // thanks to: http://www.php.net/manual/en/domdocument.savehtml.php#85165
        $output = preg_replace( '/^<!DOCTYPE.+?>/', '',
                	str_replace( array('<html>', '</html>', '<body>', '</body>'),
                        	array('', '', '', ''), $this->saveHTML()
						)
					);

        return trim( $output );

    }

}