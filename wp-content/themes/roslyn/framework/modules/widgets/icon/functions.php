<?php

if ( ! function_exists( 'roslyn_elated_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function roslyn_elated_register_icon_widget( $widgets ) {
		$widgets[] = 'RoslynElatedIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_icon_widget' );
}