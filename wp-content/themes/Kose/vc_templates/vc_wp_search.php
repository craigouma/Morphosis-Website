<?php
$output = $title = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'el_class' => ''
), $atts ) );

$title_output = '<h3>' . $title . '</h3>';
if( empty( $title ) ) {
	$title_output = '';
}

echo '<div class="search-element">' . $title_output . '<form method="get" action="' . esc_url(home_url('')) . '">
            <span>
                <input type="text" name="s" placeholder="' . esc_attr(__('type and hit enter ...', 'uxbarn')) . '" value="' . trim( get_search_query() ) . '" />
            </span>
        </form>
    </div>';
