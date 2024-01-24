<?php

if ( ! function_exists( 'roslyn_elated_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function roslyn_elated_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'RoslynElatedSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_sidearea_opener_widget' );
}