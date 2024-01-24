<?php

if ( ! function_exists( 'roslyn_news_register_layout3_widget' ) ) {
	/**
	 * Function that register layout3 widget
	 */
	function roslyn_news_register_layout3_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout3';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout3_widget' );
}