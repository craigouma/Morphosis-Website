/*global jQuery:false, UXbarnPortOptions:false */

jQuery(document).ready(function($) {
	"use strict";

	// ---------------------------------------------- //
	// General
	// ---------------------------------------------- //

	$('#option-tree-sub-header').append('<div id="plugin-options-msg">' + UXbarnPortOptions.header_text + '</div>');
	$('#option-tree-header #option-tree-logo a').attr('href', 'http://themeforest.net/user/UXbarn?ref=UXbarn').attr('target', '_blank');

	// ---------------------------------------------- //
	// Single Page Tab
	// ---------------------------------------------- //
	showAutoRotationOption();

	$('#uxb_port_po_single_page_slider_auto_rotation-0').on('change', function() {
		showAutoRotationOption();
	});

	$('#uxb_port_po_single_page_slider_auto_rotation-1').on('change', function() {
		showAutoRotationOption();
	});

	function showAutoRotationOption() {

		if ($('#uxb_port_po_single_page_slider_auto_rotation-0').is(':checked')) {
			$('#setting_uxb_port_po_single_page_slider_rotation_duration').css('display', 'block');
		}

		if ($('#uxb_port_po_single_page_slider_auto_rotation-1').is(':checked')) {
			$('#setting_uxb_port_po_single_page_slider_rotation_duration').css('display', 'none');
		}

	}

}); 