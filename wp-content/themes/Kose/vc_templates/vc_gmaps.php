<?php
$output = $title = $link = $size = $zoom = $type = $bubble = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'link' => 'https://maps.google.com/maps?q=New+York&hl=en&sll=40.686236,-73.995409&sspn=0.038009,0.078192',
    'size' => 200,
    'zoom' => 14,
    'type' => 'm',
    'bubble' => '',
    'el_class' => '',
    
	'latitude' => '40.714353',
	'longitude' => '-74.005973',
    'address' => '',
), $atts));

switch( $type ) {
	case 'm' : $type = 'ROADMAP'; break;
	case 'k' : $type = 'SATELLITE'; break;
	case 'p' : $type = 'HYBRID'; break;
	case 'TERRAIN' : $type = 'TERRAIN'; break;
	default : $type = 'ROADMAP'; break;
}

echo '<div class="google-map ' . $el_class . ' border" data-latlng="' . $latitude . ', ' . $longitude . '" data-address="' . $address . '" data-display-type="' . $type . '" data-zoom-level="' . $zoom . '" data-height="' . $size . '"></div>';
    