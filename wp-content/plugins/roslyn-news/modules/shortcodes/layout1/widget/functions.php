<?php

if ( ! function_exists( 'roslyn_news_register_layout1_widget' ) ) {
	/**
	 * Function that register layout1 widget
	 */
	function roslyn_news_register_layout1_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout1';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout1_widget' );
}