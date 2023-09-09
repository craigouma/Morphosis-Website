<?php get_header(); ?>

<?php

    // Preparing blog sidebar variables
    if ( function_exists( 'ot_get_option' ) ) {
    	$sidebar_location = ot_get_option( 'uxbarn_to_setting_blog_sidebar' );
	} else {
		$sidebar_location = 'right';
	}
    
    $content_class ='';
    $sidebar_class = '';
    $content_column_class = ' large-9 ';
    
    //global $uxbarn_blog_thumbnail_size;
    $uxbarn_blog_thumbnail_size = 'theme-blog-thumbnail';
	$blog_thumbnail_class = '';
	
	$blog_sidebar_id = 'uxbarn-blog-sidebar';
    
	if ( $sidebar_location != 'none' ) {
    	
        if ( $sidebar_location == 'left' ) {
            
            $content_class =' push-3 ';
            $sidebar_class = ' pull-9 ';
            
        }
        
        $content_class .= ' with-sidebar ';
        
    } else {
    	
        $content_column_class = ' large-12 ';
		$blog_thumbnail_class = ' full ';
		
    }
    
?>

	<!-- Blog List -->
    <div class="uxb-col <?php echo $content_column_class; ?> columns <?php echo $content_class; ?>">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <?php 
                
                $post_excerpt = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_excerpt' ), 0 );
				$post_video = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_portfolio_meta_video' ), 0 );
				parse_str( parse_url( $post_video, PHP_URL_QUERY ), $url_vars );
				//$videoout = $url_vars['v']; 
				$videoout = '<iframe style="width:100%; height:auto;" src="//www.youtube.com/embed/'.$url_vars['v'].'" frameborder="0" allowfullscreen></iframe>';
                
            ?>
            
            <div id="blog-list-wrapper" <?php post_class(); ?> >
                
                <div class="blog-item">
                    <div class="postype">
                    <?php if(in_category( 'photo', $post->ID )){ ?>
                    <img src="<?php echo get_template_directory_uri().'/images/camera.png'; ?>"/>
                    <?php } else if(in_category( 'video', $post->ID )){?>
                    <img src="<?php echo get_template_directory_uri().'/images/video.png'; ?>"/>
                     <?php } else{?>
                     <img src="<?php echo get_template_directory_uri().'/images/quote.png'; ?>"/>
                     <?php } ?>
                    </div>
                    <div class="blog-info">
		                    
	                    <?php if ( is_sticky() && !is_archive() ) : ?>
	                        
	                        <div class="sticky-badge">
	                            <i class="ion-pin" title="<?php _e( 'Sticky Post', 'uxbarn' ); ?>" alt="<?php _e( 'Sticky Post', 'uxbarn' ); ?>"></i>
	                        </div>
	                        
	                    <?php endif; ?>
	                    
	                    <?php if (!empty($post_video) && in_category( 'video', $post->ID )){?>
                        <div class="blog-thumbnail <?php echo $blog_thumbnail_class; ?>">
                        <?php echo $videoout; ?></div>
					    <?php }else{?>
                        <?php if (has_post_thumbnail()) : ?>
		                    <div class="blog-thumbnail <?php echo $blog_thumbnail_class; ?>">
								<a href="<?php echo get_permalink(); ?>" class="image-link">
							<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', true ); ?>
                               <img src="<?php echo $image_src[0]; ?>" style="width:100%; height:auto;" />
                                </a>
		                	</div>
                        <?php endif; } ?>
	                    
                    	<div class="blog-title-excerpt">
                    		<h2 class="blog-title">
                    			<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                			</h2>
                			<div class="excerpt">
			                    <?php 
			                    
			                        if ( trim( $post_excerpt) != '' ) {
			                            echo wp_kses_post( $post_excerpt );
			                        } else {
			                            the_excerpt();
			                        }
			                        
			                    ?>
		                    </div>
                            <?php get_template_part( 'template-blog-meta' ); ?>
		                   <!-- <a class="readmore-link" href="<?php// echo get_permalink(); ?>"><?php// _e( 'Read more', 'uxbarn' ); ?></a>-->
                    	</div>
                    	
                    </div>
                    
                </div>
                
            </div>
            
        <?php endwhile; ?>
        
        <?php get_template_part( 'template-pagination' ); ?>
        
        <?php else : ?>
            
            <div class="blog-item row">
                <div class="uxb-col large-12 columns">
                    <h3><?php _e( 'Sorry, there are no posts available.', 'uxbarn' ); ?></h3>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
    
    <?php if ( $sidebar_location != 'none' ) : ?>
        
        <div id="sidebar-wrapper" class="uxb-col large-3 columns <?php echo $sidebar_class; ?>">
            <?php get_sidebar(); ?>
        </div>
        
    <?php endif; ?>
    
<?php get_footer(); ?>