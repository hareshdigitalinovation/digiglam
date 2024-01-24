<?php

if ( ! function_exists( 'roslyn_news_register_layout2_widget' ) ) {
	/**
	 * Function that register layout2 widget
	 */
	function roslyn_news_register_layout2_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWidgetLayout2';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_layout2_widget' );
}