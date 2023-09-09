<?php
//$output = $title = $interval = $el_class = '';
$output = $el_class = '';
extract(shortcode_atts(array(
    //'title' => '',
    //'interval' => 0,
    'el_class' => ''
), $atts));

//wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
/*$tabs_nav = '';
$tabs_nav .= '<ul class="wpb_tabs_nav ui-tabs-nav clearfix">';
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    if(isset($tab_matches[1][0])) {
        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

    }
}
$tabs_nav .= '</ul>'."\n";*/

/*$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.$el_class), $this->settings['base']);

$output .= "\n\t".'<div class="'.$css_class.'" data-interval="'.$interval.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs clearfix">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
$output .= "\n\t\t\t".$tabs_nav;
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
if ( 'vc_tour' == $this->shortcode) {
    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
}
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($element);
*/

$tab_mode = 'auto'; // default to normal tabs
$data_section = 'tabs';
if ($this->shortcode == 'vc_tour') {
    $tab_mode = ' vertical-tabs ';
    $data_section = $tab_mode;
}
    
$output = '<div class="section-container ' . $tab_mode . ' ' . $el_class . '" data-section="' . $data_section . '">';
// Need "html" wrapping the content to be extracted later
$content = '<html>' . wpb_js_remove_wpautop($content) . '</html>';
// Create a new dom object
$dom = new MyDOMDocument(); // Use our custom class instead to fix a "mysterious" output rendering issue when do "loadHTML()" below
$dom->validateOnParse = false;
// Discard white space
$dom->preserveWhiteSpace = false;

libxml_use_internal_errors(true);
// Load the html into the object
$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"); 
$dom->loadHTML($content); 
libxml_clear_errors();

foreach ($tab_titles as $tab) {
    // Extract page title from entire string. 
    // "$tab_matches[1][0]" is the final result for title.
    // "$tab_matches[3][0]" is for the unique ID for each tab.
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    // Extract tab content using tab ID
    $tab_content = $dom->getElementById($tab_matches[3][0]);
	
	$tab_content_output = '';
	if (version_compare(PHP_VERSION, '5.3.6', '<')) {
	    $tab_content_output = $dom->saveXML($tab_content);
	} else {
		$tab_content_output = $dom->saveHTML($tab_content);
	}
        
    $output .= '
        <section>
            <p class="title" data-section-title>
                <a href="#' . $tab_matches[3][0] . '">' . $tab_matches[1][0] . '</a>
            </p>
            <div class="content" data-section-content>
                ' . $tab_content_output . '
            </div>
        </section>';
    
}

$output .= '</div>'; // close "section-container auto"

echo $output;





