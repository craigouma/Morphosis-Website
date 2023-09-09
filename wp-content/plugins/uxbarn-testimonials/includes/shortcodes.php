<?php

if ( ! function_exists( 'uxb_tmnl_load_testimonials_shortcode' ) ) {
    
    function uxb_tmnl_load_testimonials_shortcode( $atts ) {
    	
		$default_atts = array(
                            'id_list' 		=> '', 
                            'type' 			=> 'full-width', // full-width, left, right
                            'width' 		=> '', // % or px 
                            'interval' 		=> '',
                            'order_by' 		=> 'date',
                            'order' 		=> 'DESC',
                            'extra_class' 	=> '',
                        );
						
        extract( shortcode_atts( $default_atts, $atts ) );
        
        if ( trim( $id_list ) == '' ) {
            return '<div class="error box">' . __( 'Cannot create the Testimonials element. You need to select any items first.', 'uxb_tmnl' ) . '</div>';
        }
        
        $id_list = explode( ',', $id_list );
        
        $args = array(
                    'post_type' => 'uxbarn_testimonials',
                    'nopaging' 	=> true,
                    'post__in' 	=> $id_list,
                    'orderby' 	=> $order_by,
                    'order' 	=> $order,
                );
                
        $testimonials = new WP_Query( $args );
        //echo var_dump($testimonials);
		$output = '';
		
        if ( $type == 'full-width' ) { // full-width with thumbnail style
            
			$output .= '<div class="uxb-tmnl-testimonial-wrapper">';
			$output .= '<div class="uxb-tmnl-testimonial-list" data-auto-rotation="' . $interval . '">';
			
			if ( $testimonials->have_posts() ) {
	            while ( $testimonials->have_posts() ) {
	            	
	                $testimonials->the_post();
					
					$thumbnail = '';
					if ( has_post_thumbnail( get_the_ID() ) ) {
						$thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-tmnl-testimonial-thumbnail' );
					} else {
						$thumbnail = '<img src="' . UXB_TMNL_URL . 'images/placeholders/no-thumbnail.gif" alt="' . __( 'No Thumbnail', 'uxb_tmnl' ) . '" />';
					}
					
					$cite = get_the_title();
	                if ( trim( $cite ) != '' ) {
	                    $cite = '<p class="uxb-tmnl-cite">' . $cite . '</p>';
	                }
					
					$output .= 
							'<div class="uxb-tmnl-testimonial-item">
								<div class="uxb-tmnl-blockquote-wrapper">
									<div class="uxb-tmnl-testimonial-thumbnail">
										' . $thumbnail . '
									</div>
									<blockquote>
										<p>' . uxb_tmnl_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_testimonial_text' ), 0 ) . '</p>
									</blockquote>
									' . $cite . '
								</div>
							</div>';
					
				}
			}
			
			$output .= '</div>'; // close class="testimonial-list"
			$output .= '<div class="uxb-tmnl-testimonial-bullets"></div>';
			$output .= '</div>'; // close class="testimonial-wrapper"
			
            
        } else { // left, right styles
	        
	        $width = trim( $width );
            $unit = '';
            if ( $width != '' ) {
                // Set default prefix to pixel unit if it is not specified
                if ( strpos( $width, 'px' ) === false && strpos( $width, '%' ) === false ) {
                    $unit = 'px';
                }
                
            } else {
                // Default width if it is left blank
                //$width = '400';
                //$unit = 'px';
                $width = '100';
                $unit = '%';
            }
            
            $width = 'style="width: ' . $width . $unit . '"';
        
            $output .= '<div class="uxb-tmnl-testimonial-wrapper style2 ' . $type . '" ' . $width . '>';
			$output .= '<div class="uxb-tmnl-testimonial-list" data-auto-rotation="' . $interval . '">';
			
            if ( $testimonials->have_posts() ) {
	            while ( $testimonials->have_posts() ) {
	            	
	                $testimonials->the_post();
					
					$cite = get_the_title();
	                if ( trim( $cite ) != '' ) {
	                    $cite = '<p class="uxb-tmnl-cite">' . $cite . '</p>';
	                }
					
					$output .= 
							'<div class="uxb-tmnl-testimonial-item">
								<div class="uxb-tmnl-blockquote-wrapper">
									<blockquote>
										<p>' . uxb_tmnl_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_testimonial_text' ), 0 ) . '</p>
									</blockquote>
									' . $cite . '
								</div>
							</div>';
					
				}
			}
			
			$output .= '</div>'; // close class="testimonial-list"
			$output .= '<div class="uxb-tmnl-testimonial-bullets"></div>';
			$output .= '</div>'; // close class="testimonial-wrapper"
			
		}

		wp_reset_postdata();
            
		return $output;
		
	}
	
}