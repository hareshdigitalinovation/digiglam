<?php

if ( ! function_exists( 'roslyn_elated_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function roslyn_elated_register_custom_font_widget( $widgets ) {
		$widgets[] = 'RoslynElatedCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_custom_font_widget' );
}