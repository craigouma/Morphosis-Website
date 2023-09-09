<?php
/**
 * WPBakery Visual Composer actions and filters classes for .
 *
 * @package WPBakeryVisualComposer
 * @since   4.2
 */

class Vc_Interactions {
	/**
	 * Initialize default actions and filters
	 *
	 * This method is called by Vc_Base in initialization
	 * @since 4.4
	 * @access public
	 */
	public function initBase() {
		do_action('vc_interactions_init_base_before');
		add_filter( 'body_class', array( &$this, 'bodyClass' ) );
		add_filter( 'the_excerpt', array( &$this, 'excerptFilter' ) );
		add_action( 'wp_head', array( &$this, 'addMetaData' ) );
		add_filter( 'the_content', array( &$this, 'fixPContent' ), 11 );
		do_action('vc_interactions_init_base_after');
	}
	/**
	 * Hooked class method by wp_head WP action.
	 *
	 * @since  4.2
	 * @access public
	 */
	public function addMetaData() {
		echo '<meta name="generator" content="Powered by Visual Composer - drag and drop page builder for WordPress."/>' . "\n";
	}
	/**
	 * Method adds css class to body tag.
	 *
	 * Hooked class method by body_class WP filter. Method adds custom css class to body tag of the page to help
	 * identify and build design specially for VC shortcodes.
	 *
	 * @since  4.2
	 * @access public
	 * @param $classes
	 * @return array
	 */
	public function bodyClass( $classes ) {
		$classes[] = 'wpb-js-composer js-comp-ver-' . WPB_VC_VERSION;
		$disable_responsive = vc_settings()->get( 'not_responsive_css' );
		if ( $disable_responsive !== '1' ) $classes[] = 'vc_responsive';
		else $classes[] = 'vc_non_responsive';
		return $classes;
	}
	/**
	 * Builds excerpt for post from content.
	 *
	 * Hooked class method by the_excerpt WP filter. When user creates content with VC all content is always wrapped by shortcodes.
	 * This methods calls do_shortcode for post's content and then creates a new excerpt.
	 *
	 * @since  4.2
	 * @access public
	 * @param $output
	 * @return string
	 */
	public function excerptFilter( $output ) {
		global $post;
		if ( empty( $output ) && ! empty( $post->post_content ) ) {
			$text = strip_tags( do_shortcode( $post->post_content ) );
			$excerpt_length = apply_filters( 'excerpt_length', 55 );
			$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
			return $text;
		}
		return $output;
	}

	/**
	 * Remove unwanted wraping with p for content.
	 *
	 * Hooked by 'the_content' filter.
	 *
	 * @param null $content
	 * @return string|null
	 */
	public function fixPContent( $content = null ) {
		//$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		if ( $content ) {
			$s = array(
				'/' . preg_quote( '</div>', '/' ) . '[\s\n\f]*' . preg_quote( '</p>', '/' ) . '/i',
				'/' . preg_quote( '<p>', '/' ) . '[\s\n\f]*' . preg_quote( '<div ', '/' ) . '/i',
				'/' . preg_quote( '<p>', '/' ) . '[\s\n\f]*' . preg_quote( '<section ', '/' ) . '/i',
				'/' . preg_quote( '</section>', '/' ) . '[\s\n\f]*' . preg_quote( '</p>', '/' ) . '/i'
			);
			$r = array( "</div>", "<div ", "<section ", "</section>" );
			$content = preg_replace( $s, $r, $content );
			return $content;
		}
		return null;
	}

}