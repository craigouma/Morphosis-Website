<?php
$output = $type = $onclick = $img_size = $images = $el_class = $interval = $grid_style = $columns = '';
extract(shortcode_atts(array(
    //'title' => '',
    'type' => 'image_grid',
    'onclick' => 'link_image',
    //'custom_links' => '',
    //'custom_links_target' => '',
    'img_size' => 'theme-large-square',
    'images' => '',
    'el_class' => '',
    'interval' => '5',
    
	'grid_style' => 'circle',
	'columns' => '4',
	'show_bullets' => 'true',
), $atts));



$gallery_id = 'gallery_id_' . rand(0, 100000);
$images = explode(',', $images);

$output = '';

$lightbox_class = '';
if($onclick == 'link_image') {
    $lightbox_class = ' class="image-box" rel="' . $gallery_id . '" ';
}

$target = '';
if($onclick == 'link_image_window') {
    $target = ' target="_blank" ';
}

if($type == 'image_grid') { // grid type
    
    $output .= '<div class="gallery-wrapper ' . $grid_style . ' ' . $columns . ' ' . $el_class . '">';
    
    $col_num = preg_replace('/[^\d]/', '', $columns); // get only number
    
    foreach($images as $attachment_id) {
        
        $attachment = uxbarn_get_attachment($attachment_id);

        $img_tag = wp_get_attachment_image($attachment_id, 'theme-blog-thumbnail');
        //$alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ));
        $title = $attachment['title'];
        
        if($title != '') {
            $title = ' title="' . $title . '" ';
        }
        
        //$output .= '<div class="gallery-item-wrapper">
        $output .= '<div class="gallery-item">';
        
        if($onclick == 'link_no') {
            $output .= $img_tag;
        } else {
            // Got an array [0] => url, [1] => width, [2] => height
            $img_fullsize = wp_get_attachment_image_src($attachment_id, 'full');
            
            $output .= '<a href="' . $img_fullsize[0] . '"' . $lightbox_class . $target . $title . '>' . $img_tag . '</a>';
            
        }
        
        $output .= '</div>'; // close "gallery-item"
        
        if($attachment['caption'] != '') {
        	$output .= '<div class="image-caption">' . $attachment['caption'] . '</div>';
		}
        
        //$output .= '</div>'; // close "gallery-item-wrapper"
    }
    
    $output .= '</div>'; // close "gallery-x-wrapper"

} else { // slider type

	$transition_effect = 'fade';
	if( $type == 'flexslider_slide' ) {
		$transition_effect = 'slide';
	}
	
	if( $show_bullets == 'false' ) {
		$show_bullets = ' hide-bullets ';
	}
	
    $output .= '<div class="image-slider-root-container ' . $el_class . '">';
	$output .= '<div class="image-slider-wrapper slider-set ' . $show_bullets . '" data-auto-rotation="' . $interval . '" data-effect="' . $transition_effect . '">';
    $output .= '<ul class="image-slider">';
    
    foreach($images as $attachment_id) {
        
        $attachment = uxbarn_get_attachment($attachment_id);
       
		$img_fullsize = $attachment['src']; 
		
		// Get an array: [0] => url, [1] => width, [2] => height
        $img_thumbnail = wp_get_attachment_image_src($attachment_id, $img_size);
        
        $title = $attachment['title']; //trim(esc_attr(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )));
        
        $anchor_title = '';
        if($title != '') {
            $anchor_title = ' title="' . $title . '" ';
        }
        
		
		// $output .= '<div class="image-slider-item" style="width: ' . $img_thumbnail[1] . 'px;">';
		
		
		/*if($size == 'full') {
			$output .= '<div class="image-slider-item" style="width: ' . $img_thumbnail[1] . 'px;">';
		} else {
			$output .= '<div class="image-slider-item" style="width: ' . $img_thumbnail[1] . 'px; height: ' . $img_thumbnail[2] . 'px;">';
		}*/
		
		// Don't need to apply "width" or "height" here, it's aleady done in css for 100% width.
		$output .= '<li class="image-slider-item">';
		
        //$img_class = ' class="border" ';
        $img_class = '';
		
        /*$stretch_img_class = '';
        if($stretch_image != '' ) {
            $stretch_img_class = ' stretch-image ';
            $img_class = ' class="' . $stretch_img_class . '" ';
        }*/
        
        $img_tag = '<img src="' . $img_thumbnail[0] . '" ' . $img_class . ' alt="' . $attachment['alt'] . '" width="' . $img_thumbnail[1] . '" height="' . $img_thumbnail[2] . '" />';
        
        if($onclick == 'link_no') {
            $output .= $img_tag;
            
        } else {
            
            $output .= '<a href="' . $img_fullsize . '"' . $lightbox_class . $target . $anchor_title . '>' . $img_tag . '</a>';
        }
        
        if(trim($attachment['caption']) != '') {
            $output .= '<div class="image-caption-wrapper"><div class="image-caption">' . $attachment['caption'] . '</div></div>';
        }
        
        $output .= '</li>'; // close "image-slider-item"
        
    }
    
    $output .= '</ul>'; // close "image-slider"
    $output .= '</div>'; // close "image-slider-wrapper slider-set"
    $output .= 
            	'<a href="#" class="slider-controller slider-prev"><i class="ion-ios7-arrow-left"></i></a>
				<a href="#" class="slider-controller slider-next"><i class="ion-ios7-arrow-right"></i></a>';
    $output .= '</div>'; // close "image-slider-root-container"
    
}



echo $output;