<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'use_as' => 'accordion',
    'collapsible' => 'no',
    'active_section' => '1',
    'expanded' => 'true'
), $atts));

$el_class = $this->getExtraClass($el_class);
/*$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element '.$el_class.' not-column-inherit', $this->settings['base']);

$output .= "\n\t".'<div class="'.$css_class.'" data-collapsible='.$collapsible.'>'; //data-interval="'.$interval.'"
$output .= "\n\t\t".'<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');
*/

if($use_as == 'accordion') {
    
    if($collapsible == 'yes') {
        $collapsible = ' data-collapsible="true" ';
        //$output = '<div class="toggle ' . $expanded . '">';
    } else {
        $collapsible = '';
    }

    if(trim($active_section) != '') {
        if(!is_numeric($active_section)) {
            $active_section = 1;
        } else {
            $active_section = $active_section - 1; // make it as index based
        }
    }
    
    $output = '<div class="accordion ' . $el_class . ' " data-active-index="' . $active_section . '" ' . $collapsible . '>';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>';
    
} else {
        
    if($expanded == 'true') {
        $expanded = ' active ';
    } else {
        $expanded = '';
    }
    
    $output = '<div class="toggle ' . $expanded . ' ' . $el_class . '">';
    $output .= wpb_js_remove_wpautop($content);
    $output .= '</div>';
}

echo $output;