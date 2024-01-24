<?php

if ( ! function_exists( 'roslyn_elated_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function roslyn_elated_register_button_widget( $widgets ) {
		$widgets[] = 'RoslynElatedButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_button_widget' );
}