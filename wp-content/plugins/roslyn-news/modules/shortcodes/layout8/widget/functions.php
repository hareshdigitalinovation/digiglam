<?php

if ( ! function_exists( 'roslyn_news_register_layout8_widget' ) ) {
	/**
	 * Function that register layout8 widget
	 */
	function roslyn_news_register_layout8_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout8';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout8_widget' );
}