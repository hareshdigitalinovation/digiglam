<?php

if ( ! function_exists( 'roslyn_elated_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function roslyn_elated_register_social_icon_widget( $widgets ) {
		$widgets[] = 'RoslynElatedSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_social_icon_widget' );
}