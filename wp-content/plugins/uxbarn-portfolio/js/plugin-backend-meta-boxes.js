/*global jQuery:false */

jQuery(document).ready(function($) {
	"use strict";
	
	// Hide both meta boxes first
	hideFormatMetaBoxes();
	
	// Image format
	if( $('#uxbarn_portfolio_item_format-0').is(':checked') ) {
		$('#uxbarn_portfolio_image_slideshow_format_meta_box').css('display', 'block');
	}
	
	// Video format
	if( $('#uxbarn_portfolio_item_format-1').is(':checked') ) {
		$('#uxbarn_portfolio_video_format_meta_box').css('display', 'block');
	}
	
	
	
	// Event handler when selecting on each format
	$('#uxbarn_portfolio_item_format-0').change( function() {
		hideFormatMetaBoxes();
		$('#uxbarn_portfolio_image_slideshow_format_meta_box').css('display', 'block');
	} );
	
	$('#uxbarn_portfolio_item_format-1').change( function() {
		hideFormatMetaBoxes();
		$('#uxbarn_portfolio_video_format_meta_box' ).css('display', 'block');
	} );
	
	
	
	function hideFormatMetaBoxes() {
		$('#uxbarn_portfolio_image_slideshow_format_meta_box, #uxbarn_portfolio_video_format_meta_box').css('display', 'none');
	}
	
});
