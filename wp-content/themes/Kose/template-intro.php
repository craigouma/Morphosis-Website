<?php
    
    $is_displayed = '';
    $title = '';
    $body = '';
    
    if ( is_tag() || is_date() || is_category() || is_search() || is_author() ) {
    	
        $is_displayed = 'true';
		
        if ( is_tag() ) {
            $title = __( 'Tag:', 'uxbarn' ) . ' <span>' . single_tag_title( '', false ) . '</span>';
        } elseif ( is_date() ) {
            $title = __( 'Archive:', 'uxbarn' ) . ' <span>' . get_the_date( 'F Y' ) . '</span>';
        } elseif ( is_category() ) {
            $title = '<span>' . single_cat_title( '', false ) . '</span>';
        } elseif ( is_search() ) {
            $title = __( 'Search:', 'uxbarn' ) . ' <span>' . $_GET['s'] . '</span>';
        } elseif ( is_author() ) {
        	
            $curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );
            $title = __( 'Author:', 'uxbarn' ) . ' <span class="intro-title">' . $curauth->display_name . '</span>';
			
        } else {
            $title = '';
        }
        
    } elseif ( is_tax() ) {
    	
		$front_text = '';
		
		// From UXbarn Portfolio plugin
        if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
            $front_text = __( 'Category:', 'uxbarn' );
        }
		
		// From WooCommerce's
		if ( is_tax( 'product_cat' ) ) { 
            $front_text = __( 'Category:', 'uxbarn' );
        } elseif ( is_tax( 'product_tag' ) ) {
        	$front_text = __( 'Tag:', 'uxbarn' );
        }
		
		$title = $front_text . ' <span>' . single_term_title( '', false ) . '</span>';
        $body = term_description();
         
    } elseif ( is_single() ) {
                
        if ( have_posts()) : while( have_posts() ) : the_post();
        
            if ( is_singular( 'uxbarn_portfolio' ) ) { // From UXbarn Portfolio plugin
            	
                $is_displayed = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_page_intro_display' ), 0 );
                    
                    $title = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_page_intro_title' ), 0 );
                    $title = trim( $title ) == '' ? get_the_title( $post->ID ) : $title;
                    $body = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_page_intro_body' ), 0 );
            
            } elseif ( is_singular( 'uxbarn_team' ) ) { // not display intro 
            
            	$is_displayed = 'false';
                //$title = get_the_title($post->ID);
                //$body = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_staff_excerpt'), 0);
                
            } elseif ( is_singular( 'post' ) ) {
                
                if ( get_option( 'show_on_front' ) != 'posts' ) { // Set as "static page" 
                
                    // Get blog page's ID
                    $post_id = get_option( 'page_for_posts' );
                    
                    $is_displayed = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_page_intro_display' ), 0 );
                    
                    $title = uxbarn_get_array_value( get_post_meta($post_id, 'uxbarn_page_intro_title' ), 0 );
                    $title = trim( $title ) == '' ? get_the_title( $post_id ) : $title;
                    $body = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_page_intro_body' ), 0 );
					
                } else { // Set as "Your latest posts" in "Settings> Reading" 
                    $is_displayed = 'false';
                }
                
            }
        
        endwhile; endif;
        
    } else { // Other pages that are NOT "tag", "date", "category", "search", "author", "taxonomy" and "single"
    	
        $post_id = '';
		
        if ( is_front_page() ) {
        	
            if ( is_home() ) { // Case of "Your latest posts" selection
            	$post_id = '';
            } else { // Case of "Static page" selection
            
                if ( get_option( 'show_on_front' ) == 'page' ) {
                    $post_id = get_option( 'page_on_front' );
                } else {
                    $post_id = get_option( 'page_for_posts' );
                }
				
            }
			
        } else {
        	
            if ( is_home() ) {
                $post_id = get_option( 'page_for_posts' );
            } else {
            	
                if ( ! is_404() ) {
                	
                    // Normal Page
                    global $wp_query;
                    $post_id = $wp_query->post->ID;
					
					
					// WooCommerce templates
					if ( class_exists( 'Woocommerce' ) ) {
						
						if ( is_woocommerce() ) {
							$post_id = woocommerce_get_page_id( 'shop' );
						}
						
					}
				    
					
					
                }
                
            }
            
        }
        
        if( $post_id != '' ) {
        	
	        $is_displayed = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_page_intro_display' ), 0 );
	        $title = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_page_intro_title' ), 0 );
	        $title = trim( $title ) == '' ? get_the_title( $post_id ) : $title;
	        $body = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_page_intro_body' ), 0 );
			
        } else {
        	$is_displayed = 'false';
        }

    }
    
    $allowed_html = array(
						'span' => array(),
						'br' => array(),
						'p' => array(),
						'strong' => array(),
						'b' => array(),
						'em' => array(),
						'i' => array(),
					);
    
    $title = wp_kses( uxbarn_get_html_validated_content( $title ), $allowed_html );
    $body = uxbarn_get_html_validated_content( $body );
	
	global $uxbarn_intro_display;
	$uxbarn_intro_display = $is_displayed;
	
	
	// WooCommerce templates that don't need intro
	if ( class_exists( 'Woocommerce' ) ) {

		if ( is_product() ) {
			$is_displayed = 'false';
		}
		
	}
	
	//echo var_dump($is_displayed);
	// Convert the value when using with "on-off" option type of OptionTree
	if ( $is_displayed == 'on' || $is_displayed == 'true' ) {
		$is_displayed = 'true';
	} else {
		$is_displayed = 'false';
	}		
	
?>

<?php if ( $is_displayed != 'false' || is_tax() ) : ?>
	
	<!-- Page Intro -->
	<div id="intro-wrapper" class="row">
        <div class="uxb-col large-12 columns">
        	
        	<?php
        	
        		if ( is_single() ) {
					if ( is_singular( 'post' ) ) {
						echo '<h2 id="intro-title" class="blog-single">' . $title . '</h2>';
					} else {
						echo '<h1 id="intro-title">' . $title . '</h1>';
					}
        		} else {
        			echo '<h1 id="intro-title">' . $title . '</h1>';
        		}
				
				if ( trim( $body ) != '' ) {
					echo '<p id="intro-body">' . $body . '</p>';
				}
        	
        	?>
        	
	    	<hr class="pattern-divider" />
            	            
        </div>
        
    </div>
    
<?php endif; ?>