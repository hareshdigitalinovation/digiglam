<?php

if ( ! function_exists( 'roslyn_news_register_latest_news_widget' ) ) {
	/**
	 * Function that register latest news widget
	 */
	function roslyn_news_register_latest_news_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassLatestNews';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_latest_news_widget' );
}