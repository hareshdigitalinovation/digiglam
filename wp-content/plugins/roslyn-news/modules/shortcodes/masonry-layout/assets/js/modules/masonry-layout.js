(function($) {
	"use strict";

    var masonryLayout = {};
    eltdf.modules.masonryLayout = masonryLayout;

    masonryLayout.eltdfOnDocumentReady = eltdfOnDocumentReady;
    masonryLayout.eltdfOnWindowResize = eltdfOnWindowResize;

    $(document).ready(eltdfOnDocumentReady);
    $(window).resize(eltdfOnWindowResize);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfInitMasonryLayout();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
	    eltdfInitMasonryLayout();
    }

    /* 
     * Trigger functions after pagination
    */
    $(document).on('eltdfNewsAfterPagination', function(event, masonryHolder, content) {
	    eltdfAppendContentMasonryLayout(masonryHolder, content);
    });

    /* 
     * Trigger functions after filtering
    */
    $(document).on('eltdfNewsAfterFilter', function(event, masonryHolder, content) {
	    eltdfAppendContentMasonryLayout(masonryHolder, content);
    });
	
    /**
     *  Init Masonry Layout
     */
    function eltdfInitMasonryLayout() {
        var masonryLayout = $('.eltdf-news-holder.eltdf-masonry-layout');

        if(masonryLayout.length){
            masonryLayout.each(function(){
                var container = $(this),
                    masonry = container.children('.eltdf-news-list-inner'),
                    size = masonry.find('.eltdf-masonry-layout-sizer').width();
	
	            masonry.waitForImages(function(){
		            masonry.isotope({
			            layoutMode: 'packery',
			            itemSelector: '.eltdf-news-item',
			            percentPosition: true,
			            packery: {
				            gutter: '.eltdf-masonry-layout-gutter',
				            columnWidth: '.eltdf-masonry-layout-sizer'
			            }
		            });
		
		            eltdf.modules.common.setFixedImageProportionSize(container, container.find('.eltdf-news-item'), size);
		
		            masonry.isotope( 'layout').addClass('eltdf-masonry-appeared');
	            });
            });
        }
    }

    function eltdfAppendContentMasonryLayout(masonryHolder, content) {
        if(masonryHolder.length && masonryHolder.parent().hasClass('eltdf-masonry-layout')){
            var size = masonryHolder.find('.eltdf-masonry-layout-sizer').width();

            //remove duplicated sizer and gutter if exist
            masonryHolder.find('.eltdf-masonry-layout-sizer').eq(1).remove();
            masonryHolder.find('.eltdf-masonry-layout-gutter').eq(1).remove();

			masonryHolder.isotope('reloadItems').isotope({sortBy: 'original-order'});
	        eltdf.modules.common.setFixedImageProportionSize(masonryHolder, masonryHolder.find('.eltdf-news-item'), size);
	        
			setTimeout(function() {
				masonryHolder.isotope('layout');
			}, 600);
        }
    }

})(jQuery);