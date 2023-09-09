<?php get_header(); ?>

<?php if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) : ?>
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	    
	    <?php 
	        
	        $display_post_format_content = true; 
	        
	        $post_format = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_item_format' ), 0 );
			$images_format_layout = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_image_slideshow_layout' ), 0 );
			
	        $show_meta = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_display' ), 0 );
	        
	        // These meta info are used to display in the meta box, and for querying related items
	        $meta_date = uxb_port_get_portfolio_meta_text(
	                        uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_date' ), 0 ) );
	                    
	        $meta_client = uxb_port_get_portfolio_meta_text(
	                        uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_client' ), 0 ) );
	                        
	        $meta_website_link = uxb_port_get_portfolio_meta_text(
	                            	esc_url( uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_meta_info_website' ), 0) ) );
	        
			//echo $show_meta;
			
			// Prepare the values for layout mode (default values are for landscape view)
			$layout_images_column = ' large-12 ';
			$layout_info_column = ' large-12 ';
			$images_slider_class = '';
			$image_size = 'uxb-port-single-landscape';
			$meta_class_attr = '';
			
			if ( $images_format_layout == 'portrait' ) {
				
				$layout_images_column = ' large-7 ';
				$layout_info_column = 'large-5 ';
				$images_slider_class = ' portrait-view ';
				$image_size = 'uxb-port-single-portrait';
				$meta_class_attr = ' class="portrait-view" ';
				
			}
			
	    ?>
	    
	    <div id="uxb-port-inner-content-container">
	    	
	    <?php if ( $display_post_format_content ) : ?>
	    	
		    <?php 
		    
	    		$title = uxb_port_get_array_value( get_post_meta( $post->ID, 'uxbarn_portfolio_single_title' ), 0 );
				$title = trim( $title ) == '' ? get_the_title() : $title;
	    		echo apply_filters( 'uxb_port_single_title', $title ); 
					
			?>
	    
	        <?php if ( $post_format == 'image-slideshow' ) : ?>
	            
	            <?php
	                
	                $images = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_image_slideshow' ), 0 );
	                
	            ?>
	    
	            <!-- Portfolio Images/Video -->
	            <div id="uxb-port-images-type" class="row">
	                <div class="uxb-col <?php echo $layout_images_column; ?> columns">
	                	
	            		<?php if ( ! empty( $images ) ) : ?>
		                
		                	<div id="uxb-port-single-images-container" class="slider-set <?php echo $images_slider_class; ?>">
		                    	<ul class="uxb-port-single-slides">
		                        
		                        <?php foreach ( $images as $image ) : ?>
		                        	
		                    		<?php
		                        	
		                        		$image_full_size_url = $image['uxbarn_portfolio_image_slideshow_upload'];
										$attachment_id = uxb_port_get_attachment_id_from_src( $image_full_size_url );
										$caption = '';
										$alt = '';
										$title = '';
										$image_width = '1020';
										$image_height = '676';
										
										// Whether the entered URL is from external site or not
										if ( isset( $attachment_id ) ) { // From its own attachement archive
										
											$attachment = uxb_port_get_attachment( $attachment_id );
											$caption = $attachment['caption'];
											$alt = $attachment['alt'];
											$title = $attachment['title'];
											
											// Got an array [0] => url, [1] => width, [2] => height
											$image_array = wp_get_attachment_image_src( $attachment_id, $image_size );
											$image_display_size_url = $image_array[0];
											$image_width = $image_array[1];
											$image_height = $image_array[2];
											
										} else { // From external site
											$image_display_size_url = $image_full_size_url;
										}
										
		                        	?>
		                            
		                            <?php if ( $image_full_size_url ) : ?>
			                            
			                            <li class="uxb-port-single-image">
			                                <a href="<?php echo $image_full_size_url; ?>" class="uxb-port-image-box" title="<?php echo $title; ?>" data-fancybox-group="portfolio-image-group"><img src="<?php echo $image_display_size_url; ?>" alt="<?php echo $alt; ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" class="border" /></a>
			                                
			                                <?php if ( $caption != '' ) : ?>
			                                	<div class="uxb-port-image-caption-wrapper">
						                            <div class="uxb-port-image-caption">
														<?php echo $caption; ?>
													</div>
												</div>
			                                <?php endif; ?>
			                            </li>
			                            
		                            <?php endif; ?>
		                            
		                        <?php endforeach; ?>
		                        
		                        </ul>
		                    
			                    <a href="#" class="uxb-port-slider-controller uxb-port-slider-prev"><i class="icon-angle-left"></i></a>
								<a href="#" class="uxb-port-slider-controller uxb-port-slider-next"><i class="icon-angle-right"></i></a>
							
							</div>
							
						<?php else : ?>
							
							<?php echo '<div class="info uxb-port-box no-margin-bottom">' . __( 'You have not yet added any images.', 'uxb_port' ) . '</div>'; ?>
		            
	            		<?php endif; // if(!empty($images)) ?>
		                    
		            </div>
		            
		        <?php if( $images_format_layout == 'landscape' ) : // if it is "landscape" view, close the row div ?>
		        	</div>
		    	<?php endif; ?>
	            
	        <?php elseif ( $post_format == 'video' ) : ?>
	            
	            <?php
	            
	                $video_url = uxb_port_get_array_value( get_post_meta( get_the_ID(), 'uxbarn_portfolio_video_url' ), 0 );
	            
	            ?>
	            
	            <div id="uxb-port-video-type" class="row">
	                <div class="uxb-col large-12 columns">
				        
			            <?php 
			            
		            		if ( $video_url ) {
		            			
								global $wp_embed;
	            				echo '<div class="uxb-port-embed">' . $wp_embed->run_shortcode( '[embed]' . esc_url( $video_url ) . '[/embed]' ) . '</div>';
								
							} else {
								echo '<div class="info uxb-port-box">' . __( 'You have not yet specified the video URL.', 'uxb_port' ) . '</div>';
							}
							
						?>
		            
	                </div>
	            </div>
	                
	        <?php endif; // END: if($post_format == 'image-slideshow') ?>
	        
	    <?php endif; // END: if($display_post_format_content) ?>
	    
	    <?php if ( $post_format == 'image-slideshow' ) : ?>
	    	
	    	<?php if ( $images_format_layout == 'landscape' ) : // if it is "landscape" view, open the row div for info ?>
	    		<div class="row">
			<?php endif; ?>
			
		<?php else : // if it is video format, open the row div for info ?>
			<div class="row">
		<?php endif; ?>
		
	        <div class="uxb-col <?php echo $layout_info_column; ?> columns">
		        
		        <div class="row <?php if ( uxb_port_is_using_vc() ) echo ' no-margin-bottom '; ?>">
		        	
		        	<?php if ( $show_meta == 'true' ) : ?>
		        		
		        		<?php 
		        			
		        			// Default for "landscape" mode
		        			$layout_content_columns = ' large-9 ';
							$layout_meta_columns = ' large-3 ';
							$layout_content_columns_pull = ' pull-3 ';
							$layout_meta_columns_push = ' push-9 ';
							
							if ( $images_format_layout == 'portrait' ) {
								
								$layout_content_columns = ' large-12 ';
								$layout_meta_columns = ' large-12 ';
								$layout_content_columns_pull = '';
								$layout_meta_columns_push = '';
								
							}
		        		
		        		?>
				            
		        		<div class="uxb-col <?php echo $layout_meta_columns; ?> columns <?php echo $layout_meta_columns_push; ?>">
		        			
			                <ul id="uxb-port-item-meta" <?php echo $meta_class_attr; ?>>
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
		        
	        </div>
	    </div>
	    
	    <?php
	    
			// Plugin options
			$plugin_options = get_option( 'uxb_port_plugin_options' );
			
	        $display_related_items = $plugin_options['uxb_port_po_single_page_display_related_works'];
			if ( ! isset( $display_related_items ) ) { // means first time
				$display_related_items = 'true';
			}
			
	    ?>
	    
	    <?php if ( $display_related_items == 'true' ) : ?>
	        
	        <?php
	        	
	            $scope = isset( $plugin_options['uxb_port_po_single_page_related_works_scopes'] ) ? $plugin_options['uxb_port_po_single_page_related_works_scopes'] : '';
	           // echo var_dump($scope);
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
				    <!-- Divider set -->
					<div class="divider-set1">
						<hr class="short" />
						<hr class="middle" />
					</div>
				    
	                <!-- Related Items -->
	                <div class="row">
	                    <div class="uxb-col large-12 columns">
	                        <h3>' . __( 'Related Works', 'uxb_port' ) . '</h3>
	                        
	                        <div class="uxb-port-root-element-wrapper related-items col4">
	                        	<span class="uxb-port-loading-text"><span>' . __( 'Loading', 'uxb_port' ) . '</span></span>
	                            <div class="uxb-port-element-wrapper">';
	                
	                while ( $related_items->have_posts() ) {
	                	
	                    $related_items->the_post();
	                    
	                    $thumbnail = '';
	                    if ( has_post_thumbnail( get_the_ID() ) ) {
	                        $thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-port-related-items', array( 'alt'=>get_the_title() ) );
	                    } else {
	                        $thumbnail = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-related-item.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
	                    }
		                    
						//$show_title = $plugin_options['uxb_port_po_single_page_related_works_title'];
						$show_title_code = '<hr/><h4>' . get_the_title() . '</h4><hr/>';
						// if ( $show_title == 'false' ) {
							// $show_title_code = '';
						// }
		                
	                    echo 
	                    '<div class="uxb-port-element-item border">
	                        <div class="uxb-port-element-item-hover">
	                        	<a href="' . get_permalink() . '"></a>
	                        	<div class="uxb-port-element-item-hover-info">' . $show_title_code . '</div>
	                        </div>
	                        ' . $thumbnail . '
	                    </div>';
	                    
	                }
	
	                echo '</div></div>'; // close "portfolio-wrapper", "portfolio-root-wrapper"
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
	    <!-- END: id="inner-content-container" -->
	    
<?php else : // if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) :?>
	
	<?php _e( 'OptionTree plugin must be installed and activated first.', 'uxb_port' ); ?>
	
<?php endif; ?>

<?php get_footer(); ?>