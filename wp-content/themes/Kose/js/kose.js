/*global jQuery:false */

/*
 * Kose - Fullscreen Portfolio WordPress Theme
 * By UXbarn
 * Themeforest Profile: http://themeforest.net/user/UXbarn?ref=UXbarn
 * Demo URL: http://themes.uxbarn.com/redirect.php?theme=kose_wp
 * 
 */

jQuery(document).ready(function($) {
	"use strict";
	
	// ---------------------------------------------- //
	// Global Read-Only Variables (DO NOT CHANGE!)
	// ---------------------------------------------- //
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1;
	var androidversion = parseFloat(ua.slice(ua.indexOf('android') + 8));
	var isSafari = !!navigator.userAgent.match(/safari/i) && !navigator.userAgent.match(/chrome/i) && typeof document.body.style.webkitFilter !== "undefined" && !window.chrome;
	var siteWidth = $(window).width();
	var BV;
	// ---------------------------------------------- //
	
	
	// -------------------- Social Media Share  -------------------- //
	$('.floatr').mouseover(function(e) {
        $(this).find('.socialicons').css('opacity',1);
    });
	$('.floatr').mouseout(function(e) {
        $(this).find('.socialicons').css('opacity',0);
    });
	
	$('.opclose').on('click touchstart', function(){
		if($('.opclose img').hasClass('translated')){
		//$('.slide-caption').css('margin-right','-35%');
		$('.slide-caption').fadeOut("fast");
		$('.opclose img').removeClass('translated').addClass('forceimg');
		}else{
		$('.slide-caption').fadeIn("fast");
		//$('.slide-caption').css('margin-right','0px');
		$('.opclose img').removeClass('forceimg').addClass('translated');
		}
	});
	
	$('.filcats i').click(function(){
		if($('.uxb-port-element-filters').hasClass('invisble')){
		   $('.uxb-port-element-filters').slideDown("fast");
		   $('.uxb-port-element-filters').removeClass('invisble');
		}else{
		   $('.uxb-port-element-filters').slideUp("fast");
		   $('.uxb-port-element-filters').addClass('invisble');
		}
	});
	
	$('.uxb-port-element-filters li a').click(function(){
		if($('.filcats').is(':visible')){
		 $('.uxb-port-element-filters').slideUp("fast");
		 $('.uxb-port-element-filters').addClass('invisble');}
	});
	
	//cbpBGSlideshow.init();
	// ---------------------------------------------- //
	// Core Scripts
	// ---------------------------------------------- //

	// Initialize custom functions
	renderGoogleMaps();
	initMobileMenu();

	// Attach custom scrollbar
	attachCustomScrollbar();
	
	// Initialize Foundation framework
	$(document).foundation();
	
	// Force displaying tabs element after JS has been loaded
	$('#content-container .section-container').addClass('display-block');
	
	// This fix is only for IE
	if (msieversion() != '') {
		$('#content-toggle-buttons i').css('marginTop', '-2px');
	}
	
	// This fix is only for Safari
	if (isSafari) {
		$('#main-menu a.active, #main-menu a.active, #menu-wrapper > ul > li.current-menu-item > a, #menu-wrapper > ul > li.current-menu-item > a, #menu-wrapper > ul > li.current-menu-parent > a, #menu-wrapper > ul > li.current-menu-parent > a').addClass('safari-fix');
	}
	
	// Append show/hide notice div
	//$('#side-footer-wrapper').append('<div id="scroll-down-notice">' + ThemeOptions.swipe_text +' <i class="icon ion-ios7-arrow-down"></i></div>');
	
	// Whether the current page has the content area + on lower screen res, show/hide the notice
	showHideScrolldownNotice();
	
	// Initially set sidebar footer depending on current screen resolution
	setSidebarFooter();
	
	// If current viewport is small (mobile), always display the content area even it is set as "hidden-content"
	displayContentAreaForMobile();
	
	// Only for WPML plugin
	displayWPMLLangSwitcher();
	
	
	
	// Force displaying tabs element after JS has been loaded
	$('#content-container .section-container').addClass('display-block');

	// Add CSS class to submit button of comment form
	$('input#submit, input[type="submit"], input[type="button"]').addClass('button');

	// To remove some empty tags
	$('p:empty').remove(); // This is mostly added by WP automatically

	// To unwrap "p" tag out of "x" button of the message box
	if ($('.box .close').length > 0) {
		if ($('.box .close').parent().prop('tagName').toLowerCase() === 'p') {
			$('.box .close').unwrap();
		}
	}

	// To remove margin-bottom out of the last "p" element inside the message box
	$('.box').find('p:last-child').addClass('no-margin-bottom');
	
	
	
	
	
	/***** Menu *****/
	$('.sf-menu').superfish({
		animation : {
			height:'show'
		},
		animationOut: {height:'hide'},
		speed : 'normal',
		speedOut : 'normal',
		delay : 600	// 0.4 second delay on mouseout
	});
	
	
	
	// Initialize Full Screen Image/Slider
	var autoRotate = $('#full-scrn-slider').attr('data-auto-rotation'), 
		fullScrnSliderAutoAnimated = true, 
		fullScrnSliderAutoAnimatedDelay = 5000;
		
	if (autoRotate !== '0') {
		fullScrnSliderAutoAnimatedDelay = parseInt(autoRotate, 10);
	} else {
		fullScrnSliderAutoAnimated = false;
	}
	
	var fullScrnSliderAnimation = $('#full-scrn-slider').attr('data-effect'); // crossfade, directscroll, cover-fade, uncover-fade
	var fullScrnSliderAnimationSpeed = parseInt($('#full-scrn-slider').attr('data-transition-speed'), 10);
	
	$('#full-scrn-slider').imagesLoaded(function() {

		$('#full-scrn-slider').carouFredSel({
			responsive : true,
			swipe : true,
			width : '100%',
			onCreate : function() {

				// Hide loading icon
				$('#loading-bg').hide();

				// Display the slider
				$('.full-scrn-slide').stop().animate({
					opacity : 1,
				}, 800);

				// Stretch the slider's images (always stretch on all resolutions by default)
				$('.full-scrn-slide').each(function() {
					var originalImg = $(this).children('img');
					if (originalImg.length > 0 && originalImg.attr('src')) {
						
						var finalPath = originalImg.attr('src');
						
						// Make it full screen
						$(this).css('background-image', 'url("' + finalPath + '")');
						
						// At the same time, store the image path into the element's attribute for later use when the slide is video type
						$(this).attr('data-image-url', finalPath);
						
						originalImg.remove();
						
					}
				});
				
				/***** Animate caption *****/
				//var caption = $(this).find('.full-scrn-slide:first-child .slide-caption-wrapper').not('.image-caption-style');
				if ($('#content-container').length == 0) {
					
					animateFullscreenCaption(true);
					$('#full-scrn-bullets').stop().animate({
						opacity : 1,
					});
					
				}
				
				
				/***** For video type *****/
				
				// If the first slide is video clip type, display the dummy image container (which is on top of the actual slide background image)
				// then run the video function
				var firstSlide = $('.full-scrn-slide').first();
				var videoUrl = $(firstSlide).attr('data-video');
				
				// Prepend the dummy image container in the first slide
				$(firstSlide).prepend($('#dummy-slide-image'));
				
				// Assign the image url to the dummy image container for using on the first slide
				$('#dummy-slide-image').css('background-image', 'url("' + $(firstSlide).attr('data-image-url') + '")');
				
				if ( typeof videoUrl !== 'undefined' && videoUrl != '' ) {
					
					$('#dummy-slide-image').stop().animate({
						opacity : 1,
					}, fullScrnSliderAnimationSpeed, function() {
						showSlideVideo($(firstSlide), videoUrl);
					});
					
				}

			},
			items : {
			},
			scroll : {
				fx : fullScrnSliderAnimation,
				duration : fullScrnSliderAnimationSpeed,
				onBefore : function(data) {
					
					// Reset the caption style
					$('.slide-caption-wrapper').removeAttr('style').addClass('reset');
					
					$('.slide-caption-wrapper.image-caption-style').stop().animate({
						opacity : 0,
					}, 40);
					
					
					/***** For video type *****/
					
					// For making it looks smoother when transitioning
					// Reset the background images for all slides
					if ($('#full-scrn-slider').attr('data-effect') == 'crossfade') {
							
						$('#video-container').stop().animate({
							opacity : 0,
						}, fullScrnSliderAnimationSpeed);
						
					} else {
							
						$('.full-scrn-slide').each(function() {
							$(this).css('background-image', 'url("' + $(this).attr('data-image-url') + '")');
						});
						
						$('#video-container').stop().animate({
							opacity : 0,
						}, 10);
						
					}
					
					
					// Prepare the next slide if it is video type
					var nextSlide = data.items.visible;
					var videoUrl = $(nextSlide).attr('data-video');
					
					if ( typeof videoUrl !== 'undefined' && videoUrl != '' ) {
						
						// Assign the image url to the dummy image container for using on the next slide
						$('#dummy-slide-image').css('background-image', 'url("' + $(nextSlide).attr('data-image-url') + '")');
						
						// Prepend the dummy image container in the next slide
						$(nextSlide).prepend($('#dummy-slide-image'));
						
						// Re-assign the background-image for the next slide because it might be set as empty
						// when previously playing the video (see "showVideo()")
						$(nextSlide).css('background-image', 'url("' + $(nextSlide).attr('data-image-url') + '")');

					}
					
				},
				onAfter : function(data) {
					
					// Need to get the width of current window again
					var siteWidth = $(window).width();
					
					/***** Animate caption *****/
					if (siteWidth > 1161) {
						
						// This "if" rule only applies to desktop resolution
						if (($('#content-container').length > 0 && isContentHidden) || $('#content-container').length == 0) {
							animateFullscreenCaption(false);
						}
						
					} else { // else, on mobile res, always run this func
						animateFullscreenCaption(false);
					}
					
					
					/**** For video type *****/
					
					// If the current slide is video type, display the dummy image container (which is on top of the actual slide background image)
					// then run the video function
					var currentSlide = data.items.visible;
					var videoUrl = $(currentSlide).attr('data-video');
					
					if ( typeof videoUrl !== 'undefined' && videoUrl != '' ) {
						
						$('#dummy-slide-image').stop().animate({
							opacity : 1,
						}, 10, function() {
							showSlideVideo($(currentSlide), videoUrl);
						});
						
					}
				
				},
			},
			auto : {
				play : fullScrnSliderAutoAnimated,
				pauseOnHover : 'resume',
				timeoutDuration : fullScrnSliderAutoAnimatedDelay,
			},
			prev : {
			},
			next : {
			},
			pagination : {
				container : '#full-scrn-bullets',
				anchorBuilder : function(nr) {
					return '<a href="javascript:;' + nr + '"></a>';
				}
			},
		}, {
			transition : !(isAndroid), // if running on Android, set it to "false" for this CSS3 transition, otherwise "true"
		});
		
		// Make it center aligned
		$('#full-scrn-bullets').css('margin-left', (($('#full-scrn-bullets').width() / 2) * -1));

	});
	
	
	
	
	
	
	/***** Content Area *****/
	// If there is no content area (like on homepage), just reset the z-index out of this element making the slider bullets clickable
	if( $('#content-container').length == 0) {
		$('#root-container').css('zIndex', 'auto');
	}
	
	// Hide/Show Content
	var isContentHidden = false;
	
	$('#hide-toggle-button').click(function() {
		
		if( ! isContentHidden) {
			triggerContentAreaState('hide');
		} else {
			triggerContentAreaState('show');
		}
	});
	
	// If the content area is set as "hidden-content", so hide it
	if ($('#content-container').hasClass('hidden-content')) {
		triggerContentAreaState('hide');
	}
	
	function triggerContentAreaState(state) {
		
		if (state == 'hide') { // to hide the area
			
			$('#inner-content-container').getNiceScroll().hide();
			$('#content-container').stop().animate({
				opacity : 0,
			}, function() {
				
				$(this).css('display', 'none');
				
				// Remove z-index out of this element making the slider bullets clickable
				$('#root-container').css('zIndex', 'auto');
				
				// Display slider bullets (and caption, if any) when the content area is hidden
				$('#full-scrn-bullets').stop().animate({
					opacity : 1,
				});
				
				animateFullscreenCaption(false);
				
			});
			
			$('#hide-toggle-button').attr('class', 'rotated');
			
			isContentHidden = true;
			
		} else { // to display the area
			
			$('#inner-content-container').getNiceScroll().show();
			$('#content-container').css('display', 'block').stop().animate({
				opacity : 1,
			}).removeClass('hidden-content');
			
			// Set z-index back to the default value
			$('#root-container').css('zIndex', 2);
			
			// Hide slider bullets (and caption, if any) when the content area is displayed
			$('#full-scrn-bullets, .slide-caption-wrapper').stop().animate({
				opacity : 0,
			});
			
			$('#hide-toggle-button').attr('class', '');
			
			// Trigger Isotope and recalculate the elements
			$('.uxb-port-element-wrapper').isotope();
			recalculatePortfolioHoverInfo();
			
			isContentHidden = false;
			
			recalculateContentArea();
			
		}
		
	}
	
	
	
	
	
	/***** Portfolio *****/
	
	// Run Isotope for portfolio list
	var container = $('.uxb-port-element-wrapper');

	$(container).each(function() {
		var container = $(this);
		var rootContainer = $(this).closest('.uxb-port-root-element-wrapper');

		$(container).imagesLoaded(function() {
			$(container).isotope({
				itemSelector : '.uxb-port-element-item',
			});
			
			// Hide loading icon
			$(rootContainer).find('.uxb-port-loading-text').css('display', 'none');

			// Display loaded wrapper
			$(container).closest('.uxb-port-loaded-element-wrapper').css({
				opacity : 1,
				height : 'auto',
				visibility : 'visible',
			});

			// Display the items one after another
			$(container).find('.uxb-port-element-item').each(function(index) {
				$(this).css('visibility', 'visible').delay(110 * index).animate({
					opacity : 1,
				}, 1);
			});
		});
		var filters = $(container).closest('.uxb-port-loaded-element-wrapper').find('.uxb-port-element-filters a');
		$(filters).click(function() {
			
			// Hide this first to make "nicescroll" works properly
			$('.uxb-port-element-item-hover').css('display', 'none');
			
			var selector = $(this).attr('data-filter');
			$(container).isotope({
				filter : selector
			}, onAnimationFinished);

			$(filters).removeClass('active');
			$(this).addClass('active');
			
			return false;

		});
		
		$(window).smartresize(function() {
			$(container).isotope();
		});

	});
	
	// Code to be executed after the animation finishes
	var onAnimationFinished = function(){
	
		// Display it back after finished animation
		$('.uxb-port-element-item-hover').css('display', 'block');
		
		recalculateContentArea();
		
	};
	
	recalculatePortfolioHoverInfo();
	
	
	
	
	
	/***** Image Slider *****/
	if (jQuery().flexslider) {

		var imageSlider = $('.image-slider-wrapper');
		imageSlider.each(function() {

			var autoRotate = $(this).attr('data-auto-rotation'), 
				imageSliderAutoAnimated = true, 
				imageSliderAutoAnimatedDelay = 10000;
				
			if (autoRotate !== '0') {
				// Convert to milliseconds
				imageSliderAutoAnimatedDelay = parseInt(autoRotate, 10) * 1000;
			} else {
				imageSliderAutoAnimated = false;
			}
			
			var imageSliderAnimation = $(this).attr('data-effect');
			var imageSliderAnimationSpeed = 700;
			
			$(this).imagesLoaded(function() {

				$(this).flexslider({
					animation : imageSliderAnimation,
					directionNav : false,
					contolNav : false,
					pauseOnAction : true,
					pauseOnHover : true,
					slideshow : imageSliderAutoAnimated,
					slideshowSpeed : imageSliderAutoAnimatedDelay,
					animationSpeed : imageSliderAnimationSpeed,
					selector : '.image-slider > li',
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

						$(slider).find('.image-slider, .flex-viewport').css('visibility', 'visible').stop().animate({
							opacity : 1,
						}, initFadingSpeed);
						
						// Whether the border is enabled or not
						var borderEnabled = $(slider).closest('.image-slider-wrapper').find('.image-slider li.flex-active-slide img').hasClass('border');
						var extraInitHeight = 16; // border top + bottom heights
						if( ! borderEnabled) { // if not, then there is no extra initial height
							extraInitHeight = 0;
						}

						// Hide loading gif
						$(slider).closest('.image-slider-wrapper').css({
							background : 'none',
							// reset init height fix for Safari (also working on other browsers). this will also set the inline height based on the first slide's image
							height : $(slider).closest('.image-slider-wrapper').find('.image-slider li.flex-active-slide img').height() + extraInitHeight + 'px',
						}).addClass('auto-height');

						$(slider).closest('.image-slider-root-container').attr('data-loaded', 'true');
						
					},
					before : function() {
					},
					after : function(slider) {
						// set a new height based on the next slide
						$(slider).closest('.image-slider-wrapper').css('height', 'inherit');
					},
				});
				// END: flexslider

			});
			//END: imageLoaded

		});
		// END: each

		$('.image-slider-root-container .slider-prev').on('click', function() {
			$(this).closest('.image-slider-root-container').find('.slider-set').flexslider('prev');
			return false;
		});
		$('.image-slider-root-container .slider-next').on('click', function() {
			$(this).closest('.image-slider-root-container').find('.slider-set').flexslider('next');
			return false;
		});

		// Display slider controller on hovered
		$('.image-slider, .slider-controller').hover(function() {
			var root = $(this).closest('.image-slider-root-container');
			if ($(root).find('.image-slider-item:not(.clone)').length > 1) {
				if ($(root).attr('data-loaded') == 'true') {// works only when the slider is loaded
					$(root).attr('data-first-hover', 'true');
					// this is used to prevent the "mousemove" event below continuously firing the handler
					$(root).find('.slider-controller').css('display', 'block').stop().animate({
						opacity : 1
					});
				}
			}
		}, function() {
			var root = $(this).closest('.image-slider-root-container');
			$(root).find('.slider-controller').stop().animate({
				opacity : 0
			});
		});
		// If the mouse cursor is moving on the slider when it is just loaded, display the controller
		$('.image-slider, .slider-controller').mousemove(function() {
			var root = $(this).closest('.image-slider-root-container');
			if ($(root).find('.image-slider-item:not(.clone)').length > 1) {
				if ($(root).attr('data-first-hover') != 'true' && $(root).attr('data-loaded') == 'true') {
					$(root).find('.slider-controller').css('display', 'block').stop().animate({
						opacity : 1
					});
				}
			}
		});
		
		// Some sliders that are in "large-6" column (only left column) might display some 1px glitch.
		// To fix that, using the JS code below to reduce the width by 1px to hide it.
		var slidersToBeFixed = $('.row .large-6.columns:first-child .image-slider-root-container');
		$(slidersToBeFixed).each(function() {
			$(this).css('width', $(this).width() - 1 );
		});

	}
	
	
	
	
	
	// ---------------------------------------------- //
	// Elements / Misc.
	// ---------------------------------------------- //
	
	/***** BlackAndWhite jQuery Plugin *****/
	if (jQuery().BlackAndWhite) {
			
		$('.black-white').BlackAndWhite({
	        hoverEffect : true, // default true
	        // set the path to BnWWorker.js for a superfast implementation
	        webworkerPath : false,
	        // for the images with a fluid width and height 
	        responsive:true,
	        // to invert the hover effect
	        invertHoverEffect: true,
	        // this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
	        intensity:1,
	        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
	            fadeIn: 500, // 200ms for fadeIn animations
	            fadeOut: 1500 // 800ms for fadeOut animations
	        },
	        onImageReady:function(img) {
	            // this callback gets executed anytime an image is converted
	        }
	    });
	    
   }
    
    
    
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
						
						var siteWidth = $(window).width();
						
						if (siteWidth > 1161) {
								
							// Apply custom z-index to make the first item's image on top
							var zIndex = 50;
							$(this).find('.uxb-tmnl-testimonial-item .uxb-tmnl-testimonial-thumbnail').each(function() {
								$(this).css('z-index', zIndex);
								zIndex -= 1;
							});
							
						}

					},
					pagination : {
						container : $(parent).find('.uxb-tmnl-testimonial-bullets'),
						anchorBuilder : function(nr) {
							return '<a href="javascript:;' + nr + '"></a>';
						}
					},
					scroll : {
						fx : testimonialAnimation,
						duration : testimonialAnimationDuration,
						onBefore : function(data) {
							
							var siteWidth = $(window).width();
							
							if (siteWidth > 1161) {
								
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
							
							}

							//console.debug($(data.items.visible).find('p').html());
						},
						onAfter : function() {
							recalculateContentArea();
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



	/***** Google Maps *****/
	function renderGoogleMaps(laty,longy,addy) {

		if ( typeof google !== 'undefined' && typeof google.maps.MapTypeId !== 'undefined') {

			var elements = $('.google-map');

			elements.each(function() {
				var lat; var lng; var rawlatlng; var address;
				
				if(laty == null && longy == null && addy == null){
				rawlatlng = $(this).attr('data-latlng').split(',');
				lat = jQuery.trim(rawlatlng[0]);
				lng = jQuery.trim(rawlatlng[1]);
				address = $(this).attr('data-address');}
				else{ lat = laty; lng = longy; address = addy;}
				
				var displayType = $(this).attr('data-display-type');
				var zoomLevel = parseInt($(this).attr('data-zoom-level'), 10);
				$(this).css('height', $(this).attr('data-height'));

				switch(displayType.toUpperCase()) {
					case 'ROADMAP' :
						displayType = google.maps.MapTypeId.ROADMAP;
						break;
					case 'SATELLITE' :
						displayType = google.maps.MapTypeId.SATELLITE;
						break;
					case 'HYBRID' :
						displayType = google.maps.MapTypeId.HYBRID;
						break;
					case 'TERRAIN' :
						displayType = google.maps.MapTypeId.TERRAIN;
						break;
					default :
						displayType = google.maps.MapTypeId.ROADMAP;
						break;
				}

				var geocoder = new google.maps.Geocoder();
				var latlng = new google.maps.LatLng(lat, lng);
				var myOptions = {
					scrollwheel : false,
					zoom : zoomLevel,
					center : latlng,
					mapTypeId : displayType
				};

				var map = new google.maps.Map($(this)[0], myOptions);
				
				/*var goldStar = {
    			path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
    			fillColor: 'yellow',
    			fillOpacity: 0.8,
    			scale: 1,
    			strokeColor: 'gold',
    			strokeWeight: 14
 				};*/

				geocoder.geocode({
					'address' : address,
					'latLng' : latlng,
				}, function(results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
						var marker;
						if (jQuery.trim(address).length > 0) {
							marker = new google.maps.Marker({
								map : map,
								//icon: goldStar,
								position : results[0].geometry.location
							});

							map.setCenter(results[0].geometry.location);

						} else {
							marker = new google.maps.Marker({
								map : map,
								//icon: goldStar,
								position : latlng
							});

							marker.setPosition(latlng);
							map.setCenter(latlng);

						}

					} else {
						window.alert("Geocode was not successful for the following reason: " + status);
					}
				});

			});
		}

	}
	
	/*=============---- View on map code ================*/
	$('.mapa').click(function(){
		var location = $(this).attr('data-location');
		if(location=="nairobi"){
		$('.googlemaps .thismap').fadeOut("fast");
		$('.googlemaps .wpb_raw_html').html('<iframe class="thismap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.6917944024167!2d36.94741800000001!3d-1.3615759999999895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f0d31bc53639d%3A0xeb508e275ff607c1!2sMorphosis+Ltd!5e0!3m2!1sen!2ske!4v1423130140079" width="600" height="450" frameborder="0" style="border:0"></iframe>');
		} else {
		$('.googlemaps .thismap').fadeOut("fast");
		$('.googlemaps .wpb_raw_html').html('<iframe class="thismap" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3979.803717484275!2d39.679688!3d-4.0604!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1840131d9878a135%3A0x38a46f088d83953d!2sMorphosis+Ltd!5e0!3m2!1sen!2ske!4v1423132912881" width="600" height="450" frameborder="0" style="border:0"></iframe>');
		}
	});
	/*=============---- View on map code ================*/
	
	/***** Fancybox *****/
	var enableLightbox = Boolean(ThemeOptions.enable_lightbox_wp_gallery);
	
	// Add FancyBox feature to WP gallery shortcode
	if (enableLightbox) {
		registerFancyBoxToWPGallery();
	}
	function registerFancyBoxToWPGallery() {
		// WP Gallery shortcode
		var $wpGallery = $('.gallery');

		$wpGallery.each(function() {
			var mainId = $(this).attr('id');

			var items = $(this).find('.gallery-item').find('a');

			items.each(function() {

				var href = $(this).attr('href');

				if (href.toLowerCase().indexOf('.jpg') >= 0 || href.toLowerCase().indexOf('.jpeg') >= 0 || href.toLowerCase().indexOf('.png') >= 0 || href.toLowerCase().indexOf('.gif') >= 0) {

					$(this).addClass('image-box');
					$(this).attr('rel', mainId);

				}

			});

		});
	}
	
	// Register FancyBox to "image-box" class
	if (jQuery().fancybox) {
		if (isAndroid && androidversion <= 4.0) {
			// Fancybox's thumbnail helper is not working on older Android, so disable it.
			$('.image-box').not('.clone .image-box').fancybox();
		} else {
			$('.image-box').not('.clone .image-box').fancybox({
				padding: 0,
				helpers : {
					thumbs : {
						width : 50,
						height : 50
					},
					overlay: {
						locked: false, // to prevent page jumping to the top when clicking on the object
				    }
				}
			});
		}
	}
	
	
	
	/***** Accordion/Toggle *****/
	var animateObj = {
		animate : 'easeOutQuint',
		duration : 600,
	};

	if ($('.accordion').length > 0) {

		$('.accordion').each(function() {
			
			var isCollapsible = $(this).attr('data-collapsible');
			if (isCollapsible == 'true') {
				isCollapsible = true;
			}
			
			var activeVar = parseInt($(this).attr('data-active-index'), 10);
			if ($(this).attr('data-active-index') == '-1') {
				activeVar = false;
			}
			
			$(this).accordion({
				autoHeight : false,
				heightStyle : 'content', // jQuery UI 1.10.x
				collapsible : isCollapsible,
				animate : animateObj,
				active : parseInt($(this).attr('data-active-index'), 10),
				create : function() {
					$(this).css({
						height : 'auto',
						visibility : 'visible',
					}).animate({
						opacity : 1
					});
				},
				activate: function( event, ui ) {
					recalculateContentArea();
				},
			});
		});

	}

	if ($('.toggle').length > 0) {

		$('.toggle').accordion({
			autoHeight : false,
			heightStyle : 'content', // jQuery UI 1.10.x
			collapsible : true,
			animate : animateObj,
			active : false,
			create : function() {
				$(this).css({
					height : 'auto',
					visibility : 'visible',
				}).animate({
					opacity : 1
				});
			},
			activate: function( event, ui ) {
				recalculateContentArea();
			},
		});

		if ($('.toggle').hasClass('active')) {
			$('.toggle.active').accordion({
				heightStyle : 'content',
				autoHeight : false,
				collapsible : true,
				animate : animateObj,
				active : 0,
				create : function() {
					$(this).css({
						height : 'auto',
						visibility : 'visible',
					}).animate({
						opacity : 1
					});
				},
			});

			$('body').scrollTop(0);
		}

	}
			


	/***** Tabs *****/
	if ($('html').hasClass('lt-ie9')) {
		$('.auto').addClass('tabs').removeClass('auto').attr('data-section', 'tabs');
	}
	var tabs = $('.vertical-tabs p.title > a, .tabs p.title > a, .auto p.title > a');
	tabs.click(function() {

		// Force hiding any content that contains Google Map
		$(this).parents('.section-container').find('.content').each(function() {
			if ($(this).find('.google-map').length > 0) {
				$(this).css('display', 'none');
			}
		});

		var map = $(this).parents('section').find('.content').find('.google-map');
		if (map.length > 0) {
			// Re-render Google Map for tab content and display the content
			$(this).parents('section').find('.content').css({
				'display' : 'block',
				'width' : '100%'
			});
			renderGoogleMaps();
		}
		
		setTimeout( function() {  recalculateContentArea(); }, 500);
		
		// Fix the display of contained images when using with RetinaJS
		$(this).parents('section').find('.content').find('img').css('width', 'auto');
		
	});



	/***** Progress Bar *****/
	if (isAndroid) {
		if (androidversion >= 4.0) {
			animateProgressBar();
		} else {

			$('.progress-bar .bar-meter').each(function() {
				$(this).css('width', $(this).attr('data-meter') + '%');
			});

		}
	} else {
		animateProgressBar();
	}
	function animateProgressBar() {

		if (jQuery().waypoint) {
			
			$('.progress-bar').waypoint(function() {

				var meter = $(this).find('.bar-meter');
				$(meter).css('width', 0);
				$(meter).delay(250).animate({
					width : $(meter).attr('data-meter') + '%',
				}, 1400, 'easeOutQuint');

			}, {
				offset : '85%',
				triggerOnce : true,
				context : '#inner-content-container',
			});

		}

	}
	
	
	
	/***** Other Functions *****/
	
	// Whether the screen is already scrolled down on mobile
	// Note: Use with showHideScrolldownNotice() function below
	var isScrolled = false; 
	
	// Show/hide scrolldown notice on mobile
	function showHideScrolldownNotice() {
		
		// Active only when there is content area
		if( $('#content-container').length > 0 ) {
			
			var siteWidth = $(window).width();
			
			if ( siteWidth > 1161 ) {
				//$('#side-footer-wrapper').append(siteWidth).append('&nbsp;');				
				$('#side-footer-wrapper #copyright, #side-footer-wrapper .bar-social').css('display', 'inherit').stop().animate({ opacity : 1 });
				$('#scroll-down-notice').stop().animate({ opacity : 0 }, 10, function() { $(this).css('display', 'none'); });
			}
			
		} else {
			$('#scroll-down-notice').css('display', 'none');
		}
		
	}
	
	
	
	function attachCustomScrollbar() {
		
		var siteWidth = $(window).width();
		
		if (siteWidth > 1161) {
			
			$('#inner-content-container').niceScroll({
				cursorcolor : ThemeOptions.content_scrollbar_color,//'#fcda1c',
				cursorwidth : 3,
				cursorborder : 0,
				touchbehavior : false,
				autohidemode : true,
				hidecursordelay : 1000,
				scrollspeed : 100,
				//bouncescroll : true,
			});
			
		}
		
	}
	
	
	
	function setSidebarFooter() {
		
		var siteWidth = $(window).width();
		
		if (siteWidth <= 1161) {
			
			$('#side-footer-wrapper').insertAfter('#side-container');
			$('#copyright').find('br').replaceWith('<span class="blank"></span>');
			 
		} else {
			
			$('#side-container').append($('#side-footer-wrapper'));
			$('#copyright').find('span.blank').replaceWith('<br/>');
			
		}
		
	}
	
	
	
	function animateFullscreenCaption(isFirstLoad) {
		
		var caption = $('.full-scrn-slide').first().find('.slide-caption-wrapper');
		//alert($(caption).html());
		var delayTime = 700;
		
		if ( ! isFirstLoad) {
			delayTime = 0;
		}
		
		$(caption).css('marginTop', ($(caption).outerHeight() - 100) * -1);
		
		// Animate to the final position
		$(caption).stop().delay(delayTime).animate({
			marginTop : $(caption).outerHeight()/2 * -1,
			opacity: 1,
		}, 1500, 'easeOutQuint', function() {
			/* ie9 fix for text shadow */
			$(this).css('filter', 'Shadow(Color=#666666, Direction=45, Strength=0);');
		});
			
	}
	
	
	
	function showSlideVideo(currentSlide, videoUrl) {
		
		// Run video only on desktop. On mobile, ignore the video and normally display only the video cover image
		if ( ! Modernizr.touch) {
			
			// Remove the old video first, if it exists
			if ($(BV).length > 0) {
				BV.remove();
	    	}
	    	
	    	/*** BigVideoJS ***/
	    	var options = {
	    		useFlashForFirefox : false,
	    		container : $('#video-container'),
	    	};
			
			// Create a new instance
			BV = new $.BigVideo(options);
	    	BV.init();
		    BV.show( videoUrl ,{ ambient:true } );
		    
		    // Once the video file is loaded, then display it
	    	BV.getPlayer().on('loadeddata', function() {
	    		
	    		$('#video-container').stop().animate({
	    			opacity : 1,
	    		}, 10, function() {
	    			
	    			// Hide the actual slide background image to reveal the video (video container is in the lower layer)
	    			$(currentSlide).css('background-image', '');
	    			
	    			// Then animate the dummy image container making it feel like smooth transition from image into video
	    			// This dummy image container is now in the current slide (on top of the actual bg image)
	    			// NOTE: "delay()" here is for making the transition on IE more smoother (other browsers actually doesn't need it)
	    			$('#dummy-slide-image').delay(350).animate({
						opacity : 0,
					});
					
	    		});
		        
		    });
		    
	    }
	    
	}
	
	
	
	function displayContentAreaForMobile() {
		
		// If resize to mobile res, always display the content area (also reset status of the content area to "show")
		var siteWidth = $(window).width();
		
		if (siteWidth <= 1161) {
			
			//$('#inner-content-container').getNiceScroll().show();
			$('#content-container').css('display', 'block').stop().animate({
				opacity : 1,
			}).removeClass('hidden-content');
			
			// Set z-index back to the default value
			//$('#root-container').css('zIndex', 'auto'); 
			
			// Use z-index as "2" here means to make the content area showing properly when manually resizing browser's window from smaller to desktop viewport
			// Anyway, the actual z-index of #root-container in kose-responsive.css is still "auto" for mobile res to prevent the slider bullets overlaying on mobile menus
			$('#root-container').css('zIndex', 2);
			
			$('#full-scrn-bullets').stop().animate({
				opacity : 1,
			});
			
			animateFullscreenCaption(false);
			
			$('#hide-toggle-button').attr('class', '');
			
			// Trigger Isotope and recalculate the elements
			$('.uxb-port-element-wrapper').isotope();
			recalculatePortfolioHoverInfo();
			
			isContentHidden = false;
			
			recalculateContentArea();
			
		}
		
	}
	
	
	
	function recalculatePortfolioHoverInfo() {
		
		// Reset the height first
		$('.uxb-port-element-item-hover-info').css('height', 'auto');
		
		// Set the hover element to the center position
		$('.uxb-port-element-item-hover').each(function() {
			var hoverWidth = $(this).width();
			var hoverHeight = $(this).height();
			$(this).css({
				left : '50%',
				top : '50%',
				marginLeft : ((hoverWidth / 2) * -1) + 'px', // add negative margin to centering the element
				marginTop : ((hoverHeight / 2) * -1) + 'px', // add negative margin to centering the element
			});
		});
		
		// Set the hover text to the middle position
		$('.uxb-port-element-item-hover-info').each(function() {
			var infoHeight = $(this).height();
			$(this).css({
				height : infoHeight,
				top : '50%',
				marginTop : ((infoHeight / 2) * -1) + 'px', // add negative margin to centering the element
			});
		});
		
	}
	
	// Function for recalculating the size of the content area
	function recalculateContentArea() {
		$('#inner-content-container').getNiceScroll().resize();
	}
	
	function msieversion() {
	
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer, return version number
            return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
        else                 // If another browser, return 0
            return '';

	   //return false;
	}
	
	function urlExists(url) {
		
	    var http = new XMLHttpRequest();
	    http.open('HEAD', url, false);
	    http.send();
	    
	    return http.status!=404;
	}
	
	
	
	function displayWPMLLangSwitcher() {
		
		var siteWidth = $(window).width();
			
		if ( siteWidth <= 1161 ) {
			$('#logo-wrapper').prepend( $('#wpml-language-selector').addClass('mobile-mode').stop().animate({ 'opacity': 1 }) );
		} else {
			$('#side-footer-wrapper').prepend( $('#wpml-language-selector').removeClass('mobile-mode').stop().animate({ 'opacity': 1 }) );
		}
		
	}
	
	
	
	
	
	/***** Responsive Related *****/
	
	// When resizing the browser's window
	$(window).smartresize(function() {
		
		// Adjust the full screen image when resizing the window
		$('#full-scrn-slider, #full-scrn-slider-container > .caroufredsel_wrapper').css('height', 'inherit');
		recalculatePortfolioHoverInfo();
		
	});
	
	$(window).resize(function() {
		
		// Recalculate these functions when resizing the browser's window
		showHideScrolldownNotice();
		attachCustomScrollbar();
		setSidebarFooter();
		displayContentAreaForMobile();
		displayWPMLLangSwitcher();
		
		// If the status of content area is not hidden when resizing back to desktop res., hide bullet and caption
		var siteWidth = $(window).width();
		if (siteWidth > 1161) {
			
			if ( ! isContentHidden && $('#content-container').length > 0 ) {
				
				$('#full-scrn-bullets').stop().animate({
					opacity : 0,
				});
				
				$('.slide-caption-wrapper').removeAttr('style').addClass('reset');
				$('.slide-caption-wrapper.image-caption-style').stop().animate({
					opacity : 0,
				}, 40);
				
			}
			
		}
		
	});
	
	
	
	
	
	/***** Mobile Menu *****/
    function initMobileMenu() {
        //var defaultMenuList = $('#root-menu');
        var mobileMenuList = $('<ul />').appendTo($('#mobile-menu .top-bar-section'));
        
        var clonedList = $('#menu-wrapper > ul > li').clone();
        clonedList = getGeneratedSubmenu(clonedList);
        clonedList.appendTo(mobileMenuList);
        
        $(mobileMenuList).find('ul, li').removeAttr('id');
        
    }
    
    // Recursive function for generating submenus
    function getGeneratedSubmenu(list) {
    	//console.debug($('#menu-wrapper .main-menu > li'));
        $(list).each(function() {
            //$(this).append('<li class="divider"></li>');
            
            if($(this).find('ul').length > 0) {
                var submenu = $(this).find('ul');
                
                $(this).addClass('has-dropdown');
                submenu.addClass('dropdown'); 
                
                getGeneratedSubmenu(submenu.find('li'));
            }
        });
        
        return list;
    }
	
});