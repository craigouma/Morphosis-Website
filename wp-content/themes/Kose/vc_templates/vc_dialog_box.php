<?php

$output = $color = $el_class = $css_animation = '';

extract(shortcode_atts(array(
	'the_title' => '',
    'el_class' => '',
), $atts));

$el_class = $this->getExtraClass($el_class);
    
echo '<div id="somedialog" class="dialog vc_dialog_box ' . $el_class . '">
					<div class="dialog__overlay"></div>
					<div class="dialog__content"><h2>'.$the_title.'</h2>' .wpb_js_remove_wpautop( $content, true ). '
					<div><button class="action" data-dialog-close><i class="ion-close"></i></button></div>
		</div>
			</div>';