<?php

class UXTestimonialWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
					'ux_widget_testimonial', // ID
					__('[UX] Testimonials', 'uxb_tmnl'), // Title
					array('description' => __('Displays created custom testimonials. This widget is from UXbarn Testimonials plugin.', 'uxb_tmnl'))
				);
	}

 	public function form($instance) {
 		
		$title = (isset($instance['title'])) ? $instance['title'] : __('Testimonials', 'uxb_tmnl');
        $auto_rotation_duration = (isset($instance['auto_rotation_duration'])) ? $instance['auto_rotation_duration'] : '14';
		$checked_list =  (isset($instance['checked_list'])) ? $instance['checked_list'] : array();
		
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uxb_tmnl'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('auto_rotation_duration'); ?>"><?php _e('Auto rotation:', 'uxb_tmnl'); ?></label>
            <select id="<?php echo $this->get_field_id('auto_rotation_duration'); ?>" name="testimonialAutoRotation">
                <option value="0" <?php echo (esc_attr($auto_rotation_duration) == '0' ? 'selected="selected"' : ''); ?>><?php _e('Disable', 'uxb_tmnl'); ?></option>
                <option value="5" <?php echo (esc_attr($auto_rotation_duration) == '5' ? 'selected="selected"' : ''); ?>>5</option>
                <option value="6" <?php echo (esc_attr($auto_rotation_duration) == '6' ? 'selected="selected"' : ''); ?>>6</option>
                <option value="7" <?php echo (esc_attr($auto_rotation_duration) == '7' ? 'selected="selected"' : ''); ?>>7</option>
                <option value="8" <?php echo (esc_attr($auto_rotation_duration) == '8' ? 'selected="selected"' : ''); ?>>8</option>
                <option value="9" <?php echo (esc_attr($auto_rotation_duration) == '9' ? 'selected="selected"' : ''); ?>>9</option>
                <option value="10" <?php echo (esc_attr($auto_rotation_duration) == '10' ? 'selected="selected"' : ''); ?>>10</option>
                <option value="12" <?php echo (esc_attr($auto_rotation_duration) == '12' ? 'selected="selected"' : ''); ?>>12</option>
                <option value="14" <?php echo (esc_attr($auto_rotation_duration) == '14' ? 'selected="selected"' : ''); ?>>14</option>
                <option value="16" <?php echo (esc_attr($auto_rotation_duration) == '16' ? 'selected="selected"' : ''); ?>>16</option>
                <option value="18" <?php echo (esc_attr($auto_rotation_duration) == '18' ? 'selected="selected"' : ''); ?>>18</option>
                <option value="20" <?php echo (esc_attr($auto_rotation_duration) == '20' ? 'selected="selected"' : ''); ?>>20</option>
                <option value="25" <?php echo (esc_attr($auto_rotation_duration) == '25' ? 'selected="selected"' : ''); ?>>25</option>
                <option value="30" <?php echo (esc_attr($auto_rotation_duration) == '30' ? 'selected="selected"' : ''); ?>>30</option>
                <option value="40" <?php echo (esc_attr($auto_rotation_duration) == '40' ? 'selected="selected"' : ''); ?>>40</option>
                <option value="60" <?php echo (esc_attr($auto_rotation_duration) == '60' ? 'selected="selected"' : ''); ?>>60</option>
                <option value="80" <?php echo (esc_attr($auto_rotation_duration) == '80' ? 'selected="selected"' : ''); ?>>80</option>
                <option value="100" <?php echo (esc_attr($auto_rotation_duration) == '100' ? 'selected="selected"' : ''); ?>>100</option>
            </select>
        </p>
		<p>
			<label for=""><?php _e('Select specific testimonials to be shown:', 'uxb_tmnl'); ?></label>
			<br/>
			<em><?php _e('(*Uncheck all will show every testimonials.)', 'uxb_tmnl'); ?></em>
			<div style="height: 150px; overflow: auto; background: #fff; padding: 5px; border: 1px solid #ccc;">
			<?php 
				$args = array(
				            'nopaging' => true,
							'post_type' => 'uxbarn_testimonials',
							'post_status' => 'publish',
						);
				$testimonial_list = new WP_Query($args);
				
				if($testimonial_list->have_posts()) : while($testimonial_list->have_posts()) : $testimonial_list->the_post();
					?>
					<input id="<?php echo $this->get_field_id('checked_list') . '_' . get_the_ID(); ?>" name="TestimonialGroup[]" type="checkbox" value="<?php echo get_the_ID(); ?>" 
						<?php  
							if(!empty($checked_list)) {
								if(in_array(get_the_ID(), $checked_list)) {
									echo 'checked';
								}
							}
						?> 
					/>
					<label for="<?php echo $this->get_field_id('checked_list') . '_' . get_the_ID(); ?>"><?php the_title(); ?></label>
					<br/>
					<?php
				endwhile; wp_reset_postdata();
				endif;
				
			?>
			</div>
		</p>
        
<?php

	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['checked_list'] = $_POST['TestimonialGroup'];
        $instance['auto_rotation_duration'] = $_POST['testimonialAutoRotation'];
        
		return $instance;
	}

	public function widget($args, $instance) {
		extract($args);
		$widget_id = $args['widget_id'];
		$title = apply_filters('widget_title', $instance['title']);
		$checked_list = (isset($instance['checked_list'])) ? $instance['checked_list'] : array();
        $auto_rotation_duration = (isset($instance['auto_rotation_duration'])) ? $instance['auto_rotation_duration'] : '14';
		
        // Scripts for testimonials widget
		wp_enqueue_style( 'uxb-tmnl-frontend' );
		wp_enqueue_script( 'uxb-tmnl-caroufredsel' );
		wp_enqueue_script( 'uxb-tmnl-frontend' );
        
		echo $before_widget;
		
		if (!empty($title)) {
			echo $before_title . $title . $after_title;
		}
		
		//if(!empty($checked_list)) {
			
		?>
				
		<div class="uxb-tmnl-testimonial-wrapper style2 widget">
            <div class="uxb-tmnl-testimonial-bullets"></div>
            <div class="uxb-tmnl-testimonial-inner">
                <div class="uxb-tmnl-testimonial-list" data-auto-rotation="<?php echo $auto_rotation_duration; ?>">
				
		         <?php
		         
                    /*$args = array(
                                'post_type' => 'testimonials',
                                'post__in' => $checked_list,
                                'post_status' => 'publish',
                            );*/
                    
                    $args = array(
                        'post_type' => 'uxbarn_testimonials',
                        'nopaging' => true,
                        'post__in' => $checked_list,
                    );
                    $testimonial_list = new WP_Query($args);
                    if($testimonial_list->have_posts()) : while($testimonial_list->have_posts()) : $testimonial_list->the_post();
                    
		          ?>  
    		          <div class="uxb-tmnl-testimonial-item">
                        <div class="uxb-tmnl-blockquote-wrapper">
            				<blockquote>
            				    <p>
            					   <?php echo uxb_tmnl_get_array_value(get_post_meta(get_the_ID(), 'uxbarn_testimonial_text'), 0); ?>
            					</p>
            				</blockquote>
            				<p class="uxb-tmnl-cite"><?php the_title(); ?></p>
        				</div>
    				</div>
                <?php
                    endwhile; wp_reset_postdata(); endif;
                ?>
				</div>
			</div>
		</div>
				
				
				<?php
			
		//}
		
		echo $after_widget;
		
	}
}
