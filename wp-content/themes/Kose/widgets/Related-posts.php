<?php
/*============= Wordpress Related Posts Widget ===========================*/
// Creating the widget
class wpb_related extends WP_Widget {
function __construct() {
parent::__construct(
// Base ID of your widget
'wpb_related',
// Widget name will appear in UI
__('Related Posts', 'wpb_widget_domain'),
// Widget description
array( 'description' => __( 'Display Related Posts', 'wpb_widget_domain' ), ));
}
// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
// This is where you run the code and display the output
?>
<?php  
    global $post; 
	$categories = get_the_category($post->ID);
	$theoutput='';
	//var_dump($categories);
      
    if ($categories) {  
    $category_ids = array();  
    foreach($categories as $thecat) $category_ids[] = $thecat->term_id;  
    $args=array(  
    'category__in' => $category_ids,  
    'post__not_in' => array($post->ID),  
    'posts_per_page'=>4, // Number of related posts to display.  
    //'caller_get_posts'=>1  
    );
   
    $my_query = new wp_query( $args );  
  	?>
   	<ul>
    <?php 
	if ( $my_query->have_posts() ) :
	while( $my_query->have_posts()) : $my_query->the_post(); ?>
    <li>
    <div><?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'alignleft sidethumb' ) ); ?></div>
	<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
	<span class="post-date"><?php echo get_the_date(); ?></span></li>
    <?php endwhile; else : ?>
	<li>No related posts at the moment</li>
    <?php endif; ?>
    </ul></div>
	<?php }
	wp_reset_postdata();
	echo $args['after_widget'];
}
// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Related Posts', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}} // Class wpb_widget ends here
 
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_related' );
}
add_action( 'widgets_init', 'wpb_load_widget' );