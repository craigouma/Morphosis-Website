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
                
            ?>
            
            <div id="blog-list-wrapper" <?php post_class(); ?> >
                
                <div class="blog-item">
                    <div style="border-radius: 2px;padding: 1px;background: #d874af;display: inline;float: left;margin: 10px 15px 0 0;"><img src="<?php echo get_template_directory_uri().'/images/video.png'; ?>" style="padding: 6px 9px;border: 1px solid rgba(255,255,255,0.4);"/></div>
                    <div class="blog-info">
		                    
	                    <?php if ( is_sticky() && !is_archive() ) : ?>
	                        
	                        <div class="sticky-badge">
	                            <i class="ion-pin" title="<?php _e( 'Sticky Post', 'uxbarn' ); ?>" alt="<?php _e( 'Sticky Post', 'uxbarn' ); ?>"></i>
	                        </div>
	                        
	                    <?php endif; ?>
	                    
	                    <?php if ( has_post_thumbnail() ) : ?>
		                    <div class="blog-thumbnail <?php echo $blog_thumbnail_class; ?>">
								<a href="<?php echo get_permalink(); ?>" class="image-link"><?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?></a>
		                	</div>
					    <?php endif; ?>
	                    
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