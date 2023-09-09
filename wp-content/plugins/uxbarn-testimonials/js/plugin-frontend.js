/*global jQuery:false */

jQuery(document).ready(function($) {
	"use strict";
	
	// ---------------------------------------------- //
	// Global Read-Only Variables (DO NOT CHANGE!)
	// ---------------------------------------------- //
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1;
	//var androidversion = parseFloat(ua.slice(ua.indexOf("android") + 8));
	// ---------------------------------------------- //
	
	
	
	/***** Testimonial Slider *****/
	if (jQuery().carouFredSel) {

		if ($('.uxb-tmnl-testimonial-list').length > 0) {

			var testimonialAnimation = 'crossfade';
			var testimonialAnimationDuration = 500;
			if ($('html').hasClass('touch')) {
				testimonialAnimation = 'fade';
				testimonialAnimationDuration = 300;
			}

			var testimonialList = $('.uxb-tmnl-testimonial-list');
			testimonialList.each(function() {

				var parent = $(this).closest('.uxb-tmnl-testimonial-wrapper');
				
				var autoRotate = $(this).attr('data-auto-rotation'),
					testimonialSliderAutoAnimated = true,
					testimonialSliderAutoAnimatedDelay = 10000;
				if(autoRotate !== '0') {
					testimonialSliderAutoAnimatedDelay = parseInt(autoRotate, 10) * 1000; // Convert to milliseconds
				} else {
					testimonialSliderAutoAnimated = false;
				}
				
				$(this).carouFredSel({
					responsive : true,
					swipe : true,
					onCreate : function() {
						// Display the element
						$(parent).css({
							overflow : 'inherit',
							height : 'auto',
						}).stop().animate({
							opacity : 1
						});

						// Apply custom z-index to make the first item's image on top
						var zIndex = 50;
						$(this).find('.uxb-tmnl-testimonial-item .uxb-tmnl-testimonial-thumbnail').each(function() {
							$(this).css('z-index', zIndex);
							zIndex -= 1;
						});

					},
					pagination : {
						container : $(parent).find('.uxb-tmnl-testimonial-bullets'),
						anchorBuilder : function(nr) {
							return '<a href="#' + nr + '"></a>';
						}
					},
					scroll : {
						fx : testimonialAnimation,
						duration : testimonialAnimationDuration,
						onBefore : function(data) {
							// Reset custom z-index
							$(this).find('.uxb-tmnl-testimonial-item .uxb-tmnl-testimonial-thumbnail').each(function() {

								if ($('html').hasClass('touch')) {
									$(this).stop().animate({
										opacity : 0
									});
								} else {
									$(this).css({
										zIndex : '',
										display : 'none',
									});
								}

							});

							// Apply a new custom z-index to the next item's image that will be displayed
							var nextItem = data.items.visible;

							if ($('html').hasClass('touch')) {
								$(nextItem).find('.uxb-tmnl-testimonial-thumbnail').stop().animate({
									opacity : 1
								});
							} else {
								$(nextItem).find('.uxb-tmnl-testimonial-thumbnail').css({
									zIndex : 50,
									display : 'block',
								});
							}

							//console.debug($(data.items.visible).find('p').html());
						},
						onAfter : function() {
						},
					},
					auto : {
						play : testimonialSliderAutoAnimated,
						pauseOnHover : 'resume',
						timeoutDuration : testimonialSliderAutoAnimatedDelay,
					},
				}, {
					transition : !(isAndroid), // if running on Android, set it to "false" for this CSS3 transition, otherwise "true"
				});

			});
		}

	}

	
});