<?php

add_action( 'wp_head', 'uxbarn_ctmzr_css_output' );
add_action( 'wp_head', 'uxbarn_ctmzr_custom_css_output' );

if ( ! function_exists( 'uxbarn_ctmzr_css_output' ) ) {

    function uxbarn_ctmzr_css_output() {
        
        // For resetting to default (delete all customized options)
        $is_reset = get_option( 'uxbarn_sc_reset_to_default' );
        if ( $is_reset && $is_reset == 'reset_styles' ) {
            
            delete_option( 'uxbarn_sc_global_styles' );
			
            delete_option( 'uxbarn_sc_panel_site_logo' );
            delete_option( 'uxbarn_sc_panel_styles' );
            delete_option( 'uxbarn_sc_panel_background_styles' );
            delete_option( 'uxbarn_sc_panel_styles_background_opacity' );
			
            delete_option( 'uxbarn_sc_menu_styles' );
            delete_option( 'uxbarn_sc_submenu_styles' );
			
            delete_option( 'uxbarn_sc_page_intro_styles' );
			
            delete_option( 'uxbarn_sc_content_body_styles' );
            delete_option( 'uxbarn_sc_content_background_styles' );
			delete_option( 'uxbarn_sc_content_background_styles_opacity' );
			delete_option( 'uxbarn_sc_content_scrollbar_styles' );
			delete_option( 'uxbarn_sc_content_scrollbar_color' );
			
            delete_option( 'uxbarn_sc_sidebar_body_styles' );
			
            delete_option( 'uxbarn_sc_other_styles_custom_css' );
            delete_option( 'uxbarn_sc_reset_to_default' );
            
        }
        
    ?>
        <style type="text/css">
        <?php 
        
        	// Global: Accent Color
        	// color
        	$option_set = get_option( 'uxbarn_sc_global_styles' );
			uxbarn_ctmzr_print_css( 'a, a:visited, #menu-wrapper > ul > li > a:hover, #menu-wrapper a.active,#menu-wrapper > ul > li.current-menu-item > a,#menu-wrapper > ul > li.current-menu-parent > a, #menu-wrapper > li:hover > a, #menu-wrapper > ul > li:hover > a, #menu-wrapper > ul li ul a:hover, .top-bar.expanded .title-area .menu-icon a, .top-bar-section a:hover, .top-bar-section .dropdown li.title h5 a:hover, #side-footer-wrapper a:hover, #hide-toggle-button:hover i, #content-container .uxb-team-name a:hover, #blog-list-wrapper .blog-title a:hover, #content-container .tags a:hover, #content-container .blog-element-title a:hover, #content-container blockquote cite,#content-container .uxb-tmnl-testimonial-item .uxb-tmnl-cite, #content-container #sidebar-wrapper .widget .uxb-tmnl-testimonial-item .uxb-tmnl-cite,#footer-content .uxb-tmnl-testimonial-item .uxb-tmnl-cite, #theme-body .button:hover, #content-container .ui-accordion .ui-accordion-header.ui-state-active a, span.uxb-dropcap, span.uxb-dropcap.default, #content-container #sidebar-wrapper .tagcloud a:hover,#root-container #footer-content .tagcloud a:hover', 
                    'color', $option_set, 'accent_color' );
			
			// color with !important
			uxbarn_ctmzr_print_css( '#blog-pagination span.current, #blog-pagination .current a, .section-container.tabs > section.active > .title a, .section-container.tabs > .section.active > .title a,.section-container.auto > section.active > .title a,.section-container.auto > .section.active > .title a, .section-container.vertical-tabs > section.active > .title a, .section-container.vertical-tabs > .section.active > .title a', 
                    'color', $option_set, 'accent_color', '', ' !important' );
			
			/* box-shadow
			uxbarn_ctmzr_print_css_box_shadow( '.top-bar.expanded .title-area .menu-icon a span',
                '-webkit-box-shadow', $option_set, 'accent_color', '0 10px 0 1px %s, 0 16px 0 1px %s, 0 22px 0 1px %s' );
				
			uxbarn_ctmzr_print_css_box_shadow( '.top-bar.expanded .title-area .menu-icon a span',
                'box-shadow', $option_set, 'accent_color', '0 10px 0 1px %s, 0 16px 0 1px %s, 0 22px 0 1px %s' );
			Edited */
					
			// background
			uxbarn_ctmzr_print_css( '#inner-content-container a.image-link,#inner-content-container a.link-image,#inner-content-container a.image-box, .flex-control-paging li a.flex-active, .slider-controller:hover, span.uxb-highlight, span.uxb-highlight.default, #hide-toggle-button', 
                'background', $option_set, 'accent_color' );
					
			// border-color
			uxbarn_ctmzr_print_css( '.has-line, #blog-pagination span.current, #blog-pagination .current a, #content-container .tags a:hover, #theme-body .button:hover, #content-container .ui-accordion-header.ui-state-active, #content-container #sidebar-wrapper .tagcloud a:hover,
#root-container #footer-content .tagcloud a:hover, #root-container .flickr_badge_image a:hover,#root-container #sidebar-wrapper .flickr_badge_image a:hover, input[type="text"]:focus,input[type="password"]:focus,input[type="date"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="month"]:focus,input[type="week"]:focus,input[type="email"]:focus,input[type="number"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="time"]:focus,input[type="url"]:focus,textarea:focus,.input-text:focus, input[type=text]:focus,textarea:focus,.input-text:focus', 
                'border-color', $option_set, 'accent_color' );
				
			uxbarn_ctmzr_print_css( '.cta-box.left-line', 
                'border-left-color', $option_set, 'accent_color' );
			
			uxbarn_ctmzr_print_css( '.cta-box.right-line', 
                'border-right-color', $option_set, 'accent_color' );
                
            uxbarn_ctmzr_print_css( '.cta-box.bottom-line', 
                'border-bottom-color', $option_set, 'accent_color' );
			
			uxbarn_ctmzr_print_css( '.cta-box.top-line', 
                'border-top-color', $option_set, 'accent_color' );	
						
					
			
            // Global: Fonts
            uxbarn_ctmzr_print_css( '#menu-wrapper, #full-scrn-slider .caption-title, #content-container h1,#content-container h2,#content-container h3,#content-container h4,#content-container h5,#content-container h6,#page-404 h1, #intro-title,#content-container #intro-title.blog-single, .uxb-port-element-item-hover-info, #blog-list-wrapper .blog-meta li, .commenter-name a', 
                'font-family', $option_set, 'primary_font' ); 
				
            uxbarn_ctmzr_print_css( 'body, #tagline, #inner-content-container .columns, #content-container .uxb-team-position, #blog-list-wrapper .blog-title, #sidebar-wrapper .widget-item h4', 
                'font-family', $option_set, 'secondary_font' );
        
            // Site Background
            uxbarn_ctmzr_print_css( 'body', 'background-color', $option_set, 'background_color' );
            uxbarn_ctmzr_print_css( '@media only screen and (max-width: 1160px) { body, #full-scrn-slider-container', 
            	'background-color', $option_set, 'background_color', '', '', false, 1, true );
			
			
			
            // Side Panel: Logo, Title and Tagline
            $option_set = get_option( 'uxbarn_sc_panel_styles' );
            uxbarn_ctmzr_print_css( '#logo-wrapper h1', 'color', $option_set, 'site_title_color' );
            uxbarn_ctmzr_print_css( '#tagline', 'color', $option_set, 'site_tagline_color' );
			
			// Side Panel: Background
			$option_set = get_option( 'uxbarn_sc_panel_background_styles' );
			$panel_color_opacity = get_option( 'uxbarn_sc_panel_styles_background_opacity' );
            uxbarn_ctmzr_print_css( '#side-container', 
                        'background-color', $option_set, 'background_color', '', '', true, 
                        $panel_color_opacity != false ? $panel_color_opacity : 1 );
            uxbarn_ctmzr_print_css( '#side-container', 'background-image', $option_set, 'background_image', 'url("', '")' );
            uxbarn_ctmzr_print_css( '#side-container', 'background-repeat', $option_set, 'background_repeat' );
            uxbarn_ctmzr_print_css( '#side-container', 'background-position', $option_set, 'background_position' );
			uxbarn_ctmzr_print_css( '@media only screen and (max-width: 1160px) { #side-footer-wrapper', 
            	'background-color', $option_set, 'background_color', '', '', true, 0.9, true );
				
			
			
			// Mobile menu background (not assign any values making it transparent to use the background of side panel)
			//uxbarn_ctmzr_print_css( '#mobile-menu', 'background', $option_set, 'background_color', '', '', 
			//	true, 0.2 );
            
			// Menu: Menu Options
			$option_set = get_option( 'uxbarn_sc_menu_styles' );
			// menu text color
			uxbarn_ctmzr_print_css( '#menu-wrapper > ul > li > a', 'color', $option_set, 'color' );
			// hovered menu & active menu
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_color'] ) ? $option_set['use_custom_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom color
                	
            		uxbarn_ctmzr_print_css( '#menu-wrapper > ul > li > a:hover, #menu-wrapper > ul > li:hover > a', 'color', $option_set, 'hover_color' );
					uxbarn_ctmzr_print_css( '#menu-wrapper a.active,#menu-wrapper > ul > li.current-menu-item > a,#menu-wrapper > ul > li.current-menu-parent > a', 'color', $option_set, 'active_color' );
				
                } else { // else, use color from global accent color
                	
                	$option_set = get_option( 'uxbarn_sc_global_styles' );
					
					if ( $option_set ) {
									
	                    uxbarn_ctmzr_print_css( '#menu-wrapper > ul > li > a:hover, #menu-wrapper > ul > li:hover > a', 'color', $option_set, 'accent_color' );
						uxbarn_ctmzr_print_css( '#menu-wrapper a.active,#menu-wrapper > ul > li.current-menu-item > a,#menu-wrapper > ul > li.current-menu-parent > a', 'color', $option_set, 'accent_color' );
						
					}
					
                }
				
            }

			// Menu: Submenu Options
			$option_set = get_option( 'uxbarn_sc_submenu_styles' );
			// submenu bg color
			uxbarn_ctmzr_print_css( '#menu-wrapper > ul li ul', 'background', $option_set, 'background_color' );
			// submenu text color
			uxbarn_ctmzr_print_css( '#menu-wrapper > ul li ul a', 'color', $option_set, 'color' );
			// hovered submenu
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_hovered_color'] ) ? $option_set['use_custom_hovered_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom color
            		uxbarn_ctmzr_print_css( '#menu-wrapper > ul li ul a:hover', 'color', $option_set, 'hover_color' );
                } else { // else, use color from global accent color
                	
                	$option_set = get_option( 'uxbarn_sc_global_styles' );
					
					if ( $option_set ) {
	                    uxbarn_ctmzr_print_css( '#menu-wrapper > ul li ul a:hover', 'color', $option_set, 'accent_color' );
					}
					
                }
				
            }
			
			$option_set = get_option( 'uxbarn_sc_submenu_styles' );
			// Mobile menu background (expanded)
			uxbarn_ctmzr_print_css( '.top-bar.expanded .title-area, .top-bar-section ul, .top-bar-section ul li > a, .top-bar-section .dropdown li.title h5 a', 
				'background', $option_set, 'background_color' );
            // Mobile menu text (expanded)
			uxbarn_ctmzr_print_css( '.top-bar-section ul li > a, .top-bar-section .dropdown li.title h5 a', 'color', $option_set, 'color' );
			// Mobile menu hovered text (expanded)
			uxbarn_ctmzr_print_css( '.top-bar-section a:hover,.top-bar-section .dropdown li.title h5 a:hover', 'color', $option_set, 'hover_color' );
			// Mobile menu arrow (expanded)
			uxbarn_ctmzr_print_css( '.top-bar-section .has-dropdown > a:after', 'border-color', $option_set, 'color', ' transparent transparent transparent ', '', true, 0.5 );
			
            
			
            // Page Intro: Colors
            $option_set = get_option( 'uxbarn_sc_page_intro_styles' ); 
            uxbarn_ctmzr_print_css( '#content-container #intro-title, #content-container #intro-title.blog-single', 'color', $option_set, 'title_color' );
            uxbarn_ctmzr_print_css( '#intro-body', 'color', $option_set, 'body_color' );
            
			
			
            // Content: Body colors
            $option_set = get_option( 'uxbarn_sc_content_body_styles' ); 
            uxbarn_ctmzr_print_css( '#content-container h1,#content-container h2,#content-container h3,#content-container h4,#content-container h5,#content-container h6,#page-404 h1', 'color', $option_set, 'heading_color' );
            
            uxbarn_ctmzr_print_css( '#inner-content-container .columns', 'color', $option_set, 'text_color' );
            
			// link color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_link_color'] ) ? $option_set['use_custom_link_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
					uxbarn_ctmzr_print_css( '#inner-content-container a', 'color', $option_set, 'link_color' );
                } else { // else, use color from global accent color
                	
                	$option_set = get_option( 'uxbarn_sc_global_styles' );
					
					// if global is custom, then print it out otherwise, use from predefined CSS (not printed this)
					if ( $option_set ) {
						uxbarn_ctmzr_print_css( '#inner-content-container a', 'color', $option_set, 'accent_color' );
					}
					
                }
				
            }
            
            
            // Content: Bg
            $option_set = get_option('uxbarn_sc_content_background_styles');
			
			$content_bg_color_opacity = get_option( 'uxbarn_sc_content_background_styles_opacity' );
            uxbarn_ctmzr_print_css( '#content-container', 
                        'background-color', $option_set, 'background_color', '', '', true, 
                        $content_bg_color_opacity != false ? $content_bg_color_opacity : 1 );
            uxbarn_ctmzr_print_css( '#content-container', 'background-image', $option_set, 'background_image', 'url("', '")' );
            uxbarn_ctmzr_print_css( '#content-container', 'background-repeat', $option_set, 'background_repeat' );
            uxbarn_ctmzr_print_css( '#content-container', 'background-position', $option_set, 'background_position' );
            uxbarn_ctmzr_print_css( '@media only screen and (max-width: 1160px) { #content-container', 
            	'background-color', $option_set, 'background_color', '', '', true, 0.9, true );
				
			// Content: Scrollbar (set in "assets.php" file of the theme)
			
			
			
			// Sidebar
			$option_set = get_option( 'uxbarn_sc_sidebar_body_styles' );
			// heading color
			uxbarn_ctmzr_print_css( '#sidebar-wrapper .widget-item h4', 'color', $option_set, 'heading_color' );
			// text color
			uxbarn_ctmzr_print_css( '#content-container #sidebar-wrapper .columns, #content-container #sidebar-wrapper p', 'color', $option_set, 'text_color' );
			// link color
			uxbarn_ctmzr_print_css( '#content-container #sidebar-wrapper a', 'color', $option_set, 'link_color' );
			// link color
			if ( $option_set ) {
				
                $use_custom_color = false;
                $use_custom_color = isset( $option_set['use_custom_link_color'] ) ? $option_set['use_custom_link_color'] : $use_custom_color;
                
                if ( $use_custom_color ) { // if user wants to use custom link colors
					uxbarn_ctmzr_print_css( '#content-container #sidebar-wrapper a', 'color', $option_set, 'link_color' );
                } else { // else, use color from global accent color
                	
                	$option_set = get_option( 'uxbarn_sc_global_styles' );
					
					if ( $option_set ) {
						uxbarn_ctmzr_print_css( '#content-container #sidebar-wrapper a', 'color', $option_set, 'accent_color' );
					}
					
                }
				
            }
			
			
			
            // Other Styles (set in "assets.php" file of the theme)
            
        ?>
        </style> 
    <?php
        
    }

}


if( ! function_exists('uxbarn_ctmzr_custom_css_output')) {
    
    function uxbarn_ctmzr_custom_css_output() {
        
        $option_set = get_option('uxbarn_sc_other_styles_custom_css');
        if($option_set) {
            echo '<style type="text/css">' . $option_set . '</style>';
        }
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_print_css')) {
	
    function uxbarn_ctmzr_print_css($selector, $property, $option_set, $option_name, $prefix='', $postfix='', $rgb=false, $opacity=1, $media_query=false, $echo=true) {
        
        $return = '';
        
        if( $option_set ) {
            
            $value = $option_set[$option_name];
            
            if ( !empty( $value ) ) {
                
                // Check whether there is Google Fonts code contained. If so, wrap the font with double quotes and fallback font.
                if(strpos($value,'[#GF#]') !== false) {
                    $value = str_replace('[#GF#]', '', $value);
					$value_temp = explode(':', $value); // split and remove any weights out
					$value = $value_temp[0];
                    $prefix = '"';
                    $postfix = '", sans-serif';
                }
                
                // For background-image; when there is no image assigned, just don't print it out
                if($property == 'background-image') {
                    if(empty($value)) {
                        $echo = false;
                    }
                }
                
                // For typography and background set; when the user haven't selected any item (-1), 
                // just don't print it out (use default style)
                if($property == 'font-family' ||
                    $property == 'font-size' ||
                    $property == 'font-style' ||
                    $property == 'font-weight' ||
                    $property == 'line-height' ||
                    $property == 'background-position' ||
                    $property == 'background-repeat') {
                        
                    // "-1" means no selection so there is no custom css printed    
                    if($value == '-1' || empty($value)) {
                        $echo = false;
                    }
                }
                    
                
                $return = sprintf('%s { %s: %s; }',
                            $selector, $property, $prefix.$value.$postfix
                        );
                        
                if($media_query) {
                    $return = sprintf('%s { %s: %s; } }',
                            $selector, $property, $prefix.$value.$postfix
                        );
                        
                }
                
                if($rgb) {
                    $rgb_value = uxbarn_hex2rgb($value);
                    
                    $value1 = 'rgb(' . $rgb_value[0] . ',' . $rgb_value[1] . ',' . $rgb_value[2] . ')';
                    $value2 = 'rgba(' . $rgb_value[0] . ',' . $rgb_value[1] . ',' . $rgb_value[2] . ',' . $opacity . ')';
                    
					$media_query_end = '';
					if($media_query) {
						$media_query_end = ' } ';
					}
					
                    $return = sprintf('%s { %s: %s; %s: %s; }' . $media_query_end,
                            $selector, $property, $prefix . $value1 . $postfix, $property, $prefix . $value2 . $postfix
                        );
                }
                
                if($echo) {
                    echo $return;
                }
            
            }
            
        }

    }

}



if ( ! function_exists( 'uxbarn_ctmzr_print_css_box_shadow' ) ) {
	
    function uxbarn_ctmzr_print_css_box_shadow( $selector, $property, $option_set, $option_name, $string_value, $postfix = '' ) {
    	
		if ( $option_set ) {
            
            $value = $option_set[ $option_name ];
			
			if( ! empty( $value ) ) {
		            
				$return = sprintf( '%s { %s: ' . $string_value . ' %s; }', $selector, $property, $value, $value, $value, $postfix );
				
				echo $return;
				
			}
			
		}
		
	}
	
}



if ( ! function_exists( 'uxbarn_ctmzr_print_css_background_size' ) ) {
	
    function uxbarn_ctmzr_print_css_background_size( $selector, $value ) {
    	
		echo sprintf( '%s { -webkit-background-size: %s; -moz-background-size: %s; -o-background-size: %s; background-size: %s; }', $selector, $value, $value, $value, $value );
		
	}
	
}
    