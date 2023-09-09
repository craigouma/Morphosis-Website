<?php get_header(); ?>

<div id="uxb-port-inner-content-container">
	
	<?php echo apply_filters( 'uxb_port_tax_title', null ); ?>
	
	<div class="row">
        <div class="uxb-col large-12 columns">
        	
        	<div class="uxb-port-root-element-wrapper related-items col4">
            	<span class="uxb-port-loading-text"><span><?php _e( 'Loading', 'uxb_port' ); ?></span></span>
                <div class="uxb-port-element-wrapper">
                	
                	<?php
                		
                		while ( have_posts() ) {
		                	
		                    the_post();
		                    
		                    $thumbnail = '';
							
		                    if ( has_post_thumbnail( get_the_ID() ) ) {
		                        $thumbnail = get_the_post_thumbnail( get_the_ID(), 'uxb-port-related-items', array( 'alt'=>get_the_title() ) );
		                    } else {
		                        $thumbnail = '<img src="' . UXB_PORT_URL . 'images/placeholders/port-related-item.gif" alt="' . __( 'No Thumbnail', 'uxb_port' ) . '" />';
		                    }
		                    
		                    echo 
		                    '<div class="uxb-port-element-item border">
		                        <div class="uxb-port-element-item-hover">
		                        	<a href="' . get_permalink() . '"></a>
		                        	<div class="uxb-port-element-item-hover-info">
			                        	<hr/>
										<h4>' . get_the_title() . '</h4>
										<hr/>
									</div>
		                        </div>
		                        ' . $thumbnail . '
		                    </div>';
		                    
		                }
                	
                	?>
                	
            	</div>
        	</div>
        	
    	</div>
	</div>
</div>

<?php get_footer(); ?>