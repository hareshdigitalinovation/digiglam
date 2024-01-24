<?php

if ( ! function_exists( 'roslyn_news_register_layout6_widget' ) ) {
	/**
	 * Function that register layout6 widget
	 */
	function roslyn_news_register_layout6_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout6';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout6_widget' );
}