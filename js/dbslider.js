/* ================================================

 dbSlider
 v0.1
 
 USAGE
 .dbSlider();
 
 CHANGELOG
 v0.1
 * Initial Release

================================================ */

(function($) {
	
    $.fn.dbSlider = function (options) {
			
		// List Default Values
		var defaults = {
			
			// Slider Settings
			sliderClass:				"dbSlider",				// any string
			animationType: 				"fade",					// slide, fade, slideup
			markup:						"list",					// list, div, article
			
			// Features
			multipleSliders:			true,
			slideLoop:					true,
			keyboardNavigation:			true,
			swipeNavigation:			true,					// Requires TouchSwipe.js
			autoSize:					true,					// Resizes slider based on image size
			
			// Arrow Settings
			showNext:					true,
			showPrev:					true,
			showAnchors:				true,
			lastArrowOpacity:			0.5,
			
			// AutoSliding
			autoSlide:					false,
			autoSlideDelay:				4000,
			autoSlideRestart:			true,
			
		}
		
		// Extending Options
		var options = $.extend(defaults,options);
		
		// Setting up Targets
		switch (options.markup) {
			case "list": eTarget = "li"; break;
			case "div": eTarget = "div"; break;
			case "article": eTarget = "article"; break;
		}
	
		// Start the magic!
		i = 0;
		return this.each(function(i) {
			
			/* Setting up Environment
			-------------------------------------------- */
			
			// Add numeration on to sliderClass if there are multiples.
			if(options.multipleSliders) {
				options.sliderClass = options.sliderClass+"_"+i;
			}
			
			// Add SliderClass to this slider so we can target it without logic
			$(this).addClass(options.sliderClass + " dbSlider");
			var thisSlider = $("."+options.sliderClass);
			
			// Positioning
			thisSlider.find(eTarget).each(function(ia) {
				$(this).css({"position": "absolute"});

				// Styles based on animationType				
				switch (options.animationType) {
					case "fade": 
						$(this).css({"top": "0", "left": "0", "z-index": "1", "opacity": "1"});
						break;
					case "slide":
						
						break;
					case "slideup":
						
						break;
				}
				
				// Classing up the joint
				$(this).addClass("slideContainer slide_"+ia);
				ia++;
				
			});
			
			// Show First Slide
			goToSlide(1);
			
			/* Resize slider based on image size
			-------------------------------------------- */
			if(options.autoSize) {
				
				function resizeSlider() {
					thisSlider.find(".slide_0").each(function() {
						sliderHeight = $(this).height();
						sliderWidth = $(this).width();
						thisSlider.height(sliderHeight).width(sliderWidth);
					});
				}
				resizeSlider();
				
				// Listen for a window resize
				$(window).bind("resize", resizeSlider);
			}
			
			/* Animating the slides
			-------------------------------------------- */
			function goToSlide(target) {
				
				// Fade animation type
				if(options.animationType == "fade") {
					thisSlider.find(eTarget).stop().animate({"opacity": "0", "z-index": "1"});
					thisSlider.find(".slide_"+target).stop().animate({"opacity": "100%", "z-index": "99"});
				}
				
				// Slide animation type
				
				// Slide up animation type
			}
			
			/* Nexts and Previouses
			-------------------------------------------- */
			function nextSlide(target) {
				thisSlider.find(".currentSlide").next();
			}
			
			
			// Increment "i" for victory
			i++
			
		// End of Magic!
		});
	
	// End of Main Function
	}
	
// End of Script
})(jQuery);