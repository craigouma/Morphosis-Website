<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
	<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
        
        <title><?php wp_title( '-', true, 'right' ); ?></title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        
        <?php if ( function_exists( 'ot_get_option' ) ) : if ( ot_get_option( 'uxbarn_to_setting_upload_favicon' ) ) : ?>
            <link rel="icon" type="image/png" href="<?php echo ot_get_option( 'uxbarn_to_setting_upload_favicon' ); ?>">
        <?php endif; endif; ?>
        
        <?php wp_head(); ?>
        <?php
		global $post;
		$post_id = $post->ID;
		if($post_id==28){?>
        <style>
		#content-container{padding: 55px 0px 0px 216px !important;}#inner-content-container{padding-right: 0px !important;}
		.row.contacts {padding: 0 50px;} .theneeded p{padding-left: 35px; margin-bottom: 50px!important;}
		.contacts input.wpcf7-form-control{border-top:none;border-left:none;border-right:none;border-bottom: 1px solid #888;}
		.contacts .theneeded{float: left; width: 47%;} .contacts .themessage{float: right; width: 50%;}
		.contacts .wpcf7-textarea{height: 193px !important;border: none;background: rgba(255,255,255,.6);padding: 15px;} 
		::-webkit-input-placeholder {color: #aaa;font-family:'Lato';font-style:italic;}:-moz-placeholder {color: #aaa;font-family:'Lato';font-style:italic;}::-moz-placeholder {color: #aaa;font-family:'Lato';font-style:italic;}:-ms-input-placeholder {color: #aaa;font-family:'Lato';font-style:italic;} .wpcf7-textarea::-webkit-input-placeholder {color: #000; font-style:italic;font-family:'Lato';}.wpcf7-textarea:-moz-placeholder {color: #000;font-style:italic;font-family:'Lato';}.wpcf7-textarea::-moz-placeholder {color: #000;font-style:italic;font-family:'Lato';}.wpcf7-textarea:-ms-input-placeholder {color: #000;font-style:italic;font-family:'Lato';} .theneeded p:first-child{ background:url(<?php echo get_template_directory_uri();?>/images/thename.png) no-repeat left center;}.theneeded p:nth-child(2){ background:url(<?php echo get_template_directory_uri();?>/images/theemail.png) no-repeat left center;}.theneeded p:last-child{ background:url(<?php echo get_template_directory_uri();?>/images/thetel.png) no-repeat left center;} .thesubmit{float:right;} .contacts .wpcf7-submit{float: right; margin: 0 0 0 10px !important;} .thesubmit input[type=submit]{background:url(<?php echo get_template_directory_uri();?>/images/thesubmit.png) no-repeat 15% center !important; padding: 10px 18px 10px 45px !important;}
		</style>
		<?php } else if(is_home()){ ?>
         <style> #content-container{background: none; padding: 0px 20px 0px 20px; width:auto; margin-left:220px;} #actual-content-area{margin:50px 0;}</style>
        <?php } ?>
        <?php 
		if ( is_singular( 'uxbarn_portfolio' ) ) { ?>
        <style>.slide-caption{-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 40px 15px 40px 30px;max-width: 35%;margin: auto 0 auto auto;background: rgba(0,0,0,.6);}.slide-caption-wrapper{text-align: left;}</style>
		<?php } ?>
    </head>
   
   	
	<?php
	
		// Default to empty array
		$slides = array();
		
		$no_content_class_name = '';
		$display_content_area_class = '';
		$toggle_button_display = '';
	
		global $hide_content_tags;
		$hide_content_tags = false; // default value
		
		
		// If it is not 404, search template, and portfolio category template, get post ID and the slide array
		if ( ! is_404() && ! is_search() && ! is_tax( 'uxbarn_portfolio_tax' ) ) {
			
			global $post;
			$post_id = $post->ID;
			
			// If it is blog page or blog archive page, get the ID of the page that is set as Posts Page.
			if ( is_home() || is_archive() ) {
				$post_id = get_option( 'page_for_posts' );
			}
			
			
			
			/*** For Fullscreen Slider ***/
			// Default to normal page slider
			$slider_id = 'uxbarn_fullscreen_slider'; 
			$slider_image_id = 'uxbarn_fullscreen_slider_image';
			
			// If it is portfolio single page, use the ID of portfolio slider instead
			if ( is_singular( 'uxbarn_portfolio' ) ) {
				
				$slider_id = 'uxbarn_portfolio_image_slideshow';
				$slider_image_id = 'uxbarn_portfolio_image_slideshow_upload';
				
			}
			
			$slides = uxbarn_get_array_value( get_post_meta( $post_id, $slider_id ), 0 );
			
			
			
			/*** For Page Content ***/
			// Whether to display the toggle button
			$toggle_button_display = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_content_show_hide_button_display' ), 0 );
			
			// Whether to display the content area by default on page load
			$display_content_area = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_content_area_display' ), 0 );
			
			if ( $display_content_area == 'off' ) {
				$display_content_area_class = ' class="hidden-content" ';
			}
			
			// If both button and content area are hidden, then don't display the tags
			if ( $toggle_button_display == 'off' && $display_content_area == 'off' ) {
				$hide_content_tags = true;
			}
			
			if ( $hide_content_tags ) {
				 $no_content_class_name = 'no-content-area'; 
			}
			
			//echo var_dump($post_id) . '<br/>';
			//echo var_dump($hide_content_tags) . '<br/>';
			
		}
		
		// On search template, there is no need to use post ID so set is as 0
		if ( is_search() || is_tax( 'uxbarn_portfolio_tax' ) ) {
			$post_id = 0;
		}
	
	?>
	
   	
	<body id="theme-body" <?php body_class( $no_content_class_name ); ?>>
		
	<div id="dummy-slide-image" class="full-scrn"></div>
	<div id="video-container"></div>
	
	<?php if ( ! empty( $slides ) ) : // if the slide array is not empty (has slides) then create the slider ?>
		
		<?php
			
			// Get slider settings from Theme Options
			if ( function_exists( 'ot_get_option' ) ) {
					
				$slider_transition = ot_get_option( 'uxbarn_to_setting_fullscreen_slider_transition', 'crossfade' );
				$slider_transition_speed = uxbarn_sanitize_numeric_input(
		                                	ot_get_option( 'uxbarn_to_setting_fullscreen_slider_transition_speed' ), 
		                                	1000);
				$slider_auto_rotation = ot_get_option( 'uxbarn_to_setting_fullscreen_slider_auto_rotation', 'on' ) == 'off' ? false : true;
				$slider_rotation_duration = uxbarn_sanitize_numeric_input(
			                                	ot_get_option( 'uxbarn_to_setting_fullscreen_slider_rotation_duration' ), 
			                                	5000);
				
				if ( ! $slider_auto_rotation ) {
					$slider_rotation_duration = 0;
				}
				
			} else {
				
				$slider_transition = 'crossfade';
				$slider_transition_speed = 1000;
				$slider_auto_rotation = true;
				$slider_rotation_duration = 5000;
				
			}
			
		?>
			
		<!-- Full Screen Image/Slider -->
		<div id="full-scrn-slider-container">
			<div id="full-scrn-slider" data-auto-rotation="<?php echo $slider_rotation_duration; ?>" data-effect="<?php echo $slider_transition; ?>" data-transition-speed="<?php echo $slider_transition_speed; ?>">
				
			<?php
				
				$caption_style = uxbarn_get_array_value( get_post_meta( $post_id, 'uxbarn_fullscreen_slider_caption_style' ), 0 );
				//echo var_dump($slides);
				foreach ( $slides as $slide ) {
					
					$title = $slide['title'];
					$caption_text = $slide['uxbarn_fullscreen_slider_caption_text'];
					$optional_link_text = $slide['uxbarn_fullscreen_slider_caption_optional_link_text'];
					$optional_link_url = $slide['uxbarn_fullscreen_slider_caption_optional_link_url'];
					$caption_color = $slide['uxbarn_fullscreen_slider_caption_color'];
					$caption_display = $slide['uxbarn_fullscreen_slider_caption_display'];
					$slide_type = isset($slide['uxbarn_fullscreen_slider_slide_type']) ? $slide['uxbarn_fullscreen_slider_slide_type'] : 'image';
					$slide_image_url = $slide[ $slider_image_id ];
					$video_cover_image_url = isset($slide['uxbarn_fullscreen_slider_video_cover_image']) ? $slide['uxbarn_fullscreen_slider_video_cover_image'] : '';
					$video_clip_url = isset($slide['uxbarn_fullscreen_slider_video_upload']) ? $slide['uxbarn_fullscreen_slider_video_upload'] : '';
					
					// Prepare caption color style attributes
					$caption_color_style = '';
					$button_color_style = '';
					$border_color_style = '';
					
					if ( $caption_color != '' ) {
						
						$caption_color_style = ' style="color: ' . $caption_color . ';" ';
						$button_color_style = ' style="border-color: ' . $caption_color . '; color: ' . $caption_color . '; opacity: 1;" ';
						$border_color_style = ' style="border-color: ' . $caption_color . ';" ';
						
					}
					
					// Prepare title tag
					$title_tag = '';
					if ( $title != '' ) {
						$title_tag = '<h2 class="caption-title" ' . $caption_color_style . '>' . $title . '</h2>';
					}
					
					// Prepare optional link tag
					$optional_link_tag = '';
					if ( $optional_link_text != '' ) {
						$optional_link_tag = '<p><a href="' . $optional_link_url . '" class="small button" ' . $button_color_style . ' target="_blank">' . $optional_link_text . '</a></p>';
					}
					
					// Prepare caption text tag
					$caption_text_tag = '';
					if ( $caption_text != '' ) {
						$caption_text_tag =
							'<div class="caption-body">
								<p ' . $caption_color_style . '>
									' . $caption_text . '
								</p>
								' . $optional_link_tag . '
							</div>';
					}
					
					// Condition to create the caption tag
					$caption_tag = '';
					if ( $caption_display == 'on' ) {
						
						$caption_style_class_name = '';
						
						if ( $caption_style == 'normal' ) {
							$caption_style_class_name = ' image-caption-style ';	
						}
						
						if ( $title_tag != '' || $caption_text_tag != '' ) {
							
							$caption_tag = 
								'<div class="slide-caption-wrapper ' . $caption_style_class_name . '"><div class="slide-caption" ' . $border_color_style . '>
									' . $title_tag . $caption_text_tag . '
								</div></div>';
								
						}
						
					
					}
					
					// Slide image tag: Default to none
					//$slide_image_tag = '<img src="' . UXB_THEME_ROOT_IMAGE_URL . 'placeholders/2048x1365.gif" alt="" />';
					$slide_image_tag = '';
					
					// If it is video type, assign the cover image value to be used as normal slide image
					if ( $slide_type == 'video' ) {
						$slide_image_url = $video_cover_image_url;
					}
					
					if ( $slide_image_url != '' ) {
						
						$attachment_id = uxbarn_get_attachment_id_from_src( $slide_image_url );
						
						if ( isset( $attachment_id ) ) {
							// Get full image tag from the uploaded one
							$slide_image_tag = wp_get_attachment_image( $attachment_id, 'theme-fullscreen-image', false );
						} else { // else, manually create an img tag using the entered URL
							$slide_image_tag = '<img src="' . $slide_image_url . '" />';
						}
						
					}

					
					// For video type
					$video_attr = '';
					
					if ( $video_clip_url != '' ) {
						
						wp_enqueue_script( 'uxbarn-videojs' );
						wp_enqueue_script( 'uxbarn-bigvideojs' );
						
						$video_attr = ' data-video="' . $video_clip_url . '" ';
						
					}
					
					// Finally, print out the code for the slide
					echo
						'<div class="full-scrn-slide full-scrn" ' . $video_attr . '>
							' . $caption_tag . $slide_image_tag . '
						</div>';
					
				} // Loop to the next one
			
			?>
				
			</div>
			<!-- End id="full-scrn-slider" -->
			
			<div id="full-scrn-bullets"></div>
		</div>
		<!-- End id="full-scrn-slider-container" -->
	
	<?php else : // else if there is no slide ... ?>
	
		<?php if ( is_404() || is_search() || is_tax( 'uxbarn_portfolio_tax' ) ) : // And if it is 404, search template, or portfolio category template, then display its fullscreen background image ?>
			
			<?php 
			
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

			?>
			
			<?php if ( $slide_image_url != '' ) : ?>
				
				<div id="full-scrn-slider-container">
					<div id="full-scrn-slider">
						<div class="full-scrn-slide full-scrn">
							
							<?php
							
								$attachment_id = uxbarn_get_attachment_id_from_src( $slide_image_url );
								//echo var_dump($attachment_id);
								// Get full image tag
								$slide_image_tag = wp_get_attachment_image( $attachment_id, 'theme-fullscreen-image', false );
								echo $slide_image_tag;
								
							?>
							
						</div>
					</div>
				</div>
			
			<?php endif; // END: if ( $slide_image_url != '' ) : ?>
			
		<?php endif; // END: if ( is_404() || is_search() ) ?>
	
	<?php endif; // END: if ( ! empty( $slides ) ) ?>



	<div id="root-container">
		<div id="inner-container">
			
			<!-- Side Panel -->
			<div id="side-container">
				<div id="logo-wrapper">
					<a href="<?php echo esc_url( home_url() ); ?>">
						
						<?php
                        
                            $logo_url = get_option( 'uxbarn_sc_panel_site_logo' );
							
                            if ( $logo_url ) {
                            	
								$attachment_id = uxbarn_get_attachment_id_from_src( $logo_url );
								$image_array = wp_get_attachment_image_src( $attachment_id, 'full' );
	                            
                                echo '<img src="' . $logo_url . '" alt="' . get_bloginfo( 'name' ) . '" title="' . get_bloginfo( 'name' ) . '" width="' . $image_array[1] . '" height="' . $image_array[2] . '" />';
                            } else {
                                echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
                            }
                        
                        ?>
                        
					</a>
					
					<?php 
						
						if ( function_exists( 'ot_get_option' ) ) {
							$display_tagline = ot_get_option( 'uxbarn_to_setting_display_tagline', 'on' );
						} else {
							$display_tagline = 'on';
						}
						
					?>
					
					<?php if ( $display_tagline == 'on' ) : ?>
					<span id="tagline"><?php echo get_bloginfo( 'description' ); ?></span>
					<?php endif; ?>
					
				</div>
				<div id="menu-wrapper">
					
					<?php uxbarn_render_nav_menu(); ?>
					
					<nav id="mobile-menu" class="top-bar">
					    <ul class="title-area">
					        <!-- Do not remove this list item -->
					        <li class="name"></li>
					        
					        <!-- Menu toggle button -->
					        <li class="toggle-topbar menu-icon">
					            <a href="#"><span><?php _e( 'Menu', 'uxbarn' ); ?></span></a>
					        </li>
					    </ul>
					    
					    <!-- Mobile menu's container -->
					    <section class="top-bar-section"></section>
					</nav>
					
				</div>
				<div id="side-footer-wrapper">
					
					<?php
					
						if ( function_exists( 'ot_get_option' ) ) {
							$display_wpml_lang_selector = ot_get_option( 'uxbarn_to_setting_display_theme_wpml_lang_selector' );
						} else {
							$display_wpml_lang_selector = 'off';
						}
					
					?>
					
					<?php if ( function_exists( 'icl_get_languages' ) && $display_wpml_lang_selector == 'on' ) : // If WPML plugin is active, display lang selector. ?>
			            <div id="wpml-language-selector">
			            	<?php do_action( 'icl_language_selector' ); ?>
			            </div>
		            <?php endif; ?>
					
					<?php
						
						$social_string = uxbarn_get_footer_social_list_string();
					
					?>
					
					<?php if ( $social_string != '' ) : ?>
						<!-- Social Icons -->
						<ul class="bar-social">
							<?php echo $social_string; ?>
						</ul>
					<?php endif; ?>
                    <!-- Copyright Text -->
					<span id="copyright">
						<?php
						
							$copyright_text = __( '2014 &copy; Kose.<br/>Premium Theme by <a href="http://themeforest.net/user/UXbarn?ref=UXbarn">UXbarn</a>.', 'uxbarn' );
						
							if ( function_exists( 'ot_get_option' ) ) {
								echo wp_kses_post( ot_get_option( 'uxbarn_to_setting_copyright_text', $copyright_text ) );
							} else {
								echo $copyright_text;
							}
						
						?>
					</span>
					
				</div>
			</div>
			<!-- END: id="side-container" -->
			
			<?php if ( ! is_404() ) : // If it is not 404 template, display this content area ?>
				
				<?php if ( $toggle_button_display == '' || $toggle_button_display == 'on' ) : ?>
					<!-- Content Toggle Buttons -->
					<div id="content-toggle-buttons">
						<a href="javascript:;" id="hide-toggle-button"><i class="icon ion-ios7-close-empty"></i></a>
					</div>
				<?php endif; ?>
				
				<?php if ( ! $hide_content_tags ) :  ?>
				
					<!-- Content Area -->
					<div id="content-container" <?php echo $display_content_area_class; ?>>
						<div id="inner-content-container">
							
							<?php get_template_part( 'template-intro' ); ?>
							
							<!-- Actual Content Area -->
							<div id="actual-content-area" class="row">
							
				<?php endif; // END: if ( ! $show_content_tags ) ?>
							
			<?php endif; // END: if ( ! is_404() )  ?>
			