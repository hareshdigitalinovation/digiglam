(function($) {
	"use strict";

    var news = {};
    eltdf.modules.news = news;

    news.eltdfOnDocumentReady = eltdfOnDocumentReady;
    news.eltdfOnWindowLoad = eltdfOnWindowLoad;
    news.eltdfOnWindowResize = eltdfOnWindowResize;
    news.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
    	eltdfInitNewsShortcodesFilter();
    	eltdfPostHoverAnimation();
    	eltdfInputEmailHoverAnimation();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdfOnWindowLoad() {
	    eltdfInitNewsShortcodesPagination().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
	    eltdfInitNewsShortcodesPagination().scroll();
    }

	/**
	 * Init news shortcodes pagination functions
	 */
	function eltdfInitNewsShortcodesPagination(){
		var holder = $('.eltdf-news-holder');
		
		var initStandardPagination = function(thisHolder) {
			var standardLink = thisHolder.find('.eltdf-news-standard-pagination li');

			if(standardLink.length) {
				standardLink.each(function(){

					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}

						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.eltdf-news-load-more-pagination a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var newsShortcodeHeight = thisHolder.outerHeight(),
				newsShortcodeTopOffest = thisHolder.offset().top,
				newsShortcodePosition = newsShortcodeHeight + newsShortcodeTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisHolder.hasClass('eltdf-news-pag-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > newsShortcodePosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.eltdf-news-list-inner'),
				nextPage,
				maxNumPages,
				pagRangeLimit;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('eltdf-news-pag-standard')) {
				thisHolder.data('next-page', pagedLink);
				pagRangeLimit = thisHolder.data('pagination-numbers-amount');
			}
			
			if(thisHolder.hasClass('eltdf-news-pag-infinite-scroll')) {
				thisHolder.addClass('eltdf-news-pag-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltdf-news-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisHolder.hasClass('eltdf-news-pag-standard')) {
					loadingItem.addClass('eltdf-showing eltdf-news-pag-standard-trigger');
					thisHolder.addClass('eltdf-news-standard-pag-animate');
				} else {
					loadingItem.addClass('eltdf-showing');
				}

				var spinner = thisHolder.find('.eltdf-spinner');
				spinner.removeClass('eltdf-hide-spinner').addClass('eltdf-show-spinner');

				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'roslyn_news_shortcodes_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdfGlobalVars.vars.eltdfAjaxUrl,
					success: function (data) {
						if(!thisHolder.hasClass('eltdf-news-pag-standard')) {
							nextPage++;
						}

						if(spinner.hasClass('eltdf-show-spinner')) {
							spinner.removeClass('eltdf-show-spinner').addClass('eltdf-hide-spinner');
						}
						
						thisHolder.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisHolder.hasClass('eltdf-news-pag-standard')) {
							eltdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage, pagRangeLimit);
							
							thisHolder.waitForImages(function(){
								eltdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                eltdf.modules.layout2.eltdfInitLayout2();

                                if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                                    eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                                }
							});
						} else {
							thisHolder.waitForImages(function(){
								eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								
								if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
									eltdf.modules.common.eltdfStickySidebarWidget().reInit();
								}
							});
						}
						if(thisHolder.hasClass('eltdf-news-pag-infinite-scroll-started')) {
							thisHolder.removeClass('eltdf-news-pag-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.eltdf-news-load-more-pagination').hide();
			}
		};
		
		var eltdfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing eltdf-news-pag-standard-trigger');
			thisHolder.removeClass('eltdf-news-standard-pag-animate');
			thisHolderInner.html(responseHtml);
			thisHolderInner.trigger('eltdfNewsAfterPagination', [thisHolderInner, responseHtml]);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisHolderInner.append(responseHtml);
			thisHolderInner.trigger('eltdfNewsAfterPagination', [thisHolderInner, responseHtml]);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-news-pag-standard')) {
							initStandardPagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-news-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-news-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-news-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

	/**
	 * Init post hover animation function
	 */
	function eltdfPostHoverAnimation(){
		//all posts on the page
		var post = $('.eltdf-news-item, .eltdf-bl-item');
		var postElement = $('.eltdf-post-image, .eltdf-post-title');

		postElement.on('mouseenter', function(){
			$(this).closest(post).addClass('eltdf-item-hover');
		});

		postElement.on('mouseleave', function(){
			$(this).closest(post).removeClass('eltdf-item-hover');
		});
	}

	/**
	 * Init input email hover animation function
	 */
	function eltdfInputEmailHoverAnimation(){
		var inputEmail = $('input[type="email"]');
		var inputParent = $('.eltdf-newsletter');

		inputEmail.on('focusin', function(){
			$(this).closest(inputParent).addClass('eltdf-item-focus');
		});

		inputEmail.on('focusout', function(){
			$(this).closest(inputParent).removeClass('eltdf-item-focus');
		});
	}

	function eltdfInitNewsShortcodesFilter(){
		var holder = $('.eltdf-news-holder');

		if (holder.length){

			holder.each(function(){
				var thisHolder = $(this),
					filterHolder = thisHolder.find('.eltdf-news-filter');

				if (filterHolder.length){
					var filters = filterHolder.find('.eltdf-news-filter-item'),
						filterBy = filterHolder.data('filter-by');

					filters.first().addClass('eltdf-news-active-filter');

					filters.on('click', function(e){
						e.preventDefault();
						e.stopPropagation();

						var thisFilter = $(this),
							filterData = thisFilter.data('filter');

						if (!thisFilter.hasClass('eltdf-news-active-filter')) {
							thisFilter.siblings().removeClass('eltdf-news-active-filter');
							thisFilter.addClass('eltdf-news-active-filter');

							thisHolder.addClass('eltdf-news-filter-activated');

							initFilterBy(thisHolder, filterBy, filterData);
						}
					});


					var initFilterBy = function(thisHolder, filterBy, filterData) {
						var thisHolderInner = thisHolder.find('.eltdf-news-list-inner');

						var spinner = thisHolder.find('.eltdf-spinner');
						spinner.removeClass('eltdf-hide-spinner').addClass('eltdf-show-spinner');

						var loadMoreData = eltdf.modules.common.getLoadMoreData(thisHolder);

						switch(filterBy) {
							case 'category':
								loadMoreData.categoryName = filterData;
							break;
							case 'tag':
								loadMoreData.tag = filterData;
							break;
						}

						var spinner = thisHolder.find('.eltdf-spinner');
						spinner.removeClass('eltdf-hide-spinner').addClass('eltdf-show-spinner');
						
						var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreData, 'roslyn_news_shortcodes_filter');
						
						$.ajax({
							type: 'POST',
							data: ajaxData,
							url: eltdfGlobalVars.vars.eltdfAjaxUrl,
							success: function (data) {
								
								var response = $.parseJSON(data),
									responseHtml =  response.html,
									newQueryParams =  response.newQueryParams;

								thisHolder.data('max-num-pages',newQueryParams['max_num_pages']);
								thisHolder.data('next-page',parseInt(newQueryParams['paged']) + 1);

								if(spinner.hasClass('eltdf-show-spinner')) {
									spinner.removeClass('eltdf-show-spinner').addClass('eltdf-hide-spinner');
								}

								switch(filterBy) {
									case 'category':
										thisHolder.data('category-name', filterData);
									break;
									case 'tag':
										thisHolder.data('tag', filterData);
									break;
								}

								if(thisHolder.data('max-num-pages') == thisHolder.data('paged')) {
									thisHolder.find('.eltdf-news-load-more-pagination').hide();
								} else {
									thisHolder.find('.eltdf-news-load-more-pagination').show();									
								}

								if(thisHolder.hasClass('eltdf-news-pag-infinite-scroll-started')) {
									thisHolder.removeClass('eltdf-news-pag-infinite-scroll-started');
								}

								if (thisHolder.find('.eltdf-news-standard-pagination').length){
									var standardPagHolder = thisHolder.find('.eltdf-news-standard-pagination'),
										standardPagNumericItem = standardPagHolder.find('li.eltdf-news-pag-number'),
										standardPagLastPage = standardPagHolder.find('li.eltdf-news-pag-last-page a'),
										maxNumPages = thisHolder.data('max-num-pages'),
										pagRangeLimit = thisHolder.data('pagination-numbers-amount');

									eltdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, 1, pagRangeLimit);

									if (maxNumPages == 1){
										standardPagHolder.hide();
									} else {
										standardPagHolder.show();
									}

									standardPagLastPage.data('paged',maxNumPages);

									if (maxNumPages <= pagRangeLimit){
										standardPagNumericItem.each(function(e){
											var thisItem = $(this);

											if (e >= maxNumPages){
												thisItem.hide();
											} else {
												thisItem.show();
											}
										});
									} else {
										standardPagNumericItem.show();
									}
								}
									
								thisHolder.waitForImages(function(){
									eltdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, responseHtml);
									if(spinner.hasClass('eltdf-show-spinner')) {
										spinner.removeClass('eltdf-show-spinner').addClass('eltdf-hide-spinner');
									}
									thisHolder.removeClass('eltdf-news-filter-activated');
									
									if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
										eltdf.modules.common.eltdfStickySidebarWidget().reInit();
									}
								});
							}
						});
					};

					var eltdfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, responseHtml) {
						thisHolderInner.html(responseHtml);
						thisHolderInner.trigger('eltdfNewsAfterPagination', [thisHolderInner, responseHtml]);
					};
				}
			});
		}
	}

	/*
	* Function for Pagination Link Changes for navigation and filter
	*/
	function eltdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage, pagRangeLimit) {
		var standardPagHolder = thisHolder.find('.eltdf-news-standard-pagination'),
			standardPagNumericItem = standardPagHolder.find('li.eltdf-news-pag-number'),
			standardPagPrevItem = standardPagHolder.find('li.eltdf-news-pag-prev'),
			standardPagNextItem = standardPagHolder.find('li.eltdf-news-pag-next'),
			standardPagFirstItem = standardPagHolder.find('li.eltdf-news-pag-first-page'),
			standardPagLastItem = standardPagHolder.find('li.eltdf-news-pag-last-page'),
			i = 1,
			j = pagRangeLimit,
			middle = Math.floor(pagRangeLimit/2)+1;

		if (pagRangeLimit > maxNumPages) {
			pagRangeLimit = maxNumPages;
		}
		
		standardPagPrevItem.data('paged', nextPage-1);
		standardPagNextItem.data('paged', nextPage+1);
		
		if(nextPage > 1) {
			standardPagPrevItem.css({'display': 'inline-block'});
		} else {
			standardPagPrevItem.css({'display': 'none'});
		}
		
		if(nextPage === maxNumPages) {
			standardPagNextItem.css({'display': 'none'});
		} else {
			standardPagNextItem.css({'display': 'inline-block'});
		}

		if(nextPage > middle) {
			standardPagFirstItem.css({'display': 'inline-block'});
		} else {
			standardPagFirstItem.css({'display': 'none'});
		}

		if(nextPage < maxNumPages - middle + 1) {
			standardPagLastItem.css({'display': 'inline-block'});
		} else {
			standardPagLastItem.css({'display': 'none'});
		}


		if (nextPage >= middle && nextPage <= maxNumPages - middle + 1) {
			standardPagNumericItem.eq(middle - 1).find('a').data('paged', nextPage);
			standardPagNumericItem.eq(middle - 1).find('a').html(nextPage);
			standardPagNumericItem.removeClass('eltdf-news-pag-active');
			standardPagNumericItem.eq(middle - 1).addClass('eltdf-news-pag-active');

			while (i < middle) {
			    standardPagNumericItem.eq(middle - i - 1 ).find('a').data('paged', nextPage - i);
			    standardPagNumericItem.eq(middle - i - 1 ).find('a').html(nextPage - i);
			    standardPagNumericItem.eq(middle + i - 1 ).find('a').data('paged', nextPage + i);
			    standardPagNumericItem.eq(middle + i - 1 ).find('a').html(nextPage + i);
			    i++;
			}

		} else if (nextPage < middle) {
			while (i <= pagRangeLimit) {
			    standardPagNumericItem.eq(i - 1 ).find('a').data('paged', i);
			    standardPagNumericItem.eq(i - 1 ).find('a').html(i);
			    i++;
			}

			standardPagNumericItem.removeClass('eltdf-news-pag-active');
			standardPagNumericItem.eq(nextPage - 1).addClass('eltdf-news-pag-active');

		} else {
			while (j > 0) {
			    standardPagNumericItem.eq(pagRangeLimit - j).find('a').data('paged', maxNumPages - j + 1);
			    standardPagNumericItem.eq(pagRangeLimit - j ).find('a').html(maxNumPages - j + 1);
			    j--;
			}

			standardPagNumericItem.removeClass('eltdf-news-pag-active');
			standardPagNumericItem.eq(pagRangeLimit - (maxNumPages - nextPage) - 1).addClass('eltdf-news-pag-active');
		}
	}

})(jQuery);