<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    
	    <?php 
	        
	        $show_meta = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_display' ), 0 );
	        
	        // These meta info are used to display in the meta box, and for querying related items
	        $meta_date = uxb_port_get_portfolio_meta_text(
	                        uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_date' ), 0 ) );
	                    
	        $meta_client = uxb_port_get_portfolio_meta_text(
	                        uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_client' ), 0 ) );
	                        
	        $meta_website_link = uxb_port_get_portfolio_meta_text(
	                            	esc_url( uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_website' ), 0) ) );
	        
		?>
		
<div id="content-wrapper" class="uxb-col large-12 columns">
		
	<div id="uxb-port-inner-content-container">
		
        <div class="row <?php if ( uxb_port_is_using_vc() ) echo ' no-margin-bottom '; ?>">
    	
    		<?php 
    			
    			$layout_content_columns = ' large-8 ';
				$layout_meta_columns = ' large-4 ';
				$layout_content_columns_pull = ' pull-4 ';
				$layout_meta_columns_push = ' push-8 ';
				
    		?>
	            
        	<?php if ( $show_meta == 'true' ) : ?>
        		
        		<div class="uxb-col <?php echo $layout_meta_columns; ?> columns <?php echo $layout_meta_columns_push; ?>">
        			
	                <ul id="uxb-port-item-meta">
	                    <li>
	                        <strong class="title"><?php _e( 'Date', 'uxb_port' ); ?></strong><?php echo $meta_date; ?>
	                    </li>
	                    <li>
	                        <strong class="title"><?php _e( 'Client', 'uxb_port' ); ?></strong><?php echo $meta_client; ?>
	                    </li>
	                    <li>
	                        <strong class="title"><?php _e( 'Categories', 'uxb_port' ); ?></strong>
	                        <?php
	                            
	                            $output = '';
	                            $terms = get_the_terms( get_the_ID(), 'uxbarn_portfolio_tax' );
	                            
	                            if ( $terms && ! is_wp_error( $terms ) )  {
	                            	
		                            $output .= '<ul id="uxb-port-item-categories">';
		                            foreach ( $terms as $term ) {
		                                $output .= '<li><a href="' . get_term_link( intval( $term->term_id ), $term->taxonomy ) . '">' . $term->name . '</a></li>';
		                            }
		                            $output .= '</ul>';
									
		                        } else {
		                        	$output = '-';
		                        }
	                            
	                        	echo $output;
	                        
	                        ?>
	                    </li>
	                    <li>
	                        <strong class="title"><?php _e( 'Website', 'uxb_port' ); ?></strong>
	                        <?php if ( $meta_website_link != '-' ) : ?>
	                        	
	                        	<a href="<?php echo $meta_website_link; ?>" target="_blank">
	                        		<?php
	                        			$to_be_replaced = array( 'http://', 'https://' ); 
	                        			echo str_replace( $to_be_replaced, '', $meta_website_link ); 
	                    			?>
	                    		</a>
	                    		
	                    	<?php else : ?>
	                    		<?php echo $meta_website_link; ?>
	                		<?php endif; ?>
	                    </li>
	                </ul>
		        
	        	</div>
	        	
	        <?php else : // if($show_meta) ?>
	        	
	        	<?php 
	        		
	        		$layout_content_columns = ' large-12 ';
	        		$layout_content_columns_pull = '';
	        		
        		?>
	        	
        	<?php endif; ?>
        		
        	<div class="uxb-col <?php echo $layout_content_columns; ?> columns <?php echo $layout_content_columns_pull; ?>">
		        		
	        	<?php the_content(); ?>
	            
        	</div>
        	
        </div>
		        
		        
		        
		        
		        
		        
		        
	       
	    
	    <?php
	    
			// Plugin options
			$plugin_options = get_option( 'uxb_port_plugin_options' );
			
			//echo var_dump($plugin_options);
			
	        $display_related_items = $plugin_options['uxb_port_po_single_page_display_related_works'];
			if ( ! isset( $display_related_items ) ) { // means first time
				$display_related_items = 'true';
			}
			
	    ?>
	    
	    <?php if ( $display_related_items == 'true' ) : ?>
	        
	        <?php
	        	
	            $scope = isset( $plugin_options['uxb_port_po_single_page_related_works_scopes'] ) ? $plugin_options['uxb_port_po_single_page_related_works_scopes'] : '';
	            //echo var_dump($scope);
	            if ( isset( $scope ) && ! empty( $scope ) ) {
	                $scope = array_values( $scope );
	            } else {
	                $scope = array();
	            }
	            
	            
	            // Default category filter
	            $category_id_list = array( -1 );
	            $terms = get_the_terms( get_the_ID(), 'uxbarn_portfolio_tax' );
	        	
				if ( $terms ) {
		            foreach ( $terms as $term ) {
		                $category_id_list[] = $term->term_id;
		            }
				}
	            
	            $category_array = array(
	                'tax_query' => array(
	                    array(
	                        'taxonomy' 	=> 'uxbarn_portfolio_tax',
	                        'field' 	=> 'id',
	                        'terms' 	=> $category_id_list,
	                    ),
	                ),
	            );
	            
	            
	            // Custom fields filter
	            $raw_client_field = array();
	            if ( in_array( 'client', $scope ) ) {
	            	
	                $raw_client_field = array(
	                    'key' 		=> 'uxbarn_portfolio_meta_info_client',
	                    'value' 	=> $meta_client,
	                    'compare' 	=> '=',
	                );
					
	            }
	            
	            $raw_website_field = array();
	            if ( in_array( 'website', $scope ) ) {
	            	
	                $raw_website_field = array(
	                    'key' 		=> 'uxbarn_portfolio_meta_info_website',
	                    'value' 	=> $meta_website,
	                    'compare' 	=> '=',
	                );
					
	            }
	            
	            $raw_date_field = array();
	            if ( in_array( 'date', $scope ) ) {
	            	
	                $raw_date_field = array(
	                    'key' 		=> 'uxbarn_portfolio_meta_info_date',
	                    'value' 	=> $meta_date,
	                    'compare' 	=> '=',
	                );
					
	            }
	            
	            $raw_custom_fields_array = array(
	                'relation' => 'OR',
	                $raw_client_field,
	                $raw_website_field,
	                $raw_date_field,
	            );
	            
	            $custom_fields_array = array(
	                'relation' 		=> 'OR',
	                'meta_query' 	=> $raw_custom_fields_array,
	            );
	            
	            // Final result for all filters
	            $result_filtering_array = array_merge( $category_array, $custom_fields_array );
				
	            $args = array(
	                'post_type' 	=> 'uxbarn_portfolio',
	                'nopaging' 		=> true,
	                'post__not_in' 	=> array( get_the_ID() ), // Not retrieve itself
	            );
	            
	            $related_items = new WP_Query( array_merge( $args, $result_filtering_array ) );
				
	            if ( $related_items->have_posts() ) {
	            	
	                echo 
	                '   
	                <!-- Related Items -->
	                <div class="row">
	                    <div class="uxb-col large-12 columns">
	                        <h4>' . __( 'Related Works.', 'uxb_port' ) . '</h4>
                        </div>
                    </div>
					<div class="row">
						<div class="large-12 columns">
	                        <div class="uxb-port-root-element-wrapper col4">
	                        	<span class="uxb-port-loading-text"><span>' . __( 'Loading', 'uxb_port' ) . '</span></span>
	                            
	                            <div class="uxb-port-loaded-element-wrapper">
	                            
	                            	<div class="uxb-port-element-wrapper">';
	                
	                while ( $related_items->have_posts() ) {
	                	
	                    $related_items->the_post();
	                    
	                    $thumbnail = '';
	                    if ( has_post_thumbnail( get_the_ID() ) ) {
	                        $thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-port-element-thumbnails', array( 'alt'=>get_the_title() ) );
	                    } else {
	                        $thumbnail = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-related-item.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
	                    }
		                    
						//$show_title = $plugin_options['uxb_port_po_single_page_related_works_title'];
						$show_title_code = '<h3 class="portfolio-item-title">' . get_the_title() . '</h3>';
						// if ( $show_title == 'false' ) {
							// $show_title_code = '';
						// }
		                
	                    echo 
	                    '<div class="uxb-port-element-item black-white">
	                    	<a href="' . get_permalink() . '"></a>
	                        <div class="uxb-port-element-item-hover">
	                        	<div class="uxb-port-element-item-hover-info">' . $show_title_code . '</div>
	                        </div>
	                        ' . $thumbnail . '
	                    </div>';
	                    
	                }
	
	                echo '</div></div></div>'; // close "uxb-port-element-wrapper", "uxb-port-loaded-element-wrapper", "uxb-port-root-element-wrapper"
	                echo '</div></div>'; // close "columns", "row"
	
	            }
	            
	            wp_reset_postdata();
	        ?>
	        
	    <?php endif; // if($display_related_items) ?>
	    
	    <?php
	    	
			$is_comment_enabled = $plugin_options['uxb_port_po_single_page_enable_comment'];
			if ( ! isset( $is_comment_enabled ) ) {
				$is_comment_enabled = 'false';
			}
			
		?>
	    
	    <?php if ( $is_comment_enabled == 'true' ) : ?>
            
            <?php if ( comments_open() ) : ?>
                
                <!-- Comment Section -->
                <div class="row">
                    <div class="uxb-col large-12 columns">
                        
                        <?php comments_template(); ?>
                        
                    </div>
                </div>
                
            <?php endif; ?>
            
        <?php endif; ?>
	
	<?php endwhile; endif; ?>
	
    </div>
    <!-- END: id="uxb-port-inner-content-container" -->
    
</div>
<!-- END: id="content-wrapper" -->

<?php get_footer(); ?>