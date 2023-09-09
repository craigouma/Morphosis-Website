<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract(shortcode_atts(array(
    'color' => '',
    'size' => '',
    'target' => '_self',
    'href' => '',
    'el_class' => '',
    'title' => __('Button Text', 'uxbarn'),
    
    'uxb_icon' => '',
    'button_border' => '', // '', radius, round
    'expanded' => 'false', // true, false
    'button_custom_color' => '',
    'alignment' => '',
    //'position' => ''
), $atts));

if(trim($title) == '') {
    $title = __('Button Text', 'uxbarn');
}

/*if(trim($link) == '' || trim($link) == 'http://' || trim($link) == '#') {
    $link = '#';
} else {
    if(strpos($link,'http://') === false) {
        $link = 'http://' . $link;
    }
}*/
$href = esc_url( $href );

if($target == '_blank') {
    $target = ' target="_blank"';
} else {
    $target = '';
}

if($expanded == 'true') {
    $expanded = 'expand';
} else {
    $expanded = '';
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
	case 'btn-tiny' : $size = 'tiny'; break;
	case 'btn-small' : $size = 'small'; break;
	case 'btn-large' : $size = 'large'; break;
	default : $size = ''; break;
}


$alignment_start = '';
$alignment_end = '';

if ( $alignment == 'center' ) {
	
	$alignment_start = '<div class="center">';
	$alignment_end = '</div>';
	
} else if ( $alignment == 'right' ) {
	
	$alignment_start = '<div class="right">';
	$alignment_end = '</div>';
	
}

echo $alignment_start . '<a' . $target. ' href="' . $href . '" class="'. $size . ' ' . $color . ' ' . $button_border . ' ' . $expanded . ' '. $el_class . ' button" ' . $custom_color . '>' . $uxb_icon . $title . '</a>' . $alignment_end;