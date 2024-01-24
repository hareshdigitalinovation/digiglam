(function($) {
    'use strict';
    
    var postCarousel6 = {};
    eltdf.modules.postCarousel6 = postCarousel6;
    
    postCarousel6.eltdfPostCarousel6 = eltdfPostCarousel6;
    
    postCarousel6.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);
    
    /*
     All functions to be called on $(window).on('load', ) should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfPostCarousel6();
    }
    
    /**
     * Post Carousel 6 Shortcode
     */
    function eltdfPostCarousel6() {
        var owlCustomSliders = $('.eltdf-post-carousel6 .eltdf-owl-slider'),
            effect = 'fxSlide';

        if (owlCustomSliders.length) {
        	owlCustomSliders.each(function(){
        		var owlCustomSlider = $(this),
        		outIndex,
        		isResized = false,
        		isDragged = false;

        		var owlCustomSliderData = owlCustomSlider.data('owl.carousel');
    		    owlCustomSliderData.settings.autoplay = false;
    		    owlCustomSliderData.options.autoplay = false;
    		    owlCustomSlider.trigger('refresh.owl.carousel');

        		if (owlCustomSlider.data('enable-autoplay') ) {
        			owlCustomSlider.data('enable-autoplay', "custom");
        			owlCustomSlider.attr('data-enable-autoplay', "custom");
        		}

        		owlCustomSlider.addClass("fxSlide");

        		owlCustomSlider.on('change.owl.carousel', function(event) {
        		    outIndex = event.item.index;
        		});

        		//Autoplay enabled handling
        		if(owlCustomSlider.data('enable-autoplay') == "custom") {
	        		var autoplayAgainTimeout;
	        		var autoplayIntervalTime = owlCustomSlider.data('slider-speed');
	        		var autoplayTimeoutTime = 4000;

	        		//Autoplay interval triggers next slide
	        		var autoplayInterval = setInterval(function() {
	    		  		owlCustomSlider.trigger('next.owl.carousel');
	        		}, autoplayIntervalTime);

	        		//Owl nav elements click interrupt
					owlCustomSlider.find('.owl-prev, .owl-next, .owl-dot, .owl-stage').on("click", function() {
					    clearInterval(autoplayInterval);
					    clearTimeout(autoplayAgainTimeout);
					    autoplayAgainTimeout = setTimeout(function() {
					        autoplayInterval = setInterval(function() {
					            owlCustomSlider.trigger('next.owl.carousel');
					        }, autoplayIntervalTime);
					    }, autoplayTimeoutTime);
					});
        		}

        		owlCustomSlider.on('resized.owl.carousel', function(event) {
        			owlCustomSlider.find('.owl-item.cloned').removeClass('fxSlideInNext');
        			owlCustomSlider.trigger('refresh.owl.carousel');
        		});

        		owlCustomSlider.on('changed.owl.carousel', function(event) {
        		    var inIndex = event.item.index,
        		        dir = outIndex <= inIndex ? 'Next' : 'Prev';

        		    var animation = {
        		        moveIn: {
        		            item: $('.owl-item', owlCustomSlider).eq(inIndex),
        		            effect: effect + 'In' + dir
        		        },
        		        moveOut: {
        		            item: $('.owl-item', owlCustomSlider).eq(outIndex),
        		            effect: effect + 'Out' + dir
        		        },
        		        run: function(type) {
        		            var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        		                animationObj = this[type],
        		                inOut = type == 'moveIn' ? 'in' : 'out',
        		                animationClass = 'animated owl-animated-' + inOut + ' ' + animationObj.effect,
        		                $nav = owlCustomSlider.find('.owl-prev, .owl-next, .owl-dot, .owl-stage');

        		            $nav.css('pointerEvents', 'none');

        		            animationObj.item.stop().addClass(animationClass).one(animationEndEvent, function() {
        		                // remove class at the end of the animations
        		                animationObj.item.removeClass(animationClass);
        		                $nav.css('pointerEvents', 'auto');
        		            });
        		        }
        		    };

    		      	if (!isDragged && !isResized){
    		        	animation.run('moveOut');
    		        	animation.run('moveIn');
    		      	}
    		    });

    		    owlCustomSlider.on('drag.owl.carousel', function(event) {
    		      	isDragged = true;
    		    });

    		    owlCustomSlider.on('dragged.owl.carousel', function(event) {
    		        isDragged = false;
    		    });
    		    
    		    owlCustomSlider.on('resize.owl.carousel', function(event) {
    		      	isResized = true;
    		    });
    		    
    		     owlCustomSlider.on('resized.owl.carousel', function(event) {
    		      	isResized = false;
    		    });
        	});
        }
    }

})(jQuery);