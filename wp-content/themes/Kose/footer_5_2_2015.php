			
			<?php $slides = array(); ?>
			
			<?php if ( ! is_404() ) : // If it is not 404 template and... ?>
				
				<?php
					
					// If it is not search and portfolio category template, get the slides of the current post/page 
					if ( ! is_search() && ! is_tax( 'uxbarn_portfolio_tax' ) ) {
						
						global $post;
						$post_id = $post->ID;
						
						// If it is blog page or blog archive page, get the ID of the page that is set as Posts Page.
						if ( is_home() || is_archive() ) {
							$post_id = get_option( 'page_for_posts' );
						}
						
						// Default to normal page slider
						$slider_id = 'uxbarn_fullscreen_slider'; 
						
						// If it is portfolio single page, use the ID of portfolio slider instead
						if ( is_singular( 'uxbarn_portfolio' ) ) {
							$slider_id = 'uxbarn_portfolio_image_slideshow';
						}
						
						$slides = uxbarn_get_array_value( get_post_meta( $post_id, $slider_id ), 0 );
						
					}
					
					global $hide_content_tags; // from "header.php"
				
				?>
				
				<?php // These closing tags are required for post/page and any templates and has the content area (404 does not need ones) ?>
				
				<?php if ( ! $hide_content_tags ) : // If both button and content area are hidden, then don't display the tags ?>
					
							</div>
							<!-- End id="actual-content-area" -->
						</div>
						<!-- End id="inner-content-container" -->
					</div>
					<!-- End id="content-container" -->
					
				<?php endif; // END: if ( ! $show_content_tags ) ?>
				
			<?php endif; // END: if ( ! is_404() ) ?>
			
			<?php 
				
				// If it is 404, search template, or portfolio category template then check its background image.
				// And if there is an uploaded one, then create a dummy array making the loading icon display.
				if ( is_404() || is_search() || is_tax( 'uxbarn_portfolio_tax' ) ) {
					
					$option_id = 'uxbarn_to_setting_template_404_image';
					if ( is_search() ) {
						$option_id = 'uxbarn_to_setting_template_search_result_image';
					}
						
					if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
						$option_id = 'uxbarn_to_setting_template_portfolio_taxonomy_image';
					}
					
					// Get background image from Theme Options
					if ( function_exists( 'ot_get_option' ) ) {
						$slide_image_url = ot_get_option( $option_id, '' );
					} else {
						$slide_image_url = '';
					}
					
					if ( $slide_image_url != '' ) {
						$slides = array( 'dummy' );
					}
					
				}
				
			?>
			
		</div>
		<!-- End id="inner-container" -->
	</div>
	<!-- End id="root-container" -->
	
	
	<?php if ( ! empty( $slides ) ) : ?>
		
		<div id="loading-bg">
			<img src="<?php echo UXB_THEME_ROOT_IMAGE_URL; ?>loading-bg.gif" alt="<?php _e( 'Loading', 'uxbarn' ); ?>" />
		</div>
		
	<?php endif; ?>
	
	
	
	<?php wp_footer(); ?>
	<script>
	jQuery(function() {
				cbpBGSlideshow.init();
			});
	(function() {

				var dlgtrigger = document.querySelector( '[data-dialog]' ),
					somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
					dlg = new DialogFx( somedialog );

				dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

			})();
	</script>	
	</body>
</html>