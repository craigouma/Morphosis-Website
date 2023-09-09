<?php

if ( ! function_exists( 'uxb_port_load_portfolio_shortcode' ) ) {
    
    function uxb_port_load_portfolio_shortcode( $atts ) {
    	
        $default_atts = array(
                            'categories' 	=> '',
                            'max_item' 		=> '',
                            'type' 			=> 'col4', // col3, col4, flexslider_fade, flexslider_slide
                            'show_filter' 	=> 'true', // true, false
                            'show_title' 	=> 'true', // true, false
                            'img_size' 		=> '',
                            'interval' 		=> '', // 0, 5, ..
                            'show_bullets' 	=> 'true', // true, false
                            'orderby' 		=> '',
                            'order' 		=> '',
                            'el_class' 	=> '',
                        );              
						
        extract( shortcode_atts( $default_atts, $atts ) );
        
		if ( trim( $categories ) == '' ) {
            return '<div class="error box">' . __( 'Cannot generate Portfolio element. Categories must be defined.', 'uxb_port' ) . '</div>';
        }

        $category_id_list = explode( ',', $categories );
		
		// If WPML is active, get translated category's ID
		if ( function_exists( 'icl_object_id' ) ) {
			
			$wpml_cat_list = array();
			
			foreach ( $category_id_list as $cat_id ) {
				$wpml_cat_list[] = icl_object_id( $cat_id, 'uxbarn_portfolio_tax', false, ICL_LANGUAGE_CODE );
			}
			
			$category_id_list = $wpml_cat_list;
			
		}
		
		
		if ( ! is_numeric( $max_item ) ) {
            $max_item = '';
        }
        
		// Prepare WP_Query args
        if ( $max_item == '' ) {
        	
            $args = array(
                'post_type' 	=> 'uxbarn_portfolio',
                'nopaging' 		=> true,
                'tax_query' 	=> array(
	                                    array(
		                                    'taxonomy'  => 'uxbarn_portfolio_tax',
		                                    'field' 	=> 'id',
		                                    'terms' 	=> $category_id_list,
                                    	),
                                	),
                'orderby' 		=> $orderby,
                'order' 		=> $order,
            );
            
        } else {
            
            $args = array(
                'post_type' 		=> 'uxbarn_portfolio',
                'posts_per_page' 	=> $max_item,
                'tax_query' 		=> array(
		                                    array(
			                                    'taxonomy'  => 'uxbarn_portfolio_tax',
			                                    'field' 	=> 'id',
			                                    'terms' 	=> $category_id_list,
		                                    ),
		                                ),
                'orderby' 			=> $orderby,
                'order' 			=> $order,
            );
            
        }
        
        $portfolio = new WP_Query( $args );
		
		if ( ! $portfolio->have_posts() ) {
			return '<div class="error box">' . __( 'There are no portfolio items available in the selected categories.', 'uxb_port' ) . '</div>';
		}
		
		if ( $type == 'col3' || $type == 'col4' ) {
			
			$output = 
				'<div class="uxb-port-root-element-wrapper ' . $type . ' ' . $el_class . '">
					<span class="uxb-port-loading-text"><span>' . __( 'Loading', 'uxb_port' ) . '</span></span>
					
					<div class="uxb-port-loaded-element-wrapper">';
					
			if ( $show_filter == 'true' ) {
						
				$filter_string = 
						'<ul class="uxb-port-element-filters">
							<li><a href="#" class="active" data-filter="*">' . __( 'All', 'uxb_port' ) . '</a></li>';
				
				// Generate filter items
				$terms_args = array(
		            'include' => $category_id_list,
		            'orderby' => 'menu_order',
		        );
				
		        $terms = get_terms( 'uxbarn_portfolio_tax', $terms_args );
				
		        if ( $terms && ! is_wp_error( $terms ) )  {
		        	
		            foreach ( $terms as $term ) {
		                $filter_string .= '<li><a href="#" data-filter=".term_' . $term->term_id . '">' . $term->name . '</a></li>';
		            }
					
		        }
				
				$filter_string .= '</ul>'; // close filter list
				$output .= $filter_string;
				
			}
			
			$output .= '<div class="uxb-port-element-wrapper">';
			
			// Generate grid columns
	        if ( $portfolio->have_posts() ) {
	        	
	            while ( $portfolio->have_posts() ) {
	            	
	                $portfolio->the_post();
	                
					// Prepare category string for each item's class
	                $term_list = '';
	                $terms = get_the_terms( get_the_ID(), 'uxbarn_portfolio_tax' );
	                
	                if ( $terms && ! is_wp_error( $terms ) )  {
	                	
	                    foreach ( $terms as $term ) {
	                        $term_list .= 'term_' . $term->term_id . ' ';
	                    }
						
	                }
	                
	                $thumbnail = '';
	                if ( has_post_thumbnail( get_the_ID() ) ) {
	                    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-port-element-thumbnails' );
	                } else {
	                    $thumbnail = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-grid.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
	                }
					
					$show_title_code = '<hr/><h3>' . get_the_title() . '</h3><hr/>';
					if ( $show_title == 'false' ) {
						$show_title_code = '';
					}
					
					$output .= 
						'<div class="uxb-port-element-item border ' . $term_list . '">
							<div class="uxb-port-element-item-hover">
								<a href="' . get_permalink() . '"></a>
								<div class="uxb-port-element-item-hover-info">' . $show_title_code . '</div>
							</div>
							' . $thumbnail . '
						</div>';
					
				}

			} else {
				
			}
			
			$output .= '</div>'; // close class="portfolio-wrapper"
			$output .= '</div>'; // close class="portfolio-loaded-wrapper"
			$output .= '</div>'; // close class="portfolio-root-wrapper
			
		} else { // if($type == 'col3' ... ) and this is for "flexslider" type
			
			$transition_effect = 'fade';
			
			if ( $type == 'flexslider_slide' ) {
				$transition_effect = 'slide';
			}
			
			if ( $show_bullets == 'false' ) {
				$show_bullets = ' hide-bullets ';
			}
			/*

			$border_class_array = array( 'class' => 'border' );
			
			if ( $border == 'no' ) {
				$border_class_array = array();
			}
			*/

		    $output = '<div class="uxb-port-image-slider-root-container ' . $el_class . '">';
			$output .= '<div class="uxb-port-image-slider-wrapper uxb-port-slider-set ' . $show_bullets . '" data-auto-rotation="' . $interval . '" data-effect="' . $transition_effect . '">';
		    $output .= '<ul class="uxb-port-image-slider">';
		    
			if ( $portfolio->have_posts() ) {
				
	            while ( $portfolio->have_posts() ) {
	            	
	                $portfolio->the_post();
					
					// Default case if there is no thumbnail assigned
					$img_tag = '<img class="border" src="' . UXB_PORT_URL . 'images/placeholders/port-slider.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
					
					if ( has_post_thumbnail( get_the_ID() ) ) {
							
						$attachment_id = get_post_thumbnail_id( get_the_ID() );
						
						// If there is an alternate thumbnail specified, use it instead
						$alternate_thumbnail_url = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_alternate_thumbnail' ), 0 );
						
						if( $alternate_thumbnail_url != '' ) {
							$attachment_id = uxb_port_get_attachment_id_from_src( $alternate_thumbnail_url );
						}
						
						$attachment = uxb_port_get_attachment( $attachment_id );
	       
						$img_fullsize = $attachment['src']; 
						
						// Get an array: [0] => url, [1] => width, [2] => height
				        $img_thumbnail = wp_get_attachment_image_src( $attachment_id, $img_size );
				        
				        $title = $attachment['title']; //trim(esc_attr(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )));
				        
				        $anchor_title = '';
						
				        if ( $title != '' ) {
				            $anchor_title = ' title="' . $title . '" ';
				        }
				        
				        $img_tag = '<img src="' . $img_thumbnail[0] . '" class="border" alt="' . $attachment['alt'] . '" width="' . $img_thumbnail[1] . '" height="' . $img_thumbnail[2] . '" />';
						
	                }
					
					// Don't need to apply "width" or "height" here, it's aleady done in css for 100% width.
					$output .= '<li class="uxb-port-image-slider-item">';
					
					$output .= '<a href="' . get_permalink() . '"' . $anchor_title . ' class="image-link">' . $img_tag . '</a>';
			        
			        if ( trim( $attachment['caption'] ) != '' ) {
			            $output .= '<div class="uxb-port-image-caption-wrapper"><div class="uxb-port-image-caption">' . $attachment['caption'] . '</div></div>';
			        }
			        
			        $output .= '</li>'; // close "image-slider-item"
					
				}
			}
			
		    $output .= '</ul>'; // close "image-slider"
		    $output .= '</div>'; // close "image-slider-wrapper slider-set"
		    $output .= 
		            	'<a href="#" class="uxb-port-slider-controller uxb-port-slider-prev"><i class="icon-angle-left"></i></a>
						<a href="#" class="uxb-port-slider-controller uxb-port-slider-next"><i class="icon-angle-right"></i></a>';
		    $output .= '</div>'; // close "image-slider-root-container"
		    
		}
		
		wp_reset_postdata();
		
        return $output;
        
    }

}
