/*global jQuery:false, UXbarnPortOptions:false */

jQuery(document).ready(function($) {"use strict";

	// --------------------------------------------------------- //
	// Configuration Options
	// --------------------------------------------------------- //

	// This set is for *single page*
	var portfolioImageSliderAutoAnimated = Boolean(UXbarnPortOptions.portfolio_slider_auto_rotation);
	var portfolioImageSliderAutoAnimatedDelay = parseInt(UXbarnPortOptions.portfolio_slider_rotation_duration, 10);
	var portfolioImageSliderAnimation = UXbarnPortOptions.portfolio_slider_transition;
	var portfolioImageSliderAnimationSpeed = parseInt(UXbarnPortOptions.portfolio_slider_transition_speed, 10);

	// This is for *portfolio element: slider type*
	var portfolioElementSliderAnimationSpeed = 700;

	// ---------------------------------------------- //
	// Global Read-Only Variables (DO NOT CHANGE!)
	// ---------------------------------------------- //
	var isPortfolioSliderLoaded = false;
	var isPortfolioSliderFirstTimeHovered = false;

	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1;
	var androidversion = parseFloat(ua.slice(ua.indexOf("android") + 8));
	// ---------------------------------------------- //

	/***** Portfolio Element: Grid Type *****/
	if (jQuery().isotope) {

		// Run Isotope for portfolio list
		var container = $('.uxb-port-element-wrapper');

		$(container).each(function() {
			var container = $(this);
			var rootContainer = $(this).closest('.uxb-port-root-element-wrapper');

			$(container).imagesLoaded(function() {
				
				$(container).isotope({
					itemSelector : '.uxb-port-element-item',
				});

				$(rootContainer).find('.uxb-port-loading-text').css('display', 'none');

				// Display loaded wrapper
				$(container).closest('.uxb-port-loaded-element-wrapper').css({
					'opacity' : 1,
					'height' : 'auto',
					'visibility' : 'visible',
				});

				// Display the items one after another
				$(container).find('.uxb-port-element-item').each(function(index) {
					$(this).css('visibility', 'visible').delay(110 * index).animate({
						opacity : 1,
					}, 1);
				});
				
				setHoverTextCenterAligned(container);
				
			});
			var filters = $(container).closest('.uxb-port-loaded-element-wrapper').find('.uxb-port-element-filters a');
			$(filters).click(function() {

				var selector = $(this).attr('data-filter');
				$(container).isotope({
					filter : selector
				});

				$(filters).removeClass('active');
				$(this).addClass('active');

				return false;

			});

			$(window).smartresize(function() {
				
				$(container).isotope();
				setHoverTextCenterAligned(container);
				
			});

		});

	}
	
	// Use jquery animation instead of css because there is an issue on IE when using with "display: table"
	// Since v1.1.1
	$('.uxb-port-element-item').hover(function() {
		$(this).find('.uxb-port-element-item-hover').stop().animate({ opacity : 0.9 }, 200);
	}, function() {
		$(this).find('.uxb-port-element-item-hover').stop().animate({ opacity : 0 }, 200);
	});
	
	function setHoverTextCenterAligned(container) {
		
		$(container).find('.uxb-port-element-item-hover').each(function() {
			var infoHeight = $(this).closest('.uxb-port-element-item').find('img').height();
			$(this).css({
				height : infoHeight,
			});
		});
		
	}

	/***** Portfolio Element: Slider Type *****/
	if (jQuery().flexslider) {

		var imageSlider = $('.uxb-port-image-slider-wrapper');
		imageSlider.each(function() {

			var autoRotate = $(this).attr('data-auto-rotation'), imageSliderAutoAnimated = true, imageSliderAutoAnimatedDelay = 10000;

			if (autoRotate !== '0') {
				imageSliderAutoAnimatedDelay = parseInt(autoRotate, 10) * 1000; // Convert to milliseconds
			} else {
				imageSliderAutoAnimated = false;
			}

			var imageSliderAnimation = $(this).attr('data-effect');

			$(this).imagesLoaded(function() {

				$(this).flexslider({
					animation : imageSliderAnimation,
					directionNav : false,
					contolNav : false,
					pauseOnAction : true,
					pauseOnHover : true,
					slideshow : imageSliderAutoAnimated,
					slideshowSpeed : imageSliderAutoAnimatedDelay,
					animationSpeed : portfolioElementSliderAnimationSpeed,
					selector : '.uxb-port-image-slider > li',
					initDelay : 2000,
					smoothHeight : true,
					start : function(slider) {

						var initFadingSpeed = 800;
						var initDelay = 0;
						// "slide" effect has some different transition to re-define
						if (imageSliderAnimation == 'slide') {
							initFadingSpeed = 1;
							initDelay = 800;
						}

						$(slider).find('.uxb-port-image-slider, .flex-viewport').css('visibility', 'visible').stop().animate({
							opacity : 1,
						}, initFadingSpeed);

						// Whether the border is enabled or not
						var borderEnabled = $(slider).closest('.uxb-port-image-slider-wrapper').find('.uxb-port-image-slider li.flex-active-slide img').hasClass('border');
						var extraInitHeight = 16; // border top + bottom heights
						if (!borderEnabled) {// if not, then there is no extra initial height
							extraInitHeight = 0;
						}

						// Hide loading gif
						$(slider).closest('.uxb-port-image-slider-wrapper').css({
							background : 'none',
							// reset init height fix for Safari (also working on other browsers). this will also set the inline height based on the first slide's image
							height : $(slider).closest('.uxb-port-image-slider-wrapper').find('.uxb-port-image-slider li.flex-active-slide img').height() + extraInitHeight + 'px',
						}).addClass('auto-height');

						$(slider).closest('.uxb-port-image-slider-root-container').attr('data-loaded', 'true');

					},
					before : function() {
					},
					after : function(slider) {
						// set a new height based on the next slide
						$(slider).closest('.uxb-port-image-slider-wrapper').css('height', 'inherit');
					},
				});
				// END: flexslider

			});
			//END: imageLoaded

		});
		// END: each

		$('.uxb-port-image-slider-root-container .uxb-port-slider-prev').on('click', function() {
			$(this).closest('.uxb-port-image-slider-root-container').find('.uxb-port-slider-set').flexslider('prev');
			return false;
		});
		$('.uxb-port-image-slider-root-container .uxb-port-slider-next').on('click', function() {
			$(this).closest('.uxb-port-image-slider-root-container').find('.uxb-port-slider-set').flexslider('next');
			return false;
		});

		// Display slider controller on hovered
		$('.uxb-port-image-slider, .uxb-port-slider-controller').hover(function() {
			var root = $(this).closest('.uxb-port-image-slider-root-container');
			if ($(root).find('.uxb-port-image-slider-item:not(.clone)').length > 1) {
				if ($(root).attr('data-loaded') == 'true') {// works only when the slider is loaded
					$(root).attr('data-first-hover', 'true');
					// this is used to prevent the "mousemove" event below continuously firing the handler
					$(root).find('.uxb-port-slider-controller').css('display', 'block').stop().animate({
						opacity : 1
					});
				}
			}
		}, function() {
			var root = $(this).closest('.uxb-port-image-slider-root-container');
			$(root).find('.uxb-port-slider-controller').stop().animate({
				opacity : 0
			});
		});
		// If the mouse cursor is moving on the slider when it is just loaded, display the controller
		$('.uxb-port-image-slider, .uxb-port-slider-controller').mousemove(function() {
			var root = $(this).closest('.uxb-port-image-slider-root-container');
			if ($(root).find('.uxb-port-image-slider-item:not(.clone)').length > 1) {
				if ($(root).attr('data-first-hover') != 'true' && $(root).attr('data-loaded') == 'true') {
					$(root).find('.uxb-port-slider-controller').css('display', 'block').stop().animate({
						opacity : 1
					});
				}
			}
		});

		// Fix 1px glitch on the right of each slide (only for "slide" effect)
		var slidersToBeFixed = $('.uxb-port-image-slider-wrapper[data-effect="slide"]').closest('.uxb-port-image-slider-root-container');
		$(slidersToBeFixed).each(function() {
			$(this).css('width', $(this).width() - 1);
		});

	}

	/***** Portfolio slider on single page *****/
	if (jQuery().flexslider) {

		if ($('#uxb-port-single-images-container').length > 0) {

			$('#uxb-port-single-images-container').imagesLoaded(function() {

				$('#uxb-port-single-images-container').flexslider({
					animation : portfolioImageSliderAnimation,
					directionNav : false,
					contolNav : false,
					pauseOnAction : false,
					pauseOnHover : true,
					slideshow : portfolioImageSliderAutoAnimated,
					slideshowSpeed : portfolioImageSliderAutoAnimatedDelay,
					animationSpeed : portfolioImageSliderAnimationSpeed,
					selector : '.uxb-port-single-slides > li',
					initDelay : 2000,
					smoothHeight : true,
					start : function() {

						var initFadingSpeed = 800;
						var initDelay = 0;
						// "slide" effect has some different transition to re-define
						if (portfolioImageSliderAnimation == 'slide') {
							initFadingSpeed = 1;
							initDelay = 800;
						}

						$('#uxb-port-single-images-container .uxb-port-single-slides, #uxb-port-single-images-container .flex-viewport').css('visibility', 'visible').stop().animate({
							opacity : 1,
						}, initFadingSpeed);

						isPortfolioSliderLoaded = true;

						// Hide loading gif
						$('#uxb-port-single-images-container').css({
							background : 'none',
							// Reset init height fix for Safari (also working on other browsers).
							// This will also set the inline height based on the first slide's image.
							// Note that "16" is for top and bottom border's width. If there is no border, simply remove this number.
							height : $('#uxb-port-single-images-container .uxb-port-single-slides li.flex-active-slide img').height() + 16 + 'px',
						}).addClass('auto-height');

					},
					before : function() {
					},
					after : function() {
						// set a new height based on the next slide
						$('#uxb-port-single-images-container, #uxb-port-single-images-container.portrait-view').css('height', 'inherit');
					},
				});
				// END: flexslider

			});
			// END: imagesLoaded

			$('#uxb-port-single-images-container .uxb-port-slider-prev').on('click', function() {
				$(this).closest('.slider-set').flexslider('prev');
				return false;
			});
			$('#uxb-port-single-images-container .uxb-port-slider-next').on('click', function() {
				$(this).closest('.slider-set').flexslider('next');
				return false;
			});

			// Display slider controller on hovered
			$('#uxb-port-single-images-container').hover(function() {
				if ($(this).find('.uxb-port-single-image:not(.clone)').length > 1) {
					if (isPortfolioSliderLoaded) {// works only when the slider is loaded
						isPortfolioSliderFirstTimeHovered = true;
						// this is used to prevent the "mousemove" event below continuously firing the handler
						$(this).find('.uxb-port-slider-controller').css('display', 'block').stop().animate({
							opacity : 1
						});
					}
				}
			}, function() {
				$(this).find('.uxb-port-slider-controller').stop().animate({
					opacity : 0
				});
			});
			// If the mouse cursor is moving on the slider when it is just loaded, display the controller
			$('#uxb-port-single-images-container').mousemove(function() {
				if ($(this).find('.uxb-port-single-image:not(.clone)').length > 1) {
					if (!isPortfolioSliderFirstTimeHovered && isPortfolioSliderLoaded) {
						$(this).find('.uxb-port-slider-controller').css('display', 'block').stop().animate({
							opacity : 1
						});
					}
				}
			});

		}

	}

	/***** Fancybox *****/
	if (jQuery().fancybox) {

		if (isAndroid && androidversion <= 4.0) {

			// Fancybox's thumbnail helper is not working on older Android, so disable it.
			$('.uxb-port-image-box').not('.clone .uxb-port-image-box').fancybox();

		} else {

			$('.uxb-port-image-box').not('.clone .uxb-port-image-box').fancybox({
				helpers : {
					thumbs : {
						width : 50,
						height : 50
					}
				}
			});

		}

	}

}); 