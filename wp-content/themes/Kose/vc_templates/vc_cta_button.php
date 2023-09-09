<?php
$output = $color = $icon = $size = $target = $href = $title = $call_text = $position = $el_class = '';
extract(shortcode_atts(array(
    'color' => '',
    'icon' => 'none',
    'size' => '',
    'target' => '_self',
    'href' => '',
    'title' => __('Button Text', "uxbarn"),
    'call_text' => '',
    'position' => 'cta_align_right',
    'el_class' => '',
    
	'uxb_color_line' => 'left-line',
    'display_button' => '',
    'uxb_icon' => '',
    'button_border' => '', // '', radius, round
    'button_custom_color' => '',
), $atts));

$el_class = $this->getExtraClass($el_class);

if($uxb_color_line == 'none') {
	$uxb_color_line = '';
}

$output = '<div class="cta-box ' . $el_class . ' ' . $uxb_color_line . '">';

$content_class = '';
if($display_button == 'false' || $position == 'cta_align_bottom') {
    $content_class = ' full-width ';
}


$output .= '<div class="cta-box-content ' . $content_class . '">' . $content . '</div>';

if($display_button == 'true') {
    
    if($title == '') {
        $title = 'Button Text';
    }
    
    $href = esc_url( $href );
    
    if($target == '_blank') {
	    $target = ' target="_blank"';
	} else {
	    $target = '';
	}
    
    if(trim($uxb_icon) != '' && trim($uxb_icon) != 'icon-') {
	    $uxb_icon = '<i class="' . $uxb_icon . '"></i> ';
	} else {
	    $uxb_icon = '';
	}
    
    $custom_color = '';
    if($color == 'custom') {
        $custom_color = ' style="background-color: ' . $button_custom_color . '" ';
    }
		
	if($color != '' && $color != 'custom') { // for "solid-red", "solid-green", etc.
		$color .= ' custom ';
	}
	
	
	switch( $size ) {
		case 'wpb_regularsize' : $size = ''; break;
		case 'btn-small' : $size = 'small'; break;
		case 'btn-large' : $size = 'large'; break;
		default : $size = ''; break;
	}
	
	
	switch( $position ) {
		case 'cta_align_right' : $position = 'right'; break;
		case 'cta_align_bottom' : $position = 'bottom'; break;
		default : $position = 'right'; break;
	}
		
    
    $output .= '<div class="cta-box-button ' . $position . ' ' . $size . '">';
    
    $output .= '<a href="' . $href . '" ' . $target . ' class="' . $color . ' ' . $size . ' ' . $button_border . ' button" ' . $custom_color . '>' . $uxb_icon . ' ' . $title . '</a>';
    
    $output .= '</div>'; // close "cta-box-button"
}

$output .= '</div>'; // close "cta-box"

echo $output;