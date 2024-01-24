<?php

if ( ! function_exists( 'roslyn_news_register_layout7_widget' ) ) {
	/**
	 * Function that register layout7 widget
	 */
	function roslyn_news_register_layout7_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout7';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout7_widget' );
}