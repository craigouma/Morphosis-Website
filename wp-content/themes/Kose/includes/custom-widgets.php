<?php

class UXRecentPostsWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
					'ux_widget_recent_posts', // ID
					__('[UX] Recent Posts', 'uxbarn'), // Title
					array('description' => __('Displays a list of recent posts. This widget is built in the theme itself.', 'uxbarn'))
				);
	}

 	public function form($instance) {
 		
		$title = (isset($instance['title'])) ? $instance['title'] : __('Recent Posts', 'uxbarn');
		$title_length = (isset($instance['title_length'])) ? $instance['title_length'] : 30;
		$post_num = (isset($instance['post_num'])) ? $instance['post_num'] : 5;
		$show_thumbnail = (isset($instance['show_thumbnail'])) ? $instance['show_thumbnail'] : 'true';
		$show_date = (isset($instance['show_date'])) ? $instance['show_date'] : 'true';
		$checked_cat_list =  (isset($instance['checked_cat_list'])) ? $instance['checked_cat_list'] : array();
		
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title_length'); ?>"><?php _e('Post title length:', 'uxbarn'); ?></label>
			<input id="<?php echo $this->get_field_id('title_length'); ?>" name="<?php echo $this->get_field_name('title_length'); ?>" type="text" value="<?php echo esc_attr($title_length); ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('post_num'); ?>"><?php _e('Number of posts to show:', 'uxbarn'); ?></label>
			<input id="<?php echo $this->get_field_id('post_num'); ?>" name="<?php echo $this->get_field_name('post_num'); ?>" type="text" value="<?php echo esc_attr($post_num); ?>" size="3" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" type="checkbox" value="true" <?php checked($show_thumbnail, 'true', true); ?> />
			<label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Show post thumbnail?', 'uxbarn'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" type="checkbox" value="true" <?php checked($show_date, 'true', true); ?> />
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show post date?', 'uxbarn'); ?></label>
		</p>
		<p>
			<label for=""><?php _e('Select specific categories to be shown:', 'uxbarn'); ?></label>
			<br/>
			<em><?php _e('(*Uncheck all will show every category)', 'uxbarn'); ?></em>
			<div style="height: 150px; overflow: auto; background: #fff; padding: 5px; border: 1px solid #ccc;">
			<?php 
				$args = array(
							'type' => 'post',
							'taxonomy' => 'category',
							'orderby' => 'name',
							'order' => 'ASC',
						);
				$cat_list = get_categories($args);
				
				foreach($cat_list as $cat) {
					?>
					<input id="<?php echo $this->get_field_id('checked_cat_list') . '_' . $cat->term_id; ?>" name="CatGroup[]" type="checkbox" value="<?php echo $cat->term_id; ?>" 
						<?php  
							if(!empty($checked_cat_list)) {
								if(in_array($cat->term_id, $checked_cat_list)) {
									echo 'checked';
								}
							}
						?> 
					/>
					<label for="<?php echo $this->get_field_id('checked_cat_list') . '_' . $cat->term_id; ?>"><?php echo $cat->name; ?></label>
					<br/>
					<?php
				}
				
				//if($checked_cat_list )
			?>
			</div>
		</p>
<?php

	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_length'] = ((int)$new_instance['title_length']) == 0 ? 30 : absint($new_instance['title_length']);
		$instance['post_num'] = ((int)$new_instance['post_num']) == 0 ? 5 : absint($new_instance['post_num']);
		$instance['show_thumbnail'] = checked($new_instance['show_thumbnail'], 'true', false) == '' ? 'false' : 'true';
		$instance['show_date'] = checked($new_instance['show_date'], 'true', false) == '' ? 'false' : 'true';
		$instance['checked_cat_list'] = $_POST['CatGroup'];
		
		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$title_length = (isset($instance['title_length'])) ? $instance['title_length'] : 30;
		$post_num = (isset($instance['post_num'])) ? $instance['post_num'] : 5;
		$show_thumbnail = (isset($instance['show_thumbnail'])) ? $instance['show_thumbnail'] : 'true';
		$show_date = (isset($instance['show_date'])) ? $instance['show_date'] : 'true';
		$checked_cat_list = (isset($instance['checked_cat_list'])) ? $instance['checked_cat_list'] : array();
		
		echo $before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		
		$args= array(
			'post_type' => 'post',
			'posts_per_page' => $post_num,
			'category__in' => $checked_cat_list, 
			'post__not_in' => get_option('sticky_posts'),
		);
		
		$custom_query = new WP_Query($args);
		
?>
        <div class="posts-widget">
            <ul>
        		<?php while ($custom_query->have_posts()) :	$custom_query->the_post(); 
        ?>
        		  <?php 
    		          
    		          global $post;
                      $no_thumbnail_class = ' no-thumbnail ';
    		          
		          ?>
        		<li>
        			<?php if($show_thumbnail == 'true') : ?>
        				<?php 
        					if(has_post_thumbnail()) {
        					    echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">';
        						echo get_the_post_thumbnail($post->ID, 'theme-tiny-square', array('alt'=>get_the_title()));
                                echo '</a></div>';
                                $no_thumbnail_class = '';
        					}
        				?>
        			<?php endif; ?>
        			<div class="post-title<?php echo $no_thumbnail_class; ?>">
            			<?php 
            			    
            		        $title = get_the_title(); 
            		        echo '<a href="' . get_permalink() . '">' . ((strlen($title) > $title_length) ? substr($title, 0, $title_length-3) . '...' : $title) . '</a>';
                             
            	        ?>
            			<?php if($show_date == 'true') : ?>
            				<span class="date"><?php echo get_the_time(get_option('date_format')); ?></span>
            			<?php endif; ?>
                    </div>
        		</li>
        		
        		<?php endwhile; ?>
        		
    		</ul>
		</div>
		
		<?php wp_reset_postdata(); echo $after_widget;
		
	}
}


class UXFlickrWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
					'ux_widget_flickr', // ID
					__('[UX] Flickr Photos', 'uxbarn'), // Title
					array('description' => __('Displays a list of photos from Flickr. This widget is built in the theme itself.', 'uxbarn'))
				);
	}

 	public function form($instance) {
 		
		$title = (isset($instance['title'])) ? $instance['title'] : __('Flickr Photos', 'uxbarn');
		$flickr_id = (isset($instance['flickr_id'])) ? $instance['flickr_id'] : '';
		$photo_amount = (isset($instance['photo_amount'])) ? $instance['photo_amount'] : 9;
		$is_random = (isset($instance['is_random'])) ? $instance['is_random'] : 'true';
		
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', 'uxbarn'); ?></label>
			<br/>
			<em>(<?php echo __('Don\'t know your ID?', 'uxbarn') . ' <a href="http://idgettr.com/" target="_blank">' . __('Click here', 'uxbarn') . '</a>'; ?>)</em>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('photo_amount'); ?>"><?php _e('Number of photos to show:', 'uxbarn'); ?></label>
			<input id="<?php echo $this->get_field_id('photo_amount'); ?>" name="<?php echo $this->get_field_name('photo_amount'); ?>" type="text" value="<?php echo esc_attr($photo_amount); ?>" size="3" />
			<br/>
			<em>(Maximum number is 10.)</em>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('is_random'); ?>" name="<?php echo $this->get_field_name('is_random'); ?>" type="checkbox" value="true" <?php checked($is_random, 'true', true); ?> />
			<label for="<?php echo $this->get_field_id('is_random'); ?>"><?php _e('Random orders?', 'uxbarn'); ?></label>
		</p>
<?php

	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['photo_amount'] = ((int)$new_instance['photo_amount']) == 0 ? 9 : absint($new_instance['photo_amount']);
		$instance['is_random'] = checked($new_instance['is_random'], 'true', false) == '' ? 'false' : 'true';
		
		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		
		$widget_id = $args['widget_id'];
		$title = apply_filters('widget_title', $instance['title']);
		$flickr_id = (isset($instance['flickr_id'])) ? $instance['flickr_id'] : '';
		$photo_amount = (isset($instance['photo_amount'])) ? $instance['photo_amount'] : 9;
		$is_random = (isset($instance['is_random'])) ? $instance['is_random'] : 'true';
		$checked_cat_list = (isset($instance['checked_cat_list'])) ? $instance['checked_cat_list'] : array();
		
		echo $before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		
		$display = ($is_random == 'true' ? 'random' : 'latest');
		
		echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=1&count=' . $photo_amount . '&display=' . $display . '&size=s&layout=x&source=user&user=' . $flickr_id . '"></script>';
		
		echo $after_widget;
		
	}
}

class UXVideoWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                    'ux_widget_video', // ID
                    __('[UX] Video', 'uxbarn'), // Title
                    array('description' => __('Displays a video from YouTube or Vimeo. This widget is built in the theme itself.', 'uxbarn'))
                );
    }

    public function form($instance) {
        
        $title = (isset($instance['title'])) ? $instance['title'] : __('Video', 'uxbarn');
        $video_url = (isset($instance['video_url'])) ? $instance['video_url'] : '';
        
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxbarn'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('video_url'); ?>"><?php _e('Video URL:', 'uxbarn'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('video_url'); ?>" name="<?php echo $this->get_field_name('video_url'); ?>" type="text" value="<?php echo esc_attr($video_url); ?>" />
        </p>
        <p>
            <em><?php echo __('Enter the URL to your YouTube or Vimeo video here. <br/><br/>For example, <strong>http://www.youtube.com/watch?v=G_G8SdXktHg</strong> for YouTube. Or, <strong>http://www.vimeo.com/7449107</strong> for Vimeo.', 'uxbarn'); ?></em>
        </p>
<?php

    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['video_url'] = strip_tags($new_instance['video_url']);
        
        return $instance;
    }
    
    public function widget($args, $instance) {
        extract($args);
        
        $widget_id = $args['widget_id'];
        $title = apply_filters('widget_title', $instance['title']);
        $video_url = (isset($instance['video_url'])) ? $instance['video_url'] : '';
        
        echo $before_widget;
        
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
		
		global $wp_embed;
		echo '<div class="embed">' . $wp_embed->run_shortcode('[embed]'. esc_url( $video_url ) .'[/embed]') . '</div>';
		
        echo $after_widget;
        
    }
}

class UXContactInfoWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
					'ux_widget_contact_info', // ID
					__('[UX] Contact Info', 'uxbarn'), // Title
					array('description' => __('Displays contact information. This widget is built in the theme itself.', 'uxbarn'))
				);
	}

 	public function form($instance) {
 		 
		$title = (isset($instance['title'])) ? $instance['title'] : __('Contact Info', 'uxbarn');
		$logo_url = (isset($instance['logo_url'])) ? $instance['logo_url'] : '';
		$contact_person = (isset($instance['contact_person'])) ? $instance['contact_person'] : '';
		$description = (isset($instance['description'])) ? $instance['description'] : '';
		$address = (isset($instance['address'])) ? $instance['address'] : '';
		$phone = (isset($instance['phone'])) ? $instance['phone'] : '';
		$mobile = (isset($instance['mobile'])) ? $instance['mobile'] : '';
		$fax = (isset($instance['fax'])) ? $instance['fax'] : '';
		$email = (isset($instance['email'])) ? $instance['email'] : '';
		
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('logo_url'); ?>"><?php _e('Logo URL:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('logo_url'); ?>" name="<?php echo $this->get_field_name('logo_url'); ?>" type="text" value="<?php echo esc_attr($logo_url); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('contact_person'); ?>"><?php _e('Contact Person:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('contact_person'); ?>" name="<?php echo $this->get_field_name('contact_person'); ?>" type="text" value="<?php echo esc_attr($contact_person); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo esc_attr($description); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($address); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mobile'); ?>"><?php _e('Mobile:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" type="text" value="<?php echo esc_attr($mobile); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($fax); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
		</p>
<?php

	}

	public function update($new_instance, $old_instance) {
		
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['logo_url'] = strip_tags($new_instance['logo_url']);
		$instance['contact_person'] = strip_tags($new_instance['contact_person']);
		$instance['description'] = strip_tags($new_instance['description']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['mobile'] = strip_tags($new_instance['mobile']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['email'] = strip_tags($new_instance['email']);
		
		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		$widget_id = $args['widget_id'];
		$title = apply_filters('widget_title', $instance['title']);
		$logo_url = (isset($instance['logo_url'])) ? $instance['logo_url'] : '';
		$contact_person = (isset($instance['contact_person'])) ? $instance['contact_person'] : '';
		$description = (isset($instance['description'])) ? $instance['description'] : '';
		$address = (isset($instance['address'])) ? $instance['address'] : '';
		$phone = (isset($instance['phone'])) ? $instance['phone'] : '';
		$mobile = (isset($instance['mobile'])) ? $instance['mobile'] : '';
		$fax = (isset($instance['fax'])) ? $instance['fax'] : '';
		$email = (isset($instance['email'])) ? $instance['email'] : '';
		
		echo $before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		
		$less_margin = '';
		if(trim($title) == '' && trim($logo_url) != '') {
			$less_margin = ' less-margin-top';
		}
        
		echo '<div class="contact-info-widget">';
        if($logo_url != '') : echo '<img class="contact-info-widget-logo" src="'. $logo_url .'" alt="" />'; endif;
        if($description != '') : echo '<p>'. $description . '</p>'; endif;
		if($contact_person != '') : echo '<strong class="contact-person">'. $contact_person .'</strong>'; endif;
		if($address != '') : echo '<p>'. $address .'</p>'; endif;
		echo '<p>';
		echo '<p class="contact-details no-margin-bottom">';
		if($phone != '') : echo '<span>' . __('Phone:', 'uxbarn') . ' '. $phone .'</span>'; endif;
		if($mobile != '') : echo '<span>' . __('Mobile:', 'uxbarn') . ' '. $mobile .'</span>'; endif;
		if($fax != '') : echo '<span>' . __('Fax:', 'uxbarn') . ' '. $fax .'</span>'; endif;
		if($email != '') : echo '<span>' . __('Email:', 'uxbarn') . ' <a href="mailto:'. $email .'">'. $email .'</a></span>'; endif;
		echo '</p>';
		echo '</p>';
		echo '</div>';
		echo $after_widget;
		
	}
}


class UXBannerWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
					'ux_widget_advertisement', // ID
					__('[UX] Banner', 'uxbarn'), // Title
					array('description' => __('Widget for placing your image banner. This widget is built in the theme itself.', 'uxbarn'))
				);
	}

 	public function form($instance) {
 		
		$title = (isset($instance['title'])) ? $instance['title'] : __('Banner', 'uxbarn');
		$image_url = (isset($instance['image_url'])) ? $instance['image_url'] : '';
		$link_url = (isset($instance['link_url'])) ? $instance['link_url'] : '';
		
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image URL:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo esc_attr($image_url); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('link_url'); ?>"><?php _e('Link URL:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo esc_attr($link_url); ?>" />
			<br/>
			<em><?php _e( 'Make sure to put "http://" at the front of the URL.', 'uxbarn' ); ?></em>
		</p>
		
<?php

	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image_url'] = strip_tags($new_instance['image_url']);
		$instance['link_url'] = strip_tags($new_instance['link_url']);
		
		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$image_url = (isset($instance['image_url'])) ? $instance['image_url'] : '';
		$link_url = (isset($instance['link_url'])) ? $instance['link_url'] : '';
		
		echo $before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		
		if(trim($link_url) == '') {
			$link_url = '#';
		}
		
		if(trim($image_url) != '') {
			echo '<a href="'. $link_url . '"><img src="' . $image_url . '" /></a>';
		}
		
		echo $after_widget;
		
	}
}

class UXGoogleMapWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
					'ux_widget_googlemaps', // ID
					__('[UX] Google Maps', 'uxbarn'), // Title
					array('description' => __('Displays a map of specified location using Google Maps. This widget is built in the theme itself.', 'uxbarn'))
				);
	}

 	public function form($instance) {
 		
		$title = (isset($instance['title'])) ? $instance['title'] : __('Google Maps', 'uxbarn');
		$latitude = (isset($instance['latitude'])) ? $instance['latitude'] : '';
		$longitude = (isset($instance['longitude'])) ? $instance['longitude'] : '';
		$address = (isset($instance['address'])) ? $instance['address'] : '';
		$zoom = (isset($instance['zoom'])) ? $instance['zoom'] : '16';
		$height = (isset($instance['height'])) ? $instance['height'] : '250';
		
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('latitude'); ?>"><?php _e('Latitude:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('latitude'); ?>" name="<?php echo $this->get_field_name('latitude'); ?>" type="text" value="<?php echo esc_attr($latitude); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('longitude'); ?>"><?php _e('Longitude:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('longitude'); ?>" name="<?php echo $this->get_field_name('longitude'); ?>" type="text" value="<?php echo esc_attr($longitude); ?>" />
			<br/>
			<em>(<?php _e('Don\'t know your latitude and longitude?', 'uxbarn'); ?> <a href="http://itouchmap.com/latlong.html" target="_blank"><?php _e('Click here', 'uxbarn'); ?></a>)</em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($address); ?>" />
			<br/>
			<em><?php _e('If this address field is left blank, the latitude and longitude will be used. Otherwise, theme will use this entered address to render a map instead.', 'uxbarn'); ?></em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom Level (7-20):', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo esc_attr($zoom); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Map Height:', 'uxbarn'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
		</p>
		
<?php

	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['latitude'] = strip_tags($new_instance['latitude']);
		$instance['longitude'] = strip_tags($new_instance['longitude']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['zoom'] = strip_tags($new_instance['zoom']);
		$instance['height'] = strip_tags($new_instance['height']);
		
		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		$widget_id = $args['widget_id'];
		$title = apply_filters('widget_title', $instance['title']);
		$latitude = (isset($instance['latitude'])) ? (trim($instance['latitude']) == '' ? '
-24.447150' : $instance['latitude']) : '-24.447150';
		$longitude = (isset($instance['longitude'])) ? (trim($instance['longitude']) == '' ? '133.75634' : $instance['longitude']) : '133.75634';
		$address = (isset($instance['address'])) ? $instance['address'] : '';
		$zoom = (isset($instance['zoom'])) ? (trim($instance['zoom']) == '' ? '13' : $instance['zoom']) : '16';
		$height = (isset($instance['height'])) ? (trim($instance['height']) == '' ? '250' : $instance['height']) : '250';
		
		echo $before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		
        wp_enqueue_script('uxbarn-google-map');
        
		?>
		
		<div class="google-map" data-latlng="<?php echo $latitude . ',' . $longitude; ?>" data-address="<?php echo $address; ?>" data-display-type="ROADMAP" data-zoom-level="<?php echo $zoom; ?>" data-height="<?php echo $height; ?>"></div>
		
		<?php
		
		echo $after_widget;
		
	}
}
