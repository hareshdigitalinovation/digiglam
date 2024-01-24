<?php

if ( ! function_exists( 'roslyn_elated_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function roslyn_elated_register_blog_list_widget( $widgets ) {
		$widgets[] = 'RoslynElatedBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_blog_list_widget' );
}