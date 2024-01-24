<?php

if(!function_exists('roslyn_elated_register_sticky_sidebar_widget')) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function roslyn_elated_register_sticky_sidebar_widget($widgets) {
		$widgets[] = 'RoslynElatedStickySidebar';
		
		return $widgets;
	}
	
	add_filter('roslyn_elated_register_widgets', 'roslyn_elated_register_sticky_sidebar_widget');
}