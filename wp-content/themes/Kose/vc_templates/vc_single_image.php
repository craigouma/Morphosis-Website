<?php

$output = $el_class = $image = $img_size = $has_link = $img_link = $link_type = $css_animation = '';

extract(shortcode_atts(array(
    'image' => $image,
    'img_size'  => 'thumbnail',
    'image_position' => '',
    'has_link' => 'false', // true, false
    'img_link' => '', // to any url
    'link_type' => 'normal', // normal, normal-window, image
    'el_class' => '',
    'css_animation' => '',
), $atts));

$img_size = trim($img_size);

$img_id = preg_replace('/[^\d]/', '', $image);

$el_class = $this->getExtraClass($el_class);

$img_array = wp_get_attachment_image_src($img_id, $img_size);

$img_src = $img_array[0];

$css_animation .= $this->getCSSAnimation($css_animation);

//$image_class .= ' ' . $css_animation;
$image_class = ' ';

$attachment = uxbarn_get_attachment($img_id);

$alt = $attachment['alt']; //trim(esc_attr(strip_tags( get_post_meta($img_id, '_wp_attachment_image_alt', true) )));
$title = $attachment['title'];
$caption = $attachment['caption'];
    
$output = '<img src="' . $img_src . '" alt="' . $alt . '" ' . $image_class . ' width="' . $img_array[1] . '" height="' . $img_array[2] . '" />';

if($has_link == 'true') {
    
    $target = '';
    if($link_type == 'normal-window') {
        $target = ' target="_blank" ';
    }
    
    $lightbox_class = '';
    if($link_type == 'image') {
        $lightbox_class = ' image-box ';
        $img_link = wp_get_attachment_image_src($img_id, 'full');
        $img_link = $img_link[0];
        
    } else {
    	
		$img_link = esc_url( $img_link );
            
        /*if(trim($img_link) == '' || trim($img_link) == 'http://' || trim($img_link) == '#') {
            $img_link = '#';
        } else {
            if(strpos($img_link,'http://') === false) {
                $img_link = 'http://' . $img_link;
            }
        }*/
    }

    $class = ' class="' . $lightbox_class . ' image-link"';
    
    if($title != '') {
        $title = ' title="' . $title . '" ';
    }
    
    $output = '<a href="' . $img_link . '" ' . $target . $class . ' ' . $title . '>' . $output . '</a>';

}

if($caption != '') {
	$output .= '<div class="image-caption-wrapper"><div class="image-caption">' . $caption . '</div></div>';
}

echo '<div class="vc_single_image ' . $image_position . ' ' . $el_class . ' ' . $css_animation . '">' . $output . '</div>';