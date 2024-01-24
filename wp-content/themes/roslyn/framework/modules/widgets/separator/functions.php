<?php

if ( ! function_exists( 'roslyn_elated_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function roslyn_elated_register_separator_widget( $widgets ) {
		$widgets[] = 'RoslynElatedSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_separator_widget' );
}