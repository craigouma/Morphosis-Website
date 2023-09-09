<form id="form-404" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="row">
        <div class="uxb-col large-12 columns">
            <input type="text" name="s" placeholder="<?php echo esc_attr( __( 'type and hit enter to search ...', 'uxbarn' ) ); ?>" value="<?php echo trim( get_search_query() ); ?>" class="search-field" />
        </div>
    </div>
</form>