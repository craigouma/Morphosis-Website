<?php
$output = $uxb_theme_class = $el_class = $width = '';
extract(shortcode_atts(array(
    'uxb_theme_class'=>'',
    'el_class' => '',
    'width' => '1/1'
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$el_class .= ' wpb_column column_container';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);

$uxb_theme_class = str_replace(',', ' ', $uxb_theme_class);

$output .= "\n\t".'<div class="'.$css_class.' ' . $uxb_theme_class . '">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;