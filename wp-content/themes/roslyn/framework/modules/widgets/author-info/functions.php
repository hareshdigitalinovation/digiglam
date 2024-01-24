<?php

if ( ! function_exists( 'roslyn_elated_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function roslyn_elated_register_author_info_widget( $widgets ) {
		$widgets[] = 'RoslynElatedAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_author_info_widget' );
}