<?php

if ( ! function_exists( 'roslyn_news_register_layout5_widget' ) ) {
	/**
	 * Function that register layout5 widget
	 */
	function roslyn_news_register_layout5_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout5';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout5_widget' );
}