<?php get_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
    
<?php

    $member_id = get_the_ID();
    
    $thumbnail ='';
    $member_info_col_class = ' large-12 ';
	
	$member_image_url = uxb_team_get_array_value( get_post_meta( $member_id, 'uxbarn_team_single_page_image_upload' ), 0 );
    $member_image_tag = '';
	
    if ( $member_image_url != '' ) {
    	
        $member_info_col_class = ' large-7 ';
		$member_image_url = esc_url( $member_image_url );
		$member_image_tag = '<img src="' . $member_image_url . '" alt="' . get_the_title() . '" class="border" />';
		
    }
    
    $position = uxb_team_get_array_value( get_post_meta( $member_id, 'uxbarn_team_meta_info_position' ), 0 );
    $email = uxb_team_get_array_value( get_post_meta( $member_id, 'uxbarn_team_meta_info_email' ), 0 );
    
    $social_list_item_string = uxb_team_get_member_social_list_string( $member_id );

?>

<div id="uxb-team-single" class="row">
	
	<?php if ( $member_image_tag != '' ) : ?>
		
		<div id="uxb-team-single-photo" class="uxb-col large-5 columns">
	    	<?php echo $member_image_tag; ?>
	    </div>
	    
    <?php endif; ?>
    
    <div class="uxb-col <?php echo $member_info_col_class; ?> columns">
    
	    <div id="uxb-team-info">
	        <h1 class="uxb-team-name"><?php the_title(); ?></h1>
	        
	        <?php if ( trim( $position ) != '' ) : ?>
	            <h2 class="uxb-team-position light"><?php echo $position; ?></h2>
	        <?php endif; ?>
	        
	        <?php if ( trim( $email ) != '' ) : ?>
	        	
	            <p>
	                <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
	            </p>
	            
	        <?php endif; ?>
	        
	        <?php if ( $social_list_item_string != '' ) : ?>
	            
	            <ul class="uxb-team-social">
	                <?php echo $social_list_item_string; ?>
	            </ul>
	            
	        <?php endif; ?>
	    </div>

		<?php the_content(); ?>
	    
    </div>
    
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>