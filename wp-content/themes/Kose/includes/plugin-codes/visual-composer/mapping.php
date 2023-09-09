<?php

/* ORDER
 * -----------
 * Row (VC)
 * Heading (Ext. plugin)
 * Button (VC)
 * Icon (Ext. plugin)
 * Dialog Box (VC)
 * Image (VC)
 * Video (VC)
 * Blockquote
 * Message Box (VC)
 * Google Maps (VC)
 * Gallery (VC)
 * Flickr (VC)
 * Tabs (VC)
 * Vertical Tabs (VC)
 * Accordion / Toggles (VC)
 * Divider (Ext. plugin)
 * Pie Chart (VC)
 * Progress Bar (VC)
 * CTA Box (VC)
 * Portfolio (Ext. plugin)
 * Team Member (Ext. plugin)
 * Testimonial Slider (Ext. plugin)
 * Blog Posts (VC)
 * Search Form (VC)
 * Raw HTML (VC)
 * Raw JS (VC)
 * Contact Form 7 (VC)
 * LayerSlider (VC)
 * Gravity Forms (VC)
 */




// Row

vc_map( array(
  "name" => __("Row", "js_composer"),
  "base" => "vc_row",
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "show_settings_on_create" => false,
  "weight" => 3000,
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  ),
  "js_view" => 'VcRowView'
) );


// Button shortcode
vc_map( array(
  "name" => __("Button", "js_composer"),
  "base" => "vc_button",
  "icon" => "icon-wpb-ui-button",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    uxbarn_get_button_text(),
    uxbarn_get_link_param('', array('true')),
    uxbarn_get_open_new_window_param('', ''),
    uxbarn_get_button_color(),
    uxbarn_get_button_custom_color('color', array('custom')),
    uxbarn_get_button_size(),
    uxbarn_get_button_border_style(),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Expanded?', 'js_composer'),
         'param_name' => 'expanded',
         'value' => array(
                        __( 'No', 'js_composer' ) => '', 
                        __( 'Yes', 'js_composer' ) =>'true',
                    ),
         'description' => __('Whether to expand the button to fit the width of its containing column.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Alignment', 'js_composer'),
         'param_name' => 'alignment',
         'value' => array(
                        __( 'Left', 'js_composer' ) => '', 
                        __( 'Center', 'js_composer' ) =>'center',
                        __( 'Right', 'js_composer' ) =>'right',
                    ),
         'description' => __('Select the alignment for the button in its containing column.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'textfield',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Icon code', 'js_composer'),
         'param_name' => 'uxb_icon',
         'value' => '',
         'description' => sprintf(__('<a href="%s" target="_blank">Click here to see all available icons</a>. Just copy and paste the icon code into the text field. For example: <em>icon-asterisk</em>. Leave this field blank when not to use icon.', 'js_composer'), get_template_directory_uri() . '/css/Ionicons/cheatsheet.html' ),
         'admin_label' => false,
      ),
    uxbarn_get_extra_class_name(),
  ),
  "js_view" => 'VcButtonView'
) );


/*=================== Dialog Box ====================*/
vc_map( array(
	"name" => __("Popup Dialog", "js_composer"),
  	"base" => "vc_dialog_box",
 	"icon" => "icon-wpb-information-white",
  	"category" => __('Content', 'js_composer'),
	//'description' => __( 'Add a pop-up dialog box', 'js_composer' ),
	'params' => array(
		array(
             'type' => 'textfield',
             //'holder' => 'div',
             'class' => 'thetitle',
             'heading' => __('Title', 'js_composer'),
             'param_name' => 'the_title',
             'value' => '',
             'description' => __('Enter the title for the dialog box.', 'js_composer'),
          ),
		array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "messagebox_text",
      "heading" => __("Message text", "js_composer"),
      "param_name" => "content",
      "value" => __("The message goes here...", "js_composer")
    	),
	uxbarn_get_extra_class_name(),
	)
) );




// Single image 
wpb_map( array(
  'name' => __('Image', 'js_composer'),
  'base' => 'vc_single_image',
  'icon' => 'icon-wpb-single-image',
  'category' => __('Media', 'js_composer'),
  'params' => array(
    array(
      'type' => 'attach_image',
      'heading' => __('Image', 'js_composer'),
      'param_name' => 'image',
      'value' => '',
      'description' => __('Select image from media library.', 'js_composer'),
        'admin_label' => false,
    ),
    //uxbarn_get_image_border(),
    array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Image size', 'js_composer'),
         'param_name' => 'img_size',
         'value' => uxbarn_get_image_size_array(),
         'description' => __('Select the image size you want from the list.', 'js_composer'),
         'admin_label' => true,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Image position', 'js_composer'),
         'param_name' => 'image_position',
         'value' => array(
                        __('Left', 'js_composer') => 'normal-align-left', 
                        __('Center', 'js_composer') => 'normal-align-center',
                        __('Right', 'js_composer') => 'normal-align-right',
                        __('Float left (text will wrap around image)', 'js_composer') => 'alignleft',
                        __('Float right (text will wrap around image)', 'js_composer') => 'alignright',
                    ),
         'description' => __('Select how this image will be aligned.', 'js_composer'),
         'admin_label' => true,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Has link?', 'js_composer'),
         'param_name' => 'has_link',
         'value' => array(
                        __('No', 'js_composer') => 'false', 
                        __('Yes', 'js_composer') =>'true',
                    ),
         'description' => __('Whether to has a link on the image.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Link type', 'js_composer'),
         'param_name' => 'link_type',
         'value' => array(
                        __('Link to normal URL, same window', 'js_composer') => 'normal', 
                        __('Link to normal URL on a new window/tab', 'js_composer') => 'normal-window',
                        __('Link to its own full-size image file showing on lightbox', 'js_composer') => 'image',
                    ),
         'description' => __('Specify which type for the target link of this image.', 'js_composer'),
         'admin_label' => false,
         'dependency' => array(
                            'element' => 'has_link',
                            'value' => array('true'),
                        ),
      ),
      array(
             'type' => 'textfield',
             'holder' => 'div',
             'class' => '',
             'heading' => __('Target URL', 'js_composer'),
             'param_name' => 'img_link',
             'value' => '',
             'description' => __('Specify the target URL once the element is clicked. For example: <em>http://www.uxbarn.com</em>', 'js_composer'),
             'dependency' => array(
                                'element' => 'link_type',
                                'value' => array('normal', 'normal-window'),
                            ),
          ),
  	//uxbarn_get_link_param('link_type', array('normal', 'normal-window')), // Couldn't be used because the original VC use "img_link" instead of "href" here
	uxbarn_get_css_animation_param(),
    uxbarn_get_extra_class_name(),
  )
));


// Video
vc_map( array(
  "name" => __("Video", "js_composer"),
  "base" => "vc_video",
  "icon" => "icon-wpb-film-youtube",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Video link", "js_composer"),
      "param_name" => "link",
      "admin_label" => true,
      "description" => __('Enter the URL to your YouTube or Vimeo video here. <br/><br/>For example, <em>"http://www.youtube.com/watch?v=G_G8SdXktHg"</em> for YouTube. Or, <em>"http://www.vimeo.com/7449107"</em> for Vimeo.', "js_composer"),
    ),
    uxbarn_get_extra_class_name(),
    
  )
) );
 
 
 
 

// Message Box
vc_map( array(
  "name" => __("Message Box", "js_composer"),
  "base" => "vc_message",
  "icon" => "icon-wpb-information-white",
  "wrapper_class" => "alert",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Message box type", "js_composer"),
      "param_name" => "color",
      "value" => array(__('Info', "js_composer") => "alert-info", __('Warning', "js_composer") => "alert-block", __('Success', "js_composer") => "alert-success", __('Error', "js_composer") => "alert-error"),
      "description" => __("Select message type.", "js_composer")
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "messagebox_text",
      "heading" => __("Message text", "js_composer"),
      "param_name" => "content",
      "value" => __("The message goes here...", "js_composer")
    ),
  	uxbarn_get_css_animation_param(),
  	uxbarn_get_extra_class_name(),
  ),
  "js_view" => 'VcMessageView'
) );




// Google Maps
wpb_map( array(
   'name' => __('Google Map', 'js_composer'),
   'base' => 'vc_gmaps',
   'icon' => 'icon-wpb-map-pin',
   'class' => '',
   'category' => __('Content', 'js_composer'),
   'params' => array(
      array(
         'type' => 'textarea',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Address', 'js_composer'),
         'param_name' => 'address',
         'value' => '',
         'description' => __('By default, the theme will use this address field as a primary value for generating the map. For example: <em>Tillary St., New York, US</em>. <br/><strong>NOTE:</strong> In case you want to use latitude and logitude values below, just leave this field blank.', 'js_composer'),
      ),
      array(
         'type' => 'textfield',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Latitude', 'js_composer'),
         'param_name' => 'latitude',
         'value' => '',
         'description' => __('Enter the latitude value. <a href="http://itouchmap.com/latlong.html" target="_blank">Click here to find yours</a>', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'textfield',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Logitude', 'js_composer'),
         'param_name' => 'longitude',
         'value' => '',
         'description' => __('Enter the longitude value. <a href="http://itouchmap.com/latlong.html" target="_blank">Click here to find yours</a>', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Zoom level', 'js_composer'),
         'param_name' => 'zoom',
         'value' => array(
                        '7' => '7', 
                        '8' => '8',
                        '9' => '9',
                        '10' => '10',
                        '11' => '11', 
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                    ),
         'description' => __('Select the zoom level.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Display type', 'js_composer'),
         'param_name' => 'type',
         'value' => array(
                        __('Roadmap', 'js_composer') => 'm', 
                        __('Satellite', 'js_composer') => 'k',
                        __('Hybrid', 'js_composer') => 'p',
                        __('Terrain', 'js_composer') => 'TERRAIN',
                    ),
         'description' => __('Choose the display type.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'textfield',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Height', 'js_composer'),
         'param_name' => 'size',
         'value' => '250',
         'description' => __('Enter the height in pixel unit. Enter only a number.', 'js_composer'),
         'admin_label' => false,
      ),
      uxbarn_get_extra_class_name(),
   )
) );






// Gallery shortcode
wpb_map( array(
   'name' => __('Image Gallery/Slider', 'js_composer'),
   'base' => 'vc_gallery',
   'icon' => 'icon-wpb-images-stack',
   'class' => '',
   'category' => __('Media', 'js_composer'),
   'params' => array(
      array(
         'type' => 'attach_images',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Images', 'js_composer'),
         'param_name' => 'images',
         'value' => '',
         'description' => __('Select images.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Type', 'js_composer'),
         'param_name' => 'type',
         'value' => array(
                        __('Grid', 'js_composer') => 'image_grid', 
                        __('Slider (fade transition)', 'js_composer') => 'flexslider_fade',
                        __('Slider (slide transition)', 'js_composer') => 'flexslider_slide',
                    ),
         'description' => __('Select which type of the gallery to be displayed.', 'js_composer'),
         'admin_label' => true,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Grid style', 'js_composer'),
         'param_name' => 'grid_style',
         'value' => array(
                        __('Circle thumbnail', 'js_composer') => 'circle', 
                        __('Square thumbnail', 'js_composer') => 'square',
                    ),
         'description' => __('Select the style for grid gallery.', 'js_composer'),
         'admin_label' => false,
         'dependency' => array(
                            'element' => 'type',
                            'value' => array('image_grid'),
                        ),
      ),
	array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Thumbnail size', 'js_composer'),
         'param_name' => 'img_size',
         'value' => uxbarn_get_image_size_array(),
         'description' => __('Select which size to be used for the thumbnails. Anyway, the image will be scaled depending on its original size and containing column. If you are not sure which one to use, try <em>Original size</em>.', 'js_composer'),
         'admin_label' => false,
         'dependency' => array(
                            'element' => 'type',
                            'value' => array('flexslider_fade', 'flexslider_slide'),
                        ),
      ),
      /*array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Grid columns', 'js_composer'),
         'param_name' => 'columns',
         'value' => array(
                        __('3 Columns', 'js_composer') => 'col3',
                        __('4 Columns', 'js_composer') => 'col4',
                    ),
         'description' => __('Choose the number of columns.', 'js_composer'),
         'admin_label' => false,
         'dependency' => array(
                            'element' => 'type',
                            'value' => array('image_grid'),
                        ),
      ),*/
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Link type', 'js_composer'),
         'param_name' => 'onclick',
         'value' => array(
                        __('Display full image on lightbox', 'js_composer') => 'link_image', 
                        __('Display full image on new window/tab', 'js_composer') => 'link_image_window',
                        __('No link', 'js_composer') => 'link_no',
                    ),
         'description' => __('Select the type of the link for each gallery thumbnail.', 'js_composer'),
         'admin_label' => false,
      ),
      uxbarn_get_auto_rotation('type', array('flexslider_fade', 'flexslider_slide')),
      //uxbarn_get_image_border('type', array('flexslider_fade', 'flexslider_slide')),
      uxbarn_get_show_bullets('type', array('flexslider_fade', 'flexslider_slide')),
      uxbarn_get_extra_class_name(),
   )
) );






/* Flickr
---------------------------------------------------------- */
wpb_map( array(
  "base" => "vc_flickr",
  "name" => __("Flickr Widget", "js_composer"),
  "icon" => "icon-wpb-flickr",
  "category" => __('Media', 'js_composer'),
  "params"  => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Flickr ID", "js_composer"),
      "param_name" => "flickr_id",
      'admin_label' => true,
      "description" => sprintf(__('To find your flickID visit %s.', "js_composer"), '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Number of photos", "js_composer"),
      "param_name" => "count",
      "value" => array(9, 8, 7, 6, 5, 4, 3, 2, 1),
      "description" => __("Number of photos.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Type", "js_composer"),
      "param_name" => "type",
      "value" => array(__("User", "js_composer") => "user", __("Group", "js_composer") => "group"),
      "description" => __("Photo stream type.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Display", "js_composer"),
      "param_name" => "display",
      "value" => array(__("Latest", "js_composer") => "latest", __("Random", "js_composer") => "random"),
      "description" => __("Photo order.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
) );






$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
wpb_map( array(
  "name"  => __("Tabs", "js_composer"),
  "base" => "vc_tabs",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "icon-wpb-ui-tab-content",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    /*array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate tabs", "js_composer"),
      "param_name" => "interval",
      "value" => array(__("Disable", "js_composer") => 0, 3, 5, 10, 15),
      "description" => __("Auto rotate tabs each X seconds.", "js_composer")
    ),*/
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  ),
  "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );





$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
/* Tour section
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
WPBMap::map( 'vc_tour', array(
  "name" => __("Vertical Tabs", "js_composer"),
  "base" => "vc_tour",
  "show_settings_on_create" => false,
  "is_container" => true,
  "container_not_allowed" => true,
  "icon" => "icon-wpb-ui-tab-content-vertical",
  "category" => __('Content', 'js_composer'),
  "wrapper_class" => "clearfix",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", "js_composer"),
      "param_name" => "interval",
      "value" => array(__("Disable", "js_composer") => 0, 3, 5, 10, 15),
      "description" => __("Auto rotate slides each X seconds.", "js_composer")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  ),
  "custom_markup" => '  
  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );







/* Accordion block
---------------------------------------------------------- */
wpb_map( array(
  "name" => __("Accordion / Toggle", "js_composer"),
  "base" => "vc_accordion",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "icon-wpb-ui-accordion",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    /*array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),*/
    array(
      "type" => 'dropdown',
      "heading" => __("Use as", "js_composer"),
      "param_name" => "use_as",
      "description" => __('Select mode for this element. <strong>NOTE:</strong> If you select "Toggle", make sure to have only one section for the element.', 'js_composer'),
      "value" => Array(
                    __("Accordion", "js_composer") => 'accordion',
                    __("Toggle", "js_composer") => 'toggle',
                )
    ),
    array(
      "type" => 'dropdown',
      "heading" => __("Collapsible?", "js_composer"),
      "param_name" => "collapsible",
      "description" => __('Whether to make each section collapsible.', 'js_composer'),
      "value" => Array(
                    __("No", "js_composer") => 'no',
                    __("Yes", "js_composer") => 'yes',
                ),
        'dependency' => array(
                            'element' => 'use_as',
                            'value' => array('accordion'),
                        ),
    ),
    array(
      "type" => 'textfield',
      "heading" => __("Active section", "js_composer"),
      "param_name" => "active_section",
      "description" => __('Enter a section number that you want it to expanded by default. For example, enter <em>2</em> if you want to make the second section active. Or, just enter <em>0</em> to make all sections collapsed on page load (in this case, you need to select the Collapsible value above as "Yes").', 'js_composer'),
      "value" => '1',
        'dependency' => array(
                            'element' => 'use_as',
                            'value' => array('accordion'),
                        ),
    ),
    array(
      "type" => 'dropdown',
      "heading" => __("Toggle expanded?", "js_composer"),
      "param_name" => "expanded",
      "description" => __('Whether to make it expanded (active) by default.', 'js_composer'),
      "value" => Array(
                    __("Yes", "js_composer") => 'true',
                    __("No", "js_composer") => 'false',
                ),
        'dependency' => array(
                        'element' => 'use_as',
                        'value' => array('toggle'),
                    )
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    ),
  ),
  "custom_markup" => '
  <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
  %content%
  </div>
  <div class="tab_controls">
  <button class="add_tab" title="'.__("Add section", "js_composer").'">'.__("Add section (for accordion)", "js_composer").'</button>
  </div>
  ',
  'default_content' => '
  [vc_accordion_tab title="'.__('Section', "js_composer").'"][/vc_accordion_tab]
  ',
  'js_view' => 'VcAccordionView'
) );
wpb_map( array(
  "name" => __("Accordion/Toggle Section", "js_composer"),
  "base" => "vc_accordion_tab",
  "allowed_container_element" => 'vc_row',
  "is_container" => true,
  "content_element" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", "js_composer"),
      "param_name" => "title",
      "description" => __("Section title.", "js_composer")
    ),
  ),
  'js_view' => 'VcAccordionTabView'
) );





/**
 * Pie chat
 */
 $colors_arr = array(__("Grey", "js_composer") => "wpb_button", __("Blue", "js_composer") => "btn-primary", __("Turquoise", "js_composer") => "btn-info", __("Green", "js_composer") => "btn-success", __("Orange", "js_composer") => "btn-warning", __("Red", "js_composer") => "btn-danger", __("Black", "js_composer") => "btn-inverse");
vc_map( array(
    "name" => __("Pie chart", 'js_composer'),
    "base" => "vc_pie",
    "class" => "",
    "icon" => "icon-wpb-vc_pie",
    "category" => __('Content', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget title", "js_composer"),
            "param_name" => "title",
            "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pie value", "js_composer"),
            "param_name" => "value",
            "description" => __('Input graph value here. Witihn a range 0-100.', 'js_composer'),
            "value" => "50",
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pie label value", "js_composer"),
            "param_name" => "label_value",
            "description" => __('Input integer value for label. If empty "Pie value" will be used.', 'js_composer'),
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Units", "js_composer"),
            "param_name" => "units",
            "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Bar color", "js_composer"),
            "param_name" => "color",
            "value" => $colors_arr,//$pie_colors,
            "description" => __("Select pie chart color.", "js_composer"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        ),

    )
) );




/* Progress bar
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Progress Bar", "js_composer"),
  "base" => "vc_progress_bar",
  "icon" => "icon-wpb-graph",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "js_composer"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Graphic values", "js_composer"),
      "param_name" => "values",
      "description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'js_composer'),
      "value" => "90|Development,80|Design,70|Marketing",
      "admin_label" => true,
    ),
    array(
      "type" => "textfield",
      "heading" => __("Units", "js_composer"),
      "param_name" => "units",
      "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Bar color", "js_composer"),
      "param_name" => "bgcolor",
      "value" => array(
  					__("Red", "js_composer") => "bar_red", 
  					__("Yellow", "js_composer") => "solid-yellow", 
  					__("Blue", "js_composer") => "bar_blue", 
  					__("Green", "js_composer") => "bar_green", 
  					__("Grey", "js_composer") => "bar_grey", 
  					__("Gold", "js_composer") => "solid-gold", 
  					__("Pink", "js_composer") => "solid-pink", 
  					__("Purple", "js_composer") => "solid-purple", 
  					__("Custom Color", "js_composer") => "custom"),
      "description" => __("Select bar color.", "js_composer"),
      "admin_label" => true
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Bar custom color", "js_composer"),
      "param_name" => "custombgcolor",
      "description" => __("Select custom background color for bars.", "js_composer"),
      "dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
    ),
    /*array(
      "type" => "checkbox",
      "heading" => __("Options", "js_composer"),
      "param_name" => "options",
      "value" => array(__("Add Stripes?", "js_composer") => "striped", __("Add animation? Will be visible with striped bars.", "js_composer") => "animated")
    ),*/
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "js_composer"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
    )
  )
) );




// Call-To-Action Box
wpb_map( array(
  "name" => __("Call-to-Action Box", "js_composer"),
  "base" => "vc_cta_button",
  "icon" => "icon-wpb-call-to-action",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
      "type" => "textarea_html",
      'admin_label' => true,
      "heading" => __("Content", "js_composer"),
      "param_name" => "content", // param "content" means to use enclosing shortcode structure
      "value" => __("Welcome! This is an example text for CTA box. Grab it now for 20% off!", "js_composer"),
      "description" => __("Enter your content.", "js_composer")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Color line", "js_composer"),
      "param_name" => "uxb_color_line",
      "value" => array(
                    __('Left', 'js_composer') => 'left-line',
                    __('Right', 'js_composer') => 'right-line',
                    __('Top', 'js_composer') => 'top-line',
                    __('Bottom', 'js_composer') => 'bottom-line',
                    __('None', 'js_composer') => 'none',
                ),
         'admin_label' => false,
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Display button?", "js_composer"),
      "param_name" => "display_button",
      "value" => array(
                    __('Yes', 'js_composer') => 'true',
                    __('No', 'js_composer') => 'false',
                ),
         'admin_label' => false,
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Button position", "js_composer"),
      "param_name" => "position",
      "value" => array(
                    __('Right', 'js_composer') => 'cta_align_right',
                    __('Bottom', 'js_composer') => 'cta_align_bottom',
                ),
        'dependency' => array(
                            'element' => 'display_button',
                            'value' => array('true'),
                        ),
         'admin_label' => false,
    ),
    
    uxbarn_get_button_text('display_button', array('true')),
    uxbarn_get_link_param('display_button', array('true')),
    uxbarn_get_open_new_window_param('display_button'),
    uxbarn_get_button_color('display_button', array('true')),
    uxbarn_get_button_custom_color('color', array('custom'), ''),
    uxbarn_get_button_size('display_button', array('true')),
    uxbarn_get_button_border_style('display_button', array('true')),
    
    array(
         'type' => 'textfield',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Icon code', 'js_composer'),
         'param_name' => 'uxb_icon',
         'value' => '',
         'description' => sprintf(__('<a href="%s" target="_blank">Click here to see all available icons</a>. Just copy and paste the icon code into the text field. For example: <em>icon-asterisk</em>. Leave this field blank when not to use icon.', 'js_composer'), get_template_directory_uri() . '/css/Ionicons/cheatsheet.html' ),
         'admin_label' => false,
         'dependency' => array(
                            'element' => 'display_button',
                            'value' => array('true'),
                        ),
      ),
    uxbarn_get_extra_class_name(),
    
  ),
  "js_view" => 'VcCallToActionView'
) );





// Team member shortcode

// Prepare ID list array for selection
/*
global $post; // required 
$id_array = array();
$id_array['- Select member -'] = ''; // Set first dummy item (not used)
$args = array(
            'post_type' => 'team',
            'nopaging' => true,
            'orderby' => 'title',
            'order' => 'ASC',
        );
$items = get_posts($args);
if ( !empty($items) ) {
	foreach( $items as $post ) : setup_postdata($post);
	
		// If WPML is active
		if(function_exists('icl_object_id')) {
			$original_id = get_the_ID();
			
			global $sitepress;
			$default_lang = $sitepress->get_default_language();
			
			$post_lang_info = wpml_get_language_information($original_id);
			
			// If the post is the translated one (not default lang)
			if(strpos($post_lang_info['locale'], $default_lang) !== false) {
				// If the post is translated, display it or else, display the original title
				$title = get_the_title(icl_object_id($original_id, 'team', true));
				$id_array[$title] = get_the_title($original_id) . '|' . $original_id;
			}
			
			
		} else { // If there is no WPML
			$id_array[get_the_title()] = get_the_title() . '|' . get_the_ID();
		}
		
	endforeach;
}
wp_reset_postdata();
 

wpb_map( array(
   'name' => __('Team Member', 'js_composer'),
   'base' => 'uxb_team_member',
   'icon' => 'icon-wpb-uxb_team_member',
   'class' => '',
   'category' => __('Content', 'js_composer'),
   'params' => array(
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Team member', 'js_composer'),
         'param_name' => 'member_id',
         'value' => $id_array,
         'description' => __('Select a member to be added into the column.', 'js_composer'),
         'admin_label' => true,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Thumbnail size', 'js_composer'),
         'param_name' => 'image_size',
         'value' => uxbarn_get_image_size_array(),
         'description' => __('Select which size to be used for the member thumbnail. Anyway, the image will be scaled depending on its original size and containing column. If you are not sure which one to use, try <em>Original size, Rectangle or Large Square</em>.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Link?', 'js_composer'),
         'param_name' => 'link',
         'value' => array(
                        __('Yes, enable link on thumbnail and member name to the single page', 'js_composer') => 'true',
                        __('No link', 'js_composer') => 'false',
                    ),
         'description' => __('Whether to have a link to member\'s single page.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Heading size', 'js_composer'),
         'param_name' => 'heading_size',
         'value' => array(
                        __('Large', 'js_composer') => 'large',
                        __('Smaller', 'js_composer') => 'small',
                    ),
         'description' => __('Select the size for heading which is used to display name and position.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Display social icons?', 'js_composer'),
         'param_name' => 'display_social',
         'value' => array(
                        __('Yes', 'js_composer') => 'true',
                        __('No', 'js_composer') => 'false',
                    ),
         'description' => __('Whether to display the social network icons.', 'js_composer'),
         'admin_label' => false,
      ),
      uxbarn_get_css_animation_param(),
      uxbarn_get_extra_class_name(),
   )
) );*/





// Blog posts shortcode

// Prepare ID list array for selection

$id_array = array();
$args = array(
            'hide_empty' => 0,
            'orderby' => 'title',
            'order' => 'ASC',
        );
$categories = get_categories($args);
if(count($categories) > 0) {
	foreach($categories as $category) {
			
		// If WPML is active
		if(function_exists('icl_object_id')) {
			
			global $sitepress;
			$default_lang = $sitepress->get_default_language();
			
			// Text will be changed depending on current active lang, but the IDs are still original ones from default lang
			$id_array[$category->name] = icl_object_id($category->term_id, 'category', true, $default_lang);
			
			
		} else { // If there is no WPML
			$id_array[$category->name] = $category->term_id;
		}
		
	}
}
 
wpb_map( array(
   'name' => __('Blog Posts', 'js_composer'),
   'base' => 'vc_posts_grid',
   'icon' => 'icon-wpb-application-icon-large',
   'class' => '',
   'category' => __('Content', 'js_composer'),
   'params' => array(
      array(
         'type' => 'checkbox',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Blog categories', 'js_composer'),
         'param_name' => 'grid_categories',
         'value' => $id_array,
         'description' => __('Select the categories from the list.', 'js_composer'),
         'admin_label' => true,
      ),
      array(
         'type' => 'textfield',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Maximum number of items to be displayed', 'js_composer'),
         'param_name' => 'grid_teasers_count',
         'value' => '',
         'description' => __('Enter a number to limit the max number of items to be listed. Leave it blank to show all items from the selected categories above. Only number is allowed.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Type', 'js_composer'),
         'param_name' => 'type',
         'value' => array(
                        __('Columns Grid', 'js_composer') => 'grid',
                        __('List Items', 'js_composer') => 'list',
                    ),
         'description' => __('Select the display type.', 'js_composer'),
         'admin_label' => true,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Columns', 'js_composer'),
         'param_name' => 'grid_columns_count',
         'value' => array(
                        __('3 Columns', 'js_composer') => '3',
                        __('4 Columns', 'js_composer') => '4',
                    ),
         'description' => __('Select the number of columns.', 'js_composer'),
         'admin_label' => true,
         'dependency' => array(
                            'element' => 'type',
                            'value' => array('grid'),
                        )
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Grid item display', 'js_composer'),
         'param_name' => 'grid_layout',
         'value' => array(
                        __('Thumbnail + Title + Excerpt', 'js_composer') => 'thumbnail_title_text',
                        __('Title + Thumbnail + Excerpt', 'js_composer') => 'title_thumbnail_text',
                        //__('Thumbnail + Excerpt', 'js_composer') => 'thumbnail_text',
                        __('Thumbnail + Title', 'js_composer') => 'thumbnail_title',
                    ),
         'description' => __('Select the display for each item.', 'js_composer'),
         'admin_label' => false,
         'dependency' => array(
                            'element' => 'type',
                            'value' => array('grid'),
                        )
      ),
      
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Display thumbnail?', 'js_composer'),
         'param_name' => 'display_thumbnail',
         'value' => array(
                        __('Yes', 'js_composer') => 'true',
                        __('No', 'js_composer') => 'false',
                    ),
         'description' => __('Whether to display post thumbnails.', 'js_composer'),
         'admin_label' => false,
      ),
      array(
         'type' => 'dropdown',
         'holder' => 'div',
         'class' => '',
         'heading' => __('Display post meta info?', 'js_composer'),
         'param_name' => 'display_meta',
         'value' => array(
                        __('Yes', 'js_composer') => 'true',
                        __('No', 'js_composer') => 'false',
                    ),
         'description' => __('Whether to display the meta info of each post (date and comment count)', 'js_composer'),
         'admin_label' => false,
      ),
      uxbarn_get_orderby(),
      uxbarn_get_order(),
      uxbarn_get_extra_class_name(),
   )
) );





/* Search Form */
vc_map( array(
  "name" => __('Search Box', 'js_composer'),
  "base" => "vc_wp_search",
  "icon" => "icon-wpb-wp",
  "category" => __('Content', 'js_composer'),
  "params" => array(
    array(
          'type' => 'textfield',
          'admin_label' => true,
          'heading' => __('Title', 'js_composer'),
          'param_name' => 'title',
          'value' => __('Search', 'js_composer'),
          'description' => __('Enter the title. Leave it blank to hide it.', 'js_composer')
        ),
    )
) );







/* Raw HTML
---------------------------------------------------------- */
wpb_map( array(
  "name" => __("Raw HTML", "js_composer"),
    "base" => "vc_raw_html",
    "icon" => "icon-wpb-raw-html",
    "category" => __('Code', 'js_composer'),
    "wrapper_class" => "clearfix",
    "params" => array(
        array(
        "type" => "textarea_raw_html",
            "holder" => "div",
            "heading" => __("Raw HTML", "js_composer"),
            "param_name" => "content",
            "value" => base64_encode("<p>I am raw html block.<br/>Click edit button to change this html</p>"),
            "description" => __("Enter your HTML content.", "js_composer")
        ),
    )
) );







/* Raw JS
---------------------------------------------------------- */
wpb_map( array(
    "name" => __("Raw JS", "js_composer"),
    "base" => "vc_raw_js",
    "icon" => "icon-wpb-raw-javascript",
    "category" => __('Code', 'js_composer'),
    "wrapper_class" => "clearfix",
    "params" => array(
    array(
        "type" => "textarea_raw_html",
            "holder" => "div",
            "heading" => __("Raw js", "js_composer"),
            "param_name" => "content",
            "value" => __(base64_encode("<script type='text/javascript'> alert('Enter your js here!'); </script>"), "js_composer"),
            "description" => __("Enter your JS code.", "js_composer")
        ),
    )
) );







// Contact form 7 plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
  global $wpdb;
  $cf7 = $wpdb->get_results( 
    "
    SELECT ID, post_title 
    FROM $wpdb->posts
    WHERE post_type = 'wpcf7_contact_form' 
    "
  );
  $contact_forms = array();
  if ($cf7) {
    foreach ( $cf7 as $cform ) {
      $contact_forms[$cform->post_title] = $cform->ID;
    }
  } else {
    $contact_forms["No contact forms found"] = 0;
  }
  wpb_map( array(
    "base" => "contact-form-7",
    "name" => __("Contact Form 7", "js_composer"),
    "icon" => "icon-wpb-contactform7",
    "category" => __('Others', 'js_composer'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Form title", "js_composer"),
        "param_name" => "title",
        "admin_label" => true,
        "description" => __("What text use as form title. Leave blank if no title is needed.", "js_composer")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Select contact form", "js_composer"),
        "param_name" => "id",
        "value" => $contact_forms,
        "description" => __("Choose previously created contact form from the drop down list.", "js_composer")
      )
    )
  ) );
} // if contact form7 plugin active






if (is_plugin_active('LayerSlider/layerslider.php') || file_exists(get_template_directory() . '/includes/layerslider/layerslider.php')) {
  global $wpdb;
  $ls = $wpdb->get_results( 
    "
    SELECT id, name, date_c
    FROM ".$wpdb->prefix."layerslider
    WHERE flag_hidden = '0' AND flag_deleted = '0'
    ORDER BY date_c ASC LIMIT 100
    "
  );
  $layer_sliders = array();
  if ($ls) {
    foreach ( $ls as $slider ) {
      $layer_sliders[$slider->name] = $slider->id;
    }
  } else {
    $layer_sliders["No sliders found"] = 0;
  }
  wpb_map( array(
    "base" => "layerslider",
    "name" => __("Layer Slider", "js_composer"),
    "icon" => "icon-wpb-layerslider",
    "category" => __('Others', 'js_composer'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "js_composer"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "js_composer")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("LayerSlider ID", "js_composer"),
        "param_name" => "id",
        "admin_label" => true,
        "value" => $layer_sliders,
        "description" => __("Select your LayerSlider.", "js_composer")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "js_composer"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
      )
    )
  ) );
} // if layer slider plugin active






if (is_plugin_active('gravityforms/gravityforms.php')) {
  $gravity_forms_array[__("No Gravity forms found.", "js_composer")] = '';
  if ( class_exists('RGFormsModel') ) {
    $gravity_forms = RGFormsModel::get_forms(1, "title");
    if ($gravity_forms) {
      $gravity_forms_array = array(__("Select a form to display.", "js_composer") => '');
      foreach ( $gravity_forms as $gravity_form ) {
        $gravity_forms_array[$gravity_form->title] = $gravity_form->id;
      }
    }
  }
  wpb_map( array(
    "name" => __("Gravity Form", "js_composer"),
    "base" => "gravityform",
    "icon" => "icon-wpb-vc_gravityform",
    "category" => __("Others", "js_composer"),
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Form", "js_composer"),
        "param_name" => "id",
        "value" => $gravity_forms_array,
        "description" => __("Select a form to add it to your post or page.", "js_composer"),
        "admin_label" => true
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Display Form Title", "js_composer"),
        "param_name" => "title",
        "value" => array( __("No", "js_composer") => 'false', __("Yes", "js_composer") => 'true' ),
        "description" => __("Would you like to display the forms title?", "js_composer"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Display Form Description", "js_composer"),
        "param_name" => "description",
        "value" => array( __("No", "js_composer") => 'false', __("Yes", "js_composer") => 'true' ),
        "description" => __("Would you like to display the forms description?", "js_composer"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Enable AJAX?", "js_composer"),
        "param_name" => "ajax",
        "value" => array( __("No", "js_composer") => 'false', __("Yes", "js_composer") => 'true' ),
        "description" => __("Enable AJAX submission? <strong>Note:</strong> If you experience some issue in the form, try disabling this.", "js_composer"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "textfield",
        "heading" => __("Tab Index", "js_composer"),
        "param_name" => "tabindex",
        "description" => __("(Optional) Specify the starting tab index for the fields of this form. Leave blank if you're not sure what this is.", "js_composer"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      )
    )
  ) );
} // if gravityforms active
