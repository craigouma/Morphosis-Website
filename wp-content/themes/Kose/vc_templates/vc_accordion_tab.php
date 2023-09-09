<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "uxbarn")
), $atts));

/*$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#">'.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "uxbarn") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";*/
    
// Moved to functions.php
//wp_enqueue_script('jquery-ui-accordion');
    
$output = '<h3><a href="#">'.$title.'</a></h3>';
$output .= '<div>' . wpb_js_remove_wpautop($content) . '</div>';

echo $output;