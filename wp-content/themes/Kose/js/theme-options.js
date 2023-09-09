/*global jQuery:false, ThemeOptions:false */

jQuery(document).ready(function($) {"use strict";

	// ---------------------------------------------- //
	// General
	// ---------------------------------------------- //

	$('#option-tree-sub-header').append('<div id="theme-options-msg">' + ThemeOptions.welcome_text + ' <a href="http://themeforest.net/user/UXbarn?ref=UXbarn" target="_blank">ThemeForest</a>.</div>');

	$('#option-tree-version').html('<span id="theme-version">' + ThemeOptions.theme_version + '</span>');
	$('#option-tree-header #option-tree-logo a').attr('href', 'http://themeforest.net/user/UXbarn?ref=UXbarn').attr('target', '_blank');

	

	// ---------------------------------------------- //
	// Theme Options: Blog Tab
	// ---------------------------------------------- //

	showHideBlogMetaInfoOptions();

	$('#uxbarn_to_setting_override_post_meta_info-0').on('change', function() {
		showHideBlogMetaInfoOptions();
	});

	$('#uxbarn_to_setting_override_post_meta_info-1').on('change', function() {
		showHideBlogMetaInfoOptions();
	});

	function showHideBlogMetaInfoOptions() {

		if ($('#uxbarn_to_setting_override_post_meta_info-0').is(':checked')) {

			$('#setting_uxbarn_to_post_meta_info_date').css('display', 'block');
			$('#setting_uxbarn_to_post_meta_info_author').css('display', 'block');
			$('#setting_uxbarn_to_post_meta_info_categories').css('display', 'block');
			$('#setting_uxbarn_to_post_meta_info_comment').css('display', 'block');
			$('#setting_uxbarn_to_post_meta_info_single_author_box').css('display', 'block');
			$('#setting_uxbarn_to_post_meta_info_single_tags').css('display', 'block');

		}

		if ($('#uxbarn_to_setting_override_post_meta_info-1').is(':checked')) {

			$('#setting_uxbarn_to_post_meta_info_date').css('display', 'none');
			$('#setting_uxbarn_to_post_meta_info_author').css('display', 'none');
			$('#setting_uxbarn_to_post_meta_info_categories').css('display', 'none');
			$('#setting_uxbarn_to_post_meta_info_comment').css('display', 'none');
			$('#setting_uxbarn_to_post_meta_info_single_author_box').css('display', 'none');
			$('#setting_uxbarn_to_post_meta_info_single_tags').css('display', 'none');

		}

	}
	
	// ---------------------------------------------- //
	// Theme Options: Social Network Tab
	// ---------------------------------------------- //

	// Set selection
	showHideSocialSetOptions($('#uxbarn_to_setting_social_set').val());
	$('#uxbarn_to_setting_social_set').on('change', function() {
		showHideSocialSetOptions($(this).val());
	});

	function showHideSocialSetOptions(value) {

		if (value === 'default') {// default set
			
			$('#section_uxbarn_to_social_network_section .social-custom-set-wrap').css('display', 'none');
			$('#section_uxbarn_to_social_network_section .social-default-set-wrap').css('display', 'block');

		} else {// 'custom set'

			$('#section_uxbarn_to_social_network_section .social-custom-set-wrap').css('display', 'block');
			$('#section_uxbarn_to_social_network_section .social-default-set-wrap').css('display', 'none');

		}
		
	}


}); 