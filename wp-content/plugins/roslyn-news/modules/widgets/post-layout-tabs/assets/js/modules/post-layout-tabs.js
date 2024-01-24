(function($) {
    'use strict';
	
	var postTabs = {};
	eltdf.modules.postTabs = postTabs;

	postTabs.eltdfPostLayoutTabWidget = eltdfPostLayoutTabWidget;


	postTabs.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfPostLayoutTabWidget().init();
	}

	/**
	 * Object that represents post layout tabs widget
	 * @returns {{init: Function}} function that initializes post layout tabs widget functionality
	 */
	function eltdfPostLayoutTabWidget(){
		var layoutTabsWidget = $('.eltdf-plw-tabs');
		
		var eltdfPostLayoutTabWidgetEvent = function (thisWidget) {
			var plwTabsHolder = thisWidget.find('.eltdf-plw-tabs-tabs-holder'),
				plwTabsContent = thisWidget.find('.eltdf-plw-tabs-content-holder'),
				currentItemPosition = plwTabsHolder.children('.eltdf-plw-tabs-tab:first-child').index() + 1; // +1 is because index start from 0 and list from 1

			setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);

			plwTabsHolder.find('a').mouseover(function (e) {
				e.preventDefault();

				currentItemPosition = $(this).parents('.eltdf-plw-tabs-tab').index() + 1; // +1 is because index start from 0 and list from 1

				setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);
			});
		};

		function setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition){
			var activeItemClass = 'eltdf-plw-tabs-active-item';

			plwTabsContent.children('.eltdf-plw-tabs-content').removeClass(activeItemClass);
			plwTabsHolder.children('.eltdf-plw-tabs-tab').removeClass(activeItemClass);

			var height = plwTabsContent.children('.eltdf-plw-tabs-content:nth-child('+currentItemPosition+')').addClass(activeItemClass).height();
			plwTabsContent.css('min-height',height+'px');
			plwTabsHolder.children('.eltdf-plw-tabs-tab:nth-child('+currentItemPosition+')').addClass(activeItemClass);
		}

		return {
			init : function() {
				if (layoutTabsWidget.length) {
					layoutTabsWidget.each(function () {
						eltdfPostLayoutTabWidgetEvent($(this));
					});
				}
			}
		};
	}

})(jQuery);