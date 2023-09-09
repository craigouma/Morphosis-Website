<?php

	// Whether to prioritize Theme Options setting
	if ( function_exists( 'ot_get_option' ) ) {
		
		$override_with_theme_options = ot_get_option( 'uxbarn_to_setting_override_post_meta_info' );
		
		
		// Post meta info
		$show_meta_date = '';
		if ( $override_with_theme_options == 'on' ) {
		    $show_meta_date = ot_get_option( 'uxbarn_to_post_meta_info_date' );
		} else {
		    $show_meta_date = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_date' ), 0 );
		}
		
		$show_meta_author = '';
		if ( $override_with_theme_options == 'on' ) {
		    $show_meta_author = ot_get_option( 'uxbarn_to_post_meta_info_author' );
		} else {
		    $show_meta_author = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_author' ), 0 );
		}
		
		$show_meta_comment_count = '';
		if ( $override_with_theme_options == 'on' ) {
		    $show_meta_comment_count = ot_get_option( 'uxbarn_to_post_meta_info_comment' );
		} else {
		    $show_meta_comment_count = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_meta_info_comment' ), 0 );
		}
		
	} else {
		
		$override_with_theme_options = 'on';
		$show_meta_date = 'on';
		$show_meta_author = 'on';
		$show_meta_comment_count = 'on';
		
	}

?>

<?php if ( $show_meta_comment_count != 'off' || $show_meta_date != 'off' || $show_meta_author != 'off' ) : ?>

<ul class="blog-meta">
	
	<?php if ( $show_meta_date != 'off' ) : ?>
		
	    <li class="meta-date">
	    	<i class="fa fa-link rotatelink padright"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?>
	    </li>
    <?php endif; ?>
    
    <?php //if ( $show_meta_author != 'off' ) : ?>
	 	<!--<li class="meta-author">
	        <?php// _e( 'By', 'uxbarn' ); ?> <a href="<?php// echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php// echo get_the_author(); ?></a>
	    </li>-->
	    
    <?php //endif; ?>
    
    <?php if ( $show_meta_comment_count != 'off' ) : ?>
    	
	    <li class="meta-comments">
	        <i class="fa fa-comments padright"></i><a href="<?php comments_link(); ?>"><?php comments_number( __( '0', 'uxbarn' ), __( '1', 'uxbarn' ), __( '%', 'uxbarn' ) ); ?></a>
	    </li>
	    
    <?php endif; ?>
    <?php
    $post_categories = wp_get_post_categories( $post->ID );
	$cats = array();
	foreach($post_categories as $c){
	$cat = get_category( $c );
	$cats[] = $cat->slug;
	}
	?>
    <?php 
   	 $post_excerpt = uxbarn_get_array_value( get_post_meta( $post->ID, 'uxbarn_post_excerpt' ), 0 );
	 $theexcerpt;
	 if ( trim( $post_excerpt) != '' ) $theexcerpt = wp_kses_post( $post_excerpt );
	 else $theexcerpt = get_the_excerpt($post->ID);
	?>
    <li><i class="fa fa-tag padright"></i><?php if(count($cats)!=1)echo implode(", ", $cats); else echo $cats[0]; ?></li>
    <li class="floatr">
    <div class="socialicons"><i class="fa fa-facebook fb_link" onclick="return fbs_click('<?php the_permalink( $post->ID); ?>','<?php the_title( $post->ID); ?>')"></i>
     <a class='twitter_link' href='http://twitter.com/share?text=<?php echo $theexcerpt; ?>&url=<?php the_permalink( $post->ID); ?>' target='_blank'><i class='fa fa-twitter'></i></a>
    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink( $post->ID); ?>&title=<?php the_title($post->ID); ?>&source=http://brand2dlabs.com/morphosis" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-linkedin"></i></a>
    </div>
    <div class="share"><i class="fa fa-plus padright"></i>Share</div></li>
</ul>

<?php endif; ?>