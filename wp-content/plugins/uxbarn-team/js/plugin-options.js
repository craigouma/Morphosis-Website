/*global jQuery:false, UXbarnTeamOptions:false */

jQuery(document).ready(function($) {
	"use strict";

	// ---------------------------------------------- //
	// General
	// ---------------------------------------------- //

	$('#option-tree-sub-header').append('<div id="plugin-options-msg">' + UXbarnTeamOptions.header_text + '</div>');
	$('#option-tree-header #option-tree-logo a').attr('href', 'http://themeforest.net/user/UXbarn?ref=UXbarn').attr('target', '_blank');
	
	
	// ---------------------------------------------- //
	// Plugin Options: Social Network Tab
	// ---------------------------------------------- //

	// Set selection
	showHideSocialSetOptions($('#uxb_team_po_social_set').val());
	$('#uxb_team_po_social_set').on('change', function() {
		showHideSocialSetOptions($(this).val());
	});

	function showHideSocialSetOptions(value) {

		if (value === 'default') {// default set
			
			$('#section_uxb_team_po_social_icons_section .social-custom-set-wrap').css('display', 'none');
			$('#section_uxb_team_po_social_icons_section .social-default-set-wrap').css('display', 'block');

		} else {// 'custom set'

			$('#section_uxb_team_po_social_icons_section .social-custom-set-wrap').css('display', 'block');
			$('#section_uxb_team_po_social_icons_section .social-default-set-wrap').css('display', 'none');

		}
		
	}

}); 