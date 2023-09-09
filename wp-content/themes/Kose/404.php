<?php get_header(); ?>

<div id="page-404">
	<div id="text-404">
		<div class="row">
            <div class="large-12 columns">
				<h1><?php _e( '404 Page Not Found', 'uxbarn' ); ?></h1>
                <p>
                    <?php _e( 'The requested page could not be found or it is currently unavailable.', 'uxbarn' ); ?>
                    <br/>
                    <?php printf(__('Please <a href="%s">click here</a> to go back to our home page or use the search form below.', 'uxbarn'), home_url()); ?>
                </p>
            </div>
      	</div>
	</div>
    <div id="search-form-404">
    	<?php get_template_part( 'searchform', '404' ); ?>
    </div>
</div>

<?php get_footer(); ?>