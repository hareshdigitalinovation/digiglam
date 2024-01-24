<?php

if ( ! function_exists( 'roslyn_news_register_post_layout_tabs_widget' ) ) {
	/**
	 * Function that register weather widget
	 */
	function roslyn_news_register_post_layout_tabs_widget( $widgets ) {
		$widgets[] = 'RoslynfNewsClassPostLayoutTabs';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_post_layout_tabs_widget' );
}