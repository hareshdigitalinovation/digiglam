(function($) {
	"use strict";

    var layout2 = {};
    eltdf.modules.layout2 = layout2;

    layout2.eltdfOnDocumentReady = eltdfOnDocumentReady;
    layout2.eltdfOnWindowResize = eltdfOnWindowResize;
    layout2.eltdfInitLayout2 = eltdfInitLayout2;

    $(document).ready(eltdfOnDocumentReady);
    $(window).resize(eltdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfInitLayout2();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
	    eltdfInitLayout2();
    }
	
    /**
     *  Init Layout2
     */
    function eltdfInitLayout2() {
	    var holder = $('.eltdf-news-item.eltdf-layout2-item');
	
	    if (holder.length) {
		    holder.each(function () {
			    var thisHolder = $(this),
				    itemBottomMargin = thisHolder.children('.eltdf-ni-inner'),
				    contentItem = thisHolder.find('.eltdf-ni-content'),
				    tallest = 0;

			    contentItem.each(function() {
				    var thisItem = $(this).outerHeight();

				    if(thisItem > tallest) {
					    tallest = thisItem;
				    }
			    });

			    if (tallest > 0 && holder.parents().hasClass('eltdf-post-carousel2')) {
                    itemBottomMargin.css('marginBottom', tallest);
                }
				else if(tallest > 0){
					itemBottomMargin.css('marginBottom', tallest - 65); //60 is content offset inside image
				}
		    });
	    }
    }

})(jQuery);