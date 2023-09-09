<?php
$output = $uxb_theme_class = $el_class = '';
extract(shortcode_atts(array(
    'uxb_theme_class'=>'',
    'el_class' => '',
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);
//echo var_dump($uxb_theme_class);
$uxb_theme_class = str_replace(',', ' ', $uxb_theme_class);
//echo var_dump($uxb_theme_class);

$output .= '<div class="'.$css_class.' ' . $uxb_theme_class . '">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');

echo $output;