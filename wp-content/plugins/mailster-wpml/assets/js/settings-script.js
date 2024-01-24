jQuery(document).ready(function ($) {

	var textsnav = $('#wpml-text-nav'),
		textstabs = $('.wpml-text-tab');

	textsnav.on('click', 'a.nav-tab', function () {
		textsnav.find('a').removeClass('nav-tab-active');
		textstabs.hide();
		var hash = $(this).addClass('nav-tab-active').attr('href');
		$('#tab-' + hash.substr(1)).show();
		return false;
	}).find('a.nav-tab').eq(0).trigger('click');


});