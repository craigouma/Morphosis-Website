<?php
$output = $color = $el_class = $css_animation = '';
extract(shortcode_atts(array(
    'color' => 'alert-info',
    'el_class' => '',
    'css_animation' => ''
), $atts));
$el_class = $this->getExtraClass($el_class);

switch( $color ) {
	case 'alert-info' : $color = 'info'; break;
	case 'alert-block' : $color = 'warning'; break;
	case 'alert-success' : $color = 'success'; break;
	case 'alert-error' : $color = 'error'; break;
	default : $color = 'info'; break;
}

$css_animation .= $this->getCSSAnimation($css_animation);

echo '<div data-alert class="' . $color . ' ' . $css_animation . ' ' . $el_class . ' box"><a href="#" class="close">&times;</a>' . wpb_js_remove_wpautop( $content, true ) . '</div>';