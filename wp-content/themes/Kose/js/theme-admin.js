/*global jQuery:false, AdminSettings:false */

jQuery(document).ready(function($) {
	"use strict";
	
	$('#simplepagesidebarsdiv .inside > p').first().after('<p style="margin-top: 35px;"><em>' + AdminSettings.sidebar_text + '</em></p>');
	
	$('#uxbarn_page_sidebar_appearance').closest('.format-setting.type-select.no-desc').after('<p style="margin-top: 10px;"><em>' + AdminSettings.sidebar_appearance_text + '</em></p>');
	
	
	// Home Slider screen
	displayCaptionCustomColor();
	$('#uxbarn_homeslider_caption_color').change(function() {
		displayCaptionCustomColor();
	});
	
	
	function displayCaptionCustomColor() {
		if($('#uxbarn_homeslider_caption_color').val() == 'custom') {
			$('#uxbarn_homeslider_caption_custom_color').closest('.format-settings').css('display', 'block');
		} else {
			$('#uxbarn_homeslider_caption_custom_color').closest('.format-settings').css('display', 'none');
		}
	}
	
});
