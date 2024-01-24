<?php

if ( ! function_exists( 'roslyn_elated_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function roslyn_elated_register_search_opener_widget( $widgets ) {
		$widgets[] = 'RoslynElatedSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_search_opener_widget' );
}