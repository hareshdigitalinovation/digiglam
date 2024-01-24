<?php

if ( ! function_exists( 'roslyn_elated_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function roslyn_elated_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'RoslynElatedRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_recent_posts_widget' );
}